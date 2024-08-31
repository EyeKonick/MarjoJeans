<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // URLs to repeat
        $imageUrls = [
            'https://plus.unsplash.com/premium_photo-1684175656320-5c3f701c082c?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            'https://images.unsplash.com/photo-1531835551805-16d864c8d311?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            'https://images.unsplash.com/photo-1515263487990-61b07816b324?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            'https://plus.unsplash.com/premium_photo-1684175656288-c9685f3d2266?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
        ];

        // Sample apartment data with URLs repeating
        $apartments = array_map(function ($index) use ($imageUrls) {
            return (object)[
                'id' => $index + 1,
                'name' => 'Apartment ' . ($index + 1),
                'price' => '₱' . (10000 + ($index * 1000)),
                'rooms' => 3 + ($index % 3),
                'location' => 'Location ' . ($index + 1),
                'landlord_name' => 'Landlord ' . ($index + 1),
                'latitude' => 11.5 + ($index * 0.01),
                'longitude' => 122.5 + ($index * 0.01),
                'image_url' => $imageUrls[$index % count($imageUrls)],
            ];
        }, range(0, 14));

        return view('dashboard', compact('apartments'));
    }
}
