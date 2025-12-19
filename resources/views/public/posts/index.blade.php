@extends('layouts.public')

@section('title', 'Berita | '.($sharedSettings->site_name ?? 'Kerukunan'))

@section('content')
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
            <div>
                <p class="text-sm text-indigo-700 uppercase tracking-wide">Kabar Terbaru</p>
                <h1 class="text-3xl font-bold text-slate-900">Berita & Artikel</h1>
            </div>
            <form method="GET" class="flex flex-wrap gap-2">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari berita" class="rounded border-slate-300">
                <select name="category" class="rounded border-slate-300">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->slug }}" @selected(request('category') === $category->slug)>{{ $category->name }}</option>
                    @endforeach
                </select>
                <select name="tag" class="rounded border-slate-300">
                    <option value="">Semua Tag</option>
                    @foreach($tags as $tag)
                        <option value="{{ $tag->slug }}" @selected(request('tag') === $tag->slug)>{{ $tag->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn-theme">Filter</button>
            </form>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            @forelse($posts as $post)
                <article class="bg-white rounded-xl border border-slate-200 shadow-sm p-5 space-y-2">
                    <div class="text-xs text-slate-500">{{ optional($post->published_at)->format('d M Y') }}</div>
                    <a href="{{ route('posts.show', $post->slug) }}" class="block">
                        <h2 class="text-lg font-semibold text-slate-900">{{ $post->title }}</h2>
                        <p class="text-sm text-slate-600 line-clamp-3">{{ $post->excerpt }}</p>
                    </a>
                    <div class="flex flex-wrap gap-2 text-xs text-indigo-700">
                        @foreach($post->tags as $tag)
                            <span class="px-2 py-1 bg-indigo-50 rounded">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                </article>
            @empty
                <p class="text-slate-600">Belum ada berita.</p>
            @endforelse
        </div>

        <div>
            {{ $posts->links() }}
        </div>
    </section>
@endsection
