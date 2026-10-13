@extends('layouts.app')

@section('title', 'Profil')
@section('description', 'Profil lengkap SMK BPPI Baleendah')

@section('content')
    <!-- PAGE HEADER -->
    <section class="relative py-20 bg-gradient-to-br from-blue-700 to-blue-900 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="1"/></pattern></defs><rect width="100%" height="100%" fill="url(#grid)"/></svg>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center" data-aos="fade-up">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">{{ $settings['about_title'] }}</h1>
            <p class="text-blue-100 text-lg max-w-2xl mx-auto">Hijau Bersih Berkarakter</p>
        </div>
    </section>

    <!-- BREADCRUMB -->
    <div class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <nav class="text-sm text-gray-500 flex items-center space-x-2">
                <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Beranda</a>
                <span>/</span>
                <span class="text-gray-800 font-medium">Profil</span>
            </nav>
        </div>
    </div>

<!-- TENTANG KAMI -->
<section class="py-16 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12" data-aos="fade-up">
            <span class="text-blue-600 font-semibold text-sm uppercase tracking-wider">Tentang Sekolah</span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mt-2">Mengenal SMK BPPI Baleendah</h2>
        </div>

        <!-- Kotak Biru Polos -->
        <div class="relative rounded-2xl shadow-xl overflow-hidden bg-gradient-to-br from-blue-600 to-blue-800" data-aos="fade-up">
            <div class="absolute inset-0 opacity-10">
                <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern id="grid-about" width="40" height="40" patternUnits="userSpaceOnUse">
                            <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="1"/>
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#grid-about)"/>
                </svg>
            </div>
            <div class="relative p-8 md:p-12 text-white">
                <div class="flex items-start gap-4 mb-6">
                    <div class="w-14 h-14 flex-shrink-0 bg-white/20 backdrop-blur rounded-2xl flex items-center justify-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold">{{ $settings['about_title'] ?? 'Tentang SMK BPPI Baleendah' }}</h3>
                        <p class="text-blue-100 text-sm mt-1">Hijau Bersih Berkarakter</p>
                    </div>
                </div>
                <div class="text-blue-50 leading-relaxed whitespace-pre-line text-base md:text-lg">
                    {{ $settings['about_text'] ?? 'Deskripsi sekolah belum tersedia.' }}
                </div>
            </div>
        </div>
    </div>
</section>
    <!-- VISI MISI -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- VISI -->
                <div class="bg-white rounded-2xl shadow-sm p-8 md:p-10 border-t-4 border-blue-600" data-aos="fade-right">
                    <div class="w-14 h-14 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">Visi</h2>
                    <div class="text-gray-600 leading-relaxed whitespace-pre-line">
                        {{ $settings['vision'] ?? 'Visi sekolah belum tersedia.' }}
                    </div>
                </div>

                <!-- MISI -->
                <div class="bg-white rounded-2xl shadow-sm p-8 md:p-10 border-t-4 border-green-600" data-aos="fade-left">
                    <div class="w-14 h-14 bg-green-100 text-green-600 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">Misi</h2>
                    <div class="text-gray-600 leading-relaxed whitespace-pre-line">
                        {{ $settings['mission'] ?? 'Misi sekolah belum tersedia.' }}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- TIM SEKOLAH PREVIEW -->
    @if($staff->count() > 0)
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-up">
                <span class="text-blue-600 font-semibold text-sm uppercase tracking-wider">Tim Kami</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mt-2">Kenali Tim Sekolah</h2>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                @foreach($staff as $index => $person)
                    <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl overflow-hidden transition-all duration-300 group"
                         data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <div class="relative aspect-[3/4] overflow-hidden">
                            @if($person->photo)
                                <img src="{{ asset('storage/' . $person->photo) }}" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-500" 
                                     alt="{{ $person->name }}">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                    <svg class="w-20 h-20 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-4 text-center">
                            <h3 class="font-bold text-gray-800 text-sm truncate">{{ $person->name }}</h3>
                            <p class="text-xs text-blue-600 mt-1 truncate">{{ $person->position }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-10">
                <a href="{{ route('staff.index') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition shadow-md">
                    Lihat Semua Tim
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
        </div>
    </section>
    @endif

@endsection