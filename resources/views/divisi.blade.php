<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Divisi — ISFEST 2026</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet" />
  <style>
    body { font-family:'Inter',sans-serif; }
    @keyframes slideUp { from{opacity:0;transform:translateY(30px)} to{opacity:1;transform:translateY(0)} }
    @keyframes float { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-10px)} }
    @keyframes floatR { 0%,100%{transform:translateY(0) scaleX(-1)} 50%{transform:translateY(-8px) scaleX(-1)} }
    .card-divisi { transition: transform .3s, box-shadow .3s; }
    .card-divisi:hover { transform: translateY(-6px) scale(1.03); }
    .content-anim { animation: slideUp .35s ease; }
    .float-anim { animation: float 4s ease-in-out infinite; }
    .float-anim-r { animation: floatR 4s ease-in-out infinite; }
  </style>
</head>
<body class="bg-[#0a101d] text-slate-200 min-h-screen">

@include('navbar')

@php
$divisi = [
  [
    'name'   => 'Sovereign',
    'label'  => 'BPH',
    'folder' => 'Sovereign',
    'members' => [
      ['role'=>'Supervisi',   'name'=>'Alexa Hanna',            'nim'=>'00000114763'],
      ['role'=>'Ketua',       'name'=>'Julius Marselinus',       'nim'=>'00000111989'],
      ['role'=>'Wakil Ketua', 'name'=>'Johanes Anthony',         'nim'=>'00000105528'],
      ['role'=>'Sekretaris',  'name'=>'Angeline',                'nim'=>'00000130604'],
      ['role'=>'Bendahara',   'name'=>'Felicia Jesslyn Gunawan', 'nim'=>'00000137650'],
    ]
  ],
  [
    'name'   => 'Arcane',
    'label'  => 'Divisi Acara',
    'folder' => 'Arcane',
    'members' => [
      ['role'=>'Koordinator','name'=>'Amelia Christina',               'nim'=>'00000135265'],
      ['role'=>'Koordinator','name'=>'Raissa Samantha Iswandi',        'nim'=>'00000136605'],
      ['role'=>'Anggota',   'name'=>'Frizky Yeremia Jerry Rumimpuna', 'nim'=>'00000134630'],
      ['role'=>'Anggota',   'name'=>'Arya Ramadhan',                  'nim'=>'00000140292'],
      ['role'=>'Anggota',   'name'=>'Kevin Lolo',                     'nim'=>'00000145004'],
      ['role'=>'Anggota',   'name'=>'Cecilia Jeannette Wang',         'nim'=>'0000132632'],
      ['role'=>'Anggota',   'name'=>'Eunice Lois F Antonius Ang',     'nim'=>'00000153617'],
    ]
  ],
  [
    'name'   => 'Vanguard',
    'label'  => 'Liaison Officer',
    'folder' => 'Vanguard',
    'members' => [
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
    ]
  ],
  [
    'name'   => 'Aegis',
    'label'  => 'Divisi Keamanan',
    'folder' => 'Aegis',
    'members' => [
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
    ]
  ],
  [
    'name'   => 'Atelier',
    'label'  => 'Perlengkapan & Dekor',
    'folder' => 'Atelier',
    'members' => [
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
    ]
  ],
  [
    'name'   => 'Spectra',
    'label'  => 'Divisi Visual',
    'folder' => 'Spectra',
    'members' => [
      ['role'=>'Koordinator','name'=>'Dhina Novitasari',       'nim'=>'00000144522'],
      ['role'=>'Koordinator','name'=>'Fernando Heryanto',      'nim'=>'00000133959'],
      ['role'=>'Koordinator','name'=>'Michelle Theresa',       'nim'=>'00000115492'],
      ['role'=>'Anggota',   'name'=>'Rama Banu Aditya',       'nim'=>'00000122395'],
      ['role'=>'Anggota',   'name'=>'Ira Tadissya Harahap',   'nim'=>'00000133881'],
      ['role'=>'Anggota',   'name'=>'Jolyn Chou',             'nim'=>'00000144125'],
      ['role'=>'Anggota',   'name'=>'Felicia Alberta Gunawan','nim'=>'00000144758'],
      ['role'=>'Anggota',   'name'=>'Melody Deana Phanata',   'nim'=>'00000144884'],
    ]
  ],
  [
    'name'   => 'Vault',
    'label'  => 'Funding & Sponsor',
    'folder' => 'Vault',
    'members' => [
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
    ]
  ],
  [
    'name'   => 'Quill',
    'label'  => 'Divisi Registrasi',
    'folder' => 'Quill',
    'members' => [
      ['role'=>'Koordinator','name'=>'Alycia Losis An',         'nim'=>'00000106148'],
      ['role'=>'Koordinator','name'=>'Mellyne Hanessa Lo',       'nim'=>'00000140103'],
      ['role'=>'Anggota',   'name'=>'Stephanie Clarie Handoko','nim'=>'00000116232'],
      ['role'=>'Anggota',   'name'=>'Angeline Prawira',         'nim'=>'00000135429'],
      ['role'=>'Anggota',   'name'=>'Jesselyn',                 'nim'=>'00000159736'],
      ['role'=>'Anggota',   'name'=>'Anastasia Soewondo',       'nim'=>'00000135163'],
      ['role'=>'Anggota',   'name'=>'Naomi Wijaya',             'nim'=>'00000135407'],
    ]
  ],
  [
    'name'   => 'Echo',
    'label'  => 'Media Partner & PR',
    'folder' => 'Echo',
    'members' => [
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
    ]
  ],
  [
    'name'   => 'Oracle',
    'label'  => 'Divisi Akademik',
    'folder' => 'Oracle',
    'members' => [
      ['role'=>'Koordinator','name'=>'Kevin Sakia Putra',        'nim'=>'00000115491'],
      ['role'=>'Koordinator','name'=>'Audrey Imanuella Wijaya',  'nim'=>'00000142802'],
      ['role'=>'Anggota',   'name'=>'Alfonsus Ronaldy Hidayat', 'nim'=>'00000112181'],
      ['role'=>'Anggota',   'name'=>'Ethandis Keizia',          'nim'=>'00000140809'],
      ['role'=>'Anggota',   'name'=>'Jeslyn Mercya Kandowangko','nim'=>'00000145500'],
      ['role'=>'Anggota',   'name'=>'Arya Pannadana',           'nim'=>'00000107859'],
    ]
  ],
  [
    'name'   => 'Colosseum',
    'label'  => 'Non Akademik',
    'folder' => 'colloseum',
    'members' => [
      ['role'=>'Koordinator','name'=>'Richard Kane Kristanto',     'nim'=>'00000132763'],
      ['role'=>'Koordinator','name'=>'Jonathan Sandjaja',          'nim'=>'00000139091'],
      ['role'=>'Anggota',   'name'=>'Thaddeus Ananda Halim',      'nim'=>'00000136533'],
      ['role'=>'Anggota',   'name'=>'Grady Nathanael',            'nim'=>'00000153156'],
      ['role'=>'Anggota',   'name'=>'Excel Arkananta Gea',        'nim'=>'00000133805'],
      ['role'=>'Anggota',   'name'=>'Febrian David Gerson Werung','nim'=>'00000147503'],
      ['role'=>'Anggota',   'name'=>'Lucky Chandra',              'nim'=>'00000138779'],
      ['role'=>'Anggota',   'name'=>'Joshua Neilsen Subrata',     'nim'=>'00000140767'],
    ]
  ],
  [
    'name'   => 'Pensieve',
    'label'  => 'Divisi Dokumentasi',
    'folder' => 'Pensieve',
    'members' => [
      ['role'=>'Koordinator','name'=>'Nasya Nauli Siregar',        'nim'=>'00000144474'],
      ['role'=>'Koordinator','name'=>'Rangga Putra',               'nim'=>'00000134529'],
      ['role'=>'Anggota',   'name'=>'Faustinus Hulbert Nathanael','nim'=>'00000133094'],
      ['role'=>'Anggota',   'name'=>'Melisa Chiufin',             'nim'=>'00000108935'],
      ['role'=>'Anggota',   'name'=>'Zaidan Aufa Pramono',        'nim'=>'00000125415'],
    ]
  ],
];

