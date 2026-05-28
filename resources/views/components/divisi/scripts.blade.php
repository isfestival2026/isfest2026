@props(['divisi'])

<script>
    // Membawa data PHP ke JavaScript
    const DIVISI = @json($divisi);
    let curSlide = 0;
    const TOTAL  = 3;

    /* PROGRESS BAR */
    const bar = document.getElementById('progress-bar');
    window.addEventListener('scroll', () => {
        bar.style.width = Math.min(window.scrollY / (document.body.scrollHeight - window.innerHeight) * 100, 100) + '%';
    });

    /* CURSOR SPARKS */
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

    /* CARD TILT & BREATHING ANIMATION */
    document.querySelectorAll('.sovereign-card,.div-card').forEach(card => {
        let bt = null, si = null;
        card.addEventListener('mousemove', e => {
            const r  = card.getBoundingClientRect();
            const rx = ((e.clientY - (r.top  + r.height / 2)) / (r.height / 2)) * -6;
            const ry = ((e.clientX - (r.left + r.width  / 2)) / (r.width  / 2)) * 6;
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

    /* MODAL LOGIC */
    function openModal(idx) {
        const d = DIVISI[idx]; curSlide = 0;
        
        // MENGGUNAKAN URL BACKBLAZE DARI PHP YANG SUDAH DISUNTIKKAN KE JSON
        document.getElementById('m-logo').src = d.modal_logo;
        
        document.getElementById('m-name').textContent  = d.name;
        document.getElementById('m-label').textContent = d.label;

        const track = document.getElementById('slider-track');
        track.innerHTML = '';
        
        // Looping menggunakan array URL yang sudah disiapkan PHP
        d.slider_photos.forEach((photoUrl, index) => {
            const img = document.createElement('img');
            img.src = photoUrl; // Langsung pakai URL dari Backblaze/Fallback
            img.alt = d.name + ' ' + (index + 1);
            img.style.cssText = 'min-width:100%;height:100%;object-fit:cover;';
            img.onerror = function () { 
                this.style.background = 'rgba(20,10,0,.8)'; 
                this.style.display = 'block'; 
            };
            track.appendChild(img);
    });

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

    /* FADE IN SCROLL OBSERVATION */
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