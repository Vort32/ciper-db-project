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

    // Pengecekan Akun Admin
    $canAdmin = (bool) (
        $user && (
            $user->email === 'admin@rhine-lab.com'
            || str_contains(strtolower($user->position ?? ''), 'admin')
            || ($user->is_admin ?? false)
            || (($user->role ?? null) === 'admin')
        )
    );
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
     HALAMAN TERMINASI SESI (Liquid Glass RHINE OS)
     ============================================== --}}
<div id="pageWrapper" class="en-page">
    <div class="en-bg" aria-hidden="true"></div>

    {{-- ===== KIRI / ATAS: PORTRAIT OPERATIF ===== --}}
    <aside class="en-stage rv" style="--d:.05s" aria-label="Profil operatif">
        <div class="en-photo">
            <img src="{{ asset($user?->photo_path ?? 'images/users/Silence.png') }}"
                 alt="Foto {{ $user?->name }}" decoding="async">
        </div>

        {{-- Bar atas khusus mobile (di desktop disembunyikan, brand pindah ke panel kanan) --}}
        <div class="en-mtop">
            <div class="en-brand">
                <span class="en-brand-1">RHINE LAB</span>
                <span class="en-brand-2">SYNTHESIZE INFORMATION</span>
                <span class="en-brand-3">ANALYSIS <b>OS</b></span>
            </div>
            <div class="en-live"><i></i>Sesi aktif</div>
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

    {{-- ===== KANAN / BAWAH: PANEL DATA ===== --}}
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

            <p class="en-tag">Operative termination node</p>
            <h1 id="logoutHeadline" class="en-title" aria-label="Session Termination"></h1>
            <div class="en-rule" aria-hidden="true"><i></i></div>
            <p class="en-sub">Konfirmasi otorisasi untuk mengakhiri sesi kerja operatif.</p>

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
                        @else
                            <span class="en-logo en-logo--ph" aria-hidden="true">{{ strtoupper(substr($divCode, 0, 2)) }}</span>
                        @endif
                    </dd>
                </div>
                <div class="en-row">
                    <dt>Status</dt>
                    <dd>
                        <span>Menunggu otorisasi<small>Akses akan dicabut setelah konfirmasi</small></span>
                        <i class="en-state" aria-hidden="true"></i>
                    </dd>
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
                    @if ($canAdmin)
                        <a href="{{ route('admin.dashboard') }}" class="en-link en-link--accent font-extrabold">Pusat Admin</a>
                    @endif
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

    .en-page {
        position: relative; min-height: 100vh; min-height: 100dvh;
        display: flex; flex-direction: column;
        color: var(--en-ink); background: var(--en-bg); overflow-x: hidden;
        font-family: "Helvetica Neue", Helvetica, Arial, ui-sans-serif, system-ui, sans-serif;
        -webkit-font-smoothing: antialiased;
    }

    .en-bg {
        position: fixed; inset: 0; z-index: 0; pointer-events: none;
        background:
            radial-gradient(26rem 26rem at 78% 28%, rgba(234, 118, 69, .30), transparent 66%),
            radial-gradient(24rem 24rem at 58% 88%, rgba(72, 170, 140, .26), transparent 66%),
            radial-gradient(22rem 22rem at 96% 64%, rgba(255, 255, 255, .95), transparent 62%),
            radial-gradient(50rem 36rem at 100% 0%, rgba(255, 255, 255, .8), transparent 60%),
            var(--en-bg);
    }

    .rv { opacity: 0; transform: translateY(8px); transition: opacity .6s ease var(--d, 0s), transform .6s cubic-bezier(.16, 1, .3, 1) var(--d, 0s); }
    .en-page.is-in .rv { opacity: 1; transform: none; }

    /* ---------- Portrait Stage (mobile-first) ---------- */
    .en-stage { position: relative; z-index: 1; height: 52vh; height: 52dvh; min-height: 340px; max-height: 470px; }
    .en-photo { position: absolute; inset: 0; clip-path: polygon(0 0, 100% 0, 100% 88%, 0 100%); background: #d9d4cf; }
    .en-photo img { display: block; width: 100%; height: 100%; object-fit: cover; object-position: center 12%; }
    .en-photo::before { content: ""; position: absolute; inset: 0; z-index: 1; background: linear-gradient(to bottom, rgba(20, 20, 20, .5), rgba(20, 20, 20, 0) 34%); }
    .en-photo::after { content: ""; position: absolute; inset: 0; background: linear-gradient(to top, rgba(20, 20, 20, .8), rgba(20, 20, 20, 0) 58%); }

    /* Bar atas mobile: brand + status sesi di atas foto */
    .en-mtop { position: absolute; z-index: 3; top: 16px; left: 18px; right: 18px; display: flex; align-items: flex-start; justify-content: space-between; gap: 12px; color: #fff; }
    .en-mtop .en-brand-3 b { color: var(--en-accent); }
    .en-mtop .en-live {
        padding: 6px 12px; border-radius: 999px; color: #fff; font-size: 10px;
        background: rgba(255, 255, 255, .16); border: 1px solid rgba(255, 255, 255, .5);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, .45);
        -webkit-backdrop-filter: blur(8px); backdrop-filter: blur(8px);
    }

    .en-ghost {
        position: absolute; right: 14px; top: 76px; z-index: 1; pointer-events: none; user-select: none;
        font-size: clamp(22px, 7vw, 30px); font-weight: 900; letter-spacing: .1em; line-height: 1;
        color: transparent; -webkit-text-stroke: 1px rgba(255, 255, 255, .6);
        writing-mode: vertical-rl;
    }

    .en-cross { position: absolute; z-index: 2; width: 14px; height: 14px; pointer-events: none; display: none; }
    .en-cross::before, .en-cross::after { content: ""; position: absolute; background: #fff; }
    .en-cross::before { left: 6px; top: 0; width: 2px; height: 14px; }
    .en-cross::after { left: 0; top: 6px; width: 14px; height: 2px; }
    .en-cross--a { left: 16px; top: 16px; }
    .en-cross--b { right: 16px; top: 16px; }

    .en-caption { position: absolute; z-index: 2; left: 20px; right: 64px; bottom: 58px; color: #fff; }
    .en-id { display: inline-block; padding: 4px 12px; margin-bottom: 10px; border-radius: 999px; font: 700 10px/1.4 var(--en-mono); letter-spacing: .22em; color: #fff; background: rgba(255, 255, 255, .2); border: 1px solid rgba(255, 255, 255, .55); box-shadow: inset 0 1px 0 rgba(255, 255, 255, .5); }
    .en-role { margin: 0; font-size: 10px; font-weight: 700; letter-spacing: .24em; text-transform: uppercase; color: var(--en-accent); }
    .en-name { margin: 4px 0 0; font-size: clamp(22px, 6.6vw, 30px); font-weight: 800; line-height: 1.12; text-wrap: balance; }
    .en-pos { margin: 6px 0 0; font-size: 12px; opacity: .85; }

    /* ---------- Side Panel ---------- */
    .en-side { position: relative; z-index: 2; flex: 1; display: flex; flex-direction: column; gap: 18px; padding: 0 14px calc(16px + env(safe-area-inset-bottom, 0px)); margin-top: -40px; }
    .en-top { display: none; }
    .en-brand { display: flex; flex-direction: column; width: max-content; line-height: 1; }
    .en-brand-1 { font-size: 22px; font-weight: 800; letter-spacing: .01em; }
    .en-brand-2 { margin-top: 3px; font-size: 7.5px; font-weight: 500; letter-spacing: .02em; text-align-last: justify; }
    .en-brand-3 { display: flex; justify-content: space-between; margin-top: 3px; font-size: 16px; letter-spacing: .02em; }
    .en-brand-3 b { font-weight: 800; color: var(--en-accent); }
    .en-live { display: inline-flex; align-items: center; gap: 8px; font-size: 11px; font-weight: 600; letter-spacing: .08em; color: var(--en-mute); }
    .en-live i { width: 7px; height: 7px; border-radius: 50%; background: var(--en-ok); animation: enPulse 2.4s ease-out infinite; }

    /* Liquid Glass Card */
    .en-panel {
        position: relative; isolation: isolate; padding: 22px 18px 20px; border-radius: 28px;
        background: linear-gradient(135deg, rgba(255, 255, 255, .62), rgba(255, 255, 255, .2) 55%, rgba(255, 255, 255, .4));
        border: 1px solid rgba(255, 255, 255, .8);
        box-shadow:
            inset 0 1.5px 0 rgba(255, 255, 255, .95),
            inset 1px 0 0 rgba(255, 255, 255, .55),
            inset 0 -1px 0 rgba(255, 255, 255, .35),
            inset 0 -18px 28px -18px rgba(234, 118, 69, .14),
            0 28px 56px -24px rgba(70, 45, 30, .30);
        -webkit-backdrop-filter: blur(12px) saturate(1.5);
                backdrop-filter: blur(12px) saturate(1.5);
    }

    .en-tag { margin: 0; font: 700 10px/1.4 var(--en-mono); letter-spacing: .24em; text-transform: uppercase; color: var(--en-accent); }
    .en-title { min-height: 2.2em; margin: 10px 0 0; font-size: clamp(26px, 8vw, 44px); font-weight: 900; letter-spacing: .06em; line-height: 1.1; overflow-wrap: anywhere; }
    .en-title.is-typing::after { content: ""; display: inline-block; width: 3px; height: .85em; margin-left: 6px; vertical-align: -.05em; background: var(--en-accent); animation: enBlink .8s steps(2, jump-none) infinite; }
    .en-rule { position: relative; height: 1px; margin: 16px 0 12px; background: var(--en-line); }
    .en-rule i { position: absolute; left: 0; top: -1px; width: 56px; height: 3px; background: var(--en-accent); }
    .en-sub { margin: 0; font-size: 13px; line-height: 1.5; color: var(--en-mute); }

    .en-data { margin: 18px 0 0; padding: 0 14px; border-radius: 20px; background: rgba(255, 255, 255, .4); border: 1px solid rgba(255, 255, 255, .8); box-shadow: inset 0 1px 0 rgba(255, 255, 255, .9), 0 8px 18px -14px rgba(70, 45, 30, .25); }
    .en-row { display: flex; flex-direction: column; gap: 6px; padding: 13px 0; border-bottom: 1px solid var(--en-line); }
    .en-row:last-child { border-bottom: 0; }
    .en-row dt { font: 700 10px/1.4 var(--en-mono); letter-spacing: .2em; text-transform: uppercase; color: var(--en-mute); }
    .en-row dd { display: flex; align-items: center; justify-content: space-between; gap: 12px; margin: 0; font-size: 14px; font-weight: 700; letter-spacing: .02em; text-transform: uppercase; }
    .en-row dd small { display: block; margin-top: 2px; font: 600 10px/1.4 var(--en-mono); letter-spacing: .14em; text-transform: none; color: var(--en-accent); }
    .en-logo { flex: none; width: 34px; height: 34px; object-fit: contain; filter: grayscale(1); opacity: .75; }
    .en-logo--ph, .en-state { display: none; }

    .en-actions { display: flex; flex-direction: column; gap: 14px; margin: 20px 0 0; }
    .en-btn {
        display: flex; align-items: center; width: 100%; padding: 6px; border: 1px solid rgba(255, 255, 255, .22); border-radius: 999px; cursor: pointer; color: #fff;
        background: linear-gradient(180deg, #3b3b3b, #1c1c1c);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, .28), inset 0 -8px 14px -10px rgba(234, 118, 69, .45), 0 14px 24px -12px rgba(0, 0, 0, .55);
        transition: transform .2s ease, box-shadow .2s ease;
    }
    .en-btn-label { flex: 1; padding: 0 20px; text-align: left; font-size: 12px; font-weight: 700; letter-spacing: .26em; text-transform: uppercase; }
    .en-btn-icon { display: flex; align-items: center; justify-content: center; width: 44px; height: 44px; border-radius: 50%; background: linear-gradient(160deg, #f08a5b, #d66031); box-shadow: inset 0 1px 0 rgba(255, 255, 255, .55), 0 4px 10px -4px rgba(234, 118, 69, .7); }
    .en-btn:hover { box-shadow: inset 0 1px 0 rgba(255, 255, 255, .32), inset 0 -8px 14px -10px rgba(234, 118, 69, .7), 0 16px 28px -12px rgba(234, 118, 69, .5); }
    .en-btn:active { transform: scale(.985); }
    .en-btn:focus-visible, .en-link:focus-visible { outline: 2px solid var(--en-accent); outline-offset: 3px; }
    .en-links { display: flex; flex-wrap: wrap; gap: 8px; }
    .en-link {
        padding: 9px 16px; border-radius: 999px; font-size: 12px; font-weight: 600; letter-spacing: .05em; text-decoration: none; color: var(--en-ink);
        background: rgba(255, 255, 255, .45); border: 1px solid rgba(255, 255, 255, .85);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, .9), 0 6px 14px -10px rgba(70, 45, 30, .3);
        transition: color .2s ease, background-color .2s ease, border-color .2s ease;
    }
    .en-link:hover { color: var(--en-ok); background: rgba(255, 255, 255, .7); border-color: var(--en-ok); }
    .en-link--accent { color: var(--en-accent); border-color: rgba(234, 118, 69, .4); }
    .en-link--accent:hover { color: var(--en-accent); border-color: var(--en-accent); }

    .en-foot { display: flex; justify-content: space-between; flex-wrap: wrap; gap: 8px 12px; margin-top: auto; padding: 0 4px; font: 500 10px/1.4 var(--en-mono); letter-spacing: .08em; color: var(--en-mute); }
    .en-foot b { font-weight: 800; color: var(--en-ink); }

    /* ---------- MOBILE & TABLET: baris data berbentuk "kartu kecil" ---------- */
    @media (max-width: 899.98px) {
        .en-row {
            display: grid;
            grid-template-columns: 44px minmax(0, 1fr);
            column-gap: 14px;
            row-gap: 3px;
            align-items: center;
            padding: 12px 0;
        }
        .en-row dt { grid-column: 2; grid-row: 1; }
        .en-row dd { display: contents; }
        .en-row dd > span:first-child { grid-column: 2; grid-row: 2; min-width: 0; line-height: 1.3; }
        .en-row dd > .en-logo,
        .en-row dd > .en-state { grid-column: 1; grid-row: 1 / span 2; }

        .en-logo, .en-logo--ph, .en-state {
            box-sizing: border-box; width: 44px; height: 44px; padding: 8px; border-radius: 14px;
            background: rgba(255, 255, 255, .7); border: 1px solid rgba(255, 255, 255, .95);
            box-shadow: inset 0 1px 0 #fff, 0 6px 12px -8px rgba(70, 45, 30, .3);
        }
        .en-logo--ph { display: grid; place-items: center; font: 800 12px/1 var(--en-mono); letter-spacing: .04em; color: var(--en-mute); }
        .en-state { display: grid; place-items: center; }
        .en-state::before { content: ""; width: 10px; height: 10px; border-radius: 50%; background: var(--en-accent); animation: enPulseAccent 2.4s ease-out infinite; }

        .en-links { display: grid; grid-template-columns: repeat(auto-fit, minmax(104px, 1fr)); }
        .en-link { text-align: center; padding: 11px 8px; }
    }

    /* Layar sangat kecil */
    @media (max-width: 360px) {
        .en-caption { right: 52px; }
        .en-panel { padding: 20px 14px 18px; }
        .en-data { padding: 0 12px; }
        .en-btn-label { padding: 0 14px; letter-spacing: .2em; }
    }

    /* ---------- DESKTOP ---------- */
    @media (min-width: 900px) {
        .en-page { display: grid; grid-template-columns: minmax(340px, 5fr) 7fr; height: 100vh; height: 100dvh; overflow: hidden; }
        .en-stage { height: 100%; max-height: none; min-height: 0; }
        .en-photo { clip-path: polygon(0 0, 100% 0, calc(100% - 72px) 100%, 0 100%); }
        .en-photo img { object-position: center 20%; }
        .en-photo::before { display: none; }
        .en-mtop { display: none; }
        .en-ghost { right: 96px; top: 96px; font-size: clamp(64px, 8vw, 120px); letter-spacing: .06em; -webkit-text-stroke-color: rgba(255, 255, 255, .55); }
        .en-cross { display: block; }
        .en-cross--a { left: 28px; top: 28px; }
        .en-cross--b { display: none; }
        .en-caption { left: 40px; right: 96px; bottom: 56px; }
        .en-name { font-size: clamp(30px, 3.2vw, 44px); }

        .en-side { margin-top: 0; padding: 32px clamp(32px, 5vw, 80px) 28px 8px; gap: 0; justify-content: space-between; overflow-y: auto; }
        .en-top { display: flex; align-items: flex-start; justify-content: space-between; gap: 16px; }
        .en-panel { align-self: stretch; max-width: 640px; width: 100%; margin: auto 0; padding: 36px 36px 32px; border-radius: 32px; -webkit-backdrop-filter: blur(22px) saturate(1.6); backdrop-filter: blur(22px) saturate(1.6); }
        .en-title { min-height: 1.15em; }
        .en-data { padding: 0 24px; }
        .en-row { flex-direction: row; align-items: center; justify-content: space-between; gap: 24px; }
        .en-row dt { flex: none; width: 110px; }
        .en-row dd { flex: 1; }
        .en-foot { margin-top: 0; padding: 0; }
    }

    @keyframes enPulse { 0% { box-shadow: 0 0 0 0 rgba(72, 170, 140, .5); } 70%, 100% { box-shadow: 0 0 0 7px rgba(72, 170, 140, 0); } }
    @keyframes enPulseAccent { 0% { box-shadow: 0 0 0 0 rgba(234, 118, 69, .5); } 70%, 100% { box-shadow: 0 0 0 8px rgba(234, 118, 69, 0); } }
    @keyframes enBlink { 50% { opacity: .2; } }

    /* ==========================================================
       OVERLAY ID CONFIRMED
       ========================================================== */
    .ov { position: fixed; inset: 0; z-index: 9999; overflow: hidden; width: 100%; height: 100vh; height: 100dvh; background: #ECE8E5; color: #1c1c1c; font-family: "Helvetica Neue", Helvetica, Arial, ui-sans-serif, system-ui, sans-serif; clip-path: inset(0 0 0 0); transition: clip-path .9s cubic-bezier(.77, 0, .18, 1); }
    .ov.is-out { clip-path: inset(0 0 100% 0); }
    .ov-photo { position: absolute; inset: 0; background-size: cover; background-position: center; opacity: .06; }
    .ov-hex { position: absolute; inset: 0; opacity: .7; }
    .ov-head { position: absolute; top: clamp(24px, 6vh, 60px); left: clamp(20px, 5vw, 72px); display: flex; flex-direction: column; width: max-content; line-height: 1; }
    .ov-h1, .ov-h2, .ov-h3 { opacity: 0; animation: ovSlide .8s cubic-bezier(.16, 1, .3, 1) forwards; }
    .ov-h1 { font-size: clamp(22px, 2.2vw, 30px); font-weight: 800; letter-spacing: .01em; animation-delay: .15s; }
    .ov-h2 { font-size: clamp(7.5px, .68vw, 9.5px); font-weight: 500; letter-spacing: .02em; margin-top: 3px; text-align-last: justify; animation-delay: .3s; }
    .ov-h3 { display: flex; justify-content: space-between; gap: .6em; margin-top: 3px; font-size: clamp(17px, 1.7vw, 23px); font-weight: 400; letter-spacing: .02em; animation-delay: .45s; }
    .ov-h3 b { font-weight: 800; }
    .ov-stage { position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; padding: 0 24px; }
    .ov-logo { flex: none; width: clamp(150px, 18vw, 230px); animation: ovWipe 1.1s .45s cubic-bezier(.65, 0, .2, 1) both; }
    .ov-logo img { display: block; width: 100%; height: auto; }
    .ov-text { max-width: 0; opacity: 0; overflow: hidden; white-space: nowrap; padding-left: 0; transition: max-width 1s cubic-bezier(.65, 0, .2, 1), padding-left 1s cubic-bezier(.65, 0, .2, 1), opacity .5s .2s ease; }
    .ov.is-id .ov-text { max-width: min(640px, 70vw); opacity: 1; padding-left: clamp(28px, 4vw, 56px); }
    .ov-line { display: flex; align-items: center; gap: 10px; font-size: clamp(13px, 1.25vw, 16px); letter-spacing: .04em; }
    .ov-dash { width: 8px; height: 2px; background: #1c1c1c; flex: none; }
    .ov-label { color: #4a4743; }
    .ov-name { font-weight: 700; }
    .ov-caret { width: 2px; height: 1.15em; background: #EA7645; animation: ovBlink .8s steps(2, jump-none) infinite; transition: opacity .3s; }
    .ov.is-done .ov-caret { opacity: 0; animation: none; }
    .ov-role { margin: 8px 0 0 18px; font-size: 10px; letter-spacing: .32em; font-weight: 700; text-transform: uppercase; color: #7a766f; opacity: 0; transform: translateY(4px); transition: opacity .6s ease, transform .6s ease; }
    .ov.is-done .ov-role { opacity: 1; transform: none; }
    .ov-status { position: absolute; left: clamp(20px, 5vw, 72px); bottom: clamp(20px, 4vh, 40px); display: flex; align-items: center; gap: 10px; font-family: ui-monospace, SFMono-Regular, Menlo, Consolas, monospace; font-size: 9px; letter-spacing: .3em; font-weight: 700; color: #7a766f; opacity: 0; animation: ovFade .8s .9s ease forwards; }
    .ov-dot { width: 7px; height: 7px; background: #EA7645; transform: rotate(45deg); animation: ovBlink .7s steps(2, jump-none) infinite; transition: background .3s; }
    .ov-dot.is-done { background: #48AA8C; animation: none; box-shadow: 0 0 8px #48AA8C; }
    .ov-foot { position: absolute; right: clamp(20px, 5vw, 72px); bottom: clamp(20px, 4vh, 40px); display: flex; align-items: center; gap: 8px; font-size: 10px; letter-spacing: .03em; opacity: 0; animation: ovFade .8s 1s ease forwards; }
    .ov-foot b { font-weight: 800; }
    .ov-foot-dash { display: block; height: 4px; width: 0; background: #1c1c1c; animation: ovGrow .7s 1.4s cubic-bezier(.16, 1, .3, 1) forwards; }
    .ov-progress { position: absolute; left: 0; right: 0; bottom: 0; height: 2px; background: rgba(28, 28, 28, .08); }
    .ov-progress i { position: absolute; inset: 0; background: #1c1c1c; transform-origin: left; transform: scaleX(0); transition: transform .6s cubic-bezier(.16, 1, .3, 1), background .4s; }
    .ov-progress i.is-done { background: #48AA8C; }

    @keyframes ovSlide { from { opacity: 0; transform: translateX(-16px); } to { opacity: 1; transform: none; } }
    @keyframes ovWipe { from { opacity: 0; clip-path: inset(0 100% 0 0); transform: scale(.96); } to { opacity: 1; clip-path: inset(0 0 0 0); transform: none; } }
    @keyframes ovFade { to { opacity: 1; } }
    @keyframes ovBlink { 50% { opacity: .25; } }
    @keyframes ovGrow { to { width: 18px; } }

    /* Overlay: mobile sederhana (logo di atas, teks di bawah, rata tengah) */
    @media (max-width: 640px) {
        .ov-head { top: 20px; left: 20px; }

        .ov-stage { flex-direction: column; justify-content: center; padding: 0 20px; text-align: center; }
        .ov-logo { width: clamp(120px, 38vw, 170px); }

        .ov-text {
            width: 100%; max-width: 100%; max-height: 0; padding-left: 0; white-space: normal;
            transition: max-height .9s cubic-bezier(.65, 0, .2, 1), padding-top .9s cubic-bezier(.65, 0, .2, 1), opacity .5s .2s ease;
        }
        .ov.is-id .ov-text { max-width: 100%; max-height: 160px; padding-left: 0; padding-top: 28px; }

        .ov-line { flex-wrap: wrap; justify-content: center; gap: 4px 8px; font-size: 13px; line-height: 1.4; }
        .ov-dash { display: none; }
        .ov-name { flex-basis: 100%; font-size: 18px; letter-spacing: .06em; word-break: break-word; }
        .ov-caret { display: none; }

        .ov-role { margin: 10px 0 0; font-size: 9px; letter-spacing: .26em; }

        .ov-status { left: 20px; right: 20px; bottom: calc(46px + env(safe-area-inset-bottom, 0px)); justify-content: center; font-size: 8px; letter-spacing: .22em; }
        .ov-foot { left: 20px; right: 20px; bottom: calc(20px + env(safe-area-inset-bottom, 0px)); justify-content: center; font-size: 9px; }
    }

    @media (prefers-reduced-motion: reduce) {
        .ov-h1, .ov-h2, .ov-h3, .ov-logo, .ov-status, .ov-foot { animation-duration: .01s; animation-delay: 0s; }
        .ov, .ov-text, .ov-progress i { transition-duration: .01s; }
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