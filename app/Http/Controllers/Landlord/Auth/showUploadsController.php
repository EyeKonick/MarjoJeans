<?php

namespace App\Http\Controllers\Landlord\Auth;

use App\Models\Apartment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ShowUploadsController extends Controller
{
    public function uploadList()
    {
        $statusFilter = request('status');


        $uploads = Apartment::where('landlord_id', Auth::id())
            ->when($statusFilter, function ($query, $statusFilter) {
                $query->where('status', $statusFilter);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('landlord.auth.list-of-uploads', compact('uploads'));
    }






    public function deleteApartment($id)
    {
        $apartment = Apartment::find($id);

        if ($apartment && $apartment->landlord_id === Auth::id()) {
            if (in_array($apartment->status, ['approved', 'rejected'])) {
                $apartment->delete();
                return redirect()->back()->with('success', 'Apartment deleted successfully.');
            }
            return redirect()->back()->with('error', 'Only approved or rejected apartments can be deleted.');
        }

        return redirect()->back()->with('error', 'Apartment not found or unauthorized access.');
    }
}
