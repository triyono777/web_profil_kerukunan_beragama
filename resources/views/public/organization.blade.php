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
                <div class="card-theme p-4">
                    <div class="chip-theme mb-2">Urutan: {{ $member->sort_order ?? '-' }}</div>
                    <div class="text-lg font-semibold text-slate-900">{{ $member->name }}</div>
                    <div class="text-sm text-slate-600">{{ $member->position }}</div>
                    @if($member->bio)
                        <p class="text-sm text-slate-700 mt-2">{{ $member->bio }}</p>
                    @endif
                </div>
            @empty
                <p class="text-slate-600">Belum ada data struktur organisasi.</p>
            @endforelse
        </div>
    </section>
@endsection
