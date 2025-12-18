<form method="POST" action="{{ $action }}" class="space-y-4">
    @csrf
    @if(isset($section))
        @method('PUT')
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Page Key</label>
            <input type="text" name="page_key" value="{{ old('page_key', $section->page_key ?? $pageKey ?? '') }}" class="mt-1 w-full rounded border-gray-300" required>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Section Key</label>
            <input type="text" name="section_key" value="{{ old('section_key', $section->section_key ?? '') }}" class="mt-1 w-full rounded border-gray-300" required>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700">Judul (opsional)</label>
            <input type="text" name="title" value="{{ old('title', $section->title ?? '') }}" class="mt-1 w-full rounded border-gray-300">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Urutan</label>
            <input type="number" name="sort_order" value="{{ old('sort_order', $section->sort_order ?? 0) }}" class="mt-1 w-full rounded border-gray-300">
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Konten (HTML/Markdown)</label>
        <textarea name="content" rows="6" class="mt-1 w-full rounded border-gray-300">{{ old('content', $section->content ?? '') }}</textarea>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">JSON Data (opsional)</label>
        <textarea name="json_data" rows="4" class="mt-1 w-full rounded border-gray-300" placeholder='{"items": []}'>{{ old('json_data', isset($section) && $section->json_data ? json_encode($section->json_data) : '') }}</textarea>
        <p class="text-xs text-gray-500">Gunakan untuk data terstruktur seperti daftar nilai atau link.</p>
    </div>

    <div class="flex items-center gap-2">
        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $section->is_active ?? true)) class="rounded border-gray-300">
        <label class="text-sm text-gray-700">Tampilkan di halaman</label>
    </div>

    <div class="flex justify-end gap-3">
        <a href="{{ route('admin.sections.index', ['page' => old('page_key', $section->page_key ?? $pageKey ?? 'home')]) }}" class="px-4 py-2 rounded border border-gray-300 text-gray-700">Batal</a>
        <button type="submit" class="px-4 py-2 rounded bg-indigo-600 text-white">Simpan</button>
    </div>
</form>
