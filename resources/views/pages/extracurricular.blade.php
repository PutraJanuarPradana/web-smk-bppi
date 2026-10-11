@extends('layouts.app')

@section('title', 'Ekstrakurikuler')
@section('description', 'Kegiatan ekstrakurikuler di SMK BPPI Baleendah')

@section('content')
    <!-- PAGE HEADER -->
    <section class="relative py-20 bg-gradient-to-br from-blue-700 to-blue-900 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="1"/></pattern></defs><rect width="100%" height="100%" fill="url(#grid)"/></svg>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center" data-aos="fade-up">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Ekstrakurikuler</h1>
            <p class="text-blue-100 text-lg max-w-2xl mx-auto">Kembangkan bakat dan minatmu di SMK BPPI Baleendah.</p>
        </div>
    </section>

    <!-- BREADCRUMB -->
    <div class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <nav class="text-sm text-gray-500 flex items-center space-x-2">
                <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Beranda</a>
                <span>/</span>
                <span class="text-gray-800 font-medium">Ekstrakurikuler</span>
            </nav>
        </div>
    </div>

    <!-- KONTEN -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($extracurriculars->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($extracurriculars as $index => $eskul)
                        <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 p-8 group"
                             data-aos="fade-up" data-aos-delay="{{ ($index % 6) * 100 }}">
                            <div class="flex items-start gap-4">
                                <div class="w-20 h-20 flex-shrink-0 flex items-center justify-center bg-blue-50 rounded-2xl group-hover:bg-blue-600 transition-colors duration-300">
                                    @if($eskul->logo)
                                        <img src="{{ asset('storage/' . $eskul->logo) }}" class="w-14 h-14 object-contain group-hover:brightness-0 group-hover:invert transition">
                                    @else
                                        <svg class="w-10 h-10 text-blue-600 group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-bold text-xl text-gray-800 mb-2 group-hover:text-blue-600 transition">{{ $eskul->name }}</h3>
                                    <p class="text-sm text-gray-500 leading-relaxed line-clamp-4">{{ $eskul->description ?? 'Ekstrakurikuler yang tersedia di SMK BPPI Baleendah.' }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @if($extracurriculars->hasPages())
                    <div class="mt-12 flex justify-center">{{ $extracurriculars->links() }}</div>
                @endif
            @else
                <div class="text-center py-20 bg-white rounded-2xl border border-gray-100">
                    <h3 class="text-xl font-bold text-gray-700 mb-2">Belum Ada Eskul</h3>
                    <p class="text-gray-500">Data ekstrakurikuler akan segera ditambahkan.</p>
                </div>
            @endif
        </div>
    </section>
@endsection