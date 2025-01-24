<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && (auth()->user()->role_id === 1 || auth()->user()->role_id === 2)) {
            return $next($request); // Proceed to the next middleware or controller
        }
        // Deny access if the user is not an admin
        return redirect('/admin/dashboard')->with('error', 'Access denied. Admins only.');
    }
}
