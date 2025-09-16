<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// Route::get('/',function(){
//     return view('welcome');
// });
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/dashboard',[MovieController::class,'showdashboard']);
// Route::get('/dashboard', [MovieController::class, 'showdashboard'])->middleware(['auth', 'verified','is_admin'])->name('dashboard');
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [MovieController::class, 'showdashboard'])->name('dashboard');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/addmovies', [MovieController::class, 'create'])->name('add.movies');
    Route::post('/submitmovie', [MovieController::class, 'store']);
});

Route::post('/custom-logout', function (Request $request) {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/')->with('success', 'You have been logged out.');
})->name('logout');


Route::get('/', [MovieController::class, 'index'])->name('landingpage');
Route::post('store/{movie}', [MovieController::class, 'storeuserdetails'])->name('movie.store');
Route::get('/confirm/{bookingid}', [MovieController::class, 'confirmation'])->name('movie.confirm');
Route::delete('/movies/{id}', [MovieController::class, 'destroy'])->name('addmovie.destroy');
Route::delete('/bookings/{bookingId}', [MovieController::class, 'destroyBooking'])->name('booking.destroy');
Route::get('/edit/{booking}', [MovieController::class, 'edit'])->name('booking.edit');
Route::post('/bookings/{booking}', [MovieController::class, 'update'])->name('movies.update');

Route::get('/movies/edit/{id}', [MovieController::class, 'editMovie'])->name('movies.edit');
Route::post('/movies/edit/{id}', [MovieController::class, 'updateMovie'])->name('movies.updateMovie');
Route::get('/ticket', [MovieController::class, 'showTicket'])->name('movie.ticket');
Route::get('details/{id}', [MovieController::class, 'details'])->name('movie.details');

Route::post('/userlogin', [MovieController::class, 'userlogin'])->name('user.login');
Route::get('/userlogin', function () {
    return view('login');
})->name('user.login.form');

Route::get('/book/{movieid}', [MovieController::class, 'showform'])->name('movies.book');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
