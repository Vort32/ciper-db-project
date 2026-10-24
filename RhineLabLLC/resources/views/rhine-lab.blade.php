@extends('layouts.app')

@section('title', 'RHINE LAB.LLC')

@section('content')
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

        /* Halaman utama: mulai agak kabur, lalu menajam saat shutter terbuka */
        #pageWrapper { transition: opacity 1.2s ease, filter 1.6s cubic-bezier(.16, 1, .3, 1); }
        #pageWrapper.opacity-0 { filter: blur(10px); }

        /* PROFIL / LOGIN (kanan atas) */
        .pf-wrap {
            position: absolute; z-index: 10; user-select: none; -webkit-user-select: none;
            top: calc(18px + env(safe-area-inset-top, 0px)); right: 18px;
        }
        .pf {
            display: inline-flex; align-items: center; gap: 10px;
            padding: 5px 5px 5px 18px; border-radius: 999px;
            color: #1c1c1c; text-decoration: none; -webkit-tap-highlight-color: transparent;
            background: rgba(255, 255, 255, .5); border: 1px solid rgba(255, 255, 255, .85);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, .9), 0 10px 26px -16px rgba(70, 45, 30, .38);
            -webkit-backdrop-filter: blur(14px) saturate(1.4); backdrop-filter: blur(14px) saturate(1.4);
            transition: background-color .25s ease, box-shadow .25s ease, transform .25s ease;
        }
        .pf:hover { background: rgba(255, 255, 255, .78); box-shadow: inset 0 1px 0 #fff, 0 14px 30px -16px rgba(70, 45, 30, .45); }
        .pf:active { transform: scale(.97); }
        .pf:focus-visible { outline: 2px solid #EA7645; outline-offset: 3px; }

        .pf-text { display: flex; flex-direction: column; align-items: flex-end; min-width: 0; line-height: 1.15; }
        .pf-name { max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; font-size: 12px; font-weight: 600; letter-spacing: .01em; }
        .pf-meta { margin-top: 3px; font-size: 8.5px; font-weight: 600; letter-spacing: .3em; text-transform: uppercase; color: #8a857e; transition: color .25s ease; }
        .pf:hover .pf-meta { color: #EA7645; }

        .pf-avatar { position: relative; flex: none; width: 38px; height: 38px; }
        .pf-avatar img { display: block; width: 100%; height: 100%; box-sizing: border-box; border-radius: 50%; object-fit: cover; border: 2px solid #fff; box-shadow: 0 2px 8px rgba(0, 0, 0, .12); }
        .pf-live { position: absolute; right: -1px; bottom: -1px; width: 11px; height: 11px; box-sizing: border-box; border-radius: 50%; background: #48AA8C; border: 2px solid #ECE8E5; }

        .pf--guest { padding: 11px 20px; }
        .pf-login { font-size: 11px; font-weight: 600; letter-spacing: .32em; text-transform: uppercase; transition: color .25s ease; }
        .pf--guest:hover .pf-login { color: #EA7645; }

        /* Mobile kecil: hanya avatar (nama tetap tersedia untuk pembaca layar) */
        @media (max-width: 479.98px) {
            .pf:not(.pf--guest) { padding: 4px; gap: 0; }
            .pf-text {
                position: absolute; width: 1px; height: 1px; margin: -1px; padding: 0; overflow: hidden;
                clip: rect(0 0 0 0); white-space: nowrap; border: 0;
            }
            .pf-avatar { width: 40px; height: 40px; }
            .pf--guest { padding: 10px 16px; }
            .pf-login { font-size: 10px; letter-spacing: .28em; }
        }
        @media (min-width: 480px) and (max-width: 639.98px) {
            .pf-name { max-width: 120px; }
        }
        @media (min-width: 640px) {
            .pf-wrap { top: 24px; right: 24px; }
            .pf-name { max-width: 220px; font-size: 13px; }
        }

        /* DESKTOP: awalnya hanya avatar; saat diarahkan, pil terbuka dari avatar ke kiri */
        @media (min-width: 900px) and (hover: hover) {
            .pf:not(.pf--guest) {
                padding: 4px; gap: 0;
                background: rgba(255, 255, 255, 0); border-color: rgba(255, 255, 255, 0);
                box-shadow: none;
                -webkit-backdrop-filter: none; backdrop-filter: none;
                transition: background-color .45s ease, border-color .45s ease, box-shadow .45s ease, transform .25s ease;
            }
            .pf:not(.pf--guest) .pf-text {
                max-width: 0; padding-left: 0; opacity: 0; overflow: hidden;
                transition: max-width .65s cubic-bezier(.16, 1, .3, 1), padding-left .65s cubic-bezier(.16, 1, .3, 1), opacity .25s ease;
            }
            .pf:not(.pf--guest):hover,
            .pf:not(.pf--guest):focus-visible {
                background: rgba(255, 255, 255, .62); border-color: rgba(255, 255, 255, .9);
                box-shadow: inset 0 1px 0 #fff, 0 14px 30px -16px rgba(70, 45, 30, .4);
                -webkit-backdrop-filter: blur(14px) saturate(1.4); backdrop-filter: blur(14px) saturate(1.4);
            }
            .pf:not(.pf--guest):hover .pf-text,
            .pf:not(.pf--guest):focus-visible .pf-text {
                max-width: 260px; padding-left: 16px; opacity: 1;
                transition-delay: 0s, 0s, .12s;
            }
        }

        /* ==========================================================
           LOADER  (class rl-*, tidak bergantung pada Tailwind)
           ========================================================== */
        .rl {
            --rl-bg: #ECE8E5; --rl-ink: #1c1c1c; --rl-mute: #8a857e;
            --rl-accent: #EA7645; --rl-ok: #48AA8C;
            position: fixed; inset: 0; z-index: 9999; overflow: hidden;
            width: 100%; height: 100vh; height: 100dvh;
            background: var(--rl-bg); color: var(--rl-ink);
            font-family: "Helvetica Neue", Helvetica, Arial, ui-sans-serif, system-ui, sans-serif;
            -webkit-font-smoothing: antialiased;
            user-select: none; -webkit-user-select: none;
        }
        .rl::before {
            content: ""; position: absolute; inset: 0; z-index: 0; pointer-events: none;
            background:
                radial-gradient(34rem 34rem at 50% 46%, rgba(255, 255, 255, .7), transparent 68%),
                radial-gradient(28rem 28rem at 100% 100%, rgba(234, 118, 69, .08), transparent 66%);
        }

        /* Shutter polos */
        .rl-shutter {
            position: absolute; left: 0; width: 100%; height: 50.1%; z-index: 10;
            background: var(--rl-bg);
            transition: transform 1.1s cubic-bezier(.16, 1, .3, 1);
        }
        .rl-shutter--t { top: 0; }
        .rl-shutter--b { bottom: 0; }
        .shutter-open-top { transform: translateY(-101%); }
        .shutter-open-bottom { transform: translateY(101%); }

        /* Bayangan lembut di tepi shutter saat membuka */
        .rl-shutter { transition: transform 1.2s cubic-bezier(.76, 0, .18, 1), box-shadow .8s ease; }
        .rl.is-opening .rl-shutter--t { box-shadow: 0 30px 70px -24px rgba(70, 45, 30, .28); }
        .rl.is-opening .rl-shutter--b { box-shadow: 0 -30px 70px -24px rgba(70, 45, 30, .28); }

        /* Garis celah di tengah */
        .rl-seam {
            position: absolute; left: 0; right: 0; top: 50%; height: 1px; z-index: 15; pointer-events: none;
            background: linear-gradient(90deg, transparent, var(--rl-accent) 25%, var(--rl-accent) 75%, transparent);
            opacity: 0; transform: scaleX(0);
        }
        .rl.is-seam .rl-seam { opacity: .85; transform: scaleX(1); transition: transform .55s cubic-bezier(.65, 0, .2, 1), opacity .3s ease; }
        .rl.is-opening .rl-seam { opacity: 0; transition: opacity .35s ease; }

        /* Layer UI */
        .rl-ui {
            position: absolute; inset: 0; z-index: 20;
            display: flex; flex-direction: column; justify-content: space-between; align-items: center;
            padding: calc(28px + env(safe-area-inset-top, 0px)) 28px calc(28px + env(safe-area-inset-bottom, 0px));
            transition: opacity .5s ease;
        }
        .rl-ui.is-hidden {
            opacity: 0; transform: scale(.98); filter: blur(3px);
            transition: opacity .6s ease, transform .9s cubic-bezier(.16, 1, .3, 1), filter .6s ease;
        }

        .rl-head, .rl-core, .rl-foot { opacity: 0; animation: rlIn 1s cubic-bezier(.16, 1, .3, 1) forwards; }
        .rl-head { animation-delay: .15s; }
        .rl-core { animation-delay: .3s; }
        .rl-foot { animation-delay: .45s; }

        /* Header */
        .rl-head {
            width: 100%; max-width: 64rem; display: flex; justify-content: space-between; align-items: center; gap: 12px;
            font-size: 10px; letter-spacing: .28em; text-transform: uppercase;
        }
        .rl-brand { display: flex; align-items: center; gap: 10px; }
        .rl-brand b { font-weight: 700; white-space: nowrap; }
        .rl-loc { display: none; color: var(--rl-mute); white-space: nowrap; }
        .rl-dot { flex: none; width: 6px; height: 6px; border-radius: 50%; background: var(--rl-accent); transition: background .5s ease; animation: rlBreath 1.8s ease-in-out infinite; }

        /* Core: logo + teks */
        .rl-core { position: relative; z-index: 1; display: flex; flex-direction: column; align-items: center; margin: auto 0; width: 100%; }
        .rl-logo { position: relative; width: clamp(132px, 38vw, 184px); }
        .rl-logo img { display: block; width: 100%; height: auto; }
        .rl-logo-ghost { opacity: .1; filter: grayscale(1); }
        .rl-logo-ink {
            position: absolute; inset: 0; --e: 0;
            -webkit-mask-image: linear-gradient(90deg, #000 calc(var(--e) * 1% - 10%), transparent calc(var(--e) * 1%));
                    mask-image: linear-gradient(90deg, #000 calc(var(--e) * 1% - 10%), transparent calc(var(--e) * 1%));
        }
        .rl-logo-ink.is-full { -webkit-mask-image: none; mask-image: none; }

        /* Isi logo: gradasi oranye -> hijau, dipotong mengikuti bentuk logo */
        .rl-logo-fill {
            display: block; width: 100%; height: 100%;
            background: linear-gradient(90deg, #EA7645 0%, #48AA8C 100%);
            background: linear-gradient(in oklab 90deg, #EA7645 0%, #48AA8C 100%);
            -webkit-mask: url('{{ asset('images/logo.png') }}') center / 100% 100% no-repeat;
                    mask: url('{{ asset('images/logo.png') }}') center / 100% 100% no-repeat;
        }

        .rl-state { margin-top: 36px; width: 100%; max-width: 320px; text-align: center; min-height: 3.4rem; }
        .rl-headline {
            font-size: 11px; font-weight: 500; letter-spacing: .32em; text-transform: uppercase; line-height: 1.6;
            transition: opacity .2s ease, transform .2s ease;
        }
        .rl-sub {
            margin-top: 8px; font-size: 10px; font-weight: 400; letter-spacing: .2em; text-transform: uppercase; line-height: 1.6;
            color: var(--rl-mute); overflow-wrap: anywhere; text-wrap: balance;
            transition: opacity .2s ease, transform .2s ease;
        }
        .rl-headline.is-swap, .rl-sub.is-swap { opacity: 0; transform: translateY(3px); }

        /* Footer */
        .rl-foot { width: 100%; max-width: 64rem; display: flex; flex-direction: column; gap: 12px; }
        .rl-foot-row {
            display: flex; justify-content: space-between; align-items: baseline; gap: 12px;
            font-size: 10px; letter-spacing: .28em; text-transform: uppercase; color: var(--rl-mute);
        }
        .rl-pct { font-variant-numeric: tabular-nums; letter-spacing: .12em; color: var(--rl-ink); min-width: 4ch; text-align: right; }
        .rl-line { position: relative; height: 1px; background: rgba(28, 28, 28, .12); overflow: hidden; }
        .rl-line i { position: absolute; inset: 0; background: var(--rl-ink); transform: scaleX(0); transform-origin: left; transition: transform .14s linear, background .5s ease; }

        /* Selesai */
        .rl.is-done .rl-dot { background: var(--rl-ok); animation: none; }
        .rl.is-done .rl-line i { background: var(--rl-ok); }

        @media (min-width: 640px) {
            .rl-ui { padding: 52px 56px; }
            .rl-loc { display: block; }
            .rl-head, .rl-foot-row { font-size: 11px; }
            .rl-logo { width: clamp(168px, 16vw, 210px); }
            .rl-headline { font-size: 12px; }
            .rl-sub { font-size: 11px; }
        }

        @keyframes rlIn { from { opacity: 0; transform: translateY(6px); } to { opacity: 1; transform: none; } }
        @keyframes rlBreath { 0%, 100% { opacity: 1; } 50% { opacity: .3; } }

        @media (prefers-reduced-motion: reduce) {
            .rl-dot { animation: none; }
            .rl-head, .rl-core, .rl-foot { animation-duration: .01s; animation-delay: 0s; }
        }
    </style>

    <!-- ==============================================
         RHINE LAB // MINIMAL BOOT
         Satu elemen utama: logo terisi tinta mengikuti progres.
         ============================================== -->
    <div id="pageLoader" class="rl" role="status" aria-live="off" aria-label="Memuat Rhine Lab OS">

        <!-- Shutter -->
        <div id="shutterTop" class="rl-shutter rl-shutter--t"></div>
        <div id="shutterBottom" class="rl-shutter rl-shutter--b"></div>

        <!-- Garis celah: muncul sesaat sebelum shutter terbuka -->
        <div class="rl-seam" aria-hidden="true"></div>

        <!-- Layer UI -->
        <div id="loaderUI" class="rl-ui">

            <header class="rl-head">
                <div class="rl-brand">
                    <span class="rl-dot" id="akStatusDot"></span>
                    <b>RHINE LAB LLC</b>
                </div>
                <div class="rl-loc">TRIMOUNTS / COLUMBIA</div>
            </header>

            <main class="rl-core">
                <div class="rl-logo">
                    <img class="rl-logo-ghost" src="{{ asset('images/logo.png') }}" alt="Rhine Lab" decoding="async">
                    <div id="rlLogoInk" class="rl-logo-ink" aria-hidden="true"><span class="rl-logo-fill"></span></div>
                </div>

                <div class="rl-state">
                    <div id="centerText" class="rl-headline">Access permission required</div>
                    <div id="rlSub" class="rl-sub">&nbsp;</div>
                </div>
            </main>

            <footer class="rl-foot">
                <div class="rl-foot-row">
                    <span id="akStatusText">Boot</span>
                    <span class="rl-pct"><span id="akProgressText">0</span>%</span>
                </div>
                <div class="rl-line" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" id="rlLine">
                    <i id="akProgressBar"></i>
                </div>
            </footer>
        </div>
    </div>

    <!-- Loader hanya tampil sekali per sesi browser. Bila sudah pernah, hapus sebelum dirender. -->
    <script>
        (function () {
            try {
                if (sessionStorage.getItem('rl_boot_seen') === '1') {
                    var l = document.getElementById('pageLoader');
                    if (l) l.remove();
                }
            } catch (e) {}
        })();
    </script>


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

        <!-- Profil / login kanan atas -->
        <div class="pf-wrap">
            @auth
                <a href="{{ route('logout.view') }}" class="pf" aria-label="Session: {{ auth()->user()->name }}">
                    <span class="pf-text">
                        <span class="pf-name">{{ auth()->user()->name }}</span>
                        <span class="pf-meta">Session</span>
                    </span>
                    <span class="pf-avatar">
                        <img src="{{ asset(auth()->user()->photo_path ?? 'images/users/Silence.png') }}"
                            alt="" decoding="async">
                        <i class="pf-live" aria-hidden="true"></i>
                    </span>
                </a>
            @else
                <a href="{{ route('login') }}" class="pf pf--guest">
                    <span class="pf-login">Login</span>
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
           MINIMAL BOOT LOADER
           ========================================= */
        if (loader) {
            const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

            const headline = document.getElementById('centerText');
            const subline = document.getElementById('rlSub');
            const loaderUI = document.getElementById('loaderUI');
            const logoInk = document.getElementById('rlLogoInk');
            const progressText = document.getElementById('akProgressText');
            const progressBar = document.getElementById('akProgressBar');
            const progressLine = document.getElementById('rlLine');
            const statusText = document.getElementById('akStatusText');
            const sTop = document.getElementById('shutterTop');
            const sBottom = document.getElementById('shutterBottom');

            const username = @json(auth()->check() ? auth()->user()->name : 'OPERATIVE').toUpperCase();

            // Tahapan boot
            const STAGES = [
                { at: 0,  head: 'Access permission required', sub: '',         stat: 'Boot' },
                { at: 35, head: 'ID confirmed // ' + username, sub: '',       stat: 'Auth' },
                { at: 70, head: 'Processing request',         sub: '',         stat: 'Decrypt' },
                { at: 95, head: 'Access granted',             sub: '',         stat: 'Ready' },
            ];

            let pageReady = document.readyState === 'complete';
            let finished = false;
            let stageIndex = -1;

            window.addEventListener('load', () => { pageReady = true; });
            setTimeout(() => { pageReady = true; }, 6000); // jaring pengaman bila aset lambat

            // Ganti teks dengan transisi halus
            function swapText(el, text) {
                const next = text || '\u00A0';
                if (!el || el.textContent === next) return;
                if (reduce) { el.textContent = next; return; }
                el.classList.add('is-swap');
                setTimeout(() => {
                    el.textContent = next;
                    el.classList.remove('is-swap');
                }, 200);
            }

            function applyStage(idx) {
                const st = STAGES[idx];
                swapText(headline, st.head);
                swapText(subline, st.sub);
                if (statusText) statusText.textContent = st.stat;
                if (idx === STAGES.length - 1) loader.classList.add('is-done');
            }

            function renderProgress(val) {
                const rounded = Math.round(val);
                if (progressText) progressText.textContent = rounded;
                if (progressLine) progressLine.setAttribute('aria-valuenow', rounded);
                if (progressBar) progressBar.style.transform = `scaleX(${val / 100})`;

                // Logo terisi tinta dengan tepi lembut
                if (logoInk) {
                    if (val >= 100) {
                        logoInk.classList.add('is-full');
                    } else {
                        logoInk.style.setProperty('--e', (val * 1.1).toFixed(2));
                    }
                }

                let idx = 0;
                for (let k = 0; k < STAGES.length; k++) if (val >= STAGES[k].at) idx = k;
                if (idx !== stageIndex) {
                    stageIndex = idx;
                    applyStage(idx);
                }
            }

            function finishLoading() {
                finished = true;
                try { sessionStorage.setItem('rl_boot_seen', '1'); } catch (e) {}

                const k = reduce ? 0.3 : 1; // percepat bila reduced-motion

                // 1) tahan sebentar di 100%
                setTimeout(() => {
                    // 2) UI memudar halus
                    loaderUI.classList.add('is-hidden');

                    setTimeout(() => {
                        // 3) garis celah muncul di tengah
                        loader.classList.add('is-seam');

                        setTimeout(() => {
                            // 4) shutter terbuka, halaman muncul dari balik shutter
                            loader.classList.add('is-opening');
                            sTop.classList.add('shutter-open-top');
                            sBottom.classList.add('shutter-open-bottom');

                            setTimeout(revealMain, 150 * k);
                            setTimeout(() => loader.remove(), 1400 * k + 100);
                        }, 450 * k);
                    }, 450 * k);
                }, 700 * k);
            }

            // Progres: langkah acak, jeda sedikit di pergantian tahap
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
                if (!reduce && prev < 35 && value >= 35) delay += 900;       // tahan di "ID confirmed" agar terbaca
                else if (!reduce && prev < 70 && value >= 70) delay += 260;
                if (value >= cap) delay = 120; // menunggu halaman selesai dimuat

                setTimeout(tick, delay);
            };

            renderProgress(0);
            setTimeout(tick, reduce ? 0 : 500); // beri waktu animasi intro

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