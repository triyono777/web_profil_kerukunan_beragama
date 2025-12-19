<form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="space-y-4">
    @csrf
    @if(isset($document))
        @method('PUT')
    @endif

    <div>
        <label class="block text-sm font-medium text-gray-700">Judul Dokumen</label>
        <input type="text" name="title" value="{{ old('title', $document->title ?? '') }}" class="mt-1 w-full rounded border-gray-300" required>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
        <textarea name="description" rows="4" class="mt-1 w-full rounded border-gray-300">{{ old('description', $document->description ?? '') }}</textarea>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Upload File</label>
            <input type="file" name="file" class="mt-1 w-full rounded border-gray-300">
            @if(isset($document) && $document->file_path)
                <p class="text-xs text-gray-500 mt-1">Tersimpan di: {{ $document->file_path }}</p>
            @endif
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Atau Path</label>
            <input type="text" name="file_path" value="{{ old('file_path', $document->file_path ?? '') }}" class="mt-1 w-full rounded border-gray-300" placeholder="storage/documents/...">
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Tanggal Terbit</label>
            <input type="datetime-local" name="published_at" value="{{ old('published_at', isset($document->published_at) ? $document->published_at->format('Y-m-d\\TH:i') : '') }}" class="mt-1 w-full rounded border-gray-300">
        </div>
        <div class="flex items-end gap-2">
            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $document->is_active ?? true)) class="rounded border-gray-300">
            <label class="text-sm text-gray-700">Aktif</label>
        </div>
    </div>

    <div class="flex justify-end gap-3">
        <a href="{{ route('admin.documents.index') }}" class="px-4 py-2 rounded border border-gray-300 text-gray-700">Batal</a>
        <button type="submit" class="px-4 py-2 rounded bg-indigo-600 text-white">Simpan</button>
    </div>
</form>
