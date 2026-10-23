@extends('layouts.gla')

@section('title', 'RHINE LAB.LLC - RESEARCH')

@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Caveat:wght@700&family=Oswald:wght@600;700&display=swap" rel="stylesheet">
<noscript><style>.rr-card{opacity:1 !important}</style></noscript>

<div id="pageWrapper"
    class="flex flex-col justify-center items-center min-h-screen bg-[#ECE8E5] text-black relative overflow-hidden transition-opacity duration-700 opacity-0">

    <!-- Cahaya latar (gradient statis, tanpa blur filter agar ringan di mobile) -->
    <div class="rr-bg absolute inset-0 z-0 pointer-events-none"></div>

    <!-- Header kiri atas -->
    <div class="absolute top-6 left-6 leading-tight select-none space-y-1 animate-slide-fade z-10"
        style="animation-delay:0.2s;">
        <h1 class="text-2xl font-bold">RHINE LAB</h1>
        <p class="text-[10px] tracking-[0.2em] uppercase font-extralight">
            SYNTHESIZE INFORMATION
        </p>
        <p class="text-base sm:text-lg md:text-xl">
            ANALYSIS <span class="font-bold">OS</span>
        </p>
    </div>

    <!-- Header kanan atas -->
    <div class="absolute top-6 right-6 text-[10px] sm:text-sm font-medium select-none tracking-wider text-gray-700 flex items-center space-x-2 opacity-0 animate-fade-up z-10"
        style="animation-delay:0.4s;">
        <span>SYNCING DATA</span>
        <div class="liquid-dots flex space-x-[4px] ml-1">
            <span class="bg-[#EA7645]"></span>
            <span class="bg-[#C8B9A9]"></span>
            <span class="bg-[#48AA8C]"></span>
        </div>
    </div>

    <!-- Kontainer Tengah Galeri -->
    <div class="flex flex-col items-center text-center z-10 select-none w-full px-4 sm:px-6 mt-24 mb-24 sm:mb-20 relative">
        <h2 class="text-lg sm:text-xl md:text-2xl font-semibold tracking-widest uppercase text-gray-700 mb-8 opacity-0 animate-fade-up"
            style="animation-delay:0.6s;">
            Research Reports
        </h2>

        <!-- Galeri: di mobile ikut scroll halaman, di layar besar scroll internal -->
        <div class="w-full max-w-[72rem] sm:h-[68vh] sm:overflow-y-auto overflow-x-hidden sm:pr-4 custom-scroll pb-6 sm:pb-16 pt-2">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-8 lg:gap-x-10 gap-y-10 sm:gap-y-14 justify-items-center">

            @forelse($records as $index => $record)
                @php
                    // PENENTUAN IKON FILE
                    $fileExt = strtolower(pathinfo($record->file_path ?? '', PATHINFO_EXTENSION));
                    $iconData = match(true) {
                        in_array($fileExt, ['pdf']) => ['label' => 'PDF', 'color' => '#dc2626'],
                        in_array($fileExt, ['doc', 'docx']) => ['label' => 'DOCX', 'color' => '#2563eb'],
                        in_array($fileExt, ['xls', 'xlsx', 'csv']) => ['label' => 'XLSX', 'color' => '#059669'],
                        in_array($fileExt, ['ppt', 'pptx']) => ['label' => 'PPTX', 'color' => '#ea580c'],
                        in_array($fileExt, ['zip', 'rar', '7z']) => ['label' => 'ZIP', 'color' => '#9333ea'],
                        in_array($fileExt, ['png', 'jpg', 'jpeg', 'webp']) => ['label' => 'IMG', 'color' => '#0d9488'],
                        default => ['label' => 'FILE', 'color' => '#4b5563']
                    };

                    // HELPER PENGECEKAN URL SUPABASE VS LOCALHOST
                    $resolveUrl = function(?string $path) {
                        if (!$path) return null;
                        return \Illuminate\Support\Str::startsWith($path, ['http://', 'https://'])
                            ? $path
                            : asset($path);
                    };

                    // OTOMATISASI GAMBAR DENGAN SUPPORT SUPABASE
                    $fig1Path = $resolveUrl($record->image_path)
                        ?? $resolveUrl($record->thumbnail_path)
                        ?? asset('images/gallery1.jpg');

                    $fig2Path = $resolveUrl($record->thumbnail_path);

                    $project = $record->project;
                    $division = $project?->division;
                    $scientist = $record->user;

                    $statusText = match(strtolower($record->status ?? 'draft')) {
                        'draft' => 'DRAFT',
                        'revisi_1' => 'REV 1',
                        'revisi_2' => 'REV 2',
                        'revisi_3' => 'REV 3',
                        'final' => 'FINAL',
                        default => strtoupper(str_replace('_', ' ', $record->status ?? 'draft'))
                    };

                    $classText = strtoupper($record->classification ?? '-');
                    $recordYear = $record->recorded_at
                        ? \Carbon\Carbon::parse($record->recorded_at)->format('Y')
                        : optional($record->created_at)->format('Y');
                    $cardTitle = $project->title ?? $record->record_code;
                @endphp

                <div class="rr-card"
                    role="button" tabindex="0"
                    aria-label="Buka dokumen {{ $cardTitle }}"
                    onclick="openModal(this)"
                    onkeydown="if(event.key==='Enter'||event.key===' '){event.preventDefault();openModal(this);}"
                    data-src="{{ $fig1Path }}"
                    data-title="{{ $cardTitle }}"
                    data-category="{{ $project->reference_code ?? 'RESEARCH SECTION' }}"
                    data-class="{{ $classText }}"
                    data-scientist="{{ $scientist->name ?? 'Classified' }}"
                    data-desc="{{ $record->summary }}"
                    style="--d: {{ ($index % 3) * 0.08 }}s; --ft: {{ $iconData['color'] }};">

                    <!-- LAYER 1: MAP / FOLDER HIJAU -->
                    <div class="rr-folder">
                        <span class="rr-shine"></span>
                        <svg class="rr-mark" viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="11" aria-hidden="true">
                            <circle cx="50" cy="50" r="40"/>
                            <path d="M50 30v40M30 50h40" stroke-linecap="round"/>
                        </svg>
                        <span class="rr-spine">Rhine Lab Archive</span>
                    </div>

                    <!-- LAYER 2: LEMBAR HIJAU -->
                    <div class="rr-sheet-a"></div>
                    <div class="rr-sheet-b"></div>

                    <!-- NOMOR BERKAS -->
                    <div class="rr-no">
                        <div class="rr-no-text">
                            <div class="rr-no-big">NO.</div>
                            <div class="rr-no-sub"><p>Lab Report</p><p>Sealed File</p></div>
                        </div>
                        <span class="rr-no-num">{{ $loop->iteration }}</span>
                    </div>

                    <!-- LAYER 3: TUMPUKAN KERTAS -->
                    <div class="rr-ply1"></div>
                    <div class="rr-ply2"></div>

                    <!-- LAYER 4: DOKUMEN UTAMA -->
                    <div class="rr-doc">

                        <!-- Kop surat + format file -->
                        <div class="rr-kop">
                            <img src="{{ asset('images/logo.png') }}" alt="" loading="lazy" decoding="async" draggable="false">
                            <div class="rr-kop-text">
                                <p class="rr-kop-name">RHINE LABORATORY</p>
                                <p>T1 Oxford St.</p>
                                <p>Special District, Columbia</p>
                            </div>
                            @if($record->file_path)
                                <span class="rr-ft" title="Format file: {{ $iconData['label'] }}">{{ $iconData['label'] }}</span>
                            @endif
                        </div>

                        <!-- Judul -->
                        <div class="rr-title">
                            <p class="rr-eyebrow">Laboratory Report</p>
                            <h3 class="rr-h3">{{ $cardTitle }}</h3>
                            <p class="rr-sub">Clinical Trial / {{ strtoupper($project->reference_code ?? 'RESEARCH') }}</p>
                        </div>

                        <!-- Bar nomor rekord -->
                        <div class="rr-bar">
                            <span>Record No.</span>
                            <span class="rr-bar-code">{{ $record->record_code }}</span>
                        </div>

                        <!-- Tabel spesifikasi -->
                        <div class="rr-table">
                            <div class="rr-th"><span>Parameter</span><span>Value</span></div>
                            <div class="rr-tgrid">
                                <div class="rr-cell"><span class="rr-l">Class</span><span class="rr-v rr-blue">{{ $classText }}</span></div>
                                <div class="rr-cell"><span class="rr-l">Status</span><span class="rr-v rr-blue">{{ $statusText }}</span></div>
                                <div class="rr-cell"><span class="rr-l">Year</span><span class="rr-v">{{ $recordYear }}</span></div>
                                <div class="rr-cell"><span class="rr-l">Division</span><span class="rr-v">{{ strtoupper($division->code ?? 'DIV') }}</span></div>
                                <div class="rr-cell rr-wide"><span class="rr-l">Scientist</span><span class="rr-v rr-orange">{{ $scientist->name ?? 'OPERATIVE' }}</span></div>
                            </div>
                        </div>

                        <!-- Dua figur -->
                        <div class="rr-figs">
                            <div class="rr-figcol">
                                <div class="rr-fig">
                                    <img src="{{ $fig1Path }}" alt="" loading="lazy" decoding="async" draggable="false"
                                         onerror="this.onerror=null;this.style.display='none';this.parentNode.classList.add('is-broken')">
                                </div>
                                <p class="rr-cap"><b>Fig. 1</b> — Dokumentasi</p>
                            </div>
                            <div class="rr-figcol">
                                <div class="rr-fig">
                                    @if($fig2Path)
                                        <img src="{{ $fig2Path }}" alt="" loading="lazy" decoding="async" draggable="false"
                                             onerror="this.onerror=null;this.style.display='none';this.parentNode.classList.add('is-broken')">
                                    @else
                                        <svg class="rr-chart" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid meet" fill="none" stroke="#333" stroke-width="0.8" font-family="Times New Roman, serif" aria-hidden="true">
                                            <path d="M18 14H92M18 34H92M18 54H92M18 74H92" stroke="#ececec"/>
                                            <path d="M18 8v74h74" stroke="#888"/>
                                            <path d="M14 74h4M14 54h4M14 34h4M14 14h4M30 82v4M50 82v4M70 82v4M90 82v4" stroke="#999"/>
                                            <path d="M26 68L86 20" stroke="#EA7645" stroke-dasharray="2 2" stroke-width="0.7"/>
                                            <g stroke-width="1">
                                                <path d="M30 76v-16M46 68v-14M62 52v-16M76 46v-16M88 28v-14"/>
                                                <path d="M27.5 76h5M27.5 60h5M43.5 68h5M43.5 54h5M59.5 52h5M59.5 36h5M73.5 46h5M73.5 30h5M85.5 28h5M85.5 14h5"/>
                                            </g>
                                            <g fill="#222" stroke="none">
                                                <circle cx="30" cy="68" r="2"/><circle cx="46" cy="61" r="2"/><circle cx="62" cy="44" r="2"/><circle cx="76" cy="38" r="2"/><circle cx="88" cy="21" r="2"/>
                                            </g>
                                            <g fill="#666" stroke="none" font-size="5" text-anchor="middle">
                                                <text x="56" y="96">Periode</text>
                                                <text transform="translate(6 46) rotate(-90)">Progress</text>
                                            </g>
                                        </svg>
                                    @endif
                                </div>
                                <p class="rr-cap"><b>Fig. 2</b> — Pratinjau Riset</p>
                            </div>
                        </div>

                        <!-- Abstrak & tombol download -->
                        <div class="rr-bottom">
                            <p class="rr-abs"><b>Abstract — </b>{{ $record->summary }}</p>
                            @if($record->file_path)
                                <a href="{{ route('research-records.download', $record->id) }}" onclick="event.stopPropagation();" class="rr-dl">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                                    Download Dokumen
                                </a>
                            @endif
                        </div>

                        <span class="rr-wm"></span>
                    </div>

                    <!-- LAYER 5: STICKY NOTE -->
                    <div class="rr-note">
                        <span class="rr-note-logo"></span>
                        <span class="rr-note-a font-signature">Check</span>
                        <span class="rr-note-b font-signature">{{ $statusText }}</span>
                        <span class="rr-note-c">Rhine Lab</span>
                    </div>
                </div>
            @empty
                <p class="col-span-full text-gray-500 italic opacity-0 animate-fade-up">No files available</p>
            @endforelse
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="absolute bottom-3 right-3 text-[10px] sm:text-xs md:text-sm lg:text-base font-light select-none opacity-0 animate-fade-up z-10" style="animation-delay: 1.6s;">
        POWERED BY <span class="font-bold">RHINE LAB</span>
    </div>
    <div class="absolute bottom-2 w-full text-center text-[11px] text-gray-500 tracking-wide select-none opacity-0 animate-fade-up z-10" style="animation-delay:1.6s;">
        Internal Database
    </div>

    <div class="absolute bottom-4 left-4 z-20">
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
</div>

