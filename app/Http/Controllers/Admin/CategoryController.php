<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->paginate(15);

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'slug' => ['nullable', 'alpha_dash', 'unique:categories,slug'],
            'description' => ['nullable', 'string'],
        ]);

        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);

        Category::create($data);

        return redirect()->route('admin.categories.index')->with('status', 'Kategori dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'slug' => ['nullable', 'alpha_dash', 'unique:categories,slug,' . $category->id],
            'description' => ['nullable', 'string'],
        ]);

        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);

        $category->update($data);

        return redirect()->route('admin.categories.index')->with('status', 'Kategori diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')->with('status', 'Kategori dihapus.');
    }
}
