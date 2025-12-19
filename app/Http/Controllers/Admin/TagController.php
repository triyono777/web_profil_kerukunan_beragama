<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::latest()->paginate(20);

        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'slug' => ['nullable', 'alpha_dash', 'unique:tags,slug'],
        ]);

        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);

        Tag::create($data);

        return redirect()->route('admin.tags.index')->with('status', 'Tag dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        return view('admin.tags.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'slug' => ['nullable', 'alpha_dash', 'unique:tags,slug,' . $tag->id],
        ]);

        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);

        $tag->update($data);

        return redirect()->route('admin.tags.index')->with('status', 'Tag diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();

        return redirect()->route('admin.tags.index')->with('status', 'Tag dihapus.');
    }
}
