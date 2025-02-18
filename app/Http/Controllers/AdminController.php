<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Site;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard.
     */
    public function dashboard(): View
    {
        $site = Site::where('domain', '')->first() ?? Site::first();
        
        if (!$site) {
            $site = Site::create([
                'domain' => '',
                'name' => 'Main Site',
                'is_main' => true
            ]);
        }
        
        session(['current_site' => $site]);
        
        return view('admin.dashboard', compact('site'));
    }
}
