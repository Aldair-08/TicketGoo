<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Actions\Auth\LoginResponse;
use App\Actions\Auth\RegisteredUserResponse;
use Carbon\Carbon;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(LoginResponseContract::class, LoginResponse::class);
        $this->app->singleton(RegisterResponseContract::class, RegisteredUserResponse::class);
    }

    public function boot(): void
    {
        Carbon::setLocale('es');
    }
}
