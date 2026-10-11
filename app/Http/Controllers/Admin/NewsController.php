<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Tampilkan daftar semua berita.
     */
    public function index()
    {
        $news = News::latest()->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    /**
     * Tampilkan form tambah berita.
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Simpan berita baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'     => 'required|string|max:255',
            'content'   => 'required',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'author'    => 'nullable|string|max:100',
        ]);

        $data = $request->only(['title', 'content']);
        $data['slug'] = Str::slug($request->title) . '-' . time();
        $data['author'] = $request->author ?? 'Admin';

        // Upload thumbnail jika ada
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('news', 'public');
        }

        News::create($data);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil ditambahkan!');
    }

    /**
     * Tampilkan form edit berita.
     */
    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    /**
     * Update berita di database.
     */
    public function update(Request $request, News $news)
    {
        $request->validate([
            'title'     => 'required|string|max:255',
            'content'   => 'required',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'author'    => 'nullable|string|max:100',
        ]);

        $data = $request->only(['title', 'content']);
        $data['author'] = $request->author ?? 'Admin';

        // Update slug jika title berubah
        if ($request->title !== $news->title) {
            $data['slug'] = Str::slug($request->title) . '-' . time();
        }

        // Ganti thumbnail jika ada upload baru
        if ($request->hasFile('thumbnail')) {
            // Hapus gambar lama
            if ($news->thumbnail && Storage::disk('public')->exists($news->thumbnail)) {
                Storage::disk('public')->delete($news->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('news', 'public');
        }

        $news->update($data);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil diperbarui!');
    }

    /**
     * Hapus berita dari database.
     */
    public function destroy(News $news)
    {
        // Hapus thumbnail
        if ($news->thumbnail && Storage::disk('public')->exists($news->thumbnail)) {
            Storage::disk('public')->delete($news->thumbnail);
        }

        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil dihapus!');
    }
}