<?php

use App\Models\Apartment;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Admin\Auth\AdminController;
use App\Http\Controllers\Admin\Auth\OverviewController;
use App\Http\Controllers\Admin\Auth\ApartmentController;
use App\Http\Controllers\Admin\Auth\manageListController;
use App\Http\Controllers\Landlord\Auth\LandlordController;
use App\Http\Controllers\Admin\Auth\addApartmentController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;


Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest:admin')->group(function () {
        Route::get('login', [AuthenticatedSessionController::class, 'create'])
            ->name('login');
        Route::post('login', [AuthenticatedSessionController::class, 'store']);
    });

    // auth route
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', function () {
            // Fetch counts
            $totalListings = Apartment::count();
            $pendingApprovals = Apartment::where('status', 'pending')->count();
            $activeListings = Apartment::where('status', 'approved')->count();

            // Fetch recent activities
            $recentActivities = Apartment::latest()->take(5)->get();
            return view('admin.auth.overview', compact(
                'totalListings',
                'pendingApprovals',
                'activeListings',
                'recentActivities'
            ));
        })->name('dashboard');



        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::put('password', [PasswordController::class, 'update'])->name('password.update');
        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
            ->name('logout');

        // Route::get('/overview', [AdminController::class, 'overview'])->name('overview');


        Route::get('/pending-list', [addApartmentController::class, 'pendingList'])->name('pending_list');
        Route::get('/approve-apartment/{id}', [addApartmentController::class, 'approveApartment'])->name('approve_apartment');
        Route::get('/reject-apartment/{id}', [addApartmentController::class, 'rejectApartment'])->name('reject_apartment');

        Route::get('/user-management', [AdminController::class, 'userManagement'])->name('user_management');

        Route::get('/manage-list', [manageListController::class, 'manageList'])->name('manage_list');
        Route::get('/edit-apartment/{id}', [manageListController::class, 'editApartment'])->name('edit_apartment');
        Route::put('/update-apartment/{id}', [manageListController::class, 'updateApartment'])->name('update_apartment');
        Route::delete('/delete-apartment/{id}', [manageListController::class, 'deleteApartment'])->name('delete_apartment');

        Route::get('/overview', [OverviewController::class, 'index'])->name('overview');
        Route::get('/landlords/{id}/edit', [AdminController::class, 'edit'])->name('landlords.edit');
        Route::delete('/landlords/{id}', [AdminController::class, 'destroy'])->name('landlords.delete');
        Route::put('/landlords/{id}/update', [AdminController::class, 'update'])->name('landlords.update');

    });
});
