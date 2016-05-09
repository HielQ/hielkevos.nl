<?php

namespace App\Http\Middleware;

use Closure;

class Locale
{
    /**
     * @param $request
     * @param Closure $next
     * @param null $guard
     * @return mixed
     */
    public function handle($request, Closure $next , $guard = null)
    {
        //session('locale') ?: 'en';
        app()->setLocale(session()->has('locale') ? session('locale'): 'en');

        return $next($request);
    }
}
