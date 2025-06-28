<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;

// Route::get('/',function(){
//     return view('welcome');
// });
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/dashboard',[MovieController::class,'showdashboard']);
Route::get('/dashboard', [MovieController::class, 'showdashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function()
{
    Route::get('/addmovies',[MovieController::class,'create'])->name('add.movies');
    Route::post('/submitmovie',[MovieController::class,'store']);
});
Route::get('/',[MovieController::class,'show']);
Route::delete('/movies/{id}',[MovieController::class,'destroy'])->name('addmovie.destroy');
Route::get('/details/{id}',function(){
    return view('details');
})->name('movie.details');
route::get('/book',function(){
    return view('movies.book');
})->name('movies.book');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('/paymentsuccess',function(){
    return view('paymentsuccess');
});


Route::get('/paymentfailed',function(){
    return view('paymentfailed');
});