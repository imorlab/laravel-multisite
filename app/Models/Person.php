<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Support\Facades\Log;

class Person extends Model
{
    protected $table = 'people';

    protected $fillable = [
        'site_id',
        'page_id',
        'type',
        'name',
        'slug',
        'role',
        'character_name',
        'bio',
        'photo',
        'social_media',
        'order',
        'is_active'
    ];

    protected $casts = [
        'name' => 'json',
        'role' => 'json',
        'character_name' => 'json',
        'bio' => 'json',
        'social_media' => AsArrayObject::class,
        'is_active' => 'boolean',
        'order' => 'integer',
        'type' => 'string'
    ];

    // Relationships
    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }

    public function scopeForPage($query, $pageId)
    {
        return $query->where('page_id', $pageId);
    }

    // Getters
    public function getName(): string
    {
        $locale = session('locale', 'es');
        $name = is_string($this->name) ? json_decode($this->name, true) : $this->name;
        Log::info('Getting person name', [
            'locale' => $locale,
            'name' => $this->name
        ]);
        return is_array($name) ? ($name[$locale] ?? $name['es'] ?? '') : $name;
    }

    public function getRole(): ?string
    {
        $locale = session('locale', 'es');
        $role = is_string($this->role) ? json_decode($this->role, true) : $this->role;
        Log::info('Getting person role', [
            'locale' => $locale,
            'role' => $this->role
        ]);
        return is_array($role) ? ($role[$locale] ?? $role['es'] ?? '') : $role;
    }

    public function getCharacterName(): ?string
    {
        $locale = session('locale', 'es');
        $characterName = is_string($this->character_name) ? json_decode($this->character_name, true) : $this->character_name;
        Log::info('Getting person character name', [
            'locale' => $locale,
            'character_name' => $this->character_name
        ]);
        return is_array($characterName) ? ($characterName[$locale] ?? $characterName['es'] ?? '') : $characterName;
    }

    public function getBio(): ?string
    {
        $locale = session('locale', 'es');
        $bio = is_string($this->bio) ? json_decode($this->bio, true) : $this->bio;
        Log::info('Getting person bio', [
            'locale' => $locale,
            'bio' => $this->bio
        ]);
        return is_array($bio) ? ($bio[$locale] ?? $bio['es'] ?? '') : $bio;
    }
}
