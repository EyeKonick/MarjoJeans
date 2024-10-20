<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // For rendering the dashboard
    public function index()
    {
        $apartments = Apartment::where('status', 'approved')->orderBy('created_at', 'desc')->get();
        return view('dashboard', compact('apartments'));
    }

    // For handling AJAX search requests
    public function search(Request $request)
    {
        $search = $request->input('search');
        $apartments = Apartment::where('status', 'approved')
            ->where(function ($query) use ($search) {
                $query->where('apartment_name', 'like', '%' . $search . '%')
                    ->orWhere('location', 'like', '%' . $search . '%')
                    ->orWhere('landlord_name', 'like', '%' . $search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($apartments);
    }
}
