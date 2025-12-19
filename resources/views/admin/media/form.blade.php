<form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="space-y-4">
    @csrf
    @if(isset($media))
        @method('PUT')
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Judul</label>
            <input type="text" name="title" value="{{ old('title', $media->title ?? '') }}" class="mt-1 w-full rounded border-gray-300" required>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Tipe</label>
            <select name="type" class="mt-1 w-full rounded border-gray-300">
                <option value="image" @selected(old('type', $media->type ?? 'image') === 'image')>Gambar</option>
                <option value="video" @selected(old('type', $media->type ?? '') === 'video')>Video</option>
            </select>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Upload File</label>
            <input type="file" name="media" class="mt-1 w-full rounded border-gray-300">
            @if(isset($media) && $media->media_path)
                <p class="text-xs text-gray-500 mt-1">File tersimpan: {{ $media->media_path }}</p>
            @endif
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Thumbnail (opsional)</label>
            <input type="file" name="thumbnail" class="mt-1 w-full rounded border-gray-300">
            @if(isset($media) && $media->thumbnail_path)
                <img src="{{ $media->thumbnail_url }}" alt="Thumbnail" class="mt-2 h-20 rounded object-cover">
            @endif
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Atau path/link media</label>
        <input type="text" name="media_path" value="{{ old('media_path', $media->media_path ?? '') }}" class="mt-1 w-full rounded border-gray-300" placeholder="contoh: images/cover.jpg atau https://...">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
        <textarea name="description" rows="4" class="mt-1 w-full rounded border-gray-300">{{ old('description', $media->description ?? '') }}</textarea>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Tanggal tayang</label>
            <input type="datetime-local" name="published_at" value="{{ old('published_at', isset($media->published_at) ? $media->published_at->format('Y-m-d\\TH:i') : '') }}" class="mt-1 w-full rounded border-gray-300">
        </div>
        <div class="flex items-end gap-2">
            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $media->is_active ?? true)) class="rounded border-gray-300">
            <label class="text-sm text-gray-700">Aktif</label>
        </div>
    </div>

    <div class="flex justify-end gap-3">
        <a href="{{ route('admin.media.index') }}" class="px-4 py-2 rounded border border-gray-300 text-gray-700">Batal</a>
        <button type="submit" class="px-4 py-2 rounded bg-indigo-600 text-white">Simpan</button>
    </div>
</form>
