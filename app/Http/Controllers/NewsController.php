<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NewsController extends Controller
{
    public function index(Request $request, $domain = null)
    {
        try {
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

        Log::info('NewsController@show', [
            'domain' => $domain,
            'slug' => $slug,
            'segments' => $request->segments()
        ]);

        try {
            if ($domain) {
                $site = Site::where('domain', $domain)->firstOrFail();
            } else {
                $site = Site::where('domain', '')->firstOrFail();
            }

            Log::info('Site found', [
                'site_id' => $site->id,
                'domain' => $site->domain
            ]);

            $news = News::where('site_id', $site->id)
                       ->where('slug', $slug)
                       ->where('is_published', true)
                       ->firstOrFail();

            Log::info('News found', [
                'news_id' => $news->id,
                'slug' => $news->slug,
                'site_id' => $site->id
            ]);

            return view('news.show', compact('site', 'news'));

        } catch (\Exception $e) {
            Log::error('Error in NewsController@show', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }
}
