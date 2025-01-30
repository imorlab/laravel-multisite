<?php

namespace App\Livewire;

use App\Models\Site;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Log;

class ShowsList extends Component
{
    public $shows = [];
    public $translations = [];

    public function mount()
    {
        $this->loadShows();
        $this->loadTranslations();
    }

    public function loadTranslations()
    {
        $this->translations = [
            'our_shows' => __('Nuestros Shows'),
            'view_more' => __('Ver más'),
        ];
    }

    #[On('language-changed')]
    public function onLanguageChanged()
    {
        Log::info('Language changed in ShowsList');
        $this->loadTranslations();
        $this->dispatch('$refresh');
    }

    public function loadShows()
    {
        $this->shows = Site::where('is_main', false)
            ->where('is_active', true)
            ->get();
    }

    public function render()
    {
        return view('livewire.shows-list');
    }
}
