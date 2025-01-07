<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // For rendering the dashboard
    public function index()
    {
        $apartments = Apartment::where('status', 'approved')->orderBy('created_at', 'desc')->get();
        return view('dashboard', compact('apartments'));
    }

    // For handling AJAX search requests
    public function search(Request $request)
    {
        $search = $request->input('search');

        $apartments = Apartment::where('status', 'approved')
            ->where(function ($query) use ($search) {
                $query->where('apartment_name', 'like', '%' . $search . '%')
                      ->orWhere('location', 'like', '%' . $search . '%')
                      ->orWhere('landlord_name', 'like', '%' . $search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->get();

        // Format the data for JSON response
        $apartments = $apartments->map(function ($apartment) {
            $images = json_decode($apartment->apartment_images, true) ?? [];
            return [
                'id' => $apartment->id,
                'apartment_name' => $apartment->apartment_name,
                'room_rate' => $apartment->room_rate,
                'rooms_available' => $apartment->rooms_available,
                'location' => $apartment->location,
                'landlord_name' => $apartment->landlord_name,
                'thumbnail' => count($images) > 0 ? asset('storage/images/apartments/' . $images[0]) : asset('storage/images/default-thumbnail.jpg'),
            ];
        });

        return response()->json($apartments);
    }

}
