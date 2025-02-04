<?php

namespace App\Livewire;

use App\Models\News;
use App\Models\Site;
use App\Traits\WithTranslations;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Log;

class NewsList extends Component
{
    use WithTranslations;

    public $news;
    public Site $site;

    public function mount(Site $site)
    {
        $this->site = $site;
        $this->loadNews();
        $this->mountWithTranslations();
    }

    public function getTranslationKeys(): array
    {
        return [
            'latest_news' => 'content.latest_news',
            'read_more' => 'content.read_more',
            'published_on' => 'content.published_on',
            'no_news' => 'content.no_news',
        ];
    }

    #[On('language-changed')]
    public function loadNews()
    {
        $this->news = News::where('site_id', $this->site->id)
            ->where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();
            
        // Recargar traducciones cuando cambia el idioma
        $this->refreshTranslations();
    }

    public function render()
    {
        return view('livewire.news-list');
    }
}
