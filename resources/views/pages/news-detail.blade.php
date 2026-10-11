@extends('layouts.app')

@section('title', $newsItem->title)
@section('description', Str::limit(strip_tags($newsItem->content), 160))

@section('content')

    <!-- ==================== PAGE HEADER ==================== -->
    <section class="relative py-20 bg-gradient-to-br from-blue-700 to-blue-900 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="1"/></pattern></defs><rect width="100%" height="100%" fill="url(#grid)"/></svg>
        </div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center" data-aos="fade-up">
            <span class="inline-block px-4 py-1.5 bg-blue-600/90 backdrop-blur rounded-full text-xs font-semibold uppercase tracking-wider text-white mb-4">
                Berita
            </span>
            <h1 class="text-3xl md:text-5xl font-bold text-white mb-6 leading-tight">
                {{ $newsItem->title }}
            </h1>
            <div class="flex items-center justify-center text-sm text-blue-100 space-x-4">
                <span class="flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    {{ $newsItem->author }}
                </span>
                <span>•</span>
                <span class="flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    {{ $newsItem->created_at->format('d F Y') }}
                </span>
            </div>
        </div>
    </section>

    <!-- ==================== BREADCRUMB ==================== -->
    <div class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <nav class="text-sm text-gray-500 flex items-center space-x-2 flex-wrap">
                <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Beranda</a>
                <span>/</span>
                <a href="{{ route('news.index') }}" class="hover:text-blue-600 transition">Berita</a>
                <span>/</span>
                <span class="text-gray-800 font-medium truncate max-w-[200px]">{{ Str::limit($newsItem->title, 40) }}</span>
            </nav>
        </div>
    </div>

    <!-- ==================== KONTEN BERITA ==================== -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                
                <!-- KOLOM KIRI: Artikel Utama -->
                <article class="lg:col-span-2" data-aos="fade-right">
                    <!-- Thumbnail -->
                    @if($newsItem->thumbnail)
                        <div class="rounded-2xl overflow-hidden shadow-md mb-8">
                            <img src="{{ asset('storage/' . $newsItem->thumbnail) }}" 
                                 class="w-full h-auto object-cover" 
                                 alt="{{ $newsItem->title }}">
                        </div>
                    @endif

                    <!-- Konten -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-10">
                        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed whitespace-pre-line">
                            {{ $newsItem->content }}
                        </div>
                    </div>

                    <!-- Share -->
                    <div class="mt-6 p-6 bg-white rounded-2xl shadow-sm border border-gray-100">
                        <div class="flex items-center justify-between flex-wrap gap-4">
                            <span class="font-semibold text-gray-700">Bagikan berita ini:</span>
                            <div class="flex space-x-2">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="p-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                </a>
                                <a href="https://wa.me/?text={{ urlencode($newsItem->title . ' - ' . url()->current()) }}" target="_blank" class="p-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/></svg>
                                </a>
                                <button onclick="navigator.clipboard.writeText('{{ url()->current() }}'); alert('Link berhasil disalin!')" class="p-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- KOLOM KANAN: Sidebar -->
                <aside class="lg:col-span-1 space-y-6" data-aos="fade-left">
                    <!-- Berita Terkait -->
                    @if($relatedNews->count() > 0)
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                            <h3 class="font-bold text-lg text-gray-800 mb-4 pb-3 border-b border-gray-100">
                                Berita Terkait
                            </h3>
                            <div class="space-y-4">
                                @foreach($relatedNews as $related)
                                    <a href="{{ route('news.detail', $related->slug) }}" class="flex gap-3 group">
                                        <div class="w-20 h-16 rounded-lg overflow-hidden flex-shrink-0 bg-gray-100">
                                            @if($related->thumbnail)
                                                <img src="{{ asset('storage/' . $related->thumbnail) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-gray-300">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h4 class="font-semibold text-sm text-gray-800 line-clamp-2 group-hover:text-blue-600 transition">{{ $related->title }}</h4>
                                            <p class="text-xs text-gray-400 mt-1">{{ $related->created_at->format('d M Y') }}</p>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- CTA Sidebar -->
                    <div class="bg-gradient-to-br from-blue-600 to-blue-800 rounded-2xl shadow-md p-6 text-white">
                        <h3 class="font-bold text-lg mb-2">Punya Pertanyaan?</h3>
                        <p class="text-sm text-blue-100 mb-4">Hubungi kami untuk informasi lebih lanjut tentang SMK BPPI Baleendah.</p>
                        <a href="{{ route('contact') }}" class="inline-flex items-center justify-center w-full px-4 py-2.5 bg-white text-blue-600 font-semibold rounded-lg hover:bg-gray-100 transition text-sm">
                            Hubungi Kami
                        </a>
                    </div>

                    <!-- Tombol Kembali -->
                    <a href="{{ route('news.index') }}" class="flex items-center justify-center w-full px-4 py-3 bg-white border-2 border-blue-600 text-blue-600 font-semibold rounded-lg hover:bg-blue-50 transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        Kembali ke Daftar Berita
                    </a>
                </aside>
            </div>
        </div>
    </section>

@endsection