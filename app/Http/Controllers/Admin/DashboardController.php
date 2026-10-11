<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Gallery;
use App\Models\Extracurricular;
use App\Models\Staff;
use App\Models\Major;
use App\Models\Faq;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'news'            => News::count(),
            'gallery'         => Gallery::count(),
            'extracurricular' => Extracurricular::count(),
            'staff'           => Staff::count(),
            'major'           => Major::count(),
            'faq'             => Faq::count(),
        ];

        $latestNews = News::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'latestNews'));
    }
}