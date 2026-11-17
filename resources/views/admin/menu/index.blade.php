@extends('layouts.admin')

@section('title', 'Kelola Menu')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Kelola Menu Navbar</h1>
            <p class="text-gray-500 text-sm mt-1">Atur menu utama dan sub-menu (dropdown).</p>
        </div>
        <a href="{{ route('admin.menu.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition shadow-sm">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Menu
        </a>
    </div>

    @if (session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-sm text-left text-gray-600">
            <thead class="bg-gray-50 text-xs uppercase text-gray-700">
                <tr>
                    <th class="px-6 py-3 w-20">Urutan</th>
                    <th class="px-6 py-3">Label</th>
                    <th class="px-6 py-3">URL</th>
                    <th class="px-6 py-3 text-center w-28">Status</th>
                    <th class="px-6 py-3 text-center w-40">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($menus as $item)
                    <!-- BARIS MENU UTAMA -->
                    <tr class="hover:bg-gray-50 transition bg-white">
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center justify-center w-8 h-8 bg-gray-100 text-gray-700 rounded-full font-bold text-sm">{{ $item->order }}</span>
                        </td>
                        <td class="px-6 py-4 font-semibold text-gray-800">{{ $item->label }}</td>
                        <td class="px-6 py-4 font-mono text-xs text-blue-600">{{ $item->url }}</td>
                        <td class="px-6 py-4 text-center">
                            @if ($item->is_active)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">● Aktif</span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600">○ Nonaktif</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="{{ route('admin.menu.edit', $item->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Edit">✏️</a>
                                <form action="{{ route('admin.menu.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus menu ini? Sub-menu di dalamnya juga akan terhapus.')">
                                    @csrf @method('DELETE')
                                    <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus">🗑️</button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    <!-- BARIS SUB-MENU (JIKA ADA) -->
                    @foreach($item->children as $child)
                        <tr class="hover:bg-gray-50 transition bg-gray-50/50">
                            <td class="px-6 py-3 text-center"><span class="text-gray-400 text-lg">↳</span></td>
                            <td class="px-6 py-3 pl-8 text-gray-600">{{ $child->label }}</td>
                            <td class="px-6 py-3 font-mono text-xs text-gray-500">{{ $child->url }}</td>
                            <td class="px-6 py-3 text-center">
                                @if ($child->is_active)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">● Aktif</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600">○ Nonaktif</span>
                                @endif
                            </td>
                            <td class="px-6 py-3">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('admin.menu.edit', $child->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Edit">✏️</a>
                                    <form action="{{ route('admin.menu.destroy', $child->id) }}" method="POST" onsubmit="return confirm('Hapus sub-menu ini?')">
                                        @csrf @method('DELETE')
                                        <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus">🗑️</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-400">Belum ada menu. Klik tombol "Tambah Menu" untuk memulai.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection