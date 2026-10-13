@extends('layouts.app')

@section('title', 'Program Keahlian')
@section('description', 'Program keahlian di SMK BPPI Baleendah')

@section('content')
    <!-- PAGE HEADER -->
    <section class="relative py-20 bg-gradient-to-br from-blue-700 to-blue-900 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="1"/></pattern></defs><rect width="100%" height="100%" fill="url(#grid)"/></svg>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center" data-aos="fade-up">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Program Keahlian</h1>
            <p class="text-blue-100 text-lg max-w-2xl mx-auto">Pilih jurusan yang sesuai dengan minat dan bakatmu.</p>
        </div>
    </section>

    <!-- BREADCRUMB -->
    <div class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <nav class="text-sm text-gray-500 flex items-center space-x-2">
                <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Beranda</a>
                <span>/</span>
                <span class="text-gray-800 font-medium">Program Keahlian</span>
            </nav>
        </div>
    </div>

    <!-- KONTEN -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($majors->count() > 0)
                <div class="space-y-8">
                    @foreach($majors as $index => $major)
                        <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg overflow-hidden transition-all duration-300 group"
                             data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-8">
                                <div class="md:col-span-1 flex items-center justify-center">
                                    <div class="w-40 h-40 flex items-center justify-center bg-blue-50 rounded-3xl overflow-hidden">
                                        @if($major->icon)
                                            <img src="{{ asset('storage/' . $major->icon) }}" 
                                                 class="w-28 h-28 object-contain transition-transform duration-500 group-hover:scale-110">
                                        @else
                                            <svg class="w-20 h-20 text-blue-600 transition-transform duration-500 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>
                                        @endif
                                    </div>
                                </div>
                                <div class="md:col-span-2">
                                    <span class="text-blue-600 font-semibold text-sm uppercase tracking-wider">Program Keahlian</span>
                                    <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mt-2 mb-4">{{ $major->name }}</h2>
                                    <div class="prose max-w-none text-gray-600 leading-relaxed whitespace-pre-line">
                                        {{ $major->description ?? 'Deskripsi jurusan belum tersedia.' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-20 bg-white rounded-2xl border border-gray-100">
                    <h3 class="text-xl font-bold text-gray-700 mb-2">Belum Ada Jurusan</h3>
                    <p class="text-gray-500">Data program keahlian akan segera ditambahkan.</p>
                </div>
            @endif
        </div>
    </section>
@endsection