<?php

namespace App\Traits;

use Livewire\Attributes\On;

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
        $translations = [];
        foreach ($this->getTranslationKeys() as $key => $path) {
            $translations[$key] = __($path);
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
