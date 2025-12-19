<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Daftar Route</h2>
                <p class="text-sm text-gray-600">Informasi singkat route bernama yang bisa dipakai di menu/link.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 space-y-3">
                <p class="text-sm text-gray-600">Route berikut bisa diakses publik (tanpa login). Gunakan nama ini untuk menambah menu/link.</p>
                <div class="grid md:grid-cols-2 gap-3">
                    @forelse($publicRoutes as $route)
                        <div class="p-3 rounded border border-slate-200 bg-slate-50 space-y-1">
                            <div class="text-sm font-semibold text-gray-900">{{ $labels[$route['name']] ?? ucfirst(str_replace('.', ' ', $route['name'])) }}</div>
                            <div class="text-xs text-gray-600">Path: /{{ $route['uri'] }}</div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-sm">Tidak ada route publik terdaftar.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
