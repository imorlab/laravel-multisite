<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SiteController extends Controller
{

    public function index(): View
    {
        $sites = Site::all();
        return view('sites.index', compact('sites'));
    }

    public function create(): View
    {
        return view('sites.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'slug' => 'required|unique:sites|max:255',
            'name' => 'required|max:255',
            'theme' => 'required|max:255',
        ]);

        Site::create($validated);

        return redirect()->route('sites.index')
            ->with('success', 'Site created successfully.');
    }

    public function edit(Site $site): View
    {
        return view('sites.edit', compact('site'));
    }

    public function update(Request $request, Site $site): RedirectResponse
    {
        $validated = $request->validate([
            'slug' => 'required|unique:sites,slug,' . $site->id . '|max:255',
            'name' => 'required|max:255',
            'theme' => 'required|max:255',
        ]);

        $site->update($validated);

        return redirect()->route('sites.index')
            ->with('success', 'Site updated successfully.');
    }

    public function destroy(Site $site): RedirectResponse
    {
        $site->delete();

        return redirect()->route('sites.index')
            ->with('success', 'Site deleted successfully.');
    }
}
