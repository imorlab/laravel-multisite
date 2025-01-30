<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Site;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request, $domain = null)
    {
        if ($domain) {
            $site = Site::where('domain', $domain)->firstOrFail();
        } else {
            $site = Site::where('is_main', true)->firstOrFail();
        }

        $news = News::where('site_id', $site->id)
                   ->where('is_published', true)
                   ->orderBy('published_at', 'desc')
                   ->paginate(10);

        return view('news.index', compact('site', 'news'));
    }

    public function show(Request $request, $domain = null, $slug = null)
    {
        // Si no se proporciona el slug, significa que estamos en la ruta principal
        if (!$slug) {
            $slug = $domain;
            $site = Site::where('is_main', true)->firstOrFail();
        } else {
            $site = Site::where('domain', $domain)->firstOrFail();
        }

        $news = News::where('site_id', $site->id)
                   ->where('slug', $slug)
                   ->where('is_published', true)
                   ->firstOrFail();

        return view('news.show', compact('site', 'news'));
    }
}
