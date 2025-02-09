<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $apartments = Apartment::where('status', 'approved')->orderBy('created_at', 'desc')->get();
        return view('dashboard', compact('apartments'));
    }

    public function search(Request $request)
    {
        $searchQuery = $request->input('search');

        if (empty($searchQuery)) {
            $apartments = Apartment::where('status', 'approved')->orderBy('created_at', 'desc')->get();
        } else {

            $apartments = Apartment::where('apartment_name', 'like', '%' . $searchQuery . '%')
                ->orWhere('address', 'like', '%' . $searchQuery . '%')
                ->orWhere('landlord_name', 'like', '%' . $searchQuery . '%')
                ->get();
        }

        // Format the results for the frontend
        $formattedApartments = $apartments->map(function ($apartment) {
            return [
                'id' => $apartment->id,
                'apartment_name' => $apartment->apartment_name,
                'room_rate' => $apartment->room_rate,
                'rooms_available' => $apartment->rooms_available,
                'location' => $apartment->address,
                'landlord_name' => $apartment->landlord_name,
                'thumbnail' => $this->getThumbnail($apartment->apartment_images),
            ];
        });

        return response()->json($formattedApartments);
    }

    private function getThumbnail($images)
    {
        if (is_string($images)) {
            $imagesArray = json_decode($images, true);
            if (is_array($imagesArray) && count($imagesArray) > 0) {
                return asset('storage/images/apartments/' . $imagesArray[0]);
            }
        } elseif (is_array($images) && count($images) > 0) {
            return asset('storage/images/apartments/' . $images[0]);
        }
        return asset('storage/images/apartments/default.jpg');
    }
}

