<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pesan & Aspirasi</h2>
                <p class="text-sm text-gray-600">Pantau pesan masuk dari halaman kontak.</p>
            </div>
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
                                <th class="pb-3">Nama</th>
                                <th class="pb-3">Subjek</th>
                                <th class="pb-3">Status</th>
                                <th class="pb-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($messages as $message)
                                <tr class="border-b last:border-0">
                                    <td class="py-3 font-semibold text-gray-900">{{ $message->name }}</td>
                                    <td class="py-3 text-gray-700">{{ $message->subject ?? '-' }}</td>
                                    <td class="py-3">
                                        <span class="px-2 py-1 rounded text-xs {{ $message->status === 'new' ? 'bg-amber-100 text-amber-800' : 'bg-gray-200 text-gray-700' }}">
                                            {{ ucfirst($message->status) }}
                                        </span>
                                    </td>
                                    <td class="py-3 text-right space-x-2">
                                        <a href="{{ route('admin.messages.show', $message) }}" class="text-sky-600 hover:underline">Buka</a>
                                        <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Hapus pesan ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-6 text-center text-gray-500">Belum ada pesan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $messages->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
