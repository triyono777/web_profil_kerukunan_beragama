<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'description',
        'is_featured',
        'status',
        'cta_label',
        'cta_link',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];
}
