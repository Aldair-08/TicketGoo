<?php

namespace App\Actions\Auth;

use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;
use App\Providers\RouteServiceProvider;

class RegisteredUserResponse implements RegisterResponseContract
{
    public function toResponse($request)
    {
        return redirect(RouteServiceProvider::HOME);
    }
} 