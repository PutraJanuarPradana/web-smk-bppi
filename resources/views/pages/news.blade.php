@extends('layouts.app')

@section('title', 'Berita')
@section('description', 'Berita dan informasi terbaru dari SMK BPPI Baleendah')

@section('content')

    <!-- ==================== PAGE HEADER ==================== -->
    <section class="relative py-20 bg-gradient-to-br from-blue-700 to-blue-900 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="1"/></pattern></defs><rect width="100%" height="100%" fill="url(#grid)"/></svg>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center" data-aos="fade-up">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Berita & Informasi</h1>
            <p class="text-blue-100 text-lg max-w-2xl mx-auto">
                Ikuti perkembangan dan kegiatan terbaru SMK BPPI Baleendah.
            </p>
        </div>
    </section>

    <!-- ==================== BREADCRUMB ==================== -->
    <div class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <nav class="text-sm text-gray-500 flex items-center space-x-2">
                <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Beranda</a>
                <span>/</span>
                <span class="text-gray-800 font-medium">Berita</span>
            </nav>
        </div>
    </div>

    <!-- ==================== DAFTAR BERITA ==================== -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($news->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($news as $index => $item)
                        <a href="{{ route('news.detail', $item->slug) }}" 
                           class="hover-blur-item group bg-white rounded-2xl shadow-sm hover:shadow-xl overflow-hidden transition-all duration-300 flex flex-col"
                           data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}">
                            
                            <div class="relative overflow-hidden aspect-video">
                                @if($item->thumbnail)
                                    <img src="{{ asset('storage/' . $item->thumbnail) }}" 
                                         class="w-full h-full object-cover" 
                                         alt="{{ $item->title }}">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                                        <svg class="w-16 h-16 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                                <div class="hover-overlay absolute inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center">
                                    <span class="px-4 py-2 border-2 border-white text-white font-semibold rounded-lg">
                                        Baca Selengkapnya
                                    </span>
                                </div>
                            </div>

                            <div class="p-6 flex-1 flex flex-col">
                                <div class="flex items-center text-xs text-gray-500 mb-3 space-x-3">
                                    <span class="flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        {{ $item->created_at->format('d M Y') }}
                                    </span>
                                    <span>•</span>
                                    <span>{{ $item->author }}</span>
                                </div>
                                <h3 class="font-bold text-lg text-gray-800 mb-3 group-hover:text-blue-600 transition line-clamp-2">
                                    {{ $item->title }}
                                </h3>
                                <p class="text-sm text-gray-500 line-clamp-3 flex-1">
                                    {{ Str::limit(strip_tags($item->content), 130) }}
                                </p>
                                <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between">
                                    <span class="text-blue-600 font-semibold text-sm group-hover:underline">Baca Selengkapnya</span>
                                    <svg class="w-4 h-4 text-blue-600 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($news->hasPages())
                    <div class="mt-12 flex justify-center">
                        {{ $news->links() }}
                    </div>
                @endif
            @else
                <!-- Empty State -->
                <div class="text-center py-20 bg-white rounded-2xl border border-gray-100">
                    <svg class="w-20 h-20 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6"></path></svg>
                    <h3 class="text-xl font-bold text-gray-700 mb-2">Belum Ada Berita</h3>
                    <p class="text-gray-500">Silakan kembali lagi nanti untuk melihat berita terbaru.</p>
                </div>
            @endif
        </div>
    </section>

@endsection