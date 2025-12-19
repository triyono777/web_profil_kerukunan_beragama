<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Halaman Statis</h2>
                <p class="text-sm text-gray-600">Kontrol konten halaman profil, kebijakan, dan lainnya.</p>
            </div>
            <a href="{{ route('admin.pages.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded">Tambah Halaman</a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                @if (session('status'))
                    <div class="mb-4 p-3 rounded bg-emerald-50 text-emerald-700">{{ session('status') }}</div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="text-left text-gray-600 border-b">
                                <th class="pb-3">Judul</th>
                                <th class="pb-3">Key</th>
                                <th class="pb-3">Status</th>
                                <th class="pb-3">Terbit</th>
                                <th class="pb-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pages as $page)
                                <tr class="border-b last:border-0">
                                    <td class="py-3 font-semibold text-gray-900">{{ $page->title }}</td>
                                    <td class="py-3 text-gray-700">{{ $page->key }}</td>
                                    <td class="py-3">
                                        <span class="px-2 py-1 rounded text-xs {{ $page->status === 'published' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-800' }}">
                                            {{ ucfirst($page->status) }}
                                        </span>
                                    </td>
                                    <td class="py-3 text-gray-700">{{ optional($page->published_at)->format('d M Y') ?? '-' }}</td>
                                    <td class="py-3 text-right space-x-2">
                                        <a href="{{ route('admin.pages.edit', $page) }}" class="text-sky-600 hover:underline">Edit</a>
                                        <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Hapus halaman ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-6 text-center text-gray-500">Belum ada halaman.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $pages->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
