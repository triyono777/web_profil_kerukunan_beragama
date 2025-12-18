@extends('layouts.public')

@section('title', 'Galeri | '.($sharedSettings->site_name ?? 'Kerukunan'))

@section('content')
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-6">
        <div class="space-y-2">
            <p class="text-sm text-indigo-700 uppercase tracking-wide">Galeri</p>
            <h1 class="text-3xl font-bold text-slate-900">Dokumentasi Kegiatan</h1>
        </div>

        <div class="grid md:grid-cols-4 gap-4">
            @forelse($media as $item)
                <div class="rounded-xl border border-slate-200 bg-white shadow-sm p-3 space-y-2">
                    <div class="text-xs text-slate-500">{{ ucfirst($item->type) }}</div>
                    <div class="font-semibold text-slate-900">{{ $item->title }}</div>
                    <div class="text-sm text-slate-600 line-clamp-3">{{ $item->description }}</div>
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
