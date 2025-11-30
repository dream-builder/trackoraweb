<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        // 1) check route parameter {locale}
        $locale = $request->route('locale');

        // 2) or check session
        if (! $locale && session()->has('locale')) {
            $locale = session('locale');
        }

        // 3) or headers / fallback
        if (! $locale) {
            $locale = $request->getPreferredLanguage(config('locales.supported', ['en']));
        }

        // sanitize / validate
        $supported = config('locales.supported', ['en']);
        if (! in_array($locale, $supported)) {
            $locale = config('locales.default', 'en');
        }

        app()->setLocale($locale);

        return $next($request);
    }
}
