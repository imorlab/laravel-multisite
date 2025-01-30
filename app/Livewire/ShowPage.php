<?php

namespace App\Livewire;

use App\Models\Page;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;

class ShowPage extends Component
{
    public Page $page;
    public $title;
    public $content;

    public function mount(Page $page)
    {
        $this->page = $page;
        $this->refreshContent();
    }

    public function refreshContent()
    {
        $locale = session('locale', 'es');
        
        $title = is_string($this->page->title) ? json_decode($this->page->title, true) : $this->page->title;
        $content = is_string($this->page->content) ? json_decode($this->page->content, true) : $this->page->content;

        Log::info('Refreshing page content', [
            'locale' => $locale,
            'title' => $title,
            'content' => $content
        ]);

        $this->title = is_array($title) ? ($title[$locale] ?? $title['es'] ?? '') : $title;
        $this->content = is_array($content) ? ($content[$locale] ?? $content['es'] ?? '') : $content;
    }

    #[On('language-changed')]
    public function onLanguageChanged()
    {
        Log::info('Language changed event received');
        $this->refreshContent();
    }

    public function render()
    {
        return view('livewire.show-page');
    }
}
