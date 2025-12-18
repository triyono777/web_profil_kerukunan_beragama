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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-3">Route Admin</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="text-left text-gray-600 border-b">
                                <th class="pb-2">Name</th>
                                <th class="pb-2">Method</th>
                                <th class="pb-2">URI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($adminRoutes as $route)
                                <tr class="border-b last:border-0">
                                    <td class="py-2 font-semibold text-gray-900">{{ $route['name'] }}</td>
                                    <td class="py-2 text-gray-700">{{ $route['method'] }}</td>
                                    <td class="py-2 text-gray-700">/{{ $route['uri'] }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="py-3 text-gray-500 text-center">Belum ada route admin terdaftar.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-3">Route Publik</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="text-left text-gray-600 border-b">
                                <th class="pb-2">Name</th>
                                <th class="pb-2">Method</th>
                                <th class="pb-2">URI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($publicRoutes as $route)
                                <tr class="border-b last:border-0">
                                    <td class="py-2 font-semibold text-gray-900">{{ $route['name'] }}</td>
                                    <td class="py-2 text-gray-700">{{ $route['method'] }}</td>
                                    <td class="py-2 text-gray-700">/{{ $route['uri'] }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="py-3 text-gray-500 text-center">Belum ada route publik terdaftar.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
