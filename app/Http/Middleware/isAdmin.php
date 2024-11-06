<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isAdmin
{
    public function handle($request, Closure $next)
    {
        // Assuming you have a 'role' attribute to determine admin status
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Redirect or show a forbidden message if the user is not an admin
        return redirect('/home')->with('error', 'Access denied.');
    }
}
