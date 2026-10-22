<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('images/logo1.png') }}">
    @vite('resources/css/app.css')
</head>
<body class="antialiased bg-[#ECE8E5] min-h-screen relative overflow-hidden">

    <!-- Konten galeri -->
    @yield('content')

    <!-- Alpine.js -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- Global Fix: BFCache Chrome & Single Visit Animation -->
    <script>
        // 1. Tangani tombol Back/Forward Browser (BFCache) untuk SEMUA halaman
        window.addEventListener('pageshow', function(event) {
            const pageWrapper = document.getElementById('pageWrapper');
            if (pageWrapper) {
                pageWrapper.style.transition = 'none';
                pageWrapper.style.opacity = '1';
            }
        });

        // 2. Batasi animasi loading cuma 1 kali per sesi masuk web
        document.addEventListener('DOMContentLoaded', function() {
            const pageWrapper = document.getElementById('pageWrapper');
            if (!pageWrapper) return;

            const hasVisited = sessionStorage.getItem('rhine_lab_visited');

            if (hasVisited) {
                // Kalau sudah pernah masuk, matikan efek animasi & langsung tampilkan
                pageWrapper.style.transition = 'none';
                pageWrapper.style.opacity = '1';
            } else {
                // Pertama kali masuk: jalankan animasi biasa & tandai sesi
                pageWrapper.style.opacity = '1';
                sessionStorage.setItem('rhine_lab_visited', 'true');
            }
        });
    </script>
</body>
</html>