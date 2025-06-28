<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;


Route::middleware('guest:admin')->group(function () {
    Route::get('admin/login', [AuthenticatedSessionController::class, 'create'])
        ->name('admin.login');

    Route::post('admin/login', [AuthenticatedSessionController::class, 'store']);
});

// Authenticated routes for admin (only accessible when logged in as admin)
Route::middleware('auth:admin')->group(function () {
    Route::post('admin/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('admin.logout');

    Route::get('/admin/dashboard', function () {
        return view('admin.admindashboard'); // Create this Blade file: resources/views/admin/dashboard.blade.php
    })->name('admin.dashboard');
});
