<form method="POST" action="{{ $action }}" class="space-y-4">
    @csrf
    @if(isset($category))
        @method('PUT')
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Nama</label>
            <input type="text" name="name" value="{{ old('name', $category->name ?? '') }}" class="mt-1 w-full rounded border-gray-300" required>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Slug</label>
            <input type="text" name="slug" value="{{ old('slug', $category->slug ?? '') }}" class="mt-1 w-full rounded border-gray-300">
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
        <textarea name="description" rows="3" class="mt-1 w-full rounded border-gray-300">{{ old('description', $category->description ?? '') }}</textarea>
    </div>

    <div class="flex justify-end gap-3">
        <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 rounded border border-gray-300 text-gray-700">Batal</a>
        <button type="submit" class="px-4 py-2 rounded bg-indigo-600 text-white">Simpan</button>
    </div>
</form>
