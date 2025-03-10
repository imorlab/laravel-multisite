<?php

namespace App\Livewire;

use App\Models\Site;
use App\Traits\WithTranslations;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Log;

class ShowsList extends Component
{
    use WithTranslations;

    public $shows = [];

    public function mount()
    {
        $this->loadShows();
        $this->mountWithTranslations();
    }

    public function getTranslationKeys(): array
    {
        return [
            'show_producer' => 'content.show_producer',
            'description' => 'content.description',
            'view_more' => 'content.view_more',
            'no_shows' => 'content.no_shows',
            'current_shows' => 'content.current_shows',
            'past_shows' => 'content.past_shows',
        ];
    }

    #[On('language-changed')]
    public function onLanguageChanged()
    {
        $this->refreshTranslations();
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
