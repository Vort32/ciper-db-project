@extends('layouts.app')

@section('title', 'RHINE LAB.LLC - OPERATIVE OVERVIEW')

@section('content')
<div id="pageWrapper" class="relative min-h-screen bg-[#ECE8E5] text-[#222] py-16 px-4 sm:px-6 overflow-hidden transition-opacity duration-700 opacity-0 custom-scroll">
    
    <!-- Background Ambient Glow & Watermark -->
    <div class="fixed w-[40rem] h-[40rem] bg-white/50 rounded-full blur-[100px] -top-20 -left-20 z-0 pointer-events-none"></div>
    <div class="fixed w-[30rem] h-[30rem] bg-[#EA7645]/10 rounded-full blur-[80px] bottom-0 right-10 z-0 pointer-events-none"></div>
    <div class="fixed inset-0 bg-cover bg-center opacity-[0.03] pointer-events-none" style="background-image: url('{{ asset('images/Rhine_Lab_HQ1.png') }}');"></div>

    <!-- Header Left HUD -->
    <div class="absolute top-6 left-6 z-20 space-y-1 select-none">
        <h1 class="text-2xl font-bold">RHINE LAB</h1>
        <p class="text-[10px] tracking-[0.2em] uppercase font-bold text-gray-600">OPERATIVE INFORMATION</p>
        <p class="text-base sm:text-lg md:text-xl">ANALYSIS <span class="font-bold">OS</span></p>
    </div>

    <!-- Header Right Status -->
    <div class="absolute top-6 right-6 z-20 flex items-center space-x-2 text-xs sm:text-sm font-bold tracking-wider text-gray-700 select-none">
        <span>SYNCING DATA</span>
        <span class="flex space-x-1">
            <span class="h-1.5 w-1.5 rounded-full bg-[#EA7645] animate-bounce"></span>
            <span class="h-1.5 w-1.5 rounded-full bg-[#C8B9A9] animate-bounce [animation-delay:200ms]"></span>
            <span class="h-1.5 w-1.5 rounded-full bg-[#48AA8C] animate-bounce [animation-delay:400ms]"></span>
        </span>
    </div>

    <!-- Back Button -->
    <div class="fixed bottom-4 left-4 z-20">
        <a href="{{ url('/') }}" class="group relative flex items-center justify-center p-3 px-4 transition-all duration-300">
            <div class="absolute inset-0 bg-[#dcd9d2]/40 backdrop-blur-md border border-white/50 opacity-0 transform scale-50 group-hover:opacity-100 group-hover:scale-100 transition-all duration-700 cubic-bloop rounded-full pointer-events-none z-0 shadow-lg"></div>
            <div class="relative z-10 flex items-center text-gray-800 font-extrabold uppercase tracking-[0.2em] text-[10px] md:text-xs transition-colors duration-300 group-hover:text-[#2c2c2c]">
                <span class="mr-2 inline-block transform translate-x-3 opacity-0 transition-all duration-700 cubic-bloop group-hover:translate-x-0 group-hover:opacity-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5m6 6l-6-6 6-6" /></svg>
                </span>
                <span class="transition-transform duration-700 cubic-bloop group-hover:translate-x-0 -translate-x-2">Back</span>
            </div>
        </a>
    </div>

    <!-- Footers -->
    <div class="fixed bottom-3 right-3 z-20 text-[10px] sm:text-xs md:text-sm lg:text-base font-light tracking-wide text-gray-700 select-none">
        POWERED BY <span class="font-black">RHINE LAB</span>
    </div>

    <div class="relative z-10 max-w-5xl mx-auto mt-20 space-y-12 pb-24">
        
        <?php
            $operatives =$users ?? \App\Models\User::with(['division', 'researchRecords.project.division'])->get();
        ?>

        <?php if (count($operatives) > 0): ?>
            <?php foreach ($operatives as$user): ?>
                <!-- BUNGKUSAN SETIAP OPERATIF -->
                <div class="operative-wrapper relative w-full">
                    
                    <!-- KARTU PROFIL UTAMA -->
                    <div class="profile-stage relative w-full bg-white/40 backdrop-blur-[16px] border border-white/80 shadow-[0_25px_50px_rgba(0,0,0,0.05)] flex flex-col md:flex-row gap-6 p-6 md:p-10 overflow-hidden group transition-all duration-700 ease-out">
                        <div class="absolute inset-0 hex-bg opacity-30 pointer-events-none"></div>
                        <div class="absolute bottom-2 md:bottom-8 right-4 md:right-1/4 text-[6rem] md:text-[10rem] font-black text-white/60 select-none pointer-events-none leading-none tracking-tighter mix-blend-overlay">INFO</div>

                        <!-- Kiri: Foto Profil -->
                        <div class="relative z-10 w-full md:w-2/5 flex flex-col justify-center items-center md:items-start">
                            <button type="button" class="btn-toggle-records relative group focus:outline-none w-[70%] md:w-full max-w-[280px] aspect-[4/5] cursor-pointer">
                                <div class="absolute inset-0 bg-white/50 backdrop-blur-sm border border-white/80 transform -translate-x-3 translate-y-3 transition-transform duration-700 ease-out group-hover:-translate-x-5 group-hover:translate-y-5 shadow-xl"></div>
                                <img src="{{ $user->photo_path ? asset($user->photo_path) : asset('images/users/Silence.png') }}" alt="Foto {{ $user->name }}" class="relative z-10 w-full h-full object-cover border border-white/50 shadow-md transition-transform duration-700 ease-out group-hover:scale-[1.02]" />
                                <div class="absolute bottom-4 left-4 z-20 w-12 h-[3px] bg-[#1c1c1c]"></div>
                            </button>
                            <p class="mt-2 text-[9px] font-extrabold uppercase tracking-[0.2em] text-[#EA7645] animate-pulse">
                                * Klik Foto Untuk Melihat Catatan
                            </p>
                        </div>

                        <!-- Kanan: Informasi -->
                        <div class="relative z-10 w-full md:w-3/5 flex flex-col justify-center pt-4 md:pt-0">
                            <div class="self-start bg-[#1c1c1c] text-white px-3 py-1 text-[9px] sm:text-[10px] font-bold tracking-[0.2em] uppercase shadow-md relative z-10">
                                {{ $user->position ?? 'OPERATIVE RESEARCHER' }}
                            </div>
                            <div class="self-start bg-[#1c1c1c] text-white px-4 md:px-6 py-2 md:py-3 mt-1 shadow-xl w-full border-l-4 border-[#EA7645] relative z-20">
                                <h1 class="text-xl sm:text-2xl md:text-3xl font-black tracking-widest uppercase whitespace-normal break-words relative z-10 leading-snug">
                                    {{ $user->name }}
                                </h1>
                            </div>
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between bg-white/70 backdrop-blur-md border border-white p-3 md:p-4 mt-2 shadow-sm w-full relative z-10 gap-2 sm:gap-0">
                                <div class="flex items-center gap-3">
                                    <img src="{{ asset('images/logo.png') }}" class="h-6 md:h-8 filter grayscale opacity-90">
                                    <span class="text-[9px] md:text-[11px] font-black uppercase tracking-[0.2em] text-[#1c1c1c] leading-tight">
                                        {{ $user->affiliation ?? 'RHINE LAB LLC' }}<br>
                                        <span class="text-[#EA7645] font-black">
                                            <?php if ($user->division): ?>
                                                {{ $user->division->code }} — {{$user->division->name }}
                                            <?php else: ?>
                                                RHINE RESEARCH SECTION
                                            <?php endif; ?>
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <div class="mt-4 md:mt-6 flex items-center gap-2 relative z-10">
                                <div class="w-2 h-2 bg-[#EA7645]"></div>
                                <span class="text-[10px] md:text-xs font-black tracking-[0.25em] text-[#1c1c1c] uppercase">USR-{{ str_pad($user->id ?? '001', 3, '0', STR_PAD_LEFT) }}</span>
                            </div>

                            <!-- Floating Stats -->
                            <div class="static md:absolute md:bottom-2 md:-right-6 mt-6 md:mt-0 bg-white/70 backdrop-blur-[20px] border border-white shadow-[0_15px_35px_rgba(0,0,0,0.1)] p-4 md:p-5 w-full md:w-56 z-30 flex flex-col gap-2 transform transition-transform duration-700 ease-out md:group-hover:-translate-y-2">
                                <div class="bg-[#1c1c1c] text-white px-2 py-0.5 text-[8px] md:text-[9px] font-bold tracking-widest uppercase inline-block self-start mb-2">PROFIL OPERATIF</div>
                                <div class="flex justify-between items-center border-b border-gray-400/40 pb-1.5">
                                    <span class="text-[8px] md:text-[9px] font-bold uppercase tracking-[0.2em] text-gray-600">TOTAL CATATAN</span>
                                    <span class="text-xs md:text-sm font-black text-[#EA7645]">{{ $user->researchRecords ? $user->researchRecords->count() : 0 }}</span>
                                </div>
                                <div class="flex justify-between items-center border-b border-gray-400/40 pb-1.5">
                                    <span class="text-[8px] md:text-[9px] font-bold uppercase tracking-[0.2em] text-gray-600">DIVISI</span>
                                    <span class="text-xs md:text-sm font-black text-[#1c1c1c]">{{ $user->division?->code ?? 'SECTOR' }}</span>
                                </div>
                                <div class="flex justify-between items-center border-b border-gray-400/40 pb-1.5">
                                    <span class="text-[8px] md:text-[9px] font-bold uppercase tracking-[0.2em] text-gray-600">STATUS</span>
                                    <span class="text-[10px] md:text-xs font-black text-[#48AA8C] tracking-widest">ACTIVE</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- OVERLAY CATATAN RISET SPESIFIK UNTUK USER INI -->
                    <div class="records-section hidden fixed inset-0 z-[60] opacity-0 transition-opacity duration-500" role="dialog" aria-modal="true">
                        <div class="absolute inset-0 bg-[#ECE8E5]/45 backdrop-blur-md"></div>
                        <div class="absolute inset-0 pointer-events-none" style="background: radial-gradient(circle at 50% 45%, rgba(255,255,255,0.45), transparent 60%);"></div>

                        <!-- Header overlay -->
                        <div class="absolute top-0 inset-x-0 z-[200] flex items-center justify-between px-5 sm:px-8 pt-5">
                            <div class="flex items-center gap-2 select-none">
                                <span class="h-2 w-2 rounded-full bg-[#EA7645]"></span>
                                <div>
                                    <h2 class="text-[11px] sm:text-sm font-black tracking-[0.25em] uppercase text-[#1c1c1c] leading-tight">Daftar Catatan: {{ $user->name }}</h2>
                                    <span class="text-[8px] font-bold tracking-widest text-gray-500 uppercase">INTERNAL ARCHIVE</span>
                                </div>
                            </div>
                            <button type="button" class="rec-close w-10 h-10 rounded-full bg-white/40 backdrop-blur-xl border border-white/70 shadow-[inset_0_1px_1px_rgba(255,255,255,0.9),0_8px_20px_rgba(0,0,0,0.12)] flex items-center justify-center text-gray-800 hover:bg-white/60 hover:text-[#EA7645] transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12M18 6L6 18"/></svg>
                            </button>
                        </div>

                        <?php if ($user->researchRecords &&$user->researchRecords->isNotEmpty()): ?>
                            <div class="rec-stage absolute inset-0 isolate cursor-grab select-none" style="touch-action: pan-y;">
                                <?php $iteration = 1; ?>
                                <?php foreach ($user->researchRecords as$record): ?>
                                    <?php $statusFormatted = strtoupper(str_replace('_', ' ',$record->status ?? 'DRAFT')); ?>
                                    <div class="rec-card absolute left-1/2 top-1/2 w-[min(86vw,22.5rem)]" style="opacity:0;">
                                        <article class="group relative flex flex-col min-h-[480px] rounded-[22px] border border-white/70 px-5 pt-4 pb-4 overflow-hidden backdrop-blur-2xl backdrop-saturate-150"
                                                 style="background: linear-gradient(155deg, rgba(255,255,255,0.62) 0%, rgba(255,255,255,0.28) 45%, rgba(139,107,78,0.12) 100%);
                                                        box-shadow: inset 0 1px 1px rgba(255,255,255,0.95), inset 0 -1px 1px rgba(255,255,255,0.35), 0 30px 60px rgba(70,48,28,0.22), 0 4px 12px rgba(70,48,28,0.10);">
                                            
                                            <div class="absolute inset-x-0 top-0 h-28 bg-gradient-to-b from-white/60 to-transparent pointer-events-none"></div>
                                            <div class="absolute -top-16 -left-12 w-52 h-52 rounded-full bg-white/40 blur-2xl pointer-events-none"></div>
                                            <img src="{{ asset('images/logo.png') }}" alt="" draggable="false" class="absolute -bottom-6 -right-6 w-48 opacity-[0.08] grayscale pointer-events-none select-none">

                                            <header class="relative z-10 flex items-start gap-3 pb-2 border-b border-[#1c1c1c]/60">
                                                <span class="text-5xl font-black leading-none tracking-tighter text-[#1c1c1c]"><?= $iteration++ ?></span>
                                                <div class="flex-1 text-center pt-0.5">
                                                    <div class="flex items-center justify-center gap-1.5">
                                                        <img src="{{ asset('images/logo.png') }}" alt="" draggable="false" class="h-4 grayscale opacity-80">
                                                        <span class="text-[8px] font-black tracking-[0.22em] uppercase text-[#555]">Rhine Lab Corporation</span>
                                                    </div>
                                                    <h4 class="mt-1.5 text-base sm:text-lg font-black tracking-[0.2em] uppercase text-[#1c1c1c] leading-none">Research Record</h4>
                                                </div>
                                            </header>

                                            <div class="relative z-10 grid grid-cols-[1fr_1.6fr_1fr] text-[7px] font-bold uppercase tracking-[0.2em] text-gray-500 border-b border-black/15 py-1">
                                                <span>Divisi</span><span>Kode Rekord</span><span class="text-right">Tanggal</span>
                                            </div>
                                            <div class="relative z-10 grid grid-cols-[1fr_1.6fr_1fr] text-[9px] font-black uppercase tracking-wider py-1 border-b border-black/10">
                                                <span class="text-[#EA7645]">{{ $record->project?->division?->code ?? 'MATH-05' }}</span>
                                                <span class="text-[#1c1c1c] break-all pr-1">{{ $record->record_code ?? 'MATH-05-PROJ-001' }}</span>
                                                <span class="text-right text-gray-600">{{ optional($record->recorded_at)->translatedFormat('d M Y') ?? date('d M Y') }}</span>
                                            </div>

                                            <div class="relative z-10 -mx-1 px-3 py-7"
                                                 style="background-image:
                                                    linear-gradient(to right, transparent calc(20% - 1px), rgba(110,80,50,0.10) calc(20% - 1px), rgba(110,80,50,0.10) 20%, transparent 20%),
                                                    linear-gradient(to right, transparent calc(68% - 1px), rgba(110,80,50,0.10) calc(68% - 1px), rgba(110,80,50,0.10) 68%, transparent 68%),
                                                    repeating-linear-gradient(to bottom, transparent 0, transparent 15px, rgba(110,80,50,0.12) 15px, rgba(110,80,50,0.12) 16px);">
                                                <div class="relative mx-auto w-[90%] -rotate-3 bg-white p-2 pb-7 shadow-[0_10px_24px_rgba(0,0,0,0.28)] transition-transform duration-500 ease-out group-hover:-rotate-1 group-hover:scale-[1.02]">
                                                    <div class="absolute -top-3 -left-5 z-20 h-5 w-16 -rotate-[35deg] bg-white/55 border border-white/80 shadow-sm backdrop-blur-sm"></div>
                                                    <?php if ($record->image_path): ?>
                                                        <img src="{{ asset($record->image_path) }}" alt="Dokumentasi" draggable="false" class="w-full aspect-[4/3] object-cover">
                                                    <?php else: ?>
                                                        <div class="w-full aspect-[4/3] bg-gray-100 flex items-center justify-center text-[9px] font-bold text-gray-400 uppercase tracking-widest">NO VISUAL DATA</div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="relative z-10 mt-2 flex-1">
                                                <h3 class="text-[13px] font-black uppercase tracking-wider text-[#1c1c1c] leading-snug">
                                                    {{ $record->project?->title ?? 'PROYEK UTAMA' }}
                                                </h3>
                                                <p class="text-[10px] text-gray-600 italic font-medium mt-1.5 line-clamp-2">"{{ $record->summary }}"</p>
                                            </div>

                                            <footer class="relative z-10 mt-4 pt-3 border-t border-black/15 flex items-center justify-between">
                                                <span class="-rotate-2 px-3 py-1 text-[9px] font-black tracking-widest uppercase border-2 border-[#EA7645]/70 text-[#EA7645] bg-[#EA7645]/5">
                                                    {{ $statusFormatted }}
                                                </span>
                                                <span class="text-[7.5px] font-black tracking-[0.3em] uppercase text-gray-500">RHINE LAB, LLC</span>
                                            </footer>
                                        </article>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <!-- Kontrol bawah -->
                            <div class="absolute bottom-5 inset-x-0 z-[200] flex flex-col items-center gap-2 pointer-events-none">
                                <div class="flex items-center gap-4 pointer-events-auto">
                                    <button type="button" class="rec-prev w-11 h-11 rounded-full bg-white/40 backdrop-blur-xl border border-white/70 shadow-[inset_0_1px_1px_rgba(255,255,255,0.9),0_8px_20px_rgba(0,0,0,0.12)] flex items-center justify-center text-gray-800 hover:bg-white/60 hover:text-[#EA7645] disabled:opacity-30 disabled:pointer-events-none transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 6l-6 6 6 6"/></svg>
                                    </button>
                                    <span class="rec-counter min-w-[4.5rem] text-center text-xs font-black tracking-[0.3em] text-[#1c1c1c]">01 / 01</span>
                                    <button type="button" class="rec-next w-11 h-11 rounded-full bg-white/40 backdrop-blur-xl border border-white/70 shadow-[inset_0_1px_1px_rgba(255,255,255,0.9),0_8px_20px_rgba(0,0,0,0.12)] flex items-center justify-center text-gray-800 hover:bg-white/60 hover:text-[#EA7645] disabled:opacity-30 disabled:pointer-events-none transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 6l6 6-6 6"/></svg>
                                    </button>
                                </div>
                                <p class="text-[8px] font-extrabold uppercase tracking-[0.25em] text-gray-500">Geser kiri / kanan</p>
                            </div>
                        <?php else: ?>
                            <div class="absolute inset-0 flex items-center justify-center px-6">
                                <div class="p-10 text-center rounded-2xl border border-white/70 bg-white/40 backdrop-blur-xl shadow-lg">
                                    <p class="text-xs font-bold text-gray-600 uppercase tracking-widest">Belum Ada Catatan Riset Terarsip</p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="rounded-2xl border border-white/60 bg-white/40 backdrop-blur-md p-10 shadow-lg text-center space-y-4">
                <h2 class="text-2xl font-black tracking-widest uppercase text-gray-800">DATABASE WARNING: NO USER DATA</h2>
                <p class="text-gray-600 text-sm font-medium">Data operatif tidak ditemukan di dalam sistem.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
    .hex-bg {
        background-color: transparent;
        background-image: url("data:image/svg+xml,%3Csvg width='40' height='69.282' viewBox='0 0 40 69.282' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M40 11.547L20 0 0 11.547v23.094l20 11.547 20-11.547V11.547zM20 45.034L1.155 34.148V12.376L20 1.49l18.845 10.886v21.772L20 45.034z' fill='%23000000' fill-opacity='0.04' fill-rule='evenodd'/%3E%3Cpath d='M40 46.188L20 34.641 0 46.188v23.094l20 11.547 20-11.547V46.188zM20 79.675L1.155 68.789V47.017L20 36.13l18.845 10.886v21.772L20 79.675z' fill='%23000000' fill-opacity='0.04' fill-rule='evenodd'/%3E%3C/svg%3E");
        background-size: 60px 103.923px;
    }
    .custom-scroll::-webkit-scrollbar { width: 6px; }
    .custom-scroll::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.15); border-radius: 9999px; }
    .cubic-bloop { transition-timing-function: cubic-bezier(0.34, 1.56, 0.64, 1); }
    .profile-back { transform: scale(0.9); filter: blur(6px); opacity: 0.55; pointer-events: none; }
    .rec-card { transition: transform 0.55s cubic-bezier(0.22, 1, 0.36, 1), opacity 0.4s ease; will-change: transform; }
    .rec-card.dragging { transition: none; }
    .rec-stage.dragging { cursor: grabbing; }
    .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const wrapper = document.getElementById('pageWrapper');
    if (wrapper) {
        wrapper.classList.remove('opacity-0');
        wrapper.classList.add('opacity-100');
    }

    document.querySelectorAll('.operative-wrapper').forEach(container => {
        const btnToggle = container.querySelector('.btn-toggle-records');
        const section   = container.querySelector('.records-section');
        const profile   = container.querySelector('.profile-stage');
        const stage     = container.querySelector('.rec-stage');
        const cards     = Array.from(container.querySelectorAll('.rec-card'));
        const counter   = container.querySelector('.rec-counter');
        const btnPrev   = container.querySelector('.rec-prev');
        const btnNext   = container.querySelector('.rec-next');
        const btnClose  = container.querySelector('.rec-close');

        let idx = 0, dx = 0, startX = 0, dragging = false, moved = false, isOpen = false, wheelLock = false;

        function metrics() {
            if(!cards.length) return { fit: 1, spacing: 0 };
            const c = cards[0];
            const w = c.offsetWidth, h = c.offsetHeight;
            const fit = Math.min(1, (window.innerHeight - 190) / h);
            return { fit, spacing: Math.min(w * fit * 0.8, window.innerWidth * 0.6) };
        }

        function layout(entering = false) {
            if (!cards.length) return;
            const m = metrics();
            cards.forEach((c, i) => {
                const p = i - idx + (dragging ? dx / m.spacing : 0);
                const a = Math.abs(p);
                const x = p * m.spacing;
                const y = Math.min(a, 3) * 14 + (entering ? 90 : 0);
                const r = p * 5;
                const s = m.fit * (1 - Math.min(a, 3) * 0.09);
                c.style.transform = `translate(-50%, -50%) translateX(${x}px) translateY(${y}px) rotate(${r}deg) scale(${s})`;
                c.style.opacity = entering ? 0 : Math.max(0, 1 - Math.max(0, a - 0.6) * 0.35);
                c.style.zIndex = 100 - Math.round(a * 10);
                c.style.pointerEvents = a > 3.5 ? 'none' : 'auto';
            });
        }

        function update() {
            if (!cards.length) return;
            counter.textContent = String(idx + 1).padStart(2, '0') + ' / ' + String(cards.length).padStart(2, '0');
            btnPrev.disabled = idx === 0;
            btnNext.disabled = idx === cards.length - 1;
        }

        function go(n) {
            idx = Math.max(0, Math.min(cards.length - 1, idx + n));
            layout(); update();
        }

        function openRecords() {
            if (!section || isOpen) return;
            isOpen = true;
            idx = 0; dx = 0;
            section.classList.remove('hidden');
            profile && profile.classList.add('profile-back');
            document.body.style.overflow = 'hidden';
            if (cards.length) {
                cards.forEach(c => c.style.transition = 'none');
                layout(true);
                void section.offsetWidth;
                cards.forEach(c => c.style.transition = '');
            }
            requestAnimationFrame(() => {
                section.classList.remove('opacity-0');
                layout(); update();
            });
        }

        function closeRecords() {
            if (!isOpen) return;
            isOpen = false;
            section.classList.add('opacity-0');
            profile && profile.classList.remove('profile-back');
            document.body.style.overflow = '';
            setTimeout(() => { if (!isOpen) section.classList.add('hidden'); }, 500);
        }

        if (btnToggle && section) {
            btnToggle.addEventListener('click', openRecords);
            btnClose && btnClose.addEventListener('click', closeRecords);
            btnPrev && btnPrev.addEventListener('click', () => go(-1));
            btnNext && btnNext.addEventListener('click', () => go(1));

            document.addEventListener('keydown', (e) => {
                if (!isOpen) return;
                if (e.key === 'Escape') closeRecords();
                if (e.key === 'ArrowRight') go(1);
                if (e.key === 'ArrowLeft') go(-1);
            });

            if (!cards.length) {
                section.addEventListener('click', (e) => { if (e.target === section) closeRecords(); });
            }
        }

        if (stage && cards.length) {
            stage.addEventListener('pointerdown', (e) => {
                dragging = true; moved = false; startX = e.clientX; dx = 0;
                cards.forEach(c => c.classList.add('dragging'));
                stage.classList.add('dragging');
                stage.setPointerCapture(e.pointerId);
            });

            stage.addEventListener('pointermove', (e) => {
                if (!dragging) return;
                dx = e.clientX - startX;
                if (Math.abs(dx) > 6) moved = true;
                layout();
            });

            const endDrag = (e) => {
                if (!dragging) return;
                dragging = false;
                cards.forEach(c => c.classList.remove('dragging'));
                stage.classList.remove('dragging');
                const m = metrics();
                const threshold = Math.min(60, m.spacing * 0.2);

                if (moved) {
                    const steps = Math.max(1, Math.round(Math.abs(dx) / m.spacing));
                    if (dx < -threshold) idx = Math.min(cards.length - 1, idx + steps);
                    else if (dx > threshold) idx = Math.max(0, idx - steps);
                } else if (e.type === 'pointerup') {
                    const el = document.elementFromPoint(e.clientX, e.clientY);
                    const hit = el && el.closest ? el.closest('.rec-card') : null;
                    if (hit) idx = cards.indexOf(hit);
                    else closeRecords();
                }
                dx = 0;
                layout(); update();
            };
            stage.addEventListener('pointerup', endDrag);
            stage.addEventListener('pointercancel', endDrag);

            stage.addEventListener('wheel', (e) => {
                e.preventDefault();
                if (wheelLock) return;
                const d = Math.abs(e.deltaX) > Math.abs(e.deltaY) ? e.deltaX : e.deltaY;
                if (Math.abs(d) < 10) return;
                go(d > 0 ? 1 : -1);
                wheelLock = true;
                setTimeout(() => wheelLock = false, 350);
            }, { passive: false });

            window.addEventListener('resize', () => { if (isOpen) layout(); });
            layout(); update();
        }
    });
});
</script>
@endsection