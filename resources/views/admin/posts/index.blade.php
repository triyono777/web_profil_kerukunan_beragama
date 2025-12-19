<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Berita & Artikel</h2>
                <p class="text-sm text-gray-600">Kelola draft, publish, dan arsip berita.</p>
            </div>
            <a href="{{ route('admin.posts.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded shadow">
                Tambah Berita
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                @if (session('status'))
                    <div class="mb-4 p-3 rounded bg-emerald-50 text-emerald-700">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-4">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari judul atau ringkasan" class="rounded border-gray-300">
                    <select name="status" class="rounded border-gray-300">
                        <option value="">Semua status</option>
                        @foreach(['draft' => 'Draft', 'published' => 'Publish', 'archived' => 'Arsip'] as $value => $label)
                            <option value="{{ $value }}" @selected(request('status') === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="px-4 py-2 bg-gray-900 text-white rounded">Filter</button>
                </form>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="text-left text-gray-600 border-b">
                                <th class="pb-3">Judul</th>
                                <th class="pb-3">Kategori</th>
                                <th class="pb-3">Status</th>
                                <th class="pb-3">Diupdate</th>
                                <th class="pb-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($posts as $post)
                                <tr class="border-b last:border-0">
                                    <td class="py-3">
                                        <div class="font-semibold text-gray-900">{{ $post->title }}</div>
                                        <div class="text-gray-500">{{ $post->excerpt }}</div>
                                    </td>
                                    <td class="py-3 text-gray-700">{{ $post->category?->name ?? '-' }}</td>
                                    <td class="py-3">
                                        <span class="px-2 py-1 rounded text-xs {{ $post->status === 'published' ? 'bg-emerald-100 text-emerald-800' : ($post->status === 'draft' ? 'bg-amber-100 text-amber-800' : 'bg-gray-200 text-gray-800') }}">
                                            {{ ucfirst($post->status) }}
                                        </span>
                                    </td>
                                    <td class="py-3 text-gray-700">{{ optional($post->updated_at)->format('d M Y') }}</td>
                                    <td class="py-3 text-right space-x-2">
                                        <a href="{{ route('admin.posts.show', $post) }}" class="text-indigo-600 hover:underline">Preview</a>
                                        <a href="{{ route('admin.posts.edit', $post) }}" class="text-sky-600 hover:underline">Edit</a>
                                        <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Hapus berita ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-6 text-center text-gray-500">Belum ada berita.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
