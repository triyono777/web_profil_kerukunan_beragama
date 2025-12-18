<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MenuRequest;
use App\Models\Menu;
use Illuminate\Support\Facades\Cache;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::with('children')->whereNull('parent_id')->orderBy('sort_order')->get();
        $allMenus = Menu::orderBy('sort_order')->get();

        return view('admin.menus.index', compact('menus', 'allMenus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents = Menu::orderBy('sort_order')->get();

        return view('admin.menus.create', compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MenuRequest $request)
    {
        Menu::create($request->validated());
        Cache::forget('menus.active');

        return redirect()->route('admin.menus.index')->with('status', 'Menu disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        return view('admin.menus.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        $parents = Menu::where('id', '!=', $menu->id)->orderBy('sort_order')->get();

        return view('admin.menus.edit', compact('menu', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MenuRequest $request, Menu $menu)
    {
        $menu->update($request->validated());
        Cache::forget('menus.active');

        return redirect()->route('admin.menus.index')->with('status', 'Menu diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();
        Cache::forget('menus.active');

        return redirect()->route('admin.menus.index')->with('status', 'Menu dihapus.');
    }
}
