@extends('layouts.public')

@push('meta')
    <meta property="og:title" content="{{ $post->meta_title ?? $post->title }}">
    <meta property="og:description" content="{{ $post->meta_description ?? $post->excerpt }}">
    @if($post->cover_image)
        <meta property="og:image" content="{{ asset('storage/'.$post->cover_image) }}">
    @endif
@endpush

@section('title', ($post->meta_title ?? $post->title).' | '.$sharedSettings->site_name)

@section('content')
    <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-6">
        <div class="space-y-2">
            <p class="text-sm text-indigo-700 uppercase tracking-wide">Berita</p>
            <h1 class="text-3xl font-bold text-slate-900">{{ $post->title }}</h1>
            <div class="text-sm text-slate-600 flex items-center gap-3">
                <span>{{ optional($post->published_at)->format('d M Y') }}</span>
                <span>•</span>
                <span>{{ $post->category?->name ?? 'Tanpa kategori' }}</span>
            </div>
            <div class="flex flex-wrap gap-2">
                @foreach($post->tags as $tag)
                    <span class="px-2 py-1 rounded bg-indigo-50 text-indigo-700 text-xs">{{ $tag->name }}</span>
                @endforeach
            </div>
        </div>

        @if($post->cover_image)
            <img src="{{ asset('storage/'.$post->cover_image) }}" alt="{{ $post->title }}" class="rounded-xl w-full object-cover max-h-[420px]">
        @endif

        <article class="prose prose-slate max-w-none">
            {!! $post->content !!}
        </article>

        @if($related->count())
            <div class="pt-6 border-t border-slate-200">
                <h3 class="text-lg font-semibold text-slate-900 mb-3">Berita Terkait</h3>
                <div class="grid md:grid-cols-3 gap-4">
                    @foreach($related as $item)
                        <a href="{{ route('posts.show', $item->slug) }}" class="block p-3 rounded border border-slate-200 hover:border-indigo-200">
                            <div class="text-xs text-slate-500">{{ optional($item->published_at)->format('d M Y') }}</div>
                            <div class="font-semibold text-slate-900">{{ $item->title }}</div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </section>
@endsection
