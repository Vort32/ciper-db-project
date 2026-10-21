@extends('layouts.app')

@section('title', 'Session Termination - RHINE LAB.LLC')

@section('content')
@php
    $showLoginOverlay = session()->has('status');
@endphp

{{-- OVERLAY VALIDASI KREDENSIAL --}}
@if ($user &&$showLoginOverlay)
    <div id="loginCompletionOverlay"
        class="fixed inset-0 z-50 flex items-center justify-center bg-[#ECE8E5]/80 backdrop-blur-md transition-opacity duration-700 opacity-0">
        <div class="login-overlay-card">
            <div class="login-overlay-meta">
                <span class="login-overlay-chip">
                    <span class="h-1.5 w-1.5 rounded-full bg-[#EA7645] animate-ping"></span>
                    Rhine Lab · Access Node
                </span>
                <span class="login-overlay-status font-bold" data-overlay-status>Memvalidasi kredensial...</span>
            </div>
            <div class="login-overlay-body">
                <div class="login-overlay-avatar relative group">
                    <img src="{{ asset($user->photo_path ?? 'images/users/Silence.png') }}" alt="Foto {{ $user->name }}"
                        class="h-full w-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                </div>
                <div class="login-overlay-text">
                    <span class="login-overlay-greeting">Selamat Datang</span>
                    <h3 class="login-overlay-name font-black">{{ $user->name }}</h3>
                    <span class="login-overlay-role font-semibold">{{ $user->position ?? ($user->is_division_head ? 'Kepala Divisi' : 'Operatif') }}</span>
                </div>
            </div>
            <div class="login-overlay-progress">
                <span class="login-overlay-progress-bar" data-overlay-progress></span>
            </div>
            <div class="flex justify-between items-center text-[9px] font-mono tracking-widest text-gray-500 uppercase">
                <span>SYSTEM SYNCING</span>
                <span class="login-overlay-progress-value" data-overlay-progress-value>0%</span>
            </div>
        </div>
    </div>
@endif

