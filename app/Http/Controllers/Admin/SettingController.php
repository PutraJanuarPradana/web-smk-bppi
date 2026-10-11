<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

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

        // Tentang Kami
        'about_title',
        'about_text',

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
            Setting::set($key, $request->input($key, ''));
        }

        return redirect()->route('admin.setting.index')->with('success', 'Pengaturan berhasil disimpan!');
    }
}