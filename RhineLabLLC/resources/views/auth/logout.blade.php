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
     HALAMAN TERMINASI SESI
     ============================================== --}}
<div id="pageWrapper" class="st-page">
    <div class="st-bg" aria-hidden="true"></div>

    {{-- Bar atas --}}
    <header class="st-top">
        <div class="st-brand rv" style="--d:.1s">
            <span class="st-brand-1">RHINE LAB</span>
            <span class="st-brand-2">SYNTHESIZE INFORMATION</span>
            <span class="st-brand-3">ANALYSIS <b>OS</b></span>
        </div>
        <div class="st-live rv" style="--d:.2s">
            <i class="st-live-dot"></i>Sesi aktif
        </div>
    </header>

    {{-- Kartu utama --}}
    <main class="st-main">
        <section class="st-card rv" style="--d:.25s" aria-labelledby="logoutHeadline">

            <div class="st-card-head">
                <span class="st-badge">Operative termination node</span>
                <h2 id="logoutHeadline" class="st-title" aria-label="Session Termination"></h2>
                <p class="st-sub">Konfirmasi untuk mengakhiri sesi kerja operatif.</p>
            </div>

            <div class="st-body">
                {{-- Profil --}}
                <div class="st-profile rv" style="--d:.4s">
                    <div class="st-avatar">
                        <img src="{{ asset($user?->photo_path ?? 'images/users/Silence.png') }}"
                             alt="Foto {{ $user?->name }}" width="144" height="144" loading="eager" decoding="async">
                        <span class="st-avatar-id">USR-{{ str_pad($user?->id ?? '001', 3, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <div class="st-who">
                        <p class="st-role">{{ $roleLabel }}</p>
                        <p class="st-name">{{ $user?->name }}</p>
                        <p class="st-pos">{{ $user?->position ?? 'Researcher' }}</p>
                    </div>
                </div>

                {{-- Info + aksi --}}
                <div class="st-side">
                    <dl class="st-info rv" style="--d:.5s">
                        <div class="st-row">
                            <div>
                                <dt>Organisasi</dt>
                                <dd>{{ $orgName }}</dd>
                            </div>
                            <img src="{{ asset($orgLogo) }}" alt="Logo organisasi" class="st-logo" loading="lazy" decoding="async">
                        </div>
                        <div class="st-row">
                            <div>
                                <dt>Divisi</dt>
                                <dd>{{ $divName }}</dd>
                                <dd class="st-code">{{ $divCode }}</dd>
                            </div>
                            @if (!empty($selectedDivision?->photo_path))
                                <img src="{{ asset($selectedDivision->photo_path) }}" alt="Logo divisi" class="st-logo" loading="lazy" decoding="async">
                            @endif
                        </div>
                    </dl>

                    <form action="{{ route('logout') }}" method="post" class="st-actions rv" style="--d:.6s">
                        @csrf
                        <button type="submit" class="st-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Akhiri sesi
                        </button>

                        <nav class="st-links" aria-label="Pintasan">
                            <a href="{{ route('admin.dashboard') }}" class="st-link st-link--accent">Pusat Admin</a>
                            <a href="{{ route('research-records.index') }}" class="st-link">Catatan Riset</a>
                            <a href="{{ route('research.ledger') }}" class="st-link">Direktori</a>
                        </nav>
                    </form>
                </div>
            </div>
        </section>
    </main>

    {{-- Footer --}}
    <footer class="st-foot rv" style="--d:.7s">
        <span>RHINE OS v3.2.0 · Restricted access</span>
        <span>POWERED BY <b>RHINE LAB</b></span>
    </footer>
</div>

<noscript><style>.rv{opacity:1!important;transform:none!important}</style></noscript>

<style>
    :root {
        --st-bg: #ECE8E5;
        --st-ink: #1c1c1c;
        --st-mute: #7a766f;
        --st-line: rgba(28, 28, 28, .09);
        --st-accent: #EA7645;
        --st-ok: #48AA8C;
    }

    .hex-bg {
        background-image: url("data:image/svg+xml,%3Csvg width='40' height='69.282' viewBox='0 0 40 69.282' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M40 11.547L20 0 0 11.547v23.094l20 11.547 20-11.547V11.547zM20 45.034L1.155 34.148V12.376L20 1.49l18.845 10.886v21.772L20 45.034z' fill='%23000000' fill-opacity='0.04' fill-rule='evenodd'/%3E%3Cpath d='M40 46.188L20 34.641 0 46.188v23.094l20 11.547 20-11.547V46.188zM20 79.675L1.155 68.789V47.017L20 36.13l18.845 10.886v21.772L20 79.675z' fill='%23000000' fill-opacity='0.04' fill-rule='evenodd'/%3E%3C/svg%3E");
        background-size: 60px 103.923px;
    }

    /* =========================================
       HALAMAN UTAMA
       ========================================= */
    .st-page {
        position: relative; min-height: 100vh; min-height: 100dvh;
        display: flex; flex-direction: column;
        padding: clamp(16px, 3vw, 32px);
        padding-bottom: max(clamp(16px, 3vw, 32px), env(safe-area-inset-bottom));
        color: var(--st-ink); background: var(--st-bg);
        font-family: "Helvetica Neue", Helvetica, Arial, ui-sans-serif, system-ui, sans-serif;
        overflow-x: hidden; -webkit-font-smoothing: antialiased;
    }

    /* Latar statis: gradient murah, tanpa blur layer besar */
    .st-bg {
        position: fixed; inset: 0; z-index: 0; pointer-events: none;
        background:
            radial-gradient(60rem 40rem at 0% 0%, rgba(255, 255, 255, .85), transparent 60%),
            radial-gradient(40rem 32rem at 100% 100%, rgba(234, 118, 69, .14), transparent 62%),
            var(--st-bg);
    }
    .st-bg::after {
        content: ""; position: absolute; inset: 0; opacity: .7;
        background-image: url("data:image/svg+xml,%3Csvg width='40' height='69.282' viewBox='0 0 40 69.282' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M40 11.547L20 0 0 11.547v23.094l20 11.547 20-11.547V11.547zM20 45.034L1.155 34.148V12.376L20 1.49l18.845 10.886v21.772L20 45.034z' fill='%23000000' fill-opacity='0.035' fill-rule='evenodd'/%3E%3C/svg%3E");
        background-size: 60px 103.923px;
        -webkit-mask-image: radial-gradient(ellipse at center, #000 20%, transparent 75%);
                mask-image: radial-gradient(ellipse at center, #000 20%, transparent 75%);
    }

    /* Reveal: satu urutan masuk, murni CSS */
    .rv { opacity: 0; transform: translateY(8px); transition: opacity .6s ease var(--d, 0s), transform .6s cubic-bezier(.16, 1, .3, 1) var(--d, 0s); }
    .st-page.is-in .rv { opacity: 1; transform: none; }

    /* Bar atas */
    .st-top { position: relative; z-index: 2; display: flex; align-items: flex-start; justify-content: space-between; gap: 16px; }
    .st-brand { display: flex; flex-direction: column; width: max-content; line-height: 1; }
    .st-brand-1 { font-size: 22px; font-weight: 800; letter-spacing: .01em; }
    .st-brand-2 { margin-top: 3px; font-size: 7.5px; font-weight: 500; letter-spacing: .02em; text-align-last: justify; }
    .st-brand-3 { display: flex; justify-content: space-between; margin-top: 3px; font-size: 16px; letter-spacing: .02em; }
    .st-brand-3 b { font-weight: 800; color: var(--st-accent); }
    .st-live { display: inline-flex; align-items: center; gap: 8px; padding-top: 4px; font-size: 11px; font-weight: 600; letter-spacing: .08em; color: var(--st-mute); }
    .st-live-dot { width: 7px; height: 7px; border-radius: 50%; background: var(--st-ok); box-shadow: 0 0 0 0 rgba(72, 170, 140, .5); animation: stPulse 2.4s ease-out infinite; }

    /* Layout tengah */
    .st-main { position: relative; z-index: 2; flex: 1; display: flex; align-items: center; justify-content: center; padding: clamp(20px, 4vh, 40px) 0; }

    /* Kartu: satu-satunya layer backdrop-filter di halaman */
    .st-card {
        position: relative; width: 100%; max-width: 760px;
        padding: clamp(22px, 4vw, 40px); border-radius: 28px;
        background: linear-gradient(145deg, rgba(255, 255, 255, .62), rgba(255, 255, 255, .28));
        border: 1px solid rgba(255, 255, 255, .85);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, .95), 0 24px 48px -24px rgba(0, 0, 0, .12);
        -webkit-backdrop-filter: blur(18px) saturate(1.15);
                backdrop-filter: blur(18px) saturate(1.15);
    }
    /* kilau tipis ala liquid glass, statis */
    .st-card::before {
        content: ""; position: absolute; inset: 0; border-radius: inherit; pointer-events: none;
        background: linear-gradient(115deg, rgba(255, 255, 255, .5) 0%, rgba(255, 255, 255, 0) 38%);
    }
    @supports not ((backdrop-filter: blur(1px)) or (-webkit-backdrop-filter: blur(1px))) {
        .st-card { background: rgba(250, 248, 246, .92); }
    }

    .st-card-head { position: relative; display: flex; flex-direction: column; align-items: center; text-align: center; gap: 10px; padding-bottom: 24px; border-bottom: 1px solid var(--st-line); }
    .st-badge { display: inline-flex; align-items: center; gap: 8px; padding: 5px 12px; border-radius: 999px; border: 1px solid rgba(234, 118, 69, .35); background: rgba(234, 118, 69, .08); color: var(--st-accent); font-size: 10px; font-weight: 700; letter-spacing: .18em; text-transform: uppercase; }
    .st-badge::before { content: ""; width: 5px; height: 5px; border-radius: 50%; background: var(--st-accent); }
    .st-title { min-height: 1.2em; margin: 0; font-size: clamp(22px, 5.4vw, 38px); font-weight: 800; letter-spacing: .14em; line-height: 1.2; }
    .st-title.is-typing::after { content: ""; display: inline-block; width: 2px; height: .9em; margin-left: 4px; vertical-align: -.08em; background: var(--st-accent); animation: stBlink .8s steps(2, jump-none) infinite; }
    .st-sub { margin: 0; font-size: 13px; color: var(--st-mute); }

    .st-body { position: relative; display: grid; gap: 24px; margin-top: 24px; grid-template-columns: 1fr; }
    @media (min-width: 760px) { .st-body { grid-template-columns: 200px 1fr; gap: 32px; align-items: start; } }

    /* Profil */
    .st-profile { display: flex; flex-direction: column; align-items: center; gap: 14px; }
    .st-avatar { position: relative; width: 144px; height: 144px; padding: 5px; border-radius: 28px; background: rgba(255, 255, 255, .6); border: 1px solid rgba(255, 255, 255, .9); box-shadow: 0 12px 24px -14px rgba(0, 0, 0, .2); }
    @media (min-width: 760px) { .st-avatar { width: 168px; height: 168px; } }
    .st-avatar img { display: block; width: 100%; height: 100%; object-fit: cover; border-radius: 23px; }
    .st-avatar-id { position: absolute; left: 12px; right: 12px; bottom: 12px; padding: 3px 0; border-radius: 8px; text-align: center; font: 700 9px/1.4 ui-monospace, SFMono-Regular, Menlo, Consolas, monospace; letter-spacing: .2em; color: #fff; background: rgba(0, 0, 0, .45); }
    .st-who { text-align: center; }
    .st-role { margin: 0; font-size: 10px; font-weight: 700; letter-spacing: .22em; text-transform: uppercase; color: var(--st-accent); }
    .st-name { margin: 4px 0 0; font-size: 18px; font-weight: 800; line-height: 1.25; }
    .st-pos { margin: 2px 0 0; font-size: 12px; color: var(--st-mute); }

    /* Info: satu panel, dua baris, tanpa blur tambahan */
    .st-info { margin: 0; border-radius: 18px; background: rgba(255, 255, 255, .5); border: 1px solid rgba(255, 255, 255, .85); }
    .st-row { display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 14px 18px; }
    .st-row + .st-row { border-top: 1px solid var(--st-line); }
    .st-row dt { font-size: 10px; font-weight: 700; letter-spacing: .2em; text-transform: uppercase; color: var(--st-mute); }
    .st-row dd { margin: 4px 0 0; font-size: 14px; font-weight: 700; letter-spacing: .02em; text-transform: uppercase; }
    .st-row dd.st-code { margin-top: 2px; font: 600 10px/1.4 ui-monospace, SFMono-Regular, Menlo, Consolas, monospace; letter-spacing: .2em; color: var(--st-accent); }
    .st-logo { flex: none; width: 36px; height: 36px; object-fit: contain; filter: grayscale(1); opacity: .75; }

    /* Aksi */
    .st-actions { display: flex; flex-direction: column; gap: 12px; margin: 16px 0 0; }
    .st-btn {
        display: inline-flex; align-items: center; justify-content: center; gap: 10px; width: 100%;
        padding: 14px 24px; border: 1px solid var(--st-ink); border-radius: 999px; cursor: pointer;
        font: 700 12px/1 inherit; letter-spacing: .22em; text-transform: uppercase; color: #fff; background: var(--st-ink);
        transition: background-color .2s ease, border-color .2s ease, transform .2s ease;
    }
    .st-btn:hover { background: var(--st-accent); border-color: var(--st-accent); }
    .st-btn:active { transform: scale(.98); }
    .st-links { display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px; }
    .st-link {
        display: flex; align-items: center; justify-content: center; min-height: 42px; padding: 8px 6px; border-radius: 999px;
        font-size: 11px; font-weight: 600; letter-spacing: .06em; text-align: center; text-decoration: none; color: var(--st-ink);
        background: rgba(255, 255, 255, .5); border: 1px solid rgba(255, 255, 255, .9);
        transition: color .2s ease, border-color .2s ease, background-color .2s ease;
    }
    .st-link:hover { color: var(--st-ok); border-color: var(--st-ok); background: rgba(255, 255, 255, .85); }
    .st-link--accent { color: var(--st-accent); border-color: rgba(234, 118, 69, .35); }
    .st-link--accent:hover { color: var(--st-accent); border-color: var(--st-accent); }
    .st-btn:focus-visible, .st-link:focus-visible { outline: 2px solid var(--st-accent); outline-offset: 3px; }

    /* Footer */
    .st-foot { position: relative; z-index: 2; display: flex; justify-content: space-between; gap: 12px; flex-wrap: wrap; font-size: 10px; letter-spacing: .08em; color: var(--st-mute); }
    .st-foot b { font-weight: 800; color: var(--st-ink); }

    @media (max-width: 480px) {
        .st-card { border-radius: 24px; -webkit-backdrop-filter: blur(10px); backdrop-filter: blur(10px); }
        .st-links { grid-template-columns: 1fr; }
        .st-foot { justify-content: center; text-align: center; }
        .st-bg::after { display: none; }
    }

    @keyframes stPulse { 0% { box-shadow: 0 0 0 0 rgba(72, 170, 140, .5); } 70%, 100% { box-shadow: 0 0 0 7px rgba(72, 170, 140, 0); } }
    @keyframes stBlink { 50% { opacity: .2; } }

    @media (prefers-reduced-motion: reduce) {
        .rv { transition-duration: .01s; transition-delay: 0s; transform: none; }
        .st-live-dot, .st-title.is-typing::after { animation: none; }
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