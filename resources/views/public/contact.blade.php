@extends('layouts.public')

@section('title', 'Kontak | '.($sharedSettings->site_name ?? 'Kerukunan'))

@section('content')
    <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-8">
        <div class="space-y-2">
            <p class="text-sm text-indigo-700 uppercase tracking-wide">Kontak</p>
            <h1 class="text-3xl font-bold text-slate-900">Sampaikan Aspirasi</h1>
            <p class="text-slate-700">Hubungi kami untuk kolaborasi, pertanyaan, atau masukan.</p>
        </div>

        @if (session('status'))
            <div class="p-3 rounded bg-emerald-50 text-emerald-700">{{ session('status') }}</div>
        @endif

        <div class="grid md:grid-cols-2 gap-8">
            <div class="space-y-3">
                <h3 class="text-xl font-semibold text-slate-900">Kontak Resmi</h3>
                <p class="text-slate-700">{{ optional($sharedSettings)->contact_address }}</p>
                <p class="text-slate-700">Email: {{ optional($sharedSettings)->contact_email }}</p>
                <p class="text-slate-700">Telp: {{ optional($sharedSettings)->contact_phone }}</p>
                <p class="text-slate-700">Jam layanan: {{ optional($sharedSettings)->office_hours }}</p>
                <div class="mt-4">{!! optional($sharedSettings)->map_embed !!}</div>
            </div>

            <form method="POST" action="{{ route('contact.store') }}" class="bg-white border border-slate-200 rounded-xl p-6 shadow-sm space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-slate-700">Nama</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="mt-1 w-full rounded border-slate-300" required>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="mt-1 w-full rounded border-slate-300">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Telepon/WhatsApp</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" class="mt-1 w-full rounded border-slate-300">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700">Subjek</label>
                    <input type="text" name="subject" value="{{ old('subject') }}" class="mt-1 w-full rounded border-slate-300">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700">Pesan</label>
                    <textarea name="message" rows="5" class="mt-1 w-full rounded border-slate-300" required>{{ old('message') }}</textarea>
                </div>
                <button type="submit" class="btn-theme">Kirim Pesan</button>
            </form>
        </div>
    </section>
@endsection
