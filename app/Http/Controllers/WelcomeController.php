<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WelcomeController extends Controller
{
    public function index(Request $request, $domain = null)
    {
        try {
            // Encontrar el sitio
            if ($domain) {
                $site = Site::where('domain', $domain)->firstOrFail();
            } else {
                $site = Site::where('domain', '')->firstOrFail();
            }

            // Encontrar la página principal
            $page = Page::where('site_id', $site->id)
                       ->where('slug', 'home')
                       ->firstOrFail();

            // Procesar el contenido de la página
            if (is_string($page->content)) {
                $page->content = json_decode($page->content, true);
            }

            return view('welcome', [
                'site' => $site,
                'page' => $page,
            ]);
        } catch (\Exception $e) {
            Log::error('Error en WelcomeController@index', [
                'error' => $e->getMessage(),
                'domain' => $domain
            ]);
            abort(404);
        }
    }
}
