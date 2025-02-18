<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\App;
use App\Models\News;
use App\Models\Site;

class LanguageSwitcher extends Component
{
    public $currentLocale;
    public $currentRouteName;
    public $currentSlug;
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
        $this->currentLocale = app()->getLocale();
        $this->currentRouteName = Route::current()?->getName();
        $this->currentSlug = Route::current()?->parameter('slug');
    }

    public function switchLanguage($locale)
    {
        if (!array_key_exists($locale, $this->locales)) {
            return;
        }

        // Manejar específicamente las rutas de noticias
        if (in_array($this->currentRouteName, ['site.actualidad.show', 'site.news.show']) && $this->currentSlug) {
            // Encontrar la noticia actual usando el idioma actual
            $news = News::where('site_id', Site::where('domain', request('domain', ''))->first()?->id ?? 1)
                ->where('is_published', true)
                ->get()
                ->filter(function($news) {
                    $slugs = is_string($news->slug) ? json_decode($news->slug, true) : $news->slug;
                    // Buscar el slug en el idioma actual
                    return in_array($this->currentSlug, $slugs);
                })
                ->first();

            if ($news) {
                // Obtener el slug en el nuevo idioma
                $slugs = json_decode($news->slug, true);
                $newSlug = $slugs[$locale] ?? $slugs['es'] ?? null;

                if ($newSlug) {
                    // Determinar la nueva ruta basada en el idioma
                    $newRouteName = $locale === 'es' ? 'site.actualidad.show' : 'site.news.show';

                    $this->currentLocale = $locale;
                    session(['locale' => $locale]);
                    App::setLocale($locale);
                    
                    $this->dispatch('language-changed');
                    return redirect()->route($newRouteName, ['slug' => $newSlug]);
                }
            }
        }

        // Si llegamos aquí, manejamos el cambio de idioma normal
        $this->currentLocale = $locale;
        session(['locale' => $locale]);
        App::setLocale($locale);
        
        // Si tenemos un mapeo para la ruta actual
        if (isset($this->routeMappings[$this->currentRouteName][$locale])) {
            $newPath = $this->routeMappings[$this->currentRouteName][$locale];

            if ($this->currentSlug) {
                $newPath = str_replace('{slug}', $this->currentSlug, $newPath);
            }

            // Asegurarnos de que la URL comienza con /
            $newPath = '/' . ltrim($newPath, '/');

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
