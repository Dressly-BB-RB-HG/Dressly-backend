<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{

    
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || !(Auth::user()->role !== 3)) {
            return response()->json(['message' => 'Jogosulatlan hozzáférés'], 403);
        }
        return $next($request);
    }
}
