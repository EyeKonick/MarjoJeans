<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Apartment; 
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {

        $apartments = Apartment::where('status', 'approved')->orderBy('created_at', 'desc')->get();

        return view('dashboard', compact('apartments'));
    }
}
