<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $agenda->title }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 space-y-3">
                <div class="text-sm text-gray-600">Jadwal: {{ optional($agenda->start_at)->format('d M Y H:i') }} - {{ optional($agenda->end_at)->format('H:i') }}</div>
                <div class="text-sm text-gray-600">Lokasi: {{ $agenda->location ?? '-' }}</div>
                <div class="prose max-w-none">
                    {!! nl2br(e($agenda->description)) !!}
                </div>
                <a href="{{ route('admin.agendas.edit', $agenda) }}" class="text-indigo-600 hover:underline">Edit</a>
            </div>
        </div>
    </div>
</x-app-layout>
