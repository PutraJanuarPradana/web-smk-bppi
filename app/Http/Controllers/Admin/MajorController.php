<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MajorController extends Controller
{
    public function index()
    {
        $majors = Major::latest()->paginate(10);
        return view('admin.major.index', compact('majors'));
    }

    public function create()
    {
        return view('admin.major.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'icon'        => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'description' => 'nullable|string',
        ]);

        $data = $request->only(['name', 'description']);
        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('majors', 'public');
        }

        Major::create($data);
        return redirect()->route('admin.major.index')->with('success', 'Jurusan berhasil ditambahkan!');
    }

    public function edit(Major $major)
    {
        return view('admin.major.edit', compact('major'));
    }

    public function update(Request $request, Major $major)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'icon'        => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'description' => 'nullable|string',
        ]);

        $data = $request->only(['name', 'description']);
        if ($request->hasFile('icon')) {
            if ($major->icon && Storage::disk('public')->exists($major->icon)) {
                Storage::disk('public')->delete($major->icon);
            }
            $data['icon'] = $request->file('icon')->store('majors', 'public');
        }

        $major->update($data);
        return redirect()->route('admin.major.index')->with('success', 'Jurusan berhasil diperbarui!');
    }

    public function destroy(Major $major)
    {
        if ($major->icon && Storage::disk('public')->exists($major->icon)) {
            Storage::disk('public')->delete($major->icon);
        }
        $major->delete();
        return redirect()->route('admin.major.index')->with('success', 'Jurusan berhasil dihapus!');
    }
}