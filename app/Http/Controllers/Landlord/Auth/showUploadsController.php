<?php

namespace App\Http\Controllers\Landlord\Auth;

use App\Models\Apartment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class showUploadsController extends Controller
{
    public function uploadList()
    {
        // Fetch apartments that belong to the authenticated landlord
        $uploads = Apartment::where('landlord_id', Auth::id())
                            ->whereIn('status', ['approved', 'rejected'])
                            ->get();

        return view('landlord.auth.list-of-uploads', compact('uploads'));
    }
}
