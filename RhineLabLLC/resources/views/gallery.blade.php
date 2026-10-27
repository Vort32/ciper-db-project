@extends('layouts.gla')

@section('title', 'RHINE LAB.LLC - RESEARCH')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Caveat:wght@700&family=Oswald:wght@500;600;700&display=swap" rel="stylesheet">
<div id="pageWrapper"
    class="flex flex-col justify-center items-center min-h-screen bg-[#ECE8E5] text-black relative overflow-hidden transition-opacity duration-700 opacity-0">

    <!-- Efek cahaya latar belakang (Liquid Glass environment) -->
    <div class="absolute w-96 h-96 bg-white/60 rounded-full blur-[80px] -top-20 -left-20 z-0 pointer-events-none"></div>
    <div class="absolute w-[30rem] h-[30rem] bg-[#EA7645]/15 rounded-full blur-[100px] bottom-0 right-0 z-0 pointer-events-none"></div>
    <div class="absolute w-72 h-72 bg-[#48AA8C]/15 rounded-full blur-[80px] top-1/2 left-1/2 -translate-x-1/2 z-0 pointer-events-none"></div>

    <!-- Header kiri atas -->
    <div class="absolute top-6 left-6 leading-tight select-none space-y-1 animate-slide-fade z-10"
        style="animation-delay:0.2s;">
        <h1 class="text-xl sm:text-2xl font-bold">RHINE LAB</h1>
        <p class="text-[9px] sm:text-[10px] tracking-[0.2em] uppercase font-extralight">
            SYNTHESIZE INFORMATION
        </p>
        <p class="text-sm sm:text-lg md:text-xl">
            ANALYSIS <span class="font-bold">OS</span>
        </p>
    </div>

    <!-- Header kanan atas -->
    <div class="absolute top-6 right-6 text-xs sm:text-sm font-medium select-none tracking-wider text-gray-700 flex items-center space-x-2 opacity-0 animate-fade-up z-10"
        style="animation-delay:0.4s;">
        <span class="hidden sm:inline">SYNCING DATA</span>
        <div class="liquid-dots flex space-x-[4px] ml-1">
            <span class="bg-[#EA7645]"></span>
            <span class="bg-[#C8B9A9]"></span>
            <span class="bg-[#48AA8C]"></span>
        </div>
    </div>

    <!-- Kontainer Tengah Galeri -->
    <div class="flex flex-col items-center text-center z-10 select-none w-full px-3 sm:px-6 mt-20 sm:mt-24 mb-16 sm:mb-20 relative">
        <h2 class="text-base sm:text-xl md:text-2xl font-semibold tracking-widest uppercase text-gray-700 mb-6 sm:mb-8 opacity-0 animate-fade-up"
            style="animation-delay:0.6s;">
            Research Reports
        </h2>

        <!-- Kontainer Galeri (Scrollable & Responsive) -->
        <div class="w-full max-w-[72rem] h-[72vh] sm:h-[68vh] overflow-y-auto overflow-x-hidden px-1 sm:pr-4 custom-scroll pb-24 pt-2">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-6 sm:gap-x-10 gap-y-12 sm:gap-y-14">

            @forelse($records as $index => $record)
                @php
                    // PENENTUAN IKON FILE MINIMALIS
                    $fileExt = strtolower(pathinfo($record->file_path ?? '', PATHINFO_EXTENSION));
                    $iconData = match(true) {
                        in_array($fileExt, ['pdf']) => ['label' => 'PDF', 'bg' => 'bg-[#b91c1c] text-white border-[#991b1b]'],
                        in_array($fileExt, ['doc', 'docx']) => ['label' => 'DOCX', 'bg' => 'bg-[#1d4ed8] text-white border-[#1e40af]'],
                        in_array($fileExt, ['xls', 'xlsx', 'csv']) => ['label' => 'XLSX', 'bg' => 'bg-[#047857] text-white border-[#065f46]'],
                        in_array($fileExt, ['ppt', 'pptx']) => ['label' => 'PPTX', 'bg' => 'bg-[#c2410c] text-white border-[#9a3412]'],
                        in_array($fileExt, ['zip', 'rar', '7z']) => ['label' => 'ZIP', 'bg' => 'bg-[#6b21a8] text-white border-[#581c87]'],
                        in_array($fileExt, ['png', 'jpg', 'jpeg', 'webp']) => ['label' => 'IMG', 'bg' => 'bg-[#0f766e] text-white border-[#115e59]'],
                        default => ['label' => 'FILE', 'bg' => 'bg-[#374151] text-white border-[#1f2937]']
                    };

                    // HELPER PENGECEKAN URL
                    $resolveUrl = function(?string $path) {
                        if (!$path) return null;
                        return \Illuminate\Support\Str::startsWith($path, ['http://', 'https://']) 
                            ? $path 
                            : asset($path);
                    };

                    $fig1Path = $resolveUrl($record->image_path) 
                        ?? $resolveUrl($record->thumbnail_path) 
                        ?? asset('images/gallery1.jpg');
                        
                    $fig2Path = $resolveUrl($record->thumbnail_path);

                    $project = $record->project;
                    $division = $project?->division;
                    $scientist = $record->user;
                    
                    $statusText = match(strtolower($record->status)) {
                        'draft' => 'DRAFT',
                        'revisi_1' => 'REV 1',
                        'revisi_2' => 'REV 2',
                        'revisi_3' => 'REV 3',
                        'final' => 'FINAL',
                        default => strtoupper(str_replace('_', ' ', $record->status))
                    };

                    $recordYear = $record->recorded_at ? \Carbon\Carbon::parse($record->recorded_at)->format('Y') : $record->created_at->format('Y');
                @endphp
                
                <div onclick="openModal(this)"
                    data-src="{{ $fig1Path }}"
                    data-title="{{ $project->title ?? $record->record_code }}"
                    data-category="{{ $project->reference_code ?? 'RESEARCH SECTION' }}"
                    data-class="{{ strtoupper($record->classification) }}"
                    data-scientist="{{ $scientist->name ?? 'Classified' }}"
                    data-desc="{{ $record->summary }}"
                    class="relative group cursor-pointer h-[32rem] flex flex-col justify-end opacity-0 animate-fade-scale"
                    style="animation-delay: {{ 0.8 + ($index * 0.1) }}s;">
                    
                    <!-- LAYER 1: BASE FOLDER (TANPA SHADOW) -->
                    <div class="absolute inset-0 rounded-md border border-[#2f4424]/70 transform scale-95 group-hover:scale-100 transition-all duration-700 cubic-bloop overflow-hidden"
                         style="background: linear-gradient(160deg,#6d8c55 0%,#506e3c 45%,#3f5a30 100%);">
                        <div class="absolute inset-0 pointer-events-none" style="background: radial-gradient(ellipse at 40% 35%, rgba(255,255,255,0.10) 0%, rgba(0,0,0,0) 45%, rgba(0,0,0,0.30) 100%);"></div>
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/40 to-transparent -translate-x-[150%] skew-x-[-25deg] group-hover:animate-water-shine"></div>
                        <svg class="absolute bottom-[16%] -left-10 w-28 h-28 text-white/25 pointer-events-none" viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="11">
                            <circle cx="50" cy="50" r="40"/>
                            <path d="M50 30v40M30 50h40" stroke-linecap="round"/>
                        </svg>
                        <p class="absolute bottom-1.5 left-4 text-[5px] tracking-[0.6em] font-bold uppercase text-white/30 pointer-events-none">Rhine Lab Archive</p>
                    </div>

                    <!-- LAYER 2a & 2b: LEMBAR HIJAU (TANPA SHADOW) -->
                    <div class="absolute left-[10%] right-[2%] top-[9%] bottom-[5%] bg-[#c6d6b4] border border-[#a9c08f] rotate-[1.4deg] transition-transform duration-700 cubic-bloop group-hover:rotate-[3deg] group-hover:translate-x-1 pointer-events-none"></div>
                    <div class="absolute left-[7%] right-[5%] top-[6%] bottom-[7%] border border-[#8fab74] -rotate-[0.8deg] transition-transform duration-700 cubic-bloop group-hover:-rotate-[2.5deg] group-hover:-translate-x-1 pointer-events-none"
                         style="background-color:#a9c08f; background-image: repeating-linear-gradient(to bottom, rgba(45,65,35,0.26) 0, rgba(45,65,35,0.26) 1px, transparent 1px, transparent 4px), linear-gradient(to right, rgba(255,255,255,0.02), rgba(255,255,255,0.22));"></div>

                    <!-- NOMOR BERKAS -->
                    <div class="absolute top-3 left-4 z-[5] flex items-start gap-2 text-white pointer-events-none font-condensed">
                        <div class="leading-none">
                            <div class="text-[2.6rem] font-bold tracking-tight leading-[0.9]">NO.</div>
                            <div class="mt-1 text-[9px] font-semibold tracking-[0.12em] uppercase leading-[1.2]">
                                <p>Lab Report</p>
                                <p>Sealed File</p>
                            </div>
                        </div>
                        <span class="text-[5.6rem] font-bold leading-[0.8] -ml-1">{{ $loop->iteration }}</span>
                    </div>

                    <!-- LAYER 3: TUMPUKAN KERTAS (TANPA SHADOW) -->
                    <div class="absolute left-[18%] right-[1%] top-[22%] bottom-[0.8%] bg-[#d5dac9] border border-[#b9c1a9] pointer-events-none"></div>
                    <div class="absolute left-[17%] right-[2%] top-[20%] bottom-[2.2%] bg-[#e9eadf] border border-[#c9ccbc] pointer-events-none"></div>

                    <!-- LAYER 4: DOKUMEN UTAMA (TANPA SHADOW) -->
                    <div class="doc-layer absolute left-[16%] right-[3%] top-[18%] bottom-[3.5%] z-10 border border-gray-300/90 px-3.5 sm:px-4 pt-3.5 sm:pt-4 pb-3 flex flex-col text-left pointer-events-none overflow-hidden font-report"
                         style="background-color:#f8f8f1;
                                background-image: radial-gradient(rgba(0,0,0,0.035) 1px, transparent 1px), linear-gradient(100deg, rgba(0,0,0,0.05) 0%, transparent 5%, transparent 95%, rgba(0,0,0,0.035) 100%);
                                background-size: 3px 3px, 100% 100%;">

                        <!-- Kop Surat Rhine Lab -->
                        <div class="flex items-center justify-between pb-2 border-b border-gray-300 relative" style="box-shadow: 0 1px 0 #ebebe2;">
                            <div class="flex items-center gap-2 sm:gap-3">
                                <img src="{{ asset('images/logo.png') }}" class="h-6 sm:h-8 object-contain filter grayscale contrast-125 opacity-90">
                                <div class="text-[5.5px] sm:text-[6.5px] uppercase leading-[1.35] text-gray-500 tracking-[0.12em] font-semibold text-left">
                                    <p class="text-gray-900 font-bold tracking-[0.18em]">RHINE LABORATORY</p>
                                    <p>T1 Oxford St., Columbia</p>
                                </div>
                            </div>
                        </div>

                        <!-- Judul Utama Dokumen -->
                        <div class="text-center mt-2.5">
                            <p class="text-[5.5px] tracking-[0.45em] uppercase text-gray-500 font-semibold">Laboratory Report</p>
                            <h3 class="mt-0.5 text-[10.5px] sm:text-[13px] font-bold uppercase text-black tracking-[0.06em] leading-tight line-clamp-2">{{ $project->title ?? $record->record_code }}</h3>
                            <p class="mt-0.5 text-[5.8px] sm:text-[6.5px] text-gray-800 font-bold tracking-wide">Clinical Trial / {{ strtoupper($project->reference_code ?? 'RESEARCH') }}</p>
                        </div>

                        <!-- Bar teal berisi nomor rekord -->
                        <div class="mt-1.5 h-3.5 w-full bg-[#d3e8e3] flex items-center justify-between px-2 text-[5.5px] font-bold tracking-[0.25em] uppercase text-[#2f6f63]">
                            <span>Record No.</span>
                            <span>{{ $record->record_code }}</span>
                        </div>

                        <!-- Tabel Spesifikasi Data -->
                        <div class="mt-1.5 text-[6.5px] text-gray-600 leading-none">
                            <div class="flex justify-between items-baseline py-[2.5px] border-b border-gray-400/60 text-[5.5px] font-bold uppercase tracking-[0.25em] text-gray-500">
                                <span class="text-left">Parameter</span>
                                <span class="text-right">Value</span>
                            </div>
                            <div class="flex justify-between items-baseline py-[2.5px] border-b border-dotted border-gray-300">
                                <span class="text-left uppercase tracking-wider text-[5.5px] text-gray-500">Class</span>
                                <span class="text-right uppercase font-bold text-[#3b8fd0]">{{ strtoupper($record->classification) }}</span>
                            </div>
                            <div class="flex justify-between items-baseline py-[2.5px] border-b border-dotted border-gray-300">
                                <span class="text-left uppercase tracking-wider text-[5.5px] text-gray-500">Status</span>
                                <span class="text-right uppercase font-bold text-[#3b8fd0]">{{ $statusText }}</span>
                            </div>
                            <div class="flex justify-between items-baseline py-[2.5px] border-b border-dotted border-gray-300">
                                <span class="text-left uppercase tracking-wider text-[5.5px] text-gray-500">Year</span>
                                <span class="text-right font-bold text-gray-900">{{ $recordYear }}</span>
                            </div>
                            <div class="flex justify-between items-baseline py-[2.5px] border-b border-dotted border-gray-300">
                                <span class="text-left uppercase tracking-wider text-[5.5px] text-gray-500">Division</span>
                                <span class="text-right font-bold text-gray-900 uppercase">{{ strtoupper($division->code ?? 'DIV') }}</span>
                            </div>
                            <div class="flex justify-between items-baseline gap-2 py-[2.5px] border-b border-gray-400/60">
                                <span class="text-left uppercase tracking-wider text-[5.5px] text-gray-500 shrink-0">Scientist</span>
                                <span class="text-right font-bold text-[#EA7645] leading-tight truncate">{{ $scientist->name ?? 'OPERATIVE' }}</span>
                            </div>
                        </div>

                        <!-- Dua Figur -->
                        <div class="mt-2 grid grid-cols-2 gap-2 flex-1 min-h-0">
                            <div class="flex flex-col min-h-0">
                                <div class="relative flex-1 min-h-0 border border-gray-500/70 bg-white p-[2px]">
                                    <img src="{{ $fig1Path }}" class="w-full h-full object-cover filter grayscale opacity-85 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-700">
                                </div>
                                <p class="mt-0.5 text-center text-[5.5px] text-gray-500 tracking-[0.15em] font-semibold"><span class="font-bold text-gray-700">Fig. 1</span> — Dokumentasi</p>
                            </div>
                            <div class="flex flex-col min-h-0">
                                <div class="relative flex-1 min-h-0 border border-gray-500/70 bg-white">
                                    @if($fig2Path)
                                        <div class="p-[2px] w-full h-full">
                                            <img src="{{ $fig2Path }}" class="w-full h-full object-cover filter grayscale opacity-85 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-700">
                                        </div>
                                    @else
                                        <svg viewBox="0 0 100 100" class="w-full h-full" preserveAspectRatio="xMidYMid meet" fill="none" stroke="#333" stroke-width="0.8" font-family="Times New Roman, serif">
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
                                <p class="mt-0.5 text-center text-[5.5px] text-gray-500 tracking-[0.15em] font-semibold"><span class="font-bold text-gray-700">Fig. 2</span> — Pratinjau Riset</p>
                            </div>
                        </div>

                        <!-- Abstrak & Tombol Download -->
                        <div class="mt-1.5 relative">
                            <p class="text-[5.5px] leading-[1.6] text-gray-500 text-justify line-clamp-3 font-semibold tracking-wide pr-12">
                                <span class="font-bold uppercase tracking-[0.2em] text-gray-700">Abstract — </span>{{ $record->summary }}
                            </p>
                            
                            @if($record->file_path)
                                <div class="mt-1.5 relative z-20 pointer-events-auto">
                                    <a href="{{ route('research-records.download', $record->id) }}" onclick="event.stopPropagation();" class="inline-flex items-center gap-1 bg-[#3f5a30] hover:bg-[#EA7645] text-white px-2 py-0.5 rounded transition-colors text-[5px] font-bold uppercase tracking-widest">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-2 w-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                                        Download Dokumen
                                    </a>
                                </div>
                            @endif

                            <div class="absolute -bottom-3 -right-4 opacity-[0.09] pointer-events-none">
                                <img src="{{ asset('images/logo.png') }}" class="w-20 grayscale">
                            </div>
                        </div>
                    </div>

                    <!-- LAYER 5: STICKY NOTE DINAMIS (TANPA SHADOW) -->
                    <div class="absolute right-[1%] top-[8%] z-20 w-[4.5rem] h-[4.5rem] sm:w-[5rem] sm:h-[5rem] border border-[#86a85c] text-[#1f3a93] transform -rotate-[3deg] group-hover:-rotate-[9deg] group-hover:-translate-y-2 group-hover:scale-105 transition-all duration-700 cubic-bloop flex flex-col items-center justify-center overflow-hidden pointer-events-none"
                         style="background: linear-gradient(145deg,#a8cc80 0%,#8fb566 100%);">
                        <img src="{{ asset('images/logo.png') }}" class="absolute -right-3 bottom-1 w-12 opacity-20 brightness-0 invert">
                        <span class="font-signature text-[1.2rem] sm:text-[1.35rem] leading-none transform -rotate-12">Check</span>
                        <span class="font-signature text-xs sm:text-sm leading-none transform -rotate-6 mt-0.5 break-words max-w-full text-center">{{ $statusText }}</span>
                        <span class="absolute bottom-1 left-0 right-0 text-center text-[4px] sm:text-[4.5px] tracking-[0.5em] font-bold uppercase text-[#3d5e20]/70">Rhine Lab</span>
                    </div>

                    <!-- IKON FORMAT FILE MINIMALIS DI SAMPING STICKY NOTE -->
                    @if($record->file_path)
                        <div class="absolute right-[22%] sm:right-[20%] top-[9%] z-20 px-2 py-0.5 rounded-[3px] border font-mono text-[7px] font-extrabold tracking-wider uppercase transition-transform duration-700 cubic-bloop group-hover:-translate-y-1 pointer-events-none {{ $iconData['bg'] }}">
                            <span>{{ $iconData['label'] }}</span>
                        </div>
                    @endif

                </div>
            @empty
                <p class="col-span-full text-gray-500 italic opacity-0 animate-fade-up">No files available</p>
            @endforelse
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="absolute bottom-3 right-3 text-[9px] sm:text-xs md:text-sm font-light select-none opacity-0 animate-fade-up z-10" style="animation-delay: 1.6s;">
        POWERED BY <span class="font-bold">RHINE LAB</span>
    </div>
    <div class="absolute bottom-2 w-full text-center text-[10px] sm:text-[11px] text-gray-500 tracking-wide select-none opacity-0 animate-fade-up z-10" style="animation-delay:1.6s;">
        Internal Database
    </div>
    
    <!-- Tombol Back Utama -->
    <div class="fixed bottom-6 left-5 z-50">
        <a href="{{ url('/') }}" class="group relative flex items-center justify-center p-2.5 sm:p-3 px-3.5 sm:px-4 bg-[#ECE8E5]/90 sm:bg-transparent backdrop-blur-md sm:backdrop-blur-none rounded-full border border-gray-400/40 sm:border-transparent transition-all duration-300">
            <div class="absolute inset-0 bg-[#dcd9d2]/60 backdrop-blur-md border border-white/60 opacity-0 transform scale-50 group-hover:opacity-100 group-hover:scale-100 transition-all duration-700 cubic-bloop rounded-full pointer-events-none z-0"></div>
            <div class="relative z-10 flex items-center text-gray-900 font-extrabold uppercase tracking-[0.2em] text-[10px] sm:text-xs transition-colors duration-300 group-hover:text-[#2c2c2c]">
                <span class="mr-1.5 sm:mr-2 inline-block transform transition-all duration-700 cubic-bloop group-hover:-translate-x-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 sm:h-4 sm:w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5m6 6l-6-6 6-6" /></svg>
                </span>
                <span>Back</span>
            </div>
        </a>
    </div>