$sovereign   = $divisi[0];
$otherDivisi = array_slice($divisi, 1);
@endphp

{{-- ===== SOVEREIGN SINGLE CARD ===== --}}
<div class="max-w-6xl mx-auto px-6 pt-10">

  <div
    class="card-divisi relative overflow-hidden cursor-pointer rounded-3xl border border-[#ffec1f]/20 bg-gradient-to-br from-[#0e1929] via-[#172236] to-[#1a2a1a] p-8 hover:border-[#ffec1f]/50"
    onclick="openModal(0)"
  >

    {{-- dekor --}}
    <img src="/assets/leaves.png"
      class="absolute left-0 bottom-0 w-40 opacity-15 float-anim pointer-events-none" />

    <img src="/assets/witch-hat.png"
      class="absolute left-8 top-6 w-14 opacity-20 float-anim pointer-events-none" />

    <img src="/mascot/mascot-side.png"
      class="absolute right-0 bottom-0 h-52 opacity-70 float-anim pointer-events-none" />

    <div class="relative z-10">

      <p class="text-xs uppercase tracking-[.3em] text-[#ffec1f]/60 mb-4">
        ISFEST 2026
      </p>

      <div class="flex flex-col md:flex-row md:items-center gap-6">

        <img
          src="/logo%20Divisi/Sovereign.png"
          class="w-28 h-28 object-contain shrink-0"
          style="filter:drop-shadow(0 0 20px rgba(255,236,31,.3));"
        />

        <div class="flex-1">

          <h1 class="text-4xl font-black text-white">
            Sovereign
          </h1>

          <p class="text-[#ffec1f] font-bold uppercase tracking-widest text-sm mt-1">
            Badan Pengurus Harian
          </p>

          <div class="flex flex-wrap gap-3 mt-5">

            @foreach($sovereign['members'] as $m)
            <div class="px-4 py-2 rounded-xl border border-[#ffec1f]/20 bg-[#ffec1f]/5">
              <p class="text-white font-bold text-sm">{{ $m['name'] }}</p>
              <p class="text-[#ffec1f]/60 text-[10px] uppercase tracking-wider">
                {{ $m['role'] }}
              </p>
            </div>
            @endforeach

          </div>

        </div>

        <div class="shrink-0">
          <span class="inline-flex items-center gap-2 px-5 py-2 rounded-full border border-[#ffec1f]/30 text-[#ffec1f] text-xs font-bold uppercase tracking-widest hover:bg-[#ffec1f]/10 transition">
            Lihat Detail ↗
          </span>
        </div>

      </div>
    </div>
  </div>

