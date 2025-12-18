@extends('layouts.public')

@section('title', 'Dokumen | '.($sharedSettings->site_name ?? 'Kerukunan'))

@section('content')
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-6">
        <div class="space-y-2">
            <p class="text-sm text-indigo-700 uppercase tracking-wide">Dokumen</p>
            <h1 class="text-3xl font-bold text-slate-900">Unduhan & Pedoman</h1>
        </div>

        <div class="grid md:grid-cols-2 gap-4">
            @forelse($documents as $document)
                <div class="p-4 rounded-xl border border-slate-200 bg-white shadow-sm flex items-center justify-between">
                    <div>
                        <div class="font-semibold text-slate-900">{{ $document->title }}</div>
                        <div class="text-sm text-slate-600">{{ $document->description }}</div>
                    </div>
                    <a href="{{ $document->file_path ? asset('storage/'.$document->file_path) : '#' }}" class="px-3 py-2 rounded bg-indigo-700 text-white text-sm">Unduh</a>
                </div>
            @empty
                <p class="text-slate-600">Belum ada dokumen.</p>
            @endforelse
        </div>

        <div>
            {{ $documents->links() }}
        </div>
    </section>
@endsection
