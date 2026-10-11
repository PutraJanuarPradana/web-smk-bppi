<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SMK BPPI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">
    <nav class="bg-blue-600 text-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">Dashboard Admin SMK BPPI</h1>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-red-500 px-4 py-2 rounded hover:bg-red-600 transition">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container mx-auto p-6">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-4">Selamat Datang, {{ Auth::user()->name }}! 🎉</h2>
            <p class="text-gray-600">Ini adalah halaman dashboard admin. Nanti di sini akan ada menu untuk mengelola Berita, Galeri, Ekstrakurikuler, dll.</p>
        </div>
    </div>
</body>
</html>