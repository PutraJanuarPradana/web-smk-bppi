@extends('layouts.app')

@section('title', 'Galeri')
@section('description', 'Dokumentasi kegiatan dan fasilitas SMK BPPI Baleendah')

@section('content')

    <!-- ==================== PAGE HEADER ==================== -->
    <section class="relative py-20 bg-gradient-to-br from-blue-700 to-blue-900 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="1"/></pattern></defs><rect width="100%" height="100%" fill="url(#grid)"/></svg>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center" data-aos="fade-up">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Galeri Kegiatan</h1>
            <p class="text-blue-100 text-lg max-w-2xl mx-auto">
                Kumpulan dokumentasi momen berharga dan fasilitas di SMK BPPI Baleendah.
            </p>
        </div>
    </section>

    <!-- ==================== BREADCRUMB ==================== -->
    <div class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <nav class="text-sm text-gray-500 flex items-center space-x-2">
                <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Beranda</a>
                <span>/</span>
                <span class="text-gray-800 font-medium">Galeri</span>
            </nav>
        </div>
    </div>

    <!-- ==================== GRID GALERI ==================== -->
    <section class="py-16 bg-gray-50" x-data="{ 
        modalOpen: false, 
        modalImage: '', 
        modalTitle: '', 
        modalDesc: '' 
    }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($galleries->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 md:gap-4">
                    @foreach($galleries as $index => $item)
                        <div @click="
                                modalOpen = true; 
                                modalImage = '{{ asset('storage/' . $item->image) }}'; 
                                modalTitle = '{{ addslashes($item->title) }}'; 
                                modalDesc = '{{ addslashes($item->description ?? '') }}';
                             "
                             class="hover-blur-item group relative overflow-hidden rounded-xl aspect-square cursor-pointer block"
                             data-aos="fade-up" data-aos-delay="{{ ($index % 8) * 50 }}">
                            
                            <img src="{{ asset('storage/' . $item->image) }}" 
                                 class="w-full h-full object-cover" 
                                 alt="{{ $item->title }}"
                                 loading="lazy">
                            
                            <!-- Overlay Hover Blur -->
                            <div class="hover-overlay absolute inset-0 bg-black/60 backdrop-blur-sm flex flex-col items-center justify-center text-white p-4">
                                <svg class="w-10 h-10 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                                <span class="font-semibold text-sm text-center leading-tight">{{ $item->title }}</span>
                                <span class="text-xs text-gray-300 mt-2">Lihat Lengkap</span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($galleries->hasPages())
                    <div class="mt-12 flex justify-center">
                        {{ $galleries->links() }}
                    </div>
                @endif
            @else
                <div class="text-center py-20 bg-white rounded-2xl border border-gray-100">
                    <svg class="w-20 h-20 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <h3 class="text-xl font-bold text-gray-700 mb-2">Belum Ada Foto</h3>
                    <p class="text-gray-500">Galeri foto akan segera ditambahkan.</p>
                </div>
            @endif
        </div>

        <!-- ==================== MODAL PREVIEW ==================== -->
        <div x-show="modalOpen" 
             x-cloak
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @keydown.escape.window="modalOpen = false"
             @click.self="modalOpen = false"
             class="fixed inset-0 z-[100] bg-black/90 backdrop-blur-md flex items-center justify-center p-4">
            
            <!-- Tombol Close -->
            <button @click="modalOpen = false" 
                    class="absolute top-4 right-4 w-12 h-12 bg-white/10 hover:bg-white/20 backdrop-blur rounded-full flex items-center justify-center text-white transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <!-- Konten Modal -->
            <div x-show="modalOpen"
                 x-transition:enter="transition ease-out duration-300 delay-100"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 class="max-w-5xl w-full max-h-[90vh] flex flex-col">
                
                <div class="bg-white rounded-2xl overflow-hidden shadow-2xl flex flex-col max-h-[90vh]">
                    <div class="flex-1 overflow-hidden bg-black flex items-center justify-center">
                        <img :src="modalImage" 
                             :alt="modalTitle" 
                             class="max-w-full max-h-[70vh] object-contain">
                    </div>
                    <div class="p-6 bg-white">
                        <h3 class="text-xl font-bold text-gray-800" x-text="modalTitle"></h3>
                        <p class="text-sm text-gray-500 mt-2" x-show="modalDesc" x-text="modalDesc"></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection