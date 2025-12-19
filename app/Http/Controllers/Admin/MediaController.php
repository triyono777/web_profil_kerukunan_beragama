<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MediaRequest;
use App\Models\MediaItem;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mediaItems = MediaItem::latest()->paginate(20);

        return view('admin.media.index', compact('mediaItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.media.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MediaRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('media')) {
            $data['media_path'] = $request->file('media')->store('media', 'public');
        }

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail_path'] = $request->file('thumbnail')->store('media/thumbnails', 'public');
        }

        MediaItem::create($data);

        return redirect()->route('admin.media.index')->with('status', 'Media disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MediaItem $media)
    {
        return view('admin.media.show', ['media' => $media]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MediaItem $media)
    {
        return view('admin.media.edit', ['media' => $media]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MediaRequest $request, MediaItem $media)
    {
        $data = $request->validated();

        if ($request->hasFile('media')) {
            if ($media->media_path) {
                Storage::disk('public')->delete($media->media_path);
            }

            $data['media_path'] = $request->file('media')->store('media', 'public');
        }

        if ($request->hasFile('thumbnail')) {
            if ($media->thumbnail_path) {
                Storage::disk('public')->delete($media->thumbnail_path);
            }

            $data['thumbnail_path'] = $request->file('thumbnail')->store('media/thumbnails', 'public');
        }

        $media->update($data);

        return redirect()->route('admin.media.index')->with('status', 'Media diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MediaItem $media)
    {
        if ($media->media_path) {
            Storage::disk('public')->delete($media->media_path);
        }

        if ($media->thumbnail_path) {
            Storage::disk('public')->delete($media->thumbnail_path);
        }

        $media->delete();

        return redirect()->route('admin.media.index')->with('status', 'Media dihapus.');
    }
}
