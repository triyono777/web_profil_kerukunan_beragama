<?php

namespace App\Http\Controllers;

use App\Models\MediaItem;

class GalleryController extends Controller
{
    public function index()
    {
        $media = MediaItem::where('is_active', true)
            ->latest('published_at')
            ->paginate(12);

        return view('public.gallery', compact('media'));
    }
}
