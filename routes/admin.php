<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Admin\Auth\AdminController;
use App\Http\Controllers\Admin\Auth\ApartmentController;
use App\Http\Controllers\Landlord\Auth\LandlordController;
use App\Http\Controllers\Admin\Auth\addApartmentController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;

Route::prefix('admin')->name('admin.')->group(function(){
Route::middleware('guest:admin')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

// auth route
Route::middleware('auth:admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');

    Route::get('/overview', [AdminController::class, 'overview'])->name('overview');


    Route::get('/pending-list', [addApartmentController::class, 'pendingList'])->name('pending_list');
    Route::get('/approve-apartment/{id}', [addApartmentController::class, 'approveApartment'])->name('approve_apartment');
    Route::get('/reject-apartment/{id}', [addApartmentController::class, 'rejectApartment'])->name('reject_apartment');

    Route::get('/manage-list', [AdminController::class, 'manageList'])->name('manage_list');
    Route::get('/user-management', [AdminController::class, 'userManagement'])->name('user_management');
});
});
