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
        // Validate request data
        $validated = $request->validate([
            'landlord_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'contact_no' => 'required|string|max:20',
            'facebook' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'apartment_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'rooms_available' => 'required|integer',
            'room_rate' => 'required|numeric',
            'apartment_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('apartment_image')) {
            $file = $request->file('apartment_image');
            $filename = time() . '.' . $file->getClientOriginalExtension();

            $file->storeAs('public/images/apartments', $filename);

            $validated['apartment_image'] = $filename;
        }

        $validated['landlord_id'] = Auth::id();


        Apartment::create($validated);

        return redirect()->back()->with('success', 'Apartment added successfully and is pending approval.');
    }
}
