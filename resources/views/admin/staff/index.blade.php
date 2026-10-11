@extends('layouts.admin')

@section('title', 'Kelola Tim Sekolah')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Kelola Tim Sekolah</h1>
            <p class="text-gray-500 text-sm mt-1">Total {{ $staff->total() }} anggota terdaftar.</p>
        </div>
        <a href="{{ route('admin.staff.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition shadow-sm">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Staff
        </a>
    </div>

    @if (session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @forelse ($staff as $item)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden group">
                <div class="relative">
                    @if($item->photo)
                        <img src="{{ asset('storage/' . $item->photo) }}" class="w-full h-56 object-cover group-hover:scale-105 transition duration-300">
                    @else
                        <div class="w-full h-56 bg-gray-100 flex items-center justify-center text-gray-400">
                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                    @endif
                    <div class="absolute top-2 right-2 flex space-x-1 opacity-0 group-hover:opacity-100 transition">
                        <a href="{{ route('admin.staff.edit', $item->id) }}" class="p-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 shadow-lg" title="Edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </a>
                        <form action="{{ route('admin.staff.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus staff ini?')">
                            @csrf @method('DELETE')
                            <button class="p-2 bg-red-600 text-white rounded-lg hover:bg-red-700 shadow-lg" title="Hapus">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="p-3 text-center">
                    <p class="font-semibold text-gray-800 text-sm truncate">{{ $item->name }}</p>
                    <p class="text-xs text-gray-500 truncate mt-1">{{ $item->position }}</p>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12 text-gray-400 bg-white rounded-xl border border-gray-100">
                <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Belum ada data staff. Klik tombol "Tambah Staff" untuk memulai.
            </div>
        @endforelse
    </div>

    @if ($staff->hasPages())
        <div class="mt-6">{{ $staff->links() }}</div>
    @endif
@endsection