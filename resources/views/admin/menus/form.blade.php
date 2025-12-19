<form method="POST" action="{{ $action }}" class="space-y-4">
    @csrf
    @if(isset($menu))
        @method('PUT')
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Label</label>
            <input type="text" name="label" value="{{ old('label', $menu->label ?? '') }}" class="mt-1 w-full rounded border-gray-300" required>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">URL</label>
            <input type="text" name="url" value="{{ old('url', $menu->url ?? '') }}" class="mt-1 w-full rounded border-gray-300" required>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Tipe</label>
            <select name="type" class="mt-1 w-full rounded border-gray-300">
                <option value="internal" @selected(old('type', $menu->type ?? '') === 'internal')>Internal</option>
                <option value="external" @selected(old('type', $menu->type ?? '') === 'external')>Eksternal</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Parent (opsional)</label>
            <select name="parent_id" class="mt-1 w-full rounded border-gray-300">
                <option value="">Tidak ada</option>
                @foreach($parents as $parent)
                    <option value="{{ $parent->id }}" @selected(old('parent_id', $menu->parent_id ?? '') == $parent->id)>{{ $parent->label }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Urutan</label>
            <input type="number" name="sort_order" value="{{ old('sort_order', $menu->sort_order ?? 0) }}" class="mt-1 w-full rounded border-gray-300">
        </div>
    </div>

    <div class="flex items-center gap-2">
        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $menu->is_active ?? true)) class="rounded border-gray-300">
        <label class="text-sm text-gray-700">Aktifkan menu</label>
    </div>

    <div class="flex justify-end gap-3">
        <a href="{{ route('admin.menus.index') }}" class="px-4 py-2 rounded border border-gray-300 text-gray-700">Batal</a>
        <button type="submit" class="px-4 py-2 rounded bg-indigo-600 text-white">Simpan</button>
    </div>
</form>
