@php
    use Illuminate\Support\Facades\Storage;

    $hatUrl = '';
    $wandUrl = '';
    $starsUrl = '';
    $magicUrl = '';
    $leavesUrl = '';

    try {
        // Tarik URL sementara dari Backblaze (berlaku 60 menit)
        $hatUrl    = Storage::disk('s3')->temporaryUrl('Assets/Elements/witch-hat.png', now()->addMinutes(60));
        $wandUrl   = Storage::disk('s3')->temporaryUrl('Assets/Elements/Wand.png', now()->addMinutes(60));
        $starsUrl  = Storage::disk('s3')->temporaryUrl('Assets/Elements/stars.png', now()->addMinutes(60));
        $magicUrl  = Storage::disk('s3')->temporaryUrl('Assets/Elements/magic-clumps.png', now()->addMinutes(60));
        $leavesUrl = Storage::disk('s3')->temporaryUrl('Assets/Elements/leaves.png', now()->addMinutes(60));
    } catch (\Exception $e) {
        // Fallback aman kalau konfigurasi S3 belum jalan atau sedang ngetes di MacBook lokal
        $hatUrl    = asset('assets/witch-hat.png');
        $wandUrl   = asset('assets/Wand.png');
        $starsUrl  = asset('assets/stars.png');
        $magicUrl  = asset('assets/magic-clumps.png');
        $leavesUrl = asset('assets/leaves.png');
    }
@endphp

<div id="progress-bar"></div>
<div id="cursor-dot"></div>
<canvas id="sc"></canvas>

{{-- Parallax Elements --}}
<img src="{{ $hatUrl }}"    class="deco d-hat" data-depth=".06" alt="Hat">
<img src="{{ $wandUrl }}"   class="deco d-wand" data-depth=".04" alt="Wand">
<img src="{{ $starsUrl }}"  class="deco d-s1"  data-depth=".08" alt="Stars">
<img src="{{ $starsUrl }}"  class="deco d-s2"  data-depth=".05" alt="Stars">
<img src="{{ $magicUrl }}"  class="deco d-ml"  data-depth=".03" alt="Magic">
<img src="{{ $magicUrl }}"  class="deco d-mr"  data-depth=".03" alt="Magic">
<img src="{{ $leavesUrl }}" class="deco d-ll"  alt="Leaves">
<img src="{{ $leavesUrl }}" class="deco d-lr"  alt="Leaves">