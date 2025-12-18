<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class RouteInfoController extends Controller
{
    public function index()
    {
        $routes = collect(Route::getRoutes())
            ->filter(fn ($route) => $route->getName())
            ->map(function ($route) {
                return [
                    'method' => implode('|', $route->methods()),
                    'uri' => $route->uri(),
                    'name' => $route->getName(),
                    'action' => $route->getActionName(),
                ];
            })
            ->sortBy('name')
            ->values();

        $publicRoutes = $routes->filter(function ($r) {
            return ! str_starts_with($r['name'], 'admin.')
                && ! str_starts_with($r['name'], 'profile.')
                && ! str_starts_with($r['name'], 'auth.')
                && ! str_starts_with($r['name'], 'password.')
                && ! str_starts_with($r['name'], 'generated::');
        })->values();

        $labels = [
            'home' => 'Beranda utama',
            'profile.page' => 'Profil organisasi',
            'pages.show' => 'Halaman statis',
            'program.index' => 'Daftar program',
            'posts.index' => 'Daftar berita',
            'posts.show' => 'Detail berita',
            'agenda.index' => 'Agenda kegiatan',
            'gallery.index' => 'Galeri foto/video',
            'documents.index' => 'Dokumen unduhan',
            'contact.index' => 'Kontak & aspirasi (form)',
            'contact.store' => 'Kirim aspirasi',
        ];

        return view('admin.routes.index', compact('publicRoutes', 'labels'));
    }
}
