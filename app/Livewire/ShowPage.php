<?php

namespace App\Livewire;

use App\Models\Page;
use App\Models\Site;
use App\Traits\WithTranslations;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;

class ShowPage extends Component
{
    use WithTranslations;

    public Page $page;
    public $title;
    public $content;
    public $site;
    public $locale;

    public function mount(Page $page)
    {
        $this->page = $page;
        $this->site = $page->site;
        $this->locale = session('locale', 'es');
        $this->title = $page->getTitle();
        $this->content = $page->getContent();
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
        $this->locale = session('locale', 'es');
        $this->title = $this->page->getTitle();
        $this->content = $this->page->getContent();
        $this->refreshTranslations();
    }

    public function getGalleryImages()
    {
        if (!$this->site) {
            return collect()->chunk(3);
        }
        
        $availableImages = collect(range(1, 9))
            ->filter(function($num) {
                return file_exists(public_path("sites/BEN/gallery/ben-{$num}.jpg"));
            })
            ->values();
        
        // Si no hay suficientes imágenes, repetimos las disponibles
        while ($availableImages->count() < 9) {
            $availableImages = $availableImages->merge($availableImages)->take(9);
        }
        
        return $availableImages->shuffle()->chunk(3);
    }

    public function render()
    {
        return view('livewire.show-page', [
            'title' => $this->title,
            'content' => $this->content,
            'site' => $this->site,
            'locale' => $this->locale
        ]);
    }
}