</div>

{{-- ===== SOVEREIGN HERO SECTION ===== --}}
<div
  class="relative w-full overflow-hidden cursor-pointer"
  style="background:linear-gradient(135deg,#0e1929 0%,#172236 50%,#1a2a1a 100%);min-height:380px;"
  onclick="openModal(0)"
>
  {{-- dekor asset kiri --}}
  <img src="/assets/leaves.png" class="absolute left-0 bottom-0 w-48 opacity-20 float-anim pointer-events-none" />
  <img src="/assets/witch-hat.png" class="absolute left-10 top-8 w-16 opacity-30 float-anim pointer-events-none" style="animation-delay:.5s" />

  {{-- dekor asset kanan --}}
  <img src="/assets/Wand.png" class="absolute right-8 top-10 w-14 opacity-25 float-anim-r pointer-events-none" style="animation-delay:1s" />
  <img src="/mascot/mascot-side.png" class="absolute right-0 bottom-0 h-64 opacity-80 float-anim pointer-events-none" style="animation-delay:.3s" />
  <img src="/assets/magic-clumps.png" class="absolute right-48 top-6 w-20 opacity-20 float-anim pointer-events-none" />

  {{-- glow center --}}
  <div class="absolute inset-0 pointer-events-none" style="background:radial-gradient(ellipse at center,rgba(255,236,31,.06) 0%,transparent 70%);"></div>

  {{-- konten --}}
  <div class="relative z-10 flex flex-col items-center justify-center text-center px-6 py-16">
    <p class="text-xs uppercase tracking-[.3em] text-[#ffec1f]/60 mb-4">ISFEST 2026</p>

    <img
      src="/logo%20Divisi/Sovereign.png"
      class="w-28 h-28 object-contain mb-5 drop-shadow-lg"
      style="filter:drop-shadow(0 0 20px rgba(255,236,31,.3));"
    />

    <h1 class="text-5xl font-black text-white mb-1">Sovereign</h1>
    <p class="text-[#ffec1f] font-bold tracking-widest text-sm uppercase mb-4">Badan Pengurus Harian</p>

    <div class="flex flex-wrap justify-center gap-3 mb-6">
      @foreach($sovereign['members'] as $m)
      <div class="px-4 py-2 rounded-xl border border-[#ffec1f]/20 bg-[#ffec1f]/5 text-center">
        <p class="text-white font-bold text-sm">{{ $m['name'] }}</p>
        <p class="text-[#ffec1f]/60 text-[10px] uppercase tracking-wider">{{ $m['role'] }}</p>
      </div>
      @endforeach
    </div>

    <span class="inline-flex items-center gap-2 px-5 py-2 rounded-full border border-[#ffec1f]/30 text-[#ffec1f] text-xs font-bold uppercase tracking-widest hover:bg-[#ffec1f]/10 transition">
      Lihat Detail ↗
    </span>
  </div>
