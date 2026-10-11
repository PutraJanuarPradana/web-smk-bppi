@extends('layouts.app')

@section('title', 'Tim Sekolah')
@section('description', 'Tim pengajar dan staff SMK BPPI Baleendah')

@section('content')
    <!-- PAGE HEADER -->
    <section class="relative py-20 bg-gradient-to-br from-blue-700 to-blue-900 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="1"/></pattern></defs><rect width="100%" height="100%" fill="url(#grid)"/></svg>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center" data-aos="fade-up">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Tim Sekolah</h1>
            <p class="text-blue-100 text-lg max-w-2xl mx-auto">Kenali tim pengajar dan staff profesional kami.</p>
        </div>
    </section>

    <!-- BREADCRUMB -->
    <div class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <nav class="text-sm text-gray-500 flex items-center space-x-2">
                <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Beranda</a>
                <span>/</span>
                <span class="text-gray-800 font-medium">Tim Sekolah</span>
            </nav>
        </div>
    </div>

    <!-- KONTEN -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($staff->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
                    @foreach($staff as $index => $person)
                        <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl overflow-hidden transition-all duration-300 group"
                             data-aos="fade-up" data-aos-delay="{{ ($index % 8) * 80 }}">
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
                                <!-- Overlay Info Hover -->
                                <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent p-4 opacity-0 group-hover:opacity-100 transition duration-300">
                                    <p class="text-white text-sm font-medium">{{ $person->position }}</p>
                                </div>
                            </div>
                            <div class="p-4 text-center">
                                <h3 class="font-bold text-gray-800 text-sm md:text-base truncate">{{ $person->name }}</h3>
                                <p class="text-xs text-blue-600 mt-1 truncate">{{ $person->position }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                @if($staff->hasPages())
                    <div class="mt-12 flex justify-center">{{ $staff->links() }}</div>
                @endif
            @else
                <div class="text-center py-20 bg-white rounded-2xl border border-gray-100">
                    <h3 class="text-xl font-bold text-gray-700 mb-2">Belum Ada Data</h3>
                    <p class="text-gray-500">Data tim sekolah akan segera ditambahkan.</p>
                </div>
            @endif
        </div>
    </section>
@endsection