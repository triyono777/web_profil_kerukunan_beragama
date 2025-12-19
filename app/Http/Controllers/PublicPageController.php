<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Section;

class PublicPageController extends Controller
{
    public function profile()
    {
        return $this->show('profil');
    }

    public function show(string $slug)
    {
        $page = Page::where(function ($query) use ($slug) {
            $query->where('slug', $slug)->orWhere('key', $slug);
        })
            ->published()
            ->firstOrFail();

        $sections = Section::where('page_key', $page->key)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('public.page', compact('page', 'sections'));
    }
}
