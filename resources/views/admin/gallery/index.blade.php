@extends('layouts.admin')
@section('title', 'Kelola Galeri')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Kelola Galeri</h1>
            <p class="text-gray-500 text-sm mt-1">Total {{ $galleries->total() }} foto.</p>
        </div>
        <a href="{{ route('admin.gallery.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition shadow-sm">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Foto
        </a>
    </div>

    @if (session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg">{{ session('success') }}</div>
    @endif

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @forelse ($galleries as $item)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden group">
                <div class="relative">
                    <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-40 object-cover group-hover:scale-105 transition duration-300">
                    <div class="absolute top-2 right-2 flex space-x-1 opacity-0 group-hover:opacity-100 transition">
                        <a href="{{ route('admin.gallery.edit', $item->id) }}" class="p-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 shadow-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </a>
                        <form action="{{ route('admin.gallery.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus foto ini?')">
                            @csrf @method('DELETE')
                            <button class="p-2 bg-red-600 text-white rounded-lg hover:bg-red-700 shadow-lg">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="p-3">
                    <p class="font-medium text-gray-800 text-sm truncate">{{ $item->title }}</p>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12 text-gray-400">Belum ada foto galeri.</div>
        @endforelse
    </div>

    @if ($galleries->hasPages())
        <div class="mt-6">{{ $galleries->links() }}</div>
    @endif
@endsection