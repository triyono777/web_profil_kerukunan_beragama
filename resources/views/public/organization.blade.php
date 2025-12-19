@extends('layouts.public')

@section('title', 'Struktur Organisasi | '.($sharedSettings->site_name ?? 'Kerukunan'))

@section('content')
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-6">
        <div class="space-y-2">
            <span class="pill-theme">Struktur Organisasi</span>
            <h1 class="text-3xl font-bold text-slate-900">Tim & Peran</h1>
            <p class="text-slate-700">Susunan anggota aktif yang menjalankan program dan layanan.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-4">
            @forelse($members as $member)
                @php
                    $placeholder = 'data:image/svg+xml;utf8,<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"240\" height=\"240\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"%2394a3b8\" stroke-width=\"1.5\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><circle cx=\"12\" cy=\"7\" r=\"4\" fill=\"%23cbd5e1\"/><path d=\"M5 21a7 7 0 0 1 14 0\" fill=\"%23e2e8f0\"/></svg>';
                    $photo = $member->photo_path ? asset('storage/'.$member->photo_path) : $placeholder;
                @endphp
                <div class="card-theme p-4 flex items-start gap-3">
                    <img src="{{ $photo }}" alt="{{ $member->name }}" class="h-16 w-16 rounded-full object-cover border border-slate-200 bg-slate-100">
                    <div>
                        <div class="text-lg font-semibold text-slate-900">{{ $member->name }}</div>
                        <div class="text-sm text-slate-600">{{ $member->position }}</div>
                        @if($member->bio)
                            <p class="text-sm text-slate-700 mt-2">{{ $member->bio }}</p>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-slate-600">Belum ada data struktur organisasi.</p>
            @endforelse
        </div>
    </section>
@endsection
