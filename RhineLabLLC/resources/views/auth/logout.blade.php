@extends('layouts.app')

@section('title', 'Session Termination - RHINE LAB.LLC')

@section('content')
@php
    $showLoginOverlay = session()->has('status');
    $roleLabel = $user?->is_division_head ? 'Kepala Divisi' : 'Operatif Riset';
    $orgName   = $selectedOrganization['name'] ?? $user?->affiliation ?? 'RHINE LAB LLC';
    $orgLogo   = !empty($selectedOrganization['logo']) ? $selectedOrganization['logo'] : 'images/logo.png';
    $divName   = $selectedDivision?->name ?? ($user?->division?->name ?? 'RHINE RESEARCH SECTION');
    $divCode   = $selectedDivision?->code ?? ($user?->division?->code ?? 'SECTOR-01');
    $usrId     = 'USR-' . str_pad($user?->id ?? '001', 3, '0', STR_PAD_LEFT);
@endphp

{{-- ==============================================
     OVERLAY "ID CONFIRMED" (setelah login)
     ============================================== --}}
@if ($user && $showLoginOverlay)
    <div id="loginCompletionOverlay" class="ov" role="status" aria-live="polite"
         aria-label="ID confirmed: {{ $user->name }}"
         data-name="{{ $user->name }}">

        <div class="ov-photo" style="background-image: url('{{ asset('images/Rhine_Lab_HQ1.png') }}');"></div>
        <div class="ov-hex hex-bg"></div>

        <div class="ov-head">
            <div class="ov-h1">RHINE LAB</div>
            <div class="ov-h2">SYNTHESIZE INFORMATION</div>
            <div class="ov-h3"><span>ANALYSIS</span><b>OS</b></div>
        </div>

        <div class="ov-stage">
            <div class="ov-logo">
                <img src="{{ asset('images/logo.png') }}" alt="Rhine Lab">
            </div>
            <div class="ov-text">
                <div class="ov-line">
                    <span class="ov-dash"></span>
                    <span class="ov-label">ID CONFIRMED :</span>
                    <span class="ov-name" data-overlay-name></span><span class="ov-caret"></span>
                </div>
                <div class="ov-role">{{ $user->position ?? ($user->is_division_head ? 'Kepala Divisi' : 'Operatif') }}</div>
            </div>
        </div>

        <div class="ov-status">
            <span class="ov-dot" data-overlay-dot></span>
            <span data-overlay-status>VERIFYING CREDENTIALS</span>
        </div>

        <div class="ov-foot">POWERED BY <b>RHINE LAB</b><span class="ov-foot-dash"></span></div>

        <div class="ov-progress"><i data-overlay-progress></i></div>
    </div>
@endif

{{-- ==============================================
     HALAMAN TERMINASI SESI (layout HUD split)
     ============================================== --}}
