<?php

namespace App\Livewire;

use App\Models\Page;
use App\Traits\WithTranslations;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;

class ShowPage extends Component
{
    use WithTranslations;

    public Page $page;

    public function mount(Page $page)
    {
        $this->page = $page;
        $this->mountWithTranslations();
    }

    public function getTranslationKeys(): array
    {
        return [
            'back' => 'content.back',
            'loading' => 'content.loading',
        ];
    }

    #[On('language-changed')]
    public function onLanguageChanged()
    {
        Log::info('Language changed event received in ShowPage');
        $this->refreshTranslations();
    }

    public function render()
    {
        $title = $this->page->getTitle();
        $content = $this->page->getContent();
        
        Log::info('Rendering page content', [
            'locale' => session('locale'),
            'title' => $title,
            'content' => $content
        ]);

        return view('livewire.show-page', [
            'title' => $title,
            'content' => $content
        ]);
    }
}
