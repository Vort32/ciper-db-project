@extends('layouts.app')

@section('title', 'ADMIN PANEL - RHINE LAB.LLC')

@section('content')
<div id="pageWrapper" class="relative min-h-screen bg-[#ECE8E5] text-[#1c1c1c] py-12 px-4 sm:px-8 overflow-hidden transition-opacity duration-700 opacity-0" x-data="{ activeTab: 'users' }">
    
    <!-- Ambient Glass Background Glow & Grid -->
    <div class="fixed w-[50rem] h-[50rem] bg-white/70 rounded-full blur-[140px] -top-32 -left-32 z-0 pointer-events-none"></div>
    <div class="fixed w-[40rem] h-[40rem] bg-[#EA7645]/15 rounded-full blur-[120px] bottom-0 right-0 z-0 pointer-events-none"></div>
    <div class="fixed w-[30rem] h-[30rem] bg-[#48AA8C]/10 rounded-full blur-[100px] top-1/4 right-1/4 z-0 pointer-events-none"></div>
    <div class="fixed inset-0 bg-grid opacity-30 pointer-events-none z-0"></div>

    <!-- Header Left HUD -->
    <div class="absolute top-6 left-6 sm:left-8 z-20 space-y-0.5 select-none pre-animate" data-animate="animate-fade-right">
        <div class="flex items-center gap-3">
            <span class="bg-[#1c1c1c] text-white text-[9px] font-black px-2.5 py-1 tracking-widest uppercase shadow-md">ADMIN NODE</span>
            <h1 class="text-xl sm:text-2xl font-black tracking-widest text-[#1c1c1c]">RHINE LAB</h1>
        </div>
        <p class="text-[9px] tracking-[0.35em] uppercase font-bold text-gray-500 mt-1">SYSTEM MANAGEMENT OS</p>
    </div>

    <!-- Header Right Status -->
    <div class="absolute top-6 right-6 sm:right-8 z-20 pre-animate" data-animate="animate-fade-left">
        <a href="{{ url('/') }}" class="glass-btn inline-flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span>Ke Beranda</span>
        </a>
    </div>

    <!-- MAIN CONTENT -->
    <div class="relative z-10 max-w-7xl mx-auto mt-20 space-y-8">
        
        <!-- TITLE BAR & TAB SWITCHER -->
        <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 border-l-4 border-[#EA7645] pl-5 select-none pre-animate" data-animate="animate-fade-up">
            <div class="space-y-1.5">
                <p class="text-[9px] uppercase tracking-[0.4em] font-black text-[#EA7645]">RESTRICTED ADMINISTRATOR ACCESS</p>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tighter text-[#1c1c1c] uppercase drop-shadow-sm">Pusat Kendali Admin</h1>
            </div>
            
            <!-- Tab Buttons (HUD Style) -->
            <div class="flex flex-wrap items-center gap-2 bg-white/30 p-1.5 rounded-full border border-white/60 backdrop-blur-md shadow-sm">
                <button @click="activeTab = 'users'" 
                        :class="activeTab === 'users' ? 'bg-[#1c1c1c] text-white shadow-md' : 'text-gray-600 hover:bg-white/60'" 
                        class="px-5 py-2.5 rounded-full text-[10px] font-black tracking-[0.2em] uppercase transition-all duration-300">
                    Operatif <span class="ml-1 opacity-70">({{ $users->count() }})</span>
                </button>
                <button @click="activeTab = 'research'" 
                        :class="activeTab === 'research' ? 'bg-[#1c1c1c] text-white shadow-md' : 'text-gray-600 hover:bg-white/60'" 
                        class="px-5 py-2.5 rounded-full text-[10px] font-black tracking-[0.2em] uppercase transition-all duration-300">
                    Riset <span class="ml-1 opacity-70">({{ $records->count() }})</span>
                </button>
                <button @click="activeTab = 'materials'" 
                        :class="activeTab === 'materials' ? 'bg-[#1c1c1c] text-white shadow-md' : 'text-gray-600 hover:bg-white/60'" 
                        class="px-5 py-2.5 rounded-full text-[10px] font-black tracking-[0.2em] uppercase transition-all duration-300">
                    Material <span class="ml-1 opacity-70">({{ $materials->count() }})</span>
                </button>
            </div>
        </div>

        <!-- Alert Session Status -->
        @if (session('status'))
            <div class="pre-animate" data-animate="animate-fade-up">
                <div class="rounded-2xl border border-[#48AA8C]/50 bg-[#48AA8C]/10 backdrop-blur-md px-5 py-4 text-xs font-bold tracking-wide text-[#1f5f4c] flex items-center gap-3 shadow-sm">
                    <span class="h-2.5 w-2.5 rounded-full bg-[#48AA8C] animate-pulse"></span>
                    <span class="uppercase tracking-widest">{{ session('status') }}</span>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="pre-animate" data-animate="animate-fade-up">
                <div class="rounded-2xl border border-[#EA7645]/50 bg-[#EA7645]/10 backdrop-blur-md px-5 py-4 text-xs font-bold tracking-wide text-[#8a2e12] flex items-center gap-3 shadow-sm">
                    <span class="h-2.5 w-2.5 rounded-full bg-[#EA7645] animate-pulse"></span>
                    <span class="uppercase tracking-widest">{{ session('error') }}</span>
                </div>
            </div>
        @endif

        <!-- TAB 1: MANAJEMEN AKUN OPERATIF (USERS) -->
        <div x-show="activeTab === 'users'" x-transition.opacity.duration.500ms class="space-y-4" x-cloak>
            <div class="glass-panel p-2 sm:p-6 overflow-x-auto rounded-[2rem]">
                <table class="w-full text-left text-xs font-semibold text-gray-700 whitespace-nowrap">
                    <thead class="text-[9px] font-black uppercase tracking-[0.3em] text-gray-400 border-b-2 border-gray-300/40">
                        <tr>
                            <th class="pb-4 pl-4">Data Operatif</th>
                            <th class="pb-4">Jabatan</th>
                            <th class="pb-4">Organisasi</th>
                            <th class="pb-4 text-right pr-4">Otorisasi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-300/30">
                        @forelse ($users as $u)
                            <tr class="hover:bg-white/40 transition-colors duration-300 group">
                                <td class="py-4 pl-4 flex items-center gap-4">
                                    <div class="relative h-11 w-11 rounded-xl overflow-hidden border border-white/80 shadow-sm group-hover:scale-105 transition-transform duration-300">
                                        <img src="{{ asset($u->photo_path ?? 'images/users/Silence.png') }}" class="h-full w-full object-cover">
                                        <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors"></div>
                                    </div>
                                    <div>
                                        <p class="font-black text-[#1c1c1c] uppercase text-sm tracking-wide">{{ $u->name }}</p>
                                        <p class="text-[9px] text-[#EA7645] font-mono font-bold tracking-widest mt-0.5">USR-{{ str_pad($u->id, 3, '0', STR_PAD_LEFT) }}</p>
                                    </div>
                                </td>
                                <td class="py-4 uppercase font-extrabold text-gray-600 tracking-wider text-[10px]">{{ $u->position ?? 'Operatif' }}</td>
                                <td class="py-4">
                                    <span class="bg-gray-200/50 text-gray-600 border border-gray-300/50 px-3 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest">
                                        {{ $u->affiliation ?? 'RHINE LAB' }}
                                    </span>
                                </td>
                                <td class="py-4 text-right pr-4">
                                    @if ($u->id !== auth()->id())
                                        <form action="{{ route('admin.users.destroy', $u) }}" method="post" onsubmit="return confirm('Peringatan: Hapus akun operatif {{ $u->name }} secara permanen dari sistem?')" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="glass-btn glass-btn--danger">
                                                Hapus
                                            </button>
                                        </form>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 text-[9px] font-black text-[#48AA8C] tracking-[0.2em] uppercase bg-[#48AA8C]/10 px-4 py-2 rounded-full border border-[#48AA8C]/30 shadow-inner">
                                            <span class="w-1.5 h-1.5 rounded-full bg-[#48AA8C] animate-pulse"></span>
                                            Sesi Aktif
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-12 text-center text-gray-400 font-bold uppercase tracking-[0.3em] text-xs">Sistem tidak mendeteksi operatif lain.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- TAB 2: MANAJEMEN CATATAN RISET -->
        <div x-show="activeTab === 'research'" x-transition.opacity.duration.500ms class="space-y-6" x-cloak>
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                <p class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-500 border-l-2 border-gray-400 pl-3">Direktori Riset Global</p>
                <a href="{{ route('research-records.create') }}" class="glass-btn glass-btn--primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
                    Tambah Dokumen
                </a>
            </div>

            <div class="grid gap-5">
                @forelse ($records as $record)
                    <div class="glass-panel p-5 flex flex-col md:flex-row items-start md:items-center justify-between gap-5 group hover:border-white transition-colors duration-300 rounded-3xl">
                        <div class="space-y-2 flex-1">
                            <div class="flex flex-wrap items-center gap-2">
                                <span class="bg-[#1c1c1c] text-white text-[9px] font-black uppercase tracking-[0.25em] px-2.5 py-1 rounded-md shadow-sm">
                                    {{ $record->record_code }}
                                </span>
                                <span class="text-[9px] font-black tracking-widest uppercase border border-gray-300/80 bg-white/50 text-gray-600 px-2.5 py-1 rounded-md">
                                    CLASS: {{ strtoupper($record->classification) }}
                                </span>
                            </div>
                            <h3 class="text-lg font-black text-[#1c1c1c] uppercase tracking-wide group-hover:text-[#EA7645] transition-colors">{{ $record->project?->title ?? $record->record_code }}</h3>
                            <p class="text-[10px] uppercase font-bold tracking-widest text-gray-500">
                                Author: <span class="text-[#1c1c1c]">{{ $record->user?->name ?? 'UNKNOWN' }}</span>
                            </p>
                        </div>

                        <div class="flex items-center gap-2.5 w-full md:w-auto">
                            <a href="{{ route('research-records.show', $record) }}" class="glass-btn flex-1 md:flex-none text-center justify-center">Detail</a>
                            <a href="{{ route('research-records.edit', $record) }}" class="glass-btn glass-btn--primary flex-1 md:flex-none text-center justify-center">Edit</a>
                            <form action="{{ route('admin.research.destroy', $record) }}" method="post" class="flex-1 md:flex-none" onsubmit="return confirm('Hapus permanen catatan riset ini dari direktori utama?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="glass-btn glass-btn--danger w-full justify-center">Hapus</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="glass-panel p-16 text-center rounded-[2rem]">
                        <p class="text-gray-400 font-bold uppercase tracking-[0.3em] text-xs">Arsip catatan riset kosong.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- TAB 3: MANAJEMEN MATERIAL -->
        <div x-show="activeTab === 'materials'" x-transition.opacity.duration.500ms class="space-y-6" x-cloak>
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                <p class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-500 border-l-2 border-gray-400 pl-3">Inventaris Logistik & Material</p>
                <a href="{{ route('materials.create') }}" class="glass-btn glass-btn--primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
                    Tambah Material
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($materials as $mat)
                    <div class="glass-panel p-6 flex flex-col justify-between gap-5 rounded-[2rem] group hover:-translate-y-1 transition-all duration-300">
                        
                        <div class="flex items-start gap-4">
                            <!-- Icon/Preview Material -->
                            <div class="h-14 w-14 rounded-2xl bg-white/60 border border-white shadow-inner flex items-center justify-center flex-shrink-0 p-2 overflow-hidden">
                                @if($mat->file_path)
                                    <img src="{{ asset($mat->file_path) }}" alt="{{ $mat->name }}" class="h-full w-full object-contain filter drop-shadow-md group-hover:scale-110 transition-transform">
                                @else
                                    <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
                                @endif
                            </div>
                            
                            <div class="space-y-1.5 flex-1">
                                <p class="text-[9px] font-black uppercase tracking-widest text-[#48AA8C]">{{ $mat->category ?? 'MATERIAL' }}</p>
                                <h3 class="text-base font-black text-[#1c1c1c] uppercase tracking-wide leading-tight">{{ $mat->name }}</h3>
                                <p class="text-[10px] text-gray-500 font-bold uppercase tracking-wider">Tipe: {{ $mat->type ?? 'N/A' }} | Ukuran: {{ $mat->size ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="pt-4 border-t border-gray-300/50 mt-auto">
                            <!-- Aksi Edit & Hapus (SEKARANG SUDAH ADA EDIT) -->
                            <div class="flex items-center gap-2">
                                <a href="{{ route('materials.edit', $mat) }}" class="glass-btn flex-1 text-center justify-center !py-2 text-[9px]">Edit Data</a>
                                <form action="{{ route('admin.materials.destroy', $mat) }}" method="post" class="flex-1" onsubmit="return confirm('Peringatan: Buang material {{ $mat->name }} dari inventaris?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="glass-btn glass-btn--danger w-full justify-center !py-2 text-[9px]">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full glass-panel p-16 text-center rounded-[2rem]">
                        <p class="text-gray-400 font-bold uppercase tracking-[0.3em] text-xs">Inventaris logistik kosong.</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
    
    /* Background Pattern */
    .bg-grid {
        background-size: 35px 35px;
        background-image: 
            linear-gradient(to right, rgba(0, 0, 0, 0.04) 1px, transparent 1px),
            linear-gradient(to bottom, rgba(0, 0, 0, 0.04) 1px, transparent 1px);
    }

    /* Animasi Masuk */
    .pre-animate { opacity: 0; }
    @keyframes fadeUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes fadeRight { from { opacity: 0; transform: translateX(-20px); } to { opacity: 1; transform: translateX(0); } }
    @keyframes fadeLeft { from { opacity: 0; transform: translateX(20px); } to { opacity: 1; transform: translateX(0); } }
    
    .animate-fade-up { animation: fadeUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
    .animate-fade-right { animation: fadeRight 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
    .animate-fade-left { animation: fadeLeft 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }

    /* Liquid Glass Panels */
    .glass-panel {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.65), rgba(255, 255, 255, 0.25) 55%, rgba(255, 255, 255, 0.45));
        border: 1px solid rgba(255, 255, 255, 0.85);
        box-shadow: inset 0 1.5px 0 rgba(255, 255, 255, 0.95), 0 14px 24px -12px rgba(0, 0, 0, 0.08);
        backdrop-filter: blur(20px) saturate(1.2);
        -webkit-backdrop-filter: blur(20px) saturate(1.2);
    }

    /* Modern Buttons */
    .glass-btn {
        display: inline-flex; align-items: center; gap: 6px; padding: 0.5rem 1.2rem;
        border-radius: 9999px; font-size: 0.6rem; font-weight: 800; letter-spacing: 0.2em; text-transform: uppercase;
        background: rgba(255, 255, 255, 0.4); border: 1px solid rgba(255, 255, 255, 0.9); color: #1c1c1c;
        box-shadow: 0 4px 10px -4px rgba(0,0,0,0.05); transition: all 0.25s ease;
    }
    .glass-btn:hover {
        background: rgba(255, 255, 255, 0.9); transform: translateY(-2px); border-color: #fff;
        box-shadow: 0 8px 15px -5px rgba(0,0,0,0.1);
    }
    
    .glass-btn--primary {
        background: linear-gradient(135deg, #1c1c1c, #2a2a2a); color: #fff; border-color: #1c1c1c;
    }
    .glass-btn--primary:hover {
        background: linear-gradient(135deg, #EA7645, #d66031); color: #fff; border-color: #EA7645;
        box-shadow: 0 8px 15px -5px rgba(234, 118, 69, 0.4);
    }

    .glass-btn--danger {
        color: #EA7645; border-color: rgba(234, 118, 69, 0.4); background: rgba(234, 118, 69, 0.05);
    }
    .glass-btn--danger:hover {
        background: #EA7645; color: #fff; border-color: #EA7645;
        box-shadow: 0 8px 15px -5px rgba(234, 118, 69, 0.4);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const wrapper = document.getElementById('pageWrapper');
        if (wrapper) {
            wrapper.classList.remove('opacity-0');
            wrapper.classList.add('opacity-100');
        }

        // Delay animasi untuk elemen pre-animate
        const animatedElems = document.querySelectorAll('.pre-animate');
        animatedElems.forEach((elem, index) => {
            const animationClass = elem.getAttribute('data-animate');
            elem.style.animationDelay = `${0.3 + (index * 0.15)}s`;
            requestAnimationFrame(() => elem.classList.add(animationClass));
        });
    });
</script>
@endsection