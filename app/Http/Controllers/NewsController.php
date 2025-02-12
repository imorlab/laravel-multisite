<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;

class NewsController extends Controller
{
    public function index(Request $request, $domain = null)
    {
        try {
            $locale = session('locale', config('app.locale', 'es'));
            App::setLocale($locale);
            
            // Forzar la recarga de traducciones
            app('translator')->setLoaded([]);
            Cache::forget('translations');

            if ($domain) {
                $site = Site::where('domain', $domain)->firstOrFail();
            } else {
                $site = Site::where('domain', '')->firstOrFail();
            }

            $news = News::where('site_id', $site->id)
                       ->where('is_published', true)
                       ->orderBy('published_at', 'desc')
                       ->paginate(10);

            return view('news.index', compact('site', 'news'));
        } catch (\Exception $e) {
            Log::error('Error in NewsController@index', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    public function show(Request $request, $domain = null, $slug = null)
    {
        // Si el slug viene como primer parámetro, ajustamos los valores
        if ($domain && !$slug) {
            $slug = $domain;
            $domain = null;
        }

        try {
            $locale = session('locale', config('app.locale', 'es'));
            App::setLocale($locale);
            
            // Forzar la recarga de traducciones
            app('translator')->setLoaded([]);
            Cache::forget('translations');

            if ($domain) {
                $site = Site::where('domain', $domain)->firstOrFail();
            } else {
                $site = Site::where('domain', '')->firstOrFail();
            }

            $news = News::where('site_id', $site->id)
                       ->where('slug', $slug)
                       ->where('is_published', true)
                       ->firstOrFail();

            // Obtener noticias relacionadas (excluyendo la actual)
            $relatedNews = News::where('site_id', $site->id)
                             ->where('is_published', true)
                             ->where('id', '!=', $news->id)
                             ->latest('published_at')
                             ->take(3)
                             ->get();

            // Obtener noticia anterior
            $previousNews = News::where('site_id', $site->id)
                              ->where('is_published', true)
                              ->where('published_at', '<', $news->published_at)
                              ->orderBy('published_at', 'desc')
                              ->first();

            // Obtener noticia siguiente
            $nextNews = News::where('site_id', $site->id)
                          ->where('is_published', true)
                          ->where('published_at', '>', $news->published_at)
                          ->orderBy('published_at', 'asc')
                          ->first();

            return view('news.show', compact('site', 'news', 'relatedNews', 'previousNews', 'nextNews'));
        } catch (\Exception $e) {
            Log::error('Error in NewsController@show', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }
}
