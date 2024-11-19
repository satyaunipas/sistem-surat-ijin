<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Cek apakah pengguna terautentikasi dan memiliki peran yang sesuai
        if (!Auth::check() || Auth::user()->role !== $role) {
            // Jika tidak, kembalikan 403 Unauthorized
            abort(403, 'This action is unauthorized.');
        }
        return $next($request);
    }
}
