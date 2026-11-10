@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

    <!-- ==================== CINEMATIC INTRO OVERLAY ==================== -->
    <div id="intro-overlay" class="fixed inset-0 z-[9999] overflow-hidden bg-[#1C3C7F]">
        
        <!-- 1. Layer Video Background (Tersembunyi di awal) -->
        <div id="intro-bg-video" class="absolute inset-0 opacity-0">
            @if(!empty($settings['hero_video_url']))
                @php
                    $isYouTube = str_contains($settings['hero_video_url'], 'youtube.com') || str_contains($settings['hero_video_url'], 'youtu.be');
                    $youtubeId = '';
                    if ($isYouTube) {
                        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $settings['hero_video_url'], $matches);
                        $youtubeId = $matches[1] ?? '';
                    }
                @endphp

                @if($isYouTube && $youtubeId)
                    <iframe class="absolute top-1/2 left-1/2 w-[150vw] h-[150vh] -translate-x-1/2 -translate-y-1/2 pointer-events-none" 
                            src="https://www.youtube.com/embed/{{ $youtubeId }}?autoplay=1&mute=1&loop=1&playlist={{ $youtubeId }}&controls=0&showinfo=0&rel=0&modestbranding=1" 
                            frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                @else
                    <video autoplay loop muted playsinline class="absolute inset-0 w-full h-full object-cover">
                        <source src="{{ $settings['hero_video_url'] }}" type="video/mp4">
                    </video>
                @endif
            @else
                <!-- Fallback video laut jika admin belum isi video -->
                <div class="absolute inset-0 bg-gradient-to-b from-blue-800 to-blue-950"></div>
                <video autoplay loop muted playsinline class="absolute inset-0 w-full h-full object-cover">
                    <source src="https://assets.mixkit.co/videos/preview/mixkit-waves-in-the-water-1164-large.mp4" type="video/mp4">
                </video>
            @endif
            <!-- Overlay gelap tipis untuk video -->
            <div class="absolute inset-0 bg-black/30"></div>
        </div>

        <!-- 2. Layer Biru Solid (Awalnya menutupi video) -->
        <div id="intro-blue-cover" class="absolute inset-0 bg-[#1C3C7F]"></div>

        <!-- 3. Logo & Teks di Tengah -->
        <div id="intro-logo" class="absolute inset-0 flex items-center justify-center opacity-0 transform scale-90">
            <!-- Wrapper flex-col agar Logo di atas, Teks di bawah -->
            <div class="flex flex-col items-center justify-center">
                @if(!empty($settings['site_logo']))
                    <img id="intro-logo-img" src="{{ asset('storage/' . $settings['site_logo']) }}" class="w-24 md:w-32 object-contain drop-shadow-2xl">
                @else
                    <div id="intro-logo-img" class="w-24 h-24 md:w-32 md:h-32 bg-blue-600 rounded-2xl flex items-center justify-center text-white font-bold text-3xl md:text-4xl shadow-xl">BPPI</div>
                @endif
                
                <!-- Teks di bawah logo -->
                <h1 id="intro-text" class="mt-6 text-white font-bold text-3xl md:text-5xl tracking-widest drop-shadow-2xl">SMK BPPI</h1>
            </div>
        </div>

        <!-- 4. Teks Petunjuk Scroll -->
        <div id="intro-scroll-text" class="absolute bottom-12 w-full text-center text-white/60 text-sm tracking-widest animate-pulse">
            Scroll ke bawah untuk masuk
        </div>
    </div>

    <!-- ==================== KONTEN UTAMA (Tersembunyi di awal) ==================== -->
    <div id="user-content" class="opacity-0 translate-y-10">

        <!-- ==================== HERO SECTION (VIDEO) ==================== -->
        <section class="relative h-screen min-h-[600px] w-full overflow-hidden flex items-center justify-center">
            <!-- Video Background -->
            @if(!empty($settings['hero_video_url']))
                @php
                    $isYouTube = str_contains($settings['hero_video_url'], 'youtube.com') || str_contains($settings['hero_video_url'], 'youtu.be');
                    $youtubeId = '';
                    if ($isYouTube) {
                        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $settings['hero_video_url'], $matches);
                        $youtubeId = $matches[1] ?? '';
                    }
                @endphp

                @if($isYouTube && $youtubeId)
                    <div class="absolute inset-0 z-0">
                        <iframe 
                            class="absolute top-1/2 left-1/2 w-[150vw] h-[150vh] min-w-full min-h-full -translate-x-1/2 -translate-y-1/2 pointer-events-none"
                            src="https://www.youtube.com/embed/{{ $youtubeId }}?autoplay=1&mute=1&loop=1&playlist={{ $youtubeId }}&controls=0&showinfo=0&rel=0&modestbranding=1"
                            frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
                        </iframe>
                    </div>
                @else
                    <video autoplay loop muted playsinline class="absolute inset-0 w-full h-full object-cover z-0">
                        <source src="{{ $settings['hero_video_url'] }}" type="video/mp4">
                    </video>
                @endif
            @else
                <div class="absolute inset-0 bg-gradient-to-br from-blue-700 via-blue-600 to-blue-800 z-0"></div>
            @endif

            <div class="absolute inset-0 bg-black/50 z-10"></div>

            <!-- Konten Hero -->
            <div class="relative z-20 text-center text-white px-4 max-w-4xl mx-auto" data-aos="fade-up">
                <div class="mb-6 inline-block">
                    <span class="px-4 py-1.5 bg-blue-600/90 backdrop-blur rounded-full text-xs font-semibold uppercase tracking-wider">
                        Website Resmi
                    </span>
                </div>
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold mb-6 leading-tight drop-shadow-lg">
                    {{ $settings['hero_title'] }}
                </h1>
                <p class="text-lg md:text-2xl text-gray-200 mb-10 max-w-2xl mx-auto">
                    {{ $settings['hero_subtitle'] }}
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#tentang" class="inline-flex items-center justify-center px-8 py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 group">
                        Jelajahi Sekolah
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                    <a href="{{ route('contact') }}" class="inline-flex items-center justify-center px-8 py-3.5 bg-white/10 backdrop-blur border border-white/30 hover:bg-white/20 text-white font-semibold rounded-lg transition-all duration-300">
                        Hubungi Kami
                    </a>
                </div>
            </div>

            <!-- Scroll Indicator -->
            <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-20 animate-bounce">
                <svg class="w-6 h-6 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
            </div>
        </section>

        <!-- ==================== TENTANG KAMI ==================== -->
        <section id="tentang" class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div data-aos="fade-right">
                        <span class="text-blue-600 font-semibold text-sm uppercase tracking-wider">Tentang Kami</span>
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mt-2 mb-6 leading-tight">
                            {{ $settings['about_title'] }}
                        </h2>
                        <div class="prose max-w-none text-gray-600 leading-relaxed whitespace-pre-line">
                            {{ $settings['about_text'] ?: 'SMK BPPI Baleendah merupakan sekolah menengah kejuruan yang berkomitmen mencetak lulusan berkompeten, berkarakter, dan siap menghadapi dunia kerja.' }}
                        </div>
                        
                        <div class="mt-8 grid grid-cols-2 gap-4">
                            <div class="p-4 bg-blue-50 rounded-lg">
                                <p class="text-3xl font-bold text-blue-600">2008</p>
                                <p class="text-sm text-gray-600 mt-1">Tahun Berdiri</p>
                            </div>
                            <div class="p-4 bg-green-50 rounded-lg">
                                <p class="text-3xl font-bold text-green-600">4</p>
                                <p class="text-sm text-gray-600 mt-1">Program Keahlian</p>
                            </div>
                        </div>

                        <a href="{{ route('about') }}" class="inline-flex items-center mt-8 text-blue-600 font-semibold hover:text-blue-700 transition group">
                            Pelajari Lebih Lanjut 
                            <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>

                    <!-- Kanan: Google Maps (Ukuran Kotak) -->
                    <div data-aos="fade-left" class="relative">
                        <div class="aspect-square rounded-2xl shadow-2xl overflow-hidden relative bg-gray-100">
                            @if(!empty($settings['maps_embed_code']))
                                <div class="absolute inset-0 [&>iframe]:w-full [&>iframe]:h-full [&>iframe]:border-0">
                                    {!! $settings['maps_embed_code'] !!}
                                </div>
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center">
                                    <div class="text-center text-white p-8">
                                        <div class="w-24 h-24 mx-auto bg-white/20 backdrop-blur rounded-full flex items-center justify-center mb-4">
                                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        </div>
                                        <h3 class="text-2xl font-bold">Lokasi Kami</h3>
                                        <p class="text-blue-100 mt-2">Peta belum diatur oleh admin</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ==================== PROGRAM KEAHLIAN (SLIDER INTERAKTIF) ==================== -->
        @if($majors->count() > 0)
        <section class="relative py-24 bg-white overflow-hidden" 
                 x-data="majorSlider({{ $majors->toJson() }})" 
                 x-init="initSlider()">
            
            <div class="absolute inset-0 opacity-30 pointer-events-none">
                <div class="absolute top-1/2 left-1/4 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[300px] bg-blue-100 blur-[120px] rounded-full"></div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                
                <div class="text-center mb-16" data-aos="fade-up">
                    <span class="text-blue-600 font-semibold text-sm uppercase tracking-wider">Program Keahlian</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mt-2 mb-4">Pilih Masa Depanmu</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center min-h-[450px]">
                    
                    <div class="flex flex-col items-center justify-center space-y-6">
                        <button @click="prevManual()" class="p-3 bg-gray-50 hover:bg-blue-50 border border-gray-200 hover:border-blue-200 rounded-full text-gray-500 hover:text-blue-600 transition-all duration-300 hover:-translate-y-1 z-20 shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
                        </button>

                        <div class="relative w-48 h-48 md:w-64 md:h-64 bg-white border-2 border-gray-100 rounded-3xl shadow-xl shadow-blue-500/10 flex items-center justify-center p-8 overflow-hidden group">
                            <template x-for="(major, index) in majors" :key="index">
                                <div x-show="activeIndex === index" 
                                     x-transition:enter="transition ease-out duration-700"
                                     x-transition:enter-start="opacity-0 translate-y-16 scale-90"
                                     x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                     x-transition:leave="transition ease-in duration-500 absolute inset-0"
                                     x-transition:leave-start="opacity-100 scale-100"
                                     x-transition:leave-end="opacity-0 -translate-y-16 scale-90"
                                     class="w-full h-full flex items-center justify-center">
                                    
                                    <template x-if="major.icon">
                                        <img :src="'/storage/' + major.icon" :alt="major.name" class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-500">
                                    </template>
                                    <template x-if="!major.icon">
                                        <svg class="w-24 h-24 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path></svg>
                                    </template>
                                </div>
                            </template>
                        </div>

                        <button @click="nextManual()" class="p-3 bg-gray-50 hover:bg-blue-50 border border-gray-200 hover:border-blue-200 rounded-full text-gray-500 hover:text-blue-600 transition-all duration-300 hover:translate-y-1 z-20 shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                    </div>

                    <div class="relative">
                        <template x-for="(major, index) in majors" :key="index">
                            <div x-show="activeIndex === index" 
                                 x-transition:enter="transition ease-out duration-700 delay-100"
                                 x-transition:enter-start="opacity-0 translate-x-16"
                                 x-transition:enter-end="opacity-100 translate-x-0"
                                 x-transition:leave="transition ease-in duration-500 absolute inset-0"
                                 x-transition:leave-start="opacity-100 translate-x-0"
                                 x-transition:leave-end="opacity-0 -translate-x-16"
                                 class="space-y-6">
                                
                                <h3 class="text-3xl md:text-5xl font-bold text-gray-800" x-text="major.name"></h3>
                                <p class="text-gray-500 text-lg leading-relaxed line-clamp-4" x-text="major.description || 'Deskripsi jurusan belum tersedia.'"></p>
                                
                                <div class="pt-4">
                                    <a href="{{ route('majors.index') }}" class="inline-flex items-center px-8 py-4 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition shadow-lg shadow-blue-500/30 group">
                                        Lihat Lebih Detail
                                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                    </a>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <div class="mt-16 text-center">
                    <a href="{{ route('majors.index') }}" class="inline-flex items-center px-6 py-3 bg-gray-50 border border-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-100 hover:text-blue-600 transition">
                        Lihat Semua Jurusan
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            </div>

            <script>
                function majorSlider(majorsData) {
                    return {
                        majors: majorsData,
                        activeIndex: 0,
                        timer: null,
                        
                        initSlider() {
                            this.startTimer();
                        },
                        
                        startTimer() {
                            this.timer = setInterval(() => {
                                this.nextAuto();
                            }, 30000);
                        },
                        
                        resetTimer() {
                            clearInterval(this.timer);
                            this.startTimer();
                        },
                        
                        nextAuto() {
                            this.activeIndex = (this.activeIndex + 1) % this.majors.length;
                        },
                        
                        nextManual() {
                            this.activeIndex = (this.activeIndex + 1) % this.majors.length;
                            this.resetTimer();
                        },
                        
                        prevManual() {
                            this.activeIndex = (this.activeIndex - 1 + this.majors.length) % this.majors.length;
                            this.resetTimer();
                        }
                    }
                }
            </script>
        </section>
        @endif

        <!-- ==================== BERITA TERBARU ==================== -->
        @if($news->count() > 0)
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-end mb-12" data-aos="fade-up">
                    <div>
                        <span class="text-blue-600 font-semibold text-sm uppercase tracking-wider">Informasi</span>
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mt-2">Berita Terbaru</h2>
                    </div>
                    <a href="{{ route('news.index') }}" class="hidden md:inline-flex items-center text-blue-600 font-semibold hover:text-blue-700 transition group">
                        Lihat Semua
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($news as $index => $item)
                        <a href="{{ route('news.detail', $item->slug) }}" 
                           class="hover-blur-item block bg-white rounded-2xl shadow-sm hover:shadow-xl overflow-hidden transition-all duration-300 group"
                           data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                            <div class="relative overflow-hidden aspect-video">
                                @if($item->thumbnail)
                                    <img src="{{ asset('storage/' . $item->thumbnail) }}" class="w-full h-full object-cover" alt="{{ $item->title }}">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                                        <svg class="w-16 h-16 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                                <div class="hover-overlay absolute inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center">
                                    <span class="px-4 py-2 border-2 border-white text-white font-semibold rounded-lg">Baca Selengkapnya</span>
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="flex items-center text-xs text-gray-500 mb-3 space-x-3">
                                    <span class="flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        {{ $item->created_at->format('d M Y') }}
                                    </span>
                                    <span>•</span>
                                    <span>{{ $item->author }}</span>
                                </div>
                                <h3 class="font-bold text-lg text-gray-800 mb-2 group-hover:text-blue-600 transition line-clamp-2">{{ $item->title }}</h3>
                                <p class="text-sm text-gray-500 line-clamp-2">{{ Str::limit(strip_tags($item->content), 100) }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        <!-- ==================== EKSTRAKURIKULER ==================== -->
        @if($extracurriculars->count() > 0)
        <section class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-14" data-aos="fade-up">
                    <span class="text-blue-600 font-semibold text-sm uppercase tracking-wider">Pengembangan Diri</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mt-2 mb-4">Ekstrakurikuler</h2>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                    @foreach($extracurriculars as $index => $eskul)
                        <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 p-6 text-center group" data-aos="zoom-in" data-aos-delay="{{ $index * 100 }}">
                            <div class="w-20 h-20 mx-auto mb-4 flex items-center justify-center bg-gray-50 rounded-full overflow-hidden">
                                @if($eskul->logo)
                                    <img src="{{ asset('storage/' . $eskul->logo) }}" class="w-14 h-14 object-contain transition-transform duration-500 group-hover:scale-125">
                                @else
                                    <svg class="w-10 h-10 text-gray-400 transition-transform duration-500 group-hover:scale-125" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                @endif
                            </div>
                            <h3 class="font-bold text-gray-800 group-hover:text-blue-600 transition">{{ $eskul->name }}</h3>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-12">
                    <a href="{{ route('extracurricular.index') }}" class="inline-flex items-center px-6 py-3 bg-white text-blue-600 font-semibold rounded-lg hover:bg-blue-50 transition shadow-sm border border-blue-100">
                        Lihat Semua Eskul
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            </div>
        </section>
        @endif

        <!-- ==================== GALERI PREVIEW ==================== -->
        @if($galleries->count() > 0)
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-end mb-12" data-aos="fade-up">
                    <div>
                        <span class="text-blue-600 font-semibold text-sm uppercase tracking-wider">Dokumentasi</span>
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mt-2">Galeri Kegiatan</h2>
                    </div>
                    <a href="{{ route('gallery.index') }}" class="hidden md:inline-flex items-center text-blue-600 font-semibold hover:text-blue-700 transition group">
                        Lihat Semua
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 gap-3 md:gap-4">
                    @foreach($galleries as $index => $item)
                        <a href="{{ route('gallery.index') }}" class="hover-blur-item group relative overflow-hidden rounded-xl aspect-square block" data-aos="fade-up" data-aos-delay="{{ $index * 80 }}">
                            <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-full object-cover" alt="{{ $item->title }}">
                            <div class="hover-overlay absolute inset-0 bg-black/60 backdrop-blur-sm flex flex-col items-center justify-center text-white p-4">
                                <svg class="w-8 h-8 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                <span class="font-semibold text-sm text-center">{{ $item->title }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        <!-- ==================== CTA / KONTAK ==================== -->
        <section class="py-20 bg-gradient-to-br from-blue-600 to-blue-800 relative overflow-hidden">
            <div class="absolute inset-0 opacity-10">
                <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="1"/></pattern></defs><rect width="100%" height="100%" fill="url(#grid)"/></svg>
            </div>

            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10" data-aos="fade-up">
                <h2 class="text-3xl md:text-5xl font-bold text-white mb-6 leading-tight">Siap Bergabung Bersama Kami?</h2>
                <p class="text-lg text-blue-100 mb-10 max-w-2xl mx-auto">Bergabunglah dengan SMK BPPI Baleendah dan raih masa depan gemilang bersama kami.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('contact') }}" class="inline-flex items-center justify-center px-8 py-3.5 bg-white text-blue-600 font-semibold rounded-lg hover:bg-gray-100 transition shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        Hubungi Kami
                    </a>
                    <a href="{{ route('about') }}" class="inline-flex items-center justify-center px-8 py-3.5 bg-blue-700/50 backdrop-blur border border-white/30 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                        Tentang Sekolah
                    </a>
                </div>
            </div>
        </section>

    </div> <!-- ==================== END OF USER CONTENT ==================== -->

    <!-- ==================== SCRIPT ANIMASI PEMBUKA (GSAP) ==================== -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Kunci scroll body saat intro aktif
            document.body.style.overflow = 'hidden';

            const overlay = document.getElementById('intro-overlay');
            const blueCover = document.getElementById('intro-blue-cover');
            const bgVideo = document.getElementById('intro-bg-video');
            const logoContainer = document.getElementById('intro-logo');
            const logoImg = document.getElementById('intro-logo-img');
            const textElement = document.getElementById('intro-text');
            const scrollText = document.getElementById('intro-scroll-text');
            const content = document.getElementById('user-content');
            
            let isAnimating = false;

            // --- TRIK MEMBAGI TEKS MENJADI PER KARAKTER ---
            const textContent = textElement.innerText;
            textElement.innerHTML = ''; // Kosongkan teks asli
            textContent.split('').forEach(char => {
                const span = document.createElement('span');
                span.innerText = char === ' ' ? '\u00A0' : char; // Spasi menggunakan non-breaking space
                span.style.display = 'inline-block';
                span.classList.add('intro-char');
                textElement.appendChild(span);
            });

            // Animasi awal memunculkan Logo dan Teks
            gsap.to(logoContainer, { opacity: 1, scale: 1, duration: 1.2, ease: "power2.out" });

            function playCinematic() {
                if (isAnimating) return;
                isAnimating = true;

                // Sembunyikan teks petunjuk scroll
                gsap.to(scrollText, { opacity: 0, duration: 0.3 });

                // Timeline Animasi Transisi (Dipicu Scroll)
                const tl = gsap.timeline({
                    onComplete: () => {
                        overlay.style.display = 'none';
                        document.body.style.overflow = 'auto';
                    }
                });

                // 1. Teks berjatuhan ke bawah satu per satu
                tl.to('.intro-char', {
                    y: 100,                  // Turun ke bawah
                    opacity: 0,              // Memudar
                    rotationX: -90,          // Efek 3D jatuh ke belakang
                    transformOrigin: "50% 50% -50",
                    duration: 0.8,
                    stagger: 0.05,           // Jeda antar huruf
                    ease: "back.in(1.7)"
                })
                // 2. Logo membesar (di tengah)
                .to(logoImg, {
                    scale: 1.5,
                    duration: 1.5,
                    ease: "power2.inOut"
                }, "-=0.4")
                // 3. Video Background muncul & Layar Biru memudar
                .to(bgVideo, { opacity: 1, duration: 2, ease: "power2.inOut" }, "-=1")
                .to(blueCover, { opacity: 0, duration: 2, ease: "power2.inOut" }, "-=2")
                // 4. Logo memudar
                .to(logoImg, { opacity: 0, duration: 1, ease: "power2.in" }, "-=1.5")
                .to(overlay, { opacity: 0, duration: 1 })
                // 5. Konten Web Utama muncul
                .to(content, { opacity: 1, y: 0, duration: 1.5, ease: "power2.out" }, "-=0.8");
            }

            // Deteksi Scroll
            window.addEventListener('wheel', playCinematic, { once: true, passive: true });
            window.addEventListener('touchmove', playCinematic, { once: true, passive: true });
        });
    </script>

@endsection