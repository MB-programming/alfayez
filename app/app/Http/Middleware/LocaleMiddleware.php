<?php

namespace App\Http\Middleware;

use Closure;

class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        $langSegment = \Request::segment(1);
//        $locale = NULL;
//        if(isset($langSegment) && in_array($langSegment, \Config::get('app.available_language')))
//        {
//            $locale = $langSegment;
//            \App::setLocale($locale);
//            config('app.locale',$locale);
//            view()->share("locale",$locale);
//        }
//        return $next($request);

        // Set the language
        if(in_array($request->segment(1), config('app.available_language')))
        {
            \Session::put('bintwar.language_locale', $request->segment(1));
            return Redirect::to(substr($request->path(), 3));
        }

        // Check if the session has the language
        if(!\Session::has('bintwar.language_locale')) {
            \Session::put('bintwar.language_locale', config('app.fallback_locale'));
        }

        view()->share("locale",\Session::get('bintwar.language_locale'));
        app()->setLocale(\Session::get('bintwar.language_locale'));
        \Carbon::setLocale(\Session::get('bintwar.language_locale'));
        return $next($request);
    }
}
