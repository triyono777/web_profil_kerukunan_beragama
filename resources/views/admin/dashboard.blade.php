<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dasbor Admin</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid md:grid-cols-4 gap-4">
                <div class="bg-white shadow-sm sm:rounded-lg p-4">
                    <div class="text-sm text-gray-600">Berita</div>
                    <div class="text-2xl font-semibold text-gray-900">{{ $stats['posts']['published'] }} <span class="text-sm text-gray-500">publish</span></div>
                    <div class="text-xs text-gray-500">Draft: {{ $stats['posts']['draft'] }} • Arsip: {{ $stats['posts']['archived'] }}</div>
                </div>
                <div class="bg-white shadow-sm sm:rounded-lg p-4">
                    <div class="text-sm text-gray-600">Pesan Masuk</div>
                    <div class="text-2xl font-semibold text-gray-900">{{ $stats['messages'] }}</div>
                    <div class="text-xs text-gray-500">Belum dibaca</div>
                </div>
                <div class="bg-white shadow-sm sm:rounded-lg p-4">
                    <div class="text-sm text-gray-600">Konten</div>
                    <div class="text-2xl font-semibold text-gray-900">{{ $stats['sections'] }}</div>
                    <div class="text-xs text-gray-500">Menu: {{ $stats['menus'] }} • Halaman: {{ $stats['pages'] }}</div>
                </div>
                <div class="bg-white shadow-sm sm:rounded-lg p-4">
                    <div class="text-sm text-gray-600">Struktur Organisasi</div>
                    <div class="text-2xl font-semibold text-gray-900">{{ $stats['organization'] }}</div>
                    <div class="text-xs text-gray-500">Anggota aktif</div>
                </div>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Berita terbaru</h3>
                    <a href="{{ route('admin.posts.index') }}" class="text-indigo-600 text-sm">Lihat semua</a>
                </div>
                <div class="divide-y">
                    @forelse($latestPosts as $post)
                        <div class="py-3 flex items-center justify-between">
                            <div>
                                <div class="font-semibold text-gray-900">{{ $post->title }}</div>
                                <div class="text-xs text-gray-500">{{ optional($post->published_at)->format('d M Y') ?? '-' }} • {{ ucfirst($post->status) }}</div>
                            </div>
                            <a href="{{ route('admin.posts.edit', $post) }}" class="text-sky-600 text-sm">Edit</a>
                        </div>
                    @empty
                        <p class="text-gray-500 text-sm">Belum ada berita.</p>
                    @endforelse
                </div>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Pesan terbaru</h3>
                    <a href="{{ route('admin.messages.index') }}" class="text-indigo-600 text-sm">Lihat semua</a>
                </div>
                <div class="divide-y">
                    @forelse($latestMessages as $message)
                        <div class="py-3">
                            <div class="font-semibold text-gray-900">{{ $message->name }}</div>
                            <div class="text-sm text-gray-700">{{ $message->subject ?? 'Pesan' }}</div>
                            <div class="text-xs text-gray-500">{{ $message->created_at->format('d M Y H:i') }} | Status: {{ ucfirst($message->status) }}</div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-sm">Belum ada pesan masuk.</p>
                    @endforelse
                </div>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Struktur Organisasi</h3>
                    <a href="{{ route('admin.organization.index') }}" class="text-indigo-600 text-sm">Kelola</a>
                </div>
                <div class="grid md:grid-cols-3 gap-3">
                    @forelse($latestMembers as $member)
                        <div class="p-3 rounded border border-slate-200 bg-slate-50">
                            <div class="text-sm font-semibold text-gray-900">{{ $member->name }}</div>
                            <div class="text-xs text-gray-600">{{ $member->position }}</div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-sm">Belum ada data struktur organisasi.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
