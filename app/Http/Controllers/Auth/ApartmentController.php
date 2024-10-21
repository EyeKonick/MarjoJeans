<?php

namespace App\Http\Controllers\Auth;

use App\Models\Apartment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApartmentController extends Controller
{
    public function show($id)
    {
        $apartment = Apartment::findOrFail($id);
        return view('apartmentShow', compact('apartment'));
    }
}
