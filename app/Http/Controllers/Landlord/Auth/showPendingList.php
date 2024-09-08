<?php

namespace App\Http\Controllers\Landlord\Auth;

use App\Models\Apartment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ShowPendingList extends Controller
{
    public function showPendingList()
    {
        // Get the ID of the currently authenticated landlord
        $landlordId = Auth::id();

        // Fetch pending apartments for the logged-in landlord
        $pending = Apartment::where('landlord_id', $landlordId)
                    ->where('status', 'pending')
                    ->orderBy('created_at', 'desc') // Sort by created date in descending order
                    ->get();

        return view('landlord.auth.list-of-pending', compact('pending'));
    }

    // Function to handle deletion of an apartment
    public function deleteApartment($id)
    {
        // Find the apartment by ID
        $apartment = Apartment::find($id);

        // Check if the apartment exists and belongs to the logged-in landlord
        if ($apartment && $apartment->landlord_id === Auth::id() && $apartment->status === 'pending') {
            $apartment->delete();
            return redirect()->back()->with('success', 'Apartment deleted successfully.');
        }

        // If not found, not pending, or does not belong to the logged-in landlord
        return redirect()->back()->with('error', 'Apartment not found, not pending, or cannot be deleted.');
    }
}
