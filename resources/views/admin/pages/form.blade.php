<form method="POST" action="{{ $action }}" class="space-y-4">
    @csrf
    @if(isset($page))
        @method('PUT')
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Key</label>
            <input type="text" name="key" value="{{ old('key', $page->key ?? '') }}" class="mt-1 w-full rounded border-gray-300" required>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Slug</label>
            <input type="text" name="slug" value="{{ old('slug', $page->slug ?? '') }}" class="mt-1 w-full rounded border-gray-300" required>
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Judul</label>
        <input type="text" name="title" value="{{ old('title', $page->title ?? '') }}" class="mt-1 w-full rounded border-gray-300" required>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Status</label>
            <select name="status" class="mt-1 w-full rounded border-gray-300">
                <option value="draft" @selected(old('status', $page->status ?? 'draft') === 'draft')>Draft</option>
                <option value="published" @selected(old('status', $page->status ?? '') === 'published')>Publish</option>
            </select>
        </div>
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700">Tanggal terbit</label>
            <input type="datetime-local" name="published_at" value="{{ old('published_at', isset($page->published_at) ? $page->published_at->format('Y-m-d\\TH:i') : '') }}" class="mt-1 w-full rounded border-gray-300">
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Konten</label>
        <textarea name="content" rows="8" class="mt-1 w-full rounded border-gray-300">{{ old('content', $page->content ?? '') }}</textarea>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Meta Title</label>
            <input type="text" name="meta_title" value="{{ old('meta_title', $page->meta_title ?? '') }}" class="mt-1 w-full rounded border-gray-300">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Meta Description</label>
            <textarea name="meta_description" rows="3" class="mt-1 w-full rounded border-gray-300">{{ old('meta_description', $page->meta_description ?? '') }}</textarea>
        </div>
    </div>

    <div class="flex justify-end gap-3">
        <a href="{{ route('admin.pages.index') }}" class="px-4 py-2 rounded border border-gray-300 text-gray-700">Batal</a>
        <button type="submit" class="px-4 py-2 rounded bg-indigo-600 text-white">Simpan</button>
    </div>
</form>
