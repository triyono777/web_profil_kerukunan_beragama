<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'site_name',
        'logo_path',
        'favicon_path',
        'primary_color',
        'contact_email',
        'contact_phone',
        'contact_whatsapp',
        'contact_address',
        'map_embed',
        'office_hours',
        'hero_title',
        'hero_subtitle',
        'hero_cta_label',
        'hero_cta_link',
        'theme',
    ];
}
