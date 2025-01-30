<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class CreativeTeam extends Model
{
    use HasTranslations;

    protected $fillable = [
        'site_id',
        'name',
        'role',
        'bio',
        'photo',
        'social_media',
        'order',
        'is_active'
    ];

    public $translatable = [
        'role',
        'bio'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
        'social_media' => 'array'
    ];

    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }
}
