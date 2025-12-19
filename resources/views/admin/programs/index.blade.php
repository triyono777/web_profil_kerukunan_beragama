<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Program</h2>
                <p class="text-sm text-gray-600">Daftar program unggulan dan edukasi.</p>
            </div>
            <a href="{{ route('admin.programs.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded">Tambah Program</a>
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
                                <th class="pb-3">Status</th>
                                <th class="pb-3">Unggulan</th>
                                <th class="pb-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($programs as $program)
                                <tr class="border-b last:border-0">
                                    <td class="py-3 font-semibold text-gray-900">{{ $program->title }}</td>
                                    <td class="py-3">
                                        <span class="px-2 py-1 rounded text-xs {{ $program->status === 'published' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-800' }}">
                                            {{ ucfirst($program->status) }}
                                        </span>
                                    </td>
                                    <td class="py-3 text-gray-700">{{ $program->is_featured ? 'Ya' : 'Tidak' }}</td>
                                    <td class="py-3 text-right space-x-2">
                                        <a href="{{ route('admin.programs.edit', $program) }}" class="text-sky-600 hover:underline">Edit</a>
                                        <form action="{{ route('admin.programs.destroy', $program) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Hapus program ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-6 text-center text-gray-500">Belum ada program.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $programs->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
