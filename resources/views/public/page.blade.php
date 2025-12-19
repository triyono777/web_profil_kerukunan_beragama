@extends('layouts.public')

@section('title', ($page->title ?? 'Halaman').' | '.$sharedSettings->site_name)

@section('content')
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-8">
        <div class="space-y-2">
            <p class="text-sm uppercase tracking-wide text-indigo-700">{{ strtoupper($page->key) }}</p>
            <h1 class="text-3xl font-bold text-slate-900">{{ $page->title }}</h1>
            <p class="text-slate-700 leading-relaxed">{!! nl2br(e($page->content)) !!}</p>
        </div>

        @foreach($sections as $section)
            <div class="bg-white border border-slate-200 rounded-lg p-5 shadow-sm">
                <h2 class="text-xl font-semibold text-slate-900 mb-2">{{ $section->title ?? $section->section_key }}</h2>
                @if($section->json_data && isset($section->json_data['items']))
                    <ul class="list-disc list-inside space-y-1 text-slate-700">
                        @foreach($section->json_data['items'] as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                @else
                    <div class="text-slate-700 leading-relaxed">{!! nl2br(e($section->content)) !!}</div>
                @endif
            </div>
        @endforeach
    </section>
@endsection
