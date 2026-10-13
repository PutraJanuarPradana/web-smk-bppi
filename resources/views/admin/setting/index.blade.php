@extends('layouts.admin')

@section('title', 'Pengaturan Global')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Pengaturan Global Website</h1>
        <p class="text-gray-500 text-sm mt-1">Semua perubahan di sini akan langsung terlihat di halaman pengguna.</p>
    </div>

    @if (session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    {{-- PENTING: enctype="multipart/form-data" wajib ada untuk upload file --}}
    <form action="{{ route('admin.setting.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- ==================== SECTION: IDENTITAS / LOGO ==================== -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 bg-gradient-to-r from-indigo-600 to-indigo-500">
                <h2 class="text-lg font-bold text-white flex items-center">
                    🏷️ Identitas Sekolah
                </h2>
                <p class="text-indigo-100 text-sm mt-1">Logo yang tampil di navbar dan footer website.</p>
            </div>
            <div class="p-6 space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Logo Sekolah (Ukuran Kotak)</label>
                    
                    {{-- Preview logo yang sedang aktif --}}
                    @if(!empty($settings['site_logo']))
                        <div class="mb-3 flex items-center gap-4">
                            <img src="{{ asset('storage/' . $settings['site_logo']) }}" 
                                 alt="Logo Sekolah" 
                                 class="w-20 h-20 object-cover rounded-lg border border-gray-200 shadow-sm bg-gray-50">
                            <div>
                                <p class="text-xs text-green-600 font-medium">✓ Logo aktif</p>
                                <p class="text-xs text-gray-400 mt-1">Upload baru untuk menggantinya.</p>
                            </div>
                        </div>
                    @else
                        <div class="mb-3 p-4 bg-gray-50 rounded-lg border border-dashed border-gray-300 text-center">
                            <svg class="w-8 h-8 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <p class="text-xs text-gray-500">Belum ada logo. Sistem akan menampilkan lingkaran biru "BPPI" sebagai default.</p>
                        </div>
                    @endif

                    <input type="file" name="site_logo" accept="image/*" 
                           class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100 transition cursor-pointer">
                    <p class="text-xs text-gray-400 mt-2">💡 Format: JPG, PNG, WEBP, SVG. Maks 3MB. Gunakan gambar <strong>persegi (1:1)</strong> agar tampil rapi.</p>
                </div>
            </div>
        </div>

        <!-- ==================== SECTION: HERO / BERANDA ==================== -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 bg-gradient-to-r from-blue-600 to-blue-500">
                <h2 class="text-lg font-bold text-white flex items-center">
                    🎥 Bagian Hero (Beranda Utama)
                </h2>
                <p class="text-blue-100 text-sm mt-1">Video dan teks yang muncul pertama kali saat pengunjung membuka website.</p>
            </div>
            <div class="p-6 space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">URL Video Hero</label>
                    <input type="text" name="hero_video_url" value="{{ $settings['hero_video_url'] }}" 
                           placeholder="Contoh: https://www.youtube.com/watch?v=xxxx atau https://example.com/video.mp4"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    <p class="text-xs text-gray-400 mt-2">💡 Bisa berupa link YouTube atau link langsung ke file .mp4.</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Judul Utama Hero</label>
                    <input type="text" name="hero_title" value="{{ $settings['hero_title'] }}" 
                           placeholder="Contoh: SELAMAT DATANG DI SMK BPPI"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sub Judul Hero</label>
                    <input type="text" name="hero_subtitle" value="{{ $settings['hero_subtitle'] }}" 
                           placeholder="Contoh: Hijau Bersih Berkarakter"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                </div>
            </div>
        </div>

        <!-- ==================== SECTION: TENTANG KAMI ==================== -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 bg-gradient-to-r from-green-600 to-green-500">
                <h2 class="text-lg font-bold text-white">📝 Tentang Kami</h2>
                <p class="text-green-100 text-sm mt-1">Deskripsi singkat tentang sekolah.</p>
            </div>
            <div class="p-6 space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Judul Section Tentang</label>
                    <input type="text" name="about_title" value="{{ $settings['about_title'] }}" 
                           placeholder="Contoh: Tentang SMK BPPI Baleendah"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Tentang Kami</label>
                    <textarea name="about_text" rows="6" 
                              placeholder="Tulis deskripsi lengkap tentang sekolah..."
                              class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">{{ $settings['about_text'] }}</textarea>
                </div>
            </div>
        </div>

        <!-- ==================== SECTION: VISI & MISI ==================== -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 bg-gradient-to-r from-purple-600 to-purple-500">
                <h2 class="text-lg font-bold text-white">🎯 Visi & Misi</h2>
                <p class="text-purple-100 text-sm mt-1">Visi dan misi sekolah.</p>
            </div>
            <div class="p-6 space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Visi</label>
                    <textarea name="vision" rows="4" 
                              class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">{{ $settings['vision'] }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Misi</label>
                    <textarea name="mission" rows="6" 
                              placeholder="Pisahkan tiap misi dengan enter/baris baru."
                              class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">{{ $settings['mission'] }}</textarea>
                </div>
            </div>
        </div>

        <!-- ==================== SECTION: KONTAK ==================== -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 bg-gradient-to-r from-orange-600 to-orange-500">
                <h2 class="text-lg font-bold text-white">📞 Kontak & Alamat</h2>
                <p class="text-orange-100 text-sm mt-1">Informasi kontak sekolah yang ditampilkan di footer dan halaman kontak.</p>
            </div>
            <div class="p-6 space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                    <textarea name="address" rows="3" 
                              placeholder="Jl. Adipati Agung No.23, Baleendah..."
                              class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">{{ $settings['address'] }}</textarea>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" value="{{ $settings['email'] }}" 
                               placeholder="smk@bppi.sch.id"
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Telepon</label>
                        <input type="text" name="phone" value="{{ $settings['phone'] }}" 
                               placeholder="022-5943350"
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    </div>
                </div>
            </div>
        </div>

        <!-- ==================== SECTION: GOOGLE MAPS ==================== -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 bg-gradient-to-r from-red-600 to-red-500">
                <h2 class="text-lg font-bold text-white">🗺️ Google Maps</h2>
                <p class="text-red-100 text-sm mt-1">Embed Google Maps untuk menunjukkan lokasi sekolah.</p>
            </div>
            <div class="p-6 space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kode Embed Google Maps</label>
                    <textarea name="maps_embed_code" rows="4" 
                              placeholder='<iframe src="https://www.google.com/maps/embed?..." ...></iframe>'
                              class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition font-mono text-xs">{{ $settings['maps_embed_code'] }}</textarea>
                    <p class="text-xs text-gray-400 mt-2">💡 Cara mendapatkan: Buka Google Maps → Cari lokasi → Klik "Share" → "Embed a map" → Copy HTML.</p>
                </div>
            </div>
        </div>

        <!-- ==================== SECTION: SOSIAL MEDIA ==================== -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 bg-gradient-to-r from-pink-600 to-pink-500">
                <h2 class="text-lg font-bold text-white">🌐 Sosial Media</h2>
                <p class="text-pink-100 text-sm mt-1">Link sosial media sekolah (kosongkan jika tidak ada).</p>
            </div>
            <div class="p-6 space-y-5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Instagram</label>
                        <input type="url" name="social_instagram" value="{{ $settings['social_instagram'] }}" 
                               placeholder="https://instagram.com/smkbppi"
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">TikTok</label>
                        <input type="url" name="social_tiktok" value="{{ $settings['social_tiktok'] }}" 
                               placeholder="https://tiktok.com/@smkbppi"
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">YouTube</label>
                        <input type="url" name="social_youtube" value="{{ $settings['social_youtube'] }}" 
                               placeholder="https://youtube.com/@smkbppi"
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Facebook</label>
                        <input type="url" name="social_facebook" value="{{ $settings['social_facebook'] }}" 
                               placeholder="https://facebook.com/smkbppi"
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    </div>
                </div>
            </div>
        </div>

        <!-- TOMBOL SIMPAN STICKY -->
        <div class="sticky bottom-4 z-10">
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-4 flex justify-end">
                <button type="submit" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition shadow-md">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                    Simpan Semua Pengaturan
                </button>
            </div>
        </div>
    </form>
@endsection