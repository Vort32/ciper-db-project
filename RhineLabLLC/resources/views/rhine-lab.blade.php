@extends('layouts.app')

@section('title', 'RHINE LAB.LLC')

@section('content')
    <!-- ==============================================
         ADVANCED ARKNIGHTS / RHINE LAB LOADING SCREEN
         ============================================== -->
    <div id="pageLoader" class="fixed inset-0 z-50 flex flex-col items-center justify-center bg-[#f4f2ee]/95 backdrop-blur-[20px] transition-all duration-1000 overflow-hidden">
        
        <!-- Background Tech Elements -->
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none hex-bg"></div>
        
        <!-- Vertical Scanline Effect -->
        <div class="absolute w-full h-[2px] bg-[#48AA8C]/40 top-0 animate-scan-vertical shadow-[0_0_20px_#48AA8C] z-0"></div>

        <!-- Decorative Corners (HUD Style) -->
        <div class="absolute top-8 left-8 w-16 h-16 border-t-2 border-l-2 border-gray-400/50"></div>
        <div class="absolute top-8 right-8 w-16 h-16 border-t-2 border-r-2 border-gray-400/50"></div>
        <div class="absolute bottom-8 left-8 w-16 h-16 border-b-2 border-l-2 border-gray-400/50"></div>
        <div class="absolute bottom-8 right-8 w-16 h-16 border-b-2 border-r-2 border-gray-400/50"></div>

        <!-- Floating Data Ring (Center Background) -->
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[35rem] h-[35rem] border border-gray-300/30 rounded-full border-dashed animate-spin-slow opacity-50 z-0"></div>

        <div class="relative z-10 flex flex-col items-center w-full max-w-4xl px-6 sm:px-12">
            
            <!-- Branding / Logo Area -->
            <div class="mb-16 flex flex-col items-center relative">
                <div class="absolute -left-6 top-2 w-1.5 h-6 bg-[#C4FF00] shadow-[0_0_10px_#C4FF00] animate-pulse"></div>
                <h1 class="text-4xl sm:text-6xl md:text-7xl font-black tracking-[0.3em] text-[#1c1c1c] mb-1 uppercase select-none">RHINE LAB</h1>
                <div class="flex items-center gap-3">
                    <span class="w-8 sm:w-12 h-[1px] bg-gray-400"></span>
                    <p class="text-[9px] sm:text-[11px] tracking-[0.5em] text-gray-500 uppercase font-extrabold select-none">SYNTHESIZE INFORMATION OS</p>
                    <span class="w-8 sm:w-12 h-[1px] bg-gray-400"></span>
                </div>
            </div>

            <!-- Loading Bar Container (HUD Interface) -->
            <div class="w-full relative mt-4">
                
                <!-- Top Console Data -->
                <div class="flex justify-between items-end mb-2 font-mono text-[8px] sm:text-[10px] text-gray-500 tracking-[0.15em] uppercase">
                    <div class="flex flex-col">
                        <span id="akConsoleOutput" class="text-[#EA7645] font-bold h-4">INIT_SYSTEM...</span>
                        <span class="text-gray-400 text-[7px] sm:text-[8px]">> EXECUTING_PROTOCOL: RHL-ALPHA</span>
                    </div>
                    <div class="text-right">
                        <span>SYS.MEM: <span class="animate-pulse text-[#48AA8C] font-bold">ALLOCATING</span></span><br>
                        <span class="text-gray-400">SEC_LEVEL: CLASSIFIED</span>
                    </div>
                </div>

                <!-- The Progress Bar -->
                <div class="relative w-full h-[12px] sm:h-[16px] border border-gray-400/80 bg-white/30 backdrop-blur-sm p-[2px] flex items-center shadow-lg">
                    <!-- Segmented Track Background -->
                    <div class="absolute inset-0 opacity-15" style="background-image: repeating-linear-gradient(90deg, transparent, transparent 3px, #000 3px, #000 6px);"></div>

                    <!-- Solid Fill -->
                    <div id="akProgressBar" class="relative h-full bg-[#2c2c2c] w-0 transition-all duration-[80ms] ease-linear overflow-hidden">
                        <!-- Shimmer / Shine effect on the bar -->
                        <div class="absolute inset-0 w-24 bg-gradient-to-r from-transparent via-white/20 to-transparent skew-x-[-30deg] animate-shimmer"></div>
                    </div>
                    
                    <!-- Leading Edge Glow (Neon Accent) -->
                    <div id="akProgressGlow" class="absolute h-full w-2 sm:w-3 bg-[#EA7645] shadow-[0_0_12px_#EA7645] transition-all duration-[80ms] ease-linear z-10 left-0"></div>
                </div>

                <!-- Bottom Metrics -->
                <div class="mt-3 flex justify-between items-end font-mono">
                    <div class="flex items-center gap-2">
                        <div id="akStatusDot" class="w-2 h-2 bg-[#EA7645] animate-ping rounded-full border border-white"></div>
                        <span id="akStatusText" class="text-[9px] sm:text-[11px] font-bold text-gray-800 tracking-[0.2em]">CONNECTING TO SERVER</span>
                    </div>
                    
                    <div class="text-3xl sm:text-4xl font-black text-[#1c1c1c] tracking-widest flex items-baseline leading-none">
                        <span id="akProgressText">0</span><span class="text-sm sm:text-base text-gray-500 ml-1">%</span>
                    </div>
                </div>
                
                <!-- Tiny barcode decorative -->
                <div class="absolute -bottom-10 right-0 opacity-40 flex items-end gap-[2px] h-4">
                    <div class="w-[2px] h-full bg-gray-600"></div><div class="w-[1px] h-3 bg-gray-600"></div><div class="w-[3px] h-full bg-gray-600"></div><div class="w-[1px] h-2 bg-gray-600"></div><div class="w-[2px] h-4 bg-gray-600"></div><div class="w-[4px] h-full bg-gray-600"></div><div class="w-[1px] h-3 bg-gray-600"></div>
                    <span class="text-[6px] font-mono ml-1 text-gray-600">RL-ARCHIVE-XX</span>
                </div>
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
           ADVANCED ANIMATIONS (RHINE LAB HUD)
           ========================================= */
        
        /* Scanline Animasi dari atas ke bawah berulang */
        @keyframes scanVertical {
            0% { top: -5%; opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { top: 105%; opacity: 0; }
        }
        .animate-scan-vertical { animation: scanVertical 3.5s linear infinite; }

        /* Shimmer (Kilap cahaya) melintasi loading bar */
        @keyframes shimmer {
            0% { transform: translateX(-100%) skewX(-30deg); }
            100% { transform: translateX(500%) skewX(-30deg); }
        }
        .animate-shimmer { animation: shimmer 2s infinite; }

        /* Putaran lambat untuk HUD Lingkaran background */
        @keyframes spinSlow {
            from { transform: translate(-50%, -50%) rotate(0deg); }
            to { transform: translate(-50%, -50%) rotate(360deg); }
        }
        .animate-spin-slow { animation: spinSlow 30s linear infinite; }

        /* Background Pattern Hexagon Tipis (Khas Sci-Fi / Arknights) */
        .hex-bg {
            background-image: url("data:image/svg+xml,%3Csvg width='40' height='69.282' viewBox='0 0 40 69.282' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M40 11.547L20 0 0 11.547v23.094l20 11.547 20-11.547V11.547zM20 45.034L1.155 34.148V12.376L20 1.49l18.845 10.886v21.772L20 45.034z' fill='%23000000' fill-opacity='0.05' fill-rule='evenodd'/%3E%3Cpath d='M40 46.188L20 34.641 0 46.188v23.094l20 11.547 20-11.547V46.188zM20 79.675L1.155 68.789V47.017L20 36.13l18.845 10.886v21.772L20 79.675z' fill='%23000000' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
            background-size: 60px 103.923px;
        }

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
        
        // Elemen Loader Arknights Baru
        const progressBar = document.getElementById('akProgressBar');
        const progressGlow = document.getElementById('akProgressGlow');
        const progressText = document.getElementById('akProgressText');
        const consoleOutput = document.getElementById('akConsoleOutput');
        const statusText = document.getElementById('akStatusText');
        const statusDot = document.getElementById('akStatusDot');
        
        // Array Teks Konsol Hacker/Tech
        const consoleMessages = [
            "INIT_SYSTEM...",
            "VERIFYING_CREDENTIALS...",
            "DECRYPTING_CLASSIFIED_FILES...",
            "MOUNTING_ORIGINIUM_ARTS_DB...",
            "BYPASSING_SECURITY_PROTOCOLS...",
            "ESTABLISHING_SECURE_CONNECTION..."
        ];

        const welcomeText = "WELCOME TO";
        const welcomeElem = document.getElementById('welcomeText');
        const delayedAnimateElems = Array.from(document.querySelectorAll('.pre-animate'));
        
        let i = 0;
        let progressValue = 0;
        let progressTimer;
        let consoleTimer;

        // Fungsi Animasi Teks Ketik (Typewriter) untuk WELCOME TO
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

        // Animasi transisi saat link navigasi diklik
        const links = document.querySelectorAll('.nav-link');
        links.forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                const href = this.getAttribute('href');
                wrapper.classList.add('fade-out');
                setTimeout(() => {
                    window.location.href = href;
                }, 700); 
            });
        });

        // Logika Loading Arknights Lanjutan
        if (loader) {
            requestAnimationFrame(() => {
                
                // Rotasi Teks Konsol Terminal
                let msgIndex = 0;
                consoleTimer = setInterval(() => {
                    if (consoleOutput && msgIndex < consoleMessages.length) {
                        consoleOutput.textContent = consoleMessages[msgIndex];
                        msgIndex++;
                    }
                }, 400); // Ganti teks tiap 400ms

                progressTimer = setInterval(() => {
                    // Kecepatan acak (random interval) agar terasa seperti loading server sungguhan
                    let step = Math.floor(Math.random() * 8) + 1; 
                    progressValue = Math.min(progressValue + step, 100);
                    
                    // Update Lebar Bar & Posisi Leading Glow Accent
                    if (progressBar) progressBar.style.width = `${progressValue}%`;
                    if (progressGlow) {
                        progressGlow.style.left = `calc(${progressValue}% - ${progressValue === 100 ? 0 : 8}px)`; 
                    }
                    if (progressText) progressText.textContent = progressValue;
                    
                    // JIKA SELESAI (100%)
                    if (progressValue === 100) {
                        clearInterval(progressTimer);
                        clearInterval(consoleTimer);
                        
                        setTimeout(() => {
                            // Ubah UI menjadi status "Selesai" (Warna hijau / sistem siap)
                            if (statusText) {
                                statusText.textContent = 'SYSTEM READY // ACCESS GRANTED';
                                statusText.classList.remove('text-gray-800');
                                statusText.classList.add('text-[#48AA8C]'); // Hijau Rhine Lab
                            }
                            if (statusDot) {
                                statusDot.classList.remove('bg-[#EA7645]', 'animate-ping');
                                statusDot.classList.add('bg-[#48AA8C]', 'animate-pulse');
                            }
                            if (consoleOutput) {
                                consoleOutput.textContent = "OS_LOADED_SUCCESSFULLY.";
                                consoleOutput.classList.remove('text-[#EA7645]');
                                consoleOutput.classList.add('text-[#48AA8C]');
                            }
                            
                            // Eksekusi Pudar (Fade Out) & Tampilkan Beranda Utama
                            setTimeout(() => {
                                loader.classList.add('opacity-0');
                                loader.addEventListener('transitionend', () => loader.remove(), { once: true });
                                
                                if (wrapper) {
                                    wrapper.classList.remove('opacity-0');
                                    requestAnimationFrame(() => wrapper.classList.add('opacity-100'));
                                }
                                triggerDelayedAnimations();
                            }, 800); // Tahan sebentar tulisan ACCESS GRANTED sebelum menghilang
                            
                        }, 250);
                    }
                }, 60); // Interval update bar progress
            });
        } else if (wrapper) {
            // Jika loader tidak ada/dihapus, langsung tampil
            wrapper.classList.remove('opacity-0');
            requestAnimationFrame(() => wrapper.classList.add('opacity-100'));
            triggerDelayedAnimations();
        }

        // Trigger animasi elemen halaman utama setelah loading selesai
        function triggerDelayedAnimations() {
            if (!delayedAnimateElems.length) return;
            delayedAnimateElems.forEach((elem, index) => {
                const animationClass = elem.getAttribute('data-animate');
                const existingDelay = parseFloat(elem.style.animationDelay || 0);
                // Jeda berurutan
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
    </script>
@endsection