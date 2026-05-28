{{-- resources/views/components/home/background-stars.blade.php --}}

@php
    use Illuminate\Support\Facades\Storage;

    $starsUrl = '';

    try {
        // Tarik URL sementara dari Backblaze (berlaku 60 menit) khusus untuk file bintang
        $starsUrl = Storage::disk('s3')->temporaryUrl('Assets/Elements/stars.png', now()->addMinutes(60));
    } catch (\Exception $e) {
        // Fallback aman kalau konfigurasi S3 belum jalan atau sedang ngetes di MacBook
        $starsUrl = asset('assets/stars.png');
    }
@endphp

{{-- ========================================== --}}
{{-- ZONA KIRI (Area Meja, Rak Kiri, Pohon Kiri) --}}
{{-- ========================================== --}}

{{-- Bintang Kiri Atas (Dekat Ujung Rak) --}}
<img src="{{ $starsUrl }}" 
     class="absolute top-[12%] left-[4%] md:left-[10%] w-6 md:w-9 animate-pulse opacity-80 brightness-125 drop-shadow-[0_0_20px_rgba(255,236,31,1)] pointer-events-none z-10" 
     style="animation-duration: 4s;" alt="Sparkle">

{{-- Bintang Kiri Tengah (Dekat Pita Kosong) --}}
<img src="{{ $starsUrl }}" 
     class="absolute top-[32%] left-[22%] md:left-[28%] w-4 md:w-6 animate-pulse opacity-95 brightness-125 drop-shadow-[0_0_20px_rgba(255,236,31,1)] pointer-events-none z-10" 
     style="animation-duration: 2.2s;" alt="Sparkle">

{{-- Bintang Kiri Bawah (Berkilau Sangat Terang Dekat Meja Tulis) --}}
<img src="{{ $starsUrl }}" 
     class="absolute bottom-[35%] left-[6%] md:left-[14%] w-10 md:w-14 animate-pulse opacity-100 brightness-125 drop-shadow-[0_0_25px_rgba(255,236,31,1)] pointer-events-none z-10" 
     style="animation-duration: 2.8s;" alt="Sparkle">

{{-- Bintang Kiri Lantai (Dekat Akar Pohon) --}}
<img src="{{ $starsUrl }}" 
     class="absolute bottom-[15%] left-[20%] md:left-[26%] w-5 md:w-7 animate-pulse opacity-75 brightness-125 drop-shadow-[0_0_20px_rgba(255,236,31,0.8)] pointer-events-none z-10" 
     style="animation-duration: 3.5s;" alt="Sparkle">


{{-- ========================================== --}}
{{-- ZONA TENGAH (Area Lentera, Jendela, Lantai) --}}
{{-- ========================================== --}}

{{-- Bintang Tengah Atas (Di Atas Lentera) --}}
<img src="{{ $starsUrl }}" 
     class="absolute top-[8%] left-[48%] w-7 md:w-10 animate-pulse opacity-85 brightness-125 drop-shadow-[0_0_20px_rgba(255,236,31,1)] pointer-events-none z-10" 
     style="animation-duration: 5s;" alt="Sparkle">

{{-- Bintang Tengah Bawah (Lantai Belakang Maskot) --}}
<img src="{{ $starsUrl }}" 
     class="absolute bottom-[10%] left-[45%] w-4 md:w-5 animate-pulse opacity-60 brightness-125 drop-shadow-[0_0_15px_rgba(255,236,31,0.7)] pointer-events-none z-10" 
     style="animation-duration: 3.2s;" alt="Sparkle">


{{-- ========================================== --}}
{{-- ZONA KANAN (Area Globe, Rak Kanan, Pohon) --}}
{{-- ========================================== --}}

{{-- Bintang Kanan Atas (Ujung Rak Kanan) --}}
<img src="{{ $starsUrl }}" 
     class="absolute top-[18%] right-[5%] md:right-[15%] w-6 md:w-10 animate-pulse opacity-75 brightness-125 drop-shadow-[0_0_20px_rgba(255,236,31,1)] pointer-events-none z-10" 
     style="animation-duration: 4.5s;" alt="Sparkle">

{{-- Bintang Kanan Tengah (Dekat Pita Kanan) --}}
<img src="{{ $starsUrl }}" 
     class="absolute top-[28%] right-[25%] md:right-[32%] w-5 md:w-7 animate-pulse opacity-100 brightness-125 drop-shadow-[0_0_20px_rgba(255,236,31,1)] pointer-events-none z-10" 
     style="animation-duration: 2.5s;" alt="Sparkle">

{{-- Bintang Kanan Bawah (Berkilau Sangat Terang Dekat Globe) --}}
<img src="{{ $starsUrl }}" 
     class="absolute bottom-[28%] right-[8%] md:right-[16%] w-8 md:w-12 animate-pulse opacity-100 brightness-125 drop-shadow-[0_0_25px_rgba(255,236,31,1)] pointer-events-none z-10" 
     style="animation-duration: 3s;" alt="Sparkle">

{{-- Bintang Kanan Melayang (Dekat Akar Pohon) --}}
<img src="{{ $starsUrl }}" 
     class="absolute bottom-[45%] right-[22%] md:right-[26%] w-4 md:w-6 animate-pulse opacity-70 brightness-125 drop-shadow-[0_0_15px_rgba(255,236,31,0.8)] pointer-events-none z-10" 
     style="animation-duration: 3.8s;" alt="Sparkle">