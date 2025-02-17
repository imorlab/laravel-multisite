<?php

namespace App\Livewire;

use Livewire\Component;
use App\Traits\WithTranslations;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;

class ServicesSections extends Component
{
    use WithTranslations;

    public $sections = [];

    public function mount()
    {
        $this->mountWithTranslations();
        $this->loadSections();
    }

    public function getTranslationKeys(): array
    {
        return [
            'title' => 'welcome.title',
            'sections' => 'welcome.sections'
        ];
    }

    #[On('language-changed')]
    public function onLanguageChanged()
    {
        $this->refreshTranslations();
        $this->loadSections();
    }

    protected function loadSections()
    {
        $this->sections = __('welcome.sections');
        
        Log::debug('ServicesSections: Sections loaded', [
            'sections' => $this->sections,
            'locale' => app()->getLocale()
        ]);
    }

    public function render()
    {
        return view('livewire.services-sections', [
            'sections' => $this->sections
        ]);
    }
}
