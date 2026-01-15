<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to continue');
        }

        if (auth()->user()->role !== 'user') {
            abort(403, 'Unauthorized access. This area is for customers only.');
        }

        return $next($request);
    }
}
