<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Log;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_id',
        'title',
        'content',
        'slug',
        'is_homepage',
    ];

    protected $casts = [
        'title' => 'json',
        'content' => 'json',
        'is_homepage' => 'boolean',
    ];

    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }

    public function getTitle(): ?string
    {
        $locale = session('locale', 'es');
        $title = is_string($this->title) ? json_decode($this->title, true) : $this->title;

        return is_array($title) ? ($title[$locale] ?? $title['es'] ?? '') : $title;
    }

    public function getContent()
    {
        $locale = session('locale', 'es');
        $content = is_string($this->content) ? json_decode($this->content, true) : $this->content;

        return $content;
    }
}
