<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\Person;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

class ProducerController extends Controller
{
    public function index()
    {
        $site = Site::first();
        
        // Obtener el staff
        $staff = Person::query()
                      ->when(Schema::hasColumn('people', 'type'), function($query) {
                          $query->where('type', 'staff');
                      })
                      ->when(Schema::hasColumn('people', 'active'), function($query) {
                          $query->where('active', true);
                      })
                      ->when(Schema::hasColumn('people', 'order'), function($query) {
                          $query->orderBy('order');
                      })
                      ->get()
                      ->map(function ($person) {
                          return [
                              'name' => $person->name,
                              'role' => $person->role,
                              'photo' => $person->photo,
                              'slug' => $person->slug,
                          ];
                      });
        
        // Asegurarnos de que las traducciones estén cargadas
        app('translator')->setLoaded([]);
        
        // Establecer el idioma actual
        $locale = session('locale', config('app.locale', 'es'));
        App::setLocale($locale);
        
        return view('pages.la-productora', compact('site', 'staff'));
    }
}
