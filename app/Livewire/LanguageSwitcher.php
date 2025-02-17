<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\App;

class LanguageSwitcher extends Component
{
    public $currentLocale;
    public $currentRouteName;
    
    protected $routeLocales = [
        'la-productora' => 'es',
        'the-producer' => 'en',
        'actualidad' => 'es',
        'news' => 'en'
    ];

    protected $routeMappings = [
        'site.la-productora' => [
            'es' => '/la-productora',
            'en' => '/the-producer'
        ],
        'site.the-producer' => [
            'es' => '/la-productora',
            'en' => '/the-producer'
        ],
        'site.actualidad' => [
            'es' => '/actualidad',
            'en' => '/news'
        ],
        'site.news' => [
            'es' => '/actualidad',
            'en' => '/news'
        ]
    ];

    public function mount()
    {
        $path = Request::path();
        $firstSegment = explode('/', $path)[0];
        
        $this->currentLocale = isset($this->routeLocales[$firstSegment]) 
            ? $this->routeLocales[$firstSegment] 
            : config('app.locale', 'es');
            
        // Guardamos el nombre de la ruta actual
        $this->currentRouteName = Route::current()->getName();
            
        Log::info('LanguageSwitcher mounted', [
            'path' => $path,
            'firstSegment' => $firstSegment,
            'currentLocale' => $this->currentLocale,
            'currentRouteName' => $this->currentRouteName
        ]);
    }

    public function switchLanguage($locale)
    {
        Log::info('Switching language', [
            'requested_locale' => $locale,
            'saved_route' => $this->currentRouteName,
            'current_path' => Request::path()
        ]);

        if (!in_array($locale, ['es', 'en'])) {
            Log::warning('Invalid locale requested', ['locale' => $locale]);
            return;
        }

        // Establecer el nuevo idioma
        session()->put('locale', $locale);
        App::setLocale($locale);
        
        Log::info('Route info', [
            'currentRoute' => $this->currentRouteName,
            'hasMapping' => isset($this->routeMappings[$this->currentRouteName]),
            'mappings' => $this->routeMappings
        ]);
        
        // Emitir el evento de cambio de idioma antes de redirigir
        $this->dispatch('language-changed');
        
        // Si tenemos un mapeo para la ruta actual
        if (isset($this->routeMappings[$this->currentRouteName])) {
            $newPath = $this->routeMappings[$this->currentRouteName][$locale];
            Log::info('Redirecting to new path', ['newPath' => $newPath]);
            return $this->redirect($newPath, navigate: true);
        }
        
        // Si no tenemos un mapeo, solo recargamos la página
        return $this->redirect(Request::path(), navigate: true);
    }

    public function render()
    {
        return view('livewire.language-switcher', [
            'locales' => [
                'es' => 'Español',
                'en' => 'English'
            ]
        ]);
    }
}
