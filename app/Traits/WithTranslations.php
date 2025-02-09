<?php

namespace App\Traits;

use Livewire\Attributes\On;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

trait WithTranslations
{
    public $translations = [];

    public function mountWithTranslations()
    {
        $this->loadTranslations();
    }

    abstract public function getTranslationKeys(): array;

    public function loadTranslations()
    {
        // Forzar la recarga de traducciones
        app('translator')->setLoaded([]);
        Cache::forget('translations');
        
        $locale = session('locale', config('app.locale', 'es'));
        App::setLocale($locale);
        
        $translations = [];
        foreach ($this->getTranslationKeys() as $key => $path) {
            $translations[$key] = trans($path);
        }
        
        $this->translations = $translations;
    }

    #[On('language-changed')]
    public function refreshTranslations()
    {
        $this->loadTranslations();
        $this->dispatch('$refresh');
    }
}
