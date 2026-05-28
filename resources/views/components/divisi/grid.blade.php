@props(['divisi'])

@php
    use Illuminate\Support\Facades\Storage;

    // Lakukan looping untuk menyisipkan temporary URL dari Backblaze ke setiap divisi
    foreach ($divisi as &$d) {
        try {
            // Sesuai path yang lo minta: Assets/logo-divisi/[nama].png
            $pathFile = 'Assets/logo-divisi/' . $d['name'] . '.png';
            $d['logo_url'] = Storage::disk('s3')->temporaryUrl($pathFile, now()->addMinutes(60));
        } catch (\Exception $e) {
            // Fallback aman ke asset lokal di MacBook lo jika offline atau s3 belum dikonfigurasi
            $d['logo_url'] = asset('logo Divisi/' . $d['name'] . '.png');
        }
    }
    unset($d); // Putus referensi pointer agar aman
@endphp

<div class="divisi-grid">
    @foreach($divisi as $i => $d)
    {{-- Index + 1 karena Sovereign diambil di awal, sehingga Array ini mulai dari index 1 secara urutan modal --}}
    <div class="div-card fi" style="transition-delay:{{ ($i * 0.04) + 0.1 }}s" onclick="openModal({{ $i + 1 }})">
        
        {{-- Memanggil logo_url hasil generate dari Backblaze/Fallback lokal --}}
        <img src="{{ $d['logo_url'] }}" class="div-logo" alt="{{ $d['name'] }}" onerror="this.style.opacity='.2'">
        
        <div>
            <p class="div-name">{{ $d['name'] }}</p>
            <p class="div-label">{{ $d['label'] }}</p>
        </div>
        <span class="div-hint">✦ klik detail</span>
    </div>
    @endforeach
</div>