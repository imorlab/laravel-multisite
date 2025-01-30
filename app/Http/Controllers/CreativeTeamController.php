<?php

namespace App\Http\Controllers;

use App\Models\CreativeTeam;
use Illuminate\Http\Request;

class CreativeTeamController extends Controller
{
    public function index(Request $request)
    {
        $site = $request->attributes->get('site');
        $creativeTeam = CreativeTeam::where('site_id', $site->id)
                                  ->where('is_active', true)
                                  ->orderBy('order')
                                  ->get();

        return view('creative-team.index', compact('creativeTeam', 'site'));
    }
}
