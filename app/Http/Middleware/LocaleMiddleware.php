<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class LocaleMiddleware
{
    public function handle($request, Closure $next)
    {
        $locale = $request->segment(1); // get first segment from URL

        if (in_array($locale, ['en', 'bn', 'ar'])) {
            App::setLocale($locale);
            session(['locale' => $locale]);
        } 
        else if (session()->has('locale')) {
            App::setLocale(session('locale'));
        }

        return $next($request);
    }
}
