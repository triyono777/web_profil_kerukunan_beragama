<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\MediaItem;
use App\Models\Post;
use App\Models\Program;
use App\Models\Section;

class HomeController extends Controller
{
    public function index()
    {
        $featuredPosts = Post::published()->latest('published_at')->take(3)->get();
        $latestPosts = Post::published()->latest('published_at')->take(6)->get();
        $agenda = Agenda::where('status', 'published')->orderBy('start_at')->take(3)->get();
        $programs = Program::where('status', 'published')->orderByDesc('is_featured')->take(3)->get();
        $gallery = MediaItem::where('is_active', true)->latest()->take(6)->get();
        $sections = Section::where('page_key', 'home')->where('is_active', true)->orderBy('sort_order')->get();

        return view('public.home', compact('featuredPosts', 'latestPosts', 'agenda', 'programs', 'gallery', 'sections'));
    }
}
