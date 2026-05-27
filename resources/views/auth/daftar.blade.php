<x-layout.app title="Pendaftaran Arena">

  {{-- Tombol Kembali --}}
  <div class="w-full max-w-4xl mx-auto px-6 pt-8 pb-2 relative z-30">
    <a href="{{ route('home') }}" class="inline-flex items-center text-slate-400 hover:text-slate-200 transition-colors text-sm font-medium">
      <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
      Kembali ke Arena
    </a>
  </div>

  {{-- Kotak Utama Formulir --}}
  <div class="flex-grow flex items-center justify-center px-4 py-8 relative z-30">
    <div class="w-full max-w-3xl p-8 md:p-12 relative overflow-hidden bg-[#151e2e] border border-white/5 rounded-[1.5rem] shadow-2xl">
        
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-64 h-64 bg-amber-500/5 rounded-full blur-[60px] pointer-events-none"></div>

        <div class="flex flex-col items-center text-center mb-10 relative z-10">
            <div class="w-20 h-20 bg-[#1e293b] rounded-2xl border border-[#334155] p-2 flex items-center justify-center shadow-lg mb-6">
                 <img src="{{ asset('mascot/mascot-side.png') }}" alt="Icon" class="w-full h-full object-contain" onerror="this.src='{{ asset('mascot-wand.png') }}'" />
            </div>
            <h1 class="font-amarante text-3xl md:text-4xl text-[#ffd700] tracking-wide mb-3 drop-shadow-md">DAFTAR KE ARENA</h1>
            <p class="text-slate-400 text-sm md:text-base font-light">Masukkan detail Tim dan identitas anggota<br class="hidden sm:block" /> untuk mendaftarkan diri ke dalam turnamen.</p>
        </div>

        {{-- Kotak Notifikasi Sistem (Wajib ada agar error terlihat) --}}
        @if (session('success'))
            <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/40 text-emerald-400 rounded-xl text-sm font-medium relative z-10">
                ✨ {{ session('success') }}
            </div>
        @endif

        @if ($errors->has('error'))
            <div class="mb-6 p-4 bg-rose-500/10 border border-rose-500/40 text-rose-400 rounded-xl text-sm font-medium relative z-10">
                🚨 {{ $errors->first('error') }}
            </div>
        @endif

        <form action="/submit-pendaftaran" method="POST" enctype="multipart/form-data" class="space-y-8 relative z-10">
            @csrf

            {{-- 1. PROFIL TIM --}}
            <div class="space-y-5">
                <h3 class="text-xs font-bold text-slate-500 tracking-[0.2em] uppercase border-b border-slate-700/50 pb-2">1. Profil Tim</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-[11px] text-slate-300 font-bold mb-2 tracking-widest uppercase">Pilih Arena</label>
                       <select id="kategori-select" name="kategori" required class="w-full px-4 py-3.5 input-dark text-sm appearance-none">
                            <option value="" disabled selected class="text-slate-500">-- Pilih Kategori Lomba --</option>
                            <option value="UI/UX" data-anggota="3" data-harga="Rp 115.006">UI/UX Design (Maks 4 Orang)</option>
                            <option value="Data Competition" data-anggota="2" data-harga="Rp 100.006">Data Competition (Maks 3 Orang)</option>
                            <option value="Mobile Legends" data-anggota="4" data-harga="Rp 75.006">Mobile Legends (Maks 5 Orang)</option>
                            <option value="Valorant" data-anggota="4" data-harga="Rp 75.006">Valorant (Maks 5 Orang)</option>
                        </select>
                    </div>
                    <x-form.input label="Nama Tim" name="nama_tim" placeholder="e.g. gryffindordata" required="true" />
                    <x-form.input label="Kata Sandi Sihir (Password)" type="password" name="password" placeholder="••••••••" required="true" note="*Sandi ini akan digunakan tim Anda untuk login submisi." class="md:col-span-2" />
                </div>
            </div>

            {{-- 2. KETUA TIM --}}
            <div class="space-y-5 pt-4">
                <h3 class="text-xs font-bold text-slate-500 tracking-[0.2em] uppercase border-b border-slate-700/50 pb-2">2. Komandan (Ketua Tim)</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <x-form.input label="Nama Lengkap" name="nama_ketua" placeholder="Nama Ketua Tim" required="true" />
                    <x-form.input label="No. WhatsApp" type="number" name="wa_ketua" placeholder="08xxxxxxxxxx" required="true" />
                    <x-form.input label="Asal Instansi" name="instansi_ketua" placeholder="Sekolah / Universitas" required="true" class="md:col-span-2" />
                    <x-form.file label="Unggah Identitas (KTM/Pelajar)" name="ktm_ketua" required="true" class="md:col-span-2" />
                </div>
            </div>

            {{-- 3. ANGGOTA TIM --}}
            <div class="space-y-5 pt-4">
                <div class="flex justify-between items-end border-b border-slate-700/50 pb-2">
                    <h3 class="text-xs font-bold text-slate-500 tracking-[0.2em] uppercase">3. Anggota Tim</h3>
                    <span id="member-counter" class="text-[10px] text-amber-500 font-bold">Pilih Arena Terlebih Dahulu</span>
                </div>
                
                @for ($i = 1; $i <= 4; $i++)
                    <x-form.member-card :index="$i" />
                @endfor
            </div>

            {{-- 4. PEMBAYARAN --}}
            <div class="space-y-5 pt-4">
                <h3 class="text-xs font-bold text-slate-500 tracking-[0.2em] uppercase border-b border-slate-700/50 pb-2">4. Segel Perjanjian (Pembayaran)</h3>
                
                <div class="bg-[#0b1120] p-5 rounded-xl border border-amber-500/20 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <p class="text-xs text-slate-400 uppercase tracking-wider mb-1">Metode Pembayaran (blu by BCA)</p>
                        <p class="text-xl font-mono text-[#ffd700] font-bold tracking-wider">008620636951</p>
                        <p class="text-xs text-slate-400 mt-1">a.n. FELICIA JESSLYN GUNAWAN</p>
                    </div>
                    <div class="text-left sm:text-right">
                        <p class="text-xs text-slate-400 uppercase tracking-wider mb-1">Biaya Pendaftaran</p>
                        <p id="biaya-investasi" class="text-lg font-bold text-emerald-400">- / Tim</p>
                    </div>
                </div>

                <x-form.file label="Unggah Bukti Transfer" name="bukti_transfer" required="true" class="w-full" />
            </div>

            <div class="pt-6 pb-2">
                <button type="submit" class="w-full py-4 text-slate-900 font-bold text-sm tracking-[0.2em] uppercase transition-all rounded-xl bg-gradient-to-b from-[#f59e0b] to-[#d97706] hover:from-[#fbbf24] hover:to-[#f59e0b] shadow-[0_8px_20px_-6px_rgba(217,119,6,0.6)]">Buka Gerbang</button>
            </div>
        </form>
    </div>
  </div>

  {{-- Script Interaksi Dinamis --}}
  <script>
    document.addEventListener('DOMContentLoaded', function () {
        const kategoriSelect = document.getElementById('kategori-select');
        const counterText = document.getElementById('member-counter');
        const biayaText = document.getElementById('biaya-investasi');
        const memberCards = document.querySelectorAll('.member-card');

        kategoriSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const maxMembers = parseInt(selectedOption.getAttribute('data-anggota'));
            const harga = selectedOption.getAttribute('data-harga');

            biayaText.textContent = `${harga} / Tim`;

            memberCards.forEach(card => {
                card.classList.add('hidden');
                const inputs = card.querySelectorAll('.member-input input');
                inputs.forEach(input => {
                    input.required = false;
                    input.disabled = true; 
                });
            });

            for(let i = 0; i < maxMembers; i++) {
                if(memberCards[i]) {
                    memberCards[i].classList.remove('hidden');
                    const inputs = memberCards[i].querySelectorAll('.member-input input');
                    inputs.forEach(input => {
                        input.required = true;
                        input.disabled = false;
                    });
                }
            }
            
            counterText.textContent = `Wajib Mengisi ${maxMembers} Anggota Tambahan`;
        });
    });
  </script>
</x-layout.app>