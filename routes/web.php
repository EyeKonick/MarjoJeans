<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\ApartmentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
Route::get('/search-apartments', [UserController::class, 'search'])->name('search.apartments');


require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/landlord.php';
