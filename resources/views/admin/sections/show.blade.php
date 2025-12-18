<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Section</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 space-y-3">
                <div class="text-sm text-gray-600">Halaman: {{ $section->page_key }} | Kunci: {{ $section->section_key }}</div>
                <h3 class="text-xl font-semibold text-gray-900">{{ $section->title }}</h3>
                <div class="prose max-w-none">
                    {!! nl2br(e($section->content)) !!}
                </div>
                @if($section->json_data)
                    <pre class="bg-gray-50 p-3 rounded text-xs">{{ json_encode($section->json_data, JSON_PRETTY_PRINT) }}</pre>
                @endif
                <a href="{{ route('admin.sections.edit', $section) }}" class="text-indigo-600 hover:underline">Edit</a>
            </div>
        </div>
    </div>
</x-app-layout>
