<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Redirige al usuario no autenticado al login correcto según el guard.
     */
    protected function redirectTo($request)
    {
        // Aquí detectamos si la ruta empieza con 'admin', para redirigir al login admin
        if ($request->expectsJson()) {
            return null; // Para peticiones AJAX o API no redirige
        }

        if ($request->is('admin') || $request->is('admin/*')) {
            return route('admin.login'); // Ruta del login admin
        }

        // Default: login normal
        return route('login');
    }
}
