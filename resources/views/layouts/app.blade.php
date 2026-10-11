<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SMK BPPI Baleendah') - Website Resmi</title>
    <meta name="description" content="@yield('description', 'Website resmi SMK BPPI Baleendah. Hijau Bersih Berkarakter.')">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- AOS (Animate On Scroll) -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Custom Style -->
    <style>
        [x-cloak] { display: none !important; }
        html { scroll-behavior: smooth; }
        
        /* Efek hover blur untuk galeri & berita */
        .hover-blur-item .hover-overlay {
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .hover-blur-item:hover .hover-overlay {
            opacity: 1;
        }
        .hover-blur-item:hover img {
            transform: scale(1.08);
        }
        .hover-blur-item img {
            transition: transform 0.5s ease;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased text-gray-800" x-data="{ mobileMenu: false }">

    <!-- ==================== NAVBAR ==================== -->
    <nav class="bg-white/95 backdrop-blur-sm shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16 md:h-20">
                
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    <div class="w-10 h-10 md:w-12 md:h-12 bg-blue-600 rounded-full flex items-center justify-center shadow-md group-hover:scale-110 transition-transform duration-300">
                        <span class="text-white font-bold text-sm md:text-base">BPPI</span>
                    </div>
                    <div>
                        <h1 class="text-lg md:text-xl font-bold text-gray-800 leading-tight">SMK BPPI</h1>
                        <p class="text-xs text-gray-500 hidden md:block">Baleendah</p>
                    </div>
                </a>

                <!-- Menu Desktop -->
                <div class="hidden md:flex items-center space-x-1">
                    @php
                        $menuItems = \App\Models\Menu::active()->get();
                    @endphp
                    @foreach($menuItems as $menu)
                        <a href="{{ url($menu->url) }}" 
                           class="px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->path() == ltrim($menu->url, '/') || (request()->path() == '/' && $menu->url == '/') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }}">
                            {{ $menu->label }}
                        </a>
                    @endforeach
                </div>

                <!-- Tombol Hamburger Mobile -->
                <button @click="mobileMenu = !mobileMenu" class="md:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-100 transition">
                    <svg x-show="!mobileMenu" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg x-show="mobileMenu" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Sidebar Mobile -->
        <div x-show="mobileMenu" x-cloak 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4"
             class="md:hidden bg-white border-t border-gray-100 shadow-lg">
            <div class="px-4 py-3 space-y-1">
                @foreach($menuItems as $menu)
                    <a href="{{ url($menu->url) }}" 
                       class="block px-4 py-3 text-sm font-medium rounded-lg {{ request()->path() == ltrim($menu->url, '/') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }} transition">
                        {{ $menu->label }}
                    </a>
                @endforeach
            </div>
        </div>
    </nav>

    <!-- ==================== KONTEN DINAMIS ==================== -->
    <main>
        @yield('content')
    </main>

    <!-- ==================== FOOTER ==================== -->
    <footer class="bg-gray-900 text-gray-300 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                
                <!-- Kolom 1: Sekolah -->
                <div class="md:col-span-2">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center">
                            <span class="text-white font-bold">BPPI</span>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-white">SMK BPPI</h3>
                            <p class="text-sm text-gray-400">Baleendah</p>
                        </div>
                    </div>
                    <p class="text-sm leading-relaxed text-gray-400 mb-4">
                        {{ Str::limit($settings['about_text'] ?? 'SMK BPPI Baleendah adalah sekolah kejuruan yang berkomitmen mencetak lulusan berkompeten, berkarakter, dan siap menghadapi dunia kerja.', 150) }}
                    </p>
                    
                    <!-- Sosial Media -->
                    <div class="flex space-x-3">
                        @if(!empty($settings['social_instagram']))
                            <a href="{{ $settings['social_instagram'] }}" target="_blank" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-pink-600 transition group">
                                <svg class="w-5 h-5 group-hover:scale-110 transition" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                            </a>
                        @endif
                        @if(!empty($settings['social_tiktok']))
                            <a href="{{ $settings['social_tiktok'] }}" target="_blank" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-gray-700 transition group">
                                <svg class="w-5 h-5 group-hover:scale-110 transition" fill="currentColor" viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-5.2 1.74 2.89 2.89 0 012.31-4.64 2.93 2.93 0 01.88.13V9.4a6.84 6.84 0 00-1-.05A6.33 6.33 0 005 20.1a6.34 6.34 0 0010.86-4.43v-7a8.16 8.16 0 004.77 1.52v-3.4a4.85 4.85 0 01-1-.1z"/></svg>
                            </a>
                        @endif
                        @if(!empty($settings['social_youtube']))
                            <a href="{{ $settings['social_youtube'] }}" target="_blank" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-red-600 transition group">
                                <svg class="w-5 h-5 group-hover:scale-110 transition" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                            </a>
                        @endif
                        @if(!empty($settings['social_facebook']))
                            <a href="{{ $settings['social_facebook'] }}" target="_blank" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-blue-600 transition group">
                                <svg class="w-5 h-5 group-hover:scale-110 transition" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Kolom 2: Navigasi -->
                <div>
                    <h3 class="text-white font-semibold mb-4">Navigasi</h3>
                    <ul class="space-y-2 text-sm">
                        @foreach($menuItems->take(5) as $menu)
                            <li><a href="{{ url($menu->url) }}" class="hover:text-blue-400 transition">{{ $menu->label }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <!-- Kolom 3: Kontak -->
                <div>
                    <h3 class="text-white font-semibold mb-4">Kontak</h3>
                    <ul class="space-y-3 text-sm">
                        @if(!empty($settings['address']))
                            <li class="flex items-start space-x-2">
                                <svg class="w-4 h-4 mt-0.5 text-blue-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <span>{{ $settings['address'] }}</span>
                            </li>
                        @endif
                        @if(!empty($settings['email']))
                            <li class="flex items-start space-x-2">
                                <svg class="w-4 h-4 mt-0.5 text-blue-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                <a href="mailto:{{ $settings['email'] }}" class="hover:text-blue-400 transition">{{ $settings['email'] }}</a>
                            </li>
                        @endif
                        @if(!empty($settings['phone']))
                            <li class="flex items-start space-x-2">
                                <svg class="w-4 h-4 mt-0.5 text-blue-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                <span>{{ $settings['phone'] }}</span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-6 flex flex-col md:flex-row justify-between items-center text-xs text-gray-500">
                <p>© {{ date('Y') }} SMK BPPI Baleendah. All Rights Reserved.</p>
                <p class="mt-2 md:mt-0">Hijau Bersih Berkarakter</p>
            </div>
        </div>
    </footer>

    <!-- ==================== SCROLL TO TOP ==================== -->
    <button x-data="{ show: false }" 
            x-init="window.addEventListener('scroll', () => { show = window.scrollY > 400 })"
            x-show="show" x-cloak
            x-transition
            @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
            class="fixed bottom-6 right-6 w-12 h-12 bg-blue-600 text-white rounded-full shadow-lg hover:bg-blue-700 transition z-40 flex items-center justify-center">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
    </button>

    <!-- AOS Init -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 100,
            easing: 'ease-in-out'
        });
    </script>
</body>
</html>