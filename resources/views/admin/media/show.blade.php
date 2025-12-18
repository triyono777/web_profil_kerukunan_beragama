<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $media->title }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 space-y-3">
                <div class="text-sm text-gray-600">Tipe: {{ ucfirst($media->type) }} | Status: {{ $media->is_active ? 'Aktif' : 'Nonaktif' }}</div>
                <div class="text-gray-700">{{ $media->description }}</div>
                <div class="text-xs text-gray-500">Path: {{ $media->media_path }}</div>
                <a href="{{ route('admin.media.edit', $media) }}" class="text-indigo-600 hover:underline">Edit</a>
            </div>
        </div>
    </div>
</x-app-layout>
