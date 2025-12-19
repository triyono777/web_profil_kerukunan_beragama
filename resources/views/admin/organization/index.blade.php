<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Struktur Organisasi</h2>
                <p class="text-sm text-gray-600">Atur anggota, jabatan, dan urutan tampil.</p>
            </div>
            <a href="{{ route('admin.organization.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded">Tambah Anggota</a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                @if (session('status'))
                    <div class="mb-4 p-3 rounded bg-emerald-50 text-emerald-700">{{ session('status') }}</div>
                @endif

                <div class="grid md:grid-cols-3 gap-4">
                    @forelse($members as $member)
                        <div class="border rounded p-4 space-y-2">
                            @if($member->photo_path)
                                <img src="{{ asset('storage/'.$member->photo_path) }}" alt="{{ $member->name }}" class="h-32 w-full object-cover rounded">
                            @endif
                            <div class="font-semibold text-gray-900">{{ $member->name }}</div>
                            <div class="text-sm text-gray-600">{{ $member->position }}</div>
                            <div class="text-xs text-gray-500">Urutan: {{ $member->sort_order }}</div>
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.organization.edit', $member) }}" class="text-sky-600 hover:underline text-sm">Edit</a>
                                <form action="{{ route('admin.organization.destroy', $member) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline text-sm" onclick="return confirm('Hapus anggota ini?')">Hapus</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 text-center text-gray-500 py-6">Belum ada data struktur organisasi.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
