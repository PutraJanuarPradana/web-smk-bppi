<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        // Hanya ambil menu utama (parent_id = null), beserta anak-anaknya
        $menus = Menu::with('children')->whereNull('parent_id')->orderBy('order', 'asc')->get();
        return view('admin.menu.index', compact('menus'));
    }

    public function create()
    {
        // Ambil menu utama untuk pilihan dropdown parent
        $parentMenus = Menu::whereNull('parent_id')->orderBy('order', 'asc')->get();
        return view('admin.menu.create', compact('parentMenus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'label'     => 'required|string|max:100',
            'url'       => 'required|string|max:255',
            'order'     => 'nullable|integer|min:0',
            'parent_id' => 'nullable|exists:menus,id',
            'is_active' => 'nullable|boolean',
        ]);

        Menu::create([
            'label'     => $request->label,
            'url'       => $request->url,
            'order'     => $request->order ?? 0,
            'parent_id' => $request->parent_id,
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil ditambahkan!');
    }

    public function edit(Menu $menu)
    {
        // Ambil menu utama, kecuali dirinya sendiri
        $parentMenus = Menu::whereNull('parent_id')->where('id', '!=', $menu->id)->get();
        return view('admin.menu.edit', compact('menu', 'parentMenus'));
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'label'     => 'required|string|max:100',
            'url'       => 'required|string|max:255',
            'order'     => 'nullable|integer|min:0',
            'parent_id' => 'nullable|exists:menus,id',
            'is_active' => 'nullable|boolean',
        ]);

        $menu->update([
            'label'     => $request->label,
            'url'       => $request->url,
            'order'     => $request->order ?? 0,
            'parent_id' => $request->parent_id,
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil diperbarui!');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil dihapus!');
    }
}