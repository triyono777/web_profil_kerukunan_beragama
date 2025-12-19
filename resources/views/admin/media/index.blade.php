<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Galeri Media</h2>
                <p class="text-sm text-gray-600">Kelola foto dan video.</p>
            </div>
            <a href="{{ route('admin.media.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded">Tambah Media</a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                @if (session('status'))
                    <div class="mb-4 p-3 rounded bg-emerald-50 text-emerald-700">{{ session('status') }}</div>
                @endif

                @php
                    $placeholder = 'data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="300" height="180" viewBox="0 0 300 180"><defs><linearGradient id="g" x1="0" x2="1" y1="0" y2="1"><stop stop-color="%23e2e8f0" offset="0%"/><stop stop-color="%23cbd5e1" offset="100%"/></linearGradient></defs><rect width="300" height="180" fill="url(%23g)"/><g fill="%236b7280" font-family="Arial" font-size="16" text-anchor="middle"><text x="150" y="95">Preview tidak tersedia</text></g></svg>';
                @endphp

                <div class="grid md:grid-cols-3 gap-4">
                    @forelse($mediaItems as $media)
                        @php
                            $img = $media->thumbnail_url ?? $media->url ?? $placeholder;
                        @endphp
                        <div class="border rounded overflow-hidden bg-white shadow-sm space-y-2">
                            <div class="aspect-video bg-slate-100">
                                <img src="{{ $img }}" alt="{{ $media->title }}" class="w-full h-full object-cover">
                            </div>
                            <div class="flex items-center justify-between px-4 pt-3">
                                <span class="text-xs px-2 py-1 rounded bg-gray-100 text-gray-700">{{ ucfirst($media->type) }}</span>
                                <span class="text-xs text-gray-500">{{ $media->is_active ? 'Aktif' : 'Draft' }}</span>
                            </div>
                            <div class="px-4 pb-2">
                                <div class="font-semibold text-gray-900">{{ $media->title }}</div>
                                <div class="text-sm text-gray-600 line-clamp-2">{{ $media->description }}</div>
                            </div>
                            <div class="flex items-center gap-2 px-4 pb-4">
                                <a href="{{ route('admin.media.edit', $media) }}" class="text-sky-600 hover:underline text-sm">Edit</a>
                                <form action="{{ route('admin.media.destroy', $media) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline text-sm" onclick="return confirm('Hapus media ini?')">Hapus</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 text-center text-gray-500 py-6">Belum ada media.</div>
                    @endforelse
                </div>

                <div class="mt-4">
                    {{ $mediaItems->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
