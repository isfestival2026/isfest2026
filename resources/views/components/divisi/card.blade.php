@props(['data', 'index'])

@php
    use Illuminate\Support\Facades\Storage;

    $logoUrl = '';
    try {
        // Tarik URL sementara dari Backblaze (berlaku 60 menit)
        $pathFile = 'Assets/logo-divisi/' . $data['name'] . '.png';
        $logoUrl = Storage::disk('s3')->temporaryUrl($pathFile, now()->addMinutes(60));
    } catch (\Exception $e) {
        // Fallback aman kalau konfigurasi S3 belum jalan atau offline di MacBook lo
        $logoUrl = asset('logo Divisi/' . $data['name'] . '.png');
    }
@endphp

<div class="card-divisi cursor-pointer rounded-2xl border border-slate-700/40 bg-[#172236]/80 backdrop-blur p-6 flex flex-col items-center gap-3 hover:border-[#ffec1f]/40 hover:bg-[#1e2d47]/90"
     onclick="openModal({{ $index }})">
    
    {{-- Pemanggilan Gambar (Otomatis S3 / Lokal) --}}
    <img src="{{ $logoUrl }}"
         alt="{{ $data['name'] }}"
         class="w-20 h-20 object-contain drop-shadow-lg"
         onerror="this.style.opacity='0.3'" />
         
    <div class="text-center">
        <p class="font-black text-white text-base">{{ $data['name'] }}</p>
        <p class="text-[11px] text-slate-400 mt-0.5">{{ $data['label'] }}</p>
    </div>
</div>