<div id="pageWrapper" class="en-page">
    <div class="en-bg" aria-hidden="true"></div>

    {{-- ===== KIRI: PORTRAIT OPERATIF ===== --}}
    <aside class="en-stage rv" style="--d:.05s" aria-label="Profil operatif">
        <div class="en-photo">
            <img src="{{ asset($user?->photo_path ?? 'images/users/Silence.png') }}"
                 alt="Foto {{ $user?->name }}" decoding="async">
        </div>
        <span class="en-ghost" aria-hidden="true">TERMINATE</span>

        <i class="en-cross en-cross--a" aria-hidden="true"></i>
        <i class="en-cross en-cross--b" aria-hidden="true"></i>

        <div class="en-caption">
            <span class="en-id">{{ $usrId }}</span>
            <p class="en-role">{{ $roleLabel }}</p>
            <p class="en-name">{{ $user?->name }}</p>
            <p class="en-pos">{{ $user?->position ?? 'Researcher' }}</p>
        </div>
    </aside>

    {{-- ===== KANAN: PANEL DATA ===== --}}
    <main class="en-side">
        <header class="en-top">
            <div class="en-brand rv" style="--d:.15s">
                <span class="en-brand-1">RHINE LAB</span>
                <span class="en-brand-2">SYNTHESIZE INFORMATION</span>
                <span class="en-brand-3">ANALYSIS <b>OS</b></span>
            </div>
            <div class="en-live rv" style="--d:.2s"><i></i>Sesi aktif</div>
        </header>

        <section class="en-panel rv" style="--d:.3s" aria-labelledby="logoutHeadline">
            <i class="en-br en-br--tl" aria-hidden="true"></i>
            <i class="en-br en-br--tr" aria-hidden="true"></i>
            <i class="en-br en-br--bl" aria-hidden="true"></i>
            <i class="en-br en-br--br" aria-hidden="true"></i>

            <p class="en-tag">Operative termination node</p>
            <h1 id="logoutHeadline" class="en-title" aria-label="Session Termination"></h1>
            <div class="en-rule" aria-hidden="true"><i></i></div>
            <p class="en-sub">Konfirmasi untuk mengakhiri sesi kerja operatif.</p>

            <dl class="en-data">
                <div class="en-row">
                    <dt>Organisasi</dt>
                    <dd>
                        <span>{{ $orgName }}</span>
                        <img src="{{ asset($orgLogo) }}" alt="Logo organisasi" class="en-logo" loading="lazy" decoding="async">
                    </dd>
                </div>
                <div class="en-row">
                    <dt>Divisi</dt>
                    <dd>
                        <span>{{ $divName }}<small>{{ $divCode }}</small></span>
                        @if (!empty($selectedDivision?->photo_path))
                            <img src="{{ asset($selectedDivision->photo_path) }}" alt="Logo divisi" class="en-logo" loading="lazy" decoding="async">
                        @endif
                    </dd>
                </div>
                <div class="en-row">
                    <dt>Status</dt>
                    <dd><span>Menunggu otorisasi<small>Akses akan dicabut setelah konfirmasi</small></span></dd>
                </div>
            </dl>

            <form action="{{ route('logout') }}" method="post" class="en-actions">
                @csrf
                <button type="submit" class="en-btn">
                    <span class="en-btn-label">Akhiri sesi</span>
                    <span class="en-btn-icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                            <path stroke-linecap="square" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </span>
                </button>

                <nav class="en-links" aria-label="Pintasan">
                    <a href="{{ route('admin.dashboard') }}" class="en-link en-link--accent">Pusat Admin</a>
                    <a href="{{ route('research-records.index') }}" class="en-link">Catatan Riset</a>
                    <a href="{{ route('research.ledger') }}" class="en-link">Direktori</a>
                </nav>
            </form>
        </section>

        <footer class="en-foot rv" style="--d:.6s">
            <span>RHINE OS v3.2.0 · Restricted access</span>
            <span>POWERED BY <b>RHINE LAB</b></span>
        </footer>
    </main>
</div>

<noscript><style>.rv{opacity:1!important;transform:none!important}</style></noscript>

