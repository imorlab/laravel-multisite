<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Log;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_id',
        'title',
        'content',
        'excerpt',
        'slug',
        'published_at',
        'is_published'
    ];

    protected $casts = [
        'title' => 'json',
        'content' => 'json',
        'excerpt' => 'json',
        'is_published' => 'boolean',
        'published_at' => 'datetime'
    ];

    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }

    public function getTitle(): ?string
    {
        $locale = session('locale', 'es');
        $title = is_string($this->title) ? json_decode($this->title, true) : $this->title;
        Log::info('Getting news title', [
            'locale' => $locale,
            'session_locale' => session('locale'),
            'app_locale' => app()->getLocale(),
            'title' => $this->title
        ]);
        return is_array($title) ? ($title[$locale] ?? $title['es'] ?? '') : $title;
    }

    public function getContent(): ?string
    {
        $locale = session('locale', 'es');
        $content = is_string($this->content) ? json_decode($this->content, true) : $this->content;
        Log::info('Getting news content', [
            'locale' => $locale,
            'session_locale' => session('locale'),
            'app_locale' => app()->getLocale(),
            'content' => $this->content
        ]);
        return is_array($content) ? ($content[$locale] ?? $content['es'] ?? '') : $content;
    }

    public function getExcerpt(): ?string
    {
        $locale = session('locale', 'es');
        $excerpt = is_string($this->excerpt) ? json_decode($this->excerpt, true) : $this->excerpt;
        Log::info('Getting news excerpt', [
            'locale' => $locale,
            'session_locale' => session('locale'),
            'app_locale' => app()->getLocale(),
            'excerpt' => $this->excerpt
        ]);
        return is_array($excerpt) ? ($excerpt[$locale] ?? $excerpt['es'] ?? '') : $excerpt;
    }
}
