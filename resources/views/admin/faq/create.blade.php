@extends('layouts.admin')

@section('title', 'Tambah FAQ')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.faq.index') }}" class="text-sm text-blue-600 hover:underline flex items-center">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Kembali ke Daftar FAQ
        </a>
        <h1 class="text-2xl font-bold text-gray-800 mt-2">Tambah FAQ</h1>
    </div>

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.faq.store') }}" method="POST" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Pertanyaan <span class="text-red-500">*</span></label>
            <input type="text" name="question" value="{{ old('question') }}" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" placeholder="Contoh: Apa saja jurusan di SMK BPPI?">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Jawaban <span class="text-red-500">*</span></label>
            <textarea name="answer" rows="6" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" placeholder="Tulis jawaban lengkap di sini...">{{ old('answer') }}</textarea>
        </div>

        <div class="pt-4 border-t border-gray-100">
            <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition shadow-sm">
                Simpan FAQ
            </button>
        </div>
    </form>
@endsection