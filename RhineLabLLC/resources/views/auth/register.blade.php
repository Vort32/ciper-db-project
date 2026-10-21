@extends('layouts.app')

@section('title', 'Registrasi Operatif - RHINE LAB.LLC')

@section('content')
<div id="pageWrapper" class="relative min-h-screen bg-[#ECE8E5] text-[#1c1c1c] py-12 px-4 sm:px-8 overflow-hidden transition-opacity duration-700 opacity-0">
    
    <!-- Background Ambient Glow & HQ Watermark -->
    <div class="absolute w-[45rem] h-[45rem] bg-white/40 rounded-full blur-[130px] -top-24 -left-24 z-0 pointer-events-none"></div>
    <div class="absolute w-[35rem] h-[35rem] bg-[#EA7645]/8 rounded-full blur-[100px] bottom-10 right-10 z-0 pointer-events-none"></div>
    <div class="absolute inset-0 bg-cover bg-center opacity-[0.03] pointer-events-none" style="background-image: url('{{ asset('images/Rhine_Lab_HQ1.png') }}');"></div>

    <!-- Header Left HUD -->
    <div class="absolute top-6 left-6 sm:left-8 z-20 space-y-0.5 select-none">
        <div class="flex items-center gap-2">
            <h1 class="text-xl sm:text-2xl font-black tracking-widest text-[#1c1c1c]">RHINE LAB</h1>
            <span class="bg-[#1c1c1c] text-white text-[8px] font-bold px-1.5 py-0.5 tracking-widest uppercase">REGISTRATION</span>
        </div>
        <p class="text-[9px] tracking-[0.25em] uppercase font-bold text-gray-500">INITIATE OPERATIVE ACCESS</p>
    </div>

    <!-- Header Right Link -->
    <div class="absolute top-6 right-6 sm:right-8 z-20 text-[10px] sm:text-xs font-bold tracking-widest uppercase text-gray-700 select-none">
        <a href="{{ route('login') }}" class="hover:text-[#EA7645] transition">&larr; Kembali ke Login</a>
    </div>

    <!-- MAIN CONTAINER -->
    <div class="relative z-10 max-w-4xl mx-auto mt-16 space-y-6">
        
        <div class="text-center space-y-2 select-none">
            <h2 class="text-3xl sm:text-4xl font-black tracking-widest text-[#1c1c1c] uppercase">Registrasi Operatif</h2>
            <p class="text-xs font-bold tracking-[0.2em] text-gray-500 uppercase">Inisiasi Kredensial Akses Jaringan Internal</p>
        </div>

        <div class="glass-card p-6 sm:p-10 shadow-2xl">
            <form action="{{ route('register.submit') }}" method="post" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <input type="hidden" name="organization" value="rhine-lab">

                <div class="grid gap-6 md:grid-cols-2">
                    <!-- Nama Lengkap -->
                    <label class="block text-left space-y-1.5">
                        <span class="text-[10px] font-black uppercase tracking-[0.25em] text-gray-600">Nama Lengkap</span>
                        <input type="text" name="name" value="{{ old('name') }}" required class="glass-input w-full rounded-2xl border border-white/80 bg-white/50 px-4 py-3 text-xs font-bold tracking-wider text-[#1f1f1f] shadow-sm focus:border-[#EA7645] focus:outline-none" placeholder="Contoh: Silence">
                    </label>

                    <!-- Email Operatif -->
                    <label class="block text-left space-y-1.5">
                        <span class="text-[10px] font-black uppercase tracking-[0.25em] text-gray-600">Email Operatif</span>
                        <input type="email" name="email" value="{{ old('email') }}" required class="glass-input w-full rounded-2xl border border-white/80 bg-white/50 px-4 py-3 text-xs font-bold tracking-wider text-[#1f1f1f] shadow-sm focus:border-[#EA7645] focus:outline-none" placeholder="nama@rhine-lab.com">
                    </label>
                </div>

                <div class="grid gap-6 md:grid-cols-2">
                    <!-- Password + Toggle Intip -->
                    <label class="block text-left space-y-1.5">
                        <span class="text-[10px] font-black uppercase tracking-[0.25em] text-gray-600">Kunci Akses (Password)</span>
                        <div class="relative">
                            <input id="reg_pass" type="password" name="password" required class="glass-input w-full rounded-2xl border border-white/80 bg-white/50 px-4 py-3 pr-10 text-xs font-bold tracking-wider text-[#1f1f1f] shadow-sm focus:border-[#EA7645] focus:outline-none" placeholder="Minimal 8 karakter">
                            <button type="button" onclick="togglePass('reg_pass', this)" class="absolute inset-y-0 right-3 flex items-center text-gray-500 hover:text-[#EA7645] transition focus:outline-none">
                                <svg class="w-4 h-4 eye-open" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                <svg class="w-4 h-4 eye-closed hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a8.982 8.982 0 013.122-.563c4.478 0 8.268 2.943 9.542 7a9.97 9.97 0 01-2.483 4.132M15 12a3 3 0 11-6 0 3 3 0 016 0zm6 6L3 3"/></svg>
                            </button>
                        </div>
                    </label>

                    <!-- Konfirmasi Password + Toggle Intip -->
                    <label class="block text-left space-y-1.5">
                        <span class="text-[10px] font-black uppercase tracking-[0.25em] text-gray-600">Konfirmasi Kunci Akses</span>
                        <div class="relative">
                            <input id="reg_pass_confirm" type="password" name="password_confirmation" required class="glass-input w-full rounded-2xl border border-white/80 bg-white/50 px-4 py-3 pr-10 text-xs font-bold tracking-wider text-[#1f1f1f] shadow-sm focus:border-[#EA7645] focus:outline-none" placeholder="Ulangi password">
                            <button type="button" onclick="togglePass('reg_pass_confirm', this)" class="absolute inset-y-0 right-3 flex items-center text-gray-500 hover:text-[#EA7645] transition focus:outline-none">
                                <svg class="w-4 h-4 eye-open" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                <svg class="w-4 h-4 eye-closed hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a8.982 8.982 0 013.122-.563c4.478 0 8.268 2.943 9.542 7a9.97 9.97 0 01-2.483 4.132M15 12a3 3 0 11-6 0 3 3 0 016 0zm6 6L3 3"/></svg>
                            </button>
                        </div>
                    </label>
                </div>

                <div class="grid gap-6 md:grid-cols-2">
                    <!-- Divisi Operasional -->
                    <label class="block text-left space-y-1.5">
                        <span class="text-[10px] font-black uppercase tracking-[0.25em] text-gray-600">Divisi Utama</span>
                        <select name="division_id" required class="glass-input w-full rounded-2xl border border-white/80 bg-white/50 px-4 py-3 text-xs font-bold tracking-wider text-[#1f1f1f] shadow-sm focus:border-[#EA7645] focus:outline-none">
                            <option value="" disabled @selected(!old('division_id'))>Pilih Divisi</option>
                            @foreach ($divisions as $division)
                                <option value="{{ $division['id'] }}" @selected(old('division_id') == $division['id'])>
                                    {{ $division['code'] }} — {{ $division['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </label>

                    <!-- Unggah Foto -->
                    <label class="block text-left space-y-1.5">
                        <span class="text-[10px] font-black uppercase tracking-[0.25em] text-gray-600">Unggah Foto Profil</span>
                        <input type="file" name="photo" accept="image/*" class="glass-input w-full rounded-2xl border border-dashed border-white/80 bg-white/30 px-3 py-2 text-[10px] font-bold tracking-wide text-[#1f1f1f] shadow-sm focus:border-[#EA7645] focus:outline-none">
                        <span class="block text-[8px] font-bold text-gray-500 uppercase tracking-widest">Opsional — Format JPG/PNG Maks 2MB</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="pt-4 border-t border-white/60 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-[9px] font-bold tracking-widest text-gray-500 uppercase">AKSES OPERATIF RHINE LAB.LLC</p>
                    <button type="submit" class="btn-primary w-full sm:w-auto px-8 py-3 text-xs font-black tracking-[0.3em] uppercase rounded-full shadow-lg">
                        Daftar Akses
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ==============================================
     MODAL POP-UP ERROR LIQUID GLASS (HUD RHINE LAB)
     ============================================== -->
@if ($errors->any())
<div id="errorModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-md transition-opacity duration-300">
    <div id="errorCard" class="relative w-full max-w-lg rounded-3xl border border-white/80 bg-[#ECE8E5]/80 backdrop-blur-[24px] shadow-[0_30px_60px_rgba(0,0,0,0.25)] overflow-hidden transform scale-95 transition-all duration-300">
        
        <!-- Background Ambient Glow & RL Watermark -->
        <div class="absolute -top-10 -right-10 w-48 h-48 bg-[#EA7645]/20 rounded-full blur-[50px] pointer-events-none"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-[10rem] font-black text-black/5 select-none pointer-events-none">RL</div>

        <!-- Modal Header -->
        <div class="relative z-10 flex items-center justify-between border-b border-white/60 bg-white/30 px-6 py-4">
            <div class="flex items-center gap-2">
                <span class="h-2 w-2 rounded-full bg-[#EA7645] animate-ping"></span>
                <span class="text-[9px] font-black tracking-[0.35em] uppercase text-[#EA7645]">SYSTEM ERROR // ACCESS REJECTED</span>
            </div>
            <button type="button" onclick="closeErrorModal()" class="text-xl font-bold text-gray-600 hover:text-[#EA7645] transition focus:outline-none">&times;</button>
        </div>

        <!-- Modal Body -->
        <div class="relative z-10 p-6 space-y-4">
            <div class="flex items-start gap-3">
                <div class="p-2.5 rounded-2xl bg-[#EA7645]/15 border border-[#EA7645]/30 text-[#EA7645] flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
                <div>
                    <h3 class="text-base font-black uppercase tracking-wider text-[#1f1f1f]">Registrasi Tidak Valid</h3>
                    <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mt-0.5">Sistem menolak inisiasi kredensial berikut:</p>
                </div>
            </div>

            <!-- List Error -->
            <div class="bg-white/40 border border-white/80 rounded-2xl p-4 space-y-2 shadow-inner max-h-48 overflow-y-auto custom-scroll">
                <ul class="space-y-1.5 text-xs font-bold text-gray-700">
                    @foreach ($errors->all() as $error)
                        <li class="flex items-center gap-2">
                            <span class="h-1.5 w-1.5 rounded-full bg-[#EA7645]"></span>
                            <span>{{ $error }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Modal Footer -->
        <div class="relative z-10 flex items-center justify-end border-t border-white/60 bg-white/30 px-6 py-3.5">
            <button type="button" onclick="closeErrorModal()" class="px-6 py-2 rounded-full bg-[#1c1c1c] text-white text-[10px] font-black tracking-[0.25em] uppercase hover:bg-[#EA7645] transition shadow-md">
                Perbaiki Data
            </button>
        </div>
    </div>
</div>
@endif

<style>
    .glass-card {
        background: rgba(255, 255, 255, 0.45);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(255, 255, 255, 0.8);
        border-radius: 1.5rem;
    }
    .glass-input {
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        transition: all 0.3s ease;
    }
    .btn-primary {
        background-image: linear-gradient(135deg, #1c1c1c, #2d2d2d);
        color: #fff;
        border: 1px solid #1c1c1c;
        transition: all 0.3s ease;
    }
    .btn-primary:hover {
        background-image: linear-gradient(135deg, #EA7645, #d66031);
        border-color: #EA7645;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const wrapper = document.getElementById('pageWrapper');
        if (wrapper) {
            wrapper.classList.remove('opacity-0');
            wrapper.classList.add('opacity-100');
        }

        // Animasi Pop-Up Error Nimbul
        const errCard = document.getElementById('errorCard');
        if (errCard) {
            setTimeout(() => {
                errCard.classList.remove('scale-95');
                errCard.classList.add('scale-100');
            }, 50);
        }
    });

    function closeErrorModal() {
        const modal = document.getElementById('errorModal');
        const card = document.getElementById('errorCard');
        if (card && modal) {
            card.classList.remove('scale-100');
            card.classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 200);
        }
    }

    function togglePass(id, btn) {
        const input = document.getElementById(id);
        const open = btn.querySelector('.eye-open');
        const closed = btn.querySelector('.eye-closed');

        if (input.type === 'password') {
            input.type = 'text';
            open.classList.add('hidden');
            closed.classList.remove('hidden');
        } else {
            input.type = 'password';
            open.classList.remove('hidden');
            closed.classList.add('hidden');
        }
    }
</script>
@endsection