</div>

<!-- MODAL DOCUMENT VIEWER -->
<div id="imageModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-3 sm:p-8" style="perspective: 1000px;">
    <div class="absolute inset-0 bg-black/40 backdrop-blur-md pointer-events-none transition-opacity duration-500" id="modalBackdrop"></div>

    <div id="akAdvancedModal" class="relative z-10 w-full max-w-[62rem] min-h-[50vh] sm:min-h-[55vh] bg-[#f8f7f4] rounded-[20px] overflow-hidden flex flex-col transform scale-95 opacity-0 transition-all duration-700 cubic-bloop border border-white/80">
        
        <!-- Modal Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center px-4 sm:px-10 py-3 sm:py-4 border-b border-gray-300/60 relative bg-white/60 backdrop-blur-sm z-20">
            <div class="flex items-center gap-3 sm:gap-4">
                <h2 class="text-lg sm:text-2xl font-black tracking-[0.2em] text-[#2c2c2c] uppercase">Document Viewer</h2>
                <div class="hidden sm:block h-6 w-px bg-gray-400"></div>
                <p class="hidden sm:block text-[8px] tracking-[0.3em] font-bold text-gray-400 uppercase">Rhine Lab Internal Archive</p>
            </div>
            
            <div class="flex items-center gap-2 sm:gap-3 mt-2 sm:mt-0 w-full sm:w-auto justify-between sm:justify-end">
                <div class="flex items-center gap-2">
                    <span class="px-2.5 py-0.5 text-[6.5px] sm:text-[8px] font-black tracking-widest text-[#EA7645] border border-[#EA7645]/40 rounded-full bg-[#EA7645]/10">CLASSIFIED</span>
                    <span class="px-2.5 py-0.5 text-[6.5px] sm:text-[8px] font-black tracking-widest text-[#48AA8C] border border-[#48AA8C]/40 rounded-full bg-[#48AA8C]/10">VERIFICATION: RHL-A</span>
                </div>
                <button onclick="closeModal()" class="text-2xl text-gray-400 hover:text-red-500 transition-colors duration-300 focus:outline-none p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
            <div class="absolute top-0 left-0 w-full h-[3px] bg-gradient-to-r from-[#EA7645] to-transparent opacity-80"></div>
        </div>

        <div class="flex flex-col md:flex-row flex-1 relative hex-bg">
            <!-- Left Info Panel -->
            <div class="w-full md:w-[35%] p-5 sm:p-8 flex flex-col relative z-20 border-r border-gray-300/40 bg-white/40 backdrop-blur-sm pointer-events-none">
                <div class="absolute left-6 top-8 w-1 h-6 bg-[#C4FF00]"></div> 
                <div class="pl-4 mb-4 sm:mb-8">
                    <h3 class="text-lg sm:text-xl font-black leading-none text-gray-900 tracking-widest">RHINE LAB</h3>
                    <p class="text-[6.5px] sm:text-[7px] font-extrabold tracking-[0.25em] mt-1 text-gray-500">SYNTHESIZE INFORMATION</p>
                    <p class="text-[11px] sm:text-xs tracking-[0.2em] font-medium text-gray-700 mt-1">ANALYSIS <span class="font-black text-gray-900">OS</span></p>
                </div>
                <div class="mt-auto md:mt-10 relative pointer-events-auto">
                    <div class="bg-[#242424] text-white p-4 sm:p-6 relative border-l-4 border-[#9b968c] z-10">
                        <h1 id="modalTitle" class="text-base sm:text-xl font-black uppercase leading-[1.3] tracking-widest text-white">JUDUL DOKUMEN</h1>
                        <p id="modalCategory" class="text-[7px] sm:text-[7.5px] tracking-[0.25em] text-gray-400 uppercase font-bold mt-3 sm:mt-4 pt-3 sm:pt-4 border-t border-gray-600">REFERENCE SECTION</p>
                    </div>
                </div>
            </div>

            <!-- Right Interactive Image Panel -->
            <div id="modalInteractiveArea" class="w-full md:w-[65%] relative flex items-center justify-center min-h-[35vh] sm:min-h-[45vh] modal-group overflow-hidden bg-gradient-to-br from-transparent to-white/40 cursor-pointer md:cursor-auto" onclick="this.classList.toggle('is-highlighted')">
                
                <div class="absolute inset-0 z-20 pointer-events-none transition-opacity duration-500 opacity-100 mg-bg">
                    <div class="absolute top-4 sm:top-8 left-4 sm:left-8 flex items-center gap-2">
                        <div class="w-1.5 h-1.5 rounded-full bg-gray-400"></div><div class="w-12 sm:w-16 h-[1px] bg-gray-400"></div><span class="text-[6.5px] sm:text-[7px] font-extrabold tracking-[0.25em] text-gray-500">SECTION PROFILE</span>
                    </div>
                    <div class="absolute top-4 sm:top-8 right-4 sm:right-8 text-right">
                        <span class="border border-gray-400 text-gray-500 font-bold text-[6px] sm:text-[7px] px-1.5 sm:px-2 py-0.5 tracking-[0.2em] uppercase">GENERAL ACCESS CONTENT</span>
                        <div class="bg-[#323232] text-white text-[7px] sm:text-[8px] font-black px-1.5 sm:px-2 py-0.5 mt-1 tracking-widest inline-block">RHINE LAB.LLC.</div>
                    </div>
                    <div class="absolute left-4 sm:left-8 bottom-12 sm:bottom-16">
                        <div class="text-base sm:text-lg font-black tracking-widest text-gray-800">SCIENTIST</div>
                        <div class="flex gap-1 mt-1"><div class="h-[2px] w-6 bg-[#C4FF00]"></div><div class="h-[2px] w-10 bg-gray-400"></div></div>
                        <div class="text-[7.5px] sm:text-[8px] font-black text-white tracking-[0.2em] mt-1.5 uppercase bg-black px-2 py-0.5 inline-block" id="modalScientist">NAME</div>
                    </div>
                    <div class="absolute right-4 sm:right-8 top-1/2 -translate-y-1/2">
                        <div class="bg-[#1f1f1f] text-white text-sm sm:text-base font-black px-2.5 sm:px-3 py-1 tracking-widest text-right">CLASSIFICATION</div>
                        <div class="h-[3px] w-full border border-gray-800 mt-1 p-0.5"><div class="h-full bg-gray-800 w-full"></div></div>
                        <div class="text-[8px] sm:text-[9px] font-extrabold text-gray-600 tracking-[0.2em] mt-1.5 text-right uppercase" id="modalClass">CLASS</div>
                    </div>
                </div>

                <!-- Container Utama Gambar -->
                <div class="relative z-10 w-[80%] sm:w-[70%] h-[80%] sm:h-[70%] flex items-center justify-center transition-all duration-[800ms] cubic-bloop opacity-40 grayscale-[50%] scale-90 mg-img-wrap">
                    <div class="relative bg-white p-2 border border-gray-200 transition-all duration-[800ms] mg-img-inner">
                        <img id="modalImg" src="" class="max-h-[30vh] sm:max-h-[35vh] w-auto object-contain">
                    </div>
                </div>

                <div class="absolute bottom-3 sm:bottom-4 w-[85%] sm:w-[80%] text-center z-40 pointer-events-none">
                    <p id="modalDesc" class="text-[7.5px] sm:text-[8px] font-bold text-gray-500 tracking-[0.1em] line-clamp-1 opacity-80 uppercase">Deskripsi Dokumen.</p>
                </div>
            </div>
        </div>
        
        <div class="w-full h-1 bg-gray-300 flex items-center relative z-20">
            <div class="w-1/3 h-full bg-[#1c1c1c] relative"></div>
            <div class="w-1/4 h-full bg-red-600 relative animate-pulse"></div>
        </div>
    </div>
