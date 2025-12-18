<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\ContactMessage;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Post;
use App\Models\Program;
use App\Models\Section;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'posts' => [
                'draft' => Post::where('status', 'draft')->count(),
                'published' => Post::where('status', 'published')->count(),
                'archived' => Post::where('status', 'archived')->count(),
            ],
            'messages' => ContactMessage::where('status', 'new')->count(),
            'sections' => Section::count(),
            'menus' => Menu::count(),
            'pages' => Page::count(),
            'programs' => Program::count(),
            'agenda' => Agenda::count(),
        ];

        $latestPosts = Post::latest()->take(5)->get();
        $latestMessages = ContactMessage::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'latestPosts', 'latestMessages'));
    }
}
