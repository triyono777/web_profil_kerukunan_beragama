<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Berita</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 space-y-4">
                @if ($errors->any())
                    <div class="p-4 rounded bg-red-50 text-red-700">
                        <strong>Perlu dicek:</strong>
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @include('admin.posts.form', [
                    'action' => route('admin.posts.store'),
                    'post' => null,
                    'categories' => $categories,
                    'tags' => $tags,
                ])
            </div>
        </div>
    </div>
</x-app-layout>
