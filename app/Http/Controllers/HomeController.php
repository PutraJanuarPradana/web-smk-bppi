<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Gallery;
use App\Models\Extracurricular;
use App\Models\Staff;
use App\Models\Major;
use App\Models\Faq;
use App\Models\Setting;
use App\Models\Menu;

class HomeController extends Controller
{
    public function index()
    {
        $news = News::latest()->take(3)->get();
        $galleries = Gallery::latest()->take(6)->get();
        $extracurriculars = Extracurricular::take(4)->get();
        $majors = Major::all();
        $settings = $this->getSettings();

        return view('home', compact('news', 'galleries', 'extracurriculars', 'majors', 'settings'));
    }

    public function news()
    {
        $news = News::latest()->paginate(9);
        $settings = $this->getSettings();
        return view('pages.news', compact('news', 'settings'));
    }

    public function newsDetail($slug)
    {
        $newsItem = News::where('slug', $slug)->firstOrFail();
        $relatedNews = News::where('id', '!=', $newsItem->id)->latest()->take(3)->get();
        $settings = $this->getSettings();
        return view('pages.news-detail', compact('newsItem', 'relatedNews', 'settings'));
    }

    public function gallery()
    {
        $galleries = Gallery::latest()->paginate(12);
        $settings = $this->getSettings();
        return view('pages.gallery', compact('galleries', 'settings'));
    }

    public function extracurricular()
    {
        $extracurriculars = Extracurricular::paginate(12);
        $settings = $this->getSettings();
        return view('pages.extracurricular', compact('extracurriculars', 'settings'));
    }

    public function staff()
    {
        $staff = Staff::paginate(12);
        $settings = $this->getSettings();
        return view('pages.staff', compact('staff', 'settings'));
    }

    public function majors()
    {
        $majors = Major::all();
        $settings = $this->getSettings();
        return view('pages.majors', compact('majors', 'settings'));
    }

    public function faq()
    {
        $faqs = Faq::all();
        $settings = $this->getSettings();
        return view('pages.faq', compact('faqs', 'settings'));
    }

    public function about()
    {
        $settings = $this->getSettings();
        $staff = Staff::take(4)->get();
        return view('pages.about', compact('settings', 'staff'));
    }

    public function contact()
    {
        $settings = $this->getSettings();
        return view('pages.contact', compact('settings'));
    }

    /**
     * Helper untuk mengambil semua setting yang dibutuhkan frontend.
     */
    private function getSettings()
    {
        return [
            'hero_video_url'    => Setting::get('hero_video_url', ''),
            'hero_title'        => Setting::get('hero_title', 'SELAMAT DATANG DI SMK BPPI'),
            'hero_subtitle'     => Setting::get('hero_subtitle', 'Hijau Bersih Berkarakter'),
            'about_title'       => Setting::get('about_title', 'Tentang SMK BPPI'),
            'about_text'        => Setting::get('about_text', ''),
            'vision'            => Setting::get('vision', ''),
            'mission'           => Setting::get('mission', ''),
            'address'           => Setting::get('address', ''),
            'email'             => Setting::get('email', ''),
            'phone'             => Setting::get('phone', ''),
            'maps_embed_code'   => Setting::get('maps_embed_code', ''),
            'social_instagram'  => Setting::get('social_instagram', ''),
            'social_tiktok'     => Setting::get('social_tiktok', ''),
            'social_youtube'    => Setting::get('social_youtube', ''),
            'social_facebook'   => Setting::get('social_facebook', ''),
        ];
    }
}