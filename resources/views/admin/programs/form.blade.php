<form method="POST" action="{{ $action }}" class="space-y-4">
    @csrf
    @if(isset($program))
        @method('PUT')
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Judul</label>
            <input type="text" name="title" value="{{ old('title', $program->title ?? '') }}" class="mt-1 w-full rounded border-gray-300" required>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Slug</label>
            <input type="text" name="slug" value="{{ old('slug', $program->slug ?? '') }}" class="mt-1 w-full rounded border-gray-300" required>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Status</label>
            <select name="status" class="mt-1 w-full rounded border-gray-300">
                @foreach(['draft' => 'Draft', 'published' => 'Publish', 'archived' => 'Arsip'] as $value => $label)
                    <option value="{{ $value }}" @selected(old('status', $program->status ?? 'published') === $value)>{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex items-end gap-2">
            <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $program->is_featured ?? false)) class="rounded border-gray-300">
            <label class="text-sm text-gray-700">Program unggulan</label>
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Ringkasan</label>
        <textarea name="excerpt" rows="3" class="mt-1 w-full rounded border-gray-300">{{ old('excerpt', $program->excerpt ?? '') }}</textarea>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
        <textarea name="description" rows="6" class="mt-1 w-full rounded border-gray-300" required>{{ old('description', $program->description ?? '') }}</textarea>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Label CTA</label>
            <input type="text" name="cta_label" value="{{ old('cta_label', $program->cta_label ?? '') }}" class="mt-1 w-full rounded border-gray-300">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Link CTA</label>
            <input type="text" name="cta_link" value="{{ old('cta_link', $program->cta_link ?? '') }}" class="mt-1 w-full rounded border-gray-300">
        </div>
    </div>

    <div class="flex justify-end gap-3">
        <a href="{{ route('admin.programs.index') }}" class="px-4 py-2 rounded border border-gray-300 text-gray-700">Batal</a>
        <button type="submit" class="px-4 py-2 rounded bg-indigo-600 text-white">Simpan</button>
    </div>
</form>
