<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show(Request $request, $site, $slug)
    {
        $site = $request->attributes->get('site');
        $page = Page::where('site_id', $site->id)
                   ->where('slug', $slug)
                   ->where('is_published', true)
                   ->firstOrFail();

        return view('pages.show', compact('page', 'site'));
    }
}
