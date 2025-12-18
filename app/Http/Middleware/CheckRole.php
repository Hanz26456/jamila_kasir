<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }

        $user = Auth::user();
        
        if (!in_array($user->role, $roles)) {
            return redirect()->route('home')->with('error', 'Akses ditolak. Anda tidak memiliki permission');
        }

        return $next($request);
    }
}