<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $page->title }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 space-y-3">
                <div class="text-sm text-gray-600">Key: {{ $page->key }} • Status: {{ ucfirst($page->status) }}</div>
                <div class="prose max-w-none">
                    {!! nl2br(e($page->content)) !!}
                </div>
                <a href="{{ route('admin.pages.edit', $page) }}" class="text-indigo-600 hover:underline">Edit halaman</a>
            </div>
        </div>
    </div>
</x-app-layout>
