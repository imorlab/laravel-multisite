<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index(Request $request)
    {
        $site = $request->attributes->get('site');
        $staff = Staff::where('site_id', $site->id)
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('staff.index', compact('staff', 'site'));
    }

    public function show(Request $request, $slug)
    {
        $site = $request->attributes->get('site');
        $staff = Staff::where('site_id', $site->id)
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('staff.show', compact('staff', 'site'));
    }
}
