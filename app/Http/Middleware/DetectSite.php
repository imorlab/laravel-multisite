<?php

namespace App\Http\Middleware;

use App\Models\Site;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class DetectSite
{
    protected $ignoredSlugs = [
        'la-productora',
        'the-producer',
        'actualidad',
        'news'
    ];

    public function handle(Request $request, Closure $next)
    {
        try {
            // Obtener el primer segmento de la URL
            $domain = $request->segment(1);

            Log::info('DetectSite middleware', [
                'domain' => $domain,
                'segments' => $request->segments()
            ]);

            // Si el segmento es uno de nuestros slugs localizados, lo ignoramos
            if (in_array($domain, $this->ignoredSlugs)) {
                $site = Site::where('domain', '')->firstOrFail();
            }
            // Si no hay dominio o es una ruta de administración, asumimos el sitio principal
            else if (!$domain || $domain === 'admin') {
                $site = Site::where('domain', '')->firstOrFail();
            } else {
                $site = Site::where('domain', $domain)->firstOrFail();
            }

            Log::info('Site detected', [
                'site_id' => $site->id,
                'domain' => $site->domain
            ]);

            // Compartir el sitio con todas las vistas
            View::share('site', $site);

            return $next($request);

        } catch (\Exception $e) {
            Log::error('Error in DetectSite middleware', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }
}
