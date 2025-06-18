<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Fortify::loginView(function () {
            return view('auth.login');  // o la vista que uses para login
        });

        Fortify::authenticateUsing(function ($request) {
            // tu lógica si tienes personalizada
        });

        // Define la ruta a donde redirigir luego de login
        Fortify::redirects('login', config('fortify.home', '/dashboard'));
    }

    public function register()
    {
        //
    }
}
