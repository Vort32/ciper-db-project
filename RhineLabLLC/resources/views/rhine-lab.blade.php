@extends('layouts.app')

@section('title', 'RHINE LAB.LLC')

@section('content')
    <!-- ==============================================
         RHINE LAB // EXACT REPLICA BOOT LOADER (00:18)
         ============================================== -->
    <div id="pageLoader" class="fixed inset-0 z-50 overflow-hidden bg-[#ECE8E5] font-sans text-[#1c1c1c] select-none flex items-center justify-center">
        
        <!-- Latar Belakang & Watermark DNA Samar -->
        <div class="absolute inset-0 z-0 opacity-10 pointer-events-none" style="background-image: repeating-linear-gradient(45deg, #d3cfc9 0px, #d3cfc9 1px, transparent 1px, transparent 40px);"></div>
        <div class="absolute inset-0 z-0 opacity-[0.03] pointer-events-none flex items-center justify-center">
            <!-- DNA Helix Abstract Shape -->
            <svg viewBox="0 0 100 100" class="w-[80vw] h-[80vw] max-w-[800px] max-h-[800px]" fill="none" stroke="#000" stroke-width="2">
                <path d="M 20 10 Q 50 50 80 90 M 80 10 Q 50 50 20 90" stroke-dasharray="4 4" />
            </svg>
        </div>

        <!-- Shutter Panel (Efek Pintu Terbuka) -->
        <div id="shutterTop" class="absolute top-0 left-0 w-full h-[50%] bg-[#ECE8E5] z-10 transition-transform duration-[1100ms] cubic-bezier-shutter"></div>
        <div id="shutterBottom" class="absolute bottom-0 left-0 w-full h-[50%] bg-[#ECE8E5] z-10 transition-transform duration-[1100ms] cubic-bezier-shutter"></div>

        <!-- Layer UI Utama (Teks & Cincin) -->
        <div id="loaderUI" class="absolute inset-0 z-20 flex flex-col justify-center items-center transition-opacity duration-500">
            
            <!-- Top Left Typography (Sesuai Referensi Gambar) -->
            <div class="absolute top-10 left-10 sm:top-12 sm:left-14 flex flex-col">
                <h1 class="text-3xl sm:text-4xl font-black tracking-widest text-[#1c1c1c] leading-none mb-1">RHINE LAB</h1>
                <p class="text-[7.5px] sm:text-[9px] font-bold tracking-[0.25em] text-[#1c1c1c] uppercase leading-none mb-0.5">SYNTHESIZE INFORMATION</p>
                <p class="text-lg sm:text-xl font-light tracking-[0.25em] text-[#1c1c1c] uppercase leading-none">ANALYSIS <span class="font-bold">OS</span></p>
            </div>

            <!-- Pusat: Cincin Minimalis Berputar -->
            <div class="relative w-[280px] h-[280px] sm:w-[320px] sm:h-[320px] flex items-center justify-center">
                
                <!-- SVG Rings -->
                <svg class="absolute inset-0 w-full h-full" viewBox="0 0 300 300">
                    
                    <!-- 1. Inner Broken Black Arcs (Berputar Berlawanan Arah Jarum Jam) -->
                    <g class="origin-[150px_150px] animate-[spin_12s_linear_infinite_reverse]">
                        <circle cx="150" cy="150" r="55" fill="none" stroke="#1c1c1c" stroke-width="1.2" stroke-dasharray="90 82.7" stroke-linecap="butt"/>
                    </g>

                    <!-- 2. Middle Solid White Circle -->
                    <circle cx="150" cy="150" r="92" fill="none" stroke="#ffffff" stroke-width="3.5" class="opacity-95" />

                    <!-- 3. Outer Black Arc dengan Titik (Berputar Searah Jarum Jam) -->
                    <g class="origin-[150px_150px] animate-[spin_15s_linear_infinite]">
                        <!-- Garis busur (sekitar 270 derajat) -->
                        <path d="M 72 228 A 110 110 0 1 1 258 130" fill="none" stroke="#1c1c1c" stroke-width="1.2" stroke-linecap="round"/>
                        <!-- Titik hitam di ujung busur -->
                        <circle cx="258" cy="130" r="3.5" fill="#1c1c1c" />
                    </g>

                    <!-- 4. Floating Orange Dots -->
                    <g class="origin-[150px_150px] animate-[spin_20s_linear_infinite]">
                        <circle cx="105" cy="195" r="4.5" fill="#EA7645" />
                        <circle cx="205" cy="110" r="4.5" fill="#EA7645" />
                    </g>
                </svg>

                <!-- Teks Di Tengah Cincin (Berganti Secara Dinamis) -->
                <div id="centerText" class="absolute inset-0 flex items-center justify-center text-[9px] sm:text-[10px] font-medium tracking-[0.25em] text-[#1c1c1c] text-center px-6 transition-opacity duration-300 opacity-0 uppercase">
                    ACCESS PERMISSION REQUIRED
                </div>
            </div>

            <!-- Bottom Right Typography -->
            <div class="absolute bottom-10 right-10 sm:bottom-12 sm:right-14 flex items-center gap-3">
                <span class="text-[7.5px] sm:text-[9px] font-bold tracking-[0.2em] uppercase text-[#1c1c1c]">POWERED BY RHINE LAB</span>
                <span class="w-4 h-[2px] bg-[#1c1c1c]"></span>
            </div>

        </div>
    </div>

    <!-- ==============================================
         MAIN PAGE WRAPPER
         ============================================== -->
    <div id="pageWrapper"
        class="min-h-screen flex flex-col justify-center items-center bg-[#ECE8E5] text-black relative overflow-hidden transition-opacity duration-[1200ms] opacity-0">

        <!-- Background image dengan opacity -->
        <div class="absolute inset-0 bg-cover bg-center opacity-7"
            style="background-image: url('{{ asset('images/Rhine_Lab_HQ1.png') }}');">
        </div>

        <!-- Header kiri atas -->
        <div class="absolute top-6 left-6 leading-tight select-none space-y-1 z-10">
            <h1 class="text-2xl font-bold pre-animate" data-animate="animate-slide-fade" style="animation-delay: 0.2s;">RHINE LAB</h1>
            <p class="text-[10px] tracking-[0.2em] uppercase pre-animate" data-animate="animate-slide-fade" style="animation-delay: 0.4s;">
                SYNTHESIZE INFORMATION
            </p>
            <p class="text-base sm:text-lg md:text-xl font- pre-animate" data-animate="animate-slide-fade" style="animation-delay: 0.6s;">
                ANALYSIS <span class="font-bold">OS</span>
            </p>
        </div>

        <!-- Tombol login kanan atas -->
        <div class="absolute top-6 right-6 z-10 select-none flex flex-col items-end space-y-2">
            @auth
                <a href="{{ route('logout.view') }}"
                    class="text-[10px] sm:text-xs font-semibold uppercase tracking-[0.32em] text-black transition hover:text-[#EA7645]">
                    Session
                </a>
                <div class="glass-login flex items-center gap-2 rounded-xl px-3 py-1">
                    <span class="text-[10px] sm:text-xs font-semibold tracking-wide text-black">{{ auth()->user()->name }}</span>
                    <span class="h-8 w-8 overflow-hidden rounded-full border border-white shadow">
                        <img src="{{ asset(auth()->user()->photo_path ?? 'images/users/Silence.png') }}" alt="{{ auth()->user()->name }}"
                            class="h-full w-full object-cover">
                    </span>
                </div>
            @else
                <a href="{{ route('login') }}"
                    class="text-[10px] sm:text-xs font-semibold uppercase tracking-[0.32em] text-black transition hover:text-[#EA7645]">
                    Login
                </a>
            @endauth
        </div>

        <!-- Konten tengah -->
        <div class="relative z-10 flex flex-col items-center text-center space-y-6 select-none">

            <!-- WELCOME TO (typewriter effect) -->
            <h2 id="welcomeText" class="text-2xl sm:text-3xl md:text-4xl font-semibold tracking-wide pre-animate"
                data-animate="animate-slide-fade" style="color:black;"></h2>

            <!-- RHINE LAB.LLC. -->
            <h3 class="text-3xl sm:text-4xl md:text-5xl font-bold bg-black text-white px-5 py-1 tracking-wider shadow opacity-0 pre-animate"
                data-animate="animate-fade-up" style="animation-delay: 1s;">
                RHINE LAB.LLC.
            </h3>

            <!-- Navigasi minimalis -->
            <nav class="flex space-x-8 mt-4 opacity-0 pre-animate" data-animate="animate-fade-up" style="animation-delay: 1.2s;">
                <a href="{{ url('/rhineinfo') }}"
                    class="nav-link relative text-gray-700 font-light tracking-wide hover:text-black transition">
                    INFO
                    <span class="absolute left-0 -bottom-1 w-0 h-[1px] bg-black transition-all duration-300 hover:w-full"></span>
                </a>
                <a href="{{ url('/gallery') }}"
                    class="nav-link relative text-gray-700 font-light tracking-wide hover:text-black transition">
                    RESEARCH
                    <span class="absolute left-0 -bottom-1 w-0 h-[1px] bg-black transition-all duration-300 hover:w-full"></span>
                </a>
                <a href="{{ route('research.ledger') }}"
                    class="nav-link relative text-gray-700 font-light tracking-wide hover:text-black transition">
                    USER
                    <span class="absolute left-0 -bottom-1 w-0 h-[1px] bg-black transition-all duration-300 hover:w-full"></span>
                </a>
            </nav>

            <!-- Logo Tengah dengan zoom out -->
            <div class="flex flex-col items-center mt-6 select-none opacity-0 pre-animate"
                data-animate="animate-zoom-out" style="animation-delay: 1.4s;">
                <img src="{{ asset('images/logo.png') }}" alt="Rhine Lab Logo"
                    class="w-44 h-44 sm:w-52 sm:h-52 object-contain" />
            </div>
        </div>

        <!-- Footer kanan bawah  -->
        <div class="absolute bottom-3 right-3 text-[10px] sm:text-xs md:text-sm lg:text-base font-light select-none opacity-0 pre-animate z-10"
            data-animate="animate-fade-up" style="animation-delay: 1.6s;">
            POWERED BY <span class="font-bold">RHINE LAB</span>
        </div>

        <!-- Footer tengah bawah -->
        <div class="absolute bottom-2 w-full text-center text-xs text-gray-600 select-none opacity-0 pre-animate z-10"
            data-animate="animate-fade-up" style="animation-delay: 1.8s;">
            Internal Database
        </div>
    </div>

    <style>
        /* =========================================
           CUSTOM CSS ANIMATIONS & STYLES
           ========================================= */
        
        /* Exponential Ease Out Shutter Curve (Halus banget) */
        .cubic-bezier-shutter {
            transition-timing-function: cubic-bezier(0.22, 1, 0.36, 1);
        }

        /* Trigger Animasi Shutter Terbuka */
        .shutter-open-top { transform: translateY(-100%); }
        .shutter-open-bottom { transform: translateY(100%); }

        /* Standard Page Animations */
        @keyframes fadeUp { 0% { opacity: 0; transform: translateY(20px); } 100% { opacity: 1; transform: translateY(0); } }
        .animate-fade-up { animation: fadeUp 0.8s forwards; }

        @keyframes slideFade { 0% { opacity: 0; transform: translateX(-20px); } 100% { opacity: 1; transform: translateX(0); } }
        .animate-slide-fade { animation: slideFade 0.8s forwards; }

        @keyframes zoomOut { 0% { opacity: 0; transform: scale(2); } 100% { opacity: 1; transform: scale(1); } }
        .animate-zoom-out { animation: zoomOut 1s forwards; }

        .fade-out { opacity: 0; }

        /* GLASS LOGIN BUTTON */
        .glass-login {
            color: #1f1f1f; background-color: rgba(255, 255, 255, 0.28); border: 1px solid rgba(255, 255, 255, 0.6);
            box-shadow: 0 8px 32px rgba(31, 31, 31, 0.1); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px);
        }
    </style>

    <script>
        const wrapper = document.getElementById('pageWrapper');
        const loader = document.getElementById('pageLoader');

        const welcomeText = "WELCOME TO";
        const welcomeElem = document.getElementById('welcomeText');
        const delayedAnimateElems = Array.from(document.querySelectorAll('.pre-animate'));

        let i = 0;

        function typeWriter() {
            if (!welcomeElem) return;
            welcomeElem.textContent = '';
            welcomeElem.classList.remove('animate-slide-fade');
            i = 0;

            const typing = () => {
                if (i < welcomeText.length) {
                    welcomeElem.textContent += welcomeText.charAt(i);
                    i++;
                    setTimeout(typing, 130);
                }
            };
            typing();
        }
        window.addEventListener('DOMContentLoaded', typeWriter);

        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                const href = this.getAttribute('href');
                wrapper.classList.add('fade-out');
                setTimeout(() => { window.location.href = href; }, 700);
            });
        });

        function revealMain() {
            if (wrapper) {
                wrapper.classList.remove('opacity-0');
                requestAnimationFrame(() => wrapper.classList.add('opacity-100'));
            }
            triggerDelayedAnimations();
        }

        /* =========================================
           EXACT PV ANIMATION SEQUENCE LOGIC
           ========================================= */
        if (loader) {
            const centerText = document.getElementById('centerText');
            const loaderUI = document.getElementById('loaderUI');
            const sTop = document.getElementById('shutterTop');
            const sBottom = document.getElementById('shutterBottom');
            
            const username = "{{ auth()->check() ? auth()->user()->name : 'OPERATIVE' }}".toUpperCase();

            // Urutan teks yang akan muncul di tengah cincin
            const sequence = [
                "ACCESS PERMISSION REQUIRED",
                `ID CONFIRMED // ${username}`,
                "PERMISSION AUTHORIZED"
            ];

            let step = 0;

            function animateTextSequence() {
                if (step < sequence.length) {
                    // Ganti teks dan munculkan (fade in)
                    centerText.textContent = sequence[step];
                    centerText.classList.remove('opacity-0');
                    centerText.classList.add('opacity-100');
                    
                    // Tahan teks selama 1.2 detik, lalu pudarkan (kecuali teks terakhir)
                    setTimeout(() => {
                        if (step < sequence.length - 1) {
                            centerText.classList.remove('opacity-100');
                            centerText.classList.add('opacity-0');
                            
                            // Lanjut ke teks berikutnya setelah pudar
                            setTimeout(() => {
                                step++;
                                animateTextSequence();
                            }, 400); 
                        } else {
                            // Teks terakhir selesai ditahan, mulai transisi shutter terbuka
                            triggerShutterOpen();
                        }
                    }, 1200);
                }
            }

            function triggerShutterOpen() {
                // 1. Pudarkan seluruh UI (Cincin & Teks)
                loaderUI.classList.remove('opacity-100');
                loaderUI.classList.add('opacity-0');

                // 2. Buka pintu shutter ke atas & bawah
                setTimeout(() => {
                    sTop.classList.add('shutter-open-top');
                    sBottom.classList.add('shutter-open-bottom');
                    
                    // 3. Tampilkan halaman utama di balik shutter
                    setTimeout(revealMain, 400);
                    
                    // 4. Hapus elemen loader dari DOM
                    setTimeout(() => loader.remove(), 1200);
                }, 400);
            }

            // Mulai sequence teks
            setTimeout(animateTextSequence, 300);

        } else if (wrapper) {
            revealMain();
        }

        function triggerDelayedAnimations() {
            if (!delayedAnimateElems.length) return;
            delayedAnimateElems.forEach((elem, index) => {
                const animationClass = elem.getAttribute('data-animate');
                const existingDelay = parseFloat(elem.style.animationDelay || 0);
                const extraDelay = index * 0.12;
                elem.style.animationDelay = `${existingDelay + 0.3 + extraDelay}s`;
                elem.classList.remove('pre-animate');
                if (animationClass) {
                    requestAnimationFrame(() => elem.classList.add(animationClass));
                }
            });

            if (delayedAnimateElems.includes(welcomeElem)) {
                const computedDelay = parseFloat(welcomeElem.style.animationDelay || 0) * 1000;
                setTimeout(() => {
                    welcomeElem.classList.add('animate-slide-fade');
                    typeWriter();
                }, computedDelay);
            }
        }

        // Fix Stuck BFCache Navigation (Tombol Back Browser)
        window.addEventListener('pageshow', function (event) {
            if (event.persisted || (window.performance && window.performance.navigation.type === 2)) {
                const activeLoader = document.getElementById('pageLoader');
                if (activeLoader) activeLoader.remove();
                if (wrapper) {
                    wrapper.classList.remove('opacity-0', 'fade-out');
                    wrapper.style.opacity = '1';
                    wrapper.style.visibility = 'visible';
                }
                triggerDelayedAnimations();
            }
        });
    </script>
@endsection