<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $post->title }}</h2>
                <p class="text-sm text-gray-600">Status: {{ ucfirst($post->status) }} • {{ $post->category?->name ?? 'Tanpa kategori' }}</p>
            </div>
            <a href="{{ route('admin.posts.edit', $post) }}" class="px-4 py-2 bg-indigo-600 text-white rounded">Edit</a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <article class="bg-white shadow-sm sm:rounded-lg p-6 space-y-4">
                @if($post->cover_image)
                    <img src="{{ asset('storage/'.$post->cover_image) }}" alt="Cover" class="w-full h-72 object-cover rounded">
                @endif
                <div class="text-gray-600 text-sm">
                    Terbit: {{ optional($post->published_at)->format('d M Y H:i') ?? '-' }} • Penulis: {{ $post->author?->name }}
                </div>
                <div class="prose max-w-none">{!! $post->content !!}</div>
                @if($post->tags->count())
                    <div class="flex flex-wrap gap-2">
                        @foreach($post->tags as $tag)
                            <span class="px-2 py-1 rounded bg-indigo-50 text-indigo-700 text-xs">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                @endif
            </article>
        </div>
    </div>
</x-app-layout>