<!-- MODAL DOCUMENT VIEWER -->
<div id="imageModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-3 sm:p-8" role="dialog" aria-modal="true" aria-label="Document Viewer">
    <div class="absolute inset-0 bg-black/50 md:bg-black/40 md:backdrop-blur-md pointer-events-none" id="modalBackdrop"></div>

    <div id="akAdvancedModal" class="relative z-10 w-full max-w-[62rem] min-h-[55vh] bg-[#f8f7f4] rounded-[20px] overflow-x-hidden flex flex-col transform scale-95 opacity-0 transition-[transform,opacity] duration-500 cubic-bloop border border-white/80">

        <!-- Modal Header -->
        <div class="flex flex-row justify-between items-center gap-2 px-4 sm:px-10 py-3 sm:py-4 border-b border-gray-300/60 relative bg-white/80 z-20">
            <div class="flex items-center gap-4 min-w-0">
                <h2 class="text-base sm:text-2xl font-black tracking-[0.15em] sm:tracking-[0.2em] text-[#2c2c2c] uppercase truncate">Document Viewer</h2>
                <div class="hidden sm:block h-6 w-px bg-gray-400"></div>
                <p class="hidden sm:block text-[8px] tracking-[0.3em] font-bold text-gray-400 uppercase">Rhine Lab Internal Archive</p>
            </div>

            <div class="flex items-center gap-2 sm:gap-3 shrink-0">
                <span class="hidden xs:inline-block sm:inline-block px-2 sm:px-3 py-1 text-[8px] font-black tracking-widest text-[#EA7645] border border-[#EA7645]/40 rounded-full bg-[#EA7645]/10">CLASSIFIED</span>
                <span class="hidden sm:inline-block px-3 py-1 text-[8px] font-black tracking-widest text-[#48AA8C] border border-[#48AA8C]/40 rounded-full bg-[#48AA8C]/10">VERIFICATION: RHL-A</span>
                <button onclick="closeModal()" aria-label="Tutup" class="p-2 -mr-1 text-gray-400 hover:text-red-500 transition-colors duration-300 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
            <div class="absolute top-0 left-0 w-full h-[3px] bg-gradient-to-r from-[#EA7645] to-transparent opacity-80"></div>
        </div>

        <div class="flex flex-col md:flex-row flex-1 relative hex-bg">
            <!-- Left Info Panel -->
            <div class="w-full md:w-[35%] p-5 md:p-8 flex flex-col relative z-20 border-b md:border-b-0 md:border-r border-gray-300/40 bg-white/50 pointer-events-none">
                <div class="absolute left-5 md:left-6 top-6 md:top-8 w-1 h-6 bg-[#C4FF00] shadow-[0_0_8px_#C4FF00]"></div>
                <div class="pl-4 mb-5 md:mb-8">
                    <h3 class="text-xl font-black leading-none text-gray-900 tracking-widest">RHINE LAB</h3>
                    <p class="text-[8px] font-extrabold tracking-[0.25em] mt-1 text-gray-500">SYNTHESIZE INFORMATION</p>
                    <p class="text-xs tracking-[0.2em] font-medium text-gray-700 mt-1">ANALYSIS <span class="font-black text-gray-900">OS</span></p>
                </div>
                <div class="mt-auto md:mt-10 relative pointer-events-auto">
                    <div class="bg-[#242424] text-white p-5 md:p-6 relative border-l-4 border-[#9b968c] z-10">
                        <h1 id="modalTitle" class="text-base md:text-xl font-black uppercase leading-[1.3] tracking-widest text-white break-words">JUDUL DOKUMEN</h1>
                        <p id="modalCategory" class="text-[8px] tracking-[0.25em] text-gray-400 uppercase font-bold mt-4 pt-4 border-t border-gray-600">REFERENCE SECTION</p>
                    </div>
                </div>
            </div>

            <!-- Right Interactive Image Panel -->
            <div id="modalInteractiveArea" class="w-full md:w-[65%] relative flex items-center justify-center min-h-[40vh] md:min-h-[45vh] modal-group overflow-hidden bg-gradient-to-br from-transparent to-white/40 cursor-pointer md:cursor-auto" onclick="this.classList.toggle('is-highlighted')">

                <!-- Latar teks transparan -->
                <div class="absolute inset-0 z-20 pointer-events-none transition-opacity duration-500 opacity-100 mg-bg">
                    <div class="absolute top-4 left-4 sm:top-8 sm:left-8 flex items-center gap-2">
                        <div class="w-1.5 h-1.5 rounded-full bg-gray-400"></div><div class="hidden sm:block w-16 h-[1px] bg-gray-400"></div><span class="text-[8px] font-extrabold tracking-[0.2em] text-gray-500">SECTION PROFILE</span>
                    </div>
                    <div class="absolute top-10 right-4 sm:top-8 sm:right-8 text-right">
                        <span class="border border-gray-400 text-gray-500 font-bold text-[7px] sm:text-[8px] px-2 py-0.5 tracking-[0.15em] uppercase">GENERAL ACCESS CONTENT</span>
                        <div class="bg-[#323232] text-white text-[8px] font-black px-2 py-0.5 mt-1 tracking-widest inline-block">RHINE LAB.LLC.</div>
                    </div>
                    <div class="absolute left-4 sm:left-8 bottom-14 sm:bottom-16">
                        <div class="text-base sm:text-lg font-black tracking-widest text-gray-800">SCIENTIST</div>
                        <div class="flex gap-1 mt-1"><div class="h-[2px] w-6 bg-[#C4FF00]"></div><div class="h-[2px] w-10 bg-gray-400"></div></div>
                        <div class="text-[9px] font-black text-white tracking-[0.2em] mt-1.5 uppercase bg-black px-2 py-0.5 inline-block" id="modalScientist">NAME</div>
                    </div>
                    <div class="absolute right-4 sm:right-8 top-[62%] sm:top-1/2 -translate-y-1/2">
                        <div class="bg-[#1f1f1f] text-white text-sm sm:text-base font-black px-3 py-1 tracking-widest text-right">CLASSIFICATION</div>
                        <div class="h-[3px] w-full border border-gray-800 mt-1 p-0.5"><div class="h-full bg-gray-800 w-full"></div></div>
                        <div class="text-[9px] font-extrabold text-gray-600 tracking-[0.2em] mt-1.5 text-right uppercase" id="modalClass">CLASS</div>
                    </div>
                </div>

                <!-- Container gambar -->
                <div class="relative z-10 w-[70%] h-[70%] flex items-center justify-center transition-all duration-[800ms] cubic-bloop opacity-40 grayscale-[50%] scale-90 mg-img-wrap">
                    <div class="relative bg-white p-2 border border-gray-200 transition-all duration-[800ms] mg-img-inner">
                        <img id="modalImg" alt="" decoding="async" onerror="this.style.visibility='hidden'" class="max-h-[30vh] md:max-h-[35vh] w-auto object-contain">
                    </div>
                </div>

                <div class="absolute bottom-3 sm:bottom-4 w-[86%] text-center z-40 pointer-events-none">
                    <p id="modalDesc" class="text-[9px] font-bold text-gray-500 tracking-[0.08em] line-clamp-2 opacity-80 uppercase">Deskripsi Dokumen.</p>
                </div>
            </div>
        </div>

        <div class="w-full h-1 bg-gray-300 flex items-center relative z-20 shrink-0">
            <div class="w-1/3 h-full bg-[#1c1c1c] relative"></div>
            <div class="w-1/4 h-full bg-red-600 relative animate-pulse"></div>
        </div>
    </div>
