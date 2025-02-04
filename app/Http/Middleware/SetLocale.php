<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        $locale = session('locale', config('app.locale', 'es'));
        
        // Forzar la recarga de traducciones
        app('translator')->setLoaded([]);
        Cache::forget('translations');
        
        App::setLocale($locale);
        
        return $next($request);
    }
}
