<form method="POST" action="{{ $action }}" class="space-y-4">
    @csrf
    @if(isset($agenda))
        @method('PUT')
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Judul</label>
            <input type="text" name="title" value="{{ old('title', $agenda->title ?? '') }}" class="mt-1 w-full rounded border-gray-300" required>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Slug</label>
            <input type="text" name="slug" value="{{ old('slug', $agenda->slug ?? '') }}" class="mt-1 w-full rounded border-gray-300" required>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Mulai</label>
            <input type="datetime-local" name="start_at" value="{{ old('start_at', isset($agenda->start_at) ? $agenda->start_at->format('Y-m-d\\TH:i') : '') }}" class="mt-1 w-full rounded border-gray-300">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Selesai</label>
            <input type="datetime-local" name="end_at" value="{{ old('end_at', isset($agenda->end_at) ? $agenda->end_at->format('Y-m-d\\TH:i') : '') }}" class="mt-1 w-full rounded border-gray-300">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Lokasi</label>
            <input type="text" name="location" value="{{ old('location', $agenda->location ?? '') }}" class="mt-1 w-full rounded border-gray-300">
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Status</label>
            <select name="status" class="mt-1 w-full rounded border-gray-300">
                @foreach(['draft' => 'Draft', 'published' => 'Publish', 'archived' => 'Arsip'] as $value => $label)
                    <option value="{{ $value }}" @selected(old('status', $agenda->status ?? 'published') === $value)>{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex items-end gap-2">
            <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $agenda->is_featured ?? false)) class="rounded border-gray-300">
            <label class="text-sm text-gray-700">Tandai sebagai agenda utama</label>
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
        <textarea name="description" rows="5" class="mt-1 w-full rounded border-gray-300">{{ old('description', $agenda->description ?? '') }}</textarea>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Link Registrasi (opsional)</label>
        <input type="text" name="registration_link" value="{{ old('registration_link', $agenda->registration_link ?? '') }}" class="mt-1 w-full rounded border-gray-300">
    </div>

    <div class="flex justify-end gap-3">
        <a href="{{ route('admin.agendas.index') }}" class="px-4 py-2 rounded border border-gray-300 text-gray-700">Batal</a>
        <button type="submit" class="px-4 py-2 rounded bg-indigo-600 text-white">Simpan</button>
    </div>
</form>
