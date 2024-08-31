<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function overview() {
        return view('admin.auth.overview');
    }

    Public function pendingList() {
        $pending = [
            ['apartment_name' => 'Sunny Villa', 'address' => '123 Sunshine Ave', 'owner_name' => 'John Doe', 'price' => '$1200'],
            ['apartment_name' => 'Cozy Cottage', 'address' => '456 Winter Lane', 'owner_name' => 'Jane Smith', 'price' => '$900'],
        ];

        return view('admin.auth.pending-list', compact('pending'));
    }

    Public function manageList() {
        $manage = [
            ['apartment_name' => 'Sunny Villa', 'address' => '123 Sunshine Ave', 'owner_name' => 'John Doe', 'price' => '$1200'],
            ['apartment_name' => 'Cozy Cottage', 'address' => '456 Winter Lane', 'owner_name' => 'Jane Smith', 'price' => '$900'],
        ];

        return view('admin.auth.manage-list', compact('manage'));
    }

    Public function userManagement() {
        $user = [
            ['username' => 'Sunny Villa', 'role' => 'landlord', 'registration_date' => '04-30-2024',],
            ['username' => 'Juan Dela Cruz', 'role' => 'landlord', 'registration_date' => '05-25-2024',],

        ];

        return view('admin.auth.user-management', compact('user'));
    }
}
