<?php

namespace Habib\Dashboard\Http\Controllers;

class HomeController extends Controller{

    public function __construct(){
        $this->middleware('auth:'.config('dashboard.guard_name','admin'));
    }

    public function home(){

        return view('dashboard::dashboard');
    }
}
