@extends('layouts.public')

@section('title', 'Agenda | '.($sharedSettings->site_name ?? 'Kerukunan'))

@section('content')
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-6">
        <div class="space-y-2">
            <p class="text-sm text-indigo-700 uppercase tracking-wide">Agenda</p>
            <h1 class="text-3xl font-bold text-slate-900">Agenda Kegiatan</h1>
            <p class="text-slate-700">Ikuti agenda dialog, pelatihan, dan forum kolaborasi.</p>
        </div>

        <div class="space-y-3">
            @forelse($agendas as $agenda)
                <div class="p-4 rounded-xl border border-slate-200 bg-white shadow-sm flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                    <div>
                        <div class="text-xs text-slate-500">{{ optional($agenda->start_at)->format('d M Y H:i') }}</div>
                        <h3 class="text-lg font-semibold text-slate-900">{{ $agenda->title }}</h3>
                        <p class="text-sm text-slate-600">{{ $agenda->description }}</p>
                        <p class="text-sm text-slate-700">Lokasi: {{ $agenda->location ?? '-' }}</p>
                    </div>
                    @if($agenda->registration_link)
                        <a href="{{ $agenda->registration_link }}" class="px-4 py-2 rounded bg-indigo-700 text-white">Daftar</a>
                    @endif
                </div>
            @empty
                <p class="text-slate-600">Belum ada agenda terdekat.</p>
            @endforelse
        </div>

        <div>
            {{ $agendas->links() }}
        </div>
    </section>
@endsection
