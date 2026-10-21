@extends('layouts.labinfo')

@section('title', 'RHINE LAB.LLC - RHINE INFO')

@section('content')
    <div class="flex flex-col justify-center items-center text-black min-h-screen relative overflow-hidden bg-[#ECE8E5]">

        <!-- Efek cahaya latar belakang (Water depth effect) -->
        <div class="absolute w-96 h-96 bg-white/50 rounded-full blur-[80px] -top-20 -left-20 z-0 pointer-events-none"></div>
        <div class="absolute w-[30rem] h-[30rem] bg-[#EA7645]/10 rounded-full blur-[100px] bottom-0 right-0 z-0 pointer-events-none"></div>
        <div class="absolute w-72 h-72 bg-[#48AA8C]/10 rounded-full blur-[80px] top-1/2 left-1/2 -translate-x-1/2 z-0 pointer-events-none"></div>

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

        <!-- Header kanan atas (Animasi liquid dots) -->
        <div class="absolute top-6 right-6 text-xs sm:text-sm font-medium select-none tracking-wider text-gray-700 flex items-center space-x-2 opacity-0 animate-fade-up z-10"
            style="animation-delay:0.4s;">
            <span>SELECTING FILES</span>
            <div class="liquid-dots flex space-x-[4px] ml-1">
                <span class="bg-[#EA7645]"></span>
                <span class="bg-[#C8B9A9]"></span>
                <span class="bg-[#48AA8C]"></span>
            </div>
        </div>

        <!-- Konten Tengah -->
        <div class="flex flex-col items-center text-center z-10 select-none w-full px-6 mt-24 mb-20 relative">
            <h2 class="text-lg sm:text-xl md:text-2xl font-semibold tracking-widest uppercase text-gray-700 mb-8 opacity-0 animate-fade-up"
                style="animation-delay:0.6s;">
                Available Files
            </h2>

            <!-- Scroll Container -->
            <div class="w-full max-w-5xl h-[65vh] overflow-y-auto overflow-x-hidden pr-4 custom-scroll">
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-10 pb-10">
                    @forelse ($files as $file)
                        <div x-data="{ open: false }" x-init="open = false" class="relative">
                            
                            <!-- Card Pembungkus (Hover Trigger) -->
                            <div @click="open = true"
                                class="relative group cursor-pointer h-40 flex flex-col justify-center opacity-0 animate-fade-scale rounded-2xl"
                                style="animation-delay: {{ 0.8 + $loop->index * 0.1 }}s;">
                                
                                <!-- Background Liquid Glass (Muncul & Memantul saat Hover) -->
                                <div class="absolute inset-0 bg-[#dcd9d2]/50 backdrop-blur-md border border-white/60 rounded-2xl opacity-0 transform scale-75 group-hover:opacity-100 group-hover:scale-100 transition-all duration-700 cubic-bloop pointer-events-none z-0 overflow-hidden shadow-lg">
                                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/50 to-transparent -translate-x-[150%] skew-x-[-25deg] group-hover:animate-water-shine"></div>
                                </div>

                                <!-- Konten Card -->
                                <div class="relative z-10 p-5 flex flex-col justify-between w-full h-full">
                                    
                                    <!-- Header Ala ID Card (Rhine Lab Badge & File No) -->
                                    <div class="flex justify-between items-center opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-100">
                                        <div class="flex items-center gap-1.5">
                                            <img src="{{ asset('images/logo.png') }}" class="h-4 object-contain filter grayscale opacity-80">
                                            <!-- BADGE RHINE LAB SEBELAH LOGO -->
                                            <span class="bg-[#dfdcd3] border border-[#a8a49c] text-gray-800 text-[8px] font-extrabold px-1.5 py-0.2 tracking-widest shadow-sm">RHINE LAB</span>
                                            <div class="h-[1px] w-6 md:w-10 bg-gray-500"></div>
                                        </div>
                                        <div class="text-[7.5px] text-right text-gray-600 font-extrabold uppercase tracking-widest leading-tight">
                                            <p>FILE NO.</p>
                                            <p>RF-{{ sprintf('%03d', $loop->iteration) }}</p>
                                        </div>
                                    </div>

                                    <!-- Bagian Tengah (Teks & Gambar Barang Opacity Tipis) -->
                                    <div class="flex justify-between items-center z-10 relative my-auto">
                                        
                                        <!-- Teks Kiri -->
                                        <div class="flex flex-col text-left transition-all duration-500">
                                            <div class="w-4 h-[2px] bg-gray-500 mb-1 ml-3 opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-100"></div>
                                            
                                            <!-- KOTAK HITAM NAMA ITEM -->
                                            <div class="px-3 py-1 -ml-3 transition-all duration-500 bg-transparent group-hover:bg-[#2c2c2c] border-transparent group-hover:border-l-4 group-hover:border-[#9b968c]">
                                                <p class="font-extrabold text-gray-900 group-hover:text-gray-100 text-lg sm:text-xl tracking-widest uppercase transition-colors duration-500">
                                                    {{ $file->name }}
                                                </p>
                                            </div>

                                            <div class="flex items-center gap-2 mt-1 pl-1 opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-100">
                                                <span class="text-[9px] font-extrabold text-gray-700 tracking-[0.2em] uppercase">{{ $file->category }} SECTION</span>
                                                <div class="w-1.5 h-1.5 bg-[#2c2c2c]"></div>
                                            </div>
                                        </div>

                                        <!-- GAMBAR BARANG (Awalnya Opacity Tipis 25% -> Full saat Hover) -->
                                        <div class="relative flex items-center justify-center">
                                            <div class="absolute inset-0 bg-white/70 blur-xl rounded-full transform scale-0 opacity-0 group-hover:opacity-100 group-hover:scale-150 transition-all duration-700 delay-100"></div>
                                            <img src="{{ asset($file->file_path) }}" alt="{{ $file->name }}"
                                                class="w-16 h-16 sm:w-20 sm:h-20 object-contain relative z-10 
                                                       opacity-25 filter grayscale group-hover:grayscale-0 group-hover:opacity-100 
                                                       transform scale-90 group-hover:scale-110 group-hover:-translate-y-1 
                                                       transition-all duration-700 cubic-bloop drop-shadow-md group-hover:drop-shadow-2xl">
                                        </div>
                                    </div>

                                    <!-- Footer Card (Teks Peringatan/Larangan) -->
                                    <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-200">
                                        <div class="w-3 h-[2px] bg-[#2c2c2c]"></div>
                                        <p class="text-[6px] text-gray-600 leading-none uppercase font-extrabold tracking-widest">
                                            RESTRICTED ACCESS • DO NOT COPY OR DISTRIBUTE • INTERNAL LAB USE ONLY
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Overlay Modal -->
                            <div x-show="open" x-transition.opacity x-cloak class="fixed inset-0 bg-black/40 backdrop-blur-sm z-40"
                                @click="open = false"></div>

                            <!-- MODAL POPUP REPLICA -->
                            <div x-show="open" x-transition:enter="transition transform duration-700 cubic-bloop"
                                x-transition:enter-start="opacity-0 scale-75 translate-y-12"
                                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                x-transition:leave="transition transform duration-300 ease-in"
                                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                x-transition:leave-end="opacity-0 scale-90 translate-y-6" x-cloak
                                class="fixed inset-0 z-50 flex items-center justify-center p-4 md:p-6 pointer-events-none">
                                
                                <div class="ak-modal pointer-events-auto">
                                    
                                    <!-- Background Modal & Watermark RL -->
                                    <div class="absolute inset-0 bg-[#d8d5cd]/80 backdrop-blur-xl border border-white/60 z-0 rounded-2xl"></div>
                                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-[14rem] font-black text-black/5 select-none z-0 tracking-tighter">
                                        RL
                                    </div>

                                    <div class="relative z-10 p-6 md:p-8 flex flex-col h-full w-full">
                                        
                                        <!-- Header Modal -->
                                        <div class="flex justify-between items-center mb-8 md:mb-12">
                                            <div class="flex items-center gap-2">
                                                <img src="{{ asset('images/logo.png') }}" class="h-6 object-contain filter grayscale opacity-80">
                                                <span class="bg-[#dfdcd3] border border-[#a8a49c] text-gray-800 text-[9px] md:text-[10px] font-extrabold px-2 py-0.5 tracking-widest shadow-sm">RHINE LAB</span>
                                                <div class="h-[2px] w-12 md:w-24 bg-gray-500"></div>
                                            </div>
                                            <div class="text-[8px] md:text-[10px] text-right text-gray-600 font-extrabold uppercase tracking-widest leading-relaxed">
                                                <p>FILE NO. / DOCUMENT NO.</p>
                                                <p>RF-{{ sprintf('%03d', $loop->iteration) }}-05</p>
                                            </div>
                                        </div>

                                        <!-- Body Layout -->
                                        <div class="flex flex-col md:flex-row justify-between items-center mb-8 md:mb-12 relative">
                                            
                                            <!-- Kiri: Black Box & Data -->
                                            <div class="flex flex-col items-start gap-1 w-full md:w-1/2">
                                                <div class="w-6 h-[2px] bg-gray-500 mb-1"></div>
                                                
                                                <!-- KOTAK HITAM NAMA ITEM -->
                                                <div class="bg-[#2c2c2c] text-gray-100 px-5 md:px-6 py-2 shadow-lg border-l-4 border-[#9b968c]">
                                                    <h2 class="text-xl md:text-2xl font-extrabold tracking-widest uppercase">{{ $file->name }}</h2>
                                                </div>
                                                
                                                <div class="flex items-center gap-2 mt-2 pl-1">
                                                    <span class="text-[10px] md:text-xs font-extrabold text-gray-800 tracking-[0.2em] uppercase">{{ $file->category }} SECTION</span>
                                                    <div class="w-2.5 h-2.5 bg-[#2c2c2c]"></div>
                                                </div>

                                                <!-- Spesifikasi File -->
                                                <div class="mt-6 flex flex-col gap-2.5 pl-1">
                                                     <div class="flex items-center gap-4 text-xs font-extrabold text-gray-500 tracking-widest uppercase">
                                                         <span class="w-16">Type</span> <span class="text-gray-900">{{ $file->type }}</span>
                                                     </div>
                                                     <div class="flex items-center gap-4 text-xs font-extrabold text-gray-500 tracking-widest uppercase">
                                                         <span class="w-16">Size</span> <span class="text-gray-900">{{ $file->size }}</span>
                                                     </div>
                                                </div>
                                            </div>

                                            <!-- Kanan: Aksen & Gambar Full -->
                                            <div class="relative flex items-center justify-center w-full md:w-1/2 mt-8 md:mt-0">
                                                <div class="absolute right-4 md:right-8 top-1/2 -translate-y-1/2 text-[5rem] md:text-[7rem] font-black text-[#2c2c2c] leading-none tracking-tighter opacity-80 z-0">
                                                    {{ strtoupper(substr($file->category ?? 'SYS', 0, 3)) }}
                                                </div>
                                                <div class="absolute right-0 md:right-4 top-0 w-12 h-12 md:w-16 md:h-16 border-[6px] md:border-8 border-[#EA7645] z-0 opacity-80 -mt-2"></div>
                                                
                                                <img src="{{ asset($file->file_path) }}" class="w-32 h-32 md:w-44 md:h-44 object-contain z-10 drop-shadow-2xl">
                                            </div>
                                        </div>

                                        <!-- Footer Modal (Teks Larangan, Tombol Download & Close) -->
                                        <div class="flex justify-between items-center mt-auto pt-4 border-t border-gray-400/30">
                                            <div class="flex items-center gap-2">
                                                <div class="w-4 md:w-6 h-[2px] bg-[#2c2c2c]"></div>
                                                <p class="text-[7px] md:text-[9px] font-extrabold text-gray-700 leading-tight uppercase tracking-widest">
                                                    STRICTLY CONFIDENTIAL • FOR INTERNAL USE ONLY
                                                </p>
                                            </div>
                                            
                                            <div class="flex items-center gap-3">
                                                <!-- TOMBOL DOWNLOAD TAMBAHAN -->
                                                <a href="{{ asset($file->file_path) }}" download="{{ $file->name }}" class="bg-[#2c2c2c] border border-[#2c2c2c] text-white text-[9px] md:text-[10px] font-extrabold px-4 md:px-5 py-1.5 md:py-2 uppercase tracking-[0.2em] hover:bg-[#EA7645] hover:border-[#EA7645] transition-all duration-300 shadow-sm flex items-center gap-1.5">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                    </svg>
                                                    <span>Download</span>
                                                </a>

                                                <button @click="open = false" class="bg-transparent border border-gray-600 text-gray-800 text-[9px] md:text-[10px] font-extrabold px-4 md:px-5 py-1.5 md:py-2 uppercase tracking-[0.25em] hover:bg-gray-400/20 transition-all duration-300 shadow-sm">
                                                    Close
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="col-span-full text-gray-500 italic opacity-0 animate-fade-up">No files available</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Footer kanan bawah  -->
        <div class="absolute bottom-3 right-3 text-[10px] sm:text-xs md:text-sm lg:text-base font-light select-none opacity-0 animate-fade-up z-10"
            style="animation-delay: 1.6s;">
            POWERED BY <span class="font-bold">RHINE LAB</span>
        </div>

        <!-- Footer tengah bawah -->
        <div class="absolute bottom-2 w-full text-center text-[11px] text-gray-500 tracking-wide select-none opacity-0 animate-fade-up z-10"
            style="animation-delay:1.6s;">
            Internal Database
        </div>

        <!-- Tombol Kembali -->
        <div class="absolute bottom-4 left-4 z-20">
            <a href="{{ url('/') }}"
                class="group relative flex items-center justify-center p-3 px-4 transition-all duration-300">
                
                <div class="absolute inset-0 bg-[#dcd9d2]/40 backdrop-blur-md border border-white/50 opacity-0 transform scale-50 group-hover:opacity-100 group-hover:scale-100 transition-all duration-700 cubic-bloop rounded-full pointer-events-none z-0 shadow-lg"></div>

                <div class="relative z-10 flex items-center text-gray-800 font-extrabold uppercase tracking-[0.2em] text-[10px] md:text-xs transition-colors duration-300 group-hover:text-[#2c2c2c]">
                    <span class="mr-2 inline-block transform translate-x-3 opacity-0 transition-all duration-700 cubic-bloop group-hover:translate-x-0 group-hover:opacity-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5m6 6l-6-6 6-6" />
                        </svg>
                    </span>
                    <span class="transition-transform duration-700 cubic-bloop group-hover:translate-x-0 -translate-x-2">Back</span>
                </div>
            </a>
        </div>
    </div>

    <style>
        [x-cloak] { display: none !important; }

        /* =========================================
           ANIMATION & CURVES
           ========================================= */
        .cubic-bloop { transition-timing-function: cubic-bezier(0.34, 1.56, 0.64, 1); }

        @keyframes waterShine {
            0% { transform: translateX(-150%) skewX(-25deg); opacity: 0; }
            20% { opacity: 1; }
            100% { transform: translateX(150%) skewX(-25deg); opacity: 0; }
        }
        .animate-water-shine { animation: waterShine 1.5s ease-out forwards; }

        @keyframes liquidBreathe {
            0% { transform: scaleY(1); opacity: 0.5; border-radius: 999px; }
            50% { transform: scaleY(2.2); opacity: 1; border-radius: 2px; }
            100% { transform: scaleY(1); opacity: 0.5; border-radius: 999px; }
        }
        .liquid-dots span {
            display: block; width: 6px; height: 6px; border-radius: 999px;
            animation: liquidBreathe 1.5s ease-in-out infinite alternate;
        }
        .liquid-dots span:nth-child(1) { animation-delay: 0s; }
        .liquid-dots span:nth-child(2) { animation-delay: 0.3s; }
        .liquid-dots span:nth-child(3) { animation-delay: 0.6s; }

        /* =========================================
           UI MODAL REPLICA (Document Slip)
           ========================================= */
        .ak-modal {
            width: 100%;
            max-width: 44rem;
            min-height: 24rem;
            border-radius: 1rem;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            position: relative;
            box-shadow: 0 40px 80px -20px rgba(0, 0, 0, 0.25);
        }

        /* =========================================
           SCROLLBAR & GLOBALS
           ========================================= */
        .custom-scroll::-webkit-scrollbar { width: 6px; }
        .custom-scroll::-webkit-scrollbar-track { background: transparent; }
        .custom-scroll::-webkit-scrollbar-thumb { background: rgba(0,0,0, 0.15); border-radius: 9999px; }
        .custom-scroll::-webkit-scrollbar-thumb:hover { background: rgba(0,0,0, 0.3); }

        @keyframes fadeUp { 0% { opacity: 0; transform: translateY(20px); } 100% { opacity: 1; transform: translateY(0); } }
        .animate-fade-up { animation: fadeUp 0.8s forwards; }
        @keyframes fadeScale { 0% { opacity: 0; transform: translateY(20px) scale(0.95); } 100% { opacity: 1; transform: translateY(0) scale(1); } }
        .animate-fade-scale { animation: fadeScale 0.7s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; }
        @keyframes slideFade { 0% { opacity: 0; transform: translateX(-20px); } 100% { opacity: 1; transform: translateX(0); } }
        .animate-slide-fade { animation: slideFade 0.8s forwards; }
    </style>
@endsection