{{-- resources/views/tentang.blade.php --}}
<x-layout.app title="Tentang ISFEST 2026">

<style>
  @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Lora:ital,wght@0,400;0,600;1,400&display=swap');

  *, *::before, *::after { box-sizing: border-box; }

  .tw {
    background-image: url('/backgrounds/background-noclouds.png');
    background-size: cover;
    background-position: center top;
    background-attachment: fixed;
    min-height: 100vh;
    position: relative;
    overflow-x: hidden;
    font-family: 'Lora', serif;
    color: #f5e6c8;
  }
  .tw::before {
    content: '';
    position: fixed; inset: 0;
    background: linear-gradient(160deg,rgba(5,2,0,.82) 0%,rgba(10,5,0,.65) 50%,rgba(6,3,0,.80) 100%);
    z-index: 0; pointer-events: none;
  }

  #progress-bar {
    position: fixed; top: 0; left: 0;
    height: 2px; width: 0%;
    background: linear-gradient(90deg,#c8860a,#f5d78e,#c8860a);
    z-index: 9999;
    box-shadow: 0 0 8px rgba(245,215,142,.6);
  }

  #cursor-dot {
    position: fixed; pointer-events: none;
    width: 8px; height: 8px; border-radius: 50%;
    background: #f5d78e;
    z-index: 9998;
    transform: translate(-50%,-50%);
    mix-blend-mode: screen;
  }
  .spark {
    position: fixed; pointer-events: none;
    border-radius: 50%; z-index: 9997;
    transform: translate(-50%,-50%);
    animation: spark-fade .6s ease-out forwards;
  }
  @keyframes spark-fade {
    0%   { opacity:1; transform:translate(-50%,-50%) scale(1); }
    100% { opacity:0; transform:translate(calc(-50% + var(--dx)),calc(-50% + var(--dy))) scale(0); }
  }

  /* card internal sparkle */
  .card-spark {
    position: absolute; pointer-events: none; border-radius: 50%;
    z-index: 10; animation: cspark .8s ease-out forwards;
  }
  @keyframes cspark {
    0%   { opacity:1; transform:translate(0,0) scale(1); }
    100% { opacity:0; transform:translate(var(--cdx),var(--cdy)) scale(0); }
  }

  /* border breathe */
  @keyframes breathe {
    0%,100% { box-shadow: 0 4px 24px rgba(0,0,0,.45), 0 0 0px rgba(197,160,80,0); }
    50%      { box-shadow: 0 4px 24px rgba(0,0,0,.45), 0 0 22px rgba(197,160,80,.22), 0 0 40px rgba(197,160,80,.08); }
  }
  .cell.breathing { animation: breathe 2s ease-in-out infinite; }

  #sc { position:fixed; inset:0; z-index:1; pointer-events:none; opacity:.4; }

  .deco { position:absolute; pointer-events:none; z-index:2; user-select:none; will-change:transform; }
  .d-hat  { top:60px;  right:72px;  width:60px; filter:drop-shadow(0 0 8px rgba(245,215,142,.35)); }
  .d-wand { top:145px; left:38px;   width:48px; filter:drop-shadow(0 0 5px rgba(245,215,142,.2)); transform:rotate(30deg); }
  .d-s1   { top:26px;  left:18px;   width:36px; animation:tw-anim 2.4s infinite alternate; }
  .d-s2   { top:42px;  right:165px; width:28px; animation:tw-anim 3.6s infinite alternate; }
  .d-ml   { top:45%;  left:-4px;   width:70px; opacity:.25; }
  .d-mr   { top:65%;  right:-4px;  width:70px; opacity:.25; }
  .d-ll   { bottom:0; left:0;      width:92px; }
  .d-lr   { bottom:0; right:0;     width:92px; transform:scaleX(-1); }

  @keyframes fy      { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-10px)} }
  @keyframes tw-anim { 0%{opacity:.4;transform:scale(.85)} 100%{opacity:1;transform:scale(1.2)} }

  .page {
    position:relative; z-index:3;
    max-width:980px; margin:0 auto;
    padding: 0 22px 50px;
  }

  /* HEADER — dipepetkan */
  .hdr { text-align:center; padding: 5px 0 10px; }
  .bw  { position:relative; display:inline-flex; align-items:center; justify-content:center; }
  .bw img.fi-img { width:280px; max-width:78vw; filter:drop-shadow(0 4px 18px rgba(197,160,80,.38)); }
  .bw h1 {
    position:absolute; font-family:'Cinzel',serif;
    font-size:clamp(.8rem,2vw,1.2rem); font-weight:700;
    background:linear-gradient(135deg,#fff8ee,#f5d78e,#fff8ee);
    -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;
    letter-spacing:3px; margin:0; white-space:nowrap;
  }

  .tagline-wrap {
    text-align:center; margin:-45px 0 24px;
    font-family:'Cinzel',serif;
    font-size:clamp(.66rem,1.3vw,.8rem);
    color:#c8860a; letter-spacing:3px; font-style:italic;
    min-height:1.4em;
  }
  .cursor-blink {
    display:inline-block; width:2px; height:.9em;
    background:#f5d78e; margin-left:2px;
    vertical-align:middle; animation:blink .7s infinite;
  }
  @keyframes blink { 0%,100%{opacity:1} 50%{opacity:0} }

  /* ── BENTO GRID ──
     Layout:
     Row 1: about(2col) | visi(1col)
     Row 2: misi(2col)  | sdg4(1col)   ← FIXED: sdg4 pindah ke sini tapi kita pisah
     Row 3: sdg4 sdg5 sdg7 sdg8  ← semua SDG ngumpul di bawah
  */
  .bento {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 12px;
  }
  @media(max-width:700px){ .bento{ grid-template-columns:1fr; } }

  .cell {
    background:rgba(12,6,0,.72);
    border:1px solid rgba(197,160,80,.22);
    border-radius:16px;
    position:relative; overflow:hidden;
    backdrop-filter:blur(12px);
    box-shadow:0 4px 24px rgba(0,0,0,.45);
    transition:border-color .3s, box-shadow .3s;
    will-change:transform;
  }
  .cell::before {
    content:''; position:absolute; top:0;left:0;right:0; height:2px;
    background:linear-gradient(90deg,transparent,#c8860a,#f5d78e,#c8860a,transparent);
  }
  .cell:hover {
    border-color:rgba(197,160,80,.45);
  }

  /* Row 1 */
  .cell-about { grid-column:1/3; grid-row:1; padding:22px 26px; }
  .cell-visi  { grid-column:3;   grid-row:1; padding:20px 18px; cursor:default; }

  /* Row 2 — misi full width 3 cols */
  .cell-misi  { grid-column:1/4; grid-row:2; padding:18px 22px; }

  /* Row 3 — 4 SDGs rata */
  .cell-sdg4  { grid-column:1; grid-row:3; }
  .cell-sdg5  { grid-column:2; grid-row:3; }
  .cell-sdg7  { grid-column:3; grid-row:3; }

  /* Row 4 — SDG 8 (atau kita buat 2x2) */
  /* Kita pakai sub-grid 4 col untuk SDG section biar 4 sejajar */
  .sdg-section {
    grid-column: 1/4;
    grid-row: 3;
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr;
    gap: 12px;
  }
  @media(max-width:700px){ .sdg-section{ grid-template-columns:1fr 1fr; } }

  /* ABOUT */
  .about-head { display:flex; align-items:center; gap:11px; margin-bottom:11px; }
  .about-head img { width:30px; filter:drop-shadow(0 0 8px rgba(245,215,142,.5)); animation:fy 4s ease-in-out infinite; }
  .about-head h2 {
    font-family:'Cinzel',serif; font-size:.92rem;
    background:linear-gradient(135deg,#f5d78e,#fdf0c0,#c8860a);
    -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;
    margin:0; letter-spacing:1px;
  }
  .cell-about p { font-size:.79rem; color:#c0966a; line-height:1.82; margin:0 0 11px; }
  .cell-about .tgl {
    font-family:'Cinzel',serif; font-size:.68rem; color:#f5d78e;
    letter-spacing:2px; border-top:1px solid rgba(197,160,80,.2);
    padding-top:9px; font-style:italic; text-align:center; opacity:.82;
  }

  /* VISI hover reveal */
  .cell-visi .v-icon {
    font-size:1.8rem; text-align:center; display:block; margin-bottom:8px;
    filter:drop-shadow(0 0 10px rgba(245,215,142,.4));
  }
  .cell-visi h3 {
    font-family:'Cinzel',serif; font-size:.86rem; color:#f5d78e;
    text-align:center; margin:0 0 8px; letter-spacing:1px;
  }
  .cell-visi .v-teaser { font-size:.72rem; color:#9a7040; text-align:center; line-height:1.5; transition:opacity .3s; }
  .cell-visi .v-full {
    font-size:.74rem; color:#c0966a; line-height:1.8;
    position:absolute; inset:0; padding:20px 18px;
    background:rgba(12,6,0,.96); border-radius:16px;
    opacity:0; transition:opacity .35s;
    display:flex; flex-direction:column; justify-content:center;
    pointer-events:none;
  }
  .cell-visi .v-full h3 { margin-bottom:9px; }
  .cell-visi:hover .v-teaser { opacity:0; }
  .cell-visi:hover .v-full   { opacity:1; pointer-events:auto; }

  /* MISI */
  .cell-misi h3 { font-family:'Cinzel',serif; font-size:.86rem; color:#f5d78e; margin:0 0 11px; letter-spacing:1px; }
  .misi-grid { display:grid; grid-template-columns:1fr 1fr 1fr 1fr; gap:6px 16px; }
  @media(max-width:700px){ .misi-grid{ grid-template-columns:1fr 1fr; } }
  .misi-item { display:flex; gap:7px; align-items:flex-start; font-size:.74rem; color:#c0966a; line-height:1.68; }
  .mi-num { font-family:'Cinzel',serif; font-size:.68rem; color:#f5d78e; min-width:18px; font-weight:700; opacity:.7; padding-top:1px; }

  /* SDG inside sdg-section */
  .sdg-card {
    background:rgba(12,6,0,.72);
    border:1px solid rgba(197,160,80,.22);
    border-radius:16px;
    position:relative; overflow:hidden;
    backdrop-filter:blur(12px);
    box-shadow:0 4px 24px rgba(0,0,0,.45);
    transition:border-color .3s, box-shadow .3s;
    will-change:transform;
  }
  .sdg-card::before {
    content:''; position:absolute; top:0;left:0;right:0; height:2px;
    background:linear-gradient(90deg,transparent,#c8860a,#f5d78e,#c8860a,transparent);
  }
  .sdg-card:hover { border-color:rgba(197,160,80,.45); }

  .sdg-inner {
    padding:16px 14px; cursor:pointer; height:100%;
    display:flex; flex-direction:column; align-items:center; justify-content:center;
    text-align:center; gap:9px; transition:background .3s;
  }
  .sdg-inner:hover { background:rgba(197,160,80,.05); }
  .sdg-b {
    width:50px; height:50px; border-radius:12px;
    display:flex; align-items:center; justify-content:center;
    font-family:'Cinzel',serif; font-weight:700; font-size:.62rem;
    color:#fff; text-align:center; line-height:1.2;
    box-shadow:0 3px 14px rgba(0,0,0,.55),0 0 0 1.5px rgba(255,255,255,.12) inset;
    position:relative; overflow:hidden;
    transition:transform .25s, box-shadow .25s;
  }
  .sdg-b::after {
    content:''; position:absolute; top:0;left:0;right:0; height:45%;
    background:rgba(255,255,255,.14); border-radius:12px 12px 0 0;
  }
  .sdg-inner:hover .sdg-b {
    transform:scale(1.1);
    box-shadow:0 6px 20px rgba(0,0,0,.6),0 0 18px var(--sdg-glow),0 0 0 1.5px rgba(255,255,255,.18) inset;
  }
  .b4{background:linear-gradient(145deg,#d42038,#a01020);--sdg-glow:rgba(212,32,56,.55)}
  .b5{background:linear-gradient(145deg,#ee3a4c,#b82030);--sdg-glow:rgba(238,58,76,.55)}
  .b7{background:linear-gradient(145deg,#e8b040,#b88020);color:#2a1800;--sdg-glow:rgba(232,176,64,.55)}
  .b8{background:linear-gradient(145deg,#b01e4a,#7e1232);--sdg-glow:rgba(176,30,74,.55)}
  .sdg-inner h4 { font-family:'Cinzel',serif; font-size:.7rem; color:#f5d78e; margin:0; letter-spacing:.5px; line-height:1.35; }
  .sdg-hint { font-size:.6rem; color:#7a5a30; letter-spacing:1px; font-family:'Cinzel',serif; }

  /* MODAL */
  .modal-overlay {
    position:fixed; inset:0; background:rgba(4,2,0,.82);
    z-index:8000; display:flex; align-items:center; justify-content:center;
    opacity:0; pointer-events:none; transition:opacity .3s; backdrop-filter:blur(4px);
  }
  .modal-overlay.open { opacity:1; pointer-events:auto; }
  .modal-box {
    background:rgba(14,7,0,.97); border:1px solid rgba(197,160,80,.45);
    border-radius:20px; padding:30px 34px; max-width:480px; width:90%;
    position:relative;
    transform:scale(.92) translateY(16px);
    transition:transform .35s cubic-bezier(.34,1.56,.64,1);
    box-shadow:0 0 0 1px rgba(197,160,80,.1) inset,0 24px 60px rgba(0,0,0,.7),0 0 60px rgba(197,160,80,.08);
  }
  .modal-box::before {
    content:''; position:absolute; top:0;left:0;right:0; height:2px;
    background:linear-gradient(90deg,transparent,#c8860a,#f5d78e,#c8860a,transparent);
    border-radius:20px 20px 0 0;
  }
  .modal-overlay.open .modal-box { transform:scale(1) translateY(0); }
  .modal-close {
    position:absolute; top:13px; right:15px;
    background:none; border:none; cursor:pointer;
    color:#9a7040; font-size:1.1rem; transition:color .2s;
  }
  .modal-close:hover { color:#f5d78e; }
  .modal-sdg-head { display:flex; align-items:center; gap:13px; margin-bottom:16px; }
  .modal-sdg-head .sdg-b { width:54px; height:54px; font-size:.7rem; flex-shrink:0; }
  .modal-sdg-head h3 { font-family:'Cinzel',serif; font-size:.96rem; color:#f5d78e; margin:0 0 3px; }
  .modal-sdg-head span { font-size:.7rem; color:#9a7040; letter-spacing:1px; }
  .modal-body p { font-size:.8rem; color:#c0966a; line-height:1.85; margin:0 0 9px; }
  .modal-body p:last-child { margin:0; }
  .modal-tag {
    display:inline-block; margin-top:12px;
    background:rgba(197,160,80,.12); border:1px solid rgba(197,160,80,.25);
    border-radius:20px; padding:3px 13px;
    font-family:'Cinzel',serif; font-size:.62rem; color:#c8860a; letter-spacing:1.5px;
  }

  /* QUOTE */
  .qt { text-align:center; margin-top:12px; }
  .qt-inner {
    display:inline-flex; align-items:center; gap:13px;
    background:rgba(12,6,0,.55); border:1px solid rgba(197,160,80,.2);
    border-radius:40px; padding:10px 26px; backdrop-filter:blur(8px);
  }
  .qt-inner img { width:22px; opacity:.55; animation:tw-anim 3s infinite alternate; }
  .qt-inner span {
    font-family:'Cinzel',serif; font-size:clamp(.66rem,1.3vw,.8rem);
    color:#c9a96e; font-style:italic; letter-spacing:2px;
  }

  .fi { opacity:0; transform:translateY(12px); transition:opacity .5s ease,transform .5s ease; }
  .fi.vis { opacity:1; transform:translateY(0); }
</style>

<div id="progress-bar"></div>
<div id="cursor-dot"></div>
<canvas id="sc"></canvas>

<div class="modal-overlay" id="sdg-modal" role="dialog" aria-modal="true">
  <div class="modal-box">
    <button class="modal-close" id="modal-close" aria-label="Tutup">✕</button>
    <div class="modal-sdg-head">
      <div class="sdg-b" id="m-badge"></div>
      <div><h3 id="m-title"></h3><span id="m-subtitle"></span></div>
    </div>
    <div class="modal-body" id="m-body"></div>
  </div>
</div>

<div class="tw">
  <img src="{{ asset('assets/witch-hat.png') }}"    class="deco d-hat" data-depth=".06" alt="">
  <img src="{{ asset('assets/Wand.png') }}"         class="deco d-wand" data-depth=".04" alt="">
  <img src="{{ asset('assets/stars.png') }}"        class="deco d-s1"  data-depth=".08" alt="">
  <img src="{{ asset('assets/stars.png') }}"        class="deco d-s2"  data-depth=".05" alt="">
  <img src="{{ asset('assets/magic-clumps.png') }}" class="deco d-ml"  data-depth=".03" alt="">
  <img src="{{ asset('assets/magic-clumps.png') }}" class="deco d-mr"  data-depth=".03" alt="">
  <img src="{{ asset('assets/leaves.png') }}"       class="deco d-ll"  alt="">
  <img src="{{ asset('assets/leaves.png') }}"       class="deco d-lr"  alt="">

  <div class="page">

    <div class="hdr">
      <div class="bw">
        <img src="{{ asset('assets/header-flag.png') }}" class="fi-img" alt="">
        <h1>Tentang ISFEST</h1>
      </div>
    </div>

    <div class="tagline-wrap">
      <span id="typewriter-text"></span><span class="cursor-blink"></span>
    </div>

    <div class="bento">

      {{-- ROW 1: About + Visi --}}
      <div class="cell cell-about fi">
        <div class="about-head">
          <img src="{{ asset('assets/book-open.png') }}" alt="">
          <h2>Information System Festival 2026</h2>
        </div>
        <p>ISFEST adalah program kerja tahunan
          <strong style="color:#f5d78e">Himpunan Mahasiswa Sistem Informasi
          Universitas Multimedia Nusantara (HIMSI UMN)</strong> — wadah pengembangan
          kompetensi, kreativitas, dan karakter generasi muda di bidang teknologi informasi.
          Dirancang sebagai ruang pembelajaran, kolaborasi, dan pengembangan diri melalui
          rangkaian kegiatan edukatif, kompetitif, dan inspiratif: talk show, workshop,
          kompetisi inovasi, hingga awarding night.</p>
        <div class="tgl">✦ "The Grand Wizarding Conquest: Rise Beyond All Limits" ✦</div>
      </div>

      <div class="cell cell-visi fi" style="transition-delay:.07s">
        <span class="v-icon">🔮</span>
        <h3>Visi</h3>
        <p class="v-teaser">ISFEST 2026…</p>
        <div class="v-full">
          <h3>🔮 Visi</h3>
          <p>Menjadi wadah pengembangan generasi muda yang unggul, adaptif, dan berdaya saing
          global — membentuk individu yang mampu melampaui batas diri dan berkontribusi aktif
          dalam pembangunan masa depan digital.</p>
        </div>
      </div>

      {{-- ROW 2: Misi full width --}}
      <div class="cell cell-misi fi" style="transition-delay:.12s">
        <h3>📜 Misi</h3>
        <div class="misi-grid">
          <div class="misi-item"><span class="mi-num">01</span><span>Menyelenggarakan kegiatan edukatif &amp; inspiratif di bidang teknologi informasi.</span></div>
          <div class="misi-item"><span class="mi-num">02</span><span>Memfasilitasi kompetisi untuk pengembangan hard &amp; soft skills.</span></div>
          <div class="misi-item"><span class="mi-num">03</span><span>Mendorong inovasi &amp; problem solving relevan industri digital.</span></div>
          <div class="misi-item"><span class="mi-num">04</span><span>Memberikan apresiasi potensi &amp; prestasi peserta ISFEST 2026.</span></div>
        </div>
      </div>

      {{-- ROW 3: 4 SDGs sejajar --}}
      <div class="sdg-section fi" style="transition-delay:.17s">

        <div class="sdg-card">
          <div class="sdg-inner" data-sdg="4">
            <div class="sdg-b b4">SDG<br>4</div>
            <h4>Quality Education</h4>
            <span class="sdg-hint">✦ klik detail</span>
          </div>
        </div>

        <div class="sdg-card">
          <div class="sdg-inner" data-sdg="5">
            <div class="sdg-b b5">SDG<br>5</div>
            <h4>Gender Equality</h4>
            <span class="sdg-hint">✦ klik detail</span>
          </div>
        </div>

        <div class="sdg-card">
          <div class="sdg-inner" data-sdg="7">
            <div class="sdg-b b7">SDG<br>7</div>
            <h4>Affordable &amp; Clean Energy</h4>
            <span class="sdg-hint">✦ klik detail</span>
          </div>
        </div>

        <div class="sdg-card">
          <div class="sdg-inner" data-sdg="8">
            <div class="sdg-b b8">SDG<br>8</div>
            <h4>Decent Work &amp; Economic Growth</h4>
            <span class="sdg-hint">✦ klik detail</span>
          </div>
        </div>

      </div>{{-- /sdg-section --}}

    </div>{{-- /bento --}}

    <div class="qt fi" style="transition-delay:.25s">
      <div class="qt-inner">
        <img src="{{ asset('assets/stars.png') }}" alt="">
        <span>"Unleash Your Magic, Forge the Future"</span>
        <img src="{{ asset('assets/stars.png') }}" alt="">
      </div>
    </div>

  </div>
</div>

<script>
const SDG_DATA = {
  4:{badge:'b4',label:'SDG 4',title:'Quality Education',subtitle:'Pendidikan Berkualitas',
     body:`<p>ISFEST 2026 mengimplementasikan SDG 4 melalui <strong style="color:#f5d78e">seminar, workshop, dan kompetisi</strong> yang memberikan ruang pembelajaran aplikatif kepada generasi muda.</p><p>Peserta mendapat wawasan langsung dari praktisi industri teknologi digital, membangun kemampuan relevan dunia kerja masa kini dan masa depan.</p><span class="modal-tag">✦ Seminar · Workshop · Kompetisi</span>`},
  5:{badge:'b5',label:'SDG 5',title:'Gender Equality',subtitle:'Kesetaraan Gender',
     body:`<p>ISFEST 2026 membuka kesempatan <strong style="color:#f5d78e">setara bagi seluruh peserta</strong> tanpa memandang gender — menciptakan lingkungan kompetisi yang inklusif, kolaboratif, dan bebas diskriminasi.</p><p>Seluruh penilaian dilakukan objektif berdasarkan kompetensi dan kontribusi nyata setiap individu.</p><span class="modal-tag">✦ Inklusif · Kolaboratif · Setara</span>`},
  7:{badge:'b7',label:'SDG 7',title:'Affordable & Clean Energy',subtitle:'Energi Bersih & Terjangkau',
     body:`<p>Diintegrasikan ke dalam <strong style="color:#f5d78e">Data Competition ISFEST 2026</strong> — peserta merancang solusi berbasis data berfokus pada peningkatan akses ekosistem kendaraan listrik di Indonesia.</p><p>Inovasi peserta diharapkan menjawab tantangan transisi energi berkelanjutan dan ramah lingkungan.</p><span class="modal-tag">✦ Data Competition · EV Ecosystem</span>`},
  8:{badge:'b8',label:'SDG 8',title:'Decent Work & Economic Growth',subtitle:'Pekerjaan Layak & Pertumbuhan Ekonomi',
     body:`<p>Diimplementasikan melalui <strong style="color:#f5d78e">UI/UX Competition ISFEST 2026</strong> — peserta merancang solusi desain berfokus pada perluasan akses dan literasi keuangan masyarakat Indonesia.</p><p>Karya terbaik menjadi kontribusi nyata terhadap inklusi finansial dan pertumbuhan ekonomi digital.</p><span class="modal-tag">✦ UI/UX Competition · Financial Literacy</span>`}
};

/* PROGRESS BAR */
const bar = document.getElementById('progress-bar');
window.addEventListener('scroll',()=>{
  const pct = window.scrollY/(document.body.scrollHeight-window.innerHeight)*100;
  bar.style.width = Math.min(pct,100)+'%';
});

/* MAGIC CURSOR */
const dot = document.getElementById('cursor-dot');
let sparkTimer=0;
document.addEventListener('mousemove',e=>{
  dot.style.left=e.clientX+'px'; dot.style.top=e.clientY+'px';
  if(Date.now()-sparkTimer>42){
    sparkTimer=Date.now(); spawnSpark(e.clientX,e.clientY);
  }
});
function spawnSpark(x,y){
  const s=document.createElement('div'); s.className='spark';
  const sz=Math.random()*5+2;
  const dx=(Math.random()-.5)*32, dy=(Math.random()-.5)*32;
  const cols=['#f5d78e','#c8860a','#fff8ee','#f0c060'];
  s.style.cssText=`left:${x}px;top:${y}px;width:${sz}px;height:${sz}px;background:${cols[Math.floor(Math.random()*cols.length)]};--dx:${dx}px;--dy:${dy}px;`;
  document.body.appendChild(s);
  setTimeout(()=>s.remove(),600);
}

/* STARS */
(function(){
  const c=document.getElementById('sc'); if(!c)return;
  const x=c.getContext('2d'); let s=[];
  function rsz(){c.width=window.innerWidth;c.height=document.body.scrollHeight;}
  function init(){rsz();s=Array.from({length:80},()=>({px:Math.random()*c.width,py:Math.random()*c.height,r:Math.random()*1+.2,sp:Math.random()*.006+.003,ph:Math.random()*Math.PI*2}));}
  function draw(t){x.clearRect(0,0,c.width,c.height);s.forEach(p=>{const a=.2+.8*(.5+.5*Math.sin(t*p.sp*1000+p.ph));x.beginPath();x.arc(p.px,p.py,p.r,0,Math.PI*2);x.fillStyle=`rgba(245,215,142,${a})`;x.fill();});requestAnimationFrame(draw);}
  init();window.addEventListener('resize',init);requestAnimationFrame(draw);
})();

/* PARALLAX */
const decos=document.querySelectorAll('.deco[data-depth]');
document.addEventListener('mousemove',e=>{
  const cx=window.innerWidth/2,cy=window.innerHeight/2;
  const dx=e.clientX-cx,dy=e.clientY-cy;
  decos.forEach(d=>{
    const depth=parseFloat(d.dataset.depth);
    const ox=dx*depth,oy=dy*depth;
    d.style.transform=d.classList.contains('d-wand')?`rotate(30deg) translate(${ox}px,${oy}px)`:`translate(${ox}px,${oy}px)`;
  });
});

/* TYPEWRITER */
(function(){
  const el=document.getElementById('typewriter-text');
  const text='✦  "The Grand Wizarding Conquest: Rise Beyond All Limits"  ✦';
  let i=0;
  function type(){if(i<=text.length){el.textContent=text.slice(0,i++);setTimeout(type,i<3?200:36);}}
  setTimeout(type,700);
})();

/* CARD TILT + BREATHE + INTERNAL SPARKLE */
function spawnCardSpark(card){
  const r=card.getBoundingClientRect();
  for(let i=0;i<6;i++){
    const s=document.createElement('div');
    s.className='card-spark';
    const sz=Math.random()*4+2;
    const sx=Math.random()*r.width;
    const sy=Math.random()*r.height;
    const dx=(Math.random()-.5)*40;
    const dy=(Math.random()-.5)*40;
    const cols=['#f5d78e','#c8860a','#fdf0c0','#fff8ee'];
    s.style.cssText=`left:${sx}px;top:${sy}px;width:${sz}px;height:${sz}px;background:${cols[Math.floor(Math.random()*cols.length)]};--cdx:${dx}px;--cdy:${dy}px;`;
    card.appendChild(s);
    setTimeout(()=>s.remove(),800);
  }
}

document.querySelectorAll('.cell, .sdg-card').forEach(card=>{
  let breatheTimer=null, sparkInterval=null, isTilting=false;

  card.addEventListener('mousemove',e=>{
    isTilting=true;
    // stop breathe & sparkle while moving
    card.classList.remove('breathing');
    clearTimeout(breatheTimer);
    clearInterval(sparkInterval);

    const r=card.getBoundingClientRect();
    const cx=r.left+r.width/2, cy=r.top+r.height/2;
    const rx=((e.clientY-cy)/(r.height/2))*-7;
    const ry=((e.clientX-cx)/(r.width/2))*7;
    card.style.transform=`perspective(600px) rotateX(${rx}deg) rotateY(${ry}deg) translateZ(5px)`;
    card.style.transition='transform .05s, border-color .3s, box-shadow .3s';

    // after 1.2s of hover stillness → breathe + sparkle
    clearTimeout(breatheTimer);
    breatheTimer=setTimeout(()=>{
      card.classList.add('breathing');
      spawnCardSpark(card);
      sparkInterval=setInterval(()=>spawnCardSpark(card),900);
    },1200);
  });

  card.addEventListener('mouseleave',()=>{
    isTilting=false;
    card.classList.remove('breathing');
    clearTimeout(breatheTimer);
    clearInterval(sparkInterval);
    card.style.transition='transform .45s ease, border-color .3s, box-shadow .3s';
    card.style.transform='';
    setTimeout(()=>{ card.style.transition=''; },450);
  });
});

/* SDG MODAL */
const overlay=document.getElementById('sdg-modal');
const mClose=document.getElementById('modal-close');
const mBadge=document.getElementById('m-badge');
const mTitle=document.getElementById('m-title');
const mSub=document.getElementById('m-subtitle');
const mBody=document.getElementById('m-body');

document.querySelectorAll('.sdg-inner').forEach(el=>{
  el.addEventListener('click',()=>{
    const d=SDG_DATA[el.dataset.sdg]; if(!d)return;
    mBadge.className='sdg-b '+d.badge;
    mBadge.innerHTML=d.label.replace(' ','<br>');
    mTitle.textContent=d.title;
    mSub.textContent=d.subtitle;
    mBody.innerHTML=d.body;
    overlay.classList.add('open');
    document.body.style.overflow='hidden';
  });
});
function closeModal(){overlay.classList.remove('open');document.body.style.overflow='';}
mClose.addEventListener('click',closeModal);
overlay.addEventListener('click',e=>{if(e.target===overlay)closeModal();});
document.addEventListener('keydown',e=>{if(e.key==='Escape')closeModal();});

/* FADE IN */
(function(){
  const els=document.querySelectorAll('.fi');
  const io=new IntersectionObserver(en=>{en.forEach(e=>{if(e.isIntersecting){e.target.classList.add('vis');io.unobserve(e.target);}});},{threshold:.08});
  els.forEach(e=>io.observe(e));
})();
</script>

</x-layout.app>