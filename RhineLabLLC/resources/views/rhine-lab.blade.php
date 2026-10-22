@extends('layouts.app')

@section('title', 'RHINE LAB.LLC')

@section('content')
    <!-- ==============================================
         RHINE LAB // MINIMALIST BOOT SEQUENCE LOADER
         ============================================== -->
    <div id="pageLoader" class="rl-clean-loader" role="status" aria-live="polite">

        <!-- Shutter Panel (Efek Terbuka Atas & Bawah) -->
        <div class="rl-shutter rl-shutter-top"><div class="rl-hex"></div></div>
        <div class="rl-shutter rl-shutter-bottom"><div class="rl-hex"></div></div>

        <!-- Layer Konten UI Minimalis -->
        <div class="rl-layer">

            <!-- Corner Frame minimalis -->
            <span class="rl-corner rl-c-tl"></span>
            <span class="rl-corner rl-c-tr"></span>
            <span class="rl-corner rl-c-bl"></span>
            <span class="rl-corner rl-c-br"></span>

            <!-- Info Kiri-Kanan Atas HUD -->
            <div class="rl-hud-top flex justify-between items-center w-full px-8 pt-6 absolute top-0 left-0 right-0 z-10 font-mono text-[9px] sm:text-[10px] tracking-[0.25em] text-gray-500 uppercase">
                <div class="flex items-center gap-2">
                    <span class="w-1.5 h-3 bg-[#EA7645]"></span>
                    <span class="font-bold text-[#1c1c1c]">RHL-OS</span>
                    <span class="text-gray-400">// BOOT_SEQ v2.4</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-gray-400">SEC_LEVEL:</span>
                    <span class="font-bold text-[#EA7645] animate-pulse">CLASSIFIED</span>
                </div>
            </div>

            <!-- Pusat Dashboard Loader Minimalis -->
            <main class="rl-center relative z-10 flex flex-col items-center justify-center my-auto">
                
                <!-- Brand Title -->
                <div class="text-center mb-8">
                    <h1 class="text-3xl sm:text-5xl md:text-6xl font-black tracking-[0.3em] text-[#1c1c1c] uppercase leading-none">
                        RHINE LAB
                    </h1>
                    <p class="text-[8px] sm:text-[10px] font-bold tracking-[0.5em] text-gray-500 uppercase mt-2">
                        SYNTHESIZE INFORMATION OS
                    </p>
                </div>

                <!-- Minimalist Core Logo & Progress Ring -->
                <div class="relative w-44 h-44 sm:w-56 sm:h-56 flex items-center justify-center">
                    
                    <!-- SVG Ring Bar Dynamic Fill -->
                    <svg class="absolute inset-0 w-full h-full -rotate-90" viewBox="0 0 200 200">
                        <circle cx="100" cy="100" r="90" class="stroke-gray-300/50" stroke-width="2" fill="none" />
                        <circle id="rlRingFill" cx="100" cy="100" r="90" 
                                class="stroke-[#EA7645] transition-all duration-100 ease-linear" 
                                stroke-width="3" 
                                stroke-dasharray="565.48" 
                                stroke-dashoffset="565.48" 
                                stroke-linecap="round"
                                fill="none" />
                    </svg>

                    <!-- Outer Dotted Decorative Ring -->
                    <div class="absolute inset-2 border border-dashed border-gray-400/40 rounded-full animate-spin-slow pointer-events-none"></div>

                    <!-- Core Logo -->
                    <div class="w-24 h-24 sm:w-32 sm:h-32 p-4 bg-white/40 backdrop-blur-sm rounded-full border border-white/80 shadow-sm flex items-center justify-center z-10">
                        <img src="{{ asset('images/logo.png') }}" alt="Rhine Lab" class="w-full h-full object-contain filter contrast-125" />
                    </div>
                </div>

                <!-- Persentase Angka Minimalis -->
                <div class="mt-6 font-mono text-2xl sm:text-3xl font-black tracking-widest text-[#1c1c1c] flex items-baseline">
                    <span id="akProgressText">0</span><span class="text-xs text-gray-500 ml-0.5">%</span>
                </div>

                <!-- Stamp "ACCESS GRANTED" -->
                <div id="rlStamp" class="rl-stamp">
                    ACCESS GRANTED
                </div>
            </main>

            <!-- Bottom Console Status & Thin Progress Line -->
            <footer class="rl-hud-bottom absolute bottom-0 left-0 right-0 px-8 pb-6 z-10 flex flex-col gap-2 font-mono">
                <div class="flex justify-between items-end text-[9px] sm:text-[11px] tracking-widest text-gray-600">
                    <div class="flex items-center gap-2">
                        <span id="akStatusDot" class="w-2 h-2 bg-[#EA7645] animate-ping rounded-full"></span>
                        <span id="akStatusText" class="font-bold text-[#1c1c1c]">CONNECTING TO SERVER</span>
                    </div>
                    <div id="akConsoleOutput" class="text-[#EA7645] font-bold text-right">
                        INIT_SYSTEM...
                    </div>
                </div>

                <!-- Minimalist Clean Bar Line -->
                <div class="w-full h-[3px] bg-gray-300/60 rounded-full overflow-hidden relative">
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
           RHINE LAB // MINIMALIST LOADER STYLING
           ========================================= */
        .rl-clean-loader {
            position: fixed; inset: 0; z-index: 50; overflow: hidden;
            background: #ECE8E5; color: #1c1c1c;
            font-family: ui-monospace, SFMono-Regular, Menlo, Consolas, monospace;
        }

        /* Shutter Opening Mechanism */
        .rl-shutter {
            position: absolute; left: 0; width: 100%; height: 50.2%;
            background: #ECE8E5; overflow: hidden;
            transition: transform 0.85s cubic-bezier(.77, 0, .18, 1);
            z-index: 0;
        }
        .rl-shutter-top { top: 0; }
        .rl-shutter-bottom { bottom: 0; }
        .rl-shutter-bottom::before, .rl-shutter-top::after {
            content: ""; position: absolute; left: 0; width: 100%; height: 2px; background: #1c1c1c;
            opacity: 0; transition: opacity .2s;
        }
        .rl-shutter-top::after { bottom: 0; }
        .rl-shutter-bottom::before { top: 0; }
        .rl-clean-loader.rl-open .rl-shutter::before, 
        .rl-clean-loader.rl-open .rl-shutter::after { opacity: 1; }

        .rl-hex {
            position: absolute; inset: 0; opacity: 0.35;
            background-image: url("data:image/svg+xml,%3Csvg width='40' height='69.282' viewBox='0 0 40 69.282' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M40 11.547L20 0 0 11.547v23.094l20 11.547 20-11.547V11.547zM20 45.034L1.155 34.148V12.376L20 1.49l18.845 10.886v21.772L20 45.034z' fill='%23000000' fill-opacity='0.05' fill-rule='evenodd'/%3E%3Cpath d='M40 46.188L20 34.641 0 46.188v23.094l20 11.547 20-11.547V46.188zM20 79.675L1.155 68.789V47.017L20 36.13l18.845 10.886v21.772L20 79.675z' fill='%23000000' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
            background-size: 60px 103.923px;
        }

        .rl-clean-loader.rl-open .rl-shutter-top { transform: translateY(-101%); }
        .rl-clean-loader.rl-open .rl-shutter-bottom { transform: translateY(101%); }
        .rl-clean-loader.rl-open .rl-layer { opacity: 0; transition: opacity .3s ease; }

        /* Corners Frame */
        .rl-corner { position: absolute; width: 28px; height: 28px; border: 0 solid rgba(28,28,28,.4); z-index: 10; }
        .rl-c-tl { top: 20px; left: 20px; border-top-width: 2px; border-left-width: 2px; }
        .rl-c-tr { top: 20px; right: 20px; border-top-width: 2px; border-right-width: 2px; }
        .rl-c-bl { bottom: 20px; left: 20px; border-bottom-width: 2px; border-left-width: 2px; }
        .rl-c-br { bottom: 20px; right: 20px; border-bottom-width: 2px; border-right-width: 2px; }

        .rl-layer { position: absolute; inset: 0; z-index: 1; display: flex; flex-direction: column; }

        /* Stamp ACCESS GRANTED */
        .rl-stamp {
            position: absolute; padding: 4px 16px; border: 2px solid #48AA8C; color: #48AA8C;
            font-weight: 900; letter-spacing: 0.3em; font-size: 14px; background: rgba(236,232,229,0.95);
            transform: rotate(-4deg) scale(1.5); opacity: 0; pointer-events: none; z-index: 20;
        }
        .rl-stamp.is-show { animation: rlStamp .45s cubic-bezier(.2,.9,.3,1.2) forwards; }

        @keyframes spinSlow {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .animate-spin-slow { animation: spinSlow 25s linear infinite; }

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
           MINIMALIST CLEAN BOOT LOADER LOGIC
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

            const CIRCUMFERENCE = 565.48; // 2 * PI * 90

            const consoleMessages = [
                "INIT_SYSTEM...",
                "VERIFYING_CREDENTIALS...",
                "DECRYPTING_CLASSIFIED_FILES...",
                "MOUNTING_ORIGINIUM_ARTS_DB...",
                "BYPASSING_SECURITY_PROTOCOLS...",
                "ESTABLISHING_SECURE_CONNECTION..."
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
            }, 450);

            function renderProgress(val) {
                const rounded = Math.round(val);
                if (progressText) progressText.textContent = rounded;
                if (progressBar) progressBar.style.width = `${val}%`;

                // Calculate Circle Ring Offset
                if (ringFill) {
                    const offset = CIRCUMFERENCE - (val / 100) * CIRCUMFERENCE;
                    ringFill.style.strokeDashoffset = offset;
                }
            }

            function finishLoading() {
                finished = true;
                clearInterval(consoleTimer);

                // Update UI state to "ACCESS GRANTED"
                if (statusText) {
                    statusText.textContent = 'SYSTEM READY // ACCESS GRANTED';
                    statusText.classList.add('text-[#48AA8C]');
                }
                if (statusDot) {
                    statusDot.classList.remove('bg-[#EA7645]', 'animate-ping');
                    statusDot.classList.add('bg-[#48AA8C]');
                }
                if (consoleOutput) {
                    consoleOutput.textContent = 'OS_LOADED_SUCCESSFULLY.';
                    consoleOutput.classList.remove('text-[#EA7645]');
                    consoleOutput.classList.add('text-[#48AA8C]');
                }
                if (ringFill) {
                    ringFill.style.stroke = '#48AA8C';
                }
                if (stampEl) {
                    stampEl.classList.add('is-show');
                }

                // Trigger Shutter Opening
                setTimeout(() => {
                    loader.classList.add('rl-open');
                    setTimeout(revealMain, 400);
                    setTimeout(() => loader.remove(), 1000);
                }, 850);
            }

            // Progress Step Timer
            const progressTimer = setInterval(() => {
                const cap = pageReady ? 100 : 92;
                let step = Math.floor(Math.random() * 6) + 1;
                progressValue = Math.min(progressValue + step, cap);

                renderProgress(progressValue);

                if (progressValue >= 100 && !finished) {
                    clearInterval(progressTimer);
                    finishLoading();
                }
            }, 60);

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