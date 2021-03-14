<?php

namespace Habib\Dashboard\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Habib\Dashboard\Providers\DashboardServiceProvider;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = DashboardServiceProvider::HOME;

    /**
     * @return Guard|StatefulGuard
     */
    /**
     * Get the guard to be used during password reset.
     *
     * @return StatefulGuard
     */
    protected function guard()
    {
        return auth()->guard(config('dashboard.guard_name','admin'));
    }
}
