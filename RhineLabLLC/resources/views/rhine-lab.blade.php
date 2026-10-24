@extends('layouts.app')

@section('title', 'RHINE LAB.LLC')

@section('content')
    <!-- ==============================================
         RHINE LAB // BOOT SEQUENCE
         Logo "diisi tinta" mengikuti progres, ring pengukur tipis,
         shutter terbuka saat akses diberikan.
         ============================================== -->
    <div id="pageLoader" class="rl" role="status" aria-live="off" aria-label="Memuat Rhine Lab OS">

        <!-- Shutter atas -->
        <div id="shutterTop" class="rl-shutter rl-shutter--t">
            <i class="rl-corner rl-corner--tl"></i>
            <i class="rl-corner rl-corner--tr"></i>
        </div>

        <!-- Shutter bawah -->
        <div id="shutterBottom" class="rl-shutter rl-shutter--b">
            <i class="rl-corner rl-corner--bl"></i>
            <i class="rl-corner rl-corner--br"></i>
        </div>

        <!-- Garis tengah (seam) -->
        <div id="rlSeam" class="rl-seam"></div>

        <!-- Layer UI utama -->
        <div id="loaderUI" class="rl-ui">

            <!-- HUD atas -->
            <header class="rl-head">
                <div class="rl-brand">
                    <span class="rl-pulse"></span>
                    <b>RHINE LAB LLC</b>
                    <span class="rl-dim rl-hide-xs">// OS_BOOT</span>
                </div>
                <div class="rl-dim rl-loc">TRIMOUNTS / COLUMBIA</div>
            </header>

            <!-- Inti: ring + logo -->
            <main class="rl-core">
                <div class="rl-ring">
                    <svg class="rl-svg" viewBox="0 0 300 300" aria-hidden="true">
                        <!-- Bezel bertanda (72 tick) -->
                        <circle cx="150" cy="150" r="126" fill="none" stroke="rgba(28,28,28,.28)" stroke-width="6" stroke-dasharray="1 9.82" />

                        <!-- Busur berputar berlawanan arah -->
                        <g class="rl-spin">
                            <path d="M 40 150 A 110 110 0 0 1 230 70" stroke="#1c1c1c" stroke-width="1.2" stroke-linecap="round" fill="none" opacity=".4" />
                            <circle cx="230" cy="70" r="3" fill="#EA7645" />
                        </g>

                        <!-- Jalur + ring progres -->
                        <circle cx="150" cy="150" r="95" fill="none" stroke="rgba(28,28,28,.08)" stroke-width="2" />
                        <circle id="rlRingFill" class="rl-gauge" cx="150" cy="150" r="95"
                                fill="none" stroke="#EA7645" stroke-width="2"
                                stroke-dasharray="596.9" stroke-dashoffset="596.9" stroke-linecap="round" />
                    </svg>

                    <!-- Logo: bayangan + lapisan tinta yang terisi dari kiri ke kanan -->
                    <div class="rl-logo">
                        <img class="rl-logo-ghost" src="{{ asset('images/logo.png') }}" alt="Rhine Lab" decoding="async">
                        <img id="rlLogoInk" class="rl-logo-ink" src="{{ asset('images/logo.png') }}" alt="" aria-hidden="true" decoding="async">
                        <i id="rlScan" class="rl-scan"></i>
                    </div>

                    <div class="rl-pct"><span id="akProgressText">0</span>%</div>
                </div>

                <!-- Status saat ini -->
                <div class="rl-state">
                    <div id="centerText" class="rl-headline">ACCESS PERMISSION REQUIRED</div>
                    <div id="rlSub" class="rl-sub">SESSION TOKEN // CHECKING</div>
                </div>
            </main>

            <!-- Konsol bawah -->
            <footer class="rl-foot">
                <div class="rl-foot-row">
                    <div class="rl-stat">
                        <span id="akStatusDot" class="rl-dot"></span>
                        <span id="akStatusText">SYSTEM_BOOT</span>
                    </div>
                    <div id="akConsoleOutput" class="rl-out">VERIFYING</div>
                </div>
                <div id="rlSegs" class="rl-segs" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"></div>
            </footer>
        </div>
    </div>

    <!-- ==============================================
         MAIN PAGE WRAPPER
         ============================================== -->
    <div id="pageWrapper"
        class="min-h-screen flex flex-col justify-center items-center bg-[#ECE8E5] text-black relative overflow-hidden transition-opacity duration-[1200ms] opacity-0">

        <!-- Background image dengan opacity -->
        <div class="absolute inset-0 bg-cover bg-center"
            style="opacity: .07; background-image: url('{{ asset('images/Rhine_Lab_HQ1.png') }}');">
        </div>

        <!-- Header kiri atas -->
        <div class="absolute top-6 left-6 leading-tight select-none space-y-1 z-10">
            <h1 class="text-2xl font-bold pre-animate" data-animate="animate-slide-fade" style="animation-delay: 0.2s;">RHINE LAB</h1>
            <p class="text-[10px] tracking-[0.2em] uppercase pre-animate" data-animate="animate-slide-fade" style="animation-delay: 0.4s;">
                SYNTHESIZE INFORMATION
            </p>
            <p class="text-base sm:text-lg md:text-xl pre-animate" data-animate="animate-slide-fade" style="animation-delay: 0.6s;">
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
        /* ==========================================================
           PAGE ANIMATIONS
           ========================================================== */
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

        /* ==========================================================
           LOADER  (class rl-*, tidak bergantung pada Tailwind)
           ========================================================== */
        .rl {
            --rl-bg: #ECE8E5; --rl-ink: #1c1c1c; --rl-mute: #7a766f;
            --rl-accent: #EA7645; --rl-ok: #48AA8C;
            position: fixed; inset: 0; z-index: 9999; overflow: hidden;
            width: 100%; height: 100vh; height: 100dvh;
            background: var(--rl-bg); color: var(--rl-ink);
            font-family: ui-monospace, SFMono-Regular, Menlo, Consolas, monospace;
            -webkit-font-smoothing: antialiased;
            user-select: none; -webkit-user-select: none;
        }
        .rl::before {
            content: ""; position: absolute; inset: 0; z-index: 0; pointer-events: none;
            background:
                radial-gradient(30rem 30rem at 0% 0%, rgba(255, 255, 255, .75), transparent 65%),
                radial-gradient(26rem 26rem at 100% 100%, rgba(234, 118, 69, .14), transparent 65%),
                radial-gradient(22rem 22rem at 50% 50%, rgba(255, 255, 255, .45), transparent 70%);
        }

        /* Shutter */
        .rl-shutter {
            position: absolute; left: 0; width: 100%; height: 50.1%; z-index: 10;
            background: var(--rl-bg);
            transition: transform 1.1s cubic-bezier(.16, 1, .3, 1);
        }
        .rl-shutter::before {
            content: ""; position: absolute; inset: 0; pointer-events: none; opacity: .08;
            background-image:
                linear-gradient(to right, var(--rl-ink) 1px, transparent 1px),
                linear-gradient(to bottom, var(--rl-ink) 1px, transparent 1px);
            background-size: 40px 40px;
        }
        .rl-shutter--t { top: 0; border-bottom: 1px solid rgba(0, 0, 0, .1); }
        .rl-shutter--b { bottom: 0; border-top: 1px solid rgba(0, 0, 0, .1); }
        .rl-shutter--t::before { -webkit-mask-image: linear-gradient(to bottom, #000 25%, transparent); mask-image: linear-gradient(to bottom, #000 25%, transparent); }
        .rl-shutter--b::before { -webkit-mask-image: linear-gradient(to top, #000 25%, transparent); mask-image: linear-gradient(to top, #000 25%, transparent); }
        .shutter-open-top { transform: translateY(-101%); }
        .shutter-open-bottom { transform: translateY(101%); }

        .rl-corner { position: absolute; width: 22px; height: 22px; border: 0 solid rgba(28, 28, 28, .3); }
        .rl-corner--tl { top: 20px; left: 20px; border-top-width: 1px; border-left-width: 1px; }
        .rl-corner--tr { top: 20px; right: 20px; border-top-width: 1px; border-right-width: 1px; }
        .rl-corner--bl { bottom: 20px; left: 20px; border-bottom-width: 1px; border-left-width: 1px; }
        .rl-corner--br { bottom: 20px; right: 20px; border-bottom-width: 1px; border-right-width: 1px; }

        /* Seam tengah: tumbuh dari titik tengah, lalu hilang saat shutter terbuka */
        .rl-seam {
            position: absolute; left: 0; right: 0; top: 50%; height: 1px; z-index: 15; pointer-events: none;
            background: linear-gradient(90deg, transparent, var(--rl-accent) 30%, var(--rl-accent) 70%, transparent);
            transform: scaleX(0); opacity: .9;
            animation: rlSeam 1s .1s cubic-bezier(.16, 1, .3, 1) forwards;
            transition: opacity .4s ease;
        }
        .rl.is-opening .rl-seam { opacity: 0; }

        /* Layer UI */
        .rl-ui {
            position: absolute; inset: 0; z-index: 20;
            display: flex; flex-direction: column; justify-content: space-between; align-items: center;
            padding: calc(26px + env(safe-area-inset-top, 0px)) 24px calc(26px + env(safe-area-inset-bottom, 0px));
            transition: opacity .5s ease;
        }
        .rl-ui.is-hidden { opacity: 0; }

        .rl-head, .rl-core, .rl-foot { opacity: 0; animation: rlIn .8s cubic-bezier(.16, 1, .3, 1) forwards; }
        .rl-head { animation-delay: .2s; }
        .rl-core { animation-delay: .35s; }
        .rl-foot { animation-delay: .5s; }

        /* Header */
        .rl-head {
            width: 100%; max-width: 64rem; display: flex; justify-content: space-between; align-items: center; gap: 12px;
            font-size: 9px; letter-spacing: .3em; text-transform: uppercase;
        }
        .rl-brand { display: flex; align-items: center; gap: 10px; min-width: 0; }
        .rl-brand b { font-weight: 800; letter-spacing: .35em; white-space: nowrap; }
        .rl-dim { color: var(--rl-mute); font-weight: 400; }
        .rl-loc { font-size: 8px; white-space: nowrap; }
        .rl-pulse { flex: none; width: 6px; height: 6px; border-radius: 50%; background: var(--rl-accent); animation: rlPulse 1.8s ease-out infinite; }

        /* Core */
        .rl-core { position: relative; z-index: 1; display: flex; flex-direction: column; align-items: center; margin: auto 0; width: 100%; }
        .rl-ring { position: relative; width: min(260px, 72vw); aspect-ratio: 1 / 1; display: grid; place-items: center; }
        .rl-svg { position: absolute; inset: 0; width: 100%; height: 100%; overflow: visible; }
        .rl-spin { transform-box: view-box; transform-origin: 150px 150px; animation: rlSpin 20s linear infinite reverse; }
        .rl-gauge { transform-box: view-box; transform-origin: 150px 150px; transform: rotate(-90deg); transition: stroke-dashoffset .12s linear, stroke .5s ease; }

        .rl-logo { position: relative; width: 44%; }
        .rl-logo img { display: block; width: 100%; height: auto; }
        .rl-logo-ghost { opacity: .13; filter: grayscale(1); }
        .rl-logo-ink { position: absolute; inset: 0; clip-path: inset(0 100% 0 0); will-change: clip-path; }
        .rl-scan {
            position: absolute; top: -10%; bottom: -10%; left: 0; width: 1px; opacity: 0;
            background: var(--rl-accent); box-shadow: 0 0 8px 1px rgba(234, 118, 69, .6);
            transition: opacity .3s ease;
        }
        .rl-scan.is-on { opacity: 1; }

        .rl-pct {
            position: absolute; right: 2%; bottom: 7%; min-width: 4ch; text-align: right;
            font-size: 11px; font-weight: 700; letter-spacing: .1em; color: var(--rl-mute);
            font-variant-numeric: tabular-nums;
        }

        .rl-state { margin-top: 30px; width: 100%; max-width: 340px; text-align: center; min-height: 4.2rem; }
        .rl-headline {
            font-size: 12px; font-weight: 900; letter-spacing: .3em; text-transform: uppercase;
            line-height: 1.5; text-wrap: balance;
            transition: opacity .16s ease, transform .16s ease, color .4s ease;
        }
        .rl-sub {
            margin-top: 8px; font-size: 9px; font-weight: 600; letter-spacing: .2em; text-transform: uppercase; line-height: 1.6;
            color: var(--rl-mute); overflow-wrap: anywhere; text-wrap: balance;
            transition: opacity .16s ease, transform .16s ease;
        }
        .rl-headline.is-swap, .rl-sub.is-swap { opacity: 0; transform: translateY(4px); }

        /* Footer / konsol */
        .rl-foot { width: 100%; max-width: 64rem; display: flex; flex-direction: column; gap: 10px; }
        .rl-foot-row { display: flex; justify-content: space-between; align-items: center; gap: 12px; font-size: 9px; letter-spacing: .25em; text-transform: uppercase; }
        .rl-stat { display: flex; align-items: center; gap: 8px; min-width: 0; font-weight: 700; }
        .rl-stat span:last-child { overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .rl-dot { flex: none; width: 6px; height: 6px; border-radius: 50%; background: var(--rl-accent); animation: rlPulse 1.4s ease-out infinite; transition: background .4s; }
        .rl-out { font-weight: 700; color: var(--rl-accent); white-space: nowrap; transition: color .4s; }

        .rl-segs { display: flex; gap: 2px; height: 10px; }
        .rl-segs i { flex: 1; border-radius: 1px; background: rgba(28, 28, 28, .12); transition: background .15s ease; }
        .rl-segs i.is-on { background: var(--rl-ink); }
        .rl-segs i.is-lead { background: var(--rl-accent); }

        /* State selesai */
        .rl.is-done .rl-headline { color: var(--rl-ok); }
        .rl.is-done .rl-out { color: var(--rl-ok); }
        .rl.is-done .rl-dot { background: var(--rl-ok); animation: none; }
        .rl.is-done .rl-gauge { stroke: var(--rl-ok); }
        .rl.is-done .rl-segs i.is-on { background: var(--rl-ok); }
        .rl.is-done .rl-scan { opacity: 0; }

        @media (max-width: 479.98px) {
            .rl-hide-xs, .rl-loc { display: none; }
        }
        @media (min-width: 640px) {
            .rl-ui { padding: 56px; }
            .rl-head, .rl-foot-row { font-size: 10px; }
            .rl-loc { font-size: 9px; }
            .rl-ring { width: 300px; }
            .rl-headline { font-size: 14px; }
            .rl-sub { font-size: 10px; }
            .rl-pct { font-size: 12px; }
            .rl-corner { width: 32px; height: 32px; }
            .rl-corner--tl, .rl-corner--tr { top: 32px; }
            .rl-corner--bl, .rl-corner--br { bottom: 32px; }
            .rl-corner--tl, .rl-corner--bl { left: 32px; }
            .rl-corner--tr, .rl-corner--br { right: 32px; }
        }

        @keyframes rlIn { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: none; } }
        @keyframes rlSeam { to { transform: scaleX(1); } }
        @keyframes rlSpin { to { transform: rotate(360deg); } }
        @keyframes rlPulse { 0% { box-shadow: 0 0 0 0 rgba(234, 118, 69, .55); } 70%, 100% { box-shadow: 0 0 0 7px rgba(234, 118, 69, 0); } }

        @media (prefers-reduced-motion: reduce) {
            .rl-spin, .rl-pulse, .rl-dot { animation: none; }
            .rl-head, .rl-core, .rl-foot, .rl-seam { animation-duration: .01s; animation-delay: 0s; }
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
           BOOT LOADER
           ========================================= */
        if (loader) {
            const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

            const headline = document.getElementById('centerText');
            const subline = document.getElementById('rlSub');
            const loaderUI = document.getElementById('loaderUI');
            const ringFill = document.getElementById('rlRingFill');
            const logoInk = document.getElementById('rlLogoInk');
            const scan = document.getElementById('rlScan');
            const progressText = document.getElementById('akProgressText');
            const statusText = document.getElementById('akStatusText');
            const consoleOutput = document.getElementById('akConsoleOutput');
            const segWrap = document.getElementById('rlSegs');
            const sTop = document.getElementById('shutterTop');
            const sBottom = document.getElementById('shutterBottom');

            const CIRCUMFERENCE = 596.9; // 2 * PI * 95
            const SEGMENTS = 40;
            const username = @json(auth()->check() ? auth()->user()->name : 'OPERATIVE').toUpperCase();

            // Tahapan boot
            const STAGES = [
                { at: 0,  head: 'ACCESS PERMISSION REQUIRED', sub: 'SESSION TOKEN // CHECKING',          stat: 'SYSTEM_BOOT',     out: 'ID_CHECK' },
                { at: 35, head: 'ID CONFIRMED',               sub: 'OPERATIVE // ' + username,           stat: 'AUTHENTICATING',  out: 'VERIFIED' },
                { at: 70, head: 'REQUEST RECEIVED',           sub: 'START PROCESSING // DECRYPTING DATA', stat: 'DECRYPTING_DATA', out: 'PROCESSING' },
                { at: 95, head: 'PERMISSION AUTHORIZED',      sub: 'ALL SYSTEMS NOMINAL',                stat: 'ACCESS_GRANTED',  out: 'GRANTED' },
            ];

            // Bangun segmen progres
            const segs = [];
            for (let s = 0; s < SEGMENTS; s++) {
                const el = document.createElement('i');
                segWrap.appendChild(el);
                segs.push(el);
            }

            let pageReady = document.readyState === 'complete';
            let finished = false;
            let stageIndex = -1;
            let lastLit = -1;

            window.addEventListener('load', () => { pageReady = true; });
            setTimeout(() => { pageReady = true; }, 6000); // jaring pengaman bila aset lambat

            // Ganti teks dengan transisi singkat
            function swapText(el, text) {
                if (!el || el.textContent === text) return;
                if (reduce) { el.textContent = text; return; }
                el.classList.add('is-swap');
                setTimeout(() => {
                    el.textContent = text;
                    el.classList.remove('is-swap');
                }, 160);
            }

            function applyStage(idx) {
                const st = STAGES[idx];
                swapText(headline, st.head);
                swapText(subline, st.sub);
                if (statusText) statusText.textContent = st.stat;
                if (consoleOutput) consoleOutput.textContent = st.out;
                if (idx === STAGES.length - 1) loader.classList.add('is-done');
            }

            function renderProgress(val) {
                const rounded = Math.round(val);
                if (progressText) progressText.textContent = rounded;
                if (segWrap) segWrap.setAttribute('aria-valuenow', rounded);

                // Ring
                if (ringFill) ringFill.style.strokeDashoffset = CIRCUMFERENCE - (val / 100) * CIRCUMFERENCE;

                // Logo terisi tinta + garis pemindai
                if (logoInk) logoInk.style.clipPath = `inset(0 ${100 - val}% 0 0)`;
                if (scan) {
                    scan.style.left = `${val}%`;
                    scan.classList.toggle('is-on', val > 0 && val < 100);
                }

                // Segmen
                const lit = Math.floor((val / 100) * SEGMENTS);
                if (lit !== lastLit) {
                    for (let s = 0; s < SEGMENTS; s++) {
                        segs[s].classList.toggle('is-on', s < lit);
                        segs[s].classList.toggle('is-lead', s === lit && val < 100);
                    }
                    lastLit = lit;
                }

                // Tahap
                let idx = 0;
                for (let k = 0; k < STAGES.length; k++) if (val >= STAGES[k].at) idx = k;
                if (idx !== stageIndex) {
                    stageIndex = idx;
                    applyStage(idx);
                }
            }

            function finishLoading() {
                finished = true;

                setTimeout(() => {
                    loaderUI.classList.add('is-hidden');

                    setTimeout(() => {
                        loader.classList.add('is-opening');
                        sTop.classList.add('shutter-open-top');
                        sBottom.classList.add('shutter-open-bottom');

                        setTimeout(revealMain, 400);
                        setTimeout(() => loader.remove(), 1100);
                    }, 300);
                }, reduce ? 300 : 800);
            }

            // Progres: langkah acak dengan jeda kecil di tiap pergantian tahap
            let value = 0;
            const rand = (min, max) => Math.floor(Math.random() * (max - min + 1)) + min;

            const tick = () => {
                if (finished) return;

                const cap = pageReady ? 100 : 92;
                const prev = value;
                value = Math.min(value + (reduce ? 10 : rand(1, 4)), cap);
                renderProgress(value);

                if (value >= 100) { finishLoading(); return; }

                let delay = reduce ? 40 : rand(35, 80);
                if (!reduce && ((prev < 35 && value >= 35) || (prev < 70 && value >= 70))) delay += 260;
                if (value >= cap) delay = 120; // menunggu halaman selesai dimuat

                setTimeout(tick, delay);
            };

            renderProgress(0);
            setTimeout(tick, reduce ? 0 : 450); // beri waktu animasi intro

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