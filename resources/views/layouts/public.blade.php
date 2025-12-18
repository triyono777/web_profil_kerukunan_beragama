<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', optional($sharedSettings)->site_name ?? config('app.name'))</title>
    @stack('meta')
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=manrope:400,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-900">
    <div class="min-h-screen flex flex-col">
        <header class="backdrop-blur bg-white/80 border-b border-slate-200 sticky top-0 z-30">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
                <a href="{{ route('home') }}" class="text-lg font-semibold tracking-tight">
                    {{ optional($sharedSettings)->site_name ?? 'Kerukunan' }}
                </a>
                <nav class="hidden md:flex items-center gap-6 text-sm font-medium">
                    @foreach($sharedMenus ?? [] as $menu)
                        @if($menu->children->isNotEmpty())
                            <div class="relative group">
                                <button class="flex items-center gap-1">
                                    {{ $menu->label }}
                                    <span class="text-xs">▾</span>
                                </button>
                                <div class="absolute left-0 mt-2 hidden group-hover:block bg-white shadow-lg rounded border p-3 space-y-2">
                                    @foreach($menu->children as $child)
                                        <a href="{{ $child->url }}" class="block hover:text-indigo-600">{{ $child->label }}</a>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <a href="{{ $menu->url }}" class="hover:text-indigo-600">{{ $menu->label }}</a>
                        @endif
                    @endforeach
                </nav>
                <div class="md:hidden">
                    <button id="mobile-menu-toggle" class="p-2 rounded border border-slate-200">Menu</button>
                </div>
            </div>
            <div id="mobile-menu" class="hidden md:hidden border-t border-slate-200 bg-white px-4 pb-4 space-y-2">
                @foreach($sharedMenus ?? [] as $menu)
                    <a href="{{ $menu->url }}" class="block py-1">{{ $menu->label }}</a>
                    @foreach($menu->children as $child)
                        <a href="{{ $child->url }}" class="block pl-4 py-1 text-sm text-slate-600">- {{ $child->label }}</a>
                    @endforeach
                @endforeach
            </div>
        </header>

        <main class="flex-1">
            @yield('content')
        </main>

        <footer class="bg-slate-900 text-slate-100 mt-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 grid md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-3">Kontak</h3>
                    <p class="text-sm leading-relaxed">{{ optional($sharedFooter)->address ?? $sharedSettings->contact_address }}</p>
                    <p class="text-sm mt-2">Telp: {{ optional($sharedFooter)->phone ?? $sharedSettings->contact_phone }}</p>
                    <p class="text-sm">Email: {{ optional($sharedFooter)->email ?? $sharedSettings->contact_email }}</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-3">Sosial</h3>
                    <div class="space-y-2 text-sm">
                        @foreach((optional($sharedFooter)->social_links ?? []) as $link)
                            <a href="{{ $link['url'] }}" class="block hover:text-indigo-300">{{ $link['platform'] }}</a>
                        @endforeach
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-3">Link Cepat</h3>
                    <div class="space-y-2 text-sm">
                        @foreach((optional($sharedFooter)->quick_links ?? []) as $link)
                            <a href="{{ $link['url'] }}" class="block hover:text-indigo-300">{{ $link['label'] }}</a>
                        @endforeach
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-3">Lokasi</h3>
                    <div class="text-sm text-slate-200">{!! optional($sharedFooter)->map_embed ?? $sharedSettings->map_embed !!}</div>
                </div>
            </div>
            <div class="border-t border-slate-800 text-center py-4 text-sm text-slate-400">
                {{ optional($sharedFooter)->copyright_text ?? '© '.date('Y').' Portal Kerukunan' }}
            </div>
        </footer>
    </div>

    <script>
        const toggle = document.getElementById('mobile-menu-toggle');
        const menu = document.getElementById('mobile-menu');
        if (toggle && menu) {
            toggle.addEventListener('click', () => menu.classList.toggle('hidden'));
        }
    </script>
</body>
</html>
