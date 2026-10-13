<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Daftar semua key setting yang bisa diatur.
     */
    protected $settingKeys = [
        // Hero
        'hero_video_url',
        'hero_title',
        'hero_subtitle',

        // Logo
        'site_logo',

        // Tentang Kami
        'about_title',
        'about_text',
        'about_image',

        // Visi & Misi
        'vision',
        'mission',

        // Kontak
        'address',
        'email',
        'phone',

        // Google Maps
        'maps_embed_code',

        // Sosial Media
        'social_instagram',
        'social_tiktok',
        'social_youtube',
        'social_facebook',
    ];

    /**
     * Key yang berupa file upload (bukan text).
     */
    protected $fileKeys = ['site_logo', 'about_image'];

    public function index()
    {
        $settings = [];
        foreach ($this->settingKeys as $key) {
            $settings[$key] = Setting::get($key, '');
        }

        return view('admin.setting.index', compact('settings'));
    }

    public function update(Request $request)
    {
        foreach ($this->settingKeys as $key) {
            // Kalau key adalah file (site_logo / about_image)
            if (in_array($key, $this->fileKeys)) {
                if ($request->hasFile($key)) {
                    // Validasi file
                    $request->validate([
                        $key => 'image|mimes:jpeg,png,jpg,webp,svg|max:3072',
                    ]);

                    // Hapus file lama kalau ada
                    $oldFile = Setting::get($key);
                    if ($oldFile && Storage::disk('public')->exists($oldFile)) {
                        Storage::disk('public')->delete($oldFile);
                    }

                    // Simpan file baru
                    $path = $request->file($key)->store('settings', 'public');
                    Setting::set($key, $path);
                }
                // Kalau tidak upload file baru, biarkan file lama (tidak diubah)
            } else {
                // Key berupa text/textarea biasa
                Setting::set($key, $request->input($key, ''));
            }
        }

        return redirect()->route('admin.setting.index')->with('success', 'Pengaturan berhasil disimpan!');
    }
}