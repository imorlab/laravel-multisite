<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;

class LanguageSwitcher extends Component
{
    public $currentLocale;

    public function mount()
    {
        $this->currentLocale = session('locale', config('app.locale', 'es'));
    }

    public function switchLanguage($locale)
    {
        if (!in_array($locale, ['es', 'en'])) {
            return;
        }

        session()->put('locale', $locale);
        App::setLocale($locale);
        $this->currentLocale = $locale;

        // Forzar la recarga de traducciones
        app('translator')->setLoaded([]);
        Cache::forget('translations');
        Artisan::call('cache:clear');

        $this->dispatch('language-changed');
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
