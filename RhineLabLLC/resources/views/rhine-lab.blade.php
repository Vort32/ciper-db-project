@extends('layouts.app')

@section('title', 'RHINE LAB.LLC')

@section('content')
    <!-- ==============================================
         RHINE LAB // BOOT SEQUENCE LOADER
         ============================================== -->
    <div id="pageLoader" class="rl-loader" role="status" aria-live="polite" aria-label="Memuat Rhine Lab OS">

        <!-- Shutter (dua panel yang membuka saat ACCESS GRANTED) -->
        <div class="rl-shutter rl-shutter-top"><div class="rl-hex"></div></div>
        <div class="rl-shutter rl-shutter-bottom"><div class="rl-hex"></div></div>

        <!-- Lapisan konten -->
        <div class="rl-layer">

            <!-- Hazard strip atas & bawah -->
            <div class="rl-hazard rl-hazard-top"></div>
            <div class="rl-hazard rl-hazard-bottom"></div>

            <!-- Crosshair grid -->
            <div class="rl-gridline rl-gridline-h"></div>
            <div class="rl-gridline rl-gridline-v"></div>

            <!-- HUD corners -->
            <span class="rl-corner rl-c-tl"></span>
            <span class="rl-corner rl-c-tr"></span>
            <span class="rl-corner rl-c-bl"></span>
            <span class="rl-corner rl-c-br"></span>

            <!-- Info sudut -->
            <div class="rl-tag rl-tag-tl">
                <b>RHL-ALPHA</b>
                <span>BUILD 0.9.4 // INTERNAL</span>
            </div>
            <div class="rl-tag rl-tag-tr">
                <b>SEC_LEVEL</b>
                <span class="rl-blink-text">CLASSIFIED</span>
            </div>

            <!-- Panel kiri: boot log -->
            <aside class="rl-panel rl-panel-left" aria-hidden="true">
                <div class="rl-panel-head"><i></i>BOOT_LOG</div>
                <ul id="rlLog" class="rl-log"></ul>
            </aside>

            <!-- Panel kanan: modul -->
            <aside class="rl-panel rl-panel-right" aria-hidden="true">
                <div class="rl-panel-head"><i></i>MODULES</div>
                <ul id="rlModules" class="rl-modules"></ul>
                <div class="rl-barcode">
                    <span style="height:100%;width:2px"></span><span style="height:60%;width:1px"></span><span style="height:100%;width:3px"></span><span style="height:45%;width:1px"></span><span style="height:80%;width:2px"></span><span style="height:100%;width:4px"></span><span style="height:60%;width:1px"></span>
                    <em>RL-ARCHIVE-XX</em>
                </div>
            </aside>

            <!-- Pusat: logo + ring -->
            <main class="rl-center">
                <div class="rl-brand">
                    <h1>RHINE LAB</h1>
                    <p>SYNTHESIZE INFORMATION OS</p>
                </div>

                <div class="rl-ring-wrap">
                    <svg class="rl-ring" viewBox="0 0 300 300" aria-hidden="true">
                        <!-- tick ring luar -->
                        <circle class="rl-ring-ticks rl-spin-slow" cx="150" cy="150" r="141" />
                        <!-- arc putus-putus berputar balik -->
                        <circle class="rl-ring-arcs rl-spin-rev" cx="150" cy="150" r="128" />
                        <!-- jalur progress -->
                        <circle class="rl-ring-track" cx="150" cy="150" r="112" />
                        <circle id="rlRingFill" class="rl-ring-fill" cx="150" cy="150" r="112" />
                        <!-- marka salib -->
                        <path class="rl-ring-cross" d="M150 2v14M150 284v14M2 150h14M284 150h14" />
                    </svg>
                    <div class="rl-logo-core">
                        <img src="{{ asset('images/logo.png') }}" alt="" />
                    </div>
                </div>

                <div class="rl-percent" aria-live="off">
                    <span id="akProgressText">0</span><small>%</small>
                </div>
                <div id="rlStamp" class="rl-stamp">ACCESS GRANTED</div>
            </main>

            <!-- Bawah: status + bar + tips -->
            <footer class="rl-bottom">
                <div class="rl-bottom-top">
                    <div class="rl-status">
                        <span id="akStatusDot" class="rl-dot"></span>
                        <span id="akStatusText">CONNECTING TO SERVER</span>
                    </div>
                    <div class="rl-console">
                        <span id="akConsoleOutput">INIT_SYSTEM...</span>
                        <small>SYS.MEM: <b id="rlMem">ALLOCATING</b></small>
                    </div>
                </div>

                <div id="akProgressBar" class="rl-bar" aria-hidden="true"></div>

                <div class="rl-tip">
                    <span class="rl-tip-label">TIPS</span>
                    <span id="rlTip" class="rl-tip-text"></span>
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
           RHINE LAB BOOT LOADER
           Palet: kertas #ECE8E5 / tinta #1c1c1c / oranye #EA7645 / teal #48AA8C / lime #C4FF00
           ========================================= */
        .rl-loader {
            --rl-paper: #ECE8E5;
            --rl-ink: #1c1c1c;
            --rl-mute: #7a766f;
            --rl-orange: #EA7645;
            --rl-teal: #48AA8C;
            --rl-lime: #C4FF00;
            position: fixed; inset: 0; z-index: 50; overflow: hidden;
            font-family: ui-monospace, SFMono-Regular, Menlo, Consolas, monospace;
            color: var(--rl-ink);
        }

        /* Shutter */
        .rl-shutter {
            position: absolute; left: 0; width: 100%; height: 50.2%;
            background: var(--rl-paper); overflow: hidden;
            transition: transform 0.9s cubic-bezier(.77,0,.18,1);
            z-index: 0;
        }
        .rl-shutter-top { top: 0; }
        .rl-shutter-bottom { bottom: 0; }
        .rl-shutter-bottom::before, .rl-shutter-top::after {
            content: ""; position: absolute; left: 0; width: 100%; height: 2px; background: var(--rl-ink);
        }
        .rl-shutter-top::after { bottom: 0; }
        .rl-shutter-bottom::before { top: 0; }
        .rl-hex {
            position: absolute; inset: 0; opacity: .55;
            background-image: url("data:image/svg+xml,%3Csvg width='40' height='69.282' viewBox='0 0 40 69.282' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M40 11.547L20 0 0 11.547v23.094l20 11.547 20-11.547V11.547zM20 45.034L1.155 34.148V12.376L20 1.49l18.845 10.886v21.772L20 45.034z' fill='%23000000' fill-opacity='0.05' fill-rule='evenodd'/%3E%3Cpath d='M40 46.188L20 34.641 0 46.188v23.094l20 11.547 20-11.547V46.188zM20 79.675L1.155 68.789V47.017L20 36.13l18.845 10.886v21.772L20 79.675z' fill='%23000000' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
            background-size: 60px 103.923px;
        }
        .rl-shutter-bottom .rl-hex { background-position: 0 -51.9px; }

        .rl-loader.rl-open .rl-shutter-top { transform: translateY(-101%); }
        .rl-loader.rl-open .rl-shutter-bottom { transform: translateY(101%); }
        .rl-loader.rl-open .rl-layer { opacity: 0; transition: opacity .35s ease; }

        /* Layer */
        .rl-layer { position: absolute; inset: 0; z-index: 1; display: grid;
            grid-template-columns: minmax(0, 1fr) auto minmax(0, 1fr);
            grid-template-rows: 1fr auto; padding: 56px 40px 28px; gap: 0 32px; }

        /* Hazard strips */
        .rl-hazard { position: absolute; left: 0; width: 100%; height: 8px; z-index: 2;
            background: repeating-linear-gradient(-45deg, var(--rl-ink) 0 10px, var(--rl-lime) 10px 20px); }
        .rl-hazard-top { top: 0; }
        .rl-hazard-bottom { bottom: 0; }

        /* Grid lines */
        .rl-gridline { position: absolute; background: rgba(28,28,28,.12); pointer-events: none; }
        .rl-gridline-h { left: 0; right: 0; top: 50%; height: 1px; }
        .rl-gridline-v { top: 0; bottom: 0; left: 50%; width: 1px; }

        /* Corners */
        .rl-corner { position: absolute; width: 44px; height: 44px; border: 0 solid rgba(28,28,28,.55); }
        .rl-c-tl { top: 24px; left: 24px; border-top-width: 2px; border-left-width: 2px; }
        .rl-c-tr { top: 24px; right: 24px; border-top-width: 2px; border-right-width: 2px; }
        .rl-c-bl { bottom: 24px; left: 24px; border-bottom-width: 2px; border-left-width: 2px; }
        .rl-c-br { bottom: 24px; right: 24px; border-bottom-width: 2px; border-right-width: 2px; }

        /* Tag sudut */
        .rl-tag { position: absolute; top: 34px; display: flex; flex-direction: column; gap: 2px; font-size: 10px; letter-spacing: .18em; }
        .rl-tag b { font-size: 11px; letter-spacing: .3em; }
        .rl-tag span { color: var(--rl-mute); }
        .rl-tag-tl { left: 80px; border-left: 4px solid var(--rl-lime); padding-left: 10px; }
        .rl-tag-tr { right: 80px; text-align: right; align-items: flex-end; }
        .rl-tag-tr span { color: var(--rl-orange); font-weight: 700; }
        .rl-blink-text { animation: rlBlink 1.6s steps(2, jump-none) infinite; }

        /* Panels */
        .rl-panel { align-self: center; font-size: 10px; letter-spacing: .1em; min-width: 0; }
        .rl-panel-left { grid-column: 1; justify-self: start; width: min(100%, 300px); }
        .rl-panel-right { grid-column: 3; justify-self: end; width: min(100%, 240px); }
        .rl-panel-head { display: flex; align-items: center; gap: 8px; padding-bottom: 6px; margin-bottom: 8px;
            border-bottom: 2px solid var(--rl-ink); font-weight: 800; letter-spacing: .3em; font-size: 10px; }
        .rl-panel-head i { width: 8px; height: 8px; background: var(--rl-orange); transform: rotate(45deg); }

        .rl-log { list-style: none; margin: 0; padding: 0; display: flex; flex-direction: column; gap: 5px; min-height: 150px; }
        .rl-log li { display: flex; gap: 8px; white-space: nowrap; overflow: hidden; color: #4a4742;
            animation: rlLine .25s ease-out; }
        .rl-log li time { color: var(--rl-mute); flex: none; }
        .rl-log li span { overflow: hidden; text-overflow: ellipsis; }
        .rl-log li em { font-style: normal; margin-left: auto; flex: none; font-weight: 800; color: var(--rl-teal); }
        .rl-log li.warn em { color: var(--rl-orange); }

        .rl-modules { list-style: none; margin: 0; padding: 0; display: flex; flex-direction: column; gap: 6px; }
        .rl-modules li { display: grid; grid-template-columns: 10px 1fr auto; align-items: center; gap: 8px;
            padding: 5px 8px; border: 1px solid rgba(28,28,28,.25); background: rgba(255,255,255,.35);
            color: var(--rl-mute); transition: background .2s, color .2s, border-color .2s; }
        .rl-modules li i { width: 6px; height: 6px; background: currentColor; transform: rotate(45deg); }
        .rl-modules li em { font-style: normal; font-weight: 800; font-size: 9px; }
        .rl-modules li.is-load { color: var(--rl-ink); border-color: var(--rl-orange); background: rgba(234,118,69,.12); }
        .rl-modules li.is-load i { background: var(--rl-orange); animation: rlBlink .5s steps(2, jump-none) infinite; }
        .rl-modules li.is-ok { color: var(--rl-ink); border-color: rgba(72,170,140,.7); }
        .rl-modules li.is-ok i { background: var(--rl-teal); }
        .rl-modules li.is-ok em { color: var(--rl-teal); }

        .rl-barcode { margin-top: 18px; height: 18px; display: flex; align-items: flex-end; gap: 2px; opacity: .5; }
        .rl-barcode span { background: var(--rl-ink); display: block; }
        .rl-barcode em { font-style: normal; font-size: 7px; margin-left: 6px; }

        /* Center */
        .rl-center { grid-column: 2; grid-row: 1; align-self: center; display: flex; flex-direction: column; align-items: center; min-width: 0; }
        .rl-brand { text-align: center; margin-bottom: 18px; }
        .rl-brand h1 { margin: 0; font-family: ui-sans-serif, system-ui, "Helvetica Neue", Arial, sans-serif;
            font-weight: 900; font-size: clamp(28px, 5.2vw, 56px); letter-spacing: .3em; margin-right: -.3em; line-height: 1; }
        .rl-brand p { margin: 8px 0 0; font-size: 10px; letter-spacing: .5em; margin-right: -.5em; color: var(--rl-mute); font-weight: 800; }

        .rl-ring-wrap { position: relative; width: clamp(190px, 28vh, 270px); aspect-ratio: 1; }
        .rl-ring { position: absolute; inset: 0; width: 100%; height: 100%; overflow: visible; }
        .rl-ring circle { fill: none; transform-origin: 150px 150px; }
        .rl-ring-ticks { stroke: rgba(28,28,28,.55); stroke-width: 8; stroke-dasharray: 1.5 13.8; }
        .rl-ring-arcs { stroke: rgba(28,28,28,.35); stroke-width: 1.5; stroke-dasharray: 90 40 20 40 60 40; }
        .rl-ring-track { stroke: rgba(28,28,28,.15); stroke-width: 6; }
        .rl-ring-fill { stroke: var(--rl-orange); stroke-width: 6; stroke-dasharray: 703.7; stroke-dashoffset: 703.7;
            transform: rotate(-90deg); transition: stroke-dashoffset .12s linear, stroke .3s;
            filter: drop-shadow(0 0 4px rgba(234,118,69,.7)); }
        .rl-ring-cross { stroke: var(--rl-ink); stroke-width: 2; fill: none; }
        .rl-spin-slow { animation: rlSpin 40s linear infinite; }
        .rl-spin-rev { animation: rlSpin 22s linear infinite reverse; }

        .rl-logo-core { position: absolute; inset: 24%; display: grid; place-items: center; }
        .rl-logo-core img { width: 100%; height: 100%; object-fit: contain; animation: rlLogoIn 1.2s ease-out both; }
        .rl-logo-core::before { content: ""; position: absolute; inset: -8%; border-radius: 50%;
            background: radial-gradient(circle, rgba(255,255,255,.7), transparent 70%); z-index: -1; }

        .rl-percent { margin-top: 14px; font-weight: 900; font-size: clamp(40px, 7vh, 64px); line-height: 1; letter-spacing: .06em;
            font-variant-numeric: tabular-nums; display: flex; align-items: baseline; }
        .rl-percent small { font-size: .3em; margin-left: 4px; color: var(--rl-mute); letter-spacing: 0; }

        .rl-stamp { position: absolute; bottom: 26%; padding: 6px 16px; border: 3px solid var(--rl-teal); color: var(--rl-teal);
            font-weight: 900; letter-spacing: .35em; font-size: clamp(12px, 2vw, 18px); background: rgba(236,232,229,.9);
            transform: rotate(-4deg) scale(1.6); opacity: 0; pointer-events: none; }
        .rl-stamp.is-show { animation: rlStamp .45s cubic-bezier(.2,.9,.3,1.2) forwards; }

        /* Bottom */
        .rl-bottom { grid-column: 1 / -1; grid-row: 2; padding: 0 24px 16px; }
        .rl-bottom-top { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 8px; gap: 16px; }
        .rl-status { display: flex; align-items: center; gap: 10px; font-weight: 800; font-size: clamp(10px, 1.4vw, 12px); letter-spacing: .22em; min-width: 0; }
        .rl-status span:last-child { white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .rl-dot { width: 10px; height: 10px; background: var(--rl-orange); transform: rotate(45deg); flex: none; animation: rlBlink .7s steps(2, jump-none) infinite; }
        .rl-dot.is-done { background: var(--rl-teal); animation: none; box-shadow: 0 0 10px var(--rl-teal); }
        .rl-status.is-done span:last-child { color: var(--rl-teal); }
        .rl-console { text-align: right; display: flex; flex-direction: column; font-size: 10px; letter-spacing: .15em; min-width: 0; }
        .rl-console span { color: var(--rl-orange); font-weight: 800; }
        .rl-console.is-done span { color: var(--rl-teal); }
        .rl-console small { font-size: 8px; color: var(--rl-mute); }
        .rl-console small b { color: var(--rl-teal); animation: rlBlink 1s steps(2, jump-none) infinite; }

        .rl-bar { display: grid; grid-template-columns: repeat(48, 1fr); gap: 3px; height: 18px; padding: 3px;
            border: 2px solid var(--rl-ink); background: rgba(255,255,255,.4); }
        .rl-seg { background: rgba(28,28,28,.12); transform: skewX(-24deg); transition: background .1s; }
        .rl-seg.on { background: var(--rl-ink); }
        .rl-seg.head { background: var(--rl-orange); box-shadow: 0 0 10px var(--rl-orange); }
        .rl-bar.is-done .rl-seg { background: var(--rl-teal); box-shadow: none; }

        .rl-tip { display: flex; align-items: center; gap: 12px; margin-top: 10px; font-size: 10px; letter-spacing: .12em; color: #4a4742; min-height: 20px; }
        .rl-tip-label { background: var(--rl-ink); color: var(--rl-paper); padding: 2px 8px; font-weight: 800; letter-spacing: .25em; flex: none;
            clip-path: polygon(0 0, 100% 0, calc(100% - 6px) 100%, 0 100%); padding-right: 14px; }
        .rl-tip-text { transition: opacity .3s; }
        .rl-tip-text.is-swap { opacity: 0; }

        /* Mobile */
        @media (max-width: 900px) {
            .rl-panel { display: none; }
            .rl-layer { grid-template-columns: 1fr; padding: 48px 16px 20px; }
            .rl-center { grid-column: 1; }
            .rl-tag-tl { left: 56px; } .rl-tag-tr { right: 56px; }
            .rl-bottom { padding: 0 4px 12px; }
            .rl-bar { grid-template-columns: repeat(32, 1fr); }
            .rl-seg:nth-child(n+33) { display: none; }
        }
        @media (max-height: 560px) { .rl-brand p, .rl-tip { display: none; } }

        @keyframes rlSpin { to { transform: rotate(360deg); } }
        @keyframes rlBlink { 50% { opacity: .25; } }
        @keyframes rlLine { from { opacity: 0; transform: translateX(-8px); } to { opacity: 1; transform: none; } }
        @keyframes rlLogoIn { from { opacity: 0; transform: scale(.7); filter: blur(6px); } to { opacity: 1; transform: none; filter: none; } }
        @keyframes rlStamp { to { opacity: 1; transform: rotate(-4deg) scale(1); } }

        @media (prefers-reduced-motion: reduce) {
            .rl-spin-slow, .rl-spin-rev, .rl-blink-text, .rl-dot, .rl-console small b { animation: none; }
            .rl-shutter { transition-duration: .01s; }
        }

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
            const consoleEl = $('akConsoleOutput');
            const consoleBox = consoleEl.parentElement;
            const statusText = $('akStatusText');
            const statusDot = $('akStatusDot');
            const statusBox = statusDot.parentElement;
            const logEl = $('rlLog');
            const modulesEl = $('rlModules');
            const memEl = $('rlMem');
            const stampEl = $('rlStamp');
            const tipEl = $('rlTip');

            const SEGMENTS = 48;
            const RING_LEN = 703.7; // 2 * PI * 112

            // at = persen saat tahap mulai
            const stages = [
                { at: 0,  console: 'INIT_SYSTEM...',                      status: 'CONNECTING TO SERVER',  log: 'Kernel handshake RHL-ALPHA',    module: 'CORE_KERNEL' },
                { at: 18, console: 'VERIFYING_CREDENTIALS...',            status: 'VERIFYING OPERATOR',    log: 'Credential check',              module: 'AUTH_GATE' },
                { at: 36, console: 'MOUNTING_ORIGINIUM_ARTS_DB...',       status: 'MOUNTING DATABASE',     log: 'Mount originium_arts.db',       module: 'ORIGINIUM_ARTS_DB' },
                { at: 54, console: 'DECRYPTING_CLASSIFIED_FILES...',      status: 'DECRYPTING ARCHIVE',    log: 'Decrypt archive RL-ARCHIVE-XX', module: 'ARCHIVE_INDEX' },
                { at: 72, console: 'ESTABLISHING_SECURE_CONNECTION...',   status: 'SECURING CHANNEL',      log: 'Open secure channel',           module: 'SECURE_LINK' },
                { at: 90, console: 'SYNC_INTERFACE...',                   status: 'SYNCING INTERFACE',     log: 'Sync UI shell',                 module: 'UI_SHELL' }
            ];

            const tips = [
                'Seluruh data di Internal Database bersifat rahasia dan hanya untuk operator terdaftar.',
                'Gunakan menu RESEARCH untuk menelusuri arsip riset Rhine Lab.',
                'Menu USER menampilkan ledger operator yang terdaftar di sistem.',
                'Sesi akan berakhir otomatis bila tidak ada aktivitas.',
                'Rhine Lab: Synthesize Information, Analysis OS.'
            ];

            // Bangun segmen bar
            const segs = [];
            for (let s = 0; s < SEGMENTS; s++) {
                const d = document.createElement('div');
                d.className = 'rl-seg';
                barEl.appendChild(d);
                segs.push(d);
            }

            // Bangun daftar modul
            const modItems = stages.map(st => {
                const li = document.createElement('li');
                li.innerHTML = '<i></i><span>' + st.module + '</span><em>WAIT</em>';
                modulesEl.appendChild(li);
                return li;
            });

            const t0 = performance.now();
            const stamp = () => {
                const t = (performance.now() - t0) / 1000;
                return t.toFixed(2).padStart(5, '0');
            };
            const addLog = (text, result, warn) => {
                const li = document.createElement('li');
                if (warn) li.className = 'warn';
                li.innerHTML = '<time>[' + stamp() + ']</time><span>' + text + '</span><em>' + (result || 'OK') + '</em>';
                logEl.appendChild(li);
                while (logEl.children.length > 8) logEl.removeChild(logEl.firstChild);
            };

            const setModule = (idx, state) => {
                const li = modItems[idx];
                if (!li) return;
                li.className = state === 'load' ? 'is-load' : 'is-ok';
                li.lastElementChild.textContent = state === 'load' ? 'LOAD' : 'OK';
            };

            let progress = 0;
            let stageIdx = -1;
            let pageReady = document.readyState === 'complete';
            let finished = false;
            window.addEventListener('load', () => { pageReady = true; });

            function enterStage(idx) {
                if (idx > 0) {
                    setModule(idx - 1, 'ok');
                    // sesekali beri WARN palsu biar terasa hidup
                    addLog(stages[idx - 1].log, idx === 3 ? 'WARN' : 'OK', idx === 3);
                }
                stageIdx = idx;
                setModule(idx, 'load');
                consoleEl.textContent = stages[idx].console;
                statusText.textContent = stages[idx].status;
            }

            function render() {
                const shown = Math.round(progress);
                percentEl.textContent = shown;
                ringFill.style.strokeDashoffset = RING_LEN * (1 - progress / 100);

                const filled = Math.floor((progress / 100) * SEGMENTS);
                for (let s = 0; s < SEGMENTS; s++) {
                    segs[s].classList.toggle('on', s < filled);
                    segs[s].classList.toggle('head', s === filled && progress < 100);
                }
                while (stageIdx + 1 < stages.length && progress >= stages[stageIdx + 1].at) {
                    enterStage(stageIdx + 1);
                }
            }

            // Tips berganti
            let tipIdx = 0;
            tipEl.textContent = tips[0];
            const tipTimer = setInterval(() => {
                tipEl.classList.add('is-swap');
                setTimeout(() => {
                    tipIdx = (tipIdx + 1) % tips.length;
                    tipEl.textContent = tips[tipIdx];
                    tipEl.classList.remove('is-swap');
                }, 300);
            }, 2400);

            const memTimer = setInterval(() => {
                memEl.textContent = (Math.random() * 40 + 40).toFixed(1) + 'MB';
            }, 250);

            function finish() {
                finished = true;
                clearInterval(tipTimer);
                clearInterval(memTimer);
                setModule(stages.length - 1, 'ok');
                addLog(stages[stages.length - 1].log, 'OK');
                addLog('Access granted', 'OK');

                statusText.textContent = 'SYSTEM READY // ACCESS GRANTED';
                statusBox.classList.add('is-done');
                statusDot.classList.add('is-done');
                consoleEl.textContent = 'OS_LOADED_SUCCESSFULLY.';
                consoleBox.classList.add('is-done');
                memEl.textContent = 'STABLE';
                barEl.classList.add('is-done');
                ringFill.style.stroke = '#48AA8C';
                ringFill.style.filter = 'drop-shadow(0 0 5px rgba(72,170,140,.8))';
                stampEl.classList.add('is-show');

                // Tahan sebentar, lalu buka shutter
                setTimeout(() => {
                    loader.classList.add('rl-open');
                    setTimeout(revealMain, 450);
                    setTimeout(() => loader.remove(), 1100);
                }, 1000);
            }

            // Loop progres
            const timer = setInterval(() => {
                // Tahan di 92% sampai semua aset halaman benar-benar selesai dimuat
                const cap = pageReady ? 100 : 92;
                if (Math.random() > 0.14) { // jeda acak
                    progress = Math.min(progress + (Math.random() * 3.6 + 0.6), cap);
                }
                render();
                if (progress >= 100 && !finished) {
                    clearInterval(timer);
                    finish();
                }
            }, 70);

            enterStage(0);
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