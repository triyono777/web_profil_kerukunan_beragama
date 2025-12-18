@extends('layouts.public')

@section('title', 'Program | '.($sharedSettings->site_name ?? 'Kerukunan'))

@section('content')
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-6">
        <div class="space-y-2">
            <p class="text-sm text-indigo-700 uppercase tracking-wide">Program</p>
            <h1 class="text-3xl font-bold text-slate-900">Program Unggulan</h1>
            <p class="text-slate-700">Rangkaian program edukasi toleransi dan dialog lintas iman.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-4">
            @forelse($programs as $program)
                <div class="p-5 rounded-xl border border-slate-200 bg-white shadow-sm space-y-2">
                    <div class="text-xs text-indigo-700">{{ $program->is_featured ? 'Unggulan' : 'Program' }}</div>
                    <h3 class="text-lg font-semibold text-slate-900">{{ $program->title }}</h3>
                    <p class="text-sm text-slate-600">{{ $program->excerpt }}</p>
                    @if($program->cta_link)
                        <a href="{{ $program->cta_link }}" class="text-indigo-600 text-sm">Ikuti</a>
                    @endif
                </div>
            @empty
                <p class="text-slate-600">Belum ada program.</p>
            @endforelse
        </div>

        <div>
            {{ $programs->links() }}
        </div>
    </section>
@endsection
