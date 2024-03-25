<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseFortify;

class LoginResponseService implements LoginResponseFortify
{

    public function toResponse($request)
    {
        if (Auth::check()) {
            if (Auth::user()->is_admin) {
                return redirect()->route('admin.dashboard');
            }
        }

        return redirect()->intended();
    }
}
