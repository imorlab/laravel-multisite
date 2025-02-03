<?php

namespace App\Http\Middleware;

use App\Models\Site;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SiteMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $domain = $request->route('domain');

        // Si no hay dominio o es un tipo de persona (staff, cast, creative-team)
        if (!$domain || in_array($domain, ['staff', 'cast', 'creative-team'])) {
            return $next($request);
        }

        // Verificar si el sitio existe
        $site = Site::where('domain', $domain)->first();
        if (!$site) {
            abort(404);
        }

        return $next($request);
    }
}
