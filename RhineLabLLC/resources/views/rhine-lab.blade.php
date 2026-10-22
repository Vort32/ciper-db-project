@extends('layouts.app')

@section('title', 'RHINE LAB.LLC')

@section('content')
    <!-- ==============================================
         RHINE LAB // PV "ACCESS" ACCURATE BOOT LOADER
         ============================================== -->
    <div id="pageLoader" class="rl-pv-loader" role="status" aria-live="polite">

        <!-- Shutter Panel Terbelah 2 (Atas & Bawah) -->
        <div class="rl-shutter rl-shutter-top">
            <div class="rl-grid-bg"></div>
        </div>
        <div class="rl-shutter rl-shutter-bottom">
            <div class="rl-grid-bg"></div>
        </div>

        <!-- Overlapping Shutter Center Line -->
        <div class="rl-shutter-line"></div>

        <!-- Layer Konten UI HUD -->
        <div class="rl-layer flex flex-col justify-between items-center h-full w-full p-6 sm:p-12 pointer-events-none select-none relative z-10">

            <!-- HUD Corners (Aksen Sudut Khas Arknights) -->
            <span class="rl-corner rl-c-tl"></span>
            <span class="rl-corner rl-c-tr"></span>
            <span class="rl-corner rl-c-bl"></span>
            <span class="rl-corner rl-c-br"></span>

            <!-- Top Header Status HUD -->
            <header class="w-full max-w-5xl flex justify-between items-start font-mono text-[9px] sm:text-[10px] tracking-[0.25em] text-[#2c2c2c] uppercase">
                <div class="flex flex-col gap-1">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 bg-[#EA7645] inline-block"></span>
                        <span class="font-black text-[#1c1c1c] tracking-[0.3em]">RHINE LAB LLC.</span>
                    </div>
                    <span class="text-gray-500 text-[8px] pl-4">DATABASE PORTAL // REF. PV-ACCESS</span>
                </div>
                <div class="text-right flex flex-col items-end gap-1">
                    <div class="flex items-center gap-1.5">
                        <span class="text-gray-500">SYS_STATUS:</span>
                        <span id="rlTopStatus" class="font-bold text-[#EA7645]">PROCESSING</span>
                    </div>
                    <span class="text-[8px] text-gray-400 font-mono">LOCATION: COLUMBIA / TRIMOUNTS</span>
                </div>
            </header>

            <!-- Middle Core Interface (Logo & Precision Reticle Ring) -->
            <main class="w-full max-w-4xl my-auto flex flex-col items-center justify-center relative">
                
                <!-- Rotating Reticle & Ring Stack -->
                <div class="relative w-52 h-52 sm:w-64 sm:h-64 flex items-center justify-center">
                    
                    <!-- Outer Rotating Crosshair Ring -->
                    <svg class="absolute inset-0 w-full h-full animate-spin-slow opacity-40" viewBox="0 0 200 200">
                        <circle cx="100" cy="100" r="95" stroke="#1c1c1c" stroke-width="1" stroke-dasharray="4 8" fill="none" />
                        <circle cx="100" cy="100" r="85" stroke="#1c1c1c" stroke-width="0.5" stroke-dasharray="40 10 20 10" fill="none" />
                    </svg>

                    <!-- Inner Active Gauge Progress Fill -->
                    <svg class="absolute inset-0 w-full h-full -rotate-90" viewBox="0 0 200 200">
                        <circle cx="100" cy="100" r="76" stroke="#d5d2cc" stroke-width="2" fill="none" />
                        <circle id="rlRingFill" cx="100" cy="100" r="76" 
                                class="stroke-[#EA7645] transition-all duration-100 ease-out" 
                                stroke-width="3" 
                                stroke-dasharray="477.52" 
                                stroke-dashoffset="477.52" 
                                stroke-linecap="butt"
                                fill="none" />
                    </svg>

                    <!-- Logo Center Wrapper -->
                    <div class="w-28 h-28 sm:w-36 sm:h-36 p-4 bg-white/70 backdrop-blur-md rounded-full border border-white shadow-lg flex items-center justify-center z-10 rl-core-glow">
                        <img src="{{ asset('images/logo.png') }}" alt="Rhine Lab" class="w-full h-full object-contain filter contrast-125" />
                    </div>

                    <!-- HUD Reticle Cross Markings -->
                    <div class="absolute inset-0 flex items-center justify-between px-1 pointer-events-none opacity-30">
                        <div class="w-2 h-[1px] bg-[#1c1c1c]"></div>
                        <div class="w-2 h-[1px] bg-[#1c1c1c]"></div>
                    </div>
                    <div class="absolute inset-0 flex flex-col items-center justify-between py-1 pointer-events-none opacity-30">
                        <div class="h-2 w-[1px] bg-[#1c1c1c]"></div>
                        <div class="h-2 w-[1px] bg-[#1c1c1c]"></div>
                    </div>
                </div>

                <!-- Text Log Typing Output (Sesuai Trailer PV) -->
                <div class="mt-8 text-center flex flex-col items-center font-mono">
                    <div id="rlLogLine" class="text-sm sm:text-base font-black tracking-[0.25em] text-[#1c1c1c] uppercase min-h-[1.5rem]">
                        ACCESS PERMISSION REQUIRED
                    </div>
                    <div class="flex items-center gap-2 mt-2 text-[10px] font-bold tracking-[0.3em] text-gray-500 uppercase">
                        <span>PROGRESS:</span>
                        <span id="akProgressText" class="text-[#EA7645] font-black">0</span>%
                    </div>
                </div>

                <!-- Stamp "PERMISSION AUTHORIZED / ACCESS GRANTED" -->
                <div id="rlStamp" class="rl-stamp">
                    PERMISSION AUTHORIZED
                </div>
            </main>

            <!-- Bottom Console HUD -->
            <footer class="w-full max-w-5xl z-10 flex flex-col gap-2 font-mono">
                <div class="flex justify-between items-center text-[9px] sm:text-[10px] tracking-[0.2em] text-gray-600 uppercase">
                    <div class="flex items-center gap-2">
                        <span id="akStatusDot" class="w-2 h-2 bg-[#EA7645] inline-block animate-ping"></span>
                        <span id="akStatusText" class="font-bold text-[#1c1c1c]">REQUEST RECEIVED</span>
                    </div>
                    <div id="akConsoleOutput" class="text-[#EA7645] font-bold text-right">
                        ID_CONFIRMED
                    </div>
                </div>

                <!-- Thin Segmented Progress Line -->
                <div class="w-full h-[3px] bg-gray-300/80 rounded-full overflow-hidden relative">
                    <div id="akProgressBar" class="h-full bg-[#1c1c1c] w-0 transition-all duration-100 ease-out"></div>
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
           RHINE LAB // PV ACCESS ACCURATE STYLING
           ========================================= */
        .rl-pv-loader {
            position: fixed; inset: 0; z-index: 50; overflow: hidden;
            background: #ECE8E5; color: #1c1c1c;
            font-family: ui-monospace, SFMono-Regular, Menlo, Consolas, monospace;
        }

        /* Ultra-smooth Shutter Opening Transisi */
        .rl-shutter {
            position: absolute; left: 0; width: 100%; height: 50.1%;
            background: #ECE8E5; overflow: hidden;
            transition: transform 1.2s cubic-bezier(0.16, 1, 0.3, 1);
            z-index: 0;
        }
        .rl-shutter-top { top: 0; }
        .rl-shutter-bottom { bottom: 0; }

        /* Aksen Garis Pemisah Tengah Shutter */
        .rl-shutter-line {
            position: absolute; top: 50%; left: 0; right: 0; height: 1px;
            background: #1c1c1c; z-index: 2; transform: translateY(-50%);
            transition: opacity 0.3s ease;
        }

        .rl-pv-loader.rl-open .rl-shutter-line { opacity: 0; }
        .rl-pv-loader.rl-open .rl-shutter-top { transform: translateY(-101%); }
        .rl-pv-loader.rl-open .rl-shutter-bottom { transform: translateY(101%); }
        .rl-pv-loader.rl-open .rl-layer { opacity: 0; transition: opacity .4s ease; }

        /* Grid Background Pattern khas Trailer PV */
        .rl-grid-bg {
            position: absolute; inset: 0; opacity: 0.18;
            background-image: 
                linear-gradient(to right, #1c1c1c 1px, transparent 1px),
                linear-gradient(to bottom, #1c1c1c 1px, transparent 1px);
            background-size: 40px 40px;
        }

        /* HUD Frame Corners */
        .rl-corner { position: absolute; width: 28px; height: 28px; border: 0 solid rgba(28,28,28,.4); z-index: 10; }
        .rl-c-tl { top: 20px; left: 20px; border-top-width: 2px; border-left-width: 2px; }
        .rl-c-tr { top: 20px; right: 20px; border-top-width: 2px; border-right-width: 2px; }
        .rl-c-bl { bottom: 20px; left: 20px; border-bottom-width: 2px; border-left-width: 2px; }
        .rl-c-br { bottom: 20px; right: 20px; border-bottom-width: 2px; border-right-width: 2px; }

        /* Core Glow */
        .rl-core-glow {
            box-shadow: 0 0 35px rgba(234, 118, 69, 0.18), inset 0 0 15px rgba(255, 255, 255, 0.8);
        }

        /* Stamp PERMISSION AUTHORIZED */
        .rl-stamp {
            position: absolute; padding: 6px 20px; border: 2px solid #48AA8C; color: #48AA8C;
            font-weight: 900; letter-spacing: 0.35em; font-size: 13px; background: rgba(236,232,229,0.96);
            transform: rotate(-3deg) scale(1.4); opacity: 0; pointer-events: none; z-index: 20;
            top: 55%;
        }
        .rl-stamp.is-show { animation: rlStamp .45s cubic-bezier(.16, 1, 0.3, 1) forwards; }

        @keyframes rlStamp { to { opacity: 1; transform: rotate(-3deg) scale(1); } }
        @keyframes spinSlow { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
        .animate-spin-slow { animation: spinSlow 30s linear infinite; }

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
           PV "ACCESS" ACCURATE LOADER LOGIC
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
            const logLine = $('rlLogLine');
            const topStatus = $('rlTopStatus');

            const CIRCUMFERENCE = 477.52; // 2 * PI * 76

            // Sequence log persis sesuai percakapan suara trailer PV Rhine Lab Access
            const pvSequence = [
                { progress: 20, log: "ACCESS PERMISSION REQUIRED", console: "ID_CHECK", status: "PROCESSING PERMISSION" },
                { progress: 45, log: "ID CONFIRMED // JOYCE MOORE", console: "ID_CONFIRMED", status: "CREDENTIALS VERIFIED" },
                { progress: 75, log: "REQUEST RECEIVED // START PROCESSING", console: "PROCESSING", status: "AUTHORIZING ACCESS" },
                { progress: 100, log: "PERMISSION AUTHORIZED", console: "WELCOME_RHINE_LAB", status: "ACCESS GRANTED" }
            ];

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

                // Update teks log sesuai persentase
                if (val < 25) {
                    if (logLine) logLine.textContent = pvSequence[0].log;
                    if (consoleOutput) consoleOutput.textContent = pvSequence[0].console;
                    if (statusText) statusText.textContent = pvSequence[0].status;
                } else if (val < 60) {
                    if (logLine) logLine.textContent = pvSequence[1].log;
                    if (consoleOutput) consoleOutput.textContent = pvSequence[1].console;
                    if (statusText) statusText.textContent = pvSequence[1].status;
                } else if (val < 95) {
                    if (logLine) logLine.textContent = pvSequence[2].log;
                    if (consoleOutput) consoleOutput.textContent = pvSequence[2].console;
                    if (statusText) statusText.textContent = pvSequence[2].status;
                } else {
                    if (logLine) logLine.textContent = pvSequence[3].log;
                    if (consoleOutput) consoleOutput.textContent = pvSequence[3].console;
                    if (statusText) statusText.textContent = pvSequence[3].status;
                }
            }

            function finishLoading() {
                finished = true;

                if (topStatus) {
                    topStatus.textContent = 'AUTHORIZED';
                    topStatus.classList.remove('text-[#EA7645]');
                    topStatus.classList.add('text-[#48AA8C]');
                }
                if (statusDot) {
                    statusDot.classList.remove('bg-[#EA7645]', 'animate-ping');
                    statusDot.classList.add('bg-[#48AA8C]');
                }
                if (consoleOutput) {
                    consoleOutput.classList.remove('text-[#EA7645]');
                    consoleOutput.classList.add('text-[#48AA8C]');
                }
                if (ringFill) {
                    ringFill.style.stroke = '#48AA8C';
                }
                if (stampEl) {
                    stampEl.classList.add('is-show');
                }

                // Ultra-smooth Shutter Open
                setTimeout(() => {
                    loader.classList.add('rl-open');
                    setTimeout(revealMain, 400);
                    setTimeout(() => loader.remove(), 1100);
                }, 850);
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
            }, 55);

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