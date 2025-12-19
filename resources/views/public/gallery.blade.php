@extends('layouts.public')

@section('title', 'Galeri | '.($sharedSettings->site_name ?? 'Kerukunan'))

@section('content')
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-6">
        <div class="space-y-2">
            <p class="text-sm text-indigo-700 uppercase tracking-wide">Galeri</p>
            <h1 class="text-3xl font-bold text-slate-900">Dokumentasi Kegiatan</h1>
        </div>

        @php
            $placeholder = 'data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="320" height="200" viewBox="0 0 320 200"><rect width="320" height="200" fill="%23e5e7eb"/><g fill="%2394a3b8" font-family="Arial" font-size="16" text-anchor="middle"><text x="160" y="106">Tidak ada gambar</text></g></svg>';
        @endphp

        <div class="grid md:grid-cols-4 gap-4">
            @forelse($media as $item)
                @php
                    $img = $item->thumbnail_url ?? $item->url ?? $placeholder;
                @endphp
                <div class="rounded-xl border border-slate-200 bg-white shadow-sm overflow-hidden">
                    <div class="aspect-video bg-slate-100">
                        <img src="{{ $img }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                    </div>
                    <div class="p-3 space-y-1">
                        <div class="text-xs text-slate-500">{{ ucfirst($item->type) }}</div>
                        <div class="font-semibold text-slate-900">{{ $item->title }}</div>
                        <div class="text-sm text-slate-600 line-clamp-3">{{ $item->description }}</div>
                    </div>
                </div>
            @empty
                <p class="text-slate-600">Galeri belum tersedia.</p>
            @endforelse
        </div>

        <div>
            {{ $media->links() }}
        </div>
    </section>
@endsection
