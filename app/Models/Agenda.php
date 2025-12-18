<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'start_at',
        'end_at',
        'location',
        'is_featured',
        'status',
        'registration_link',
    ];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'is_featured' => 'boolean',
    ];
}
