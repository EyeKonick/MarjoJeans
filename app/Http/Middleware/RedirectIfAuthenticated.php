<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
           if (Auth::guard($guard)->check()) {

            if ($guard === 'admin' && Route::is('admin.*')) {
                return redirect()->route('admin.dashboard');
            }
            elseif ($guard === 'landlord' && Route::is('landlord.*')) {
                return redirect()->route('landlord.dashboard');
            }
            else {
                return redirect()->route('dashboard');
            }

           }
        }

        return $next($request);
    }

}
