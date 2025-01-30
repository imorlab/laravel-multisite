<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard(): View
    {
        $site = session('current_site');
        return view('admin.dashboard', compact('site'));
    }
}
