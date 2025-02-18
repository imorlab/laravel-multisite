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
        ]
    ];

    public function mount()
    {
        $this->currentLocale = session('locale', config('app.locale', 'es'));
        $this->currentRouteName = Route::current()?->getName() ?? 'site.home';
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
        
        if ($this->currentRouteName === 'site.home') {
            session()->reflash();
            return redirect('/');
        }
        
        if (isset($this->routeMappings[$this->currentRouteName][$locale])) {
            $newPath = $this->routeMappings[$this->currentRouteName][$locale];
            Log::info('Redirecting to new path', ['newPath' => $newPath]);
            session()->reflash();
            return redirect()->to($newPath);
        }
        
        session()->reflash();
        return redirect()->to(Request::path());
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
