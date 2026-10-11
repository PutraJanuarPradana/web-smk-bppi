<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('label'); // Contoh: Beranda, Berita, Kontak
            $table->string('url');   // Contoh: /, /berita, /kontak
            $table->integer('order')->default(0); // Urutan menu
            $table->boolean('is_active')->default(true); // Tampil atau tidak
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};