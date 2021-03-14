<?php

namespace Habib\Dashboard\Providers;

use Habib\Dashboard\Http\Middleware\LocaleMiddleware;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use RealRashid\SweetAlert\ToSweetAlert;
use Illuminate\Contracts\Http\Kernel;

/**
 * Class DashboardServiceProvider
 * @package Habib\Dashboard\Providers
 */
class DashboardServiceProvider extends ServiceProvider
{

    const  HOME = '/dashboard';


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $package_path = dirname(__DIR__);
        $this->mergeConfigFrom($package_path . '/config/dashboard.php', 'dashboard');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $package_path = dirname(__DIR__);

        // publish config
        $this->publishes([
            $package_path . '/config/dashboard.php' => config_path('dashboard.php'),
        ], 'config');

        // publish config
        $this->publishes([
            $package_path . '/config/uuid.php' => config_path('uuid.php'),
        ], 'config');

        //publish views
        $this->publishes([
            $package_path . '/resources/views' => resource_path('views/vendor/dashboard'),
        ], 'views');

        //publish assets
        $this->publishes([
            $package_path . '/resources/assets' => public_path('vendor/dashboard'),
        ], 'assets');

        $kernel = $this->app->make(Kernel::class);
        $kernel->pushMiddleware(config('dashboard.localeMiddleware',LocaleMiddleware::class));

        $this->loadTranslationsFrom($package_path . '/resources/lang', 'dashboard');
        $this->loadViewsFrom($package_path . '/resources/views', 'dashboard');

    }
}
