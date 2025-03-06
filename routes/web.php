<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\SuperAdminMiddleware;
use App\Http\Controllers\UserControllers\PMController;


// Redirect all unauthenticated users to login first
Route::get('/', function () {
    return redirect('/login');
})->name('home');

// Protect all routes so only Super Admins can access them

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('manager.create');
    });
    Route::resource('manager-dashboard', PMController::class);
});

