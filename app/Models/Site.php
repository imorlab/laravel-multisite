<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Log;

class Site extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'domain',
        'is_main',
        'is_active',
        'description',
    ];

    protected $casts = [
        'name' => 'json',
        'is_main' => 'boolean',
        'is_active' => 'boolean',
        'description' => 'json',
    ];

    public function pages(): HasMany
    {
        return $this->hasMany(Page::class);
    }

    public function news(): HasMany
    {
        return $this->hasMany(News::class);
    }

    public function getName(): ?string
    {
        $locale = session('locale', 'es');
        $name = is_string($this->name) ? json_decode($this->name, true) : $this->name;

        return is_array($name) ? ($name[$locale] ?? $name['es'] ?? '') : $name;
    }

    public function getDescription(): ?string
    {
        $locale = session('locale', 'es');
        $description = is_string($this->description) ? json_decode($this->description, true) : $this->description;
        return is_array($description) ? ($description[$locale] ?? $description['es'] ?? '') : $description;
    }

    public function getIsMainAttribute(): bool
    {
        return empty($this->domain);
    }

    public function getPath(): string
    {
        return $this->domain;
    }

    public function getRouteParams(array $additionalParams = []): array
    {
        $params = $additionalParams;
        if ($this->domain !== '') {
            $params['domain'] = $this->domain;
        }
        return $params;
    }
}
