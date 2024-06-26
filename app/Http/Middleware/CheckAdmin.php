<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            return redirect('/');
        }

        return $next($request);
    }
}