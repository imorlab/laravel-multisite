<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class NewsController extends Controller
{
    protected $routeLocales = [
        'actualidad' => 'es',
        'news' => 'en'
    ];

    protected function setLocaleFromPath(Request $request)
    {
        $path = $request->path();
        $firstSegment = explode('/', $path)[0];

        if (isset($this->routeLocales[$firstSegment])) {
            $locale = $this->routeLocales[$firstSegment];
            session()->put('locale', $locale);
            App::setLocale($locale);
            
            Log::debug('NewsController: Setting locale', [
                'path' => $path,
                'firstSegment' => $firstSegment,
                'locale' => $locale,
                'translations' => __('news')
            ]);

            // Forzar la recarga de traducciones
            app('translator')->setLoaded([]);
            Cache::forget('translations');
        }
    }

    public function index(Request $request, $domain = null)
    {
        $this->setLocaleFromPath($request);

        try {
            $locale = session('locale', config('app.locale', 'es'));
            App::setLocale($locale);

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

        $this->setLocaleFromPath($request);

        try {
            $locale = session('locale', config('app.locale', 'es'));
            App::setLocale($locale);

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