</div>

<style>
    :root { --rr-logo: url('{{ asset('images/logo.png') }}'); }

    /* ===== Umum ===== */
    .cubic-bloop { transition-timing-function: cubic-bezier(0.34, 1.56, 0.64, 1); }
    .font-signature { font-family: 'Caveat', cursive; }
    .hex-bg { background-color: transparent; background-image: url("data:image/svg+xml,%3Csvg width='40' height='69.282' viewBox='0 0 40 69.282' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M40 11.547L20 0 0 11.547v23.094l20 11.547 20-11.547V11.547zM20 45.034L1.155 34.148V12.376L20 1.49l18.845 10.886v21.772L20 45.034z' fill='%23000000' fill-opacity='0.025' fill-rule='evenodd'/%3E%3Cpath d='M40 46.188L20 34.641 0 46.188v23.094l20 11.547 20-11.547V46.188zM20 79.675L1.155 68.789V47.017L20 36.13l18.845 10.886v21.772L20 79.675z' fill='%23000000' fill-opacity='0.025' fill-rule='evenodd'/%3E%3C/svg%3E"); background-size: 60px 103.923px; }
    .custom-scroll::-webkit-scrollbar { width: 6px; }
    .custom-scroll::-webkit-scrollbar-track { background: transparent; }
    .custom-scroll::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.15); border-radius: 9999px; }
    .custom-scroll::-webkit-scrollbar-thumb:hover { background: rgba(0,0,0,0.3); }
    .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }

    .rr-bg {
        background:
            radial-gradient(circle at 0% 0%, rgba(255,255,255,0.65) 0, rgba(255,255,255,0) 24rem),
            radial-gradient(circle at 100% 100%, rgba(234,118,69,0.16) 0, rgba(234,118,69,0) 28rem),
            radial-gradient(circle at 50% 50%, rgba(72,170,140,0.13) 0, rgba(72,170,140,0) 18rem);
    }

    @keyframes liquidBreathe { 0% { transform: scaleY(1); opacity: 0.5; } 50% { transform: scaleY(2.2); opacity: 1; } 100% { transform: scaleY(1); opacity: 0.5; } }
    .liquid-dots span { display: block; width: 6px; height: 6px; border-radius: 999px; animation: liquidBreathe 1.5s ease-in-out infinite alternate; }
    .liquid-dots span:nth-child(2) { animation-delay: 0.3s; }
    .liquid-dots span:nth-child(3) { animation-delay: 0.6s; }
    @keyframes fadeUp { 0% { opacity: 0; transform: translateY(20px); } 100% { opacity: 1; transform: translateY(0); } }
    .animate-fade-up { animation: fadeUp 0.8s forwards; }
    @keyframes slideFade { 0% { opacity: 0; transform: translateX(-20px); } 100% { opacity: 1; transform: translateX(0); } }
    .animate-slide-fade { animation: slideFade 0.8s forwards; }

    /* ===== KARTU RISET =====
       Seluruh ukuran memakai cqw (persen lebar kartu) sehingga desain
       terskala presisi di semua lebar layar. Tanpa bayangan di belakang kartu. */
    .rr-card {
        --ft: #4b5563;
        position: relative;
        width: 100%;
        max-width: 26rem;
        aspect-ratio: 5 / 7.2;
        container-type: inline-size;
        content-visibility: auto;
        contain-intrinsic-size: auto 36rem;
        cursor: pointer;
        opacity: 0;
        -webkit-tap-highlight-color: transparent;
        text-align: left;
    }
    .rr-card:focus-visible { outline: 2px solid #EA7645; outline-offset: -4px; }
    .rr-card.is-in { animation: rrIn 0.6s cubic-bezier(0.22, 1, 0.36, 1) var(--d, 0s) forwards; }
    @keyframes rrIn { 0% { opacity: 0; transform: translateY(18px) scale(0.97); } 100% { opacity: 1; transform: none; } }

    .rr-card > * { position: absolute; }

    /* Map / folder */
    .rr-folder {
        inset: 0; border-radius: 1.6cqw; overflow: hidden;
        border: 1px solid rgba(47,68,36,0.7);
        background:
            radial-gradient(ellipse at 38% 30%, rgba(255,255,255,0.16) 0%, rgba(0,0,0,0) 48%, rgba(0,0,0,0.26) 100%),
            linear-gradient(160deg, #7d9f65 0%, #5b7b46 45%, #44602f 100%);
    }
    .rr-folder::after { content: ""; position: absolute; inset: 0 auto 0 0; width: 6cqw; background: linear-gradient(90deg, rgba(0,0,0,0.2), rgba(0,0,0,0)); }
    .rr-shine { position: absolute; inset: 0; background: linear-gradient(90deg, transparent, rgba(255,255,255,0.35), transparent); transform: translateX(-150%) skewX(-25deg); display: none; }
    .rr-mark { position: absolute; left: -9cqw; bottom: 14%; width: 28cqw; height: 28cqw; color: rgba(255,255,255,0.25); }
    .rr-spine {
        position: absolute; left: 2.2cqw; bottom: 3cqw;
        writing-mode: vertical-rl; transform: rotate(180deg);
        font: 700 1.5cqw/1 'Oswald', sans-serif; letter-spacing: 0.5em; text-transform: uppercase; color: rgba(255,255,255,0.34);
    }

    /* Lembar hijau */
    .rr-sheet-a { left: 10%; right: 2%; top: 9%; bottom: 5%; background: #c6d6b4; border: 1px solid #a9c08f; transform: rotate(1.4deg); transition: transform 0.5s; }
    .rr-sheet-b {
        left: 7%; right: 5%; top: 6%; bottom: 7%; border: 1px solid #8fab74; transform: rotate(-0.8deg); transition: transform 0.5s;
        background-color: #a9c08f;
        background-image:
            repeating-linear-gradient(to bottom, rgba(45,65,35,0.26) 0, rgba(45,65,35,0.26) 1px, transparent 1px, transparent 4px),
            linear-gradient(to right, rgba(255,255,255,0.02), rgba(255,255,255,0.22));
    }

    /* Nomor berkas */
    .rr-no { z-index: 5; top: 3.2%; left: 4.5cqw; display: flex; align-items: flex-start; gap: 2cqw; color: #fff; pointer-events: none; font-family: 'Oswald', 'Arial Narrow', sans-serif; }
    .rr-no-big { font-size: 13cqw; font-weight: 700; line-height: 0.9; letter-spacing: -0.01em; }
    .rr-no-sub { margin-top: 1.2cqw; font-size: 2.8cqw; font-weight: 600; letter-spacing: 0.12em; text-transform: uppercase; line-height: 1.2; }
    .rr-no-sub p { margin: 0; }
    .rr-no-num { font-size: 27cqw; font-weight: 700; line-height: 0.8; margin-left: -1cqw; }

    /* Tumpukan kertas */
    .rr-ply1 { left: 18%; right: 1%; top: 22%; bottom: 0.8%; background: #d5dac9; border: 1px solid #b9c1a9; }
    .rr-ply2 { left: 17%; right: 2%; top: 20%; bottom: 2.2%; background: #e9eadf; border: 1px solid #c9ccbc; }

    /* Dokumen utama */
    .rr-doc {
        z-index: 10; left: 16%; right: 3%; top: 18%; bottom: 3.5%;
        padding: 3.4cqw 3.6cqw 2.8cqw;
        display: flex; flex-direction: column; overflow: hidden;
        font-family: 'Times New Roman', Times, 'Liberation Serif', serif;
        background-color: #f8f8f1;
        background-image: radial-gradient(rgba(0,0,0,0.035) 1px, transparent 1px), linear-gradient(100deg, rgba(0,0,0,0.05) 0%, transparent 5%, transparent 95%, rgba(0,0,0,0.035) 100%);
        background-size: 3px 3px, 100% 100%;
        border: 1px solid rgba(209,213,219,0.95); border-bottom-color: #bfc4b0;
        transition: transform 0.5s;
    }

    .rr-kop { display: flex; align-items: center; gap: 2.2cqw; padding-bottom: 1.8cqw; border-bottom: 1px solid #d1d5db; flex: none; }
    .rr-kop img { height: 7.4cqw; width: auto; object-fit: contain; filter: grayscale(1) contrast(1.25); opacity: 0.9; }
    .rr-kop-text { font-size: 1.9cqw; line-height: 1.45; letter-spacing: 0.14em; text-transform: uppercase; color: #6b7280; font-weight: 600; min-width: 0; }
    .rr-kop-text p { margin: 0; }
    .rr-kop-name { color: #111827; font-weight: 700; letter-spacing: 0.2em; }

    /* Badge format file: ikon halaman dengan sudut terlipat, rata kanan kop surat */
    .rr-ft {
        position: relative; flex: none; margin-left: auto;
        width: 7.4cqw; height: 9cqw; padding-bottom: 1cqw;
        display: flex; align-items: flex-end; justify-content: center;
        background: var(--ft); color: #fff;
        font: 800 1.8cqw/1 system-ui, -apple-system, 'Segoe UI', sans-serif; letter-spacing: 0.04em;
        clip-path: polygon(0 0, 68% 0, 100% 24%, 100% 100%, 0 100%);
        border-radius: 0.5cqw;
    }
    .rr-ft::after { content: ""; position: absolute; top: 0; right: 0; width: 32%; height: 24%; background: rgba(255,255,255,0.38); clip-path: polygon(0 0, 0 100%, 100% 100%); }

    .rr-title { text-align: center; margin-top: 2.6cqw; flex: none; }
    .rr-eyebrow { margin: 0; font-size: 1.7cqw; letter-spacing: 0.45em; text-transform: uppercase; color: #6b7280; font-weight: 600; }
    .rr-h3 {
        margin: 0.8cqw 0 0; font-size: 4.2cqw; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; line-height: 1.15; color: #000;
        display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; word-break: break-word;
    }
    .rr-sub { margin: 0.8cqw 0 0; font-size: 2cqw; font-weight: 700; letter-spacing: 0.04em; color: #1f2937; }

    .rr-bar { flex: none; margin-top: 2cqw; height: 4.4cqw; background: #d3e8e3; display: flex; align-items: center; justify-content: space-between; gap: 2cqw; padding: 0 2cqw; font-size: 1.8cqw; font-weight: 700; letter-spacing: 0.22em; text-transform: uppercase; color: #2f6f63; }
    .rr-bar-code { letter-spacing: 0.1em; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; min-width: 0; }

    .rr-table { flex: none; margin-top: 1.4cqw; }
    .rr-th { display: flex; justify-content: space-between; padding: 0.9cqw 0; border-bottom: 1px solid rgba(107,114,128,0.6); font-size: 1.7cqw; font-weight: 700; text-transform: uppercase; letter-spacing: 0.25em; color: #6b7280; }
    .rr-tgrid { display: grid; grid-template-columns: 1fr 1fr; column-gap: 3cqw; }
    .rr-cell { display: flex; justify-content: space-between; align-items: baseline; gap: 1.5cqw; padding: 1cqw 0; border-bottom: 1px dotted #cfd3d8; min-width: 0; }
    .rr-wide { grid-column: 1 / -1; border-bottom: 1px solid rgba(107,114,128,0.6); }
    .rr-l { font-size: 1.8cqw; text-transform: uppercase; letter-spacing: 0.12em; color: #6b7280; flex: none; }
    .rr-v { font-size: 2.4cqw; font-weight: 700; color: #111827; text-align: right; line-height: 1.15; text-transform: uppercase; overflow: hidden; text-overflow: ellipsis; min-width: 0; }
    .rr-blue { color: #3b8fd0; }
    .rr-orange { color: #EA7645; }

    .rr-figs { flex: 1 1 0; min-height: 18cqw; margin-top: 2.4cqw; display: grid; grid-template-columns: 1fr 1fr; gap: 2.4cqw; }
    .rr-figcol { display: flex; flex-direction: column; min-height: 0; min-width: 0; }
    .rr-fig { position: relative; flex: 1; min-height: 0; background: #fff; border: 1px solid rgba(107,114,128,0.7); overflow: hidden; }
    .rr-fig img { position: absolute; inset: 0.6cqw; width: calc(100% - 1.2cqw); height: calc(100% - 1.2cqw); object-fit: cover; filter: grayscale(1); opacity: 0.88; }
    .rr-chart { position: absolute; inset: 0; width: 100%; height: 100%; }
    .rr-fig.is-broken { background: repeating-linear-gradient(45deg, #f3f4f6 0 6px, #e8eaed 6px 12px); }
    .rr-fig.is-broken::after { content: 'NO IMAGE'; position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; font: 700 1.7cqw/1 system-ui, sans-serif; letter-spacing: 0.2em; color: #9ca3af; }
    .rr-cap { margin: 0.9cqw 0 0; text-align: center; font-size: 1.7cqw; letter-spacing: 0.1em; color: #6b7280; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .rr-cap b { color: #374151; }

    .rr-bottom { flex: none; margin-top: 2cqw; position: relative; z-index: 2; }
    .rr-abs { margin: 0; font-size: 2cqw; line-height: 1.6; color: #6b7280; text-align: justify; font-weight: 600; letter-spacing: 0.02em; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; word-break: break-word; }
    .rr-abs b { color: #374151; text-transform: uppercase; letter-spacing: 0.2em; }
    .rr-dl { margin-top: 1.8cqw; display: inline-flex; align-items: center; gap: 1.4cqw; min-height: 6.6cqw; padding: 0 3cqw; border-radius: 1cqw; background: #3f5a30; color: #fff; text-decoration: none; font-size: 1.9cqw; font-weight: 700; letter-spacing: 0.16em; text-transform: uppercase; transition: background-color 0.3s; }
    .rr-dl svg { width: 2.8cqw; height: 2.8cqw; }
    .rr-dl:hover, .rr-dl:active { background: #EA7645; }
    .rr-wm { position: absolute; right: -3cqw; bottom: -3cqw; width: 24cqw; height: 14cqw; background: var(--rr-logo) no-repeat center / contain; opacity: 0.08; filter: grayscale(1); pointer-events: none; }

    /* Sticky note */
    .rr-note {
        z-index: 20; right: 2%; top: 5%; width: 21cqw; height: 21cqw;
        display: flex; flex-direction: column; align-items: center; justify-content: center; overflow: hidden;
        color: #1f3a93; border: 1px solid #86a85c; border-bottom-width: 2px;
        background: linear-gradient(145deg, #a8cc80 0%, #8fb566 100%);
        transform: rotate(-3deg); transition: transform 0.5s; pointer-events: none;
    }
    .rr-note-logo { position: absolute; right: -3cqw; bottom: 1cqw; width: 13cqw; height: 9cqw; background: var(--rr-logo) no-repeat center / contain; opacity: 0.2; filter: brightness(0) invert(1); }
    .rr-note-a { font-size: 6.4cqw; line-height: 1; transform: rotate(-12deg); position: relative; }
    .rr-note-b { font-size: 4cqw; line-height: 1; margin-top: 0.6cqw; transform: rotate(-6deg); text-align: center; max-width: 100%; word-break: break-word; position: relative; }
    .rr-note-c { position: absolute; bottom: 1cqw; left: 0; right: 0; text-align: center; font: 700 1.4cqw/1 system-ui, sans-serif; letter-spacing: 0.5em; text-transform: uppercase; color: rgba(61,94,32,0.7); }

    /* Efek hover hanya di perangkat dengan mouse (hemat di mobile) */
    @media (hover: hover) {
        .rr-shine { display: block; }
        .rr-card:hover .rr-shine { animation: rrShine 1.5s ease-out forwards; }
        .rr-card:hover .rr-sheet-a { transform: rotate(3deg) translateX(0.8cqw); }
        .rr-card:hover .rr-sheet-b { transform: rotate(-2.5deg) translateX(-0.8cqw); }
        .rr-card:hover .rr-doc { transform: translateY(-1.6cqw); }
        .rr-card:hover .rr-note { transform: rotate(-9deg) translateY(-1.2cqw) scale(1.05); }
        .rr-fig img { transition: filter 0.5s, opacity 0.5s; }
        .rr-card:hover .rr-fig img { filter: none; opacity: 1; }

        .modal-group:hover .mg-bg { opacity: 0.1; }
        .modal-group:hover .mg-img-wrap { z-index: 30; opacity: 1; filter: grayscale(0); transform: scale(1.1); }
        .modal-group:hover .mg-img-inner { box-shadow: 0 30px 60px rgba(0,0,0,0.3); }
    }
    @keyframes rrShine { 0% { transform: translateX(-150%) skewX(-25deg); opacity: 0; } 20% { opacity: 1; } 100% { transform: translateX(150%) skewX(-25deg); opacity: 0; } }

    /* Modal */
    #akAdvancedModal { max-height: 92vh; max-height: 92dvh; overflow-y: auto; }
    #akAdvancedModal.show { opacity: 1; transform: scale(1); }
    .modal-group.is-highlighted .mg-bg { opacity: 0.1; }
    .modal-group.is-highlighted .mg-img-wrap { z-index: 30; opacity: 1; filter: grayscale(0); transform: scale(1.1); }
    .modal-group.is-highlighted .mg-img-inner { box-shadow: 0 30px 60px rgba(0,0,0,0.3); }
    @media (min-width: 400px) { .xs\:inline-block { display: inline-block; } }

    @media (prefers-reduced-motion: reduce) {
        .rr-card { opacity: 1; animation: none !important; }
        .liquid-dots span { animation: none; }
        .animate-fade-up, .animate-slide-fade { animation: none !important; opacity: 1 !important; transform: none !important; }
    }
</style>

<script>
    let isModalOpen = false;
    let modalTimer = 0;

    function setModalTitle(el, title) {
        el.textContent = '';
        const i = title.length > 15 ? title.indexOf(' ') : -1;
        if (i > 0) {
            el.append(title.slice(0, i), document.createElement('br'), title.slice(i + 1));
        } else {
            el.textContent = title;
        }
    }

    function openModal(element) {
        const modal = document.getElementById('imageModal');
        const modalInner = document.getElementById('akAdvancedModal');
        const img = document.getElementById('modalImg');

        clearTimeout(modalTimer);

        img.style.visibility = '';
        img.src = element.getAttribute('data-src') || '';
        setModalTitle(document.getElementById('modalTitle'), element.getAttribute('data-title') || '');
        document.getElementById('modalCategory').textContent = element.getAttribute('data-category') || '';
        document.getElementById('modalScientist').textContent = element.getAttribute('data-scientist') || '';
        document.getElementById('modalClass').textContent = element.getAttribute('data-class') || '';
        document.getElementById('modalDesc').textContent = element.getAttribute('data-desc') || '';

        // Reset highlight jika ada sisa dari modal sebelumnya
        document.getElementById('modalInteractiveArea').classList.remove('is-highlighted');
        modalInner.scrollTop = 0;

        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        void modalInner.offsetWidth;
        modalInner.classList.add('show');
        isModalOpen = true;
        document.addEventListener('keydown', handleEscapeKey);
    }

    function closeModal() {
        const modal = document.getElementById('imageModal');
        const modalInner = document.getElementById('akAdvancedModal');
        modalInner.classList.remove('show');
        document.removeEventListener('keydown', handleEscapeKey);
        isModalOpen = false;
        modalTimer = setTimeout(() => {
            modal.classList.add('hidden');
            document.getElementById('modalImg').removeAttribute('src');
            document.getElementById('modalInteractiveArea').classList.remove('is-highlighted');
            document.body.style.overflow = '';
        }, 500);
    }

    function handleEscapeKey(event) { if (event.key === 'Escape' && isModalOpen) { closeModal(); } }
    document.getElementById('modalBackdrop').addEventListener('click', closeModal);
    // Backdrop memiliki pointer-events-none, jadi klik di area kosong modal juga menutup
    document.getElementById('imageModal').addEventListener('click', (e) => {
        if (e.target === e.currentTarget) closeModal();
    });

    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('pageWrapper').style.opacity = '1';

        // Animasi muncul hanya saat kartu terlihat, lalu observer dilepas
        const cards = document.querySelectorAll('.rr-card');
        if (!('IntersectionObserver' in window)) {
            cards.forEach(c => c.classList.add('is-in'));
            return;
        }
        const io = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-in');
                    io.unobserve(entry.target);
                }
            });
        }, { threshold: 0.05, rootMargin: '0px 0px 60px 0px' });
        cards.forEach(c => io.observe(c));
    });
</script>
@endsection