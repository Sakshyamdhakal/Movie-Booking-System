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
use Illuminate\Support\Facades\Mail;

class MovieController extends Controller
{

    //  public function index(Request $request)
    // {
    //     $query=Newmovie::query();
    //     if($request->has('search')){
    //         $query->where('name','like','%'. $request->search . '%');
    //     }
    //         $addmovie=$query->get();
    //     return view('welcome',compact('addmovie'));
    // }

public function index(Request $request)
{
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $user=Auth::user(); 

    $query = Newmovie::query();

    if ($request->has('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    $addmovie = $query->get();

    return view('welcome', compact('addmovie'));
}

public function create(){
    return view('addmovies');
}

public function store(Request $request)
{
            $request->validate([
             'name'   => 'required|string|max:255',
             'description'  => 'nullable|string',
             'image'=> 'required|mimes:jpg,png,jpeg|max:2048',
         ]);

          NewMovie::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
                return redirect('/')->with('success', 'Movie added successfully!');
}

public function show(Request $request)
{
        $addmovie=NewMovie::all();
        return view('welcome',compact('addmovie'));
}

public function showdashboard()
{
    Auth::user()->role;
    if (!Auth::check() || auth()->user()->role!== 'admin') {
        return redirect('/')->with('error', 'Access Denied.');
    }
    
    $addmovie=Newmovie::all();
    return view('dashboard',compact('addmovie'));
}

public function destroy($id)
{
    $movie=Newmovie::findOrFail($id);
    $movie->delete();
    return redirect('/')->with('success', 'Movie deleted successfully!');
}
  // Show the booking form for a movie
    public function showForm($movieid)

    {
        $movie=Newmovie::findOrFail($movieid);
        return view('movies.book', compact('movie'));
    }

public function storeUserdetails(Request $request, $movieid)
{
    $request->validate([
        'name'   => 'required|string',
        'email'  => 'required|email',
        'seats'  => 'required|integer|min:1'
    ]);

    $movie = Newmovie::findOrFail($movieid);

    $booking=MovieBooking::create([
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

public function showTicket(){
    $bookings = MovieBooking::where('user_id', auth()->id())->get();
    return view('movies.user_bookings', compact('bookings'));
}

    public function userlogin(Request $request)
{
    $data=$request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:userlogin',
        'password' => 'required|string|min:6',
    ]);

    $user = userlogin::create([
        'name' => $data['name'],
        'email' =>$data['email'],
        'password' => Hash::make($data['password']),
        'role' => 'user',
    ]);

    Auth::login($user);
    $user=Auth::user();
    event(new UserLoggedIn($user));
    return redirect('/')->with('success', 'Account created!');
}

    public function destroyBooking($bookingId)
    {
        $booking = MovieBooking::findOrFail($bookingId);
        $booking->delete();

        return redirect()->route('landingpage')->with('success', 'Booking deleted.');
    }

}

//     public function edit(MovieBooking $booking)
//     {
//             return view('movies.edit',compact('booking'));
//     }

//     public function update(Request $request ,MovieBooking $bookingid)
//     {
//         $data=$request->validate([
//             'name'=> 'required',
//             'email'=>'required|email',
//             'seats'=> 'required|integer|min:1'
//         ]);
//         $bookingid->update($data);

//         return redirect()->route('movies.confirm');
//     }
// 

