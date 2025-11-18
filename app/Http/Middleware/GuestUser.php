<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GuestUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next)
    {
        // Jika user sudah login
        if (auth()->check()) {
            // Kalau role admin → redirect ke panel admin
            if (auth()->user()->role === 'admin') {
                return redirect('/admin');
            }

            // Kalau user biasa → redirect ke halaman user
            return redirect('/');
        }

        return $next($request);
    }
}
