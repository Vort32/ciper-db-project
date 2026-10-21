@extends('layouts.app')

@section('title', 'Material Registry - RHINE LAB.LLC')

@section('content')
<div id="pageWrapper" class="relative min-h-screen bg-[#ECE8E5] text-[#222] py-16 px-4 sm:px-6 overflow-hidden transition-opacity duration-700 opacity-0">
    
    <!-- Background Ambient Glow -->
    <div class="absolute w-[45rem] h-[45rem] bg-white/50 rounded-full blur-[120px] -top-20 -left-20 z-0 pointer-events-none"></div>
    <div class="absolute w-[35rem] h-[35rem] bg-[#48AA8C]/10 rounded-full blur-[90px] bottom-10 right-10 z-0 pointer-events-none"></div>
    <div class="absolute inset-0 bg-cover bg-center opacity-5 pointer-events-none" style="background-image: url('{{ asset('images/Rhine_Lab_HQ1.png') }}');"></div>

    <!-- Header HUD -->
    <div class="absolute top-6 left-6 z-20 space-y-1 select-none">
        <h1 class="text-2xl font-bold">RHINE LAB</h1>
        <p class="text-[10px] tracking-[0.2em] uppercase font-bold text-gray-600">MATERIAL REGISTRY SYSTEM</p>
        <p class="text-base sm:text-lg md:text-xl">INVENTORY <span class="font-bold">OS</span></p>
    </div>

    <!-- Header Kanan Atas Status -->
    <div class="absolute top-6 right-6 z-20 flex items-center space-x-2 text-xs sm:text-sm font-bold tracking-wider text-gray-700 select-none">
        <span>SYNCING ASSETS</span>
        <span class="flex space-x-1">
            <span class="h-1.5 w-1.5 rounded-full bg-[#EA7645] animate-bounce"></span>
            <span class="h-1.5 w-1.5 rounded-full bg-[#C8B9A9] animate-bounce [animation-delay:200ms]"></span>
            <span class="h-1.5 w-1.5 rounded-full bg-[#48AA8C] animate-bounce [animation-delay:400ms]"></span>
        </span>
    </div>

    <!-- MAIN CONTAINER -->
    <div class="relative z-10 max-w-7xl mx-auto mt-12 space-y-8">
        
        <!-- Header Judul Form -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 border-l-4 border-[#48AA8C] pl-4 select-none">
            <div class="space-y-2">
                <p class="text-[10px] uppercase tracking-[0.42em] font-bold text-gray-500">Database Inventaris</p>
                <h1 class="text-3xl sm:text-4xl font-black tracking-widest text-[#1f1f1f] uppercase">Kelola Material</h1>
                <p class="text-xs sm:text-sm text-gray-600 font-medium">Registrasi, modifikasi, dan pantau komponen material riset operatif.</p>
            </div>
            <a href="{{ url('/') }}" class="action-button action-button--secondary text-[10px]">
                <span>Ke Beranda</span>
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- FORM TAMBAH / EDIT MATERIAL -->
            <div class="lg:col-span-1">
                <div class="relative rounded-3xl border border-white/80 bg-white/40 backdrop-blur-[20px] p-6 shadow-[0_25px_50px_rgba(0,0,0,0.05)] overflow-hidden">
                    <div class="absolute inset-0 hex-bg opacity-25 pointer-events-none"></div>
                    
                    <div class="relative z-10 mb-6 border-b border-white/60 pb-4">
                        <h2 id="formTitle" class="text-lg font-black tracking-widest text-[#1f1f1f] uppercase">Registrasi Baru</h2>
                        <p class="text-[9px] font-bold uppercase tracking-[0.2em] text-gray-500">Input Data Komponen</p>
                    </div>

                    <form id="materialForm" action="{{ route('materials.store') }}" method="post" enctype="multipart/form-data" class="relative z-10 space-y-5">
                        @csrf
                        <input type="hidden" name="_method" id="formMethod" value="POST">

                        <!-- Nama Material -->
                        <label class="block text-left">
                            <span class="text-[9px] font-black uppercase tracking-[0.25em] text-gray-600">Nama Material</span>
                            <input type="text" name="name" id="matName" required class="glass-input mt-1.5 w-full rounded-xl border border-white/80 bg-white/50 px-4 py-2.5 text-xs font-bold tracking-wider text-[#1f1f1f] shadow-sm focus:border-[#48AA8C] focus:outline-none focus:ring-2 focus:ring-[#48AA8C]/20" placeholder="Contoh: Orirock Cube">
                        </label>

                        <!-- Dropdown Kategori & Tipe -->
                        <div class="grid grid-cols-2 gap-4">
                            <label class="block text-left">
                                <span class="text-[9px] font-black uppercase tracking-[0.25em] text-gray-600">Kategori</span>
                                <div class="mt-1.5 select-wrapper">
                                    <select name="category" id="matCategory" required class="glass-input custom-scroll appearance-none w-full rounded-xl border border-white/80 bg-white/50 px-3 py-2.5 pr-8 text-xs font-bold tracking-wider text-[#1f1f1f] shadow-sm focus:border-[#48AA8C] focus:outline-none">
                                        <option value="Data">Data</option>
                                        <option value="Research">Research</option>
                                        <option value="Materials">Materials</option>
                                        <option value="Engineering">Engineering</option>
                                    </select>
                                    <span class="select-arrow">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                                    </span>
                                </div>
                            </label>
                            
                            <label class="block text-left">
                                <span class="text-[9px] font-black uppercase tracking-[0.25em] text-gray-600">Tipe / Ekstensi</span>
                                <div class="mt-1.5 select-wrapper">
                                    <select name="type" id="matType" required class="glass-input custom-scroll appearance-none w-full rounded-xl border border-white/80 bg-white/50 px-3 py-2.5 pr-8 text-xs font-bold tracking-wider text-[#1f1f1f] shadow-sm focus:border-[#48AA8C] focus:outline-none">
                                        <option value="Disk">Disk</option>
                                        <option value="PDF">PDF</option>
                                        <option value="Material">Material</option>
                                        <option value="Image">Image</option>
                                    </select>
                                    <span class="select-arrow">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                                    </span>
                                </div>
                            </label>
                        </div>

                        <!-- Unggah File Gambar (Ukuran dihitung otomatis) -->
                        <label class="block text-left">
                            <span class="text-[9px] font-black uppercase tracking-[0.25em] text-gray-600">File Icon / Gambar</span>
                            <input type="file" name="file" id="matFile" accept="image/*" class="glass-input mt-1.5 w-full rounded-xl border border-dashed border-white/80 bg-white/30 px-3 py-2 text-[10px] font-bold tracking-wide text-[#1f1f1f] shadow-sm focus:border-[#48AA8C] focus:outline-none">
                            <span class="mt-1 block text-[8px] font-bold tracking-widest text-gray-500 uppercase">Ukuran file akan terdeteksi otomatis.</span>
                        </label>

                        <div class="pt-4 flex flex-col gap-2 border-t border-white/60">
                            <button type="submit" id="btnSubmit" class="action-button action-button--primary w-full justify-center text-[10px]">
                                <span>Simpan Material</span>
                            </button>
                            <button type="button" id="btnCancelEdit" class="hidden action-button action-button--secondary w-full justify-center text-[10px]">
                                <span>Batal Edit</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- GRID INVENTORY MATERIAL -->
            <div class="lg:col-span-2 space-y-4">
                <div class="flex items-center justify-between border-b border-white/60 pb-3">
                    <h2 class="text-sm font-black tracking-widest text-[#1f1f1f] uppercase">Inventory Database</h2>
                    <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#48AA8C]">Total: {{ isset($materials) ? count($materials) : 0 }} Entitas</span>
                </div>

                @if(isset($materials) && count($materials) > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4">
                        <?php foreach ($materials as$material): ?>
                            <div class="material-card group relative flex flex-col justify-between rounded-2xl border border-white/80 bg-white/40 backdrop-blur-md p-4 transition-all duration-300 hover:bg-white/70 hover:shadow-lg overflow-hidden">
                                
                                <div class="flex items-start gap-4 z-10">
                                    <div class="h-12 w-12 flex-shrink-0 rounded-xl bg-white/80 border border-white p-1.5 shadow-sm flex items-center justify-center">
                                        <img src="{{ asset($material->file_path) }}" alt="{{ $material->name }}" class="h-full w-full object-contain filter group-hover:scale-110 transition-transform">
                                    </div>
                                    <div class="overflow-hidden pr-2">
                                        <p class="text-sm font-black uppercase tracking-wider text-[#1f1f1f] truncate">{{ $material->name }}</p>
                                        <p class="text-[10px] font-bold text-[#EA7645] tracking-widest uppercase">{{ $material->category ?? 'DATA' }}</p>
                                    </div>
                                </div>

                                <div class="mt-4 flex justify-between items-center text-[9px] font-black uppercase tracking-widest text-gray-500 z-10">
                                    <span class="border border-white/60 bg-white/40 px-2 py-0.5 rounded">{{ $material->type }}</span>
                                    <span class="text-[#48AA8C]">{{ $material->size }}</span>
                                </div>

                                <div class="absolute inset-0 bg-white/80 backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-3 z-20">
                                    <button type="button" 
                                        onclick="editMaterial({{ $material->id }}, '{{$material->name }}', '{{ $material->category }}', '{{$material->type }}')"
                                        class="rounded-full bg-[#1c1c1c] text-white px-4 py-1.5 text-[9px] font-bold tracking-widest uppercase transition hover:bg-[#48AA8C]">
                                        Edit
                                    </button>

                                    <form action="{{ route('materials.destroy', $material->id) }}" method="post" class="inline" onsubmit="return confirm('Hapus material ini dari database?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="rounded-full border border-[#EA7645] text-[#EA7645] px-4 py-1.5 text-[9px] font-bold tracking-widest uppercase transition hover:bg-[#EA7645] hover:text-white">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                @else
                    <div class="rounded-3xl border border-white/40 bg-white/20 px-6 py-16 text-center shadow-sm backdrop-blur-xl">
                        <p class="text-[11px] uppercase tracking-[0.32em] font-bold text-gray-500">Database Kosong</p>
                        <p class="mt-2 text-sm font-semibold text-[#1f1f1f]">Belum ada material yang diregistrasi ke dalam sistem.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    .hex-bg {
        background-color: transparent;
        background-image: url("data:image/svg+xml,%3Csvg width='40' height='69.282' viewBox='0 0 40 69.282' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M40 11.547L20 0 0 11.547v23.094l20 11.547 20-11.547V11.547zM20 45.034L1.155 34.148V12.376L20 1.49l18.845 10.886v21.772L20 45.034z' fill='%23000000' fill-opacity='0.04' fill-rule='evenodd'/%3E%3Cpath d='M40 46.188L20 34.641 0 46.188v23.094l20 11.547 20-11.547V46.188zM20 79.675L1.155 68.789V47.017L20 36.13l18.845 10.886v21.772L20 79.675z' fill='%23000000' fill-opacity='0.04' fill-rule='evenodd'/%3E%3C/svg%3E");
        background-size: 60px 103.923px;
    }

    .glass-input {
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        transition: all 0.3s ease;
    }

    .select-wrapper { position: relative; }
    .select-arrow {
        position: absolute;
        right: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
        color: #1f1f1f;
        opacity: 0.6;
    }

    .action-button {
        display: inline-flex;
        align-items: center;
        gap: 0.65rem;
        border-radius: 9999px;
        border: 1px solid rgba(255, 255, 255, 0.8);
        padding: 0.65rem 1.5rem;
        font-size: 0.7rem;
        letter-spacing: 0.3em;
        text-transform: uppercase;
        font-weight: 800;
        color: #1f1f1f;
        background: rgba(255, 255, 255, 0.5);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
    }

    .action-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    }

    .action-button--primary {
        background-image: linear-gradient(135deg, #1c1c1c, #2d2d2d);
        color: #fff;
        border-color: #1c1c1c;
    }

    .action-button--primary:hover {
        background-image: linear-gradient(135deg, #48AA8C, #368a70);
        border-color: #48AA8C;
        color: #fff;
    }

    .action-button--secondary:hover {
        background: rgba(255, 255, 255, 0.85);
        color: #EA7645;
    }
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

    function editMaterial(id, name, category, type) {
        document.getElementById('formTitle').innerText = 'Modifikasi Material';
        
        document.getElementById('materialForm').action = `/materials/${id}`;
        document.getElementById('formMethod').value = 'PUT';

        document.getElementById('matName').value = name;
        document.getElementById('matCategory').value = category;
        document.getElementById('matType').value = type;

        document.getElementById('btnSubmit').querySelector('span').innerText = 'Update Material';
        document.getElementById('btnCancelEdit').classList.remove('hidden');

        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    document.getElementById('btnCancelEdit').addEventListener('click', () => {
        document.getElementById('formTitle').innerText = 'Registrasi Baru';
        
        document.getElementById('materialForm').action = `{{ route('materials.store') }}`;
        document.getElementById('formMethod').value = 'POST';

        document.getElementById('materialForm').reset();
        
        document.getElementById('btnSubmit').querySelector('span').innerText = 'Simpan Material';
        document.getElementById('btnCancelEdit').classList.add('hidden');
    });
</script>
@endsection