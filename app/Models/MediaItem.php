<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaItem extends Model
{
    protected $fillable = [
        'title',
        'type',
        'media_path',
        'thumbnail_path',
        'description',
        'is_active',
        'published_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'published_at' => 'datetime',
    ];
}
