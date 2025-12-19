<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $program->title }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 space-y-3">
                <div class="text-sm text-gray-600">Status: {{ ucfirst($program->status) }} | Unggulan: {{ $program->is_featured ? 'Ya' : 'Tidak' }}</div>
                <div class="prose max-w-none">
                    {!! nl2br(e($program->description)) !!}
                </div>
                @if($program->cta_label)
                    <div class="text-sm text-gray-700">CTA: {{ $program->cta_label }} → {{ $program->cta_link }}</div>
                @endif
                <a href="{{ route('admin.programs.edit', $program) }}" class="text-indigo-600 hover:underline">Edit</a>
            </div>
        </div>
    </div>
</x-app-layout>
