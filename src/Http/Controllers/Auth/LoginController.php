<?php

namespace Habib\Dashboard\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Habib\Dashboard\Providers\DashboardServiceProvider;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

/**
 * Class LoginController
 * @package Habib\Dashboard\Http\Controllers\Auth
 */
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = DashboardServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    /**
     * @return Factory|View
     */
    public function showLoginForm(){
        return view('dashboard::auth.login');
    }
    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return array_merge($request->only($this->username(), 'password'),['is_admin'=>true]);
    }

    /**
     * @return Guard|StatefulGuard
     */
    protected function guard()
    {
        return auth()->guard(config('dashboard.guard_name','admin'));
    }
}