</div>


{{-- ===== DIVIDER ===== --}}
<div class="max-w-6xl mx-auto px-6 pt-14 pb-4">
  <div class="flex items-center gap-4 mb-10">
    <div class="h-px flex-1 bg-slate-700/50"></div>
    <p class="text-xs uppercase tracking-[.3em] text-slate-500">Divisi Panitia</p>
    <div class="h-px flex-1 bg-slate-700/50"></div>
  </div>

  {{-- ===== GRID 11 DIVISI ===== --}}
  <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-5 pb-16">
    @foreach($otherDivisi as $i => $d)
    <div
      class="card-divisi cursor-pointer rounded-2xl border border-slate-700/40 bg-[#172236]/80 backdrop-blur p-6 flex flex-col items-center gap-3 hover:border-[#ffec1f]/40 hover:bg-[#1e2d47]/90"
      onclick="openModal({{ $i + 1 }})"
    >
      <img
        src="/logo%20Divisi/{{ $d['name'] }}.png"
        alt="{{ $d['name'] }}"
        class="w-20 h-20 object-contain drop-shadow-lg"
        onerror="this.style.opacity='0.3'"
      />
      <div class="text-center">
        <p class="font-black text-white text-base">{{ $d['name'] }}</p>
        <p class="text-[11px] text-slate-400 mt-0.5">{{ $d['label'] }}</p>
      </div>
    </div>
    @endforeach
  </div>
</div>

{{-- ===== MODAL ===== --}}
<div
  id="modal-overlay"
  class="fixed inset-0 z-50 hidden items-center justify-center p-4"
  style="background:rgba(5,10,20,.88);backdrop-filter:blur(10px);"
  onclick="closeModal(event)"
