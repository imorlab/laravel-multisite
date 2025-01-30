<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class LanguageSwitcher extends Component
{
    public $currentLocale;

    public function mount()
    {
        $this->currentLocale = session('locale', 'es');
    }

    public function switchLanguage($locale)
    {
        if (!in_array($locale, ['es', 'en'])) {
            return;
        }

        Log::info('Switching language', [
            'from' => session('locale'),
            'to' => $locale
        ]);

        $this->currentLocale = $locale;
        session(['locale' => $locale]);
        App::setLocale($locale);

        $this->dispatch('language-changed');
    }

    public function render()
    {
        return view('livewire.language-switcher');
    }
}
