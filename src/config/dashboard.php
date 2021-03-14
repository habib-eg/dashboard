<?php


use App\Models\User;

return [
    'dashboard_url'=>'dashboard',
    'name'=>config('app.name','Dashboard'),
    'contact_model'=>Habib\Dashboard\Models\Contact::class,
    'user_model'=> User::class,
    'route_lang_parameter'=>'locale',
    'guard_name'=>'admin',
];