>
  <div
    id="modal-box"
    class="content-anim relative w-full max-w-2xl rounded-3xl border border-slate-700/50 bg-[#0e1929] overflow-hidden"
    style="max-height:90vh;display:flex;flex-direction:column;"
    onclick="event.stopPropagation()"
  >
    <button
      onclick="closeModalDirect()"
      class="absolute top-4 right-4 z-20 w-8 h-8 rounded-full bg-black/60 text-slate-300 hover:bg-black/80 text-lg flex items-center justify-center"
    >✕</button>

    <div class="relative w-full shrink-0 overflow-hidden" style="height:300px;">
      <div id="slider-track" class="flex h-full" style="transition:transform .5s ease;"></div>
      <button onclick="slide(-1)" class="absolute left-3 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-black/50 text-white text-2xl flex items-center justify-center hover:bg-black/80 z-10">‹</button>
      <button onclick="slide(1)"  class="absolute right-3 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-black/50 text-white text-2xl flex items-center justify-center hover:bg-black/80 z-10">›</button>
      <div id="slider-dots" class="absolute bottom-3 left-1/2 -translate-x-1/2 flex gap-2 z-10"></div>
    </div>

    <div class="overflow-y-auto p-6" style="flex:1;">
      <div class="flex items-center gap-4 mb-6">
        <img id="modal-logo" src="" class="w-16 h-16 object-contain shrink-0" />
        <div>
          <h2 id="modal-name" class="text-2xl font-black text-white"></h2>
          <p id="modal-label" class="text-sm mt-0.5" style="color:#ffec1f;opacity:.8;"></p>
        </div>
      </div>
      <div id="modal-members" class="space-y-2"></div>
    </div>
  </div>
</div>

<script>
const divisiData = @json($divisi);
let currentSlide = 0;
const totalSlides = 3;

function openModal(index) {
  const d = divisiData[index];
  currentSlide = 0;

  document.getElementById('modal-logo').src        = '/logo%20Divisi/' + d.name + '.png';
  document.getElementById('modal-name').textContent  = d.name;
  document.getElementById('modal-label').textContent = d.label;

  const track = document.getElementById('slider-track');
  track.innerHTML = '';
  for (let i = 1; i <= totalSlides; i++) {
    const img = document.createElement('img');
    img.src = '/foto%20divisi/' + encodeURIComponent(d.folder) + '/' + encodeURIComponent(d.name + ' (' + i + ')') + '.JPG';
    img.alt = d.name + ' foto ' + i;
    img.style.cssText = 'min-width:100%;height:100%;object-fit:cover;';
    track.appendChild(img);
  }
  updateSlider();

  const dots = document.getElementById('slider-dots');
  dots.innerHTML = '';
  for (let i = 0; i < totalSlides; i++) {
    const dot = document.createElement('div');
    dot.id = 'dot-' + i;
    dot.style.cssText = 'height:8px;border-radius:999px;transition:all .3s;background:' + (i === 0 ? '#ffec1f' : 'rgba(255,255,255,.35)') + ';width:' + (i === 0 ? '20px' : '8px') + ';';
    dots.appendChild(dot);
  }

  const memberDiv = document.getElementById('modal-members');
  memberDiv.innerHTML = '';

  const pimpinan = d.members.filter(m =>
    ['Koordinator','Ketua','Wakil Ketua','Sekretaris','Bendahara','Supervisi'].includes(m.role)
  );
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

function closeModal(e) {
  if (e.target === document.getElementById('modal-overlay')) closeModalDirect();
}

function closeModalDirect() {
  const overlay = document.getElementById('modal-overlay');
  overlay.style.display = 'none';
  overlay.classList.add('hidden');
  document.body.style.overflow = '';
}

document.addEventListener('keydown', e => {
  if (e.key === 'Escape')     closeModalDirect();
  if (e.key === 'ArrowLeft')  slide(-1);
  if (e.key === 'ArrowRight') slide(1);
});
</script>

</body>
</html>


