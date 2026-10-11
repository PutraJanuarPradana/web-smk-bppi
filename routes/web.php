<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - SMK BPPI
|--------------------------------------------------------------------------
*/

// ==========================================
// RUTE PUBLIK (Frontend - Tampilan Pengguna)
// ==========================================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/berita', [HomeController::class, 'news'])->name('news.index');
Route::get('/berita/{slug}', [HomeController::class, 'newsDetail'])->name('news.detail');
Route::get('/galeri', [HomeController::class, 'gallery'])->name('gallery.index');
Route::get('/eskul', [HomeController::class, 'extracurricular'])->name('extracurricular.index');
Route::get('/tim-sekolah', [HomeController::class, 'staff'])->name('staff.index');
Route::get('/jurusan', [HomeController::class, 'majors'])->name('majors.index');
Route::get('/faq', [HomeController::class, 'faq'])->name('faq.index');
Route::get('/profil', [HomeController::class, 'about'])->name('about');
Route::get('/kontak', [HomeController::class, 'contact'])->name('contact');

// ==========================================
// RUTE RAHASIA (Easter Egg) - Login Admin
// ==========================================
Route::get('/portal-sekolah-99', function () {
    return view('auth.login');
})->middleware('guest')->name('login');

// ==========================================
// RUTE ADMIN (Harus login dulu)
// ==========================================
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::resource('news', App\Http\Controllers\Admin\NewsController::class);
    Route::resource('gallery', App\Http\Controllers\Admin\GalleryController::class);
    Route::resource('extracurricular', App\Http\Controllers\Admin\ExtracurricularController::class);
    Route::resource('staff', App\Http\Controllers\Admin\StaffController::class);
    Route::resource('major', App\Http\Controllers\Admin\MajorController::class);
    Route::resource('faq', App\Http\Controllers\Admin\FaqController::class);
    Route::resource('menu', App\Http\Controllers\Admin\MenuController::class);

    Route::get('/setting', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('setting.index');
    Route::put('/setting', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('setting.update');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';