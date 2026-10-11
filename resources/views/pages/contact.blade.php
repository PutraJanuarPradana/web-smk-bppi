@extends('layouts.app')

@section('title', 'Kontak')
@section('description', 'Hubungi SMK BPPI Baleendah untuk informasi lebih lanjut')

@section('content')

    <!-- ==================== PAGE HEADER ==================== -->
    <section class="relative py-20 bg-gradient-to-br from-blue-700 to-blue-900 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="1"/></pattern></defs><rect width="100%" height="100%" fill="url(#grid)"/></svg>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center" data-aos="fade-up">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Hubungi Kami</h1>
            <p class="text-blue-100 text-lg max-w-2xl mx-auto">
                Kami siap membantu Anda. Silakan hubungi kami melalui kontak di bawah ini.
            </p>
        </div>
    </section>

    <!-- ==================== BREADCRUMB ==================== -->
    <div class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <nav class="text-sm text-gray-500 flex items-center space-x-2">
                <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Beranda</a>
                <span>/</span>
                <span class="text-gray-800 font-medium">Kontak</span>
            </nav>
        </div>
    </div>

    <!-- ==================== INFORMASI KONTAK ==================== -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Kartu Kontak -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-16">
                
                <!-- Alamat -->
                <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 p-8 text-center group" data-aos="fade-up">
                    <div class="w-16 h-16 mx-auto mb-4 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <h3 class="font-bold text-lg text-gray-800 mb-3">Alamat</h3>
                    <p class="text-gray-600 text-sm leading-relaxed whitespace-pre-line">
                        {{ $settings['address'] ?: 'Alamat belum diatur.' }}
                    </p>
                </div>

                <!-- Email -->
                <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 p-8 text-center group" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-16 h-16 mx-auto mb-4 bg-green-100 text-green-600 rounded-2xl flex items-center justify-center group-hover:bg-green-600 group-hover:text-white transition-colors duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="font-bold text-lg text-gray-800 mb-3">Email</h3>
                    @if(!empty($settings['email']))
                        <a href="mailto:{{ $settings['email'] }}" class="text-gray-600 text-sm hover:text-blue-600 transition break-all">
                            {{ $settings['email'] }}
                        </a>
                    @else
                        <p class="text-gray-400 text-sm">Email belum diatur.</p>
                    @endif
                </div>

                <!-- Telepon -->
                <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 p-8 text-center group" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-16 h-16 mx-auto mb-4 bg-orange-100 text-orange-600 rounded-2xl flex items-center justify-center group-hover:bg-orange-600 group-hover:text-white transition-colors duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                    </div>
                    <h3 class="font-bold text-lg text-gray-800 mb-3">Telepon</h3>
                    @if(!empty($settings['phone']))
                        <a href="tel:{{ $settings['phone'] }}" class="text-gray-600 text-sm hover:text-blue-600 transition">
                            {{ $settings['phone'] }}
                        </a>
                    @else
                        <p class="text-gray-400 text-sm">Telepon belum diatur.</p>
                    @endif
                </div>
            </div>

            <!-- ==================== GOOGLE MAPS ==================== -->
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden mb-16" data-aos="fade-up">
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                        <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Lokasi Kami
                    </h2>
                </div>
                <div class="w-full h-[450px] bg-gray-100 relative">
                    @if(!empty($settings['maps_embed_code']))
                        {{-- PENTING: Gunakan {!! !!} bukan {{ }} agar iframe ter-render --}}
                        <div class="w-full h-full [&>iframe]:w-full [&>iframe]:h-full [&>iframe]:border-0">
                            {!! $settings['maps_embed_code'] !!}
                        </div>
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center text-gray-400">
                            <svg class="w-16 h-16 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
                            <p class="text-sm">Lokasi belum diatur oleh admin.</p>
                            <p class="text-xs mt-1">Silakan isi kode embed Google Maps di halaman pengaturan admin.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- ==================== CTA SOSIAL MEDIA ==================== -->
            @if(!empty($settings['social_instagram']) || !empty($settings['social_tiktok']) || !empty($settings['social_youtube']) || !empty($settings['social_facebook']))
            <div class="text-center" data-aos="fade-up">
                <h3 class="text-xl font-bold text-gray-800 mb-6">Ikuti Kami di Sosial Media</h3>
                <div class="flex justify-center gap-4 flex-wrap">
                    @if(!empty($settings['social_instagram']))
                        <a href="{{ $settings['social_instagram'] }}" target="_blank" 
                           class="inline-flex items-center gap-3 px-6 py-3 bg-gradient-to-r from-pink-500 to-purple-600 text-white font-semibold rounded-lg hover:shadow-lg transition-all duration-300 hover:scale-105">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                            Instagram
                        </a>
                    @endif
                    @if(!empty($settings['social_tiktok']))
                        <a href="{{ $settings['social_tiktok'] }}" target="_blank" 
                           class="inline-flex items-center gap-3 px-6 py-3 bg-gray-900 text-white font-semibold rounded-lg hover:shadow-lg transition-all duration-300 hover:scale-105">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-5.2 1.74 2.89 2.89 0 012.31-4.64 2.93 2.93 0 01.88.13V9.4a6.84 6.84 0 00-1-.05A6.33 6.33 0 005 20.1a6.34 6.34 0 0010.86-4.43v-7a8.16 8.16 0 004.77 1.52v-3.4a4.85 4.85 0 01-1-.1z"/></svg>
                            TikTok
                        </a>
                    @endif
                    @if(!empty($settings['social_youtube']))
                        <a href="{{ $settings['social_youtube'] }}" target="_blank" 
                           class="inline-flex items-center gap-3 px-6 py-3 bg-red-600 text-white font-semibold rounded-lg hover:shadow-lg transition-all duration-300 hover:scale-105">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                            YouTube
                        </a>
                    @endif
                    @if(!empty($settings['social_facebook']))
                        <a href="{{ $settings['social_facebook'] }}" target="_blank" 
                           class="inline-flex items-center gap-3 px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:shadow-lg transition-all duration-300 hover:scale-105">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            Facebook
                        </a>
                    @endif
                </div>
            </div>
            @endif

        </div>
    </section>

@endsection