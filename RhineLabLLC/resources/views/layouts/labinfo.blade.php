<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('images/logo1.png') }}">
    @vite('resources/css/app.css')

    <style>
        /* Paksa semua elemen transparan muncul saat tombol Back Chrome ditekan */
        body.bfcache-active #pageWrapper,
        body.bfcache-active .opacity-0,
        body.bfcache-active .pre-animate {
            opacity: 1 !important;
            visibility: visible !important;
            transform: none !important;
            transition: none !important;
            animation: none !important;
        }
    </style>
</head>
<body class="antialiased bg-[#ECE8E5] min-h-screen relative overflow-hidden">
    @yield('content')

    <!-- Alpine.js -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <script>
        // Penanganan tombol Back/Forward Chrome (BFCache)
        window.addEventListener('pageshow', function(event) {
            if (event.persisted || (window.performance && window.performance.navigation.type === 2)) {
                document.body.classList.add('bfcache-active');
                
                const pageWrapper = document.getElementById('pageWrapper');
                if (pageWrapper) {
                    pageWrapper.style.opacity = '1';
                    pageWrapper.style.visibility = 'visible';
                }

                document.querySelectorAll('.opacity-0, .pre-animate').forEach(function(el) {
                    el.style.opacity = '1';
                    el.style.visibility = 'visible';
                    el.style.transform = 'none';
                });
            }
        });
    </script>
</body>
</html>