@extends('layouts.admin')

@section('title', 'Edit Ekstrakurikuler')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.extracurricular.index') }}" class="text-sm text-blue-600 hover:underline flex items-center">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Kembali ke Daftar Eskul
        </a>
        <h1 class="text-2xl font-bold text-gray-800 mt-2">Edit Ekstrakurikuler</h1>
    </div>

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.extracurricular.update', $extracurricular->id) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Kolom Kiri -->
            <div class="md:col-span-2 space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Ekstrakurikuler <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $extracurricular->name) }}" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="description" rows="8" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">{{ old('description', $extracurricular->description) }}</textarea>
                </div>
            </div>

            <!-- Kolom Kanan -->
            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Logo Saat Ini</label>
                    @if($extracurricular->logo)
                        <img src="{{ asset('storage/' . $extracurricular->logo) }}" class="w-32 h-32 object-contain rounded-lg border border-gray-200 mb-3 bg-gray-50 p-2">
                    @else
                        <div class="w-32 h-32 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400 text-sm mb-3">Belum ada logo</div>
                    @endif

                    <label class="block text-sm font-medium text-gray-700 mb-2">Ganti Logo</label>
                    <input type="file" name="logo" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-50 file:text-blue-600 hover:file:bg-blue-100 transition">
                    <p class="text-xs text-gray-400 mt-2">Kosongkan jika tidak ingin mengganti logo.</p>
                </div>

                <div class="pt-4 border-t border-gray-100">
                    <button type="submit" class="w-full px-4 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition shadow-sm">
                        Perbarui Eskul
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection