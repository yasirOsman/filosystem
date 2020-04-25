<?php

namespace App\Http\Middleware;

use Closure;
class Isadmin
{
    public function handle($request, Closure $next)
    {
        if (\Auth::user()->role) {
            return $next($request);
        }

        return redirect()->route('home'); // If user is not an admin.
    }
}