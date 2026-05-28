{{-- resources/views/divisi.blade.php --}}
<x-layout.app title="Divisi — ISFEST 2026">

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
    position: fixed; top: 0; left: 0; height: 2px; width: 0%;
    background: linear-gradient(90deg,#c8860a,#f5d78e,#c8860a);
    z-index: 9999; box-shadow: 0 0 8px rgba(245,215,142,.6);
    transition: width .1s linear;
  }

  #cursor-dot {
    position: fixed; pointer-events: none;
    width: 8px; height: 8px; border-radius: 50%;
    background: #f5d78e; z-index: 9998;
    transform: translate(-50%,-50%); mix-blend-mode: screen;
  }
  .spark {
    position: fixed; pointer-events: none; border-radius: 50%; z-index: 9997;
    transform: translate(-50%,-50%);
    animation: spark-fade .6s ease-out forwards;
  }
  @keyframes spark-fade {
    0%   { opacity:1; transform:translate(-50%,-50%) scale(1); }
    100% { opacity:0; transform:translate(calc(-50% + var(--dx)),calc(-50% + var(--dy))) scale(0); }
  }

  @keyframes cspark {
    0%   { opacity:1; transform:translate(0,0) scale(1); }
    100% { opacity:0; transform:translate(var(--cdx),var(--cdy)) scale(0); }
  }

  @keyframes breathe {
    0%,100% { box-shadow:0 4px 24px rgba(0,0,0,.45),0 0 0px rgba(197,160,80,0); }
    50%     { box-shadow:0 4px 24px rgba(0,0,0,.45),0 0 22px rgba(197,160,80,.22),0 0 40px rgba(197,160,80,.08); }
  }

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
    max-width:1040px; margin:0 auto;
    padding: 0 22px 60px;
  }

  /* HEADER */
  .hdr { text-align:center; padding:14px 0 16px; }
  .bw  { position:relative; display:inline-flex; align-items:center; justify-content:center; }
  .bw img.fi-img { width:280px; max-width:78vw; filter:drop-shadow(0 4px 18px rgba(197,160,80,.38)); }
  .bw h1 {
    position:absolute; font-family:'Cinzel',serif;
    font-size:clamp(.8rem,2vw,1.2rem); font-weight:700;
    background:linear-gradient(135deg,#fff8ee,#f5d78e,#fff8ee);
    -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;
    letter-spacing:3px; margin:0; white-space:nowrap;
  }

  /* SOVEREIGN CARD */
  .sovereign-card {
    background: rgba(12,6,0,.75);
    border: 1px solid rgba(197,160,80,.4);
    border-radius: 20px;
    padding: 28px 32px;
    position: relative; overflow: hidden;
    backdrop-filter: blur(12px);
    box-shadow: 0 0 0 1px rgba(197,160,80,.08) inset, 0 8px 40px rgba(0,0,0,.55), 0 0 60px rgba(197,160,80,.07);
    margin-bottom: 20px;
    cursor: pointer;
    transition: border-color .3s, box-shadow .3s, transform .3s;
    will-change: transform;
  }
  .sovereign-card::before {
    content:''; position:absolute; top:0;left:0;right:0; height:2px;
    background:linear-gradient(90deg,transparent,#c8860a,#f5d78e,#c8860a,transparent);
  }
  .sovereign-card::after {
    content:''; position:absolute; top:0; left:-100%; width:55%; height:100%;
    background:linear-gradient(90deg,transparent,rgba(245,215,142,.04),transparent);
    transition:left .6s;
  }
  .sovereign-card:hover { border-color:rgba(197,160,80,.55); box-shadow:0 12px 44px rgba(0,0,0,.6),0 0 40px rgba(197,160,80,.12); }
  .sovereign-card:hover::after { left:140%; }

  .sovereign-card .s-deco-leaves {
    position:absolute; left:0; bottom:0; width:110px; opacity:.12; pointer-events:none;
    animation: fy 5s ease-in-out infinite;
  }
  .sovereign-card .s-deco-mascot {
    position:absolute; right:0; bottom:0; height:160px; opacity:.55; pointer-events:none;
    animation: fy 4s ease-in-out infinite;
  }

  .s-inner { position:relative; z-index:2; display:flex; align-items:center; gap:22px; flex-wrap:wrap; }
  .s-logo  { width:80px; height:80px; object-fit:contain; filter:drop-shadow(0 0 16px rgba(245,215,142,.4)); animation:fy 4s ease-in-out infinite; flex-shrink:0; }
  .s-info  { flex:1; min-width:0; }
  .s-tag   { font-family:'Cinzel',serif; font-size:.62rem; letter-spacing:3px; color:rgba(245,215,142,.55); text-transform:uppercase; margin-bottom:4px; }
  .s-name  { font-family:'Cinzel',serif; font-size:1.6rem; font-weight:700;
    background:linear-gradient(135deg,#fff8ee,#f5d78e,#c8860a);
    -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;
    margin:0 0 2px; letter-spacing:2px;
  }
  .s-label { font-family:'Cinzel',serif; font-size:.72rem; color:#c8860a; letter-spacing:2px; text-transform:uppercase; margin-bottom:14px; }
  .s-members { display:flex; flex-wrap:wrap; gap:8px; }
  .s-member {
    padding:6px 14px; border-radius:10px;
    border:1px solid rgba(197,160,80,.2); background:rgba(197,160,80,.06);
    transition: border-color .25s, background .25s;
  }
  .s-member:hover { border-color:rgba(197,160,80,.45); background:rgba(197,160,80,.12); }
  .s-member .sm-name { font-size:.76rem; font-weight:700; color:#f5e6c8; }
  .s-member .sm-role { font-size:.62rem; color:rgba(197,160,80,.65); letter-spacing:1px; text-transform:uppercase; }
  .s-btn {
    flex-shrink:0; align-self:center;
    display:inline-flex; align-items:center; gap:6px;
    padding:8px 20px; border-radius:30px;
    border:1px solid rgba(197,160,80,.35); color:#f5d78e;
    font-family:'Cinzel',serif; font-size:.68rem; letter-spacing:1.5px; text-transform:uppercase;
    background:rgba(197,160,80,.06);
    transition:background .25s, border-color .25s;
    cursor:pointer;
  }
  .s-btn:hover { background:rgba(197,160,80,.15); border-color:rgba(197,160,80,.6); }

  /* DIVIDER */
  .sec-div {
    display:flex; align-items:center; gap:14px;
    margin: 4px 0 16px;
  }
  .sec-div .sd-line { flex:1; height:1px; background:linear-gradient(to right,transparent,rgba(197,160,80,.3),transparent); }
  .sec-div span {
    font-family:'Cinzel',serif; font-size:.68rem;
    letter-spacing:4px; color:rgba(197,160,80,.5); text-transform:uppercase;
  }

  /* DIVISI GRID */
  .divisi-grid {
    display:grid;
    grid-template-columns: repeat(4, 1fr);
    gap:12px;
  }
  @media(max-width:780px){ .divisi-grid{ grid-template-columns:repeat(3,1fr); } }
  @media(max-width:520px){ .divisi-grid{ grid-template-columns:repeat(2,1fr); } }

  .div-card {
    background:rgba(12,6,0,.70);
    border:1px solid rgba(197,160,80,.18);
    border-radius:16px;
    padding:20px 14px 16px;
    display:flex; flex-direction:column; align-items:center; gap:10px;
    text-align:center; cursor:pointer;
    position:relative; overflow:hidden;
    backdrop-filter:blur(10px);
    box-shadow:0 4px 20px rgba(0,0,0,.4);
    transition:transform .3s, border-color .3s, box-shadow .3s;
    will-change:transform;
  }
  .div-card::before {
    content:''; position:absolute; top:0;left:0;right:0; height:2px;
    background:linear-gradient(90deg,transparent,#c8860a,#f5d78e,#c8860a,transparent);
    opacity:0; transition:opacity .3s;
  }
  .div-card:hover { transform:translateY(-4px); border-color:rgba(197,160,80,.42); box-shadow:0 10px 32px rgba(0,0,0,.5),0 0 22px rgba(197,160,80,.1); }
  .div-card:hover::before { opacity:1; }

  .div-logo { width:72px; height:72px; object-fit:contain; filter:drop-shadow(0 0 10px rgba(245,215,142,.25)); transition:filter .3s, transform .3s; }
  .div-card:hover .div-logo { filter:drop-shadow(0 0 18px rgba(245,215,142,.5)); transform:scale(1.08); }
  .div-name  { font-family:'Cinzel',serif; font-size:.88rem; font-weight:700; color:#f5d78e; letter-spacing:1px; margin:0; }
  .div-label { font-size:.68rem; color:#9a7040; letter-spacing:.5px; margin:0; }
  .div-hint  { font-family:'Cinzel',serif; font-size:.58rem; color:rgba(197,160,80,.4); letter-spacing:1.5px; }

  .breathing { animation: breathe 2s ease-in-out infinite; }

  /* MODAL */
  .modal-overlay {
    position:fixed; inset:0; z-index:8000;
    display:none; align-items:center; justify-content:center; padding:16px;
    background:rgba(4,2,0,.88); backdrop-filter:blur(8px);
  }
  .modal-overlay.open { display:flex; }
  .modal-box {
    position:relative; width:100%; max-width:640px; max-height:90vh;
    background:rgba(12,6,0,.97); border:1px solid rgba(197,160,80,.4);
    border-radius:22px; overflow:hidden;
    display:flex; flex-direction:column;
    box-shadow:0 0 0 1px rgba(197,160,80,.08) inset,0 24px 60px rgba(0,0,0,.75),0 0 60px rgba(197,160,80,.07);
    animation:modal-in .35s cubic-bezier(.34,1.56,.64,1);
  }
  @keyframes modal-in { from{transform:scale(.9) translateY(16px);opacity:0} to{transform:scale(1) translateY(0);opacity:1} }
  .modal-box::before {
    content:''; position:absolute; top:0;left:0;right:0; height:2px;
    background:linear-gradient(90deg,transparent,#c8860a,#f5d78e,#c8860a,transparent);
    z-index:5;
  }

  /* SLIDER */
  .slider-wrap { position:relative; height:260px; overflow:hidden; flex-shrink:0; }
  .slider-track { display:flex; height:100%; transition:transform .5s ease; }
  .slider-track img { min-width:100%; height:100%; object-fit:cover; }
  .slider-btn {
    position:absolute; top:50%; transform:translateY(-50%);
    width:36px; height:36px; border-radius:50%;
    background:rgba(0,0,0,.6); border:1px solid rgba(197,160,80,.3);
    color:#f5d78e; font-size:1.2rem;
    display:flex; align-items:center; justify-content:center;
    cursor:pointer; z-index:4;
    transition:background .2s, border-color .2s;
  }
  .slider-btn:hover { background:rgba(0,0,0,.85); border-color:rgba(197,160,80,.7); }
  .slider-btn.prev { left:10px; }
  .slider-btn.next { right:10px; }
  .slider-dots { position:absolute; bottom:10px; left:50%; transform:translateX(-50%); display:flex; gap:6px; z-index:4; }
  .sdot {
    height:7px; border-radius:999px; transition:all .3s;
    background:rgba(255,255,255,.3); width:7px;
  }
  .sdot.active { background:#f5d78e; width:18px; }

  /* MODAL BODY */
  .modal-body { overflow-y:auto; padding:20px 24px 24px; flex:1; }
  .modal-head { display:flex; align-items:center; gap:14px; margin-bottom:18px; }
  .modal-head img { width:56px; height:56px; object-fit:contain; filter:drop-shadow(0 0 10px rgba(245,215,142,.4)); }
  .modal-head h2 { font-family:'Cinzel',serif; font-size:1.3rem; font-weight:700;
    background:linear-gradient(135deg,#f5d78e,#fdf0c0,#c8860a);
    -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;
    margin:0 0 2px; letter-spacing:1px;
  }
  .modal-head p { font-family:'Cinzel',serif; font-size:.68rem; color:#c8860a; letter-spacing:2px; text-transform:uppercase; margin:0; }

  .member-section-label {
    font-family:'Cinzel',serif; font-size:.62rem; letter-spacing:3px;
    text-transform:uppercase; margin:14px 0 8px;
  }
  .member-section-label.gold { color:rgba(197,160,80,.7); }
  .member-section-label.dim  { color:rgba(100,116,139,.7); }

  .member-row {
    display:flex; align-items:center; justify-content:space-between;
    padding:10px 14px; border-radius:11px; margin-bottom:5px;
    transition:background .2s;
  }
  .member-row.lead {
    background:rgba(197,160,80,.08); border:1px solid rgba(197,160,80,.2);
  }
  .member-row.reg {
    background:rgba(20,10,0,.55); border:1px solid rgba(197,160,80,.1);
  }
  .member-row:hover { background:rgba(197,160,80,.13); }
  .member-row .mr-name { font-size:.82rem; font-weight:700; color:#f5e6c8; margin:0; }
  .member-row .mr-role { font-size:.68rem; color:#9a7040; margin:0; }
  .member-row .mr-nim  { font-size:.68rem; color:#5a4030; font-family:monospace; }

  .modal-close {
    position:absolute; top:12px; right:14px; z-index:10;
    width:30px; height:30px; border-radius:50%;
    background:rgba(0,0,0,.7); border:1px solid rgba(197,160,80,.25);
    color:#9a7040; font-size:1rem;
    display:flex; align-items:center; justify-content:center;
    cursor:pointer; transition:color .2s, border-color .2s;
  }
  .modal-close:hover { color:#f5d78e; border-color:rgba(197,160,80,.6); }

  /* QUOTE */
  .qt { text-align:center; margin-top:20px; }
  .qt-inner {
    display:inline-flex; align-items:center; gap:13px;
    background:rgba(12,6,0,.55); border:1px solid rgba(197,160,80,.2);
    border-radius:40px; padding:10px 26px; backdrop-filter:blur(8px);
  }
  .qt-inner img { width:22px; opacity:.55; animation:tw-anim 3s infinite alternate; }
  .qt-inner span { font-family:'Cinzel',serif; font-size:clamp(.66rem,1.3vw,.8rem); color:#c9a96e; font-style:italic; letter-spacing:2px; }

  .fi { opacity:0; transform:translateY(12px); transition:opacity .5s ease,transform .5s ease; }
  .fi.vis { opacity:1; transform:translateY(0); }
</style>

<div id="progress-bar"></div>
<div id="cursor-dot"></div>
<canvas id="sc"></canvas>

{{-- MODAL --}}
<div class="modal-overlay" id="modal-overlay">
  <div class="modal-box" onclick="event.stopPropagation()">
    <button class="modal-close" id="modal-close">✕</button>

    <div class="slider-wrap">
      <div class="slider-track" id="slider-track"></div>
      <button class="slider-btn prev" onclick="slide(-1)">‹</button>
      <button class="slider-btn next" onclick="slide(1)">›</button>
      <div class="slider-dots" id="slider-dots"></div>
    </div>

    <div class="modal-body">
      <div class="modal-head">
        <img id="m-logo" src="" alt="">
        <div>
          <h2 id="m-name"></h2>
          <p id="m-label"></p>
        </div>
      </div>
      <div id="m-members"></div>
    </div>
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

    {{-- HEADER --}}
    <div class="hdr">
      <div class="bw">
        <img src="{{ asset('assets/header-flag.png') }}" class="fi-img" alt="">
        <h1>Divisi</h1>
      </div>
    </div>

    @php
    $divisi = [
      ['name'=>'Sovereign','label'=>'Badan Pengurus Harian','folder'=>'Sovereign','members'=>[
        ['role'=>'Supervisi',   'name'=>'Alexa Hanna',            'nim'=>'00000114763'],
        ['role'=>'Ketua',       'name'=>'Julius Marselinus',       'nim'=>'00000111989'],
        ['role'=>'Wakil Ketua', 'name'=>'Johanes Anthony',         'nim'=>'00000105528'],
        ['role'=>'Sekretaris',  'name'=>'Angeline',                'nim'=>'00000130604'],
        ['role'=>'Bendahara',   'name'=>'Felicia Jesslyn Gunawan', 'nim'=>'00000137650'],
      ]],
      ['name'=>'Arcane','label'=>'Divisi Acara','folder'=>'Arcane','members'=>[
        ['role'=>'Koordinator','name'=>'Amelia Christina',               'nim'=>'00000135265'],
        ['role'=>'Koordinator','name'=>'Raissa Samantha Iswandi',        'nim'=>'00000136605'],
        ['role'=>'Anggota',   'name'=>'Frizky Yeremia Jerry Rumimpuna', 'nim'=>'00000134630'],
        ['role'=>'Anggota',   'name'=>'Arya Ramadhan',                  'nim'=>'00000140292'],
        ['role'=>'Anggota',   'name'=>'Kevin Lolo',                     'nim'=>'00000145004'],
        ['role'=>'Anggota',   'name'=>'Cecilia Jeannette Wang',         'nim'=>'0000132632'],
        ['role'=>'Anggota',   'name'=>'Eunice Lois F Antonius Ang',     'nim'=>'00000153617'],
      ]],
      ['name'=>'Vanguard','label'=>'Liaison Officer','folder'=>'Vanguard','members'=>[
        ['role'=>'Koordinator','name'=>'Mevira Agustin',                       'nim'=>'00000133729'],
        ['role'=>'Koordinator','name'=>'Bernadetta Laura',                      'nim'=>'00000133078'],
        ['role'=>'Anggota',   'name'=>'Xavier Arthadio Wijaya',               'nim'=>'00000133814'],
        ['role'=>'Anggota',   'name'=>'Bulan Eka Pratiwi',                    'nim'=>'00000134244'],
        ['role'=>'Anggota',   'name'=>'Jeremy Joe Hernella',                  'nim'=>'00000133913'],
        ['role'=>'Anggota',   'name'=>'Marcellius Jose Ryanto',               'nim'=>'00000137425'],
        ['role'=>'Anggota',   'name'=>'Jason Tjahjono',                       'nim'=>'00000134789'],
        ['role'=>'Anggota',   'name'=>'Jovan Diorlino',                       'nim'=>'00000135023'],
        ['role'=>'Anggota',   'name'=>'Steve Ken Vino Ruslim',                'nim'=>'00000132775'],
        ['role'=>'Anggota',   'name'=>'Givenio Tumangkas Manasye Tampubolon', 'nim'=>'00000137842'],
        ['role'=>'Anggota',   'name'=>'Daniel Surya Yudhistira',              'nim'=>'00000133067'],
        ['role'=>'Anggota',   'name'=>'Celine Claribel',                      'nim'=>'00000133251'],
        ['role'=>'Anggota',   'name'=>'Marcell Shawn',                        'nim'=>'00000142783'],
      ]],
      ['name'=>'Aegis','label'=>'Divisi Keamanan','folder'=>'Aegis','members'=>[
        ['role'=>'Koordinator','name'=>'Wilson',                     'nim'=>'00000133092'],
        ['role'=>'Koordinator','name'=>'Radot Timothy Nicholas N.',  'nim'=>'00000141644'],
        ['role'=>'Anggota',   'name'=>'Christiano Rayden Ten',      'nim'=>'00000142579'],
        ['role'=>'Anggota',   'name'=>'Justin Lee Reinhart',        'nim'=>'00000134342'],
        ['role'=>'Anggota',   'name'=>'Jonathan Edbert Santoso',    'nim'=>'00000135396'],
        ['role'=>'Anggota',   'name'=>'Gabriel Tandika Putra',      'nim'=>'00000137450'],
        ['role'=>'Anggota',   'name'=>'William Christanto Marpaung','nim'=>'00000154566'],
        ['role'=>'Anggota',   'name'=>'Jocelyn Electra Serafina',   'nim'=>'00000145209'],
        ['role'=>'Anggota',   'name'=>'Fery Darmawan',              'nim'=>'00000135241'],
        ['role'=>'Anggota',   'name'=>'Marcellino Harlim',          'nim'=>'00000134534'],
        ['role'=>'Anggota',   'name'=>'Clay Asher Jeremiah',        'nim'=>'00000139098'],
        ['role'=>'Anggota',   'name'=>'Gerry Evans Makabonga',      'nim'=>'00000134022'],
        ['role'=>'Anggota',   'name'=>'Hebert Favian',              'nim'=>'00000108952'],
        ['role'=>'Anggota',   'name'=>'Ferdinand Andhika Tamsil',   'nim'=>'00000133786'],
        ['role'=>'Anggota',   'name'=>'Helbert Howie Lymnois',      'nim'=>'00000123444'],
        ['role'=>'Anggota',   'name'=>'Aurelia Gizelle Lie',        'nim'=>'00000133074'],
        ['role'=>'Anggota',   'name'=>'Miranda Wijaya',             'nim'=>'00000143044'],
      ]],
      ['name'=>'Atelier','label'=>'Perlengkapan & Dekor','folder'=>'Atelier','members'=>[
        ['role'=>'Koordinator','name'=>'Kelvin Alexander',          'nim'=>'00000106797'],
        ['role'=>'Koordinator','name'=>'Ivana Gabriela Cahyadi',    'nim'=>'00000133718'],
        ['role'=>'Koordinator','name'=>'Cleavon Theodore Wijaya',   'nim'=>'0000091460'],
        ['role'=>'Anggota',   'name'=>'Florencia Priskila Budhi',  'nim'=>'00000117400'],
        ['role'=>'Anggota',   'name'=>'Dylan Valentino Kurniawan', 'nim'=>'00000109467'],
        ['role'=>'Anggota',   'name'=>'Kennedy Chen',              'nim'=>'00000105674'],
        ['role'=>'Anggota',   'name'=>'Christian Zoe Beru Tena',   'nim'=>'00000108336'],
        ['role'=>'Anggota',   'name'=>'Jefferson Octolius',        'nim'=>'00000123428'],
        ['role'=>'Anggota',   'name'=>'Nathania Putri Prayugo',    'nim'=>'00000108920'],
        ['role'=>'Anggota',   'name'=>'Machiko Putri Yuwan Kho',   'nim'=>'00000108889'],
        ['role'=>'Anggota',   'name'=>'Lavi Zahwa Lazuardi',       'nim'=>'00000105674'],
      ]],
      ['name'=>'Spectra','label'=>'Divisi Visual','folder'=>'Spectra','members'=>[
        ['role'=>'Koordinator','name'=>'Dhina Novitasari',       'nim'=>'00000144522'],
        ['role'=>'Koordinator','name'=>'Fernando Heryanto',      'nim'=>'00000133959'],
        ['role'=>'Koordinator','name'=>'Michelle Theresa',       'nim'=>'00000115492'],
        ['role'=>'Anggota',   'name'=>'Rama Banu Aditya',       'nim'=>'00000122395'],
        ['role'=>'Anggota',   'name'=>'Ira Tadissya Harahap',   'nim'=>'00000133881'],
        ['role'=>'Anggota',   'name'=>'Jolyn Chou',             'nim'=>'00000144125'],
        ['role'=>'Anggota',   'name'=>'Felicia Alberta Gunawan','nim'=>'00000144758'],
        ['role'=>'Anggota',   'name'=>'Melody Deana Phanata',   'nim'=>'00000144884'],
      ]],
      ['name'=>'Vault','label'=>'Funding & Sponsor','folder'=>'Vault','members'=>[
        ['role'=>'Koordinator','name'=>'Alexander Briant',          'nim'=>'0000099774'],
        ['role'=>'Koordinator','name'=>'Irgo Huang',                'nim'=>'00000160764'],
        ['role'=>'Koordinator','name'=>'Joana Vania Chandra',       'nim'=>'00000116180'],
        ['role'=>'Anggota',   'name'=>'Vincent Lyn',               'nim'=>'00000138582'],
        ['role'=>'Anggota',   'name'=>'Patricia Thenda',           'nim'=>'00000133015'],
        ['role'=>'Anggota',   'name'=>'Farrel Miko Perkasa',       'nim'=>'00000137707'],
        ['role'=>'Anggota',   'name'=>'Dicky Darma',               'nim'=>'00000138591'],
        ['role'=>'Anggota',   'name'=>'Carlos Limanto',            'nim'=>'00000137316'],
        ['role'=>'Anggota',   'name'=>'Calvin Fernando',           'nim'=>'00000138583'],
        ['role'=>'Anggota',   'name'=>'Wibisana Theomen Kasriady', 'nim'=>'00000119106'],
      ]],
      ['name'=>'Quill','label'=>'Divisi Registrasi','folder'=>'Quill','members'=>[
        ['role'=>'Koordinator','name'=>'Alycia Losis An',         'nim'=>'00000106148'],
        ['role'=>'Koordinator','name'=>'Mellyne Hanessa Lo',       'nim'=>'00000140103'],
        ['role'=>'Anggota',   'name'=>'Stephanie Clarie Handoko','nim'=>'00000116232'],
        ['role'=>'Anggota',   'name'=>'Angeline Prawira',         'nim'=>'00000135429'],
        ['role'=>'Anggota',   'name'=>'Jesselyn',                 'nim'=>'00000159736'],
        ['role'=>'Anggota',   'name'=>'Anastasia Soewondo',       'nim'=>'00000135163'],
        ['role'=>'Anggota',   'name'=>'Naomi Wijaya',             'nim'=>'00000135407'],
      ]],
      ['name'=>'Echo','label'=>'Media Partner & PR','folder'=>'Echo','members'=>[
        ['role'=>'Koordinator','name'=>'Keisya Kaira',            'nim'=>'00000154857'],
        ['role'=>'Koordinator','name'=>'Jocelyn Gabrielle',       'nim'=>'00000132719'],
        ['role'=>'Anggota',   'name'=>'Jessica Claudia Chen',    'nim'=>'00000139847'],
        ['role'=>'Anggota',   'name'=>'Tirza Tan',               'nim'=>'00000136424'],
        ['role'=>'Anggota',   'name'=>'Jessica Angelina Salim',  'nim'=>'00000137083'],
        ['role'=>'Anggota',   'name'=>'Kirana Haifa Kesuma',     'nim'=>'00000157018'],
        ['role'=>'Anggota',   'name'=>'Dasha Geanni',            'nim'=>'00000165127'],
        ['role'=>'Anggota',   'name'=>'Reysi Sabhrina',          'nim'=>'00000157418'],
        ['role'=>'Anggota',   'name'=>'Cantika Bunga Maharani',  'nim'=>'00000163883'],
        ['role'=>'Anggota',   'name'=>'Viviana Erika Fransiska', 'nim'=>'00000138677'],
      ]],
      ['name'=>'Oracle','label'=>'Divisi Akademik','folder'=>'Oracle','members'=>[
        ['role'=>'Koordinator','name'=>'Kevin Sakia Putra',        'nim'=>'00000115491'],
        ['role'=>'Koordinator','name'=>'Audrey Imanuella Wijaya',  'nim'=>'00000142802'],
        ['role'=>'Anggota',   'name'=>'Alfonsus Ronaldy Hidayat', 'nim'=>'00000112181'],
        ['role'=>'Anggota',   'name'=>'Ethandis Keizia',          'nim'=>'00000140809'],
        ['role'=>'Anggota',   'name'=>'Jeslyn Mercya Kandowangko','nim'=>'00000145500'],
        ['role'=>'Anggota',   'name'=>'Arya Pannadana',           'nim'=>'00000107859'],
      ]],
      ['name'=>'Colosseum','label'=>'Non Akademik','folder'=>'Colosseum','members'=>[
        ['role'=>'Koordinator','name'=>'Richard Kane Kristanto',     'nim'=>'00000132763'],
        ['role'=>'Koordinator','name'=>'Jonathan Sandjaja',          'nim'=>'00000139091'],
        ['role'=>'Anggota',   'name'=>'Thaddeus Ananda Halim',      'nim'=>'00000136533'],
        ['role'=>'Anggota',   'name'=>'Grady Nathanael',            'nim'=>'00000153156'],
        ['role'=>'Anggota',   'name'=>'Excel Arkananta Gea',        'nim'=>'00000133805'],
        ['role'=>'Anggota',   'name'=>'Febrian David Gerson Werung','nim'=>'00000147503'],
        ['role'=>'Anggota',   'name'=>'Lucky Chandra',              'nim'=>'00000138779'],
        ['role'=>'Anggota',   'name'=>'Joshua Neilsen Subrata',     'nim'=>'00000140767'],
      ]],
      ['name'=>'Pensieve','label'=>'Divisi Dokumentasi','folder'=>'Pensieve','members'=>[
        ['role'=>'Koordinator','name'=>'Nasya Nauli Siregar',        'nim'=>'00000144474'],
        ['role'=>'Koordinator','name'=>'Rangga Putra',               'nim'=>'00000134529'],
        ['role'=>'Anggota',   'name'=>'Faustinus Hulbert Nathanael','nim'=>'00000133094'],
        ['role'=>'Anggota',   'name'=>'Melisa Chiufin',             'nim'=>'00000108935'],
        ['role'=>'Anggota',   'name'=>'Zaidan Aufa Pramono',        'nim'=>'00000125415'],
      ]],
    ];
    $sovereign   = $divisi[0];
    $otherDivisi = array_slice($divisi,1);
    @endphp

    {{-- SOVEREIGN CARD --}}
    <div class="sovereign-card fi" onclick="openModal(0)">
      <img src="{{ asset('assets/leaves.png') }}"       class="s-deco-leaves" alt="">
      <img src="{{ asset('mascot/mascot-side.png') }}"  class="s-deco-mascot" alt="">
      <div class="s-inner">
        <img src="{{ asset('logo Divisi/Sovereign.png') }}" class="s-logo" alt="Sovereign"
             onerror="this.style.opacity='.3'">
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

    {{-- DIVIDER --}}
    <div class="sec-div fi" style="transition-delay:.08s">
      <div class="sd-line"></div>
      <span>✦ Divisi Panitia ✦</span>
      <div class="sd-line"></div>
    </div>

    {{-- 11 DIVISI GRID --}}
    <div class="divisi-grid">
      @foreach($otherDivisi as $i => $d)
      <div class="div-card fi" style="transition-delay:{{ ($i * 0.04) + 0.1 }}s" onclick="openModal({{ $i + 1 }})">
        <img src="{{ asset('logo Divisi/' . $d['name'] . '.png') }}"
             class="div-logo" alt="{{ $d['name'] }}"
             onerror="this.style.opacity='.2'">
        <div>
          <p class="div-name">{{ $d['name'] }}</p>
          <p class="div-label">{{ $d['label'] }}</p>
        </div>
        <span class="div-hint">✦ klik detail</span>
      </div>
      @endforeach
    </div>

    {{-- QUOTE --}}
    <div class="qt fi" style="transition-delay:.55s">
      <div class="qt-inner">
        <img src="{{ asset('assets/stars.png') }}" alt="">
        <span>"Unleash Your Magic, Forge the Future"</span>
        <img src="{{ asset('assets/stars.png') }}" alt="">
      </div>
    </div>

  </div>{{-- /page --}}
</div>{{-- /tw --}}

<script>
const DIVISI = @json($divisi);
let curSlide = 0;
const TOTAL  = 3;

/* PROGRESS */
const bar = document.getElementById('progress-bar');
window.addEventListener('scroll', () => {
  bar.style.width = Math.min(window.scrollY / (document.body.scrollHeight - window.innerHeight) * 100, 100) + '%';
});

/* CURSOR */
const dot = document.getElementById('cursor-dot');
let spT = 0;
document.addEventListener('mousemove', e => {
  dot.style.left = e.clientX + 'px';
  dot.style.top  = e.clientY + 'px';
  if (Date.now() - spT > 42) { spT = Date.now(); spawnSpark(e.clientX, e.clientY); }
});
function spawnSpark(x, y) {
  const s = document.createElement('div');
  s.className = 'spark';
  const sz = Math.random() * 5 + 2, dx = (Math.random() - .5) * 32, dy = (Math.random() - .5) * 32;
  const c = ['#f5d78e','#c8860a','#fff8ee','#f0c060'];
  s.style.cssText = `left:${x}px;top:${y}px;width:${sz}px;height:${sz}px;background:${c[Math.random()*c.length|0]};--dx:${dx}px;--dy:${dy}px;`;
  document.body.appendChild(s);
  setTimeout(() => s.remove(), 600);
}

/* STARS CANVAS */
(function () {
  const c = document.getElementById('sc'); if (!c) return;
  const x = c.getContext('2d'); let s = [];
  function rsz() { c.width = window.innerWidth; c.height = document.body.scrollHeight; }
  function init() {
    rsz();
    s = Array.from({ length: 80 }, () => ({
      px: Math.random() * c.width, py: Math.random() * c.height,
      r: Math.random() * 1 + .2, sp: Math.random() * .006 + .003, ph: Math.random() * Math.PI * 2
    }));
  }
  function draw(t) {
    x.clearRect(0, 0, c.width, c.height);
    s.forEach(p => {
      const a = .2 + .8 * (.5 + .5 * Math.sin(t * p.sp * 1000 + p.ph));
      x.beginPath(); x.arc(p.px, p.py, p.r, 0, Math.PI * 2);
      x.fillStyle = `rgba(245,215,142,${a})`; x.fill();
    });
    requestAnimationFrame(draw);
  }
  init(); window.addEventListener('resize', init); requestAnimationFrame(draw);
})();

/* PARALLAX */
const decos = document.querySelectorAll('.deco[data-depth]');
document.addEventListener('mousemove', e => {
  const cx = window.innerWidth / 2, cy = window.innerHeight / 2;
  const dx = e.clientX - cx, dy = e.clientY - cy;
  decos.forEach(d => {
    const dep = parseFloat(d.dataset.depth), ox = dx * dep, oy = dy * dep;
    d.style.transform = d.classList.contains('d-wand')
      ? `rotate(30deg) translate(${ox}px,${oy}px)`
      : `translate(${ox}px,${oy}px)`;
  });
});

/* CARD TILT */
document.querySelectorAll('.sovereign-card,.div-card').forEach(card => {
  let bt = null, si = null;
  card.addEventListener('mousemove', e => {
    const r  = card.getBoundingClientRect();
    const rx = ((e.clientY - (r.top  + r.height / 2)) / (r.height / 2)) * -6;
    const ry = ((e.clientX - (r.left + r.width  / 2)) / (r.width  / 2)) *  6;
    card.style.transform  = `perspective(600px) rotateX(${rx}deg) rotateY(${ry}deg) translateZ(4px)`;
    card.style.transition = 'transform .05s,border-color .3s,box-shadow .3s';
    clearTimeout(bt); clearInterval(si);
    card.classList.remove('breathing');
    bt = setTimeout(() => {
      card.classList.add('breathing');
      spawnCardSpark(card);
      si = setInterval(() => spawnCardSpark(card), 900);
    }, 1200);
  });
  card.addEventListener('mouseleave', () => {
    card.classList.remove('breathing');
    clearTimeout(bt); clearInterval(si);
    card.style.transition = 'transform .4s ease,border-color .3s,box-shadow .3s';
    card.style.transform  = '';
    setTimeout(() => card.style.transition = '', 400);
  });
});

/* CARD INTERNAL SPARK */
function spawnCardSpark(card) {
  const r = card.getBoundingClientRect();
  for (let i = 0; i < 5; i++) {
    const s = document.createElement('div');
    s.style.cssText = `position:absolute;pointer-events:none;border-radius:50%;z-index:10;`
      + `left:${Math.random() * r.width}px;top:${Math.random() * r.height}px;`
      + `width:${Math.random() * 4 + 2}px;height:${Math.random() * 4 + 2}px;`
      + `background:${['#f5d78e','#c8860a','#fdf0c0'][Math.random() * 3 | 0]};`
      + `--cdx:${(Math.random() - .5) * 40}px;--cdy:${(Math.random() - .5) * 40}px;`
      + `animation:cspark .8s ease-out forwards;`;
    card.appendChild(s);
    setTimeout(() => s.remove(), 800);
  }
}

/* MODAL */
function openModal(idx) {
  const d = DIVISI[idx]; curSlide = 0;
  document.getElementById('m-logo').src = '/logo%20Divisi/' + encodeURIComponent(d.name) + '.png';
  document.getElementById('m-name').textContent  = d.name;
  document.getElementById('m-label').textContent = d.label;

  const track = document.getElementById('slider-track');
  track.innerHTML = '';
  for (let i = 1; i <= TOTAL; i++) {
    const img = document.createElement('img');
    img.src = '/foto%20divisi/' + encodeURIComponent(d.folder) + '/' + encodeURIComponent(d.name + ' (' + i + ')') + '.JPG';
    img.alt = d.name + ' ' + i;
    img.style.cssText = 'min-width:100%;height:100%;object-fit:cover;';
    img.onerror = function () { this.style.background = 'rgba(20,10,0,.8)'; this.style.display = 'block'; };
    track.appendChild(img);
  }

  const dots = document.getElementById('slider-dots');
  dots.innerHTML = '';
  for (let i = 0; i < TOTAL; i++) {
    const dot = document.createElement('div');
    dot.id = 'sdot-' + i;
    dot.className = 'sdot' + (i === 0 ? ' active' : '');
    dots.appendChild(dot);
  }
  updateSlider();

  const mb = document.getElementById('m-members'); mb.innerHTML = '';
  const leads = d.members.filter(m => ['Koordinator','Ketua','Wakil Ketua','Sekretaris','Bendahara','Supervisi'].includes(m.role));
  const angg  = d.members.filter(m => m.role === 'Anggota');
  if (leads.length) { mb.appendChild(mkLabel('Pimpinan', 'gold')); leads.forEach(m => mb.appendChild(mkRow(m, true))); }
  if (angg.length)  { mb.appendChild(mkLabel('Anggota',  'dim'));  angg.forEach(m  => mb.appendChild(mkRow(m, false))); }

  document.getElementById('modal-overlay').classList.add('open');
  document.body.style.overflow = 'hidden';
}

function mkLabel(txt, cls) {
  const p = document.createElement('p');
  p.className = 'member-section-label ' + cls;
  p.textContent = txt; return p;
}
function mkRow(m, isLead) {
  const d = document.createElement('div');
  d.className = 'member-row ' + (isLead ? 'lead' : 'reg');
  d.innerHTML = `<div><p class="mr-name">${m.name}</p><p class="mr-role">${m.role}</p></div><p class="mr-nim">${m.nim}</p>`;
  return d;
}

function slide(dir) { curSlide = (curSlide + dir + TOTAL) % TOTAL; updateSlider(); }
function updateSlider() {
  document.getElementById('slider-track').style.transform = `translateX(-${curSlide * 100}%)`;
  for (let i = 0; i < TOTAL; i++) {
    const d = document.getElementById('sdot-' + i); if (!d) continue;
    d.className = 'sdot' + (i === curSlide ? ' active' : '');
  }
}

document.getElementById('modal-close').addEventListener('click', closeModal);
document.getElementById('modal-overlay').addEventListener('click', function (e) { if (e.target === this) closeModal(); });
document.addEventListener('keydown', e => {
  if (e.key === 'Escape')     closeModal();
  if (e.key === 'ArrowLeft')  slide(-1);
  if (e.key === 'ArrowRight') slide(1);
});
function closeModal() {
  document.getElementById('modal-overlay').classList.remove('open');
  document.body.style.overflow = '';
}

/* FADE IN — pakai requestAnimationFrame agar layout sudah stabil */
requestAnimationFrame(() => {
  const els = document.querySelectorAll('.fi');
  const io  = new IntersectionObserver(entries => {
    entries.forEach(e => {
      if (e.isIntersecting) { e.target.classList.add('vis'); io.unobserve(e.target); }
    });
  }, { threshold: 0.06 });
  els.forEach(e => io.observe(e));
});
</script>

</x-layout.app>