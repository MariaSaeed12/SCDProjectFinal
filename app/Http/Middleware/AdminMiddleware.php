<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated and is an admin
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request); // Proceed if the user is an admin
        }

        // If not an admin, redirect to home or an error page
        return redirect('/home')->with('error', 'You do not have admin access.');
    }
}
