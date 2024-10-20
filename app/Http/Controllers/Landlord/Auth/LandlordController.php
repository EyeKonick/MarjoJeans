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
        $apartment = Apartment::findOrFail($id);
        // Pass the redirect query parameter to the view
        $redirect = $request->input('redirect', 'list_uploads'); // Default to 'list_uploads' if no redirect is provided

        return view('landlord.auth.update-apartment', compact('apartment', 'redirect'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request
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
            'thumbnail_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'display_image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'display_image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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

        // Check for uploaded images
        if ($request->hasFile('thumbnail_image')) {
            // Delete old thumbnail image
            if ($apartment->thumbnail_image) {
                Storage::delete('public/images/apartments/' . $apartment->thumbnail_image);
            }
            // Store new thumbnail image
            $thumbnailImage = $request->file('thumbnail_image');
            $thumbnailPath = $thumbnailImage->store('public/images/apartments');
            $apartment->thumbnail_image = basename($thumbnailPath);
        }

        if ($request->hasFile('display_image_1')) {
            // Delete old display image 1
            if ($apartment->display_image_1) {
                Storage::delete('public/images/apartments/' . $apartment->display_image_1);
            }
            // Store new display image 1
            $displayImage1 = $request->file('display_image_1');
            $displayPath1 = $displayImage1->store('public/images/apartments');
            $apartment->display_image_1 = basename($displayPath1);
        }

        if ($request->hasFile('display_image_2')) {
            // Delete old display image 2
            if ($apartment->display_image_2) {
                Storage::delete('public/images/apartments/' . $apartment->display_image_2);
            }
            // Store new display image 2
            $displayImage2 = $request->file('display_image_2');
            $displayPath2 = $displayImage2->store('public/images/apartments');
            $apartment->display_image_2 = basename($displayPath2);
        }

        // Save the apartment
        $apartment->save();

        // Redirect to the appropriate page
        $redirectRoute = $request->input('redirect', 'list_uploads'); // Default to 'list_uploads' if no redirect is provided
        return redirect()->route("landlord.$redirectRoute")->with('success', 'Apartment updated successfully.');
    }


}
