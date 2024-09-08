<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;

class addApartmentController extends Controller
{
    public function pendingList()
    {
        // Fetch apartments with status 'pending'
        $pending = Apartment::where('status', 'pending')->get();

        return view('admin.auth.pending-list', compact('pending'));
    }

    public function approveApartment($id)
    {
        $apartment = Apartment::findOrFail($id);
        $apartment->status = 'approved';
        $apartment->save();

        return redirect()->route('admin.pending_list')->with('success', 'Apartment approved successfully.');
    }

    public function rejectApartment($id)
    {
        $apartment = Apartment::findOrFail($id);
        $apartment->status = 'rejected';
        $apartment->save();

        return redirect()->route('admin.pending_list')->with('success', 'Apartment rejected successfully.');
    }
}
