@extends('layouts.app')

@section('title', 'ADMIN PANEL - RHINE LAB.LLC')

@section('content')
<div id="pageWrapper" class="relative min-h-screen bg-[#ECE8E5] text-[#1c1c1c] py-12 px-4 sm:px-8 overflow-hidden transition-opacity duration-700 opacity-0" x-data="{ activeTab: 'users' }">
    
    <!-- Ambient Glass Background Glow -->
    <div class="absolute w-[45rem] h-[45rem] bg-white/40 rounded-full blur-[130px] -top-24 -left-24 z-0 pointer-events-none"></div>
    <div class="absolute w-[35rem] h-[35rem] bg-[#EA7645]/10 rounded-full blur-[100px] bottom-10 right-10 z-0 pointer-events-none"></div>

    <!-- Header Left HUD -->
    <div class="absolute top-6 left-6 sm:left-8 z-20 space-y-0.5 select-none">
        <div class="flex items-center gap-2">
            <h1 class="text-xl sm:text-2xl font-black tracking-widest text-[#1c1c1c]">RHINE LAB</h1>
            <span class="bg-[#EA7645] text-white text-[8px] font-black px-2 py-0.5 tracking-widest uppercase">ADMIN NODE</span>
        </div>
        <p class="text-[9px] tracking-[0.25em] uppercase font-bold text-gray-500">SYSTEM MANAGEMENT OS</p>
    </div>

    <!-- Header Right Status -->
    <div class="absolute top-6 right-6 sm:right-8 z-20 flex items-center space-x-2 text-xs font-bold tracking-wider text-gray-600 select-none">
        <a href="{{ url('/') }}" class="nav-pill">
            <span>&larr; Ke Beranda</span>
        </a>
    </div>

    <!-- MAIN CONTENT -->
    <div class="relative z-10 max-w-7xl mx-auto mt-16 space-y-8">
        
        <!-- TITLE BAR & TAB SWITCHER -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 border-l-2 border-[#1c1c1c] pl-5 select-none">
            <div class="space-y-1">
                <p class="text-[9px] uppercase tracking-[0.4em] font-black text-gray-400">RESTRICTED ADMINISTRATOR ACCESS</p>
                <h1 class="text-3xl sm:text-4xl font-black tracking-wider text-[#1c1c1c] uppercase">Pusat Kendali Admin</h1>
            </div>
            
            <!-- Tab Buttons -->
            <div class="flex flex-wrap items-center gap-2">
                <button @click="activeTab = 'users'" :class="activeTab === 'users' ? 'nav-pill--active' : ''" class="nav-pill">
                    <span>Manajemen Operatif ({{ $users->count() }})</span>
                </button>
                <button @click="activeTab = 'research'" :class="activeTab === 'research' ? 'nav-pill--active' : ''" class="nav-pill">
                    <span>Catatan Riset ({{ $records->count() }})</span>
                </button>
                <button @click="activeTab = 'materials'" :class="activeTab === 'materials' ? 'nav-pill--active' : ''" class="nav-pill">
                    <span>Material ({{ $materials->count() }})</span>
                </button>
            </div>
        </div>

        <!-- Alert Session Status -->
        @if (session('status'))
            <div class="rounded-2xl border border-[#48AA8C]/40 bg-[#48AA8C]/15 backdrop-blur-md px-5 py-3.5 text-xs font-bold tracking-wide text-[#1f5f4c] flex items-center gap-3">
                <span class="h-2 w-2 rounded-full bg-[#48AA8C]"></span>
                <span>{{ session('status') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="rounded-2xl border border-[#EA7645]/40 bg-[#EA7645]/15 backdrop-blur-md px-5 py-3.5 text-xs font-bold tracking-wide text-[#8a2e12] flex items-center gap-3">
                <span class="h-2 w-2 rounded-full bg-[#EA7645]"></span>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <!-- TAB 1: MANAJEMEN AKUN OPERATIF (USERS) -->
        <div x-show="activeTab === 'users'" class="space-y-4">
            <div class="glass-card p-6 overflow-x-auto">
                <table class="w-full text-left text-xs font-semibold text-gray-700">
                    <thead class="text-[9px] font-black uppercase tracking-[0.25em] text-gray-400 border-b border-gray-300/60 pb-3">
                        <tr>
                            <th class="pb-3">ID / Operatif</th>
                            <th class="pb-3">Jabatan</th>
                            <th class="pb-3">Divisi / Affiliation</th>
                            <th class="pb-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-300/40">
                        @forelse ($users as $u)
                            <tr class="hover:bg-white/40 transition-colors">
                                <td class="py-4 flex items-center gap-3">
                                    <img src="{{ asset($u->photo_path ?? 'images/users/Silence.png') }}" class="h-9 w-9 rounded-xl object-cover border border-white/80">
                                    <div>
                                        <p class="font-black text-[#1c1c1c] uppercase">{{ $u->name }}</p>
                                        <p class="text-[9px] text-gray-500 font-mono">USR-{{ str_pad($u->id, 3, '0', STR_PAD_LEFT) }}</p>
                                    </div>
                                </td>
                                <td class="py-4 uppercase font-bold text-gray-600">{{ $u->position ?? 'Operatif' }}</td>
                                <td class="py-4 uppercase font-bold text-gray-600">{{ $u->affiliation ?? 'RHINE LAB' }}</td>
                                <td class="py-4 text-right">
                                    @if ($u->id !== auth()->id())
                                        <form action="{{ route('admin.users.destroy', $u) }}" method="post" onsubmit="return confirm('Hapus akun operatif {{ $u->name }} secara permanen?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action border border-[#EA7645] text-[#EA7645] hover:bg-[#EA7645] hover:text-white">
                                                Hapus Akun
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-[9px] font-bold text-[#48AA8C] tracking-widest uppercase bg-[#48AA8C]/10 px-3 py-1 rounded-full border border-[#48AA8C]/30">Sesi Aktif</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-8 text-center text-gray-400 font-bold uppercase tracking-widest">Tidak ada akun operatif terdaftar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- TAB 2: MANAJEMEN CATATAN RISET -->
        <div x-show="activeTab === 'research'" class="space-y-4" x-cloak>
            <div class="flex justify-between items-center mb-2">
                <p class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-500">Daftar Seluruh Catatan Riset Operatif</p>
                <a href="{{ route('research-records.create') }}" class="btn-action bg-[#1c1c1c] text-white hover:bg-[#EA7645]">
                    + Tambah Catatan Baru
                </a>
            </div>

            <div class="grid gap-4">
                @forelse ($records as $record)
                    <div class="glass-card p-5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                        <div class="space-y-1">
                            <div class="flex items-center gap-2">
                                <span class="text-[10px] font-black uppercase tracking-[0.25em] text-[#EA7645]">{{ $record->record_code }}</span>
                                <span class="text-[8px] font-black tracking-widest uppercase border border-gray-300 text-gray-600 px-2 py-0.5 rounded-full">
                                    {{ strtoupper($record->classification) }}
                                </span>
                            </div>
                            <h3 class="text-base font-black text-[#1c1c1c] uppercase">{{ $record->project?->title ?? $record->record_code }}</h3>
                            <p class="text-xs text-gray-500">Operatif: <span class="font-bold text-gray-800">{{ $record->user?->name ?? 'N/A' }}</span></p>
                        </div>

                        <div class="flex items-center gap-2">
                            <a href="{{ route('research-records.show', $record) }}" class="btn-action border border-gray-300 text-gray-700 hover:bg-gray-200">
                                Detail
                            </a>
                            <a href="{{ route('research-records.edit', $record) }}" class="btn-action bg-[#1c1c1c] text-white hover:bg-[#EA7645]">
                                Edit
                            </a>
                            <form action="{{ route('admin.research.destroy', $record) }}" method="post" onsubmit="return confirm('Hapus permanen catatan riset ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action border border-[#EA7645] text-[#EA7645] hover:bg-[#EA7645] hover:text-white">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="glass-card p-12 text-center text-gray-400 font-bold uppercase tracking-widest">
                        Belum ada catatan riset terarsip.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- TAB 3: MANAJEMEN MATERIAL -->
        <div x-show="activeTab === 'materials'" class="space-y-4" x-cloak>
            <div class="flex justify-between items-center mb-2">
                <p class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-500">Inventaris Material Riset</p>
                <a href="{{ route('materials.create') }}" class="btn-action bg-[#1c1c1c] text-white hover:bg-[#EA7645]">
                    + Tambah Material Baru
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse ($materials as $mat)
                    <div class="glass-card p-5 flex flex-col justify-between gap-4">
                        <div class="space-y-2">
                            <p class="text-[9px] font-black uppercase tracking-widest text-[#48AA8C]">{{ $mat->category ?? 'MATERIAL' }}</p>
                            <h3 class="text-lg font-black text-[#1c1c1c] uppercase">{{ $mat->name }}</h3>
                            <p class="text-xs text-gray-600 line-clamp-2">{{ $mat->description ?? 'Tidak ada deskripsi.' }}</p>
                        </div>

                        <div class="flex items-center justify-between border-t border-gray-300/60 pt-3">
                            <span class="text-[10px] font-bold text-gray-500 uppercase">Stok: {{ $mat->stock ?? 0 }}</span>
                            <form action="{{ route('admin.materials.destroy', $mat) }}" method="post" onsubmit="return confirm('Hapus material riset ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action border border-[#EA7645] text-[#EA7645] hover:bg-[#EA7645] hover:text-white">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full glass-card p-12 text-center text-gray-400 font-bold uppercase tracking-widest">
                        Tidak ada data material.
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
    .glass-card {
        background: rgba(255, 255, 255, 0.45);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        border: 1px solid rgba(255, 255, 255, 0.8);
        border-radius: 1.25rem;
    }
    .nav-pill {
        display: inline-flex; align-items: center; padding: 0.5rem 1.25rem;
        border-radius: 9999px; background: rgba(255, 255, 255, 0.5);
        border: 1px solid rgba(255, 255, 255, 0.8); font-size: 0.65rem;
        font-weight: 800; letter-spacing: 0.22em; text-transform: uppercase;
        color: #1c1c1c; backdrop-filter: blur(10px); transition: all 0.25s ease;
    }
    .nav-pill:hover { background: rgba(255, 255, 255, 0.9); color: #EA7645; }
    .nav-pill--active { background: #1c1c1c !important; color: #fff !important; border-color: #1c1c1c !important; }
    .btn-action {
        padding: 0.45rem 1.1rem; border-radius: 9999px; font-size: 0.65rem;
        font-weight: 800; letter-spacing: 0.2em; text-transform: uppercase; transition: all 0.2s ease;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const wrapper = document.getElementById('pageWrapper');
        if (wrapper) {
            wrapper.classList.remove('opacity-0');
            wrapper.classList.add('opacity-100');
        }
    });
</script>
@endsection