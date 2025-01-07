<?php

namespace App\Http\Controllers\Landlord\Auth;

use App\Models\Apartment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Auth;

class AddApartmentController extends Controller
{
    public function store(Request $request)
    {

        $validated = $request->validate([
            'landlord_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'contact_no' => 'required|string|max:20',
            'facebook' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'apartment_name' => 'required|string|max:255',
            'latitude' => 'required|string|max:255',
            'longitude' => 'required|string|max:255',
            'rooms_available' => 'required|integer',
            'room_rate' => 'required|numeric',
            'apartment_images' => 'required|array|min:1',
            'apartment_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);

        $imagePaths = [];
        if ($request->hasFile('apartment_images')) {
            foreach ($request->file('apartment_images') as $file) {
                $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $uniqueFileName = $filename . '_' . time() . '.' . $extension;
                $file->storeAs('public/images/apartments', $uniqueFileName);
                $imagePaths[] = $uniqueFileName;
            }
        }

        $validated['apartment_images'] = json_encode($imagePaths);
        $validated['landlord_id'] = Auth::id();


        Apartment::create($validated);

        return redirect()->back()->with('success', 'Apartment added successfully and is pending approval.');
    }


}
