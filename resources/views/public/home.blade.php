@extends('layouts.public')

@section('title', ($sharedSettings->site_name ?? 'Kerukunan').' | Beranda')

@section('content')
    <section class="bg-gradient-to-br from-indigo-100 via-sky-50 to-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 grid md:grid-cols-2 gap-10 items-center">
            <div class="space-y-4">
                <p class="text-sm uppercase tracking-wide text-indigo-700">Portal Kerukunan</p>
                <h1 class="text-3xl md:text-4xl font-bold text-slate-900 leading-tight">
                    {{ $sharedSettings->hero_title ?? 'Ruang bersama untuk narasi damai' }}
                </h1>
                <p class="text-lg text-slate-700">
                    {{ $sharedSettings->hero_subtitle ?? 'Informasi publik, berita, dan program kolaborasi lintas iman.' }}
                </p>
                <div class="flex flex-wrap gap-3">
                    @if($sharedSettings?->hero_cta_link)
                        <a href="{{ $sharedSettings->hero_cta_link }}" class="px-5 py-3 rounded bg-indigo-700 text-white shadow hover:bg-indigo-800">
                            {{ $sharedSettings->hero_cta_label ?? 'Lihat Agenda' }}
                        </a>
                    @endif
                    <a href="/profil" class="px-5 py-3 rounded border border-indigo-200 text-indigo-700 hover:bg-indigo-50">Profil Singkat</a>
                </div>
            </div>
            <div class="bg-white shadow-xl rounded-xl p-6 border border-indigo-50">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-slate-900">Berita Unggulan</h3>
                    <a href="/berita" class="text-sm text-indigo-600">Lihat semua</a>
                </div>
                <div class="space-y-3">
                    @foreach($featuredPosts as $post)
                        <a href="{{ route('posts.show', $post->slug) }}" class="block p-3 rounded border border-slate-100 hover:border-indigo-200 hover:bg-indigo-50/40">
                            <div class="text-sm text-slate-500">{{ optional($post->published_at)->format('d M Y') }}</div>
                            <div class="font-semibold text-slate-900">{{ $post->title }}</div>
                            <div class="text-sm text-slate-600 line-clamp-2">{{ $post->excerpt }}</div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 grid md:grid-cols-3 gap-6">
        <div class="col-span-2 space-y-6">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold text-slate-900">Berita Terbaru</h2>
                <a href="{{ route('posts.index') }}" class="text-indigo-600 text-sm">Selengkapnya</a>
            </div>
            <div class="grid md:grid-cols-2 gap-4">
                @foreach($latestPosts as $post)
                    <a href="{{ route('posts.show', $post->slug) }}" class="block p-4 rounded border border-slate-200 hover:border-indigo-200 hover:shadow-sm bg-white">
                        <div class="text-xs text-slate-500">{{ optional($post->published_at)->format('d M Y') }}</div>
                        <div class="font-semibold text-slate-900 mt-1">{{ $post->title }}</div>
                        <div class="text-sm text-slate-600 line-clamp-2">{{ $post->excerpt }}</div>
                    </a>
                @endforeach
            </div>

            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-slate-900">Agenda Terdekat</h2>
                    <a href="{{ route('agenda.index') }}" class="text-indigo-600 text-sm">Lihat agenda</a>
                </div>
                <div class="grid md:grid-cols-3 gap-3">
                    @forelse($agenda as $item)
                        <div class="p-4 rounded border border-slate-200 bg-white">
                            <div class="text-xs text-slate-500">{{ optional($item->start_at)->format('d M Y H:i') }}</div>
                            <div class="font-semibold text-slate-900">{{ $item->title }}</div>
                            <div class="text-sm text-slate-600">{{ $item->location }}</div>
                        </div>
                    @empty
                        <p class="text-sm text-slate-500">Belum ada agenda terjadwal.</p>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="space-y-6">
            <div class="bg-white border border-slate-200 rounded-lg p-5 shadow-sm">
                <h3 class="text-lg font-semibold text-slate-900 mb-3">Program Unggulan</h3>
                <div class="space-y-3">
                    @foreach($programs as $program)
                        <div class="p-3 rounded border border-slate-100 bg-slate-50">
                            <div class="font-semibold text-slate-900">{{ $program->title }}</div>
                            <div class="text-sm text-slate-600">{{ $program->excerpt }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="bg-white border border-slate-200 rounded-lg p-5 shadow-sm">
                <h3 class="text-lg font-semibold text-slate-900 mb-3">Nilai & Narasi</h3>
                <div class="space-y-2">
                    @foreach($sections as $section)
                        <div class="p-3 rounded bg-indigo-50 border border-indigo-100">
                            <div class="text-sm font-semibold text-indigo-800">{{ $section->title ?? $section->section_key }}</div>
                            @if($section->json_data && isset($section->json_data['items']))
                                <ul class="text-sm text-indigo-900 list-disc list-inside">
                                    @foreach($section->json_data['items'] as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-sm text-indigo-900">{{ $section->content }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold text-slate-900">Galeri</h2>
            <a href="{{ route('gallery.index') }}" class="text-indigo-600 text-sm">Lihat semua</a>
        </div>
        <div class="grid md:grid-cols-4 gap-4">
            @forelse($gallery as $media)
                <div class="relative rounded-lg overflow-hidden border border-slate-200 bg-white">
                    <div class="p-3">
                        <div class="text-sm font-semibold text-slate-900">{{ $media->title }}</div>
                        <div class="text-xs text-slate-500">{{ ucfirst($media->type) }}</div>
                    </div>
                </div>
            @empty
                <p class="text-sm text-slate-500">Galeri belum tersedia.</p>
            @endforelse
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold text-slate-900">Struktur Organisasi</h2>
            <a href="{{ route('admin.organization.index') }}" class="text-indigo-600 text-sm">Kelola (admin)</a>
        </div>
        <div class="grid md:grid-cols-3 gap-4">
            @forelse($organization as $member)
                <div class="p-4 rounded-xl border border-slate-200 bg-white shadow-sm">
                    <div class="text-sm uppercase tracking-wide text-indigo-700">#{{ $member->sort_order ?? 0 }}</div>
                    <div class="text-lg font-semibold text-slate-900">{{ $member->name }}</div>
                    <div class="text-sm text-slate-600">{{ $member->position }}</div>
                    @if($member->bio)
                        <p class="text-sm text-slate-600 mt-2">{{ $member->bio }}</p>
                    @endif
                </div>
            @empty
                <p class="text-sm text-slate-500">Data struktur organisasi belum tersedia.</p>
            @endforelse
        </div>
    </section>
@endsection
