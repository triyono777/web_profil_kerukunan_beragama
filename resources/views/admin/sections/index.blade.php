<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Konten Dinamis (Sections)</h2>
                <p class="text-sm text-gray-600">Kelola blok konten per halaman. Saat ini halaman: <strong class="text-gray-900">{{ $pageKey }}</strong></p>
            </div>
            <div class="flex items-center gap-2">
                <form method="GET" class="flex items-center gap-2">
                    <select name="page" class="rounded border-gray-300">
                        @foreach($pageKeys as $key)
                            <option value="{{ $key }}" @selected($pageKey === $key)>{{ $key }}</option>
                        @endforeach
                        <option value="home" @selected($pageKey === 'home')>home</option>
                    </select>
                    <button type="submit" class="px-3 py-2 bg-slate-100 rounded border border-slate-200 text-sm">Pilih</button>
                </form>
                <a href="{{ route('admin.sections.create', ['page' => $pageKey]) }}" class="px-4 py-2 bg-indigo-600 text-white rounded">Tambah Blok</a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 space-y-4">
                <div>
                    <h3 class="text-sm font-semibold text-gray-700 mb-2">Ringkasan Halaman</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($pagesSummary as $summary)
                            <a href="{{ route('admin.sections.index', ['page' => $summary->page_key]) }}" class="px-3 py-1 rounded-full bg-slate-100 border border-slate-200 text-sm {{ $pageKey === $summary->page_key ? 'font-semibold text-indigo-700' : 'text-gray-700' }}">
                                {{ $summary->page_key }} ({{ $summary->total }})
                            </a>
                        @endforeach
                    </div>
                </div>

                @if (session('status'))
                    <div class="mb-4 p-3 rounded bg-emerald-50 text-emerald-700">{{ session('status') }}</div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="text-left text-gray-600 border-b">
                                <th class="pb-3">Section</th>
                                <th class="pb-3">Judul</th>
                                <th class="pb-3">Urutan</th>
                                <th class="pb-3">Aktif</th>
                                <th class="pb-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sections as $section)
                                <tr class="border-b last:border-0">
                                    <td class="py-3 font-semibold text-gray-900">{{ $section->section_key }}</td>
                                    <td class="py-3 text-gray-700">{{ $section->title ?? '-' }}</td>
                                    <td class="py-3 text-gray-700">{{ $section->sort_order }}</td>
                                    <td class="py-3">
                                        <span class="px-2 py-1 rounded text-xs {{ $section->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-200 text-gray-700' }}">
                                            {{ $section->is_active ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>
                                    <td class="py-3 text-right space-x-2">
                                        <a href="{{ route('admin.sections.edit', $section) }}" class="text-sky-600 hover:underline">Edit</a>
                                        <form action="{{ route('admin.sections.destroy', $section) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Hapus section ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-6 text-center text-gray-500">Belum ada konten untuk halaman ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
