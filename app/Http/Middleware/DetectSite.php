<?php

namespace App\Http\Middleware;

use App\Models\Site;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class DetectSite
{
    public function handle(Request $request, Closure $next): Response
    {
        // Si es la ruta principal, buscar el sitio principal
        if (!$request->segment(1)) {
            $site = Site::where('is_main', true)->first();
            Log::info('Main site search', ['site' => $site]);
            if (!$site) {
                abort(404, 'No se encontró el sitio principal');
            }
            $request->attributes->set('site', $site);
            return $next($request);
        }

        // Para otros sitios, buscar por el segmento de la URL
        $domain = $request->segment(1);
        
        if ($domain) {
            $site = Site::where('domain', $domain)->first();
            Log::info('Domain site search', ['domain' => $domain, 'site' => $site]);
            if (!$site) {
                abort(404, 'Sitio no encontrado');
            }
            $request->attributes->set('site', $site);
            return $next($request);
        }

        abort(404, 'Sitio no encontrado');
    }
}
