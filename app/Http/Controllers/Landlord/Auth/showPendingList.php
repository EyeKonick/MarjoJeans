<?php

namespace App\Http\Controllers\Landlord\Auth;

use App\Models\Apartment;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ShowPendingList extends Controller
{
    public function showPendingList()
    {
        $landlordId = Auth::id();

        $pending = Apartment::where('landlord_id', $landlordId)
                            ->where('status', 'pending')
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('landlord.auth.list-of-pending', compact('pending'));
    }

    public function deleteApartment($id)
    {
        $apartment = Apartment::find($id);

        if ($apartment && $apartment->landlord_id === Auth::id()) {
            // Allow deletion for approved or rejected apartments
            if (in_array($apartment->status, ['approved', 'rejected'])) {
                $apartment->delete();
                return redirect()->back()->with('success', 'Apartment deleted successfully.');
            }
            return redirect()->back()->with('error', 'Only approved or rejected apartments can be deleted.');
        }

        return redirect()->back()->with('error', 'Apartment not found or unauthorized access.');
    }


    public function editApartment($id)
    {
        // Assuming edit functionality is required for pending or approved apartments
        $apartment = Apartment::where('id', $id)
                            ->where('landlord_id', Auth::id())
                            ->first();

        if ($apartment) {
            return view('landlord.auth.edit-apartment', compact('apartment'));
        }

        return redirect()->back()->with('error', 'Apartment not found.');
    }
}
