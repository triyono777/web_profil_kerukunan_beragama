<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    protected $fillable = [
        'address',
        'phone',
        'email',
        'whatsapp',
        'map_embed',
        'social_links',
        'quick_links',
        'copyright_text',
    ];

    protected $casts = [
        'social_links' => 'array',
        'quick_links' => 'array',
    ];
}
