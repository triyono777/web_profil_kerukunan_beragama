<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pesan dari {{ $message->name }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 space-y-3">
                <div class="text-sm text-gray-600">Email: {{ $message->email ?? '-' }} | Telp: {{ $message->phone ?? '-' }}</div>
                <div class="text-sm text-gray-600">Status: {{ ucfirst($message->status) }}</div>
                <div class="text-lg font-semibold text-gray-900">{{ $message->subject ?? 'Pesan' }}</div>
                <div class="text-gray-700 whitespace-pre-line">{{ $message->message }}</div>

                <form method="POST" action="{{ route('admin.messages.update', $message) }}" class="flex items-center gap-3">
                    @csrf
                    @method('PUT')
                    <select name="status" class="rounded border-gray-300">
                        @foreach(['new' => 'Baru', 'read' => 'Dibaca', 'archived' => 'Arsip'] as $value => $label)
                            <option value="{{ $value }}" @selected($message->status === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded">Update</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
