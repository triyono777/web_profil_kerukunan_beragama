<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

    protected function resolvePath(?string $path): ?string
    {
        if (! $path) {
            return null;
        }

        if (Str::startsWith($path, ['http://', 'https://', '//'])) {
            return $path;
        }

        return asset('storage/'.$path);
    }

    public function getUrlAttribute(): ?string
    {
        return $this->resolvePath($this->media_path);
    }

    public function getThumbnailUrlAttribute(): ?string
    {
        return $this->resolvePath($this->thumbnail_path) ?? $this->url;
    }
}
