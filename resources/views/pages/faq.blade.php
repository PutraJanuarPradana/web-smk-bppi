@extends('layouts.app')

@section('title', 'FAQ')
@section('description', 'Pertanyaan yang sering diajukan tentang SMK BPPI Baleendah')

@section('content')
    <!-- PAGE HEADER -->
    <section class="relative py-20 bg-gradient-to-br from-blue-700 to-blue-900 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="1"/></pattern></defs><rect width="100%" height="100%" fill="url(#grid)"/></svg>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center" data-aos="fade-up">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Pertanyaan Umum</h1>
            <p class="text-blue-100 text-lg max-w-2xl mx-auto">Pertanyaan yang sering diajukan tentang SMK BPPI Baleendah.</p>
        </div>
    </section>

    <!-- BREADCRUMB -->
    <div class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <nav class="text-sm text-gray-500 flex items-center space-x-2">
                <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Beranda</a>
                <span>/</span>
                <span class="text-gray-800 font-medium">FAQ</span>
            </nav>
        </div>
    </div>

    <!-- KONTEN -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($faqs->count() > 0)
                <div class="space-y-3" x-data="{ openItem: null }">
                    @foreach($faqs as $index => $faq)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden transition-all"
                             data-aos="fade-up" data-aos-delay="{{ $index * 50 }}">
                            <button @click="openItem = (openItem === {{ $index }} ? null : {{ $index }})"
                                    class="w-full px-6 py-5 flex items-center justify-between text-left hover:bg-gray-50 transition group">
                                <div class="flex items-center gap-4 flex-1">
                                    <div class="w-10 h-10 flex-shrink-0 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center font-bold">?</div>
                                    <h3 class="font-semibold text-gray-800 group-hover:text-blue-600 transition">{{ $faq->question }}</h3>
                                </div>
                                <svg class="w-5 h-5 text-gray-400 flex-shrink-0 transition-transform duration-300"
                                     :class="openItem === {{ $index }} ? 'rotate-180' : ''"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="openItem === {{ $index }}"
                                 x-collapse
                                 x-cloak
                                 class="px-6 pb-6 text-gray-600 leading-relaxed whitespace-pre-line border-t border-gray-100 pt-5">
                                {{ $faq->answer }}
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-20 bg-white rounded-2xl border border-gray-100">
                    <h3 class="text-xl font-bold text-gray-700 mb-2">Belum Ada FAQ</h3>
                    <p class="text-gray-500">Pertanyaan umum akan segera ditambahkan.</p>
                </div>
            @endif

            <!-- CTA -->
            <div class="mt-12 bg-gradient-to-br from-blue-600 to-blue-800 rounded-2xl p-8 text-white text-center" data-aos="fade-up">
                <h3 class="text-2xl font-bold mb-2">Masih Punya Pertanyaan?</h3>
                <p class="text-blue-100 mb-6">Tim kami siap membantu Anda.</p>
                <a href="{{ route('contact') }}" class="inline-flex items-center px-6 py-3 bg-white text-blue-600 font-semibold rounded-lg hover:bg-gray-100 transition">
                    Hubungi Kami
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
        </div>
    </section>
@endsection