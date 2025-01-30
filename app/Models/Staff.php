<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_id',
        'name',
        'role',
        'bio',
        'slug',
        'order',
        'is_active'
    ];

    protected $casts = [
        'name' => 'json',
        'role' => 'json',
        'bio' => 'json',
        'is_active' => 'boolean',
        'order' => 'integer'
    ];

    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }

    public function getName(): ?string
    {
        $locale = session('locale', 'es');
        $name = is_string($this->name) ? json_decode($this->name, true) : $this->name;
        return is_array($name) ? ($name[$locale] ?? $name['es'] ?? '') : $name;
    }

    public function getRole(): ?string
    {
        $locale = session('locale', 'es');
        $role = is_string($this->role) ? json_decode($this->role, true) : $this->role;
        return is_array($role) ? ($role[$locale] ?? $role['es'] ?? '') : $role;
    }

    public function getBio(): ?string
    {
        $locale = session('locale', 'es');
        $bio = is_string($this->bio) ? json_decode($this->bio, true) : $this->bio;
        return is_array($bio) ? ($bio[$locale] ?? $bio['es'] ?? '') : $bio;
    }
}
