<?php

namespace App\Http\Controllers\Landlord\Auth;

use App\Models\Apartment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class LandlordController extends Controller
{
    public function addApartment()
    {
        return view('landlord.auth.add-apartment');
    }

    public function edit(Request $request, $id)
    {
        // Retrieve the apartment by ID
        $apartment = Apartment::findOrFail($id);

        // Pass the apartment to the view
        return view('landlord.auth.update-apartment', compact('apartment'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'landlord_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'contact_no' => 'required|string|max:20',
            'facebook' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'apartment_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'rooms_available' => 'required|integer|min:1',
            'room_rate' => 'required|numeric|min:0',
            'apartment_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);

        $apartment = Apartment::findOrFail($id);
        $apartment->landlord_name = $request->input('landlord_name');
        $apartment->address = $request->input('address');
        $apartment->contact_no = $request->input('contact_no');
        $apartment->facebook = $request->input('facebook');
        $apartment->email = $request->input('email');
        $apartment->apartment_name = $request->input('apartment_name');
        $apartment->location = $request->input('location');
        $apartment->rooms_available = $request->input('rooms_available');
        $apartment->room_rate = $request->input('room_rate');
        $apartment->description = $request->input('description');

        // Handle file upload
        if ($request->hasFile('apartment_image')) {
            if ($apartment->apartment_image) {
                Storage::delete('public/images/apartments/' . $apartment->apartment_image);
            }

            $image = $request->file('apartment_image');
            $imagePath = $image->store('public/images/apartments');
            $apartment->apartment_image = basename($imagePath);
        }

        $apartment->save();

        return redirect()->route('landlord.list_pending')->with('success', 'Apartment updated successfully.');
    }
}
