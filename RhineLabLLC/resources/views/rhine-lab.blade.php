@extends('layouts.app')

@section('title', 'RHINE LAB.LLC')

@section('content')
    <!-- ==============================================
         RHINE LAB // ULTRA-CLEAN BOOT LOADER
         ============================================== -->
    <div id="pageLoader" class="rl-clean-loader" role="status" aria-live="polite">

        <!-- Shutter Panel (Transisi Terbuka Atas & Bawah) -->
        <div class="rl-shutter rl-shutter-top"><div class="rl-hex"></div></div>
        <div class="rl-shutter rl-shutter-bottom"><div class="rl-hex"></div></div>

        <!-- Layer Konten UI Minimalis -->
        <div class="rl-layer flex flex-col justify-between items-center h-full w-full p-8 sm:p-12 pointer-events-none select-none">

            <!-- Frame Sudut Minimalis -->
            <span class="rl-corner rl-c-tl"></span>
            <span class="rl-corner rl-c-tr"></span>
            <span class="rl-corner rl-c-bl"></span>
            <span class="rl-corner rl-c-br"></span>

            <!-- Top HUD Header -->
            <header class="w-full max-w-4xl flex justify-between items-center z-10 font-mono text-[9px] sm:text-[10px] tracking-[0.25em] text-gray-500 uppercase">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 bg-[#EA7645]"></span>
                    <span class="font-bold text-[#1c1c1c] tracking-[0.3em]">RHINE LAB OS</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-gray-400">SEC_STATUS:</span>
                    <span class="font-bold text-[#EA7645] tracking-widest">CLASSIFIED</span>
                </div>
            </header>

            <!-- Center Core Area -->
            <main class="relative z-10 flex flex-col items-center justify-center my-auto">
                
                <!-- Title & Subtitle -->
                <div class="text-center mb-8 sm:mb-10">
                    <h1 class="text-3xl sm:text-5xl md:text-6xl font-black tracking-[0.35em] text-[#1c1c1c] uppercase leading-none">
                        RHINE LAB
                    </h1>
                    <p class="text-[8px] sm:text-[10px] font-semibold tracking-[0.5em] text-gray-400 uppercase mt-2.5">
                        SYNTHESIZE INFORMATION OS
                    </p>
                </div>

                <!-- Clean Circular Progress & Logo -->
                <div class="relative w-40 h-40 sm:w-52 sm:h-52 flex items-center justify-center">
                    
                    <!-- Circular SVG Ring -->
                    <svg class="absolute inset-0 w-full h-full -rotate-90" viewBox="0 0 200 200">
                        <!-- Ring Track -->
                        <circle cx="100" cy="100" r="88" stroke="#d5d2cc" stroke-width="1.5" fill="none" />
                        <!-- Active Ring Fill -->
                        <circle id="rlRingFill" cx="100" cy="100" r="88" 
                                class="stroke-[#EA7645] transition-all duration-100 ease-linear" 
                                stroke-width="2.5" 
                                stroke-dasharray="552.92" 
                                stroke-dashoffset="552.92" 
                                stroke-linecap="round"
                                fill="none" />
                    </svg>

                    <!-- Minimalist Logo Wrapper -->
                    <div class="w-24 h-24 sm:w-32 sm:h-32 p-5 bg-white/50 backdrop-blur-md rounded-full border border-white/80 shadow-sm flex items-center justify-center z-10">
                        <img src="{{ asset('images/logo.png') }}" alt="Rhine Lab" class="w-full h-full object-contain" />
                    </div>
                </div>

                <!-- Counter Percentage -->
                <div class="mt-6 font-mono text-xl sm:text-2xl font-bold tracking-[0.2em] text-[#1c1c1c] flex items-baseline">
                    <span id="akProgressText">0</span><span class="text-xs text-gray-400 ml-0.5">%</span>
                </div>

                <!-- Stamp ACCESS GRANTED -->
                <div id="rlStamp" class="rl-stamp">
                    ACCESS GRANTED
                </div>
            </main>

            <!-- Bottom Console Line -->
            <footer class="w-full max-w-4xl z-10 flex flex-col gap-2 font-mono">
                <div class="flex justify-between items-center text-[9px] sm:text-[10px] tracking-[0.2em] text-gray-500 uppercase">
                    <div class="flex items-center gap-2">
                        <span id="akStatusDot" class="w-1.5 h-1.5 bg-[#EA7645] rounded-full animate-pulse"></span>
                        <span id="akStatusText" class="font-semibold text-gray-700">INITIALIZING...</span>
                    </div>
                    <div id="akConsoleOutput" class="text-[#EA7645] font-semibold text-right">
                        SYSTEM_BOOT
                    </div>
                </div>

                <!-- Thin Modern Loading Bar -->
                <div class="w-full h-[2px] bg-gray-300/80 rounded-full overflow-hidden">
                    <div id="akProgressBar" class="h-full bg-[#1c1c1c] w-0 transition-all duration-100 ease-linear"></div>
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
           RHINE LAB // ULTRA-CLEAN LOADER STYLING
           ========================================= */
        .rl-clean-loader {
            position: fixed; inset: 0; z-index: 50; overflow: hidden;
            background: #ECE8E5; color: #1c1c1c;
            font-family: ui-monospace, SFMono-Regular, Menlo, Consolas, monospace;
        }

        /* Shutter Opening Animation */
        .rl-shutter {
            position: absolute; left: 0; width: 100%; height: 50.2%;
            background: #ECE8E5; overflow: hidden;
            transition: transform 0.85s cubic-bezier(.77, 0, .18, 1);
            z-index: 0;
        }
        .rl-shutter-top { top: 0; }
        .rl-shutter-bottom { bottom: 0; }
        
        /* Thin Accent Line at the Shutter Boundary */
        .rl-shutter-bottom::before, .rl-shutter-top::after {
            content: ""; position: absolute; left: 0; width: 100%; height: 2px; background: #1c1c1c;
            opacity: 0; transition: opacity .2s;
        }
        .rl-shutter-top::after { bottom: 0; }
        .rl-shutter-bottom::before { top: 0; }
        
        .rl-clean-loader.rl-open .rl-shutter::before, 
        .rl-clean-loader.rl-open .rl-shutter::after { opacity: 1; }

        /* Subtle Hex Pattern */
        .rl-hex {
            position: absolute; inset: 0; opacity: 0.25;
            background-image: url("data:image/svg+xml,%3Csvg width='40' height='69.282' viewBox='0 0 40 69.282' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M40 11.547L20 0 0 11.547v23.094l20 11.547 20-11.547V11.547zM20 45.034L1.155 34.148V12.376L20 1.49l18.845 10.886v21.772L20 45.034z' fill='%23000000' fill-opacity='0.05' fill-rule='evenodd'/%3E%3Cpath d='M40 46.188L20 34.641 0 46.188v23.094l20 11.547 20-11.547V46.188zM20 79.675L1.155 68.789V47.017L20 36.13l18.845 10.886v21.772L20 79.675z' fill='%23000000' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
            background-size: 60px 103.923px;
        }

        /* Shutter Slide Out */
        .rl-clean-loader.rl-open .rl-shutter-top { transform: translateY(-101%); }
        .rl-clean-loader.rl-open .rl-shutter-bottom { transform: translateY(101%); }
        .rl-clean-loader.rl-open .rl-layer { opacity: 0; transition: opacity .3s ease; }

        /* Minimal Corner Accents */
        .rl-corner { position: absolute; width: 24px; height: 24px; border: 0 solid rgba(28,28,28,.3); z-index: 10; }
        .rl-c-tl { top: 20px; left: 20px; border-top-width: 2px; border-left-width: 2px; }
        .rl-c-tr { top: 20px; right: 20px; border-top-width: 2px; border-right-width: 2px; }
        .rl-c-bl { bottom: 20px; left: 20px; border-bottom-width: 2px; border-left-width: 2px; }
        .rl-c-br { bottom: 20px; right: 20px; border-bottom-width: 2px; border-right-width: 2px; }

        /* ACCESS GRANTED Stamp */
        .rl-stamp {
            position: absolute; padding: 4px 16px; border: 2px solid #48AA8C; color: #48AA8C;
            font-weight: 900; letter-spacing: 0.35em; font-size: 13px; background: rgba(236,232,229,0.95);
            transform: rotate(-4deg) scale(1.5); opacity: 0; pointer-events: none; z-index: 20;
        }
        .rl-stamp.is-show { animation: rlStamp .4s cubic-bezier(.2,.9,.3,1.2) forwards; }

        @keyframes rlStamp { to { opacity: 1; transform: rotate(-4deg) scale(1); } }

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
           ULTRA-CLEAN LOADER LOGIC
           ========================================= */
        if (loader) {
            const $ = (id) => document.getElementById(id);
            const progressBar = $('akProgressBar');
            const ringFill = $('rlRingFill');
            const progressText = $('akProgressText');
            const consoleOutput = $('akConsoleOutput');
            const statusText = $('akStatusText');
            const statusDot = $('akStatusDot');
            const stampEl = $('rlStamp');

            const CIRCUMFERENCE = 552.92; // 2 * PI * 88

            const consoleMessages = [
                "SYSTEM_BOOT",
                "VERIFYING_AUTH",
                "DECRYPTING_DATA",
                "MOUNTING_DB",
                "ESTABLISHING_LINK"
            ];

            let progressValue = 0;
            let pageReady = document.readyState === 'complete';
            let finished = false;

            window.addEventListener('load', () => { pageReady = true; });

            // Terminal Console Message Rotator
            let msgIdx = 0;
            const consoleTimer = setInterval(() => {
                if (consoleOutput && msgIdx < consoleMessages.length) {
                    consoleOutput.textContent = consoleMessages[msgIdx];
                    msgIdx++;
                }
            }, 500);

            function renderProgress(val) {
                const rounded = Math.round(val);
                if (progressText) progressText.textContent = rounded;
                if (progressBar) progressBar.style.width = `${val}%`;

                // Ring Bar Stroke Fill Calculation
                if (ringFill) {
                    const offset = CIRCUMFERENCE - (val / 100) * CIRCUMFERENCE;
                    ringFill.style.strokeDashoffset = offset;
                }
            }

            function finishLoading() {
                finished = true;
                clearInterval(consoleTimer);

                // UI Update on Success
                if (statusText) {
                    statusText.textContent = 'ACCESS GRANTED';
                    statusText.classList.add('text-[#48AA8C]');
                }
                if (statusDot) {
                    statusDot.classList.remove('bg-[#EA7645]', 'animate-pulse');
                    statusDot.classList.add('bg-[#48AA8C]');
                }
                if (consoleOutput) {
                    consoleOutput.textContent = 'OS_READY';
                    consoleOutput.classList.remove('text-[#EA7645]');
                    consoleOutput.classList.add('text-[#48AA8C]');
                }
                if (ringFill) {
                    ringFill.style.stroke = '#48AA8C';
                }
                if (stampEl) {
                    stampEl.classList.add('is-show');
                }

                // Shutter Open Delay
                setTimeout(() => {
                    loader.classList.add('rl-open');
                    setTimeout(revealMain, 380);
                    setTimeout(() => loader.remove(), 950);
                }, 800);
            }

            // Smooth Progress Step
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

        // BFCache Navigation Handling
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