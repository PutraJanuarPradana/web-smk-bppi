@extends('layouts.admin')

@section('title', 'Program Keahlian')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Program Keahlian</h1>
            <p class="text-gray-500 text-sm mt-1">Total {{ $majors->total() }} jurusan terdaftar.</p>
        </div>
        <a href="{{ route('admin.major.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition shadow-sm">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Jurusan
        </a>
    </div>

    @if (session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        @forelse ($majors as $item)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 text-center group relative hover:shadow-md transition">
                <!-- Tombol Aksi (Muncul saat hover) -->
                <div class="absolute top-3 right-3 flex space-x-1 opacity-0 group-hover:opacity-100 transition">
                    <a href="{{ route('admin.major.edit', $item->id) }}" class="p-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 shadow-lg" title="Edit">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </a>
                    <form action="{{ route('admin.major.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus jurusan ini?')">
                        @csrf @method('DELETE')
                        <button class="p-2 bg-red-600 text-white rounded-lg hover:bg-red-700 shadow-lg" title="Hapus">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </form>
                </div>

                <!-- Icon Jurusan -->
                <div class="w-24 h-24 mx-auto mb-4 flex items-center justify-center">
                    @if($item->icon)
                        <img src="{{ asset('storage/' . $item->icon) }}" class="w-full h-full object-contain">
                    @else
                        <div class="w-full h-full bg-gray-100 rounded-full flex items-center justify-center text-gray-400">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>
                        </div>
                    @endif
                </div>

                <h3 class="font-bold text-gray-800 text-lg">{{ $item->name }}</h3>
                <p class="text-sm text-gray-500 mt-2 line-clamp-3">{{ Str::limit($item->description, 80) }}</p>
            </div>
        @empty
            <div class="col-span-full text-center py-12 text-gray-400 bg-white rounded-xl border border-gray-100">
                <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path></svg>
                Belum ada jurusan. Klik tombol "Tambah Jurusan" untuk memulai.
            </div>
        @endforelse
    </div>

    @if ($majors->hasPages())
        <div class="mt-6">{{ $majors->links() }}</div>
    @endif
@endsection