<?php

namespace App\Http\Controllers\Landlord\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LandlordLoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('landlord.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LandlordLoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->route('landlord.dashboard');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('landlord')->logout();

        // $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('landlord.login');
    }
}
