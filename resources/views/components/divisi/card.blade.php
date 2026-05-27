@props(['data', 'index'])

<div class="card-divisi cursor-pointer rounded-2xl border border-slate-700/40 bg-[#172236]/80 backdrop-blur p-6 flex flex-col items-center gap-3 hover:border-[#ffec1f]/40 hover:bg-[#1e2d47]/90"
     onclick="openModal({{ $index }})">
    
    {{-- Pemanggilan Gambar (Siap untuk Backblaze) --}}
    <img src="{{ $data['logo_url'] ?? asset('logo Divisi/' . $data['name'] . '.png') }}"
         alt="{{ $data['name'] }}"
         class="w-20 h-20 object-contain drop-shadow-lg"
         onerror="this.style.opacity='0.3'" />
         
    <div class="text-center">
        <p class="font-black text-white text-base">{{ $data['name'] }}</p>
        <p class="text-[11px] text-slate-400 mt-0.5">{{ $data['label'] }}</p>
    </div>
</div>