{{-- resources/views/components/home/modal-arena.blade.php --}}
<template x-teleport="body">
    <div x-show="showArena"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-90"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-90"
         class="fixed inset-0 z-[99999] flex items-center justify-center bg-slate-900/80 backdrop-blur-md p-4"
         style="display: none;">

        <div @click.away="showArena = false" class="relative w-full max-w-lg mx-auto">
            
            <img src="{{ asset('assets/blank-paper.png') }}" class="w-full h-auto drop-shadow-2xl pointer-events-none block" alt="Blank Paper">

            <div class="absolute top-[12%] bottom-[15%] left-[15%] right-[15%] flex flex-col overflow-y-auto">
                <h2 class="text-2xl sm:text-3xl font-serif font-bold text-[#5c2118] text-center mb-4 border-b-2 border-[#5c2118]/30 pb-2">
                    Arena of Magic
                </h2>

                <div class="w-full flex flex-col gap-4">
                    {{-- Kategori: Akademik --}}
                    <div>
                        <h3 class="font-bold text-[#8a4a27] font-serif text-base sm:text-lg mb-2 flex items-center gap-2">📚 Akademik</h3>
                        <div class="flex flex-col gap-2 pl-1">
                            <div class="flex items-start gap-2">
                                <span class="text-amber-800 text-sm mt-0.5">✔️</span>
                                <div>
                                    <h4 class="font-bold text-[#5c2118] text-sm">Data Competition</h4>
                                
                                </div>
                            </div>
                            <div class="flex items-start gap-2">
                                <span class="text-amber-800 text-sm mt-0.5">✔️</span>
                                <div>
                                    <h4 class="font-bold text-[#5c2118] text-sm">UI/UX Design</h4>
                                   
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Kategori: Non-Akademik --}}
                    <div>
                        <h3 class="font-bold text-[#8a4a27] font-serif text-base sm:text-lg mb-2 flex items-center gap-2">🎮 Non-Akademik</h3>
                        <div class="flex flex-col gap-2 pl-1">
                            <div class="flex items-start gap-2">
                                <span class="text-amber-800 text-sm mt-0.5">✔️</span>
                                <h4 class="font-bold text-[#5c2118] text-sm">Valorant</h4>
                            </div>
                            <div class="flex items-start gap-2">
                                <span class="text-amber-800 text-sm mt-0.5">✔️</span>
                                <h4 class="font-bold text-[#5c2118] text-sm">Mobile Legends</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button @click="showArena = false" class="absolute -top-2 -right-2 sm:-top-4 sm:-right-4 w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center bg-red-600 hover:bg-red-500 text-white text-2xl sm:text-3xl font-bold rounded-full shadow-lg border-2 border-amber-200 transition duration-150 z-50">&times;</button>
        </div>
    </div>
</template>