</div>

<style>
    .cubic-bloop { transition-timing-function: cubic-bezier(0.34, 1.56, 0.64, 1); }
    @keyframes waterShine { 0% { transform: translateX(-150%) skewX(-25deg); opacity: 0; } 20% { opacity: 1; } 100% { transform: translateX(150%) skewX(-25deg); opacity: 0; } }
    .animate-water-shine { animation: waterShine 1.5s ease-out forwards; }
    @keyframes liquidBreathe { 0% { transform: scaleY(1); opacity: 0.5; border-radius: 999px; } 50% { transform: scaleY(2.2); opacity: 1; border-radius: 2px; } 100% { transform: scaleY(1); opacity: 0.5; border-radius: 999px; } }
    .liquid-dots span { display: block; width: 6px; height: 6px; border-radius: 999px; animation: liquidBreathe 1.5s ease-in-out infinite alternate; }
    .liquid-dots span:nth-child(1) { animation-delay: 0s; } .liquid-dots span:nth-child(2) { animation-delay: 0.3s; } .liquid-dots span:nth-child(3) { animation-delay: 0.6s; }
    .font-signature { font-family: 'Caveat', cursive; }
    .font-condensed { font-family: 'Oswald', 'Arial Narrow', 'Roboto Condensed', sans-serif; }
    .font-report { font-family: 'Times New Roman', Times, 'Liberation Serif', serif; }
    .hex-bg { background-color: transparent; background-image: url("data:image/svg+xml,%3Csvg width='40' height='69.282' viewBox='0 0 40 69.282' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M40 11.547L20 0 0 11.547v23.094l20 11.547 20-11.547V11.547zM20 45.034L1.155 34.148V12.376L20 1.49l18.845 10.886v21.772L20 45.034z' fill='%23000000' fill-opacity='0.025' fill-rule='evenodd'/%3E%3Cpath d='M40 46.188L20 34.641 0 46.188v23.094l20 11.547 20-11.547V46.188zM20 79.675L1.155 68.789V47.017L20 36.13l18.845 10.886v21.772L20 79.675z' fill='%23000000' fill-opacity='0.025' fill-rule='evenodd'/%3E%3C/svg%3E"); background-size: 60px 103.923px; }
    .custom-scroll::-webkit-scrollbar { width: 6px; } .custom-scroll::-webkit-scrollbar-track { background: transparent; } .custom-scroll::-webkit-scrollbar-thumb { background: rgba(0,0,0, 0.15); border-radius: 9999px; } .custom-scroll::-webkit-scrollbar-thumb:hover { background: rgba(0,0,0, 0.3); }
    @keyframes fadeUp { 0% { opacity: 0; transform: translateY(20px); } 100% { opacity: 1; transform: translateY(0); } } .animate-fade-up { animation: fadeUp 0.8s forwards; }
    @keyframes fadeScale { 0% { opacity: 0; transform: translateY(20px) scale(0.95); } 100% { opacity: 1; transform: translateY(0) scale(1); } } .animate-fade-scale { animation: fadeScale 0.7s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; }
    @keyframes slideFade { 0% { opacity: 0; transform: translateX(-20px); } 100% { opacity: 1; transform: translateX(0); } } .animate-slide-fade { animation: slideFade 0.8s forwards; }
    .line-clamp-1 { display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden; }
    .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    .line-clamp-3 { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
    #akAdvancedModal.show { opacity: 1; transform: scale(1); }

    @media (hover: hover) {
        .modal-group:hover .mg-bg { opacity: 0.1; }
        .modal-group:hover .mg-img-wrap { z-index: 30; opacity: 1; filter: grayscale(0); transform: scale(1.1); }
    }
    
    .modal-group.is-highlighted .mg-bg { opacity: 0.1; }
    .modal-group.is-highlighted .mg-img-wrap { z-index: 30; opacity: 1; filter: grayscale(0); transform: scale(1.1); }

    /* ===== ANIMASI HOVER DOKUMEN ===== */
    .doc-layer {
        transition: transform .7s cubic-bezier(.22,1,.36,1), filter .7s ease;
    }
    .doc-layer::after {
        content: ""; position: absolute; inset: 0; pointer-events: none; z-index: 5;
        background: linear-gradient(115deg, transparent 35%, rgba(255,255,255,.65) 50%, transparent 65%);
        transform: translateX(-120%);
    }
    .group:hover .doc-layer {
        transform: translateY(-8%) scale(1.02) rotate(-0.8deg);
        filter: drop-shadow(0 16px 22px rgba(0,0,0,.28));
    }
    .group:hover .doc-layer::after {
        transform: translateX(120%);
        transition: transform 1.1s ease .15s;
    }
</style>

<script>
    let isModalOpen = false;

    function openModal(element) {
        const modal = document.getElementById('imageModal');
        const modalInner = document.getElementById('akAdvancedModal');
        const src = element.getAttribute('data-src');
        const title = element.getAttribute('data-title');
        const category = element.getAttribute('data-category');
        const classification = element.getAttribute('data-class');
        const scientist = element.getAttribute('data-scientist');
        const desc = element.getAttribute('data-desc');

        document.getElementById('modalImg').src = src;
        
        let formattedTitle = title;
        if(title.length > 15 && title.indexOf(' ') !== -1) {
            formattedTitle = title.replace(/ (.+)/, '<br>$1');
        }
        document.getElementById('modalTitle').innerHTML = formattedTitle;
        document.getElementById('modalCategory').innerText = category;
        document.getElementById('modalScientist').innerText = scientist;
        document.getElementById('modalClass').innerText = classification;
        document.getElementById('modalDesc').innerText = desc;

        document.getElementById('modalInteractiveArea').classList.remove('is-highlighted');

        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        setTimeout(() => { modalInner.classList.add('show'); }, 10);
        isModalOpen = true;
        document.addEventListener('keydown', handleEscapeKey);
    }

    function closeModal() {
        const modal = document.getElementById('imageModal');
        const modalInner = document.getElementById('akAdvancedModal');
        modalInner.classList.remove('show');
        setTimeout(() => {
            modal.classList.add('hidden');
            document.getElementById('modalImg').src = "";
            document.getElementById('modalInteractiveArea').classList.remove('is-highlighted');
            document.body.style.overflow = '';
            isModalOpen = false;
            document.removeEventListener('keydown', handleEscapeKey);
        }, 500);
    }

    function handleEscapeKey(event) { if (event.key === 'Escape' && isModalOpen) { closeModal(); } }
    document.getElementById('modalBackdrop').addEventListener('click', closeModal);

    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.group');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) { entry.target.classList.add('animate-fade-scale'); }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });
        cards.forEach(card => observer.observe(card));
        document.getElementById('pageWrapper').style.opacity = '1';
    });
</script>
@endsection