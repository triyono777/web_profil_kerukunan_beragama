<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tag</h2>
                <p class="text-sm text-gray-600">Kelola tag untuk berita.</p>
            </div>
            <a href="{{ route('admin.tags.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded">Tambah</a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                @if (session('status'))
                    <div class="mb-4 p-3 rounded bg-emerald-50 text-emerald-700">{{ session('status') }}</div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="text-left text-gray-600 border-b">
                                <th class="pb-3">Nama</th>
                                <th class="pb-3">Slug</th>
                                <th class="pb-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tags as $tag)
                                <tr class="border-b last:border-0">
                                    <td class="py-3 font-semibold text-gray-900">{{ $tag->name }}</td>
                                    <td class="py-3 text-gray-700">{{ $tag->slug }}</td>
                                    <td class="py-3 space-x-2">
                                        <a href="{{ route('admin.tags.edit', $tag) }}" class="text-sky-600 hover:underline">Edit</a>
                                        <form action="{{ route('admin.tags.destroy', $tag) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Hapus tag ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="py-6 text-center text-gray-500">Belum ada tag.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $tags->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
