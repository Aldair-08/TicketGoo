<?php

namespace App\Actions\Auth;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use App\Providers\RouteServiceProvider;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        return redirect()->intended(RouteServiceProvider::HOME);
    }
} 