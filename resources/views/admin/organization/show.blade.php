<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $member->name }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 space-y-3">
                <div class="text-gray-700">Jabatan: {{ $member->position }}</div>
                <div class="text-gray-700">Bio: {{ $member->bio }}</div>
                <div class="text-gray-700">Urutan: {{ $member->sort_order }}</div>
                <a href="{{ route('admin.organization.edit', $member) }}" class="text-indigo-600 hover:underline">Edit</a>
            </div>
        </div>
    </div>
</x-app-layout>
