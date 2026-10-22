@extends('layouts.app')

@section('title', 'RHINE LAB.LLC')

@section('content')
    <!-- ==============================================
         RHINE LAB // BOOT SEQUENCE LOADER
         ============================================== -->
    <div id="pageLoader" class="rl-loader" role="status" aria-live="polite" aria-label="Memuat Rhine Lab OS">

        <!-- Shutter (dua panel yang membuka saat selesai) -->
        <div class="rl-shutter rl-shutter-top"><div class="rl-hex"></div></div>
        <div class="rl-shutter rl-shutter-bottom"><div class="rl-hex"></div></div>

        <div class="rl-layer">
            <div class="rl-hazard"></div>
            <span class="rl-corner rl-c-tl"></span>
            <span class="rl-corner rl-c-tr"></span>
            <span class="rl-corner rl-c-bl"></span>
            <span class="rl-corner rl-c-br"></span>

            <main class="rl-center">
                <div class="rl-brand">
                    <h1>RHINE LAB</h1>
                    <p>SYNTHESIZE INFORMATION OS</p>
                </div>

                <div class="rl-ring-wrap">
                    <svg class="rl-ring" viewBox="0 0 300 300" aria-hidden="true">
                        <circle class="rl-ring-ticks rl-spin-slow" cx="150" cy="150" r="141" />
                        <circle class="rl-ring-track" cx="150" cy="150" r="118" />
                        <circle id="rlRingFill" class="rl-ring-fill" cx="150" cy="150" r="118" />
                    </svg>
                    <div class="rl-logo-core">
                        <img src="{{ asset('images/logo.png') }}" alt="" />
                    </div>
                </div>

                <div class="rl-meter">
                    <div class="rl-status">
                        <span id="akStatusDot" class="rl-dot"></span>
                        <span id="akStatusText">CONNECTING TO SERVER</span>
                    </div>
                    <div class="rl-percent"><span id="akProgressText">0</span><small>%</small></div>
                </div>

                <div id="akProgressBar" class="rl-bar" aria-hidden="true"></div>
            </main>
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
           RHINE LAB BOOT LOADER (minimal)
           ========================================= */
        .rl-loader {
            --rl-paper: #ECE8E5; --rl-ink: #1c1c1c; --rl-mute: #7a766f;
            --rl-orange: #EA7645; --rl-teal: #48AA8C; --rl-lime: #C4FF00;
            position: fixed; inset: 0; z-index: 50; overflow: hidden;
            font-family: ui-monospace, SFMono-Regular, Menlo, Consolas, monospace;
            color: var(--rl-ink);
        }

        /* Shutter */
        .rl-shutter { position: absolute; left: 0; width: 100%; height: 50.2%; background: var(--rl-paper);
            overflow: hidden; transition: transform 0.9s cubic-bezier(.77,0,.18,1); z-index: 0; }
        .rl-shutter-top { top: 0; }
        .rl-shutter-bottom { bottom: 0; }
        /* garis tepi hanya muncul saat membuka, supaya tidak memotong logo */
        .rl-shutter::after { content: ""; position: absolute; left: 0; width: 100%; height: 3px; background: var(--rl-ink); opacity: 0; transition: opacity .2s; }
        .rl-shutter-top::after { bottom: 0; }
        .rl-shutter-bottom::after { top: 0; }
        .rl-hex { position: absolute; inset: 0; opacity: .55;
            background-image: url("data:image/svg+xml,%3Csvg width='40' height='69.282' viewBox='0 0 40 69.282' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M40 11.547L20 0 0 11.547v23.094l20 11.547 20-11.547V11.547zM20 45.034L1.155 34.148V12.376L20 1.49l18.845 10.886v21.772L20 45.034z' fill='%23000000' fill-opacity='0.05' fill-rule='evenodd'/%3E%3Cpath d='M40 46.188L20 34.641 0 46.188v23.094l20 11.547 20-11.547V46.188zM20 79.675L1.155 68.789V47.017L20 36.13l18.845 10.886v21.772L20 79.675z' fill='%23000000' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
            background-size: 60px 103.923px; }
        .rl-shutter-bottom .rl-hex { background-position: 0 -51.9px; }

        .rl-loader.rl-open .rl-shutter-top { transform: translateY(-101%); }
        .rl-loader.rl-open .rl-shutter-bottom { transform: translateY(101%); }
        .rl-loader.rl-open .rl-shutter::after { opacity: 1; }
        .rl-loader.rl-open .rl-layer { opacity: 0; transition: opacity .35s ease; }

        /* Layer */
        .rl-layer { position: absolute; inset: 0; z-index: 1; display: grid; place-items: center; padding: 24px 20px; }
        .rl-hazard { position: absolute; top: 0; left: 0; width: 100%; height: 5px;
            background: repeating-linear-gradient(-45deg, var(--rl-ink) 0 8px, var(--rl-lime) 8px 16px); }
        .rl-corner { position: absolute; width: 28px; height: 28px; border: 0 solid rgba(28,28,28,.5); }
        .rl-c-tl { top: 18px; left: 18px; border-top-width: 2px; border-left-width: 2px; }
        .rl-c-tr { top: 18px; right: 18px; border-top-width: 2px; border-right-width: 2px; }
        .rl-c-bl { bottom: 18px; left: 18px; border-bottom-width: 2px; border-left-width: 2px; }
        .rl-c-br { bottom: 18px; right: 18px; border-bottom-width: 2px; border-right-width: 2px; }

        /* Center column */
        .rl-center { width: min(100%, 460px); display: flex; flex-direction: column; align-items: center; gap: clamp(14px, 3.2vh, 28px); }
        .rl-brand { text-align: center; }
        .rl-brand h1 { margin: 0; font-family: ui-sans-serif, system-ui, "Helvetica Neue", Arial, sans-serif;
            font-weight: 900; font-size: clamp(26px, 8vw, 48px); letter-spacing: .28em; margin-right: -.28em; line-height: 1; }
        .rl-brand p { margin: 8px -.4em 0 0; font-size: clamp(8px, 2.2vw, 10px); letter-spacing: .4em; color: var(--rl-mute); font-weight: 800; }

        .rl-ring-wrap { position: relative; width: clamp(140px, 30vh, 220px); aspect-ratio: 1; }
        .rl-ring { position: absolute; inset: 0; width: 100%; height: 100%; overflow: visible; }
        .rl-ring circle { fill: none; transform-origin: 150px 150px; }
        .rl-ring-ticks { stroke: rgba(28,28,28,.5); stroke-width: 8; stroke-dasharray: 1.5 13.8; }
        .rl-ring-track { stroke: rgba(28,28,28,.14); stroke-width: 6; }
        .rl-ring-fill { stroke: var(--rl-orange); stroke-width: 6; stroke-dasharray: 741.4; stroke-dashoffset: 741.4;
            transform: rotate(-90deg); transition: stroke-dashoffset .12s linear, stroke .3s;
            filter: drop-shadow(0 0 4px rgba(234,118,69,.6)); }
        .rl-spin-slow { animation: rlSpin 40s linear infinite; }
        .rl-logo-core { position: absolute; inset: 25%; display: grid; place-items: center; }
        .rl-logo-core img { width: 100%; height: 100%; object-fit: contain; animation: rlLogoIn 1s ease-out both; }

        /* Status + persen */
        .rl-meter { width: 100%; display: flex; justify-content: space-between; align-items: flex-end; gap: 12px; }
        .rl-status { display: flex; align-items: center; gap: 10px; font-weight: 800; font-size: clamp(9px, 2.6vw, 11px); letter-spacing: .2em; min-width: 0; padding-bottom: 4px; }
        .rl-status span:last-child { white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .rl-dot { width: 9px; height: 9px; background: var(--rl-orange); transform: rotate(45deg); flex: none; animation: rlBlink .7s steps(2, jump-none) infinite; }
        .rl-dot.is-done { background: var(--rl-teal); animation: none; box-shadow: 0 0 10px var(--rl-teal); }
        .rl-status.is-done span:last-child { color: var(--rl-teal); }
        .rl-percent { font-weight: 900; font-size: clamp(32px, 9vw, 44px); line-height: 1; letter-spacing: .04em; font-variant-numeric: tabular-nums; display: flex; align-items: baseline; flex: none; }
        .rl-percent small { font-size: .38em; margin-left: 3px; color: var(--rl-mute); }

        /* Bar segmen */
        .rl-bar { width: 100%; display: grid; grid-template-columns: repeat(40, 1fr); gap: 3px; height: 16px; padding: 3px; border: 2px solid var(--rl-ink); background: rgba(255,255,255,.4); margin-top: -8px; }
        .rl-seg { background: rgba(28,28,28,.12); transform: skewX(-24deg); transition: background .1s; }
        .rl-seg.on { background: var(--rl-ink); }
        .rl-seg.head { background: var(--rl-orange); box-shadow: 0 0 8px var(--rl-orange); }
        .rl-bar.is-done .rl-seg { background: var(--rl-teal); box-shadow: none; }

        @media (max-width: 480px) { .rl-bar { grid-template-columns: repeat(28, 1fr); } .rl-seg:nth-child(n+29) { display: none; } }
        @media (max-height: 520px) { .rl-brand p { display: none; } }

        @keyframes rlSpin { to { transform: rotate(360deg); } }
        @keyframes rlBlink { 50% { opacity: .25; } }
        @keyframes rlLogoIn { from { opacity: 0; transform: scale(.7); filter: blur(6px); } to { opacity: 1; transform: none; filter: none; } }
        @media (prefers-reduced-motion: reduce) { .rl-spin-slow, .rl-dot { animation: none; } .rl-shutter { transition-duration: .01s; } }

        /* =========================================
           STANDARD PAGE ANIMATIONS
           ========================================= */
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

        // Typewriter untuk WELCOME TO
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

        // Transisi saat link navigasi diklik
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                const href = this.getAttribute('href');
                wrapper.classList.add('fade-out');
                setTimeout(() => { window.location.href = href; }, 700);
            });
        });

        // Tampilkan halaman utama
        function revealMain() {
            if (wrapper) {
                wrapper.classList.remove('opacity-0');
                requestAnimationFrame(() => wrapper.classList.add('opacity-100'));
            }
            triggerDelayedAnimations();
        }

        /* =========================================
           RHINE LAB BOOT SEQUENCE
           ========================================= */
        if (loader) {
            const $ = (id) => document.getElementById(id);
            const barEl = $('akProgressBar');
            const ringFill = $('rlRingFill');
            const percentEl = $('akProgressText');
            const statusText = $('akStatusText');
            const statusDot = $('akStatusDot');
            const statusBox = statusDot.parentElement;

            const SEGMENTS = 40;
            const RING_LEN = 741.4; // 2 * PI * 118

            const stages = [
                { at: 0,  status: 'CONNECTING TO SERVER' },
                { at: 20, status: 'VERIFYING OPERATOR' },
                { at: 40, status: 'MOUNTING DATABASE' },
                { at: 60, status: 'DECRYPTING ARCHIVE' },
                { at: 80, status: 'SECURING CHANNEL' }
            ];

            const segs = [];
            for (let n = 0; n < SEGMENTS; n++) {
                const d = document.createElement('div');
                d.className = 'rl-seg';
                barEl.appendChild(d);
                segs.push(d);
            }

            let progress = 0;
            let stageIdx = 0;
            let pageReady = document.readyState === 'complete';
            let finished = false;
            window.addEventListener('load', () => { pageReady = true; });

            function render() {
                percentEl.textContent = Math.round(progress);
                ringFill.style.strokeDashoffset = RING_LEN * (1 - progress / 100);
                const filled = Math.floor((progress / 100) * SEGMENTS);
                for (let n = 0; n < SEGMENTS; n++) {
                    segs[n].classList.toggle('on', n < filled);
                    segs[n].classList.toggle('head', n === filled && progress < 100);
                }
                while (stageIdx + 1 < stages.length && progress >= stages[stageIdx + 1].at) {
                    stageIdx++;
                    statusText.textContent = stages[stageIdx].status;
                }
            }

            function finish() {
                finished = true;
                statusText.textContent = 'ACCESS GRANTED';
                statusBox.classList.add('is-done');
                statusDot.classList.add('is-done');
                barEl.classList.add('is-done');
                ringFill.style.stroke = '#48AA8C';
                ringFill.style.filter = 'drop-shadow(0 0 5px rgba(72,170,140,.7))';

                setTimeout(() => {
                    loader.classList.add('rl-open');
                    setTimeout(revealMain, 450);
                    setTimeout(() => loader.remove(), 1100);
                }, 800);
            }

            const timer = setInterval(() => {
                // Tahan di 92% sampai semua aset halaman selesai dimuat
                const cap = pageReady ? 100 : 92;
                if (Math.random() > 0.14) {
                    progress = Math.min(progress + (Math.random() * 3.6 + 0.6), cap);
                }
                render();
                if (progress >= 100 && !finished) {
                    clearInterval(timer);
                    finish();
                }
            }, 70);

            render();

        } else if (wrapper) {
            revealMain();
        }

        // Animasi elemen halaman utama setelah loading selesai
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

        // Perbaikan stuck loading saat tombol Back browser (BFCache)
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