<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Newmovie;
use App\Models\MovieBooking;
use phpDocumentor\Reflection\Types\Null_;

class MovieController extends Controller
{

     public function index()
    {
        $addmovie =Newmovie::all();
        return view('dashboard',compact('addmovie'));
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

         $imagepath=Null;
        if($request->hasFile('image'))  {
         $imagepath=$request->file('image')->store('posters','public');
        }

          NewMovie::create([
            'name' => $request->name,
            'description' => $request->description,
            'image'=>$imagepath,
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
    $addmovie=Newmovie::all();
    return view('dashboard',compact('addmovie'));
}

public function destroy($id)
{
    $movie=Newmovie::findOrFail($id);
    $movie->delete();
    return redirect('/')->with('success', 'Movie deleted successfully!');
}

}

    // List all movies
//     public function index()
//     {
//         $movies = Movie::all();
//         return view('movies.movies', compact('movies'));
//     }

//     // Show the booking form for a movie
//     public function showForm(Movie $movie)
//     {
//         return view('movies.book', compact('movie'));
//     }

//     // Handle form save
//     public function store(Request $request, Movie $movie)
//     {
//         $data = $request->validate([
//             'name'   => 'required',
//             'email'  => 'required|email',
//             'seats'  => 'required|integer|min:1'
//         ]);

//         $booking = $movie->bookings()->create($data);

//         return redirect()->route('movies.confirm', $booking->id);
//     }

//     // Show confirmation
//     public function confirm($bookingId)
//     {
//         $booking = MovieBooking::findOrFail($bookingId);
//         return view('movies.confirmation', compact('booking'));        
//     }

//     // Delete booking
//     public function destroy($bookingId)
//     {
//         $booking = MovieBooking::findOrFail($bookingId);
//         $booking->delete();

//         return redirect()->route('movies.index')->with('success', 'Booking deleted.');
//     }

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