{{-- HALAMAN UTAMA TERMINASI SESI --}}
<div id="pageWrapper"
    class="min-h-screen flex flex-col items-center justify-center bg-[#ECE8E5] text-[#1c1c1c] relative overflow-hidden transition-opacity duration-700 opacity-0 select-none py-12 px-4">
    
    <!-- Ambient Glow & Watermark BG -->
    <div class="fixed w-[45rem] h-[45rem] bg-white/60 rounded-full blur-[130px] -top-20 -left-20 pointer-events-none z-0"></div>
    <div class="fixed w-[35rem] h-[35rem] bg-[#EA7645]/15 rounded-full blur-[100px] bottom-0 right-0 pointer-events-none z-0"></div>
    <div class="fixed inset-0 bg-cover bg-center opacity-5 pointer-events-none z-0"
        style="background-image: url('{{ asset('images/Rhine_Lab_HQ1.png') }}');"></div>

    <!-- Top Left HUD Header -->
    <div class="absolute top-6 left-6 leading-tight select-none space-y-1 z-20">
        <h1 class="text-2xl font-black tracking-wider pre-animate" data-animate="animate-slide-fade" style="animation-delay: 0.2s;">RHINE LAB</h1>
        <p class="text-[9px] tracking-[0.3em] uppercase font-bold text-gray-500 pre-animate" data-animate="animate-slide-fade" style="animation-delay: 0.4s;">
            SYNTHESIZE INFORMATION
        </p>
        <p class="text-xs sm:text-sm md:text-base font-semibold tracking-widest text-gray-700 pre-animate" data-animate="animate-slide-fade" style="animation-delay: 0.6s;">
            ANALYSIS <span class="font-black text-[#EA7645]">OS</span>
        </p>
    </div>

    <!-- Top Right Status HUD -->
    <div class="absolute top-6 right-6 z-20 flex items-center gap-3 text-[10px] sm:text-xs tracking-[0.35em] font-bold uppercase text-gray-700 select-none">
        <span class="pre-animate flex items-center gap-2" data-animate="animate-slide-fade" style="animation-delay: 0.8s;">
            <span class="h-2 w-2 rounded-full bg-[#48AA8C] animate-pulse"></span>
            SESSION ACTIVE
        </span>
    </div>

    <!-- CARD UTAMA (LIQUID GLASS) -->
    <div class="relative z-20 w-full max-w-4xl px-4 sm:px-6 my-auto">
        <div class="relative rounded-[32px] glass-card p-6 sm:p-10 opacity-0 pre-animate overflow-hidden"
            data-animate="animate-fade-up" style="animation-delay: 0.9s;">
            
            <div class="absolute inset-0 hex-bg opacity-20 pointer-events-none"></div>

            <!-- Header Card -->
            <div class="flex flex-col items-center text-center space-y-2 select-none relative z-10 border-b border-white/60 pb-6">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-[#EA7645]/40 bg-[#EA7645]/10 text-[9px] font-black uppercase tracking-[0.3em] text-[#EA7645]">
                    <span class="h-1.5 w-1.5 rounded-full bg-[#EA7645]"></span>
                    OPERATIVE TERMINATION NODE
                </div>
                <h2 id="logoutHeadline" class="text-2xl sm:text-4xl font-black tracking-[0.22em] text-[#1f1f1f] pre-animate min-h-[2.5rem] flex items-center justify-center"></h2>
                <p class="text-[10px] sm:text-xs uppercase tracking-[0.35em] text-gray-500 font-bold pre-animate"
                    data-animate="animate-slide-fade">Konfirmasi otorisasi untuk mengakhiri sesi kerja operatif</p>
            </div>

            <!-- Body Grid: Avatar & Info Status -->
            <div class="mt-8 grid gap-8 lg:grid-cols-[220px_1fr] relative z-10">
                
                <!-- Kiri: Profile HUD -->
                <div class="flex flex-col items-center gap-4 pre-animate" data-animate="animate-fade-up" style="animation-delay: 1.1s;">
                    <div class="glass-avatar relative h-44 w-44 overflow-hidden rounded-3xl p-1.5">
                        <div class="h-full w-full overflow-hidden rounded-[20px] relative">
                            <img src="{{ asset($user?->photo_path ?? 'images/users/Silence.png') }}" alt="Foto {{ $user?->name }}"
                                class="h-full w-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
                            <span class="absolute bottom-2 left-2 right-2 text-center text-[8px] font-black tracking-widest text-white/90 uppercase bg-black/40 backdrop-blur-sm py-1 rounded-md border border-white/20">
                                USR-{{ str_pad($user?->id ?? '001', 3, '0', STR_PAD_LEFT) }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="text-center space-y-1">
                        <p class="text-[9px] uppercase font-extrabold tracking-[0.35em] text-[#EA7645]">
                            {{ $user?->is_division_head ? 'Kepala Divisi' : 'Operatif Riset' }}
                        </p>
                        <p class="text-lg font-black tracking-wide text-[#1f1f1f] leading-snug">{{ $user?->name }}</p>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ $user?->position ?? 'RESEARCHER' }}</p>
                    </div>
                </div>

                <!-- Kanan: Status Organisasi & Tombol Aksi -->
                <div class="space-y-4">
                    
                    <!-- Panel Organisasi -->
                    <div class="glass-panel rounded-2xl px-5 py-4 pre-animate transition-transform duration-300 hover:scale-[1.01]" data-animate="animate-fade-up" style="animation-delay: 1.2s;">
                        <p class="text-[9px] font-black uppercase tracking-[0.35em] text-gray-500">Affiliation / Organisasi</p>
                        <div class="mt-2 flex items-center justify-between gap-4">
                            <div class="space-y-0.5">
                                <p class="text-sm font-black tracking-wider text-[#1f1f1f] uppercase">
                                    {{ $selectedOrganization['name'] ?? $user?->affiliation ?? 'RHINE LAB LLC' }}
                                </p>
                                <p class="text-[9px] font-bold uppercase tracking-widest text-gray-500">SEC-PRIMARY SECTOR</p>
                            </div>
                            @if (!empty($selectedOrganization['logo']))
                                <img src="{{ asset($selectedOrganization['logo']) }}" alt="Logo Organisasi" class="h-10 w-10 object-contain filter grayscale opacity-80">
                            @else
                                <img src="{{ asset('images/logo.png') }}" alt="Logo Rhine Lab" class="h-8 object-contain filter grayscale opacity-70">
                            @endif
                        </div>
                    </div>

                    <!-- Panel Divisi -->
                    <div class="glass-panel rounded-2xl px-5 py-4 pre-animate transition-transform duration-300 hover:scale-[1.01]" data-animate="animate-fade-up" style="animation-delay: 1.3s;">
                        <p class="text-[9px] font-black uppercase tracking-[0.35em] text-gray-500">Assigned Division</p>
                        <div class="mt-2 flex items-center justify-between">
                            <div class="space-y-0.5">
                                <p class="text-sm font-black tracking-wider text-[#1f1f1f] uppercase">
                                    {{ $selectedDivision?->name ?? ($user?->division?->name ?? 'RHINE RESEARCH SECTION') }}
                                </p>
                                <p class="text-[9px] font-extrabold uppercase tracking-[0.3em] text-[#EA7645]">
                                    CODE: {{ $selectedDivision?->code ?? ($user?->division?->code ?? 'SECTOR-01') }}
                                </p>
                            </div>
                            @if (!empty($selectedDivision?->photo_path))
                                <span class="flex h-11 w-11 items-center justify-center rounded-xl border border-white/80 bg-white/60 shadow-sm overflow-hidden">
                                    <img src="{{ asset($selectedDivision->photo_path) }}" alt="Logo Divisi" class="h-8 w-8 object-contain">
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Actions Form -->
                    <form action="{{ route('logout') }}" method="post" class="space-y-2.5 pt-2 pre-animate" data-animate="animate-fade-up" style="animation-delay: 1.45s;">
                        @csrf
                        <button type="submit"
                            class="glass-button glass-button--danger inline-flex w-full items-center justify-center gap-3 rounded-full py-3.5 px-6 text-xs font-black tracking-[0.3em] uppercase transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Log Out / Akhiri Sesi
                        </button>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                            <a href="{{ route('research-records.index') }}"
                                class="glass-link inline-flex w-full items-center justify-center rounded-full py-3 px-4 text-[10px] font-bold uppercase tracking-[0.25em] text-center transition-all duration-300">
                                Catatan Riset
                            </a>
                            <a href="{{ route('research.ledger') }}"
                                class="glass-link inline-flex w-full items-center justify-center rounded-full py-3 px-4 text-[10px] font-bold uppercase tracking-[0.25em] text-center transition-all duration-300">
                                Direktori Utama
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Footer HUD -->
    <div class="absolute bottom-4 right-6 text-[9px] sm:text-xs font-light tracking-widest text-gray-600 select-none z-20 pre-animate" data-animate="animate-fade-up" style="animation-delay: 1.6s;">
        POWERED BY <span class="font-black text-[#1c1c1c]">RHINE LAB</span>
    </div>
    <div class="absolute bottom-4 left-6 text-[9px] font-mono tracking-[0.3em] uppercase text-gray-500 select-none z-20 pre-animate" data-animate="animate-fade-up" style="animation-delay: 1.8s;">
        RHINE OS v3.2.0 · RESTRICTED ACCESS
    </div>
</div>

<style>
    .hex-bg {
        background-color: transparent;
        background-image: url("data:image/svg+xml,%3Csvg width='40' height='69.282' viewBox='0 0 40 69.282' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M40 11.547L20 0 0 11.547v23.094l20 11.547 20-11.547V11.547zM20 45.034L1.155 34.148V12.376L20 1.49l18.845 10.886v21.772L20 45.034z' fill='%23000000' fill-opacity='0.04' fill-rule='evenodd'/%3E%3Cpath d='M40 46.188L20 34.641 0 46.188v23.094l20 11.547 20-11.547V46.188zM20 79.675L1.155 68.789V47.017L20 36.13l18.845 10.886v21.772L20 79.675z' fill='%23000000' fill-opacity='0.04' fill-rule='evenodd'/%3E%3C/svg%3E");
        background-size: 60px 103.923px;
    }

    .login-overlay-card {
        position: relative;
        width: min(90%, 420px);
        padding: 1.75rem;
        border-radius: 28px;
        border: 1px solid rgba(255, 255, 255, 0.8);
        background: linear-gradient(145deg, rgba(255, 255, 255, 0.85), rgba(236, 232, 229, 0.75));
        box-shadow: inset 0 1px 1px rgba(255,255,255,0.9), 0 30px 60px -20px rgba(0,0,0,0.15);
        backdrop-filter: blur(24px);
        -webkit-backdrop-filter: blur(24px);
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
        transform: scale(0.94);
        opacity: 0;
        transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.6s ease;
    }

    .login-overlay-card.is-active {
        opacity: 1;
        transform: scale(1);
    }

    .login-overlay-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .login-overlay-chip {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.35rem 0.85rem;
        border-radius: 999px;
        border: 1px solid rgba(255, 255, 255, 0.9);
        background: rgba(255, 255, 255, 0.6);
        font-size: 0.62rem;
        letter-spacing: 0.25em;
        text-transform: uppercase;
        color: #333;
        font-weight: 800;
    }

    .login-overlay-status {
        font-size: 0.65rem;
        letter-spacing: 0.25em;
        text-transform: uppercase;
        color: #EA7645;
    }

    .login-overlay-body {
        display: flex;
        gap: 1rem;
        align-items: center;
    }

    .login-overlay-avatar {
        height: 80px;
        width: 80px;
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.9);
        background: rgba(255, 255, 255, 0.4);
        box-shadow: 0 12px 25px -10px rgba(0,0,0,0.15);
    }

    .login-overlay-text {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .login-overlay-greeting {
        font-size: 0.65rem;
        letter-spacing: 0.35em;
        text-transform: uppercase;
        color: #666;
        font-weight: 700;
    }

    .login-overlay-name {
        font-size: 1.15rem;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        color: #1f1f1f;
    }

    .login-overlay-role {
        font-size: 0.65rem;
        letter-spacing: 0.25em;
        text-transform: uppercase;
        color: #EA7645;
    }

    .login-overlay-progress {
        position: relative;
        height: 6px;
        border-radius: 999px;
        background: rgba(0, 0, 0, 0.08);
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.8);
    }

    .login-overlay-progress-bar {
        position: absolute;
        inset: 0;
        border-radius: inherit;
        background: linear-gradient(90deg, #EA7645, #48AA8C);
        transform-origin: left;
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    @keyframes fadeUp {
        0% { opacity: 0; transform: translateY(20px); }
        100% { opacity: 1; transform: translateY(0); }
    }

    .animate-fade-up { animation: fadeUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }

    @keyframes slideFade {
        0% { opacity: 0; transform: translateX(-20px); }
        100% { opacity: 1; transform: translateX(0); }
    }

    .animate-slide-fade { animation: slideFade 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }

    .glass-card {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.55), rgba(255, 255, 255, 0.25));
        border: 1px solid rgba(255, 255, 255, 0.8);
        box-shadow: inset 0 1px 1px rgba(255,255,255,0.95), 0 30px 60px -20px rgba(0,0,0,0.08);
        backdrop-filter: blur(24px);
        -webkit-backdrop-filter: blur(24px);
    }

    .glass-panel {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.45), rgba(255, 255, 255, 0.15));
        border: 1px solid rgba(255, 255, 255, 0.7);
        box-shadow: inset 0 1px 1px rgba(255,255,255,0.8), 0 10px 20px -10px rgba(0,0,0,0.04);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
    }

    .glass-avatar {
        border: 1px solid rgba(255, 255, 255, 0.85);
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.6), rgba(255, 255, 255, 0.2));
        box-shadow: inset 0 1px 1px rgba(255,255,255,0.9), 0 15px 30px -15px rgba(0,0,0,0.12);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
    }

    .glass-button--danger {
        color: #ffffff;
        background: linear-gradient(135deg, #1c1c1c, #2b2b2b);
        border: 1px solid #1c1c1c;
        box-shadow: 0 10px 20px -8px rgba(0,0,0,0.3);
    }

    .glass-button--danger:hover {
        background: linear-gradient(135deg, #EA7645, #d66031);
        border-color: #EA7645;
        box-shadow: 0 12px 25px -8px rgba(234, 118, 69, 0.4);
        transform: translateY(-2px);
    }

    .glass-link {
        color: #1f1f1f;
        background: rgba(255, 255, 255, 0.45);
        border: 1px solid rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
    }

    .glass-link:hover {
        color: #48AA8C;
        border-color: #48AA8C;
        background: rgba(255, 255, 255, 0.85);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px -8px rgba(72, 170, 140, 0.3);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const wrapper = document.getElementById('pageWrapper');
        const overlay = document.getElementById('loginCompletionOverlay');
        const overlayCard = overlay?.querySelector('.login-overlay-card');
        const overlayStatus = overlay?.querySelector('[data-overlay-status]');
        const overlayProgress = overlay?.querySelector('[data-overlay-progress]');
        const overlayProgressValue = overlay?.querySelector('[data-overlay-progress-value]');
        const animatedElems = Array.from(document.querySelectorAll('.pre-animate'));
        const headlineText = 'SESSION TERMINATION';
        const headlineElem = document.getElementById('logoutHeadline');
        let typeIndex = 0;

        const typewriter = () => {
            if (!headlineElem) return;

            if (typeIndex < headlineText.length) {
                headlineElem.innerHTML += headlineText.charAt(typeIndex);
                typeIndex += 1;
                setTimeout(typewriter, 100);
            }
        };

        const activateAnimatedElems = () => {
            if (!animatedElems.length) return;

            animatedElems.forEach((elem, index) => {
                const animationClass = elem.getAttribute('data-animate');
                const baseDelay = parseFloat(elem.style.animationDelay || 0);
                elem.classList.remove('pre-animate');
                elem.style.animationDelay = `${baseDelay + 0.2 + index * 0.1}s`;
                if (animationClass) {
                    requestAnimationFrame(() => elem.classList.add(animationClass));
                }
            });

            setTimeout(typewriter, 400);
        };

        const revealPage = () => {
            if (!wrapper) return;
            wrapper.classList.remove('opacity-0');
            requestAnimationFrame(() => wrapper.classList.add('opacity-100'));
        };

        const runOverlaySequence = () => {
            if (!overlay || !overlayCard) {
                revealPage();
                activateAnimatedElems();
                return;
            }

            overlay.classList.remove('opacity-0');
            overlay.classList.add('opacity-100');
            requestAnimationFrame(() => overlayCard.classList.add('is-active'));

            let progress = 0;
            const progressTimer = setInterval(() => {
                progress = Math.min(progress + 10, 100);
                if (overlayProgress) {
                    overlayProgress.style.transform = `scaleX(${progress / 100})`;
                }
                if (overlayProgressValue) {
                    overlayProgressValue.textContent = `${progress}%`;
                }

                if (progress >= 100) {
                    clearInterval(progressTimer);
                    if (overlayStatus) {
                        overlayStatus.textContent = 'Akses Disetujui';
                    }

                    setTimeout(() => {
                        overlay.classList.remove('opacity-100');
                        overlay.classList.add('opacity-0');
                        overlayCard.classList.remove('is-active');
                        overlay.addEventListener('transitionend', () => overlay.remove(), { once: true });

                        revealPage();
                        activateAnimatedElems();
                    }, 500);
                }
            }, 100);
        };

        runOverlaySequence();
    });
</script>
@endsection