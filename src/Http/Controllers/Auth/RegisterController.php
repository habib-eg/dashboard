<?php

namespace Habib\Dashboard\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Models\user;
use Habib\Dashboard\Providers\DashboardServiceProvider;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * @var array
     */
    public $rules=[
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ];

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest:admin');
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data,$this->rules ?? [] );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $data['password']=Hash::make($data['password']);

        return User::create($data);
    }
    public function showRegistrationForm()
    {
        return view('dashboard::auth.register');
    }

    /**
     * @return Guard|StatefulGuard
     */
    protected function guard()
    {
        return auth()->guard(config('dashboard.guard_name','admin'));
    }
}
