<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    // PASTIKAN parent_id ADA DI SINI
    protected $fillable = ['parent_id', 'label', 'url', 'order', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order', 'asc');
    }

    // Relasi untuk sub-menu (Anak)
    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('order', 'asc');
    }

    // Relasi ke menu induk (Orang tua)
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }
}