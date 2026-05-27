@props(['data'])

<div class="max-w-6xl mx-auto px-6 pt-10">
    <div class="card-divisi relative overflow-hidden cursor-pointer rounded-3xl border border-[#ffec1f]/20 bg-gradient-to-br from-[#0e1929] via-[#172236] to-[#1a2a1a] p-8 hover:border-[#ffec1f]/50"
         onclick="openModal(0)">

        {{-- Dekorasi Statis --}}
        <img src="{{ asset('assets/leaves.png') }}" class="absolute left-0 bottom-0 w-40 opacity-15 float-anim pointer-events-none" />
        <img src="{{ asset('assets/witch-hat.png') }}" class="absolute left-8 top-6 w-14 opacity-20 float-anim pointer-events-none" />
        <img src="{{ asset('mascot/mascot-side.png') }}" class="absolute right-0 bottom-0 h-52 opacity-70 float-anim pointer-events-none" />

        <div class="relative z-10">
            <p class="text-xs uppercase tracking-[.3em] text-[#ffec1f]/60 mb-4">ISFEST 2026</p>

            <div class="flex flex-col md:flex-row md:items-center gap-6">
                {{-- Pemanggilan Gambar (Siap untuk Backblaze) --}}
                <img src="{{ $data['logo_url'] ?? asset('logo Divisi/' . $data['name'] . '.png') }}" 
                     class="w-28 h-28 object-contain shrink-0 drop-shadow-[0_0_20px_rgba(255,236,31,0.3)]" 
                     alt="{{ $data['name'] }}" />

                <div class="flex-1">
                    <h1 class="text-4xl font-black text-white">{{ $data['name'] }}</h1>
                    <p class="text-[#ffec1f] font-bold uppercase tracking-widest text-sm mt-1">{{ $data['label'] }}</p>

                    <div class="flex flex-wrap gap-3 mt-5">
                        @foreach($data['members'] as $m)
                        <div class="px-4 py-2 rounded-xl border border-[#ffec1f]/20 bg-[#ffec1f]/5">
                            <p class="text-white font-bold text-sm">{{ $m['name'] }}</p>
                            <p class="text-[#ffec1f]/60 text-[10px] uppercase tracking-wider">{{ $m['role'] }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="shrink-0">
                    <span class="inline-flex items-center gap-2 px-5 py-2 rounded-full border border-[#ffec1f]/30 text-[#ffec1f] text-xs font-bold uppercase tracking-widest hover:bg-[#ffec1f]/10 transition">
                        Lihat Detail ↗
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>