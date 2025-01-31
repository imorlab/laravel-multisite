<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StaffController extends Controller
{
    public function index(Request $request, $domain = null)
    {
        if ($domain) {
            $site = Site::where('domain', $domain)->firstOrFail();
        } else {
            $site = Site::where('domain', '')->firstOrFail();
        }

        $staff = Staff::where('site_id', $site->id)
                     ->where('is_active', true)
                     ->orderBy('order')
                     ->paginate(10);

        return view('staff.index', compact('site', 'staff'));
    }

    public function show(Request $request, $domain = null, $slug = null)
    {
        // Si el slug viene como primer parámetro, ajustamos los valores
        if ($domain && !$slug) {
            $slug = $domain;
            $domain = null;
        }

        try {
            if ($domain) {
                $site = Site::where('domain', $domain)->firstOrFail();
            } else {
                $site = Site::where('domain', '')->firstOrFail();
            }

            $staff = Staff::where('site_id', $site->id)
                         ->where('slug', $slug)
                         ->where('is_active', true)
                         ->firstOrFail();

            return view('staff.show', compact('site', 'staff'));
        } catch (\Exception $e) {
            Log::error('Error in StaffController@show', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }
}
