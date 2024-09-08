<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Apartment; // Make sure to import the Apartment model
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Fetch only approved apartments
        $apartments = Apartment::where('status', 'approved')->orderBy('created_at', 'desc')->get();

        return view('dashboard', compact('apartments'));
    }
}
