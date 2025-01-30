<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Site;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $site = Site::where('is_main', true)->firstOrFail();
        $page = Page::where('site_id', $site->id)
                   ->where('slug', 'home-' . $site->id)
                   ->firstOrFail();

        return view('welcome', compact('site', 'page'));
    }
}
