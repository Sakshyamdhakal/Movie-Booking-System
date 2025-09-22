<?php

namespace App\Http\Controllers;

use App\Events\EventsManager;
use App\Events\UserLoggedIn;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Newmovie;
use App\Models\MovieBooking;
use App\Models\Userlogin;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;
use App\Mail\BookingConfirmationMail;
use App\Models\Favorite;
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
        $userId = auth()->id();
        $today = \Carbon\Carbon::today();
        $totalBookings = MovieBooking::where('user_id', $userId)->count();
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

        NewMovie::create($data);
        return redirect('/')->with('success', 'Movie added successfully!');
    }

    public function show(Request $request)
    {
        $addmovie = NewMovie::all();
        return view('welcome', compact('addmovie'));
    }

    public function showdashboard()
    {
        Auth::user()->role;
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
        $user = Auth::user() ;
        $movie = Newmovie::findOrFail($movieid);
        return view('movies.book', compact('movie','user'));
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
        ]);
        //pending
        // Mail::to($booking->email)->send(new BookingConfirmationMail($booking));

        return redirect()->route('movie.confirm', ['bookingid' => $booking->id]);
    }

    public function confirmation($bookingid)
    {
        $booking = MovieBooking::with('movie')->findOrFail($bookingid);
        return view('movies.confirmation', compact('booking'));
    }

    public function showTicket()
    {
        $bookings = MovieBooking::where('user_id', auth()->id())->latest()->get();
        return view('movies.user_bookings', compact('bookings'));
    }

    public function userlogin(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:userlogin',
            'password' => 'required|string|min:6',
        ]);

        $user = userlogin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'user',
        ]);

        Auth::login($user);
        $user = Auth::user();
        event(new UserLoggedIn($user));
        return redirect('/')->with('success', 'Account created!');
    }

    public function destroyBooking($bookingId)
    {
        $booking = MovieBooking::findOrFail($bookingId);
        $booking->delete();

        return redirect()->route('landingpage')->with('success', 'Booking Cancelled.');
    }



    public function edit(MovieBooking $booking)
    {
        return view('movies.edit', compact('booking'));
    }

    public function update(Request $request, MovieBooking $bookingid)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'seats' => 'required|integer|min:1'
        ]);
        $bookingid->update($data);

        return redirect()->route('movies.confirm');
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
        $userId = auth()->id();
        $favorites = Favorite::with('movie')
            ->where('user_id', $userId)
            ->get();

        $totalBookings = MovieBooking::where('user_id', $userId)->count();

        return view('movies.favourites', compact('favorites', 'totalBookings'));
    }
}
