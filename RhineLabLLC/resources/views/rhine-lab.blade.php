@extends('layouts.app')

@section('title', 'RHINE LAB.LLC')

@section('content')
    <!-- ==============================================
         RHINE LAB // LIQUID GLASS BOOT LOADER
         ============================================== -->
    <div id="pageLoader" class="fixed inset-0 z-50 overflow-hidden bg-[#ECE8E5] font-sans text-[#1c1c1c] select-none flex items-center justify-center">
        
        <!-- Ambient Liquid Glow Background -->
        <div class="absolute w-[36rem] h-[36rem] bg-white/60 rounded-full blur-[100px] -top-20 -left-20 z-0 pointer-events-none"></div>
        <div class="absolute w-[30rem] h-[30rem] bg-[#EA7645]/15 rounded-full blur-[90px] bottom-0 right-0 z-0 pointer-events-none"></div>
        <div class="absolute w-80 h-80 bg-[#48AA8C]/15 rounded-full blur-[90px] top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-0 pointer-events-none"></div>

        <!-- Shutter Panel (Efek Pintu Terbuka Liquid Glass) -->
        <div id="shutterTop" class="absolute top-0 left-0 w-full h-[50.1%] bg-[#ECE8E5] z-10 border-b border-white/60 transition-transform duration-[1200ms] cubic-bezier-shutter">
            <div class="absolute inset-0 opacity-[0.12] pointer-events-none" style="background-image: linear-gradient(to right, #1c1c1c 1px, transparent 1px), linear-gradient(to bottom, #1c1c1c 1px, transparent 1px); background-size: 36px 36px;"></div>
        </div>
        <div id="shutterBottom" class="absolute bottom-0 left-0 w-full h-[50.1%] bg-[#ECE8E5] z-10 border-t border-white/60 transition-transform duration-[1200ms] cubic-bezier-shutter">
            <div class="absolute inset-0 opacity-[0.12] pointer-events-none" style="background-image: linear-gradient(to right, #1c1c1c 1px, transparent 1px), linear-gradient(to bottom, #1c1c1c 1px, transparent 1px); background-size: 36px 36px;"></div>
        </div>

        <!-- Layer UI Utama (Liquid Glass Dashboard) -->
        <div id="loaderUI" class="absolute inset-0 z-20 flex flex-col justify-between items-center p-8 sm:p-12 transition-opacity duration-500">
            
            <!-- Top Left & Right Liquid Glass Cards -->
            <header class="w-full max-w-5xl flex justify-between items-center font-mono text-[9px] sm:text-[10px] tracking-[0.25em] text-[#1c1c1c] uppercase">
                <div class="glass-pill px-4 py-2 rounded-full flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-[#EA7645] animate-pulse"></span>
                    <span class="font-bold">RHINE LAB LLC</span>
                    <span class="text-gray-400 font-normal">// SYSTEM_BOOT</span>
                </div>
                <div class="glass-pill px-4 py-2 rounded-full flex items-center gap-2">
                    <span class="text-gray-500">CLEARANCE:</span>
                    <span class="font-extrabold text-[#EA7645]">LEVEL-4</span>
                </div>
            </header>

            <!-- Pusat: Glassmorphism Floating Core & Ring Loader -->
            <main class="relative z-10 flex flex-col items-center justify-center my-auto">
                
                <!-- Liquid Glass Ring Container -->
                <div class="relative w-[280px] h-[280px] sm:w-[320px] sm:h-[320px] flex items-center justify-center">
                    
                    <!-- SVG Rings (Inner & Outer Motion) -->
                    <svg class="absolute inset-0 w-full h-full" viewBox="0 0 300 300">
                        <!-- Outer Rotating Arc -->
                        <g class="origin-[150px_150px] animate-[spin_16s_linear_infinite]">
                            <path d="M 60 210 A 110 110 0 1 1 250 120" fill="none" stroke="rgba(28,28,28,0.3)" stroke-width="1.5" stroke-linecap="round"/>
                            <circle cx="250" cy="120" r="4" fill="#EA7645" />
                        </g>

                        <!-- Inner Dash Ring -->
                        <g class="origin-[150px_150px] animate-[spin_12s_linear_infinite_reverse]">
                            <circle cx="150" cy="150" r="70" fill="none" stroke="rgba(255,255,255,0.8)" stroke-width="2" stroke-dasharray="80 70" />
                        </g>

                        <!-- Dynamic Glowing Progress Circle -->
                        <circle id="rlRingFill" cx="150" cy="150" r="92" 
                                fill="none" stroke="#EA7645" stroke-width="3" 
                                stroke-dasharray="578.05" stroke-dashoffset="578.05" 
                                stroke-linecap="round" class="transition-all duration-150 ease-out" />
                    </svg>

                    <!-- Core Logo Glass Sphere -->
                    <div class="glass-core w-28 h-28 sm:w-36 sm:h-36 p-5 rounded-full flex items-center justify-center z-10 shadow-2xl backdrop-blur-md border border-white/80">
                        <img src="{{ asset('images/logo.png') }}" alt="Rhine Lab" class="w-full h-full object-contain filter contrast-125" />
                    </div>
                </div>

                <!-- Teks Dynamic Console Di Bawah Cincin -->
                <div class="mt-8 text-center flex flex-col items-center font-mono">
                    <div id="centerText" class="text-xs sm:text-sm font-black tracking-[0.3em] text-[#1c1c1c] uppercase min-h-[1.5rem] transition-all duration-300">
                        ACCESS PERMISSION REQUIRED
                    </div>
                    <div class="flex items-center gap-2 mt-2 text-[9px] sm:text-[10px] font-bold tracking-[0.35em] text-gray-500 uppercase">
                        <span>SYSTEM SYNC:</span>
                        <span id="akProgressText" class="text-[#EA7645] font-black">0</span>%
                    </div>
                </div>
            </main>

            <!-- Bottom Terminal Bar Glass -->
            <footer class="w-full max-w-5xl z-10 flex flex-col gap-2 font-mono">
                <div class="flex justify-between items-center text-[9px] sm:text-[10px] tracking-[0.2em] text-gray-600 uppercase px-1">
                    <div class="flex items-center gap-2">
                        <span id="akStatusDot" class="w-2 h-2 rounded-full bg-[#EA7645] animate-ping"></span>
                        <span id="akStatusText" class="font-bold text-[#1c1c1c]">INITIALIZING...</span>
                    </div>
                    <div id="akConsoleOutput" class="text-[#EA7645] font-bold text-right">
                        BOOT_SEQ
                    </div>
                </div>

                <!-- Thin Modern Liquid Progress Bar -->
                <div class="w-full h-[3px] bg-white/60 backdrop-blur-sm rounded-full overflow-hidden border border-white/80">
                    <div id="akProgressBar" class="h-full bg-gradient-to-r from-[#EA7645] to-[#48AA8C] w-0 transition-all duration-150 ease-out"></div>
                </div>
            </footer>

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
           LIQUID GLASS STYLING & ANIMATIONS
           ========================================= */
        .glass-pill {
            background: rgba(255, 255, 255, 0.45);
            border: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.04);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
        }

        .glass-core {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.75), rgba(255, 255, 255, 0.35));
            box-shadow: inset 0 1px 2px rgba(255, 255, 255, 0.9), 0 20px 40px rgba(0, 0, 0, 0.08);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }

        /* Exponential Ease Out Shutter Curve */
        .cubic-bezier-shutter {
            transition-timing-function: cubic-bezier(0.16, 1, 0.3, 1);
        }

        /* Trigger Animasi Shutter Terbuka */
        .shutter-open-top { transform: translateY(-101%); }
        .shutter-open-bottom { transform: translateY(101%); }

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
           LIQUID GLASS LOADER LOGIC
           ========================================= */
        if (loader) {
            const centerText = document.getElementById('centerText');
            const loaderUI = document.getElementById('loaderUI');
            const ringFill = document.getElementById('rlRingFill');
            const progressBar = document.getElementById('akProgressBar');
            const progressText = document.getElementById('akProgressText');
            const statusText = document.getElementById('akStatusText');
            const consoleOutput = document.getElementById('akConsoleOutput');
            const statusDot = document.getElementById('akStatusDot');
            
            const sTop = document.getElementById('shutterTop');
            const sBottom = document.getElementById('shutterBottom');

            const CIRCUMFERENCE = 578.05; // 2 * PI * 92
            const username = "{{ auth()->check() ? auth()->user()->name : 'OPERATIVE' }}".toUpperCase();

            let progressValue = 0;
            let pageReady = document.readyState === 'complete';
            let finished = false;

            window.addEventListener('load', () => { pageReady = true; });

            function renderProgress(val) {
                const rounded = Math.round(val);
                if (progressText) progressText.textContent = rounded;
                if (progressBar) progressBar.style.width = `${val}%`;

                if (ringFill) {
                    const offset = CIRCUMFERENCE - (val / 100) * CIRCUMFERENCE;
                    ringFill.style.strokeDashoffset = offset;
                }

                // Dynamic Terminal Output
                if (val < 30) {
                    if (centerText) centerText.textContent = "ACCESS PERMISSION REQUIRED";
                    if (consoleOutput) consoleOutput.textContent = "ID_CHECK";
                    if (statusText) statusText.textContent = "INITIALIZING SYSTEM...";
                } else if (val < 65) {
                    if (centerText) centerText.textContent = `ID CONFIRMED // ${username}`;
                    if (consoleOutput) consoleOutput.textContent = "VERIFIED";
                    if (statusText) statusText.textContent = "AUTHENTICATING...";
                } else if (val < 95) {
                    if (centerText) centerText.textContent = "REQUEST RECEIVED // START PROCESSING";
                    if (consoleOutput) consoleOutput.textContent = "PROCESSING";
                    if (statusText) statusText.textContent = "DECRYPTING ARCHIVES...";
                } else {
                    if (centerText) {
                        centerText.textContent = "PERMISSION AUTHORIZED";
                        centerText.classList.add('text-[#48AA8C]');
                    }
                    if (consoleOutput) {
                        consoleOutput.textContent = "GRANTED";
                        consoleOutput.classList.remove('text-[#EA7645]');
                        consoleOutput.classList.add('text-[#48AA8C]');
                    }
                    if (statusText) {
                        statusText.textContent = "ACCESS GRANTED";
                        statusText.classList.add('text-[#48AA8C]');
                    }
                    if (statusDot) {
                        statusDot.classList.remove('bg-[#EA7645]', 'animate-ping');
                        statusDot.classList.add('bg-[#48AA8C]');
                    }
                    if (ringFill) {
                        ringFill.style.stroke = '#48AA8C';
                    }
                }
            }

            function finishLoading() {
                finished = true;

                // Transisi Smooth Pembukaan Loader
                setTimeout(() => {
                    loaderUI.classList.add('opacity-0');
                    
                    setTimeout(() => {
                        sTop.classList.add('shutter-open-top');
                        sBottom.classList.add('shutter-open-bottom');
                        
                        setTimeout(revealMain, 400);
                        setTimeout(() => loader.remove(), 1200);
                    }, 350);
                }, 800);
            }

            const progressTimer = setInterval(() => {
                const cap = pageReady ? 100 : 92;
                let step = Math.floor(Math.random() * 5) + 2;
                progressValue = Math.min(progressValue + step, cap);

                renderProgress(progressValue);

                if (progressValue >= 100 && !finished) {
                    clearInterval(progressTimer);
                    finishLoading();
                }
            }, 50);

            renderProgress(0);

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

        // BFCache Navigation Fix
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