@props(['allData'])

{{-- HTML Modal --}}
<div id="modal-overlay" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-[#050a14e0] backdrop-blur-md" onclick="closeModal(event)">
    <div id="modal-box" class="content-anim relative w-full max-w-2xl rounded-3xl border border-slate-700/50 bg-[#0e1929] overflow-hidden flex flex-col max-h-[90vh]" onclick="event.stopPropagation()">
        
        <button onclick="closeModalDirect()" class="absolute top-4 right-4 z-20 w-8 h-8 rounded-full bg-black/60 text-slate-300 hover:bg-black/80 text-lg flex items-center justify-center">✕</button>

        {{-- Slider Area --}}
        <div class="relative w-full shrink-0 overflow-hidden h-[300px]">
            <div id="slider-track" class="flex h-full transition-transform duration-500 ease-in-out"></div>
            <button onclick="slide(-1)" class="absolute left-3 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-black/50 text-white text-2xl flex items-center justify-center hover:bg-black/80 z-10">‹</button>
            <button onclick="slide(1)"  class="absolute right-3 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-black/50 text-white text-2xl flex items-center justify-center hover:bg-black/80 z-10">›</button>
            <div id="slider-dots" class="absolute bottom-3 left-1/2 -translate-x-1/2 flex gap-2 z-10"></div>
        </div>

        {{-- Info Divisi --}}
        <div class="overflow-y-auto p-6 flex-1">
            <div class="flex items-center gap-4 mb-6">
                <img id="modal-logo" src="" class="w-16 h-16 object-contain shrink-0" />
                <div>
                    <h2 id="modal-name" class="text-2xl font-black text-white"></h2>
                    <p id="modal-label" class="text-sm mt-0.5 text-[#ffec1f]/80"></p>
                </div>
            </div>
            <div id="modal-members" class="space-y-2"></div>
        </div>
    </div>
</div>

{{-- JS Logic --}}
@push('scripts')
<script>
    const divisiData = @json($allData);
    let currentSlide = 0;
    const totalSlides = 3;

    function openModal(index) {
        const d = divisiData[index];
        currentSlide = 0;

        // Menggunakan URL dari Backblaze (logo_url) atau fallback lokal
        const logoPath = d.logo_url ? d.logo_url : '/logo%20Divisi/' + d.name + '.png';
        
        document.getElementById('modal-logo').src = logoPath;
        document.getElementById('modal-name').textContent = d.name;
        document.getElementById('modal-label').textContent = d.label;

        // Render Slider
        const track = document.getElementById('slider-track');
        track.innerHTML = '';
        for (let i = 1; i <= totalSlides; i++) {
            const img = document.createElement('img');
            // Catatan: Pastikan endpoint URL foto slider nanti juga di-set ke Backblaze
            img.src = '/foto%20divisi/' + encodeURIComponent(d.folder) + '/' + encodeURIComponent(d.name + ' (' + i + ')') + '.JPG';
            img.alt = d.name + ' foto ' + i;
            img.className = 'min-w-full h-full object-cover';
            track.appendChild(img);
        }
        updateSlider();

        // Render Dots
        const dots = document.getElementById('slider-dots');
        dots.innerHTML = '';
        for (let i = 0; i < totalSlides; i++) {
            const dot = document.createElement('div');
            dot.id = 'dot-' + i;
            dot.style.cssText = 'height:8px;border-radius:999px;transition:all .3s;background:' + (i === 0 ? '#ffec1f' : 'rgba(255,255,255,.35)') + ';width:' + (i === 0 ? '20px' : '8px') + ';';
            dots.appendChild(dot);
        }

        // Render Members
        const memberDiv = document.getElementById('modal-members');
        memberDiv.innerHTML = '';

        const pimpinan = d.members.filter(m => ['Koordinator','Ketua','Wakil Ketua','Sekretaris','Bendahara','Supervisi'].includes(m.role));
        const anggota = d.members.filter(m => m.role === 'Anggota');

        if (pimpinan.length) {
            memberDiv.appendChild(sectionLabel('Pimpinan', '#ffec1f'));
            pimpinan.forEach(m => memberDiv.appendChild(memberRow(m, true)));
        }
        if (anggota.length) {
            memberDiv.appendChild(sectionLabel('Anggota', '#64748b'));
            anggota.forEach(m => memberDiv.appendChild(memberRow(m, false)));
        }

        const overlay = document.getElementById('modal-overlay');
        overlay.style.display = 'flex';
        overlay.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function sectionLabel(text, color) {
        const p = document.createElement('p');
        p.textContent = text;
        p.style.cssText = 'font-size:10px;text-transform:uppercase;letter-spacing:.15em;color:' + color + ';opacity:.7;margin-bottom:8px;margin-top:12px;';
        return p;
    }

    function memberRow(m, isKoor) {
        const row = document.createElement('div');
        row.style.cssText = 'display:flex;align-items:center;justify-content:space-between;padding:10px 16px;border-radius:12px;margin-bottom:4px;background:' + (isKoor ? 'rgba(255,236,31,.07)' : 'rgba(30,45,71,.6)') + ';border:1px solid ' + (isKoor ? 'rgba(255,236,31,.2)' : 'rgba(51,65,85,.4)') + ';';
        row.innerHTML =
            '<div>' +
            '<p style="font-size:14px;font-weight:700;color:#fff;margin:0;">' + m.name + '</p>' +
            '<p style="font-size:11px;color:#94a3b8;margin:0;">' + m.role + '</p>' +
            '</div>' +
            '<p style="font-size:11px;color:#475569;font-family:monospace;">' + m.nim + '</p>';
        return row;
    }

    function slide(dir) {
        currentSlide = (currentSlide + dir + totalSlides) % totalSlides;
        updateSlider();
    }

    function updateSlider() {
        document.getElementById('slider-track').style.transform = 'translateX(-' + (currentSlide * 100) + '%)';
        for (let i = 0; i < totalSlides; i++) {
            const dot = document.getElementById('dot-' + i);
            if (!dot) continue;
            dot.style.background = i === currentSlide ? '#ffec1f' : 'rgba(255,255,255,.35)';
            dot.style.width      = i === currentSlide ? '20px' : '8px';
        }
    }

    function closeModal(e) { if (e.target === document.getElementById('modal-overlay')) closeModalDirect(); }
    function closeModalDirect() {
        const overlay = document.getElementById('modal-overlay');
        overlay.style.display = 'none';
        overlay.classList.add('hidden');
        document.body.style.overflow = '';
    }

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') closeModalDirect();
        if (e.key === 'ArrowLeft') slide(-1);
        if (e.key === 'ArrowRight') slide(1);
    });
</script>
@endpush