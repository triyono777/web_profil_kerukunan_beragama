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

        $adminRoutes = $routes->filter(fn ($r) => str_starts_with($r['name'], 'admin.'));
        $publicRoutes = $routes->filter(fn ($r) => ! str_starts_with($r['name'], 'admin.') && ! str_starts_with($r['name'], 'generated::'));

        return view('admin.routes.index', compact('adminRoutes', 'publicRoutes'));
    }
}
