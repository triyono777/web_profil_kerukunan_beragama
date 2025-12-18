<form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @if(isset($post))
        @method('PUT')
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-700">Judul</label>
            <input type="text" name="title" value="{{ old('title', $post->title ?? '') }}" class="mt-1 w-full rounded border-gray-300" required>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Slug</label>
            <input type="text" name="slug" value="{{ old('slug', $post->slug ?? '') }}" class="mt-1 w-full rounded border-gray-300" required>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-700">Status</label>
            <select name="status" class="mt-1 w-full rounded border-gray-300">
                @foreach(['draft' => 'Draft', 'published' => 'Publish', 'archived' => 'Arsip'] as $value => $label)
                    <option value="{{ $value }}" @selected(old('status', $post->status ?? 'draft') === $value)>{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Kategori</label>
            <select name="category_id" class="mt-1 w-full rounded border-gray-300">
                <option value="">Pilih kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id', $post->category_id ?? '') == $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex items-end gap-2">
            <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
                <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $post->is_featured ?? false)) class="rounded border-gray-300">
                Tandai sebagai unggulan
            </label>
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Tag</label>
        <div class="mt-2 grid grid-cols-2 md:grid-cols-4 gap-2">
            @foreach($tags as $tag)
                <label class="flex items-center gap-2 text-sm text-gray-700">
                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}" class="rounded border-gray-300"
                        @checked(collect(old('tags', isset($post) ? $post->tags->pluck('id')->toArray() : []))->contains($tag->id))>
                    {{ $tag->name }}
                </label>
            @endforeach
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Ringkasan</label>
        <textarea name="excerpt" rows="3" class="mt-1 w-full rounded border-gray-300" required>{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
        <p class="text-xs text-gray-500 mt-1">Maksimal 300 karakter.</p>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Konten</label>
        <textarea name="content" rows="8" class="mt-1 w-full rounded border-gray-300" required>{{ old('content', $post->content ?? '') }}</textarea>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-700">Cover</label>
            <input type="file" name="cover_image" class="mt-1 w-full rounded border-gray-300">
            @if(isset($post) && $post->cover_image)
                <img src="{{ asset('storage/'.$post->cover_image) }}" alt="Cover" class="mt-2 h-24 rounded object-cover">
            @endif
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Tanggal terbit</label>
            <input type="datetime-local" name="published_at" value="{{ old('published_at', isset($post->published_at) ? $post->published_at->format('Y-m-d\TH:i') : '') }}" class="mt-1 w-full rounded border-gray-300">
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-700">Meta Title</label>
            <input type="text" name="meta_title" value="{{ old('meta_title', $post->meta_title ?? '') }}" class="mt-1 w-full rounded border-gray-300">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Meta Description</label>
            <textarea name="meta_description" rows="2" class="mt-1 w-full rounded border-gray-300">{{ old('meta_description', $post->meta_description ?? '') }}</textarea>
        </div>
    </div>

    <div class="flex justify-end gap-3">
        <a href="{{ route('admin.posts.index') }}" class="px-4 py-2 rounded border border-gray-300 text-gray-700">Batal</a>
        <button type="submit" class="px-4 py-2 rounded bg-indigo-600 text-white">Simpan</button>
    </div>
</form>
