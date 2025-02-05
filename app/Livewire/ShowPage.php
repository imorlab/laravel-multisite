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
        $this->refreshTranslations();
    }

    public function getGalleryImages()
    {
        $site = $this->page->site;
        
        $availableImages = collect(range(1, 9))
            ->filter(function($num) use ($site) {
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
        $title = $this->page->getTitle();
        $content = $this->page->getContent();
        $site = $this->page->site;

        return view('livewire.show-page', [
            'title' => $title,
            'content' => $content,
            'site' => $site
        ]);
    }
}
