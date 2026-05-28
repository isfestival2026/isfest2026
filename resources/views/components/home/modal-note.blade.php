{{-- resources/views/components/home/modal-note.blade.php --}}

@php
    use Illuminate\Support\Facades\Storage;

    $boardUrl = '';

    try {
        // Tarik URL sementara dari Backblaze (berlaku 60 menit)
        $boardUrl = Storage::disk('s3')->temporaryUrl('Assets/Elements/decorative-board.png', now()->addMinutes(60));
    } catch (\Exception $e) {
        // Fallback aman kalau konfigurasi S3 belum jalan atau sedang ngetes di MacBook
        $boardUrl = asset('assets/decorative-board.png');
    }
@endphp

<template x-teleport="body">
    <div x-show="showNote"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-90"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-90"
         class="fixed inset-0 z-[99999] flex items-center justify-center bg-slate-900/80 backdrop-blur-md p-4"
         style="display: none;">

        <div @click.away="showNote = false" class="relative w-full max-w-md mx-auto">
            
            {{-- Menggunakan variabel $boardUrl dari Backblaze --}}
            <img src="{{ $boardUrl }}" class="w-full h-auto drop-shadow-2xl pointer-events-none block" alt="Decorative Board">
            
            <div class="absolute top-[24%] bottom-[24%] left-[22%] right-[22%] flex flex-col items-center justify-center text-center">
                <h3 class="text-xl sm:text-2xl font-serif font-extrabold text-[#5c2118] mb-1">ISFEST 2026</h3>
                <h4 class="text-[10px] sm:text-xs font-serif font-bold text-[#8a4a27] mb-3 uppercase tracking-widest">The Grand Wizarding Conquest: Rise Beyond the Limits</h4>
                <p class="text-[12px] sm:text-[14px] text-[#4a3424] font-serif leading-tight sm:leading-snug font-medium mb-3">Selamat datang di Information Systems Festival UMN! Mari gali potensi dan temukan sihir di dalam dirimu.</p>
                <p class="text-[13px] sm:text-[15px] font-bold italic text-[#5c2118]">"Unleash Your Magic,<br>Forge the Future!"</p>
            </div>
            
            <button @click="showNote = false" class="absolute -top-2 -right-2 sm:-top-4 sm:-right-4 w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center bg-red-600 hover:bg-red-500 text-white text-2xl sm:text-3xl font-bold rounded-full shadow-lg border-2 border-amber-200 transition duration-150 z-50">&times;</button>
        </div>
    </div>
</template>