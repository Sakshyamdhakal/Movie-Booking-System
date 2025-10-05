<?php

namespace App\Http\Controllers;

use App\Events\UserLoggedIn;
use Illuminate\Http\Request;
use App\Models\Newmovie;
use App\Models\MovieBooking;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Mail\BookingConfirmationMail;
use App\Models\Favorite;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MovieController extends Controller
{

    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $userId = $user->id;
        $totalBookings = MovieBooking::where('user_id', $userId)
            ->whereDate('date', Carbon::now())
            ->count();
        $query = Newmovie::query();

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $addmovie = $query->get();

        return view('welcome', compact(['addmovie', 'totalBookings']));
    }

    public function create()
    {
        return view('addmovies');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|mimes:jpg,png,jpeg|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
        ];

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        Newmovie::create($data);
        return redirect('/')->with('success', 'Movie added successfully!');
    }

    public function show(Request $request)
    {
        $addmovie = Newmovie::all();
        return view('welcome', compact('addmovie'));
    }

    public function showdashboard()
    {
        if (!Auth::check() || auth()->user()->role !== 'admin') {
            return redirect('/')->with('error', 'Access Denied.');
        }

        $addmovie = Newmovie::all();
        return view('dashboard', compact('addmovie'));
    }

    public function destroy($id)
    {
        $movie = Newmovie::findOrFail($id);
        $movie->delete();
        return redirect('/')->with('success', 'Movie deleted successfully!');
    }


    // Show the booking form for a movie
    public function showForm($movieid)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $user = Auth::user();
        $movie = Newmovie::findOrFail($movieid);
        return view('movies.book', compact('movie', 'user'));
    }

    public function storeUserdetails(Request $request, $movieid)
    {
        $request->validate([
            'name'   => 'required|string',
            'email'  => 'required|email',
            'seats'  => 'required|integer|min:1'
        ]);

        $movie = Newmovie::findOrFail($movieid);

        $booking = MovieBooking::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'seats'    => $request->seats,
            'movie_id' => $movieid,
            'movie'    => $movie->name,
            'user_id'  => auth()->id(),
            'date' =>  now(),
        ]);
        //pending
        Mail::to($booking->email)->queue(new BookingConfirmationMail($booking));

        return redirect()->route('movie.confirm', ['bookingid' => $booking->id]);
    }

    public function confirmation($bookingid)
    {
        $booking = MovieBooking::with('movie')->findOrFail($bookingid);
        return view('movies.confirmation', compact('booking'));
    }

    public function showTicket()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $bookings = MovieBooking::where('user_id', auth()->id())->latest()->get();
        return view('movies.user_bookings', compact('bookings'));
    }



    public function destroyBooking($bookingId)
    {
        $booking = MovieBooking::findOrFail($bookingId);
        $booking->delete();

        return redirect()->route('landingpage')->with('success', 'Booking Cancelled.');
    }

    public function editMovie($id)
    {
        if (!Auth::check() || auth()->user()->role !== 'admin') {
            return redirect('/')->with('error', 'Access Denied.');
        }
        $movie = Newmovie::findOrFail($id);
        return view('movies.edit', compact('movie'));
    }

    public function updateMovie(Request $request, $id)
    {
        if (!Auth::check() || auth()->user()->role !== 'admin') {
            return redirect('/')->with('error', 'Access Denied.');
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|mimes:jpg,png,jpeg,avif,webp|max:2048',
        ]);

        $movie = Newmovie::findOrFail($id);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
        ];

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        $movie->update($data);

        return redirect('/dashboard')->with('success', 'Movie updated successfully!');
    }

    public function details($id)
    {
        $movie = Newmovie::findOrFail($id);
        return view('details', compact('movie'));
    }



    public function toggleFavorite($movieId)
    {
        try {
            $userId = auth()->id();

            if (!$userId) {
                return response()->json(['error' => 'User not authenticated'], 401);
            }

            $existing = Favorite::where('user_id', $userId)
                ->where('movie_id', $movieId)
                ->first();

            if ($existing) {
                $existing->delete();
                return response()->json(['status' => 'removed']);
            } else {
                Favorite::create([
                    'user_id' => $userId,
                    'movie_id' => $movieId,
                ]);
                return response()->json(['status' => 'added']);
            }
        } catch (\Exception $e) {
            Log::error('Favorite toggle error: ' . $e->getMessage());
            return response()->json(['error' => 'Internal server error'], 500);
        }
    }

    public function favorites()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $userId = auth()->id();
        $favorites = Favorite::with('movie')
            ->where('user_id', $userId)
            ->get();

        $totalBookings = MovieBooking::where('user_id', $userId)
            ->whereDate('date', Carbon::today())
            ->count();

        return view('movies.favourites', compact('favorites', 'totalBookings'));
    }
}
