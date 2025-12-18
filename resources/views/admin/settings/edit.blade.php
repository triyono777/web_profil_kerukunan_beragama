<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pengaturan Situs</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 space-y-6">
                @if (session('status'))
                    <div class="p-3 rounded bg-emerald-50 text-emerald-700">{{ session('status') }}</div>
                @endif
                @if ($errors->any())
                    <div class="p-3 rounded bg-red-50 text-red-700">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Situs</label>
                            <input type="text" name="site_name" value="{{ old('site_name', $siteSetting->site_name) }}" class="mt-1 w-full rounded border-gray-300" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Warna Utama</label>
                            <input type="text" name="primary_color" value="{{ old('primary_color', $siteSetting->primary_color) }}" class="mt-1 w-full rounded border-gray-300" placeholder="#1b4b66">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Logo Header</label>
                            <input type="file" name="logo" accept=".png,.jpg,.jpeg,.webp,.svg" class="mt-1 w-full rounded border-gray-300">
                            @if($siteSetting->logo_path)
                                <img src="{{ asset('storage/'.$siteSetting->logo_path) }}" alt="Logo" class="h-12 mt-2 object-contain">
                            @endif
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Favicon</label>
                            <input type="file" name="favicon" accept=".png,.jpg,.jpeg,.webp,.svg" class="mt-1 w-full rounded border-gray-300">
                            @if($siteSetting->favicon_path)
                                <div class="mt-2 text-sm text-gray-700">Tersimpan: {{ $siteSetting->favicon_path }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email Kontak</label>
                            <input type="email" name="contact_email" value="{{ old('contact_email', $siteSetting->contact_email) }}" class="mt-1 w-full rounded border-gray-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Telepon</label>
                            <input type="text" name="contact_phone" value="{{ old('contact_phone', $siteSetting->contact_phone) }}" class="mt-1 w-full rounded border-gray-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">WhatsApp</label>
                            <input type="text" name="contact_whatsapp" value="{{ old('contact_whatsapp', $siteSetting->contact_whatsapp) }}" class="mt-1 w-full rounded border-gray-300">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Alamat</label>
                        <textarea name="contact_address" rows="3" class="mt-1 w-full rounded border-gray-300">{{ old('contact_address', $siteSetting->contact_address) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jam Layanan</label>
                        <input type="text" name="office_hours" value="{{ old('office_hours', $siteSetting->office_hours) }}" class="mt-1 w-full rounded border-gray-300">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Hero Title</label>
                            <input type="text" name="hero_title" value="{{ old('hero_title', $siteSetting->hero_title) }}" class="mt-1 w-full rounded border-gray-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Hero Subtitle</label>
                            <input type="text" name="hero_subtitle" value="{{ old('hero_subtitle', $siteSetting->hero_subtitle) }}" class="mt-1 w-full rounded border-gray-300">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">CTA Label</label>
                            <input type="text" name="hero_cta_label" value="{{ old('hero_cta_label', $siteSetting->hero_cta_label) }}" class="mt-1 w-full rounded border-gray-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">CTA Link</label>
                            <input type="text" name="hero_cta_link" value="{{ old('hero_cta_link', $siteSetting->hero_cta_link) }}" class="mt-1 w-full rounded border-gray-300">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Map Embed</label>
                        <textarea name="map_embed" rows="3" class="mt-1 w-full rounded border-gray-300">{{ old('map_embed', $siteSetting->map_embed) }}</textarea>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
