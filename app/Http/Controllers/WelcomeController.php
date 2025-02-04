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
            if ($domain) {
                $site = Site::where('domain', $domain)->firstOrFail();
            } else {
                $site = Site::where('domain', '')->firstOrFail();
            }

            $page = Page::where('site_id', $site->id)
                       ->where('slug', 'home')
                       ->firstOrFail();

            return view('welcome', [
                'site' => $site,
                'page' => $page,
            ]);
        } catch (\Exception $e) {
            Log::error('Error en WelcomeController@index', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }
}
