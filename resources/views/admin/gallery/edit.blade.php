@extends('layouts.admin')
@section('title', 'Edit Foto Galeri')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.gallery.index') }}" class="text-sm text-blue-600 hover:underline">← Kembali</a>
        <h1 class="text-2xl font-bold text-gray-800 mt-2">Edit Foto Galeri</h1>
    </div>

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg">
            <ul class="list-disc list-inside text-sm">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('admin.gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-5">
        @csrf @method('PUT')
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Judul Foto <span class="text-red-500">*</span></label>
            <input type="text" name="title" value="{{ old('title', $gallery->title) }}" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
            <textarea name="description" rows="3" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">{{ old('description', $gallery->description) }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Foto Saat Ini</label>
            <img src="{{ asset('storage/' . $gallery->image) }}" class="w-48 h-32 object-cover rounded-lg border border-gray-200 mb-3">
            <label class="block text-sm font-medium text-gray-700 mb-2">Ganti Foto (Opsional)</label>
            <input type="file" name="image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-50 file:text-blue-600 hover:file:bg-blue-100">
        </div>
        <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700">Perbarui</button>
    </form>
@endsection