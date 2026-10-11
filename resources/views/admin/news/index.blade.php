@extends('layouts.admin')

@section('title', 'Kelola Berita')

@section('content')
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Kelola Berita</h1>
            <p class="text-gray-500 text-sm mt-1">Total {{ $news->total() }} berita tersimpan.</p>
        </div>
        <a href="{{ route('admin.news.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition shadow-sm">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Berita
        </a>
    </div>

    <!-- Notifikasi Sukses -->
    @if (session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabel Berita -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-600">
                <thead class="bg-gray-50 text-gray-700 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-3 w-16">No</th>
                        <th class="px-6 py-3 w-24">Gambar</th>
                        <th class="px-6 py-3">Judul</th>
                        <th class="px-6 py-3">Penulis</th>
                        <th class="px-6 py-3">Tanggal</th>
                        <th class="px-6 py-3 text-center w-40">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($news as $index => $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">{{ $news->firstItem() + $index }}</td>
                            <td class="px-6 py-4">
                                @if ($item->thumbnail)
                                    <img src="{{ asset('storage/' . $item->thumbnail) }}" class="w-16 h-12 object-cover rounded-md">
                                @else
                                    <div class="w-16 h-12 bg-gray-200 rounded-md flex items-center justify-center text-gray-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-800">{{ Str::limit($item->title, 50) }}</td>
                            <td class="px-6 py-4">{{ $item->author }}</td>
                            <td class="px-6 py-4">{{ $item->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('admin.news.edit', $item->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>
                                    <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                                <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                Belum ada berita. Klik tombol "Tambah Berita" untuk memulai.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($news->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $news->links() }}
            </div>
        @endif
    </div>
@endsection