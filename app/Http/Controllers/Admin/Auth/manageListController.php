<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\Apartment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class manageListController extends Controller
{
    public function manageList()
    {
        $manage = Apartment::where('status', 'approved')->orderby('created_at', 'desc')->paginate(10);

        return view('admin.auth.manage-list', compact('manage'));
    }

    public function editApartment($id)
    {
        $apartment = Apartment::findOrFail($id);
        return view('admin.auth.update-apartment', compact('apartment'));
    }

    public function updateApartment(Request $request, $id)
    {
    $request->validate([
        'landlord_name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'contact_no' => 'required|string|max:15',
        'facebook' => 'nullable|string|max:255',
        'email' => 'required|email|max:255',
        'apartment_name' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'rooms_available' => 'required|integer|min:1',
        'room_rate' => 'required|numeric|min:0',
        'apartment_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'description' => 'nullable|string',
    ]);

    $apartment = Apartment::findOrFail($id);

    $apartment->update($request->except(['apartment_image']));

    if ($request->hasFile('apartment_image')) {
        $imageName = time() . '.' . $request->apartment_image->extension();
        $request->apartment_image->storeAs('images/apartments', $imageName, 'public');

        if ($apartment->apartment_image) {
            Storage::disk('public')->delete('images/apartments/' . $apartment->apartment_image);
        }
        
        $apartment->apartment_image = $imageName;
        $apartment->save();
    }

    return redirect()->route('admin.manage_list')->with('success', 'Apartment updated successfully.');
    }

    public function deleteApartment($id)
    {
        $apartment = Apartment::findOrFail($id);
        $apartment->delete();

        return redirect()->route('admin.manage_list')->with('success', 'Apartment deleted successfully.');
    }
}
