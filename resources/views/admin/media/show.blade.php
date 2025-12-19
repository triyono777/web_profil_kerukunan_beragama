<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $media->title }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @php
                $placeholder = 'data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="600" height="340" viewBox="0 0 600 340"><defs><linearGradient id="g2" x1="0" x2="1" y1="0" y2="1"><stop stop-color="%23e5e7eb" offset="0%"/><stop stop-color="%23cbd5e1" offset="100%"/></linearGradient></defs><rect width="600" height="340" fill="url(%23g2)"/><g fill="%236b7280" font-family="Arial" font-size="18" text-anchor="middle"><text x="300" y="175">Tidak ada gambar</text></g></svg>';
                $img = $media->thumbnail_url ?? $media->url ?? $placeholder;
            @endphp
            <div class="bg-white shadow-sm sm:rounded-lg p-6 space-y-3">
                <div class="rounded-lg overflow-hidden border border-gray-200">
                    <img src="{{ $img }}" alt="{{ $media->title }}" class="w-full h-72 object-cover bg-gray-100">
                </div>
                <div class="text-sm text-gray-600">Tipe: {{ ucfirst($media->type) }} | Status: {{ $media->is_active ? 'Aktif' : 'Nonaktif' }}</div>
                <div class="text-gray-700">{{ $media->description }}</div>
                <div class="text-xs text-gray-500">Path: {{ $media->media_path }}</div>
                <a href="{{ route('admin.media.edit', $media) }}" class="text-indigo-600 hover:underline">Edit</a>
            </div>
        </div>
    </div>
</x-app-layout>
