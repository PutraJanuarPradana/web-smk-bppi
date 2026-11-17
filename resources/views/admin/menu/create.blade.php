@extends('layouts.admin')

@section('title', 'Tambah Menu')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.menu.index') }}" class="text-sm text-blue-600 hover:underline flex items-center">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Kembali ke Daftar Menu
        </a>
        <h1 class="text-2xl font-bold text-gray-800 mt-2">Tambah Menu Baru</h1>
    </div>

    {{-- BLOK INI SANGAT PENTING UNTUK MENAMPILKAN ERROR JIKA GAGAL SIMPAN --}}
    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg">
            <p class="font-bold mb-2">Terjadi kesalahan:</p>
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.menu.store') }}" method="POST" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Label Menu <span class="text-red-500">*</span></label>
            <input type="text" name="label" value="{{ old('label') }}" required 
                   placeholder="Contoh: Profil, Berita, Galeri" 
                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">URL / Tujuan <span class="text-red-500">*</span></label>
            <input type="text" name="url" value="{{ old('url') }}" required 
                   placeholder="Contoh: /berita, /profil, /kontak, atau /" 
                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition font-mono text-sm">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Jadikan Sub-menu Dari (Opsional)</label>
            <select name="parent_id" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition bg-white">
                <option value="">-- Jadikan Menu Utama --</option>
                @foreach($parentMenus as $parent)
                    <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
                        {{ $parent->label }}
                    </option>
                @endforeach
            </select>
            <p class="text-xs text-gray-400 mt-2">Pilih menu induk jika ini adalah sub-menu (dropdown).</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Urutan</label>
                <input type="number" name="order" value="{{ old('order', 0) }}" min="0" 
                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <div class="flex items-center h-11">
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" checked class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600 relative"></div>
                        <span class="ml-3 text-sm text-gray-700">Tampilkan di Navbar</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="pt-4 border-t border-gray-100">
            <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition shadow-sm">
                Simpan Menu
            </button>
        </div>
    </form>
@endsection