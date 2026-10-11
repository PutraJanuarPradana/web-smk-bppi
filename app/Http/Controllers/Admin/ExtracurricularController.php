<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Extracurricular;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExtracurricularController extends Controller
{
    /**
     * Tampilkan daftar semua eskul.
     */
    public function index()
    {
        $extracurriculars = Extracurricular::latest()->paginate(10);
        return view('admin.extracurricular.index', compact('extracurriculars'));
    }

    /**
     * Tampilkan form tambah eskul.
     */
    public function create()
    {
        return view('admin.extracurricular.create');
    }

    /**
     * Simpan eskul baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'logo'        => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'description' => 'nullable|string',
        ]);

        $data = $request->only(['name', 'description']);
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('extracurriculars', 'public');
        }

        Extracurricular::create($data);
        return redirect()->route('admin.extracurricular.index')->with('success', 'Eskul berhasil ditambahkan!');
    }

    /**
     * Tampilkan form edit eskul.
     */
    public function edit(Extracurricular $extracurricular)
    {
        return view('admin.extracurricular.edit', compact('extracurricular'));
    }

    /**
     * Update eskul di database.
     */
    public function update(Request $request, Extracurricular $extracurricular)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'logo'        => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'description' => 'nullable|string',
        ]);

        $data = $request->only(['name', 'description']);
        if ($request->hasFile('logo')) {
            if ($extracurricular->logo && Storage::disk('public')->exists($extracurricular->logo)) {
                Storage::disk('public')->delete($extracurricular->logo);
            }
            $data['logo'] = $request->file('logo')->store('extracurriculars', 'public');
        }

        $extracurricular->update($data);
        return redirect()->route('admin.extracurricular.index')->with('success', 'Eskul berhasil diperbarui!');
    }

    /**
     * Hapus eskul dari database.
     */
    public function destroy(Extracurricular $extracurricular)
    {
        if ($extracurricular->logo && Storage::disk('public')->exists($extracurricular->logo)) {
            Storage::disk('public')->delete($extracurricular->logo);
        }
        $extracurricular->delete();
        return redirect()->route('admin.extracurricular.index')->with('success', 'Eskul berhasil dihapus!');
    }
}