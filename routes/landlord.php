<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Landlord\ProfileController;
use App\Http\Controllers\Landlord\Auth\showPendingList;
use App\Http\Controllers\Landlord\Auth\LandlordController;
use App\Http\Controllers\Landlord\Auth\showUploadsController;
use App\Http\Controllers\Landlord\Auth\AddApartmentController;
use App\Http\Controllers\Landlord\Auth\RegisteredUserController;
use App\Http\Controllers\Landlord\Auth\AuthenticatedSessionController;

Route::prefix('landlord')->name('landlord.')->group(function(){
Route::middleware('guest:landlord')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

// auth route
Route::middleware('auth:landlord')->group(function () {
    Route::get('/dashboard', function () {
        return view('landlord.dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');

    Route::get('/add-apartment', [LandlordController::class, 'addApartment'])->name('add_apartment');
     Route::get('/list-uploads', [showUploadsController::class, 'uploadList'])->name('list_uploads');
    Route::get('/list-pending', [showPendingList::class, 'showPendingList'])->name('list_pending');
    Route::get('/update-apartment', [LandlordController::class, 'updateApartment'])->name('update_apartment');

    Route::delete('/apartments/{id}', [ShowPendingList::class, 'deleteApartment'])->name('apartments.delete');
    Route::get('/apartments/{id}/edit', [LandlordController::class, 'edit'])->name('apartments.edit');

    // Route for updating the apartment
    Route::put('/apartments/{id}', [LandlordController::class, 'update'])->name('apartments.update');


    Route::post('/add-apartment', [AddApartmentController::class, 'store'])->name('add_apartment_item');

});
});
