<x-layout.app title="Divisi — ISFEST 2026">

    {{-- 1. Memanggil CSS --}}
    <x-divisi.styles />

    @php
        $divisi = require resource_path('views/components/divisi/data.php');

        // Memisahkan data Sovereign (Index 0) dan Divisi Lainnya
        $sovereign   = $divisi[0];
        $otherDivisi = array_slice($divisi, 1);

        // ==========================================
        // TAMBAHKAN LOOPING INI UNTUK MODAL JAVASCRIPT
        // ==========================================
        foreach ($divisi as &$d) {
            try {
                $d['modal_logo'] = \Illuminate\Support\Facades\Storage::disk('s3')->temporaryUrl('Assets/logo-divisi/' . $d['name'] . '.png', now()->addMinutes(60));
            } catch (\Exception $e) {
                $d['modal_logo'] = asset('logo Divisi/' . $d['name'] . '.png');
            }

            $d['slider_photos'] = [];
            for ($i = 1; $i <= 3; $i++) {
                try {
                    $path = sprintf(
                        'Assets/foto-divisi/%s/%s (%d).JPG',
                        $d['folder'],
                        $d['name'],
                        $i
                    );
                    $d['slider_photos'][] = \Illuminate\Support\Facades\Storage::disk('s3')->temporaryUrl($path, now()->addMinutes(60));
                } catch (\Exception $e) {
                    $d['slider_photos'][] = asset('foto divisi/' . $d['folder'] . '/' . $d['name'] . ' (' . $i . ').JPG');
                }
            }
        }
        unset($d); 
        // ==========================================

        $headerFlagUrl = '';
        $starsUrl = '';

        try {
            $headerFlagUrl = \Illuminate\Support\Facades\Storage::disk('s3')->temporaryUrl('Assets/Elements/header-flag.png', now()->addMinutes(60));
            $starsUrl      = \Illuminate\Support\Facades\Storage::disk('s3')->temporaryUrl('Assets/Elements/stars.png', now()->addMinutes(60));
        } catch (\Exception $e) {
            $headerFlagUrl = asset('assets/header-flag.png');
            $starsUrl      = asset('assets/stars.png');
        }
    @endphp

    {{-- 3. Elemen Dekorasi (Progress Bar, Cursor, Canvas Bintang, dsb) --}}
    <x-divisi.decorations />

    {{-- 4. Kerangka Modal --}}
    <x-divisi.modal />

    {{-- 5. KONTEN UTAMA --}}
    <div class="tw">
        <div class="page">
            
            {{-- Header Title --}}
            <div class="hdr">
                <div class="bw">
                    <img src="{{ $headerFlagUrl }}" class="fi-img" alt="Header Flag">
                    <h1>Divisi</h1>
                </div>
            </div>

            {{-- Card Sovereign (BPH) --}}
            <x-divisi.sovereign :sovereign="$sovereign" />

            {{-- Divider Pemisah --}}
            <div class="sec-div fi" style="transition-delay:.08s">
                <div class="sd-line"></div>
                <span>✦ Divisi Panitia ✦</span>
                <div class="sd-line"></div>
            </div>

            {{-- Grid 11 Divisi Lainnya --}}
            <x-divisi.grid :divisi="$otherDivisi" />

            {{-- Footer Quote --}}
            <div class="qt fi" style="transition-delay:.55s">
                <div class="qt-inner">
                    <img src="{{ $starsUrl }}" alt="Stars">
                    <span>"Unleash Your Magic, Forge the Future"</span>
                    <img src="{{ $starsUrl }}" alt="Stars">
                </div>
            </div>

        </div>
    </div>

    {{-- 6. Memanggil JavaScript (Mengirimkan data $divisi dari PHP ke JS) --}}
    <x-divisi.scripts :divisi="$divisi" />

</x-layout.app>