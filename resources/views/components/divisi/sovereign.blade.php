@props(['sovereign'])

@php
    use Illuminate\Support\Facades\Storage;

    $leavesUrl = '';
    $mascotUrl = '';
    $logoUrl   = '';

    try {
        // Tarik URL sementara dari Backblaze (berlaku 60 menit)
        $leavesUrl = Storage::disk('s3')->temporaryUrl('Assets/Elements/leaves.png', now()->addMinutes(60));
        $mascotUrl = Storage::disk('s3')->temporaryUrl('Assets/Mascot/mascot-side.png', now()->addMinutes(60));
        $logoUrl   = Storage::disk('s3')->temporaryUrl('Assets/logo-divisi/Sovereign.png', now()->addMinutes(60));
    } catch (\Exception $e) {
        // Fallback aman kalau konfigurasi S3 belum jalan atau sedang offline
        $leavesUrl = asset('assets/leaves.png');
        $mascotUrl = asset('mascot/mascot-side.png');
        $logoUrl   = asset('logo Divisi/Sovereign.png');
    }
@endphp

<div class="sovereign-card fi" onclick="openModal(0)">
    <img src="{{ $leavesUrl }}" class="s-deco-leaves" alt="Leaves">
    <img src="{{ $mascotUrl }}" class="s-deco-mascot" alt="Mascot">
    
    <div class="s-inner">
        <img src="{{ $logoUrl }}" class="s-logo" alt="Sovereign Logo" onerror="this.style.opacity='.3'">
        
        <div class="s-info">
            <p class="s-tag">ISFEST 2026 · Badan Pengurus Harian</p>
            <h2 class="s-name">Sovereign</h2>
            <p class="s-label">Badan Pengurus Harian</p>
            
            <div class="s-members">
                @foreach($sovereign['members'] as $m)
                <div class="s-member">
                    <div class="sm-name">{{ $m['name'] }}</div>
                    <div class="sm-role">{{ $m['role'] }}</div>
                </div>
                @endforeach
            </div>
        </div>
        
        <button class="s-btn" onclick="event.stopPropagation();openModal(0)">
            Lihat Detail ↗
        </button>
    </div>
</div>