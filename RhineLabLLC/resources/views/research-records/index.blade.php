@extends('layouts.app')

@section('title', 'Catatan Riset Saya - RHINE LAB.LLC')

@section('content')
<div id="pageWrapper" class="relative min-h-screen bg-[#ECE8E5] text-[#1c1c1c] py-12 px-4 sm:px-8 overflow-hidden transition-opacity duration-700 opacity-0">
    
    <!-- Background Ambient Glow & Watermark HQ -->
    <div class="absolute w-[45rem] h-[45rem] bg-white/40 rounded-full blur-[130px] -top-24 -left-24 z-0 pointer-events-none"></div>
    <div class="absolute w-[35rem] h-[35rem] bg-[#EA7645]/8 rounded-full blur-[100px] bottom-10 right-10 z-0 pointer-events-none"></div>
    <div class="absolute inset-0 bg-cover bg-center opacity-[0.03] pointer-events-none" style="background-image: url('{{ asset('images/Rhine_Lab_HQ1.png') }}');"></div>

    <!-- Header Left HUD -->
    <div class="absolute top-6 left-6 sm:left-8 z-20 space-y-0.5 select-none">
        <div class="flex items-center gap-2">
            <h1 class="text-xl sm:text-2xl font-black tracking-widest text-[#1c1c1c]">RHINE LAB</h1>
            <span class="bg-[#1c1c1c] text-white text-[8px] font-bold px-1.5 py-0.5 tracking-widest uppercase">OPERATIVE</span>
        </div>
        <p class="text-[9px] tracking-[0.25em] uppercase font-bold text-gray-500">RESEARCH LOG SYSTEM</p>
        <p class="text-xs sm:text-sm font-bold text-gray-700">ANALYSIS <span class="font-black text-[#EA7645]">OS</span></p>
    </div>

    <!-- Header Right Status -->
    <div class="absolute top-6 right-6 sm:right-8 z-20 flex items-center space-x-2 text-xs font-bold tracking-wider text-gray-600 select-none">
        <span class="text-[10px] tracking-[0.2em] uppercase">SYSTEM ACTIVE</span>
        <span class="flex space-x-1">
            <span class="h-1.5 w-1.5 rounded-full bg-[#EA7645] animate-bounce"></span>
            <span class="h-1.5 w-1.5 rounded-full bg-[#C8B9A9] animate-bounce [animation-delay:200ms]"></span>
            <span class="h-1.5 w-1.5 rounded-full bg-[#48AA8C] animate-bounce [animation-delay:400ms]"></span>
        </span>
    </div>

    <!-- MAIN CONTENT WRAPPER -->
    <div class="relative z-10 max-w-7xl mx-auto mt-16 space-y-8">
        
        <!-- TITLE & ACTION BUTTONS BAR -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 border-l-2 border-[#1c1c1c] pl-5 select-none">
            <div class="space-y-1">
                <p class="text-[9px] uppercase tracking-[0.4em] font-black text-gray-400">RHINE LAB INTERNAL ARCHIVE</p>
                <h1 class="text-3xl sm:text-4xl font-black tracking-wider text-[#1c1c1c] uppercase">Catatan Riset Saya</h1>
                <p class="text-xs text-gray-600 font-medium">Dokumentasi mandiri eksperimen &amp; laporan operatif Rhine Lab.</p>
            </div>
            
            <div class="flex flex-wrap items-center gap-2">
                <a href="{{ url('/') }}" class="nav-pill">
                    <span>Beranda</span>
                </a>
                <!-- TOMBOL KELOLA / TAMBAH MATERIAL (DITAMBAHKAN) -->
                <a href="{{ route('materials.index') }}" class="nav-pill border-[#48AA8C] text-[#1f5f4c] hover:bg-[#48AA8C] hover:text-white">
                    <span>+ Kelola Material</span>
                </a>
                <a href="{{ route('research-records.create') }}" class="nav-pill nav-pill--active">
                    <span>+ Tambah Catatan</span>
                </a>
            </div>
        </div>

        @if (session('status'))
            <div class="rounded-2xl border border-[#48AA8C]/40 bg-[#48AA8C]/15 backdrop-blur-md px-5 py-3.5 text-xs font-bold tracking-wide text-[#1f5f4c] flex items-center gap-3">
                <span class="h-2 w-2 rounded-full bg-[#48AA8C]"></span>
                <span>{{ session('status') }}</span>
            </div>
        @endif

        <!-- LIST CATATAN RISET -->
        <div class="space-y-4">
            @forelse ($records as $record)
                @php
                    $statusFormatted = strtoupper(str_replace('_', ' ', $record->status ?? 'DRAFT'));
                    $isFinal = ($record->status === 'final');
                @endphp
                <div class="glass-card p-6 flex flex-col md:flex-row md:items-center justify-between gap-5 transition hover:bg-white/60">
                    <div class="space-y-2 flex-1">
                        <div class="flex items-center gap-2">
                            <span class="text-[10px] font-black uppercase tracking-[0.3em] text-[#EA7645]">{{ $record->record_code }}</span>
                            <span class="text-[8px] font-black tracking-widest uppercase border px-2.5 py-0.5 rounded-full {{ $isFinal ? 'bg-[#1c1c1c] text-white border-[#1c1c1c]' : 'bg-[#EA7645]/10 text-[#EA7645] border-[#EA7645]/30' }}">
                                {{ $statusFormatted }}
                            </span>
                            <span class="text-[8px] font-bold tracking-widest uppercase border border-gray-300 text-gray-600 px-2.5 py-0.5 rounded-full">
                                {{ strtoupper($record->classification) }}
                            </span>
                        </div>
                        
                        <h2 class="text-xl font-black tracking-wide text-[#1c1c1c] uppercase">{{ $record->project?->title ?? 'Tanpa Proyek' }}</h2>
                        
                        @if ($record->image_path)
                            <div class="my-3 max-w-md overflow-hidden rounded-xl border border-white/80 bg-white/40 shadow-sm">
                                <img src="{{ asset($record->image_path) }}" alt="Dokumentasi {{ $record->record_code }}" class="h-36 w-full object-cover" />
                            </div>
                        @endif

                        <p class="text-xs text-gray-600 line-clamp-2 leading-relaxed italic bg-white/30 p-3 rounded-xl border border-white/50 max-w-3xl">
                            "{{ \Illuminate\Support\Str::limit($record->summary, 180) }}"
                        </p>

                        <div class="flex flex-wrap items-center gap-3 text-[9px] font-bold text-gray-500 uppercase tracking-widest pt-1">
                            <span>PROYEK: {{ $record->project?->reference_code ?? 'N/A' }}</span>
                            <span>•</span>
                            <span>DIVISI: {{ $record->project?->division?->code ?? 'N/A' }}</span>
                            <span>•</span>
                            <span>TANGGAL: {{ optional($record->recorded_at)->translatedFormat('d M Y') ?? 'Belum ditentukan' }}</span>
                        </div>
                    </div>

                    <!-- TOMBOL AKSI OPERATIF -->
                    <div class="flex items-center gap-2 md:flex-col md:items-end">
                        <a href="{{ route('research-records.show', $record) }}" class="btn-action border border-gray-300 text-gray-700 hover:bg-gray-200">
                            Detail
                        </a>
                        <a href="{{ route('research-records.edit', $record) }}" class="btn-action bg-[#1c1c1c] text-white hover:bg-[#EA7645]">
                            Edit / Revisi
                        </a>
                        <form action="{{ route('research-records.destroy', $record) }}" method="post" onsubmit="return confirm('Hapus catatan riset ini secara permanen?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action border border-[#EA7645] text-[#EA7645] hover:bg-[#EA7645] hover:text-white">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="glass-card p-16 text-center">
                    <p class="text-[10px] font-black uppercase tracking-[0.35em] text-gray-400">DATABASE KOSONG</p>
                    <p class="mt-2 text-sm font-semibold text-[#1c1c1c]">Belum ada catatan riset terarsip. Mulai dokumentasikan temuan Anda melalui tombol "Tambah Catatan".</p>
                </div>
            @endforelse
        </div>

        <!-- Custom Pagination -->
        <div class="mt-8 liquid-pagination">
            {{ $records->links() }}
        </div>
    </div>
</div>

<style>
    .glass-card {
        background: rgba(255, 255, 255, 0.45);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        border: 1px solid rgba(255, 255, 255, 0.8);
        border-radius: 1.25rem;
        box-shadow: 0 10px 30px -15px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }
    .nav-pill {
        display: inline-flex; align-items: center; padding: 0.5rem 1.25rem;
        border-radius: 9999px; background: rgba(255, 255, 255, 0.5);
        border: 1px solid rgba(255, 255, 255, 0.8); font-size: 0.65rem;
        font-weight: 800; letter-spacing: 0.22em; text-transform: uppercase;
        color: #1c1c1c; backdrop-filter: blur(10px); transition: all 0.25s ease;
    }
    .nav-pill:hover { background: rgba(255, 255, 255, 0.9); color: #EA7645; }
    .nav-pill--active { background: #1c1c1c; color: #fff; border-color: #1c1c1c; }
    .nav-pill--active:hover { background: #EA7645; color: #fff; border-color: #EA7645; }
    .btn-action {
        padding: 0.45rem 1.1rem; border-radius: 9999px; font-size: 0.65rem;
        font-weight: 800; letter-spacing: 0.2em; text-transform: uppercase; transition: all 0.2s ease;
    }
    .liquid-pagination nav[role="navigation"] > div:first-child { display: none; }
    .liquid-pagination nav[role="navigation"] > div:last-child { width: 100%; }
    .liquid-pagination nav[role="navigation"] ul { display: flex; justify-content: center; gap: 0.4rem; }
    .liquid-pagination nav[role="navigation"] li { list-style: none; }
    .liquid-pagination nav[role="navigation"] a,
    .liquid-pagination nav[role="navigation"] span {
        display: inline-flex; align-items: center; justify-content: center;
        border-radius: 9999px; border: 1px solid rgba(255, 255, 255, 0.8);
        background-color: rgba(255, 255, 255, 0.4); backdrop-filter: blur(8px);
        padding: 0.4rem 0.85rem; font-size: 0.65rem; letter-spacing: 0.2em; font-weight: 800;
        color: #1c1c1c; min-width: 2.2rem; transition: all 0.2s ease; text-decoration: none;
    }
    .liquid-pagination nav[role="navigation"] a:hover { color: #fff; background: #1c1c1c; border-color: #1c1c1c; }
    .liquid-pagination nav[role="navigation"] span[aria-current="page"] { background: #EA7645; color: #fff; border-color: transparent; }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const wrapper = document.getElementById('pageWrapper');
        if (wrapper) {
            wrapper.classList.remove('opacity-0');
            wrapper.classList.add('opacity-100');
        }
        document.body.classList.add('custom-scroll');
    });
</script>
@endsection