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

        Log::info('Switching language in Livewire component', [
            'from' => session('locale'),
            'to' => $locale,
            'current_app_locale' => App::getLocale()
        ]);

        session()->put('locale', $locale);
        App::setLocale($locale);
        $this->currentLocale = $locale;

        // Forzar la recarga de traducciones
        app('translator')->setLoaded([]);
        Cache::forget('translations');
        Artisan::call('cache:clear');

        Log::info('Language switched', [
            'new_session_locale' => session('locale'),
            'new_app_locale' => App::getLocale(),
            'translations' => trans('content')
        ]);

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
