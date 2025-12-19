<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Menu</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 space-y-2">
                <div class="text-lg font-semibold text-gray-900">{{ $menu->label }}</div>
                <div class="text-gray-700">URL: {{ $menu->url }}</div>
                <div class="text-gray-700">Status: {{ $menu->is_active ? 'Aktif' : 'Nonaktif' }}</div>
                <div class="text-gray-700">Urutan: {{ $menu->sort_order }}</div>
                <a href="{{ route('admin.menus.edit', $menu) }}" class="text-indigo-600 hover:underline">Edit menu</a>
            </div>
        </div>
    </div>
</x-app-layout>
