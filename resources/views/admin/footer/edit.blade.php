@php
    $socialLinks = old('social_links', $footer->social_links ?? []);
    $quickLinks = old('quick_links', $footer->quick_links ?? []);
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Footer & Kontak Singkat</h2>
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

                <form method="POST" action="{{ route('admin.footer.update') }}" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Alamat</label>
                            <textarea name="address" rows="3" class="mt-1 w-full rounded border-gray-300">{{ old('address', $footer->address) }}</textarea>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Telepon</label>
                                <input type="text" name="phone" value="{{ old('phone', $footer->phone) }}" class="mt-1 w-full rounded border-gray-300">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" value="{{ old('email', $footer->email) }}" class="mt-1 w-full rounded border-gray-300">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">WhatsApp</label>
                                <input type="text" name="whatsapp" value="{{ old('whatsapp', $footer->whatsapp) }}" class="mt-1 w-full rounded border-gray-300">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Copyright</label>
                                <input type="text" name="copyright_text" value="{{ old('copyright_text', $footer->copyright_text) }}" class="mt-1 w-full rounded border-gray-300">
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Embed Map</label>
                        <textarea name="map_embed" rows="3" class="mt-1 w-full rounded border-gray-300">{{ old('map_embed', $footer->map_embed) }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <div class="font-semibold text-gray-800">Social Links</div>
                            @foreach(range(0, max(2, count($socialLinks)-1)) as $i)
                                <div class="grid grid-cols-2 gap-2">
                                    <input type="text" name="social_links[{{ $i }}][platform]" value="{{ $socialLinks[$i]['platform'] ?? '' }}" placeholder="Platform" class="rounded border-gray-300">
                                    <input type="url" name="social_links[{{ $i }}][url]" value="{{ $socialLinks[$i]['url'] ?? '' }}" placeholder="URL" class="rounded border-gray-300">
                                </div>
                            @endforeach
                        </div>
                        <div class="space-y-2">
                            <div class="font-semibold text-gray-800">Quick Links</div>
                            @foreach(range(0, max(2, count($quickLinks)-1)) as $i)
                                <div class="grid grid-cols-2 gap-2">
                                    <input type="text" name="quick_links[{{ $i }}][label]" value="{{ $quickLinks[$i]['label'] ?? '' }}" placeholder="Label" class="rounded border-gray-300">
                                    <input type="text" name="quick_links[{{ $i }}][url]" value="{{ $quickLinks[$i]['url'] ?? '' }}" placeholder="URL" class="rounded border-gray-300">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 pt-2">
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
