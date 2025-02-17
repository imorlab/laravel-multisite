<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class LocalizeRoutes
{
    protected $routeLocales = [
        'la-productora' => 'es',
        'the-producer' => 'en',
        'actualidad' => 'es',
        'news' => 'en'
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        Log::debug('LocalizeRoutes: Starting middleware', [
            'path' => $request->path(),
            'session_locale' => session()->get('locale'),
            'app_locale' => App::getLocale(),
            'translations_loaded' => app('translator')->getLoader()->loaded()
        ]);

        $path = $request->path();
        $firstSegment = explode('/', $path)[0];
        
        // Determinar el idioma basado en la URL
        if (isset($this->routeLocales[$firstSegment])) {
            $locale = $this->routeLocales[$firstSegment];
            session()->put('locale', $locale);
            App::setLocale($locale);
            
            Log::debug('LocalizeRoutes: Setting locale from URL', [
                'path' => $path,
                'firstSegment' => $firstSegment,
                'locale' => $locale,
                'translations_loaded' => app('translator')->getLoader()->loaded()
            ]);
        }
        // Si no hay idioma en la URL, intentar usar el de la sesión
        elseif (session()->has('locale')) {
            $locale = session()->get('locale');
            App::setLocale($locale);
            
            Log::debug('LocalizeRoutes: Setting locale from session', [
                'path' => $path,
                'locale' => $locale,
                'translations_loaded' => app('translator')->getLoader()->loaded()
            ]);
        }
        // Si no hay idioma en la sesión, usar el predeterminado
        else {
            $locale = config('app.locale', 'es');
            session()->put('locale', $locale);
            App::setLocale($locale);
            
            Log::debug('LocalizeRoutes: Setting default locale', [
                'path' => $path,
                'locale' => $locale,
                'translations_loaded' => app('translator')->getLoader()->loaded()
            ]);
        }

        // Forzar la recarga de traducciones al cambiar de idioma
        if ($request->session()->get('_previous_locale') !== $locale) {
            app('translator')->setLoaded([]);
            $request->session()->put('_previous_locale', $locale);
            
            Log::debug('LocalizeRoutes: Clearing translation cache', [
                'previous_locale' => $request->session()->get('_previous_locale'),
                'new_locale' => $locale,
                'translations_loaded' => app('translator')->getLoader()->loaded()
            ]);
        }

        $response = $next($request);

        Log::debug('LocalizeRoutes: After response', [
            'path' => $path,
            'locale' => App::getLocale(),
            'translations_loaded' => app('translator')->getLoader()->loaded()
        ]);

        return $response;
    }
}
