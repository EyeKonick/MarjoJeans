<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
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
                Auth::shouldUse($guard);
                return $next($request);
            }
         }
         #handel aunthenticated
         $this->unauthenticated($guards);

    }

    /**
     * Functiom to handle authenticated request
     * @param array $guards
     */

    protected function unauthenticated(array $guards) {
        throw new AuthenticationException(
            'Unauthenticated', $guards, $this->redirectTo()
        );
    }

    protected Function redirectTo() {

        # for admin
        if (Route::is('admin.*')) {
            return route('admin.login');
        }

        # for landlord
        if (Route::is('landlord.*')) {
            return route('landlord.login');
        }

        # for user
        return route('login');
    }
}
