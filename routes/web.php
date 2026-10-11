<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - SMK BPPI
|--------------------------------------------------------------------------
*/

// ==========================================
// RUTE PUBLIK (Bisa diakses semua orang)
// ==========================================
Route::get('/', function () {
    return view('welcome'); // Nanti akan kita ubah ke view home
})->name('home');

// ==========================================
// RUTE RAHASIA (Easter Egg) - Hanya admin yang tahu
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
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';