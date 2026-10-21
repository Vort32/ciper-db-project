@extends('layouts.app')

@section('title', 'Catatan Riset Baru - RHINE LAB.LLC')

@section('content')
<div id="pageWrapper" class="relative min-h-screen bg-[#ECE8E5] text-[#222] py-16 px-4 sm:px-6 overflow-hidden transition-opacity duration-700 opacity-0">
    
    <!-- Background Ambient Glow & HQ Watermark -->
    <div class="absolute w-[45rem] h-[45rem] bg-white/50 rounded-full blur-[120px] -top-20 -left-20 z-0 pointer-events-none"></div>
    <div class="absolute w-[35rem] h-[35rem] bg-[#EA7645]/10 rounded-full blur-[90px] bottom-10 right-10 z-0 pointer-events-none"></div>
    <div class="absolute inset-0 bg-cover bg-center opacity-5 pointer-events-none" style="background-image: url('{{ asset('images/Rhine_Lab_HQ1.png') }}');"></div>

    <!-- Header HUD -->
    <div class="absolute top-6 left-6 z-20 space-y-1 select-none">
        <h1 class="text-2xl font-bold">RHINE LAB</h1>
        <p class="text-[10px] tracking-[0.2em] uppercase font-bold text-gray-600">RESEARCH LOG ENTRY</p>
        <p class="text-base sm:text-lg md:text-xl">ANALYSIS <span class="font-bold">OS</span></p>
    </div>

    <div class="absolute top-6 right-6 z-20 flex items-center space-x-2 text-xs sm:text-sm font-bold tracking-wider text-gray-700 select-none">
        <span>LOGGING SYSTEM</span>
        <span class="flex space-x-1">
            <span class="h-1.5 w-1.5 rounded-full bg-[#EA7645] animate-bounce"></span>
            <span class="h-1.5 w-1.5 rounded-full bg-[#C8B9A9] animate-bounce [animation-delay:200ms]"></span>
            <span class="h-1.5 w-1.5 rounded-full bg-[#48AA8C] animate-bounce [animation-delay:400ms]"></span>
        </span>
    </div>

    <div class="relative z-10 max-w-5xl mx-auto mt-12 space-y-8">
        
        <div class="select-none space-y-2 border-l-4 border-[#EA7645] pl-4">
            <p class="text-[10px] uppercase tracking-[0.42em] font-bold text-gray-500">Formulir Catatan Riset Operatif</p>
            <h1 class="text-3xl sm:text-4xl font-black tracking-widest text-[#1f1f1f] uppercase">Buat Catatan Baru</h1>
            <p class="text-xs sm:text-sm text-gray-600 font-medium">Dokumentasikan temuan, eksperimen, serta komponen riset divisi Anda.</p>
        </div>

        <div class="relative rounded-3xl border border-white/80 bg-white/40 backdrop-blur-[20px] p-6 sm:p-10 shadow-[0_25px_50px_rgba(0,0,0,0.05)] overflow-hidden">
            
            <div class="absolute inset-0 hex-bg opacity-25 pointer-events-none"></div>

            <form action="{{ route('research-records.store') }}" method="post" enctype="multipart/form-data" class="relative z-10 space-y-8">
                @csrf
                <?php $userDivisionId = old('division_id'); ?>

                <!-- SECTION 0: JUDUL CATATAN / PROYEK RISET -->
                <label class="block text-left space-y-2">
                    <span class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-600">00 / Judul Catatan Riset</span>
                    <input type="text" name="title" value="{{ old('title') }}" required placeholder="Contoh: PROYEK UTAMA CYBER SECURITY & NETWORK ENGINEERING"
                        class="glass-input w-full rounded-2xl border border-white/80 bg-white/50 px-5 py-3.5 text-xs font-black uppercase tracking-wider text-[#1f1f1f] shadow-sm focus:border-[#EA7645] focus:outline-none focus:ring-2 focus:ring-[#EA7645]/20">
                    @error('title')
                        <span class="mt-1 block text-xs font-bold text-[#EA7645] tracking-wide">{{ $message }}</span>
                    @enderror
                </label>

                <!-- SECTION 1: DIVISI RISET -->
                <div class="grid gap-6 md:grid-cols-2">
                    <label class="block text-left">
                        <span class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-600">01 / Divisi Riset</span>
                        <div class="mt-2 select-wrapper">
                            <select id="divisionSelect" name="division_id" data-selected="{{ $userDivisionId }}" required class="glass-input custom-scroll appearance-none w-full rounded-2xl border border-white/80 bg-white/50 px-4 py-3.5 pr-12 text-sm font-semibold tracking-wide text-[#1f1f1f] shadow-sm focus:border-[#EA7645] focus:outline-none focus:ring-2 focus:ring-[#EA7645]/20">
                                <option value="" disabled {{ !$userDivisionId ? 'selected' : '' }}>Pilih Divisi Riset</option>
                                <?php foreach ($divisions as$division): ?>
                                    <option value="{{ $division['id'] }}" 
                                            data-lead="{{ $division['lead_scientist'] ?? 'Dosen Pembina' }}" 
                                            data-code="{{ $division['code'] ?? 'DIV' }}" 
                                            {{ $userDivisionId ==$division['id'] ? 'selected' : '' }}>
                                        {{ $division['code'] ? $division['code'].' — ' : '' }}{{$division['name'] }}
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <span class="select-arrow">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </div>
                        @error('division_id')
                            <span class="mt-1 block text-xs font-bold text-[#EA7645] tracking-wide">{{ $message }}</span>
                        @enderror
                    </label>

                    <div class="rounded-2xl border border-dashed border-white/80 bg-white/30 backdrop-blur-md px-5 py-4 text-left flex flex-col justify-center">
                        <p class="text-[9px] uppercase tracking-[0.32em] font-black text-gray-500">Identifikasi Divisi Terintegrasi</p>
                        <p id="divisionLeadPreview" class="mt-2 text-[10px] uppercase font-bold tracking-widest text-[#1f1f1f] leading-relaxed">Kode Divisi: — • Penanggung Jawab: —</p>
                    </div>
                </div>

                <!-- SECTION 2: MATERIAL EKSPERIMEN -->
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-600">02 / Material Riset &amp; Komponen</span>
                        <span class="text-[9px] font-bold uppercase tracking-[0.2em] text-gray-400">PILIH MATERIAL TERHUBUNG</span>
                    </div>

                    <?php if (isset($materials) && count($materials) > 0): ?>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                            <?php foreach ($materials as$material): ?>
                                <label class="material-card group relative flex flex-col justify-between rounded-2xl border border-white/80 bg-white/40 backdrop-blur-md p-3.5 cursor-pointer transition-all duration-300 hover:bg-white/70 hover:shadow-md select-none">
                                    <input type="checkbox" name="material_ids[]" value="{{ $material->id }}" class="hidden peer" {{ in_array($material->id, old('material_ids', [])) ? 'checked' : '' }}>
                                    
                                    <div class="absolute top-2.5 right-2.5 h-4 w-4 rounded-full border border-gray-400/60 bg-white/60 peer-checked:bg-[#EA7645] peer-checked:border-[#EA7645] transition-colors duration-300 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-2.5 w-2.5 text-white opacity-0 peer-checked:opacity-100 transition-opacity" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>

                                    <div class="flex items-center gap-3">
                                        <div class="h-10 w-10 flex-shrink-0 rounded-xl bg-white/80 border border-white p-1.5 shadow-sm overflow-hidden flex items-center justify-center">
                                            <img src="{{ asset($material->file_path) }}" alt="{{ $material->name }}" class="h-full w-full object-contain filter group-hover:scale-110 transition-transform">
                                        </div>
                                        <div class="overflow-hidden pr-3">
                                            <p class="text-xs font-black uppercase tracking-wider text-[#1f1f1f] truncate">{{ $material->name }}</p>
                                            <p class="text-[9px] font-bold text-gray-500 tracking-widest uppercase">{{ $material->category ?? 'DATA' }}</p>
                                        </div>
                                    </div>

                                    <div class="mt-3 pt-2 border-t border-gray-300/40 flex justify-between items-center text-[8px] font-black uppercase tracking-widest text-gray-500">
                                        <span>TYPE: {{ $material->type }}</span>
                                        <span class="text-[#48AA8C]">{{ $material->size }}</span>
                                    </div>

                                    <div class="absolute inset-0 rounded-2xl border-2 border-transparent peer-checked:border-[#EA7645] pointer-events-none transition-colors"></div>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- SECTION 3: KLASIFIKASI, STATUS, & TANGGAL -->
                <div class="grid gap-6 md:grid-cols-3">
                    <label class="block text-left">
                        <span class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-600">03 / Akses Kerahasiaan</span>
                        <div class="mt-2 select-wrapper">
                            <select name="classification" required class="glass-input custom-scroll appearance-none w-full rounded-2xl border border-white/80 bg-white/50 px-4 py-3.5 pr-12 text-xs font-bold tracking-widest text-[#1f1f1f] shadow-sm focus:border-[#EA7645] focus:outline-none focus:ring-2 focus:ring-[#EA7645]/20">
                                <?php foreach ($classifications as$classification): ?>
                                    <option value="{{ $classification }}" {{ old('classification') === $classification ? 'selected' : '' }}>{{ strtoupper($classification) }}</option>
                                <?php endforeach; ?>
                            </select>
                            <span class="select-arrow">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </div>
                    </label>

                    <label class="block text-left">
                        <span class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-600">04 / Status Revisi</span>
                        <div class="mt-2 select-wrapper">
                            <select name="status" required class="glass-input custom-scroll appearance-none w-full rounded-2xl border border-white/80 bg-white/50 px-4 py-3.5 pr-12 text-xs font-bold tracking-widest text-[#1f1f1f] shadow-sm focus:border-[#EA7645] focus:outline-none focus:ring-2 focus:ring-[#EA7645]/20">
                                <?php foreach ($statuses as$status): ?>
                                    <option value="{{ $status }}" {{ old('status') === $status ? 'selected' : '' }}>{{ strtoupper(str_replace('_', ' ', $status)) }}</option>
                                <?php endforeach; ?>
                            </select>
                            <span class="select-arrow">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </div>
                    </label>

                    <label class="block text-left">
                        <span class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-600">05 / Tanggal Pencatatan</span>
                        <input type="date" name="recorded_at" value="{{ old('recorded_at') ?? date('Y-m-d') }}"
                            class="glass-input mt-2 w-full rounded-2xl border border-white/80 bg-white/50 px-4 py-3 text-xs font-bold tracking-wider text-[#1f1f1f] shadow-sm focus:border-[#EA7645] focus:outline-none focus:ring-2 focus:ring-[#EA7645]/20">
                    </label>
                </div>

                <!-- SECTION 4: RINGKASAN TEMUAN -->
                <label class="block text-left">
                    <span class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-600">06 / Ringkasan Temuan Riset</span>
                    <textarea name="summary" rows="5" required class="glass-input custom-scroll mt-2 w-full rounded-3xl border border-white/80 bg-white/50 px-5 py-4 text-xs font-medium leading-relaxed tracking-wide text-[#1f1f1f] shadow-sm focus:border-[#EA7645] focus:outline-none focus:ring-2 focus:ring-[#EA7645]/20" placeholder="Tuliskan penjelasan detail hasil eksperimen, pengamatan, atau temuan riset Anda...">{{ old('summary') }}</textarea>
                </label>

                <!-- SECTION 5: UNGGAH BERKAS RISET -->
                <div class="block text-left">
                    <div class="flex items-center justify-between">
                        <span class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-600">07 / Berkas Riset</span>
                        <span class="text-[9px] font-bold uppercase tracking-[0.2em] text-gray-400">PRATINJAU DIBUAT OTOMATIS</span>
                    </div>

                    <!-- Dropzone -->
                    <label id="fileDrop" for="fileInput"
                        class="group mt-2 flex cursor-pointer flex-col items-center justify-center gap-2 rounded-3xl border-2 border-dashed border-white/90 bg-white/35 backdrop-blur-md px-6 py-8 text-center shadow-[inset_0_1px_1px_rgba(255,255,255,0.9)] transition-all duration-300 hover:bg-white/60 hover:border-[#EA7645]/60">
                        <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white/70 border border-white shadow-sm text-[#EA7645] transition-transform duration-500 group-hover:-translate-y-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 16V4m0 0L8 8m4-4l4 4M5 20h14" />
                            </svg>
                        </span>
                        <span class="text-xs font-black uppercase tracking-[0.25em] text-[#1f1f1f]">Klik atau seret berkas ke sini</span>
                        <span class="text-[10px] font-bold uppercase tracking-widest text-gray-500">PDF · DOCX · XLSX · PPTX · ZIP · PNG/JPG — Maks 20MB</span>
                        <input id="fileInput" type="file" name="file" required
                            accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.csv,.txt,.zip,.rar,.7z,.png,.jpg,.jpeg,.webp"
                            class="sr-only">
                    </label>

                    <input id="thumbnailInput" type="file" name="thumbnail" accept="image/*" class="hidden">

                    <!-- Kartu pratinjau -->
                    <div id="filePreview" class="mt-3 hidden items-center gap-4 rounded-3xl border border-white/80 bg-white/45 backdrop-blur-md p-4 shadow-[inset_0_1px_1px_rgba(255,255,255,0.9),0_10px_24px_rgba(0,0,0,0.06)]">
                        <div id="previewThumb" class="relative h-28 w-20 flex-shrink-0 overflow-hidden rounded-lg border border-gray-300/70 bg-white shadow-md flex items-center justify-center">
                            <img id="previewImg" alt="Pratinjau" class="hidden h-full w-full object-cover object-top">
                            <div id="previewIcon" class="flex flex-col items-center gap-1">
                                <svg id="previewGlyph" class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M14 3H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8z M14 3v5h5 M9 13h6 M9 17h6"/></svg>
                            </div>
                            <span id="previewExt" class="absolute bottom-1 left-1 rounded-sm px-1.5 py-[1px] text-[8px] font-black tracking-widest text-white bg-gray-600">FILE</span>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p id="previewName" class="truncate text-xs font-black uppercase tracking-wider text-[#1f1f1f]">—</p>
                            <p id="previewMeta" class="mt-1 text-[10px] font-bold uppercase tracking-widest text-gray-500">—</p>
                            <p id="previewStatus" class="mt-2 text-[10px] font-bold uppercase tracking-widest text-[#48AA8C]">—</p>
                        </div>
                        <button type="button" id="previewClear" class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-full border border-white/80 bg-white/60 text-gray-500 transition hover:bg-white hover:text-red-500" aria-label="Hapus berkas">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>

                    @error('file')
                        <span class="mt-1 block text-xs font-bold text-[#EA7645] tracking-wide">{{ $message }}</span>
                    @enderror
                </div>

                <!-- SECTION 6: FOTO DOKUMENTASI -->
                <label class="block text-left">
                    <div class="flex items-center justify-between">
                        <span class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-600">08 / Foto Dokumentasi</span>
                        <span class="rounded-full border border-gray-400/50 bg-white/50 px-2.5 py-0.5 text-[8px] font-black uppercase tracking-[0.2em] text-gray-500">Opsional</span>
                    </div>
                    <input type="file" name="image" accept="image/*" class="glass-input mt-2 block w-full rounded-2xl border border-dashed border-white/80 px-4 py-3 text-xs font-bold tracking-wide text-[#1f1f1f] shadow-sm focus:border-[#48AA8C] focus:outline-none">
                    <span class="mt-1 block text-[10px] font-bold tracking-widest text-gray-500 uppercase">Tidak wajib — kalau kosong, kartu memakai pratinjau berkas. Format PNG/JPG (Maks 4MB).</span>
                    @error('image')
                        <span class="mt-1 block text-xs font-bold text-[#EA7645] tracking-wide">{{ $message }}</span>
                    @enderror
                </label>

                <!-- ACTION BUTTONS -->
                <div class="pt-4 flex flex-col gap-3 sm:flex-row sm:justify-between items-center border-t border-white/60">
                    <div class="flex flex-col gap-3 sm:flex-row w-full sm:w-auto">
                        <a href="{{ url('/') }}" class="action-button action-button--secondary text-center">
                            <span>Ke Beranda</span>
                        </a>
                        <a href="{{ route('research-records.index') }}" class="action-button action-button--secondary text-center">
                            <span>Batalkan</span>
                        </a>
                    </div>
                    <button type="submit" class="action-button action-button--primary w-full sm:w-auto justify-center">
                        <span class="action-button__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12.75 9.5 17.25 19 7.5" />
                            </svg>
                        </span>
                        <span>Simpan Catatan Riset</span>
                    </button>
                </div>
            </form>
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

    .action-button {
        display: inline-flex;
        align-items: center;
        gap: 0.65rem;
        border-radius: 9999px;
        border: 1px solid rgba(255, 255, 255, 0.8);
        padding: 0.75rem 1.85rem;
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
        background-image: linear-gradient(135deg, #EA7645, #d66031);
        border-color: #EA7645;
        color: #fff;
    }

    .action-button--secondary:hover {
        background: rgba(255, 255, 255, 0.85);
        color: #EA7645;
    }

    .action-button__icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 1rem;
        height: 1rem;
    }

    .select-wrapper { position: relative; }
    .select-arrow {
        position: absolute;
        right: 0.85rem;
        top: 50%;
        transform: translateY(-50%);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 1.65rem;
        height: 1.65rem;
        border-radius: 9999px;
        border: 1px solid rgba(255, 255, 255, 0.8);
        background: rgba(255, 255, 255, 0.4);
        pointer-events: none;
    }

    #fileDrop.is-dragover {
        background: rgba(255, 255, 255, 0.8);
        border-color: #EA7645;
        transform: scale(1.01);
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
        const divisionSelect = document.getElementById('divisionSelect');
        const preview = document.getElementById('divisionLeadPreview');

        if (divisionSelect) {
            const updatePreview = (divisionId) => {
                if (!preview) return;
                if (!divisionId) {
                    preview.textContent = 'Kode Divisi: — • Penanggung Jawab: —';
                    return;
                }

                const option = divisionSelect.querySelector(`option[value="${divisionId}"]`);
                const lead = option ? option.dataset.lead : null;
                const code = option ? option.dataset.code : null;
                const parts = [`Kode Divisi: ${code || 'DIV'}`];
                parts.push(`Pembina / Lead: ${lead || 'Dosen Pembina'}`);

                preview.textContent = parts.join(' • ');
            };

            divisionSelect.addEventListener('change', () => {
                updatePreview(divisionSelect.value);
            });

            if (divisionSelect.value) {
                updatePreview(divisionSelect.value);
            }
        }

        // ============================================================
        // UNGGAH BERKAS + GENERATOR THUMBNAIL SEMUA FORMAT (DOCX/PDF/IMG)
        // ============================================================
        const fileInput   = document.getElementById('fileInput');
        const fileDrop    = document.getElementById('fileDrop');
        const thumbInput  = document.getElementById('thumbnailInput');
        const box         = document.getElementById('filePreview');
        const pvImg       = document.getElementById('previewImg');
        const pvIcon      = document.getElementById('previewIcon');
        const pvGlyph     = document.getElementById('previewGlyph');
        const pvExt       = document.getElementById('previewExt');
        const pvName      = document.getElementById('previewName');
        const pvMeta      = document.getElementById('previewMeta');
        const pvStatus    = document.getElementById('previewStatus');
        const pvClear     = document.getElementById('previewClear');

        if (!fileInput) return;

        const THUMB_WIDTH = 640;
        const PDFJS_URL    = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js';
        const PDFJS_WORKER = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

        const KINDS = {
            pdf:   { c: '#c62828', glyph: 'M14 3H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8z M14 3v5h5 M9 13h6 M9 17h6', exts: ['pdf'] },
            word:  { c: '#1f5fb4', glyph: 'M14 3H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8z M14 3v5h5 M9 13h6 M9 17h6', exts: ['doc','docx','odt','rtf'] },
            excel: { c: '#17784f', glyph: 'M4 5h16v14H4z M4 10h16 M4 15h16 M10 5v14', exts: ['xls','xlsx','csv','ods'] },
            ppt:   { c: '#c85a1c', glyph: 'M4 5h16v10H4z M12 15v4 M8 19h8', exts: ['ppt','pptx','odp'] },
            zip:   { c: '#6a43b8', glyph: 'M4 8h16v12H4z M3 4h18v4H3z M10 12h4', exts: ['zip','rar','7z','tar','gz'] },
            image: { c: '#17808c', glyph: 'M4 5h16v14H4z M4 16l5-5 4 4 3-3 4 4 M9 9h.01', exts: ['png','jpg','jpeg','gif','webp'] },
            text:  { c: '#5b6673', glyph: 'M14 3H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8z M14 3v5h5 M9 13h6 M9 17h6', exts: ['txt','md','log'] },
            file:  { c: '#4c5866', glyph: 'M14 3H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8z M14 3v5h5 M9 13h6 M9 17h6', exts: [] },
        };

        const kindOf = (ext) => Object.entries(KINDS).find(([, k]) => k.exts.includes(ext))?.[0] || 'file';

        const formatSize = (bytes) => bytes >= 1048576
            ? (bytes / 1048576).toFixed(1) + ' MB'
            : Math.max(1, Math.round(bytes / 1024)) + ' KB';

        const setThumbnail = (blob) => {
            if (!blob) { thumbInput.value = ''; return; }
            const dt = new DataTransfer();
            dt.items.add(new File([blob], 'thumbnail.jpg', { type: 'image/jpeg' }));
            thumbInput.files = dt.files;
        };

        const canvasToBlob = (canvas) => new Promise((resolve) => canvas.toBlob(resolve, 'image/jpeg', 0.85));

        const showImage = (url) => {
            pvImg.src = url;
            pvImg.classList.remove('hidden');
            pvIcon.classList.add('hidden');
        };

        // Thumbnail dari Gambar
        const thumbFromImage = async (file) => {
            const url = URL.createObjectURL(file);
            const img = await new Promise((res, rej) => {
                const i = new Image();
                i.onload = () => res(i);
                i.onerror = rej;
                i.src = url;
            });
            const scale = Math.min(1, THUMB_WIDTH / img.width);
            const canvas = document.createElement('canvas');
            canvas.width = Math.round(img.width * scale);
            canvas.height = Math.round(img.height * scale);
            canvas.getContext('2d').drawImage(img, 0, 0, canvas.width, canvas.height);
            URL.revokeObjectURL(url);
            return canvas;
        };

        // Thumbnail dari PDF (halaman pertama)
        const loadPdfJs = () => new Promise((resolve, reject) => {
            if (window.pdfjsLib) return resolve(window.pdfjsLib);
            const s = document.createElement('script');
            s.src = PDFJS_URL;
            s.onload = () => {
                window.pdfjsLib.GlobalWorkerOptions.workerSrc = PDFJS_WORKER;
                resolve(window.pdfjsLib);
            };
            s.onerror = reject;
            document.head.appendChild(s);
        });

        const thumbFromPdf = async (file) => {
            const pdfjs = await loadPdfJs();
            const pdf = await pdfjs.getDocument({ data: await file.arrayBuffer() }).promise;
            const page = await pdf.getPage(1);
            const base = page.getViewport({ scale: 1 });
            const viewport = page.getViewport({ scale: THUMB_WIDTH / base.width });
            const canvas = document.createElement('canvas');
            canvas.width = viewport.width;
            canvas.height = viewport.height;
            const ctx = canvas.getContext('2d');
            ctx.fillStyle = '#fff';
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            await page.render({ canvasContext: ctx, viewport }).promise;
            return canvas;
        };

        // GENERATOR THUMBNAIL OTOMATIS DOKUMEN RHINE LAB (DOCX, XLSX, PPTX, ZIP, TXT, dll)
        const generateDocumentPlaceholder = (filename, ext, colorHex) => {
            const canvas = document.createElement('canvas');
            canvas.width = 600;
            canvas.height = 450;
            const ctx = canvas.getContext('2d');

            // Background dokumen Kertas HUD
            ctx.fillStyle = '#F4F1EE';
            ctx.fillRect(0, 0, canvas.width, canvas.height);

            // Watermark Garis Berpola
            ctx.strokeStyle = 'rgba(0,0,0,0.06)';
            ctx.lineWidth = 2;
            for (let i = 20; i < canvas.height; i += 20) {
                ctx.beginPath();
                ctx.moveTo(30, i);
                ctx.lineTo(canvas.width - 30, i);
                ctx.stroke();
            }

            // Header Blok Kertas Dokumen
            ctx.fillStyle = '#1C1C1C';
            ctx.fillRect(30, 30, canvas.width - 60, 70);

            ctx.fillStyle = '#FFFFFF';
            ctx.font = 'bold 20px sans-serif';
            ctx.fillText('RHINE LAB CORPORATION', 50, 62);

            ctx.fillStyle = colorHex;
            ctx.font = 'bold 16px sans-serif';
            ctx.fillText(`OFFICIAL DOCUMENT FILE [${ext.toUpperCase()}]`, 50, 86);

            // Badge Tipe File Kanan Atas
            ctx.fillStyle = colorHex;
            ctx.fillRect(canvas.width - 150, 45, 100, 40);
            ctx.fillStyle = '#FFFFFF';
            ctx.font = 'black 22px sans-serif';
            ctx.textAlign = 'center';
            ctx.fillText(ext.toUpperCase(), canvas.width - 100, 73);
            ctx.textAlign = 'left';

            // Nama File Utama
            ctx.fillStyle = '#111111';
            ctx.font = 'black 26px sans-serif';
            
            // Bungkus Teks Panjang
            const maxW = canvas.width - 100;
            let words = filename.split(' ');
            let line = '';
            let y = 160;

            for (let n = 0; n < words.length; n++) {
                let testLine = line + words[n] + ' ';
                let metrics = ctx.measureText(testLine);
                if (metrics.width > maxW && n > 0) {
                    ctx.fillText(line, 50, y);
                    line = words[n] + ' ';
                    y += 36;
                } else {
                    line = testLine;
                }
            }
            ctx.fillText(line, 50, y);

            // Elemen Informasi Tambahan HUD
            ctx.fillStyle = '#666666';
            ctx.font = 'bold 16px monospace';
            ctx.fillText('FILE STATUS: CLASSIFIED ARCHIVE', 50, y + 50);
            ctx.fillText('ENCRYPTION : RHINE-SEC-256', 50, y + 78);

            // Footer Stamp
            ctx.strokeStyle = colorHex;
            ctx.lineWidth = 3;
            ctx.strokeRect(50, canvas.height - 70, 180, 40);
            ctx.fillStyle = colorHex;
            ctx.font = 'bold 16px sans-serif';
            ctx.fillText('VERIFIED DATA', 70, canvas.height - 44);

            return canvas;
        };

        const reset = () => {
            fileInput.value = '';
            setThumbnail(null);
            pvImg.removeAttribute('src');
            pvImg.classList.add('hidden');
            pvIcon.classList.remove('hidden');
            box.classList.add('hidden');
            box.classList.remove('flex');
        };

        const handleFile = async (file) => {
            if (!file) return reset();

            const ext = (file.name.split('.').pop() || '').toLowerCase();
            const kind = kindOf(ext);
            const k = KINDS[kind];

            box.classList.remove('hidden');
            box.classList.add('flex');
            pvName.textContent = file.name;
            pvMeta.textContent = `${ext.toUpperCase() || 'FILE'} · ${formatSize(file.size)}`;
            pvExt.textContent = (ext || 'file').toUpperCase();
            pvExt.style.background = k.c;
            pvGlyph.style.color = k.c;
            pvGlyph.querySelector('path').setAttribute('d', k.glyph);
            pvImg.classList.add('hidden');
            pvIcon.classList.remove('hidden');
            setThumbnail(null);
            pvStatus.style.color = '#48AA8C';
            pvStatus.textContent = 'Membuat pratinjau…';

            try {
                let canvas = null;
                if (kind === 'image') {
                    canvas = await thumbFromImage(file);
                } else if (kind === 'pdf') {
                    canvas = await thumbFromPdf(file);
                } else {
                    // Otomatis bikin thumbnail canvas visual untuk DOCX, XLSX, PPTX, ZIP, TXT, dll
                    canvas = generateDocumentPlaceholder(file.name, ext, k.c);
                }

                if (canvas) {
                    const blob = await canvasToBlob(canvas);
                    setThumbnail(blob);
                    showImage(URL.createObjectURL(blob));
                    pvStatus.textContent = 'Pratinjau visual siap disimpan';
                }
            } catch (err) {
                console.error(err);
                pvStatus.style.color = '#EA7645';
                pvStatus.textContent = 'Gagal membuat pratinjau visual — berkas tetap bisa disimpan';
            }
        };

        fileInput.addEventListener('change', () => handleFile(fileInput.files[0]));
        pvClear.addEventListener('click', reset);

        ['dragenter', 'dragover'].forEach(ev => fileDrop.addEventListener(ev, (e) => {
            e.preventDefault();
            fileDrop.classList.add('is-dragover');
        }));
        ['dragleave', 'drop'].forEach(ev => fileDrop.addEventListener(ev, (e) => {
            e.preventDefault();
            fileDrop.classList.remove('is-dragover');
        }));
        fileDrop.addEventListener('drop', (e) => {
            if (e.dataTransfer.files.length) {
                fileInput.files = e.dataTransfer.files;
                handleFile(fileInput.files[0]);
            }
        });
    });
</script>
@endsection