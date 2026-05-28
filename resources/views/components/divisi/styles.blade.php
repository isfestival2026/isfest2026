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