<style>
    :root {
        --en-bg: #ECE8E5;
        --en-ink: #1c1c1c;
        --en-mute: #7a766f;
        --en-line: rgba(28, 28, 28, .12);
        --en-accent: #EA7645;
        --en-ok: #48AA8C;
        --en-mono: ui-monospace, SFMono-Regular, Menlo, Consolas, monospace;
    }

    .hex-bg {
        background-image: url("data:image/svg+xml,%3Csvg width='40' height='69.282' viewBox='0 0 40 69.282' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M40 11.547L20 0 0 11.547v23.094l20 11.547 20-11.547V11.547zM20 45.034L1.155 34.148V12.376L20 1.49l18.845 10.886v21.772L20 45.034z' fill='%23000000' fill-opacity='0.04' fill-rule='evenodd'/%3E%3Cpath d='M40 46.188L20 34.641 0 46.188v23.094l20 11.547 20-11.547V46.188zM20 79.675L1.155 68.789V47.017L20 36.13l18.845 10.886v21.772L20 79.675z' fill='%23000000' fill-opacity='0.04' fill-rule='evenodd'/%3E%3C/svg%3E");
        background-size: 60px 103.923px;
    }

    /* =========================================
       HALAMAN UTAMA — mobile first
       ========================================= */
    .en-page {
        position: relative; min-height: 100vh; min-height: 100dvh;
        display: flex; flex-direction: column;
        color: var(--en-ink); background: var(--en-bg); overflow-x: hidden;
        font-family: "Helvetica Neue", Helvetica, Arial, ui-sans-serif, system-ui, sans-serif;
        -webkit-font-smoothing: antialiased;
    }

    /* Latar statis: gradient + garis grid tipis, tanpa blur layer */
    .en-bg {
        position: fixed; inset: 0; z-index: 0; pointer-events: none;
        background:
            radial-gradient(50rem 36rem at 100% 0%, rgba(255, 255, 255, .85), transparent 60%),
            radial-gradient(36rem 28rem at 0% 100%, rgba(234, 118, 69, .12), transparent 62%),
            linear-gradient(var(--en-line), var(--en-line)) 0 0 / 100% 1px no-repeat,
            var(--en-bg);
    }
    .en-bg::after {
        content: ""; position: absolute; inset: 0; opacity: .5;
        background-image:
            linear-gradient(to right, rgba(28, 28, 28, .045) 1px, transparent 1px),
            linear-gradient(to bottom, rgba(28, 28, 28, .045) 1px, transparent 1px);
        background-size: 72px 72px;
        -webkit-mask-image: linear-gradient(115deg, transparent 20%, #000 70%);
                mask-image: linear-gradient(115deg, transparent 20%, #000 70%);
    }

    /* Reveal: satu urutan masuk, murni CSS */
    .rv { opacity: 0; transform: translateY(8px); transition: opacity .6s ease var(--d, 0s), transform .6s cubic-bezier(.16, 1, .3, 1) var(--d, 0s); }
    .en-page.is-in .rv { opacity: 1; transform: none; }

    /* ---- Stage / portrait ---- */
    .en-stage { position: relative; z-index: 1; height: 44vh; height: 44dvh; min-height: 280px; max-height: 420px; }
    .en-photo { position: absolute; inset: 0; clip-path: polygon(0 0, 100% 0, 100% 86%, 0 100%); background: #d9d4cf; }
    .en-photo img { display: block; width: 100%; height: 100%; object-fit: cover; object-position: center 20%; }
    .en-photo::after { content: ""; position: absolute; inset: 0; background: linear-gradient(to top, rgba(20, 20, 20, .72), rgba(20, 20, 20, 0) 62%); }

    .en-ghost {
        position: absolute; right: 12px; top: 56px; z-index: 1; pointer-events: none; user-select: none;
        font-size: clamp(44px, 14vw, 72px); font-weight: 900; letter-spacing: .06em; line-height: 1;
        color: transparent; -webkit-text-stroke: 1px rgba(255, 255, 255, .55);
        writing-mode: vertical-rl;
    }

    .en-cross { position: absolute; z-index: 2; width: 14px; height: 14px; pointer-events: none; }
    .en-cross::before, .en-cross::after { content: ""; position: absolute; background: #fff; }
    .en-cross::before { left: 6px; top: 0; width: 2px; height: 14px; }
    .en-cross::after { left: 0; top: 6px; width: 14px; height: 2px; }
    .en-cross--a { left: 16px; top: 16px; }
    .en-cross--b { right: 16px; top: 16px; }

    .en-caption { position: absolute; z-index: 2; left: 20px; right: 20px; bottom: 52px; color: #fff; }
    .en-id { display: inline-block; padding: 3px 8px; margin-bottom: 10px; font: 700 10px/1.4 var(--en-mono); letter-spacing: .22em; color: var(--en-ink); background: #fff; }
    .en-role { margin: 0; font-size: 10px; font-weight: 700; letter-spacing: .24em; text-transform: uppercase; color: var(--en-accent); }
    .en-name { margin: 4px 0 0; font-size: clamp(24px, 7vw, 34px); font-weight: 800; line-height: 1.1; }
    .en-pos { margin: 4px 0 0; font-size: 12px; opacity: .8; }

    /* ---- Side / panel ---- */
    .en-side { position: relative; z-index: 2; flex: 1; display: flex; flex-direction: column; gap: 20px; padding: 0 16px 16px; margin-top: -28px; }
    .en-top { display: none; }
    .en-brand { display: flex; flex-direction: column; width: max-content; line-height: 1; }
    .en-brand-1 { font-size: 22px; font-weight: 800; letter-spacing: .01em; }
    .en-brand-2 { margin-top: 3px; font-size: 7.5px; font-weight: 500; letter-spacing: .02em; text-align-last: justify; }
    .en-brand-3 { display: flex; justify-content: space-between; margin-top: 3px; font-size: 16px; letter-spacing: .02em; }
    .en-brand-3 b { font-weight: 800; color: var(--en-accent); }
    .en-live { display: inline-flex; align-items: center; gap: 8px; font-size: 11px; font-weight: 600; letter-spacing: .08em; color: var(--en-mute); }
    .en-live i { width: 7px; height: 7px; border-radius: 50%; background: var(--en-ok); animation: enPulse 2.4s ease-out infinite; }

    .en-panel {
        position: relative; padding: 24px 20px 22px;
        background: linear-gradient(145deg, rgba(255, 255, 255, .7), rgba(255, 255, 255, .34));
        border: 1px solid rgba(255, 255, 255, .9);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 1), 0 24px 48px -28px rgba(0, 0, 0, .18);
        -webkit-backdrop-filter: blur(10px) saturate(1.1);
                backdrop-filter: blur(10px) saturate(1.1);
    }
    @supports not ((backdrop-filter: blur(1px)) or (-webkit-backdrop-filter: blur(1px))) {
        .en-panel { background: rgba(250, 248, 246, .94); }
    }

    /* siku sudut ala HUD */
    .en-br { position: absolute; width: 12px; height: 12px; border: 0 solid var(--en-ink); pointer-events: none; }
    .en-br--tl { left: -1px; top: -1px; border-left-width: 2px; border-top-width: 2px; }
    .en-br--tr { right: -1px; top: -1px; border-right-width: 2px; border-top-width: 2px; }
    .en-br--bl { left: -1px; bottom: -1px; border-left-width: 2px; border-bottom-width: 2px; }
    .en-br--br { right: -1px; bottom: -1px; border-right-width: 2px; border-bottom-width: 2px; border-color: var(--en-accent); }

    .en-tag { margin: 0; font: 700 10px/1.4 var(--en-mono); letter-spacing: .24em; text-transform: uppercase; color: var(--en-accent); }
    .en-title { min-height: 1.15em; margin: 10px 0 0; font-size: clamp(26px, 8vw, 44px); font-weight: 900; letter-spacing: .06em; line-height: 1.1; }
    .en-title.is-typing::after { content: ""; display: inline-block; width: 3px; height: .85em; margin-left: 6px; vertical-align: -.05em; background: var(--en-accent); animation: enBlink .8s steps(2, jump-none) infinite; }
    .en-rule { position: relative; height: 1px; margin: 16px 0 12px; background: var(--en-line); }
    .en-rule i { position: absolute; left: 0; top: -1px; width: 56px; height: 3px; background: var(--en-accent); }
    .en-sub { margin: 0; font-size: 13px; color: var(--en-mute); }

    /* Data rows: label kiri, nilai kanan, garis tipis */
    .en-data { margin: 20px 0 0; border-top: 1px solid var(--en-line); }
    .en-row { display: flex; flex-direction: column; gap: 6px; padding: 12px 0; border-bottom: 1px solid var(--en-line); }
    .en-row dt { font: 700 10px/1.4 var(--en-mono); letter-spacing: .2em; text-transform: uppercase; color: var(--en-mute); }
    .en-row dd { display: flex; align-items: center; justify-content: space-between; gap: 12px; margin: 0; font-size: 14px; font-weight: 700; letter-spacing: .02em; text-transform: uppercase; }
    .en-row dd small { display: block; margin-top: 2px; font: 600 10px/1.4 var(--en-mono); letter-spacing: .14em; text-transform: none; color: var(--en-accent); }
    .en-logo { flex: none; width: 34px; height: 34px; object-fit: contain; filter: grayscale(1); opacity: .75; }

    /* Aksi */
    .en-actions { display: flex; flex-direction: column; gap: 16px; margin: 22px 0 0; }
    .en-btn {
        display: flex; align-items: stretch; width: 100%; padding: 0; border: 0; cursor: pointer; color: #fff; background: var(--en-ink);
        clip-path: polygon(0 0, calc(100% - 16px) 0, 100% 16px, 100% 100%, 16px 100%, 0 calc(100% - 16px));
        transition: background-color .2s ease;
    }
    .en-btn-label { flex: 1; padding: 17px 20px; text-align: left; font-size: 12px; font-weight: 700; letter-spacing: .26em; text-transform: uppercase; }
    .en-btn-icon { display: flex; align-items: center; justify-content: center; width: 56px; background: var(--en-accent); transition: background-color .2s ease; }
    .en-btn:hover { background: #2b2b2b; }
    .en-btn:hover .en-btn-icon { background: #d66031; }
    .en-btn:active { transform: scale(.985); }
    .en-links { display: flex; flex-wrap: wrap; gap: 8px 0; }
    .en-link { padding: 6px 14px 6px 0; margin-right: 14px; font-size: 12px; font-weight: 600; letter-spacing: .06em; text-decoration: none; color: var(--en-ink); border-right: 1px solid var(--en-line); transition: color .2s ease; }
    .en-link:last-child { border-right: 0; margin-right: 0; padding-right: 0; }
    .en-link:hover { color: var(--en-ok); }
    .en-link--accent { color: var(--en-accent); }
    .en-link--accent:hover { color: var(--en-accent); text-decoration: underline; text-underline-offset: 4px; }
    .en-btn:focus-visible, .en-link:focus-visible { outline: 2px solid var(--en-accent); outline-offset: 3px; }

    .en-foot { display: flex; justify-content: space-between; flex-wrap: wrap; gap: 8px 12px; margin-top: auto; font: 500 10px/1.4 var(--en-mono); letter-spacing: .08em; color: var(--en-mute); }
    .en-foot b { font-weight: 800; color: var(--en-ink); }

    /* =========================================
       DESKTOP — split screen
       ========================================= */
    @media (min-width: 900px) {
        .en-page { display: grid; grid-template-columns: minmax(340px, 5fr) 7fr; height: 100vh; height: 100dvh; overflow: hidden; }
        .en-stage { height: 100%; max-height: none; min-height: 0; }
        .en-photo { clip-path: polygon(0 0, 100% 0, calc(100% - 72px) 100%, 0 100%); }
        .en-ghost { right: 96px; top: 96px; font-size: clamp(64px, 8vw, 120px); }
        .en-cross--a { left: 28px; top: 28px; }
        .en-cross--b { display: none; }
        .en-caption { left: 40px; right: 96px; bottom: 56px; }
        .en-name { font-size: clamp(30px, 3.2vw, 44px); }

        .en-side { margin-top: 0; padding: 32px clamp(32px, 5vw, 80px) 28px 8px; gap: 0; justify-content: space-between; overflow-y: auto; }
        .en-top { display: flex; align-items: flex-start; justify-content: space-between; gap: 16px; }
        .en-panel { align-self: stretch; max-width: 640px; width: 100%; margin: auto 0; padding: 36px 36px 32px; -webkit-backdrop-filter: blur(18px) saturate(1.15); backdrop-filter: blur(18px) saturate(1.15); }
        .en-row { flex-direction: row; align-items: center; justify-content: space-between; gap: 24px; }
        .en-row dt { flex: none; width: 110px; }
        .en-row dd { flex: 1; }
        .en-foot { margin-top: 0; }
    }

    @media (min-height: 1px) and (max-height: 640px) and (min-width: 900px) {
        .en-page { height: auto; min-height: 100dvh; overflow: auto; }
    }

    @keyframes enPulse { 0% { box-shadow: 0 0 0 0 rgba(72, 170, 140, .5); } 70%, 100% { box-shadow: 0 0 0 7px rgba(72, 170, 140, 0); } }
    @keyframes enBlink { 50% { opacity: .2; } }

    @media (prefers-reduced-motion: reduce) {
        .rv { transition-duration: .01s; transition-delay: 0s; transform: none; }
        .en-live i, .en-title.is-typing::after { animation: none; }
    }

    /* =========================================
       OVERLAY: ID CONFIRMED
       ========================================= */
    .ov {
        position: fixed; inset: 0; z-index: 50; overflow: hidden;
        background: #ECE8E5; color: #1c1c1c;
        font-family: "Helvetica Neue", Helvetica, Arial, ui-sans-serif, system-ui, sans-serif;
        clip-path: inset(0 0 0 0);
        transition: clip-path .9s cubic-bezier(.77, 0, .18, 1);
    }
    .ov.is-out { clip-path: inset(0 0 100% 0); }

    .ov-photo { position: absolute; inset: 0; background-size: cover; background-position: center; opacity: .06; }
    .ov-hex { position: absolute; inset: 0; opacity: .7; }

    .ov-head {
        position: absolute; top: clamp(24px, 6vh, 60px); left: clamp(20px, 5vw, 72px);
        display: flex; flex-direction: column; width: max-content; line-height: 1;
    }
    .ov-h1, .ov-h2, .ov-h3 { opacity: 0; animation: ovSlide .8s cubic-bezier(.16, 1, .3, 1) forwards; }
    .ov-h1 { font-size: clamp(22px, 2.2vw, 30px); font-weight: 800; letter-spacing: .01em; animation-delay: .15s; }
    .ov-h2 { font-size: clamp(7.5px, .68vw, 9.5px); font-weight: 500; letter-spacing: .02em; margin-top: 3px; text-align-last: justify; animation-delay: .3s; }
    .ov-h3 { display: flex; justify-content: space-between; gap: .6em; margin-top: 3px; font-size: clamp(17px, 1.7vw, 23px); font-weight: 400; letter-spacing: .02em; animation-delay: .45s; }
    .ov-h3 b { font-weight: 800; }

    .ov-stage { position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; padding: 0 24px; }
    .ov-logo { flex: none; width: clamp(150px, 18vw, 230px); animation: ovWipe 1.1s .45s cubic-bezier(.65, 0, .2, 1) both; }
    .ov-logo img { display: block; width: 100%; height: auto; }

    .ov-text {
        max-width: 0; opacity: 0; overflow: hidden; white-space: nowrap; padding-left: 0;
        transition: max-width 1s cubic-bezier(.65, 0, .2, 1), padding-left 1s cubic-bezier(.65, 0, .2, 1), opacity .5s .2s ease;
    }
    .ov.is-id .ov-text { max-width: min(640px, 70vw); opacity: 1; padding-left: clamp(28px, 4vw, 56px); }

    .ov-line { display: flex; align-items: center; gap: 10px; font-size: clamp(13px, 1.25vw, 16px); letter-spacing: .04em; }
    .ov-dash { width: 8px; height: 2px; background: #1c1c1c; flex: none; }
    .ov-label { color: #4a4743; }
    .ov-name { font-weight: 700; }
    .ov-caret { width: 2px; height: 1.15em; background: #EA7645; animation: ovBlink .8s steps(2, jump-none) infinite; transition: opacity .3s; }
    .ov.is-done .ov-caret { opacity: 0; animation: none; }

    .ov-role {
        margin: 8px 0 0 18px; font-size: 10px; letter-spacing: .32em; font-weight: 700; text-transform: uppercase; color: #7a766f;
        opacity: 0; transform: translateY(4px); transition: opacity .6s ease, transform .6s ease;
    }
    .ov.is-done .ov-role { opacity: 1; transform: none; }

    .ov-status {
        position: absolute; left: clamp(20px, 5vw, 72px); bottom: clamp(20px, 4vh, 40px);
        display: flex; align-items: center; gap: 10px;
        font-family: ui-monospace, SFMono-Regular, Menlo, Consolas, monospace;
        font-size: 9px; letter-spacing: .3em; font-weight: 700; color: #7a766f; opacity: 0;
        animation: ovFade .8s .9s ease forwards;
    }
    .ov-dot { width: 7px; height: 7px; background: #EA7645; transform: rotate(45deg); animation: ovBlink .7s steps(2, jump-none) infinite; transition: background .3s; }
    .ov-dot.is-done { background: #48AA8C; animation: none; box-shadow: 0 0 8px #48AA8C; }

    .ov-foot {
        position: absolute; right: clamp(20px, 5vw, 72px); bottom: clamp(20px, 4vh, 40px);
        display: flex; align-items: center; gap: 8px; font-size: 10px; letter-spacing: .03em; opacity: 0;
        animation: ovFade .8s 1s ease forwards;
    }
    .ov-foot b { font-weight: 800; }
    .ov-foot-dash { display: block; height: 4px; width: 0; background: #1c1c1c; animation: ovGrow .7s 1.4s cubic-bezier(.16, 1, .3, 1) forwards; }

    .ov-progress { position: absolute; left: 0; right: 0; bottom: 0; height: 2px; background: rgba(28, 28, 28, .08); }
    .ov-progress i { position: absolute; inset: 0; background: #1c1c1c; transform-origin: left; transform: scaleX(0); transition: transform .6s cubic-bezier(.16, 1, .3, 1), background .4s; }
    .ov-progress i.is-done { background: #48AA8C; }

    @media (max-width: 640px) {
        .ov-stage { flex-direction: column; }
        .ov-text { max-width: none; max-height: 0; white-space: normal; text-align: center; transition: max-height .8s cubic-bezier(.65, 0, .2, 1), padding-top .8s cubic-bezier(.65, 0, .2, 1), opacity .5s .2s ease; }
        .ov.is-id .ov-text { max-width: none; max-height: 100px; padding-left: 0; padding-top: 22px; }
        .ov-line { justify-content: center; flex-wrap: wrap; }
        .ov-role { margin-left: 0; }
        .ov-foot { display: none; }
    }

    @keyframes ovSlide { from { opacity: 0; transform: translateX(-16px); } to { opacity: 1; transform: none; } }
    @keyframes ovWipe { from { opacity: 0; clip-path: inset(0 100% 0 0); transform: scale(.96); } to { opacity: 1; clip-path: inset(0 0 0 0); transform: none; } }
    @keyframes ovFade { to { opacity: 1; } }
    @keyframes ovBlink { 50% { opacity: .25; } }
    @keyframes ovGrow { to { width: 18px; } }
    @media (prefers-reduced-motion: reduce) {
        .ov-h1, .ov-h2, .ov-h3, .ov-logo { animation-duration: .01s; animation-delay: 0s; }
        .ov, .ov-text { transition-duration: .01s; }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const page = document.getElementById('pageWrapper');
        const overlay = document.getElementById('loginCompletionOverlay');
        const headline = document.getElementById('logoutHeadline');
        const headlineText = 'SESSION TERMINATION';
        const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        const typewriter = () => {
            if (!headline) return;
            if (reduce) { headline.textContent = headlineText; return; }

            let i = 0;
            headline.classList.add('is-typing');
            const tick = () => {
                headline.textContent = headlineText.slice(0, ++i);
                if (i < headlineText.length) {
                    setTimeout(tick, 70);
                } else {
                    headline.classList.remove('is-typing');
                }
            };
            tick();
        };

        const revealPage = () => {
            if (!page) return;
            requestAnimationFrame(() => page.classList.add('is-in'));
            setTimeout(typewriter, 450);
        };

        const runOverlaySequence = async () => {
            if (!overlay) { revealPage(); return; }

            const nameEl = overlay.querySelector('[data-overlay-name]');
            const statusEl = overlay.querySelector('[data-overlay-status]');
            const dotEl = overlay.querySelector('[data-overlay-dot]');
            const barEl = overlay.querySelector('[data-overlay-progress]');
            const name = (overlay.dataset.name || '').toUpperCase();

            const wait = (ms) => new Promise((r) => setTimeout(r, reduce ? ms * 0.3 : ms));
            const setProgress = (p) => { if (barEl) barEl.style.transform = `scaleX(${p})`; };
            const setStatus = (t) => { if (statusEl) statusEl.textContent = t; };

            setProgress(0.15);
            await wait(1100);

            overlay.classList.add('is-id');
            setStatus('ID CONFIRMED');
            setProgress(0.45);
            await wait(750);

            for (let k = 1; k <= name.length; k++) {
                if (nameEl) nameEl.textContent = name.slice(0, k);
                setProgress(0.45 + 0.4 * (k / name.length));
                await wait(65);
            }

            overlay.classList.add('is-done');
            setStatus('ACCESS GRANTED');
            dotEl?.classList.add('is-done');
            barEl?.classList.add('is-done');
            setProgress(1);
            await wait(1100);

            overlay.classList.add('is-out');
            setTimeout(revealPage, 350);
            setTimeout(() => overlay.remove(), 1100);
        };

        runOverlaySequence();
    });
</script>
@endsection