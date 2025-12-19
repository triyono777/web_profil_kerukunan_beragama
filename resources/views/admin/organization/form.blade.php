<form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="space-y-4">
    @csrf
    @if(isset($member))
        @method('PUT')
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Nama</label>
            <input type="text" name="name" value="{{ old('name', $member->name ?? '') }}" class="mt-1 w-full rounded border-gray-300" required>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Jabatan</label>
            <input type="text" name="position" value="{{ old('position', $member->position ?? '') }}" class="mt-1 w-full rounded border-gray-300" required>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700">Bio</label>
            <textarea name="bio" rows="4" class="mt-1 w-full rounded border-gray-300">{{ old('bio', $member->bio ?? '') }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Urutan</label>
            <input type="number" name="sort_order" value="{{ old('sort_order', $member->sort_order ?? 0) }}" class="mt-1 w-full rounded border-gray-300">
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Foto</label>
            <input type="file" name="photo" class="mt-1 w-full rounded border-gray-300">
            @if(isset($member) && $member->photo_path)
                <img src="{{ asset('storage/'.$member->photo_path) }}" alt="Foto" class="mt-2 h-24 rounded object-cover">
            @endif
        </div>
        <div class="flex items-end gap-2">
            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $member->is_active ?? true)) class="rounded border-gray-300">
            <label class="text-sm text-gray-700">Aktif</label>
        </div>
    </div>

    <div class="flex justify-end gap-3">
        <a href="{{ route('admin.organization.index') }}" class="px-4 py-2 rounded border border-gray-300 text-gray-700">Batal</a>
        <button type="submit" class="px-4 py-2 rounded bg-indigo-600 text-white">Simpan</button>
    </div>
</form>
