<?php

namespace Habib\Dashboard\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class DashboardController
 * @package Habib\Dashboard\Http\Controllers
 */
class DashboardController extends Controller
{
    /**
     * DashboardController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:' . config('dashboard.guard_name', 'admin'))->except('switchLocale');
    }

    /**
     * @return Factory|View
     */
    public function home()
    {

        return view('dashboard::dashboard');
    }

    /**
     * @return Factory|View
     */
    public function profile()
    {
        return view('dashboard::profile');
    }

    /**
     * @return Factory|View
     */
    public function contacts()
    {
        $contacts = config('dashboard.contact_model')::latest()->paginate();

        return view('dashboard::contacts', compact('contacts'));
    }

    /**
     * @param Request $request
     * @param $user
     * @return mixed
     */
    public function update_profile(Request $request, $user)
    {
        $class = config('dashboard.user_model');

        $user = (new $class)->resolveRouteBinding($user, (new $class)->getRouteKeyName());

        $user = $user->name ? $user : auth()->user();

        $user->update($user->validation(null, true));

        return back()->withSuccess('Updated');
    }

    /**
     * @param string|null $locale
     * @return mixed
     */
    public function switchLocale(string $locale = null)
    {

        $locale = $locale ?? config('app.locale', 'en');

        session()->put('locale', $locale);

        return back()->withSuccess(' locale : ' . $locale);
    }
}
