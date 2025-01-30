<?php

namespace App\Livewire;

use App\Models\News;
use App\Models\Site;
use Livewire\Component;
use Livewire\Attributes\On;

class NewsList extends Component
{
    public $news;
    public Site $site;

    public function mount(Site $site)
    {
        $this->site = $site;
        $this->loadNews();
    }

    #[On('language-changed')]
    public function loadNews()
    {
        $this->news = News::where('site_id', $this->site->id)
            ->where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();
    }

    public function render()
    {
        return view('livewire.news-list');
    }
}
