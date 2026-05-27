@php
    use Illuminate\Support\Facades\Storage;

    $mascotUrl = '';
    try {
        // Meminta URL sementara dari Backblaze (berlaku 60 menit)
        // Pastikan path foldernya persis: Assets/Mascot/mascot-wand.png
        $mascotUrl = Storage::disk('s3')->temporaryUrl('Assets/Mascot/mascot-wand.png', now()->addMinutes(60));
    } catch (\Exception $e) {
        // Fallback aman: Jika .env belum disetting atau sedang offline, pakai gambar lokal
        $mascotUrl = asset('mascot/mascot-wand.png');
    }
@endphp

<div class="relative flex flex-col items-center w-full">
    
    <style>
        @keyframes mascotFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
        }
        .animate-mascot-float {
            animation: mascotFloat 4s ease-in-out infinite;
        }
    </style>

    {{-- Gelembung Mantra Penyihir --}}
    <div 
        id="mascot-bubble" 
        class="absolute bottom-full mb-3 z-20 w-max max-w-[150px] md:max-w-[220px] bg-[#223753]/95 border border-[#ffec1f]/40 p-2.5 md:px-4 md:py-3 rounded-xl md:rounded-2xl text-[9px] md:text-xs text-slate-100 shadow-xl transition-all duration-300 backdrop-blur-md text-center font-medium opacity-0 scale-95 translate-y-2 pointer-events-none"
    >
        <p id="mascot-spell" class="leading-relaxed md:leading-snug"></p>
        <div class="absolute -bottom-1.5 md:-bottom-2 left-1/2 -translate-x-1/2 w-3 h-3 md:w-4 md:h-4 bg-[#223753] border-r border-b border-[#ffec1f]/40 rotate-45"></div>
    </div>

    {{-- Area Sensitif Sentuhan/Hover Maskot --}}
    <div 
        id="mascot-trigger"
        class="relative w-full h-auto cursor-pointer animate-mascot-float group"
    >
        <div class="absolute inset-0 bg-[#ffec1f]/5 rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"></div>
        
        {{-- Pemanggilan Gambar Dinamis dari Backblaze/Lokal --}}
        <img
            src="{{ $mascotUrl }}"
            alt="ISFEST 2026 Wizard Mascot"
            class="w-full h-auto object-contain drop-shadow-[0_10px_20px_rgba(0,0,0,0.5)] transition-transform duration-300 group-hover:scale-[1.05]"
            onerror="this.src='{{ asset('images/logo-frog.png') }}'" 
        />
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const SPELLS = [
            "Alohomora! Semoga jalan menuju puncak klasemen terbuka lebar untuk asramamu! 🪄",
            "Expecto Patronum! Usir jauh-jauh segala error dan kebuntuan ide dari karyamu! 🌌",
            "Mantra yang luar biasa! Mahakarya yang kamu bangun memancarkan aura magis yang kuat! 🧪",
            "Ribbit! Kesempurnaan karya ini hanya bisa diracik oleh penyihir teknologi sejati! 🐸",
            "Forge the Future! Teruslah berinovasi, puncak House Standings sudah di depan mata! ✨",
            "Unleash Your Magic, Forge the Future! Tunjukkan keajaibanmu kepada para juri! 🔮"
        ];

        const triggerArea = document.getElementById('mascot-trigger');
        const bubble = document.getElementById('mascot-bubble');
        const spellText = document.getElementById('mascot-spell');
        let bubbleTimeout;

        function castSpell() {
            const randomIndex = Math.floor(Math.random() * SPELLS.length);
            spellText.textContent = SPELLS[randomIndex];

            bubble.classList.remove('opacity-0', 'scale-95', 'translate-y-2', 'pointer-events-none');
            bubble.classList.add('opacity-100', 'scale-100', 'translate-y-0');

            clearTimeout(bubbleTimeout);
            
            bubbleTimeout = setTimeout(() => {
                bubble.classList.remove('opacity-100', 'scale-100', 'translate-y-0');
                bubble.classList.add('opacity-0', 'scale-95', 'translate-y-2', 'pointer-events-none');
            }, 4500);
        }

        triggerArea.addEventListener('click', castSpell);
        triggerArea.addEventListener('mouseenter', castSpell);
    });
</script>