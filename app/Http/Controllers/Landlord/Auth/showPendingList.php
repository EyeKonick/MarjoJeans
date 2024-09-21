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

        if ($apartment && $apartment->landlord_id === Auth::id() && $apartment->status === 'pending') {
            $apartment->delete();
            return redirect()->back()->with('success', 'Apartment deleted successfully.');
        }

        return redirect()->back()->with('error', 'Apartment not found, not pending, or cannot be deleted.');
    }
}
