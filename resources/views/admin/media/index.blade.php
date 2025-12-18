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

                <div class="grid md:grid-cols-3 gap-4">
                    @forelse($mediaItems as $media)
                        <div class="border rounded p-4 space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="text-xs px-2 py-1 rounded bg-gray-100 text-gray-700">{{ ucfirst($media->type) }}</span>
                                <span class="text-xs text-gray-500">{{ $media->is_active ? 'Aktif' : 'Draft' }}</span>
                            </div>
                            <div class="font-semibold text-gray-900">{{ $media->title }}</div>
                            <div class="text-sm text-gray-600 line-clamp-2">{{ $media->description }}</div>
                            <div class="flex items-center gap-2">
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
