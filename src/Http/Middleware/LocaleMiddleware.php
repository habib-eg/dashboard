<?php

namespace Habib\Dashboard\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\URL;

class LocaleMiddleware
{
    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $locale=str_replace('_', '-', session('locale',request('locale',config('app.locale'))));
        app()->setLocale($locale);
        config()->set('seo-manager.locale',$locale);
        config()->set('app.rtl',(bool)$locale==='ar');

//        $localeName = config('dashboard.route_lang_parameter', 'locale');
//        if (request()->route() && request()->route()->hasParameter($localeName)) {
//            URL::defaults([$localeName => $locale]);
//            request()->route()->forgetParameter($localeName);
//        }

        return $next($request);
    }
}
