<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class PersonController extends Controller
{
    public function index(Request $request, ?string $domain = null)
    {
        try {
            // El tipo viene de la ruta por defecto o de la URL
            $defaults = $request->route()->defaults;
            $type = $defaults['type'] ?? $this->getTypeFromUrl($request->path());

            if (!$type || !in_array($type, ['staff', 'cast', 'creative'])) {
                abort(404);
            }

            if ($domain) {
                $site = Site::where('domain', $domain)->firstOrFail();
            } else {
                $site = Site::where('domain', '')->firstOrFail();
            }
            
            $people = Person::where('site_id', $site->id)
                ->where('type', $type)
                ->where('is_active', true)
                ->orderBy('order')
                ->get();

            return view('person.index', [
                'site' => $site,
                'people' => $people,
                'type' => $type
            ]);

        } catch (\Exception $e) {
            Log::error('Error in PersonController@index', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    public function show(Request $request, $domain = null, $slug = null)
    {
        try {
            // Si el slug viene como primer parámetro, ajustamos los valores
            if ($domain && !$slug) {
                $slug = $domain;
                $domain = null;
            }

            // El tipo viene de la ruta por defecto o de la URL
            $defaults = $request->route()->defaults;
            $type = $defaults['type'] ?? $this->getTypeFromUrl($request->path());

            if (!$type || !in_array($type, ['staff', 'cast', 'creative'])) {
                abort(404);
            }

            if ($domain) {
                $site = Site::where('domain', $domain)->firstOrFail();
            } else {
                $site = Site::where('domain', '')->firstOrFail();
            }

            $person = Person::where('site_id', $site->id)
                ->where('type', $type)
                ->where('slug', $slug)
                ->where('is_active', true)
                ->firstOrFail();

            return view('person.show', [
                'person' => $person,
                'site' => $site,
                'type' => $type
            ]);

        } catch (\Exception $e) {
            Log::error('Error in PersonController@show', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    private function getTypeFromUrl(string $path): ?string
    {
        $segments = explode('/', trim($path, '/'));
        $typeMap = [
            'staff' => 'staff',
            'cast' => 'cast',
            'creative-team' => 'creative'
        ];

        foreach ($segments as $segment) {
            if (isset($typeMap[$segment])) {
                return $typeMap[$segment];
            }
        }

        return null;
    }
}
