@extends('layouts.admin')

@section('title', 'Kelola FAQ')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Frequently Asked Questions</h1>
            <p class="text-gray-500 text-sm mt-1">Total {{ $faqs->total() }} pertanyaan terdaftar.</p>
        </div>
        <a href="{{ route('admin.faq.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition shadow-sm">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah FAQ
        </a>
    </div>

    @if (session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="space-y-3">
        @forelse ($faqs as $item)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex justify-between items-start gap-4 hover:shadow-md transition group">
                <div class="flex-1">
                    <div class="flex items-start gap-3">
                        <div class="flex-shrink-0 w-8 h-8 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center font-bold text-sm">?</div>
                        <div>
                            <h3 class="font-semibold text-gray-800">{{ $item->question }}</h3>
                            <p class="text-sm text-gray-500 mt-2 leading-relaxed">{{ $item->answer }}</p>
                        </div>
                    </div>
                </div>
                <div class="flex space-x-2 flex-shrink-0 opacity-0 group-hover:opacity-100 transition">
                    <a href="{{ route('admin.faq.edit', $item->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Edit">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </a>
                    <form action="{{ route('admin.faq.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus FAQ ini?')">
                        @csrf @method('DELETE')
                        <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="text-center py-12 text-gray-400 bg-white rounded-xl border border-gray-100">
                <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Belum ada FAQ. Klik tombol "Tambah FAQ" untuk memulai.
            </div>
        @endforelse
    </div>

    @if ($faqs->hasPages())
        <div class="mt-6">{{ $faqs->links() }}</div>
    @endif
@endsection