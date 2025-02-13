<?php

namespace App\Livewire;

use Livewire\Component;

class ServicesSections extends Component
{
    public $sections = [];

    public function mount($content)
    {
        if (empty($content)) {
            return;
        }

        $locale = app()->getLocale();
        
        if (!isset($content[$locale]['sections'])) {
            return;
        }

        $this->sections = $content[$locale]['sections'];
    }

    public function render()
    {
        return view('livewire.services-sections', [
            'sections' => $this->sections
        ]);
    }
}
