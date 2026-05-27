{{-- resources/views/components/splashscreen.blade.php --}}

<div 
    id="splash-screen" 
    class="fixed inset-0 z-[999] flex flex-col items-center justify-center bg-[#0a101d] transition-opacity duration-1000 ease-in-out opacity-100"
>
    {{-- Efek Cahaya Latar (Aura Sihir) --}}
    <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
        <div class="w-64 h-64 bg-[#f59e0b] rounded-full mix-blend-screen filter blur-[100px] opacity-20 animate-pulse"></div>
    </div>

    <div class="relative z-10 flex flex-col items-center">
        
        {{-- WADAH LOGO ISFEST --}}
        <div 
            class="relative w-40 h-40 md:w-48 md:h-48 mb-8 drop-shadow-[0_0_30px_rgba(245,158,11,0.4)] flex justify-center items-center"
            style="animation: float 4s ease-in-out infinite;"
        >
            <img
                src="{{ asset('logo/logo-isfest.png') }}"
                alt="ISFEST 2026 Logo"
                class="w-full h-full object-contain"
            />
        </div>

        {{-- Teks Intro --}}
        <h1 class="font-cinzel text-3xl md:text-5xl font-bold text-[#ffec1f] tracking-widest text-center drop-shadow-lg mb-3">
            ISFEST 2026
        </h1>
        
        <div class="flex items-center gap-3 mt-2">
            <div class="w-4 h-4 rounded-full border-t-2 border-r-2 border-[#ffec1f] animate-spin"></div>
            <p class="text-slate-400 font-mono text-xs uppercase tracking-widest animate-pulse">
                Mempersiapkan Arena...
            </p>
        </div>
    </div>

    {{-- DEFINISI KEYFRAME CSS UNTUK ANIMASI KUSTOM --}}
    <style>
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }
    </style>
</div>

{{-- SCRIPT MENGATUR WAKTU & SESSION --}}
<script>
    // Tetap menggunakan 'load' agar dia menunggu background raksasa beres di-download
    window.addEventListener('load', function() {
        const splashScreen = document.getElementById('splash-screen');
        
        if (!splashScreen) return;

        // Cek session storage agar animasi hanya jalan 1x per sesi browser
        const hasSeenIntro = sessionStorage.getItem('hasSeenIsfestIntro');
        
        if (hasSeenIntro) {
            // Jika sudah pernah melihatnya, langsung hapus elemen
            splashScreen.remove();
            return;
        }

        // Mulai animasi memudar setelah 2.5 detik (memberi waktu user menikmati animasi)
        setTimeout(() => {
            splashScreen.classList.remove('opacity-100');
            splashScreen.classList.add('opacity-0', 'pointer-events-none');
        }, 2500);

        // Hapus komponen sepenuhnya dari struktur HTML setelah 3.5 detik 
        setTimeout(() => {
            splashScreen.remove();
            sessionStorage.setItem('hasSeenIsfestIntro', 'true');
        }, 3500);
    });
</script>