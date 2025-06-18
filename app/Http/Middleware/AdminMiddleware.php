<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        // Verificar si el usuario tiene rol de admin
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}