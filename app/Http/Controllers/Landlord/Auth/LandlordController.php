<?php

namespace App\Http\Controllers\Landlord\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LandlordController extends Controller
{
    public function addApartment()
    {
        return view('landlord.auth.add-apartment');
    }

    public function listUploads()
    {
        // Fetch uploaded apartments from the database
        // For now, we'll use a placeholder array
        $uploads = [
            ['apartment_name' => 'Sunny Villa', 'address' => '123 Sunshine Ave', 'price' => '$1200'],
            ['apartment_name' => 'Cozy Cottage', 'address' => '456 Winter Lane', 'price' => '$900'],
        ];

        return view('landlord.auth.list-of-uploads', compact('uploads'));
    }

    public function listPending()
    {
        // Fetch pending apartments from the database
        // For now, we'll use a placeholder array
        $pending = [
            ['apartment_name' => 'Sunny Villa', 'address' => '123 Sunshine Ave', 'price' => '$1200', 'status' => 'Pending'],
            ['apartment_name' => 'Cozy Cottage', 'address' => '456 Winter Lane', 'price' => '$900', 'status' => 'Pending'],
        ];

        return view('landlord.auth.list-of-pending', compact('pending'));
    }

    public function updateApartment()
    {
        return view('landlord.auth.update-apartment');
    }


}
