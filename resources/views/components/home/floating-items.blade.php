{{-- resources/views/components/home/floating-items.blade.php --}}
<div class="w-48 sm:w-64 md:w-80 lg:w-96 relative z-20 mt-24 md:mt-32 lg:mt-40">
          
    {{-- BUKU MENGAMBANG (KIRI) --}}
    <div @click="showNote = true" class="absolute -left-12 sm:-left-16 md:-left-20 top-1/4 w-16 sm:w-24 md:w-32 cursor-pointer z-50 animate-float-magic hover:scale-110 transition-transform duration-300">
         <img src="{{ asset('assets/book-open.png') }}" class="w-full h-full drop-shadow-[0_0_20px_rgba(255,236,31,0.8)]" alt="Floating Magic Book">
         
         {{-- Elemen Bintang Interaktif --}}
         <img src="{{ asset('assets/stars.png') }}" class="absolute -top-6 -left-4 w-8 sm:w-12 animate-pulse drop-shadow-[0_0_10px_rgba(255,255,255,0.8)] pointer-events-none" alt="Sparkle">
    </div>

    {{-- GULUNGAN KERTAS MENGAMBANG (KANAN) --}}
    <div @click="showArena = true" class="absolute -right-12 sm:-right-16 md:-right-20 top-1/3 w-16 sm:w-24 md:w-32 cursor-pointer z-50 animate-float-magic-alt hover:scale-110 transition-transform duration-300">
         <img src="{{ asset('assets/paper-roll.png') }}" class="w-full h-full drop-shadow-[0_0_20px_rgba(100,200,255,0.8)]" alt="Floating Paper Roll">
         
         {{-- Elemen Bintang Interaktif --}}
         <img src="{{ asset('assets/stars.png') }}" class="absolute -bottom-4 -right-6 w-10 sm:w-14 animate-pulse drop-shadow-[0_0_10px_rgba(255,255,255,0.8)] pointer-events-none" alt="Sparkle">
    </div>

    {{-- Efek Cahaya Maskot --}}
    <div class="absolute inset-0 bg-gradient-to-tr from-[#ffec1f]/10 to-transparent rounded-full blur-[60px] pointer-events-none"></div>
    
    {{-- Maskot --}}
    @include('components.mascot')
</div>