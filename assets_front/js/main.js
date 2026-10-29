/* ============================================================
   ALIEN CODE — main.js
   ============================================================ */
(function () {
  'use strict';

  /* ── Loader ───────────────────────────────────────────── */
  const loader = document.getElementById('loader');
  const fill   = document.getElementById('loaderFill');
  let pct = 0;
  const loaderTimer = setInterval(() => {
    pct += Math.random() * 15 + 6;
    if (pct >= 100) {
      pct = 100;
      clearInterval(loaderTimer);
      if (fill) fill.style.width = '100%';
      setTimeout(() => loader && loader.classList.add('done'), 380);
      return;
    }
    if (fill) fill.style.width = pct + '%';
  }, 75);

  /* ── Custom cursor ────────────────────────────────────── */
  const cur  = document.getElementById('cursor');
  const ring = document.getElementById('cursor-ring');
  let mx = -200, my = -200, rx = -200, ry = -200;

  document.addEventListener('mousemove', e => { mx = e.clientX; my = e.clientY; });
  document.addEventListener('mouseleave', () => {
    if (cur) cur.style.opacity = '0';
    if (ring) ring.style.opacity = '0';
  });
  document.addEventListener('mouseenter', () => {
    if (cur) cur.style.opacity = '';
    if (ring) ring.style.opacity = '';
  });

  (function tickCursor() {
    if (cur)  { cur.style.left  = mx + 'px'; cur.style.top  = my + 'px'; }
    rx += (mx - rx) * 0.11;
    ry += (my - ry) * 0.11;
    if (ring) { ring.style.left = rx + 'px'; ring.style.top = ry + 'px'; }
    requestAnimationFrame(tickCursor);
  })();

  document.querySelectorAll('a,button,.svc-hex,.wcard,.tc,.branch,.career-card').forEach(el => {
    el.addEventListener('mouseenter', () => document.body.classList.add('cursor-hover'));
    el.addEventListener('mouseleave', () => document.body.classList.remove('cursor-hover'));
  });

  /* ── Navbar scroll ────────────────────────────────────── */
  const nav = document.getElementById('mainNav');
  function checkScroll() { nav && nav.classList.toggle('scrolled', window.scrollY > 50); }
  window.addEventListener('scroll', checkScroll, { passive: true });
  checkScroll();

  /* ── Float-up observer ────────────────────────────────── */
  const fuObs = new IntersectionObserver(entries => {
    entries.forEach(e => {
      if (e.isIntersecting) { e.target.classList.add('visible'); fuObs.unobserve(e.target); }
    });
  }, { threshold: 0.1, rootMargin: '0px 0px -30px 0px' });
  document.querySelectorAll('.fu').forEach(el => fuObs.observe(el));

  /* ── Counter animation ────────────────────────────────── */
  function runCounter(el) {
    const target = parseInt(el.dataset.target, 10);
    if (!target) return;
    let current = 0;
    const step = Math.ceil(target / 60);
    const t = setInterval(() => {
      current = Math.min(current + step, target);
      el.textContent = current;
      if (current >= target) {
        el.textContent = target + '+';
        clearInterval(t);
      }
    }, 22);
  }
  const cntObs = new IntersectionObserver(entries => {
    entries.forEach(e => {
      if (e.isIntersecting) { runCounter(e.target); cntObs.unobserve(e.target); }
    });
  }, { threshold: 0.6 });
  document.querySelectorAll('.cnt').forEach(el => cntObs.observe(el));

  /* ── Skill bars ───────────────────────────────────────── */
  const skillObs = new IntersectionObserver(entries => {
    entries.forEach(e => {
      if (e.isIntersecting) { e.target.classList.add('animated'); skillObs.unobserve(e.target); }
    });
  }, { threshold: 0.4 });
  document.querySelectorAll('.skill-fill').forEach(el => skillObs.observe(el));

  /* ── Matrix canvas ────────────────────────────────────── */
  const mc = document.getElementById('matrix-canvas');
  if (mc) {
    const ctx = mc.getContext('2d');
    const chars = 'アイウエオ01ALIENCODE><{}[]()#$%';
    let cols, drops;
    function resizeMC() {
      mc.width  = window.innerWidth;
      mc.height = window.innerHeight;
      cols  = Math.floor(mc.width / 18);
      drops = Array.from({ length: cols }, () => Math.random() * (mc.height / 18));
    }
    resizeMC();
    window.addEventListener('resize', resizeMC, { passive: true });
    setInterval(() => {
      ctx.fillStyle = 'rgba(5,3,16,0.055)';
      ctx.fillRect(0, 0, mc.width, mc.height);
      ctx.fillStyle = '#f5a800';
      ctx.font = '13px "Share Tech Mono", monospace';
      drops.forEach((y, i) => {
        ctx.fillText(chars[Math.floor(Math.random() * chars.length)], i * 18, y * 18);
        if (y * 18 > mc.height && Math.random() > 0.975) drops[i] = 0;
        drops[i] += 0.45;
      });
    }, 55);
  }

  /* ── Portfolio canvas fallback ────────────────────────── */
  document.querySelectorAll('.portfolio-canvas').forEach(canvas => {
    const c   = canvas.getContext('2d');
    const idx = +canvas.dataset.index;
    const palette = ['#f5a800', '#00d4ff', '#7c3aed', '#ff6b6b', '#4ade80', '#fb923c'];
    const col = palette[idx % palette.length];
    const W = canvas.width, H = canvas.height;
    let t = idx * 1.2;
    (function draw() {
      requestAnimationFrame(draw);
      c.fillStyle = '#0d0824';
      c.fillRect(0, 0, W, H);
      for (let i = 0; i < 3; i++) {
        c.strokeStyle = col + (i === 0 ? 'ff' : i === 1 ? '99' : '44');
        c.lineWidth = 1.2 - i * 0.3;
        c.beginPath();
        for (let x = 0; x <= W; x += 3) {
          const y = H / 2 + Math.sin((x / W) * Math.PI * 4 + t + i * 1.2) * (18 + i * 8);
          x === 0 ? c.moveTo(x, y) : c.lineTo(x, y);
        }
        c.stroke();
      }
      t += 0.025;
    })();
  });

  /* ── Career apply ─────────────────────────────────────── */
  window.careerApply = function (title) {
    const sel = document.getElementById('careerPositionSelect');
    if (sel) {
      for (const opt of sel.options) {
        if (opt.value === title) { opt.selected = true; break; }
      }
    }
    const wrap = document.getElementById('careerFormWrap');
    if (wrap) {
      wrap.scrollIntoView({ behavior: 'smooth', block: 'center' });
      wrap.style.transition = 'box-shadow .4s';
      wrap.style.boxShadow = '0 0 0 2px var(--gold)';
      setTimeout(() => { wrap.style.boxShadow = ''; }, 1600);
    }
  };

  /* ── Resume file label ────────────────────────────────── */
  window.updateResumeLabel = function (input) {
    const lbl = document.getElementById('resumeLabel');
    if (lbl && input.files[0]) {
      const f = input.files[0];
      lbl.innerHTML = '<strong>' + f.name + '</strong><br><span>' +
        (f.size / 1024 / 1024).toFixed(2) + ' MB</span>';
    }
  };

  /* ── Game ─────────────────────────────────────────────── */
  const gc = document.getElementById('gameCanvas');
  if (gc) {
    const gx      = gc.getContext('2d');
    const overlay = document.getElementById('gameOverlay');
    const startBtn = document.getElementById('gameStartBtn');
    const scoreEl  = document.getElementById('scoreDisplay');
    const livesEl  = document.getElementById('livesDisplay');
    const levelEl  = document.getElementById('levelDisplay');
    const gsoTitle = document.getElementById('gsoTitle');
    const gsoSub   = document.getElementById('gsoSub');
    const GW = gc.width, GH = gc.height;

    let running = false, score = 0, lives = 3, level = 1;
    let ship = { x: GW / 2, y: GH - 55, w: 32, h: 32 };
    let bullets = [], enemies = [], particles = [];
    let keys = {}, enemyDir = 1, lastShot = 0, eMoveTimer = 0;
    let stars = Array.from({ length: 70 }, () => ({
      x: Math.random() * GW, y: Math.random() * GH,
      r: Math.random() * 1.4 + .3, p: Math.random() * Math.PI * 2
    }));
    let hs = JSON.parse(localStorage.getItem('acHS') || '[0,0,0]');

    function updateHSDisplay() {
      const s = [...hs].sort((a, b) => b - a);
      ['hs1', 'hs2', 'hs3'].forEach((id, i) => {
        const el = document.getElementById(id);
        if (el) el.textContent = s[i] || 0;
      });
    }
    updateHSDisplay();

    function spawnWave() {
      enemies = [];
      for (let r = 0; r < 3; r++) {
        for (let c = 0; c < 8; c++) {
          enemies.push({ x: 55 + c * 74, y: 38 + r * 48, alive: true, type: r });
        }
      }
      enemyDir = 1;
    }

    function hud() {
      if (scoreEl) scoreEl.textContent = score;
      if (livesEl) livesEl.textContent = '❤️'.repeat(Math.max(0, lives));
      if (levelEl) levelEl.textContent = level;
    }

    function shoot() {
      const now = Date.now();
      if (now - lastShot < 260) return;
      lastShot = now;
      bullets.push({ x: ship.x, y: ship.y - 10, vy: -11, own: true });
    }

    function burst(x, y, col) {
      for (let i = 0; i < 9; i++) {
        const a = Math.random() * Math.PI * 2, sp = Math.random() * 3 + 1;
        particles.push({ x, y, vx: Math.cos(a) * sp, vy: Math.sin(a) * sp, life: 1, col });
      }
    }

    const eCols = ['#ff6b6b', '#fb923c', '#f5a800'];

    function gameLoop() {
      if (!running) return;
      requestAnimationFrame(gameLoop);

      gx.fillStyle = '#050310';
      gx.fillRect(0, 0, GW, GH);

      // stars
      stars.forEach(s => {
        s.p += 0.006;
        const a = 0.15 + Math.abs(Math.sin(s.p)) * 0.45;
        gx.fillStyle = `rgba(255,255,255,${a})`;
        gx.beginPath(); gx.arc(s.x, s.y, s.r, 0, Math.PI * 2); gx.fill();
      });

      // ship movement
      if (keys['ArrowLeft'] || keys['a'] || keys['A']) ship.x = Math.max(16, ship.x - 5);
      if (keys['ArrowRight'] || keys['d'] || keys['D']) ship.x = Math.min(GW - 16, ship.x + 5);
      if (keys[' '] || keys['Space']) shoot();

      // draw ship
      gx.fillStyle = '#f5a800';
      gx.shadowColor = '#f5a800'; gx.shadowBlur = 14;
      gx.beginPath();
      gx.moveTo(ship.x, ship.y - 17);
      gx.lineTo(ship.x - 13, ship.y + 13);
      gx.lineTo(ship.x + 13, ship.y + 13);
      gx.closePath(); gx.fill();
      gx.shadowBlur = 0;

      // bullets
      bullets = bullets.filter(b => b.y > -8 && b.y < GH + 8);
      bullets.forEach(b => {
        b.y += b.vy;
        gx.fillStyle = b.own ? '#00d4ff' : '#ff4444';
        gx.shadowColor = b.own ? '#00d4ff' : '#ff4444'; gx.shadowBlur = 8;
        gx.fillRect(b.x - 2, b.y - 7, 4, 14);
        gx.shadowBlur = 0;
      });

      // enemy movement
      eMoveTimer++;
      const interval = Math.max(8, 28 - level * 2);
      if (eMoveTimer >= interval) {
        eMoveTimer = 0;
        const alive = enemies.filter(e => e.alive);
        if (!alive.length) return;
        const maxX = Math.max(...alive.map(e => e.x));
        const minX = Math.min(...alive.map(e => e.x));
        if (maxX > GW - 36 || minX < 36) {
          enemyDir *= -1;
          enemies.forEach(e => { if (e.alive) e.y += 14; });
        } else {
          enemies.forEach(e => { if (e.alive) e.x += enemyDir * 11; });
        }
      }

      // draw enemies
      enemies.forEach(e => {
        if (!e.alive) return;
        if (e.y > GH - 36) { lives--; hud(); if (lives <= 0) endGame(); return; }
        gx.fillStyle = eCols[e.type];
        gx.shadowColor = eCols[e.type]; gx.shadowBlur = 7;
        gx.beginPath(); gx.ellipse(e.x, e.y, 11, 7, 0, 0, Math.PI * 2); gx.fill();
        gx.fillRect(e.x - 4, e.y - 13, 3, 9);
        gx.fillRect(e.x + 1, e.y - 13, 3, 9);
        gx.shadowBlur = 0;
      });

      // enemy shooting
      if (Math.random() < 0.012 * level) {
        const alive = enemies.filter(e => e.alive);
        if (alive.length) {
          const sh = alive[Math.floor(Math.random() * alive.length)];
          bullets.push({ x: sh.x, y: sh.y + 9, vy: 3.5 + level * .5, own: false });
        }
      }

      // collision: player bullets vs enemies
      bullets.forEach(b => {
        if (!b.own) return;
        enemies.forEach(e => {
          if (!e.alive) return;
          if (Math.abs(b.x - e.x) < 14 && Math.abs(b.y - e.y) < 14) {
            e.alive = false; b.y = -999;
            score += 10 * level; hud();
            burst(e.x, e.y, eCols[e.type]);
          }
        });
      });

      // collision: enemy bullets vs ship
      bullets.forEach(b => {
        if (b.own) return;
        if (Math.abs(b.x - ship.x) < 15 && Math.abs(b.y - ship.y) < 18) {
          lives--; b.y = 9999; burst(ship.x, ship.y, '#f5a800'); hud();
          if (lives <= 0) endGame();
        }
      });

      // particles
      particles = particles.filter(p => p.life > 0);
      particles.forEach(p => {
        p.x += p.vx; p.y += p.vy; p.life -= 0.045;
        const hex = Math.floor(p.life * 255).toString(16).padStart(2, '0');
        gx.fillStyle = p.col + hex;
        gx.beginPath(); gx.arc(p.x, p.y, 3 * p.life, 0, Math.PI * 2); gx.fill();
      });

      // next wave
      if (enemies.every(e => !e.alive)) { level++; spawnWave(); hud(); }
    }

    function endGame() {
      running = false;
      hs.push(score);
      hs = hs.sort((a, b) => b - a).slice(0, 3);
      localStorage.setItem('acHS', JSON.stringify(hs));
      updateHSDisplay();
      if (gsoTitle) gsoTitle.textContent = 'GAME OVER';
      if (gsoSub)   gsoSub.textContent   = 'Score: ' + score;
      if (startBtn) startBtn.textContent  = '▶ PLAY AGAIN';
      if (overlay)  overlay.style.display = 'flex';
    }

    function startGame() {
      score = 0; lives = 3; level = 1;
      bullets = []; particles = []; ship.x = GW / 2;
      spawnWave(); hud();
      if (overlay) overlay.style.display = 'none';
      running = true;
      requestAnimationFrame(gameLoop);
    }

    if (startBtn) startBtn.addEventListener('click', startGame);

    document.addEventListener('keydown', e => {
      keys[e.key] = true;
      const map = { 'ArrowLeft': 'keyA', 'a': 'keyA', 'A': 'keyA', 'ArrowRight': 'keyD', 'd': 'keyD', 'D': 'keyD', ' ': 'keySP', 'Space': 'keySP' };
      const k = document.getElementById(map[e.key]);
      if (k) k.classList.add('active');
    });
    document.addEventListener('keyup', e => {
      keys[e.key] = false;
      const map = { 'ArrowLeft': 'keyA', 'a': 'keyA', 'A': 'keyA', 'ArrowRight': 'keyD', 'd': 'keyD', 'D': 'keyD', ' ': 'keySP', 'Space': 'keySP' };
      const k = document.getElementById(map[e.key]);
      if (k) k.classList.remove('active');
    });

    // mobile buttons
    const mbl = document.getElementById('gmb-left');
    const mbr = document.getElementById('gmb-right');
    const mbf = document.getElementById('gmb-fire');
    if (mbl) {
      mbl.addEventListener('touchstart', () => { keys['ArrowLeft'] = true; }, { passive: true });
      mbl.addEventListener('touchend',   () => { keys['ArrowLeft'] = false; }, { passive: true });
    }
    if (mbr) {
      mbr.addEventListener('touchstart', () => { keys['ArrowRight'] = true; }, { passive: true });
      mbr.addEventListener('touchend',   () => { keys['ArrowRight'] = false; }, { passive: true });
    }
    if (mbf) mbf.addEventListener('touchstart', shoot, { passive: true });

    // touch drag on canvas
    let touchX = 0;
    gc.addEventListener('touchstart', e => { touchX = e.touches[0].clientX; e.preventDefault(); }, { passive: false });
    gc.addEventListener('touchmove', e => {
      const dx = e.touches[0].clientX - touchX;
      ship.x = Math.max(16, Math.min(GW - 16, ship.x + dx * 0.5));
      touchX = e.touches[0].clientX;
      e.preventDefault();
    }, { passive: false });
    gc.addEventListener('touchend', shoot, { passive: true });
  }

})();
