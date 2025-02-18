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
    public $locales = [
        'es' => 'Español',
        'en' => 'English'
    ];
    
    protected $routeLocales = [
        'la-productora' => 'es',
        'the-producer' => 'en',
        'actualidad' => 'es',
        'news' => 'en'
    ];

    protected $routeMappings = [
        'site.home' => [
            'es' => '/',
            'en' => '/'
        ],
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
        ],
        'site.actualidad.show' => [
            'es' => '/actualidad/{slug}',
            'en' => '/news/{slug}'
        ],
        'site.news.show' => [
            'es' => '/actualidad/{slug}',
            'en' => '/news/{slug}'
        ]
    ];

    public function mount()
    {
        $this->currentLocale = session('locale', config('app.locale', 'es'));
        $this->currentRouteName = Route::current()?->getName() ?? 'site.home';
    }

    public function switchLanguage($locale)
    {
        if (!array_key_exists($locale, $this->locales)) {
            return;
        }

        $this->currentLocale = $locale;
        session(['locale' => $locale]);
        App::setLocale($locale);

        // Obtener los parámetros de la ruta actual
        $currentRoute = Route::current();
        $parameters = $currentRoute?->parameters() ?? [];
        
        // Si tenemos un mapeo para la ruta actual
        if (isset($this->routeMappings[$this->currentRouteName][$locale])) {
            $newPath = $this->routeMappings[$this->currentRouteName][$locale];
            
            // Reemplazar los parámetros en la URL
            foreach ($parameters as $key => $value) {
                $newPath = str_replace("{{$key}}", $value, $newPath);
            }

            // Asegurarnos de que la URL comienza con /
            $newPath = '/' . ltrim($newPath, '/');

            // Si es una ruta con dominio, mantener el dominio
            if (isset($parameters['domain'])) {
                $newPath = '/' . $parameters['domain'] . $newPath;
            }
            
            $this->dispatch('language-changed');
            return redirect($newPath);
        }

        // Si no hay mapeo, simplemente recarga la página
        $this->dispatch('language-changed');
        return redirect(Request::url());
    }

    public function render()
    {
        return view('livewire.language-switcher');
    }
}
