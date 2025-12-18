<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Menu Navigasi</h2>
                <p class="text-sm text-gray-600">Semua menu yang tampil di header diambil dari data ini.</p>
            </div>
            <a href="{{ route('admin.menus.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded">Tambah Menu</a>
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
                                <th class="pb-3">Label</th>
                                <th class="pb-3">URL</th>
                                <th class="pb-3">Urutan</th>
                                <th class="pb-3">Status</th>
                                <th class="pb-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($menus as $menu)
                                <tr class="border-b last:border-0">
                                    <td class="py-3 font-semibold text-gray-900">{{ $menu->label }}</td>
                                    <td class="py-3 text-gray-700">{{ $menu->url }}</td>
                                    <td class="py-3 text-gray-700">{{ $menu->sort_order }}</td>
                                    <td class="py-3">
                                        <span class="px-2 py-1 rounded text-xs {{ $menu->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-200 text-gray-700' }}">
                                            {{ $menu->is_active ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>
                                    <td class="py-3 text-right space-x-2">
                                        <a href="{{ route('admin.menus.edit', $menu) }}" class="text-sky-600 hover:underline">Edit</a>
                                        <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Hapus menu ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @foreach($menu->children as $child)
                                    <tr class="border-b last:border-0 bg-gray-50">
                                        <td class="py-3 pl-6 text-gray-900">↳ {{ $child->label }}</td>
                                        <td class="py-3 text-gray-700">{{ $child->url }}</td>
                                        <td class="py-3 text-gray-700">{{ $child->sort_order }}</td>
                                        <td class="py-3">
                                            <span class="px-2 py-1 rounded text-xs {{ $child->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-200 text-gray-700' }}">
                                                {{ $child->is_active ? 'Aktif' : 'Nonaktif' }}
                                            </span>
                                        </td>
                                        <td class="py-3 text-right space-x-2">
                                            <a href="{{ route('admin.menus.edit', $child) }}" class="text-sky-600 hover:underline">Edit</a>
                                            <form action="{{ route('admin.menus.destroy', $child) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Hapus menu ini?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @empty
                                <tr>
                                    <td colspan="5" class="py-6 text-center text-gray-500">Belum ada menu.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
