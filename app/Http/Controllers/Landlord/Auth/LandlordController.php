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
        $redirect = $request->input('redirect', 'list_uploads'); // Default to 'list_uploads' if no redirect is provided

        return view('landlord.auth.update-apartment', compact('apartment', 'redirect'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request
        $validated = $request->validate([
            'landlord_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'contact_no' => 'required|string|max:20',
            'facebook' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'apartment_name' => 'required|string|max:255',
            'rooms_available' => 'required|integer|min:1',
            'room_rate' => 'required|numeric|min:0',
            'apartment_images' => 'nullable|array',
            'apartment_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'deleted_images' => 'nullable|string', // For removing existing images
        ]);

        $apartment = Apartment::findOrFail($id);

        // Update basic fields
        $apartment->fill([
            'landlord_name' => $validated['landlord_name'],
            'address' => $validated['address'],
            'contact_no' => $validated['contact_no'],
            'facebook' => $validated['facebook'],
            'email' => $validated['email'],
            'apartment_name' => $validated['apartment_name'],
            'rooms_available' => $validated['rooms_available'],
            'room_rate' => $validated['room_rate'],
            'description' => $validated['description'],
        ]);

        // Handle image removal
        $existingImages = json_decode($apartment->apartment_images, true) ?? [];
        if ($request->has('deleted_images') && !empty($request->deleted_images)) {
            $deletedImages = explode(',', $request->deleted_images);
            foreach ($deletedImages as $deletedImage) {
                if (($key = array_search($deletedImage, $existingImages)) !== false) {
                    // Delete the image from storage
                    Storage::delete("public/images/apartments/$deletedImage");

                    // Remove the image from the array
                    unset($existingImages[$key]);
                }
            }
        }

        // Handle new image uploads
        if ($request->hasFile('apartment_images')) {
            foreach ($request->file('apartment_images') as $file) {
                $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $uniqueFileName = $filename . '_' . time() . '.' . $extension;
                $file->storeAs('public/images/apartments', $uniqueFileName);
                $existingImages[] = $uniqueFileName;
            }
        }

        // Update the images field in the database
        $apartment->apartment_images = json_encode(array_values($existingImages));

        // Save the updated apartment
        $apartment->save();

        return redirect()->route('landlord.list_uploads')->with('success', 'Apartment updated successfully.');
    }

    public function deleteImage(Request $request)
    {
        $request->validate([
            'image_name' => 'required|string',
        ]);

        $apartment = Apartment::where('apartment_images', 'like', '%' . $request->image_name . '%')->first();

        if ($apartment) {
            $existingImages = json_decode($apartment->apartment_images, true) ?? [];
            if (($key = array_search($request->image_name, $existingImages)) !== false) {
                Storage::delete("public/images/apartments/{$request->image_name}");
                unset($existingImages[$key]);
                $apartment->apartment_images = json_encode(array_values($existingImages));
                $apartment->save();

                return response()->json(['success' => true], 200);
            }
        }

        return response()->json(['success' => false], 404);
    }
}
