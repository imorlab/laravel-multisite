<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
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
        'slug' => 'json',
        'is_published' => 'boolean',
        'published_at' => 'datetime'
    ];

    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }

    public function getTitle(): string
    {
        $locale = session('locale', 'es');
        $title = is_string($this->title) ? json_decode($this->title, true) : $this->title;
        return $title[$locale] ?? $title['en'] ?? $title['es'] ?? '';
    }

    public function getContent(): ?string
    {
        $locale = session('locale', 'es');
        $content = is_string($this->content) ? json_decode($this->content, true) : $this->content;
        
        return is_array($content) ? ($content[$locale] ?? $content['es'] ?? '') : $content;
    }

    public function getExcerpt(): ?string
    {
        $locale = session('locale', 'es');
        $excerpt = is_string($this->excerpt) ? json_decode($this->excerpt, true) : $this->excerpt;
        
        return is_array($excerpt) ? ($excerpt[$locale] ?? $excerpt['es'] ?? '') : $excerpt;
    }

    /**
     * Get the slug for the current locale
     */
    public function getSlug()
    {
        Log::info('Getting slug for news', [
            'id' => $this->id,
            'raw_slug' => $this->slug,
            'locale' => app()->getLocale()
        ]);

        $slugs = is_array($this->slug) ? $this->slug : json_decode($this->slug, true);
        
        if (!is_array($slugs)) {
            Log::error('Invalid slug format in News model', [
                'id' => $this->id,
                'slug' => $this->slug,
                'decoded' => $slugs
            ]);
            return '';
        }
        
        $locale = app()->getLocale();
        
        // Si no existe el slug en el idioma actual, usar el español como fallback
        $slug = $slugs[$locale] ?? $slugs['es'] ?? '';
        
        if (empty($slug)) {
            Log::error('Empty slug in News model', [
                'id' => $this->id,
                'locale' => $locale,
                'slugs' => $slugs
            ]);
        }
        
        Log::info('Returning slug', [
            'id' => $this->id,
            'slug' => $slug,
            'locale' => $locale
        ]);
        
        return $slug;
    }

    /**
     * Get the raw slug JSON
     */
    public function getRawSlug()
    {
        return $this->slug;
    }

    public function scopePublished(Builder $query)
    {
        return $query->where('is_published', true)
                    ->where(function ($query) {
                        $query->whereNull('published_at')
                              ->orWhere('published_at', '<=', now());
                    });
    }

    public function scopeScheduled(Builder $query)
    {
        return $query->where('is_published', true)
                    ->where('published_at', '>', now());
    }

    public function getPublicationStatus(): string
    {
        if (!$this->is_published) {
            return 'draft';
        }
        
        if ($this->published_at && $this->published_at->isFuture()) {
            return 'scheduled';
        }
        
        return 'published';
    }
}
