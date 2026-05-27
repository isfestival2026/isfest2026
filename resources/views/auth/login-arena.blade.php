{{-- 📂 resources/views/auth/login-arena.blade.php --}}
<x-layout.app title="Masuk Arena Submisi">

  {{-- Definisi Animasi Sihir (Diadaptasi dari Next.js) --}}
  <style>
    @keyframes magicFloat {
      0% { transform: translateY(0px) rotate(0deg); }
      50% { transform: translateY(-5px) rotate(3deg); }
      100% { transform: translateY(0px) rotate(0deg); }
    }
    .animate-magic-float {
      animation: magicFloat 3s ease-in-out infinite;
    }
  </style>

  {{-- Tombol Kembali --}}
  <div class="w-full max-w-lg mx-auto px-6 pt-12 pb-2 relative z-30">
    <a href="{{ route('home') }}" class="inline-flex items-center text-slate-400 hover:text-[#ffec1f] transition-colors text-sm font-medium">
      <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
      </svg>
      Kembali ke Arena
    </a>
  </div>

  {{-- Kotak Utama Formulir Login --}}
  <div class="flex-grow flex items-center justify-center px-4 py-6 relative z-30">
    <div class="w-full max-w-lg p-8 md:p-10 relative overflow-hidden bg-[#151e2e] border border-white/5 rounded-[1.5rem] shadow-2xl">
        
        {{-- Efek Aura Magic di Background Card --}}
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-48 h-48 bg-amber-500/5 rounded-full blur-[50px] pointer-events-none"></div>

        {{-- Header Identitas --}}
        <div class="flex flex-col items-center text-center mb-8 relative z-10">
            
            {{-- Komponen Mascot (Desain dari referensi Next.js lo) --}}
            <div class="w-16 h-16 bg-[#ffec1f]/10 border border-[#ffec1f]/30 rounded-2xl mx-auto flex items-center justify-center mb-4 shadow-[0_0_15px_rgba(255,236,31,0.15)] relative overflow-hidden animate-magic-float p-2">
                 <img src="{{ asset('mascot/mascot-wand.png') }}" alt="Tongkat Sihir Maskot" 
                      class="w-full h-full object-contain drop-shadow-[0_0_10px_rgba(255,236,31,0.5)]" 
                      onerror="this.src='{{ asset('images/logo-frog.png') }}'" />
            </div>

            <h1 class="font-amarante text-2xl md:text-3xl text-[#ffd700] tracking-wide mb-2 drop-shadow-md">MASUK KE ARENA</h1>
            <p class="text-slate-400 text-xs md:text-sm font-light leading-relaxed">
                Gunakan Username Tim dan Kata Sandi Anda<br />untuk mengakses gerbang submisi proyek.
            </p>
        </div>

        {{-- Notifikasi Error Otentikasi --}}
        @if ($errors->any())
            <div class="mb-5 p-3 bg-red-500/10 border border-red-500/50 text-red-400 rounded-lg text-xs font-medium flex items-center justify-center gap-2 relative z-10 text-center">
                @foreach ($errors->all() as $error)
                    <span>🛑 {{ $error }}</span>
                @endforeach
            </div>
        @endif

        {{-- Form Login Akses Gerbang --}}
        <form action="{{ route('login') }}" method="POST" class="space-y-6 relative z-10">
            @csrf

            {{-- Input Username Tim --}}
            <div>
                <label for="username" class="block text-[10px] text-slate-300 font-bold mb-2 tracking-[0.15em] uppercase">Username Tim</label>
                <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus placeholder="e.g. gryffindordata" 
                    class="w-full px-4 py-3.5 bg-[#0b1120]/50 border border-slate-700/60 rounded-xl text-white text-sm focus:outline-none focus:border-[#ffec1f] focus:ring-1 focus:ring-[#ffec1f]/50 transition shadow-inner placeholder-slate-600">
            </div>

            {{-- Input Kata Sandi Sihir --}}
            <div>
                <label for="password" class="block text-[10px] text-slate-300 font-bold mb-2 tracking-[0.15em] uppercase">Kata Sandi Sihir</label>
                <input id="password" type="password" name="password" required placeholder="••••••••" 
                    class="w-full px-4 py-3.5 bg-[#0b1120]/50 border border-slate-700/60 rounded-xl text-white text-sm focus:outline-none focus:border-[#ffec1f] focus:ring-1 focus:ring-[#ffec1f]/50 transition shadow-inner placeholder-slate-600">
            </div>

            {{-- Action Button --}}
            <div class="pt-2">
                <button type="submit" class="w-full py-4 text-slate-900 font-bold text-sm tracking-[0.2em] uppercase transition-all rounded-xl bg-gradient-to-b from-[#f59e0b] to-[#d97706] hover:from-[#fbbf24] hover:to-[#f59e0b] shadow-lg shadow-amber-900/40 transform hover:-translate-y-0.5">
                    Buka Gerbang
                </button>
            </div>
        </form>

        {{-- Jalur Alternatif jika Belum Registrasi --}}
        <div class="mt-8 pt-5 border-t border-slate-700/40 text-center relative z-10">
            <p class="text-xs text-slate-400">
                Tim Anda belum terdaftar di arena? 
                <a href="/daftar-arena" class="text-amber-500 font-bold hover:underline ml-1">Registrasi Sekarang</a>
            </p>
        </div>
    </div>
  </div>
</x-layout.app>