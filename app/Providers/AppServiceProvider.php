<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Limpiar caché de traducciones al iniciar la aplicación
        Cache::forget('translations');
        
        // Asegurarse de que el locale por defecto esté configurado
        $locale = session('locale', config('app.locale', 'es'));
        App::setLocale($locale);
        
        // Forzar la recarga de traducciones
        app('translator')->setLoaded([]);
    }
}
