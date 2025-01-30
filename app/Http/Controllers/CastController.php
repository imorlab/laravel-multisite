<?php

namespace App\Http\Controllers;

use App\Models\Cast;
use Illuminate\Http\Request;

class CastController extends Controller
{
    public function index(Request $request)
    {
        $site = $request->attributes->get('site');
        $cast = Cast::where('site_id', $site->id)
                   ->where('is_active', true)
                   ->orderBy('order')
                   ->get();

        return view('cast.index', compact('cast', 'site'));
    }
}
