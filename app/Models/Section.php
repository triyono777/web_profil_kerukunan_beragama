<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = [
        'page_key',
        'section_key',
        'title',
        'content',
        'json_data',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'json_data' => 'array',
        'is_active' => 'boolean',
    ];
}
