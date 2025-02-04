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
            'our_shows' => 'content.our_shows',
            'view_more' => 'content.view_more',
            'no_shows' => 'content.no_shows',
        ];
    }

    #[On('language-changed')]
    public function onLanguageChanged()
    {
        Log::info('Language changed in ShowsList');
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
