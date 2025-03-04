<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Ensure user is logged in
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Ensure user is Super Admin
        if (Auth::user()->role !== 'superadmin') {
            Auth::logout(); // Logout non-superadmin users
            return redirect()->route('login')->with('error', 'Access denied.');
        }

        return $next($request);
    }
}
