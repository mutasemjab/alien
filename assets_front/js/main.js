/* ============================================================
   Alien Code — main.js
   All canvas/element inits are null-guarded so the file works
   on every page even if a section is absent.
   ============================================================ */

// ============================================================
// CUSTOM CURSOR
// ============================================================
const cur  = document.getElementById('cursor');
const curR = document.getElementById('cursor-ring');

if (cur && curR) {
  let mx = 0, my = 0, rx = 0, ry = 0;

  document.addEventListener('mousemove', e => {
    mx = e.clientX; my = e.clientY;
    cur.style.left = mx + 'px';
    cur.style.top  = my + 'px';
  });

  function animRing() {
    rx += (mx - rx) * .12;
    ry += (my - ry) * .12;
    curR.style.left = rx + 'px';
    curR.style.top  = ry + 'px';
    requestAnimationFrame(animRing);
  }
  animRing();

  document.querySelectorAll('a, button, .wcard, .svc-hex, .tc, .branch, .client-pill').forEach(el => {
    el.addEventListener('mouseenter', () => document.body.classList.add('cursor-hover'));
    el.addEventListener('mouseleave', () => document.body.classList.remove('cursor-hover'));
  });
}

// ============================================================
// LOADER
// ============================================================
const loaderFill = document.getElementById('loaderFill');
const loaderText = document.getElementById('loaderText');
const loaderEl   = document.getElementById('loader');

if (loaderFill && loaderText && loaderEl) {
  const msgs = [
    'Booting alien systems...',
    'Loading neural cores...',
    'Calibrating lasers...',
    'Establishing warp connection...',
    'Ready for launch! 🚀'
  ];
  let lp = 0, li = 0;

  const lInt = setInterval(() => {
    lp += Math.random() * 12 + 3;
    if (lp > 100) lp = 100;
    loaderFill.style.width = lp + '%';

    if (lp > 20 && li === 0) { loaderText.textContent = msgs[1]; li = 1; }
    if (lp > 45 && li === 1) { loaderText.textContent = msgs[2]; li = 2; }
    if (lp > 70 && li === 2) { loaderText.textContent = msgs[3]; li = 3; }

    if (lp >= 100) {
      loaderText.textContent = msgs[4];
      clearInterval(lInt);
      setTimeout(() => {
        loaderEl.classList.add('hide');
        startAll();
      }, 500);
    }
  }, 80);
} else {
  // No loader on page — start everything immediately
  document.addEventListener('DOMContentLoaded', startAll);
}

// ============================================================
// MATRIX RAIN
// ============================================================
function initMatrix() {
  const c = document.getElementById('matrix-canvas');
  if (!c) return;

  const ctx  = c.getContext('2d');
  const chars = 'ALIENCODE01アイエンコード量子宇宙∞⚡█▓▒░';

  function resize() {
    c.width  = window.innerWidth;
    c.height = window.innerHeight;
  }
  resize();
  window.addEventListener('resize', resize);

  const drops = () => Array(Math.floor(c.width / 18)).fill(1);
  let d = drops();

  setInterval(() => {
    ctx.fillStyle = 'rgba(10,7,20,0.05)';
    ctx.fillRect(0, 0, c.width, c.height);

    d.forEach((y, i) => {
      const ch = chars[Math.floor(Math.random() * chars.length)];
      ctx.fillStyle = `rgba(245,168,0,${Math.random() * .5 + .1})`;
      ctx.font = '14px Share Tech Mono, monospace';
      ctx.fillText(ch, i * 18, y * 18);
      if (y * 18 > c.height && Math.random() > .97) d[i] = 0;
      d[i]++;
    });
  }, 50);

  window.addEventListener('resize', () => { resize(); d = drops(); });
}

// ============================================================
// TYPEWRITER
// ============================================================
function initTypewriter() {
  const el = document.getElementById('typeText');
  if (!el) return;

  const phrases = [
    'Building scalable web applications...',
    'Crafting AI-powered solutions...',
    'Engineering cloud infrastructure...',
    'Designing stunning interfaces...',
    'Shipping blockchain protocols...',
    'Transforming your vision into reality.'
  ];
  let pi = 0, ci = 0, del = false;

  function tick() {
    const phrase = phrases[pi];
    if (!del) {
      el.textContent = phrase.slice(0, ++ci);
      if (ci === phrase.length) { del = true; setTimeout(tick, 1800); return; }
    } else {
      el.textContent = phrase.slice(0, --ci);
      if (ci === 0) { del = false; pi = (pi + 1) % phrases.length; setTimeout(tick, 400); return; }
    }
    setTimeout(tick, del ? 40 : 60);
  }
  setTimeout(tick, 2000);
}

// ============================================================
// ANIMATED ROBOT CANVAS
// ============================================================
function initRobot() {
  const c = document.getElementById('robotCanvas');
  if (!c) return;

  const ctx = c.getContext('2d');
  let t = 0;

  function roundRect(ctx, x, y, w, h, r, fill, stroke, lw) {
    ctx.beginPath();
    ctx.roundRect(x, y, w, h, r);
    if (fill)   { ctx.fillStyle   = fill;   ctx.fill(); }
    if (stroke) { ctx.strokeStyle = stroke; ctx.lineWidth = lw || 1; ctx.stroke(); }
  }

  function drawRobot(t) {
    ctx.clearRect(0, 0, 420, 560);
    const fl       = Math.sin(t * .8) * 12;
    const eye      = 0.5 + 0.5 * Math.sin(t * 2);
    const armSwing = Math.sin(t * .8) * 8;

    ctx.save();
    ctx.translate(0, fl);

    // Glow
    const g = ctx.createRadialGradient(210, 300, 20, 210, 300, 180);
    g.addColorStop(0, 'rgba(245,168,0,.08)');
    g.addColorStop(1, 'rgba(0,0,0,0)');
    ctx.fillStyle = g;
    ctx.fillRect(0, 0, 420, 560);

    // BODY
    roundRect(ctx, 115, 240, 190, 170, 18, 'rgba(31,22,48,.95)', 'rgba(245,168,0,.6)', 1.5);
    // CHEST PANEL
    roundRect(ctx, 133, 260, 154, 85, 10, 'rgba(5,2,15,.7)', 'rgba(245,168,0,.2)', 1);

    // Chest hexagons
    for (let r = 0; r < 2; r++) {
      for (let c2 = 0; c2 < 3; c2++) {
        const hx = 155 + c2 * 32, hy = 274 + r * 28;
        ctx.beginPath();
        for (let i = 0; i < 6; i++) {
          const a = i * Math.PI / 3 - Math.PI / 6;
          ctx.lineTo(hx + 11 * Math.cos(a), hy + 11 * Math.sin(a));
        }
        ctx.closePath();
        ctx.fillStyle   = `rgba(245,168,0,${0.08 + 0.05 * Math.sin(t + r * 2 + c2)})`;
        ctx.strokeStyle = `rgba(245,168,0,${0.4  + 0.2  * Math.sin(t + r * 2 + c2)})`;
        ctx.lineWidth   = .8;
        ctx.fill(); ctx.stroke();
      }
    }

    // Power core
    const pGlow = 0.5 + 0.5 * Math.sin(t * 2.5);
    const pg    = ctx.createRadialGradient(210, 340, 0, 210, 340, 16);
    pg.addColorStop(0, `rgba(245,168,0,${0.8 * pGlow})`);
    pg.addColorStop(1, 'rgba(245,168,0,0)');
    ctx.fillStyle = pg;
    ctx.beginPath(); ctx.arc(210, 340, 16, 0, Math.PI * 2); ctx.fill();
    ctx.beginPath(); ctx.arc(210, 340, 6,  0, Math.PI * 2);
    ctx.fillStyle = `rgba(245,168,0,${0.7 + 0.3 * pGlow})`; ctx.fill();

    // NECK
    roundRect(ctx, 180, 218, 60, 26, 8, 'rgba(31,22,48,.9)', 'rgba(245,168,0,.4)', 1);
    // HEAD
    roundRect(ctx, 118, 100, 184, 120, 22, 'rgba(31,22,48,.95)', 'rgba(245,168,0,.8)', 2);

    // Head scan line
    ctx.fillStyle = `rgba(245,168,0,${0.1 + 0.1 * Math.sin(t * 3)})`;
    ctx.fillRect(120, 100 + ((t * 20) % 118), 182, 3);

    // ANTENNAS
    ctx.strokeStyle = 'rgba(245,168,0,.7)'; ctx.lineWidth = 2;
    ctx.beginPath(); ctx.moveTo(210, 100); ctx.lineTo(210, 68); ctx.stroke();
    ctx.beginPath(); ctx.moveTo(120, 128); ctx.lineTo(90, 105);  ctx.stroke();
    ctx.beginPath(); ctx.moveTo(302, 128); ctx.lineTo(332, 105); ctx.stroke();

    // Antenna tips
    [[210, 62], [88, 103], [334, 103]].forEach(([ax, ay], i) => {
      const ag  = 0.5 + 0.5 * Math.sin(t * 2 + i);
      const aGr = ctx.createRadialGradient(ax, ay, 0, ax, ay, 10);
      aGr.addColorStop(0, `rgba(245,168,0,${ag})`);
      aGr.addColorStop(1, 'rgba(245,168,0,0)');
      ctx.fillStyle = aGr; ctx.beginPath(); ctx.arc(ax, ay, 10, 0, Math.PI * 2); ctx.fill();
      ctx.beginPath(); ctx.arc(ax, ay, 5, 0, Math.PI * 2);
      ctx.fillStyle = `rgba(245,168,0,${0.6 + 0.4 * ag})`; ctx.fill();
    });

    // EYES
    [[155, 145], [242, 145]].forEach(([ex, ey]) => {
      roundRect(ctx, ex, ey, 42, 24, 12, 'rgba(245,168,0,.1)', 'rgba(245,168,0,.8)', 1.5);
      const eyeGr = ctx.createRadialGradient(ex + 21, ey + 12, 0, ex + 21, ey + 12, 12);
      eyeGr.addColorStop(0, `rgba(245,168,0,${0.5 + 0.5 * eye})`);
      eyeGr.addColorStop(1, 'rgba(245,168,0,0)');
      ctx.fillStyle = eyeGr; ctx.beginPath(); ctx.arc(ex + 21, ey + 12, 12, 0, Math.PI * 2); ctx.fill();
      ctx.beginPath(); ctx.arc(ex + 21, ey + 12, 6, 0, Math.PI * 2);
      ctx.fillStyle = `rgba(245,168,0,${0.8 + 0.2 * eye})`; ctx.fill();
      ctx.beginPath(); ctx.arc(ex + 14, ey + 8, 3, 0, Math.PI * 2);
      ctx.fillStyle = 'rgba(255,255,255,.6)'; ctx.fill();
    });

    // MOUTH GRILLE
    roundRect(ctx, 155, 182, 110, 22, 5, 'rgba(5,2,15,.7)', 'rgba(245,168,0,.3)', 1);
    for (let i = 0; i < 9; i++) {
      ctx.strokeStyle = `rgba(245,168,0,${0.3 + 0.2 * Math.sin(t * 3 + i)})`;
      ctx.lineWidth = 1.5;
      ctx.beginPath(); ctx.moveTo(163 + i * 11, 187); ctx.lineTo(163 + i * 11, 199); ctx.stroke();
    }

    // ARMS
    roundRect(ctx, 58,  242 + armSwing, 54, 138, 16, 'rgba(31,22,48,.9)', 'rgba(245,168,0,.5)', 1.5);
    roundRect(ctx, 308, 242 - armSwing, 54, 138, 16, 'rgba(31,22,48,.9)', 'rgba(245,168,0,.5)', 1.5);
    // Arm joints
    [{ x: 85, y: 248 + armSwing }, { x: 335, y: 248 - armSwing }].forEach(({ x, y }) => {
      ctx.beginPath(); ctx.arc(x, y, 14, 0, Math.PI * 2);
      ctx.fillStyle = 'rgba(245,168,0,.1)'; ctx.strokeStyle = 'rgba(245,168,0,.5)'; ctx.lineWidth = 1.5;
      ctx.fill(); ctx.stroke();
    });

    // HANDS
    roundRect(ctx, 52,  378 + armSwing, 66, 48, 14, 'rgba(31,22,48,.9)', 'rgba(245,168,0,.5)', 1.5);
    roundRect(ctx, 302, 378 - armSwing, 66, 48, 14, 'rgba(31,22,48,.9)', 'rgba(245,168,0,.5)', 1.5);
    // Left hand symbol
    ctx.fillStyle = 'rgba(245,168,0,.7)'; ctx.font = 'bold 14px monospace'; ctx.textAlign = 'center';
    ctx.fillText('</>', 85, 408 + armSwing);
    // Right hand circuit
    ctx.beginPath(); ctx.arc(335, 403 - armSwing, 10, 0, Math.PI * 2);
    ctx.strokeStyle = 'rgba(245,168,0,.5)'; ctx.lineWidth = 1.5; ctx.stroke();
    ctx.beginPath(); ctx.arc(335, 403 - armSwing, 4, 0, Math.PI * 2);
    ctx.fillStyle = 'rgba(245,168,0,.7)'; ctx.fill();

    // LEGS
    roundRect(ctx, 148, 406, 48, 90, 14, 'rgba(31,22,48,.9)', 'rgba(245,168,0,.4)', 1.5);
    roundRect(ctx, 224, 406, 48, 90, 14, 'rgba(31,22,48,.9)', 'rgba(245,168,0,.4)', 1.5);
    // FEET
    roundRect(ctx, 135, 478, 68, 24, 10, 'rgba(31,22,48,.9)', 'rgba(245,168,0,.4)', 1.5);
    roundRect(ctx, 215, 478, 68, 24, 10, 'rgba(31,22,48,.9)', 'rgba(245,168,0,.4)', 1.5);

    ctx.restore();
    t += 0.04;
    requestAnimationFrame(() => drawRobot(t));
  }

  drawRobot(0);
}

// ============================================================
// DEMO CANVAS ANIMATIONS
// ============================================================
function initDemos() {

  // ── DEMO 1: Neural Network ────────────────────────────────
  const c1 = document.getElementById('demoCanvas1');
  if (c1) {
    const ctx = c1.getContext('2d');
    const W = c1.width, H = c1.height;
    const layers = [
      [{ x: 80 }, { x: 80 }, { x: 80 }],
      [{ x: 200 }, { x: 200 }, { x: 200 }, { x: 200 }],
      [{ x: 330 }, { x: 330 }, { x: 330 }, { x: 330 }, { x: 330 }],
      [{ x: 460 }, { x: 460 }, { x: 460 }],
      [{ x: 560 }, { x: 560 }]
    ];
    layers.forEach((l, li) => l.forEach((n, ni) => { n.y = H / (l.length + 1) * (ni + 1); }));
    let t = 0;

    function drawNN() {
      ctx.fillStyle = 'rgba(10,7,20,.95)'; ctx.fillRect(0, 0, W, H);
      t += .02;
      layers.forEach((l, li) => {
        if (li >= layers.length - 1) return;
        l.forEach(n => {
          layers[li + 1].forEach(n2 => {
            const a = 0.05 + 0.08 * Math.sin(t + n.x + n.y);
            ctx.strokeStyle = `rgba(245,168,0,${a})`; ctx.lineWidth = .5;
            ctx.beginPath(); ctx.moveTo(n.x, n.y); ctx.lineTo(n2.x, n2.y); ctx.stroke();
          });
        });
      });
      const pl = Math.floor(t * 2) % layers.length;
      if (pl < layers.length - 1) {
        const prog = (t * 2) % 1;
        layers[pl].forEach((n, ni) => {
          const n2 = layers[pl + 1][ni % layers[pl + 1].length];
          const px = n.x + (n2.x - n.x) * prog, py = n.y + (n2.y - n.y) * prog;
          ctx.beginPath(); ctx.arc(px, py, 3, 0, Math.PI * 2);
          ctx.fillStyle = 'rgba(245,168,0,.8)'; ctx.fill();
        });
      }
      layers.forEach((l, li) => l.forEach(n => {
        const act = 0.4 + 0.6 * Math.sin(t * 2 + li + n.y);
        const g   = ctx.createRadialGradient(n.x, n.y, 0, n.x, n.y, 14);
        g.addColorStop(0, `rgba(245,168,0,${act})`); g.addColorStop(1, 'rgba(245,168,0,0)');
        ctx.fillStyle = g; ctx.beginPath(); ctx.arc(n.x, n.y, 14, 0, Math.PI * 2); ctx.fill();
        ctx.beginPath(); ctx.arc(n.x, n.y, 7, 0, Math.PI * 2);
        ctx.fillStyle = `rgba(245,168,0,${act})`; ctx.strokeStyle = 'rgba(245,168,0,.3)';
        ctx.lineWidth = 1; ctx.fill(); ctx.stroke();
      }));
      ctx.fillStyle = 'rgba(245,168,0,.3)'; ctx.font = '10px Orbitron,sans-serif'; ctx.textAlign = 'center';
      ['INPUT', 'HIDDEN', 'HIDDEN', 'HIDDEN', 'OUTPUT'].forEach((l, i) => ctx.fillText(l, layers[i][0].x, H - 8));
      requestAnimationFrame(drawNN);
    }
    drawNN();
  }

  // ── DEMO 2: Trading Chart ─────────────────────────────────
  const c2 = document.getElementById('demoCanvas2');
  if (c2) {
    const ctx = c2.getContext('2d');
    const W = c2.width, H = c2.height;
    let prices = [], time = 0;
    for (let i = 0; i < 80; i++) prices.push(100 + Math.sin(i * .3) * 20 + Math.random() * 10);

    function drawTrading() {
      ctx.fillStyle = 'rgba(10,7,20,.95)'; ctx.fillRect(0, 0, W, H);
      time += .04;
      prices.push(prices[prices.length - 1] + (-1 + Math.random() * 2) * 2 + Math.sin(time) * .5);
      if (prices.length > 100) prices.shift();
      const min = Math.min(...prices) - 5, max = Math.max(...prices) + 5, range = max - min;
      for (let i = 0; i < 5; i++) {
        const y = 40 + i * (H - 80) / 4;
        ctx.strokeStyle = 'rgba(245,168,0,.05)'; ctx.lineWidth = 1;
        ctx.beginPath(); ctx.moveTo(40, y); ctx.lineTo(W - 20, y); ctx.stroke();
        const val = (max - i * (range / 4)).toFixed(0);
        ctx.fillStyle = 'rgba(245,168,0,.3)'; ctx.font = '9px monospace';
        ctx.textAlign = 'right'; ctx.fillText(val, 35, y + 3);
      }
      ctx.beginPath();
      prices.forEach((p, i) => {
        const x = 40 + (W - 60) * i / (prices.length - 1);
        const y = H - 40 - ((p - min) / range) * (H - 80);
        i === 0 ? ctx.moveTo(x, y) : ctx.lineTo(x, y);
      });
      ctx.lineTo(40 + (W - 60), H - 40); ctx.lineTo(40, H - 40); ctx.closePath();
      const grad = ctx.createLinearGradient(0, 0, 0, H);
      grad.addColorStop(0, 'rgba(245,168,0,.15)'); grad.addColorStop(1, 'rgba(245,168,0,0)');
      ctx.fillStyle = grad; ctx.fill();
      ctx.beginPath();
      prices.forEach((p, i) => {
        const x = 40 + (W - 60) * i / (prices.length - 1);
        const y = H - 40 - ((p - min) / range) * (H - 80);
        i === 0 ? ctx.moveTo(x, y) : ctx.lineTo(x, y);
      });
      ctx.strokeStyle = 'rgba(245,168,0,.9)'; ctx.lineWidth = 1.5; ctx.stroke();
      const lastP = prices[prices.length - 1];
      const lastY = H - 40 - ((lastP - min) / range) * (H - 80);
      ctx.beginPath(); ctx.arc(W - 20, lastY, 5, 0, Math.PI * 2);
      ctx.fillStyle = 'rgba(245,168,0,1)'; ctx.fill();
      ctx.strokeStyle = 'rgba(245,168,0,.3)'; ctx.lineWidth = 1;
      ctx.beginPath(); ctx.moveTo(40, lastY); ctx.lineTo(W - 25, lastY);
      ctx.setLineDash([3, 5]); ctx.stroke(); ctx.setLineDash([]);
      ctx.fillStyle = 'rgba(245,168,0,.8)'; ctx.font = 'bold 10px monospace';
      ctx.textAlign = 'left'; ctx.fillText(lastP.toFixed(2), W - 18, lastY + 4);
      ctx.fillStyle = 'rgba(245,168,0,.6)'; ctx.font = 'bold 11px Orbitron';
      ctx.textAlign = 'left'; ctx.fillText('BTC/USD', 8, 22);
      const chg = ((lastP - prices[0]) / prices[0] * 100).toFixed(2);
      ctx.fillStyle = chg > 0 ? 'rgba(40,200,64,.8)' : 'rgba(255,80,80,.8)';
      ctx.fillText((chg > 0 ? '+' : '') + chg + '%', 80, 22);
      requestAnimationFrame(drawTrading);
    }
    drawTrading();
  }

  // ── DEMO 3: Blockchain ────────────────────────────────────
  const c3 = document.getElementById('demoCanvas3');
  if (c3) {
    const ctx = c3.getContext('2d');
    const W = c3.width, H = c3.height;
    let blocks = [], t3 = 0, newBlockTimer = 0;
    for (let i = 0; i < 5; i++) blocks.push({
      x: 50 + i * 110, y: H / 2,
      hash: Math.random().toString(36).substr(2, 8),
      tx: Math.floor(Math.random() * 500) + 100,
      confirmed: true, scale: 1
    });

    function roundRect(ctx, x, y, w, h, r, fill, stroke, lw) {
      ctx.beginPath(); ctx.roundRect(x, y, w, h, r);
      if (fill)   { ctx.fillStyle   = fill; ctx.fill(); }
      if (stroke) { ctx.strokeStyle = stroke; ctx.lineWidth = lw || 1; ctx.stroke(); }
    }

    function drawBlockchain() {
      ctx.fillStyle = 'rgba(10,7,20,.95)'; ctx.fillRect(0, 0, W, H);
      t3 += .03; newBlockTimer++;
      if (newBlockTimer > 120) {
        blocks.push({
          x: W + 80, y: H / 2,
          hash: Math.random().toString(36).substr(2, 8),
          tx: Math.floor(Math.random() * 500) + 100,
          confirmed: false, scale: 0
        });
        blocks.forEach(b => { b.x -= 110; });
        newBlockTimer = 0;
        if (blocks.length > 7) blocks.shift();
      }
      blocks.forEach(b => { if (!b.confirmed) { b.scale = Math.min(1, b.scale + .04); if (b.scale >= 1) b.confirmed = true; } });
      blocks.forEach((b, i) => {
        if (i === 0) return;
        const prev = blocks[i - 1];
        ctx.strokeStyle = 'rgba(245,168,0,.3)'; ctx.lineWidth = 2; ctx.setLineDash([4, 4]);
        ctx.beginPath(); ctx.moveTo(prev.x + 45, prev.y); ctx.lineTo(b.x - 45, b.y); ctx.stroke();
        const ax = b.x - 50, ay = b.y;
        ctx.setLineDash([]); ctx.fillStyle = 'rgba(245,168,0,.4)';
        ctx.beginPath(); ctx.moveTo(ax, ay - 5); ctx.lineTo(ax + 8, ay); ctx.lineTo(ax, ay + 5); ctx.fill();
      });
      ctx.setLineDash([]);
      blocks.forEach((b, i) => {
        if (b.x < -100) return;
        ctx.save(); ctx.translate(b.x, b.y); ctx.scale(b.scale, b.scale);
        const isLatest = i === blocks.length - 1;
        roundRect(ctx, -45, -35, 90, 70, 8,
          isLatest ? 'rgba(245,168,0,.15)' : 'rgba(31,22,48,.9)',
          isLatest ? 'rgba(245,168,0,.8)'  : 'rgba(245,168,0,.3)',
          isLatest ? 2 : 1
        );
        ctx.fillStyle = 'rgba(245,168,0,.8)'; ctx.font = 'bold 9px Orbitron'; ctx.textAlign = 'center';
        ctx.fillText('#' + (1000 + i).toString(), 0, -20);
        ctx.fillStyle = 'rgba(245,168,0,.4)'; ctx.font = '8px monospace'; ctx.fillText(b.hash, 0, -5);
        ctx.fillStyle = 'rgba(245,168,0,.5)'; ctx.fillText(b.tx + ' tx', 0, 10);
        if (b.confirmed) { ctx.fillStyle = 'rgba(40,200,64,.7)'; ctx.fillText('✓ confirmed', 0, 25); }
        else             { ctx.fillStyle = 'rgba(245,168,0,.7)'; ctx.fillText('mining...', 0, 25); }
        ctx.restore();
      });
      ctx.fillStyle = 'rgba(245,168,0,.4)'; ctx.font = 'bold 10px Orbitron';
      ctx.textAlign = 'left'; ctx.fillText('ALIEN CHAIN — LIVE', 8, 18);
      ctx.fillStyle = 'rgba(40,200,64,.6)'; ctx.font = '9px monospace'; ctx.fillText('● ACTIVE', 140, 18);
      requestAnimationFrame(drawBlockchain);
    }
    drawBlockchain();
  }

  // ── DEMO 4: Network Map ───────────────────────────────────
  const c4 = document.getElementById('demoCanvas4');
  if (c4) {
    const ctx = c4.getContext('2d');
    const W = c4.width, H = c4.height;
    const nodeNames = ['Amman', 'Dubai', 'London', 'NYC', 'Tokyo', 'Seoul', 'Berlin', 'Sydney'];
    const nodes = nodeNames.map((name, i) => {
      const a = i * Math.PI * 2 / 8, r = 120 + Math.random() * 60;
      return { x: W / 2 + r * Math.cos(a), y: H / 2 + r * Math.sin(a) * 0.5, name, active: Math.random() > .3, pulse: Math.random() * Math.PI * 2 };
    });
    nodes.push({ x: W / 2, y: H / 2, name: 'HQ', active: true, pulse: 0, isHub: true });
    let t4 = 0;
    const packets = [];

    function drawNetwork() {
      ctx.fillStyle = 'rgba(10,7,20,.95)'; ctx.fillRect(0, 0, W, H);
      t4 += .02;
      if (Math.random() < .03) {
        const src = nodes[Math.floor(Math.random() * nodes.length)];
        const dst = nodes[Math.floor(Math.random() * nodes.length)];
        if (src !== dst) packets.push({ sx: src.x, sy: src.y, dx: dst.x, dy: dst.y, p: 0, speed: .008 + Math.random() * .015 });
      }
      for (let i = packets.length - 1; i >= 0; i--) {
        const pk = packets[i]; pk.p += pk.speed;
        if (pk.p >= 1) { packets.splice(i, 1); continue; }
        const px = pk.sx + (pk.dx - pk.sx) * pk.p, py = pk.sy + (pk.dy - pk.sy) * pk.p;
        ctx.beginPath(); ctx.arc(px, py, 3, 0, Math.PI * 2); ctx.fillStyle = 'rgba(245,168,0,.8)'; ctx.fill();
        const trail = ctx.createRadialGradient(px, py, 0, px, py, 8);
        trail.addColorStop(0, 'rgba(245,168,0,.3)'); trail.addColorStop(1, 'rgba(245,168,0,0)');
        ctx.fillStyle = trail; ctx.beginPath(); ctx.arc(px, py, 8, 0, Math.PI * 2); ctx.fill();
      }
      nodes.forEach((n, i) => { nodes.forEach((n2, j) => {
        if (j <= i) return;
        const d = Math.hypot(n.x - n2.x, n.y - n2.y);
        if (d < 220) {
          ctx.strokeStyle = `rgba(245,168,0,${0.04 + 0.06 * (1 - d / 220)})`; ctx.lineWidth = .5;
          ctx.beginPath(); ctx.moveTo(n.x, n.y); ctx.lineTo(n2.x, n2.y); ctx.stroke();
        }
      }); });
      nodes.forEach(n => {
        const pulse = 0.5 + 0.5 * Math.sin(t4 * 2 + n.pulse);
        const r     = n.isHub ? 18 : 10;
        if (n.active) {
          const aura = ctx.createRadialGradient(n.x, n.y, 0, n.x, n.y, r * 3);
          aura.addColorStop(0, `rgba(245,168,0,${0.15 * pulse})`); aura.addColorStop(1, 'rgba(245,168,0,0)');
          ctx.fillStyle = aura; ctx.beginPath(); ctx.arc(n.x, n.y, r * 3, 0, Math.PI * 2); ctx.fill();
        }
        ctx.beginPath(); ctx.arc(n.x, n.y, r, 0, Math.PI * 2);
        ctx.fillStyle   = n.isHub ? `rgba(245,168,0,${0.8 + 0.2 * pulse})` : `rgba(245,168,0,${n.active ? 0.7 + 0.3 * pulse : 0.2})`;
        ctx.strokeStyle = 'rgba(245,168,0,.3)'; ctx.lineWidth = 1; ctx.fill(); ctx.stroke();
        ctx.fillStyle = 'rgba(245,168,0,.7)';
        ctx.font      = `${n.isHub ? 'bold ' : ''}9px Orbitron`;
        ctx.textAlign = 'center'; ctx.fillText(n.name, n.x, n.y + r + 12);
      });
      ctx.fillStyle = 'rgba(245,168,0,.4)'; ctx.font = 'bold 10px Orbitron';
      ctx.textAlign = 'left'; ctx.fillText('GLOBAL NETWORK MAP', 8, 18);
      requestAnimationFrame(drawNetwork);
    }
    drawNetwork();
  }
}

// ============================================================
// MINI GAME — ALIEN DEFENDER
// ============================================================
function initGame() {
  const canvas  = document.getElementById('gameCanvas');
  const overlay = document.getElementById('gameOverlay');
  const startBtn = document.getElementById('gameStartBtn');

  // ── Hard guard — if the game section isn't on this page, bail out silently
  if (!canvas || !overlay || !startBtn) return;

  const ctx = canvas.getContext('2d');
  const W = 700, H = 420;

  let gameState = 'idle', score = 0, lives = 3, level = 1;
  let highScores = [0, 0, 0];
  let ship       = { x: W / 2, y: H - 60, speed: 4 };
  let bullets    = [], aliens = [], particles = [], stars = [];
  let keys       = {};
  let alienDir   = 1, alienDrop = false, alienSpeed = 0.4;
  let shootCooldown = 0;

  // Stars
  for (let i = 0; i < 80; i++) stars.push({
    x: Math.random() * W, y: Math.random() * H,
    s: Math.random() * 1.5 + .3, sp: Math.random() * .3 + .1
  });

  function spawnAliens() {
    aliens = [];
    const rows = 2 + level, cols = 6 + level;
    for (let r = 0; r < rows; r++) {
      for (let c = 0; c < cols; c++) {
        aliens.push({
          x: 60 + c * (W - 120) / cols, y: 40 + r * 44,
          w: 28, h: 20, alive: true,
          hp: level > 2 ? 2 : 1,
          t: Math.random() * Math.PI * 2,
          type: Math.floor(Math.random() * 3)
        });
      }
    }
  }

  function updateHUD() {
    const sd = document.getElementById('scoreDisplay');
    const ld = document.getElementById('livesDisplay');
    const lv = document.getElementById('levelDisplay');
    if (sd) sd.textContent = score;
    if (ld) ld.textContent = '❤️'.repeat(lives);
    if (lv) lv.textContent = level;
  }

  function addParticles(x, y, col) {
    for (let i = 0; i < 10; i++) particles.push({
      x, y,
      vx: -2 + Math.random() * 4,
      vy: -3 + Math.random() * 3,
      life: 1,
      col: col || 'rgba(245,168,0,'
    });
  }

  function drawStars() {
    stars.forEach(s => {
      s.y += s.sp; if (s.y > H) s.y = 0;
      ctx.beginPath(); ctx.arc(s.x, s.y, s.s, 0, Math.PI * 2);
      ctx.fillStyle = `rgba(255,255,255,${s.s / 2})`; ctx.fill();
    });
  }

  function drawShip(x, y) {
    ctx.save(); ctx.translate(x, y);
    ctx.fillStyle = `rgba(245,168,0,${0.4 + 0.4 * Math.random()})`;
    ctx.beginPath(); ctx.moveTo(-6, 15); ctx.lineTo(0, 15 + Math.random() * 12 + 8); ctx.lineTo(6, 15); ctx.closePath(); ctx.fill();
    ctx.fillStyle = 'rgba(245,168,0,.9)';
    ctx.beginPath(); ctx.moveTo(0, -18); ctx.lineTo(14, 12); ctx.lineTo(6, 8); ctx.lineTo(-6, 8); ctx.lineTo(-14, 12); ctx.closePath(); ctx.fill();
    ctx.fillStyle = 'rgba(31,22,48,.8)'; ctx.beginPath(); ctx.arc(0, -2, 6, 0, Math.PI * 2); ctx.fill();
    ctx.strokeStyle = 'rgba(245,168,0,.4)'; ctx.lineWidth = 1; ctx.stroke();
    ctx.fillStyle = 'rgba(245,168,0,.6)';
    ctx.beginPath(); ctx.moveTo(-6, 8); ctx.lineTo(-20, 16); ctx.lineTo(-10, 12); ctx.closePath(); ctx.fill();
    ctx.beginPath(); ctx.moveTo( 6, 8); ctx.lineTo( 20, 16); ctx.lineTo( 10, 12); ctx.closePath(); ctx.fill();
    ctx.restore();
  }

  function drawAlien(a) {
    if (!a.alive) return;
    ctx.save(); ctx.translate(a.x + a.w / 2, a.y + a.h / 2);
    ctx.translate(0, Math.sin(a.t) * 3);
    const cols  = ['rgba(255,80,80,', 'rgba(80,200,255,', 'rgba(200,80,255,'];
    const col   = cols[a.type];
    ctx.fillStyle = `${col}0.8)`;
    ctx.beginPath(); ctx.ellipse(0, 0, 14, 10, 0, 0, Math.PI * 2); ctx.fill();
    ctx.fillStyle = 'rgba(255,255,255,.9)';
    [-5, 5].forEach(ex => {
      ctx.beginPath(); ctx.ellipse(ex, -2, 3, 3.5, 0, 0, Math.PI * 2); ctx.fill();
      ctx.beginPath(); ctx.ellipse(ex, -2, 1.5, 2, 0, 0, Math.PI * 2); ctx.fillStyle = 'rgba(0,0,0,.8)'; ctx.fill();
    });
    ctx.strokeStyle = `${col}0.5)`; ctx.lineWidth = 1.5;
    [-8, -3, 3, 8].forEach((tx, i) => {
      ctx.beginPath(); ctx.moveTo(tx, 8); ctx.quadraticCurveTo(tx + 2, 14 + Math.sin(a.t + i) * 3, tx, 16); ctx.stroke();
    });
    if (a.hp > 1) {
      ctx.fillStyle = 'rgba(255,80,80,.6)'; ctx.fillRect(-12, -16, 24, 3);
      ctx.fillStyle = 'rgba(255,80,80,.9)'; ctx.fillRect(-12, -16, 24 * (a.hp === 2 ? .7 : .3), 3);
    }
    ctx.restore();
  }

  function showMsg(txt, dur) {
    const wrap = document.querySelector('.game-container');
    if (!wrap) return;
    const ov = document.createElement('div');
    ov.style.cssText = 'position:absolute;inset:0;display:flex;align-items:center;justify-content:center;font-family:Orbitron,sans-serif;font-size:2rem;color:#f5a800;pointer-events:none;z-index:5;text-shadow:0 0 30px rgba(245,168,0,.5);';
    ov.textContent = txt;
    wrap.appendChild(ov);
    setTimeout(() => ov.remove(), dur);
  }

  function endGame() {
    gameState = 'over';
    const combined = [score, ...highScores].sort((a, b) => b - a).slice(0, 3);
    highScores = combined;
    ['hs1', 'hs2', 'hs3'].forEach((id, i) => {
      const el = document.getElementById(id);
      if (el) el.textContent = combined[i] || 0;
    });
    const gsoTitle = document.getElementById('gsoTitle');
    const gsoSub   = document.getElementById('gsoSub');
    const gsoInstr = document.querySelector('.gso-instructions');
    if (gsoTitle) gsoTitle.textContent = score > highScores[0] ? 'NEW RECORD!' : 'GAME OVER';
    if (gsoSub)   gsoSub.textContent   = `Score: ${score} | Level: ${level}`;
    if (gsoInstr) gsoInstr.innerHTML   = `Final Score: <span style="color:#f5a800">${score}</span><br>Level: <span style="color:#f5a800">${level}</span><br><br>Beat <span style="color:#f5a800">${highScores[0]}</span>?`;
    startBtn.textContent = '▶ PLAY AGAIN';
    overlay.style.display = 'flex';
  }

  function gameLoop() {
    if (gameState !== 'playing') return;
    ctx.fillStyle = 'rgba(10,7,20,.95)'; ctx.fillRect(0, 0, W, H);
    drawStars();

    if ((keys['ArrowLeft'] || keys['a'])  && ship.x > 24)    ship.x -= ship.speed;
    if ((keys['ArrowRight'] || keys['d']) && ship.x < W - 24) ship.x += ship.speed;

    // Player bullets
    bullets = bullets.filter(b => b.y > -10);
    bullets.forEach(b => {
      b.y -= 9;
      const grd = ctx.createRadialGradient(b.x, b.y, 0, b.x, b.y, 6);
      grd.addColorStop(0, 'rgba(245,168,0,1)'); grd.addColorStop(1, 'rgba(245,168,0,0)');
      ctx.fillStyle = grd; ctx.beginPath(); ctx.arc(b.x, b.y, 6, 0, Math.PI * 2); ctx.fill();
      ctx.beginPath(); ctx.arc(b.x, b.y, 3, 0, Math.PI * 2); ctx.fillStyle = 'rgba(245,168,0,.9)'; ctx.fill();
    });

    // Alien movement
    const aliveAliens = aliens.filter(a => a.alive);
    aliveAliens.forEach(a => {
      a.t += .04; a.x += alienDir * 0.4;
      if (alienDrop) { a.y += 12; a.x += alienDir * 5; }
      if (Math.random() < .0005 * level) bullets.push({ x: a.x + 14, y: a.y + 20, enemy: true, speed: 3 + level * .3 });
    });
    alienDrop = false;
    if (aliveAliens.length) {
      const maxX = Math.max(...aliveAliens.map(a => a.x + 28));
      const minX = Math.min(...aliveAliens.map(a => a.x));
      if (maxX > W - 10) { alienDir = -1; alienDrop = true; }
      if (minX < 10)     { alienDir =  1; alienDrop = true; }
    }

    // Enemy bullets
    bullets.filter(b => b.enemy).forEach(b => {
      b.y += b.speed;
      ctx.fillStyle = 'rgba(255,80,80,.8)'; ctx.beginPath(); ctx.arc(b.x, b.y, 4, 0, Math.PI * 2); ctx.fill();
      ctx.fillStyle = 'rgba(255,80,80,.3)'; ctx.beginPath(); ctx.arc(b.x, b.y, 8, 0, Math.PI * 2); ctx.fill();
      if (Math.abs(b.x - ship.x) < 18 && Math.abs(b.y - ship.y) < 20) {
        addParticles(ship.x, ship.y, 'rgba(255,150,0,');
        lives--; updateHUD();
        bullets = bullets.filter(bb => bb !== b);
        if (lives <= 0) endGame();
      }
    });
    bullets = bullets.filter(b => b.y < H + 10);

    // Collision — player bullets vs aliens
    bullets.filter(b => !b.enemy).forEach(b => {
      aliens.forEach(a => {
        if (!a.alive) return;
        if (b.x > a.x && b.x < a.x + a.w && b.y > a.y && b.y < a.y + a.h) {
          a.hp--;
          if (a.hp <= 0) { a.alive = false; addParticles(a.x + 14, a.y + 10); score += 10 * level; updateHUD(); }
          bullets = bullets.filter(bb => bb !== b);
        }
      });
    });

    aliveAliens.forEach(a => { if (a.y + a.h > H - 50) endGame(); });

    aliens.forEach(a => drawAlien(a));
    drawShip(ship.x, ship.y);

    particles = particles.filter(p => p.life > 0);
    particles.forEach(p => {
      p.x += p.vx; p.y += p.vy; p.vy += .1; p.life -= .04;
      ctx.beginPath(); ctx.arc(p.x, p.y, 3, 0, Math.PI * 2);
      ctx.fillStyle = `${p.col}${p.life})`; ctx.fill();
    });

    ctx.strokeStyle = 'rgba(245,168,0,.2)'; ctx.lineWidth = 1;
    ctx.beginPath(); ctx.moveTo(0, H - 35); ctx.lineTo(W, H - 35); ctx.stroke();
    ctx.fillStyle = 'rgba(245,168,0,.15)'; ctx.fillRect(0, 0, W, 30);

    if (aliveAliens.length === 0) {
      level++; updateHUD(); alienSpeed = 0.4 + level * .05; spawnAliens(); showMsg(`LEVEL ${level}!`, 1500);
    }
    requestAnimationFrame(gameLoop);
  }

  // Keyboard
  document.addEventListener('keydown', e => {
    keys[e.key] = true;
    if (e.key === ' ' && gameState === 'playing') {
      e.preventDefault();
      if (shootCooldown <= 0) {
        bullets.push({ x: ship.x, y: ship.y - 20, enemy: false });
        shootCooldown = 15;
        const sp = document.getElementById('keySP');
        if (sp) { sp.classList.add('active-key'); setTimeout(() => sp.classList.remove('active-key'), 100); }
      }
    }
    const keyMap = { ArrowLeft: 'keyA', a: 'keyA', ArrowRight: 'keyD', d: 'keyD' };
    const el = document.getElementById(keyMap[e.key]);
    if (el) el.classList.add('active-key');
  });
  document.addEventListener('keyup', e => {
    keys[e.key] = false;
    ['keyA', 'keyD', 'keyW', 'keyS', 'keySP'].forEach(id => {
      const el = document.getElementById(id); if (el) el.classList.remove('active-key');
    });
  });
  setInterval(() => { if (shootCooldown > 0) shootCooldown--; }, 16);

  // Mobile tap
  canvas.addEventListener('touchstart', e => {
    e.preventDefault();
    if (gameState === 'playing' && shootCooldown <= 0) {
      bullets.push({ x: ship.x, y: ship.y - 20, enemy: false }); shootCooldown = 15;
    }
  });

  // Start button
  startBtn.onclick = () => {
    gameState = 'playing'; score = 0; lives = 3; level = 1;
    bullets = []; particles = []; alienDir = 1; alienSpeed = 0.4;
    ship.x = W / 2; updateHUD(); spawnAliens();
    overlay.style.display = 'none';
    gameLoop();
  };

  // Idle preview
  ctx.fillStyle = 'rgba(10,7,20,.95)'; ctx.fillRect(0, 0, W, H);
  drawStars();
  for (let i = 0; i < 6; i++) aliens.push({
    x: 80 + i * 90, y: 80 + Math.floor(i / 3) * 44,
    w: 28, h: 20, alive: true, hp: 1,
    t: Math.random() * Math.PI * 2, type: i % 3
  });
  aliens.forEach(a => drawAlien(a));
  drawShip(W / 2, H - 60);
}

// ============================================================
// PORTFOLIO CANVASES
// ============================================================
function initPortfolio() {

  function lineChart(id, colorR, colorG, colorB) {
    const c = document.getElementById(id);
    if (!c) return;
    const ctx = c.getContext('2d');
    const W = c.width, H = c.height;
    let d = [], t = 0;
    for (let i = 0; i < 50; i++) d.push(60 + Math.sin(i * .5) * 20 + Math.random() * 10);
    function draw() {
      ctx.fillStyle = 'rgba(10,7,20,.95)'; ctx.fillRect(0, 0, W, H);
      t += .03;
      d.push(d[d.length - 1] + (-1 + Math.random() * 2) * 2 + Math.sin(t) * .5);
      if (d.length > 60) d.shift();
      const mn = Math.min(...d) - 5, mx = Math.max(...d) + 5, rng = mx - mn;
      ctx.beginPath();
      d.forEach((v, i) => {
        const x = i * (W / (d.length - 1)), y = H - 10 - ((v - mn) / rng) * (H - 20);
        i === 0 ? ctx.moveTo(x, y) : ctx.lineTo(x, y);
      });
      ctx.strokeStyle = `rgba(${colorR},${colorG},${colorB},.9)`; ctx.lineWidth = 2; ctx.stroke();
      const g = ctx.createLinearGradient(0, 0, 0, H);
      g.addColorStop(0, `rgba(${colorR},${colorG},${colorB},.2)`);
      g.addColorStop(1, `rgba(${colorR},${colorG},${colorB},0)`);
      ctx.lineTo(W, H); ctx.lineTo(0, H); ctx.closePath(); ctx.fillStyle = g; ctx.fill();
      requestAnimationFrame(draw);
    }
    draw();
  }

  lineChart('pCanvas1', 245, 168, 0);
  lineChart('pCanvas6', 80, 255, 200);

  // Health ring
  const p2 = document.getElementById('pCanvas2');
  if (p2) {
    const ctx = p2.getContext('2d'); const W = p2.width, H = p2.height; let t = 0;
    function draw() {
      ctx.fillStyle = 'rgba(10,14,20,.95)'; ctx.fillRect(0, 0, W, H); t += .02;
      const r = 40 + Math.sin(t) * 5;
      ctx.beginPath(); ctx.arc(W / 2, H / 2, r, 0, Math.PI * 2);
      ctx.strokeStyle = 'rgba(80,200,255,.15)'; ctx.lineWidth = r * 2; ctx.stroke();
      ctx.beginPath(); ctx.arc(W / 2, H / 2, r, -Math.PI / 2, (-Math.PI / 2) + Math.PI * 1.6 * (.5 + .5 * Math.sin(t * .5)));
      ctx.strokeStyle = 'rgba(80,200,255,.8)'; ctx.lineWidth = 6; ctx.lineCap = 'round'; ctx.stroke();
      ctx.fillStyle = 'rgba(80,200,255,.8)'; ctx.font = 'bold 24px Orbitron'; ctx.textAlign = 'center';
      ctx.fillText(Math.floor(73 + 10 * Math.sin(t * .5)) + '%', W / 2, H / 2 + 8);
      ctx.font = '9px Orbitron'; ctx.fillStyle = 'rgba(80,200,255,.4)'; ctx.fillText('HEALTH SCORE', W / 2, H / 2 + 22);
      requestAnimationFrame(draw);
    }
    draw();
  }

  // NFT hex
  const p3 = document.getElementById('pCanvas3');
  if (p3) {
    const ctx = p3.getContext('2d'); const W = p3.width, H = p3.height; let t = 0;
    function draw() {
      ctx.fillStyle = 'rgba(20,10,20,.95)'; ctx.fillRect(0, 0, W, H); t += .02;
      const hexPoints = [];
      for (let i = 0; i < 6; i++) { const a = i * Math.PI / 3 - Math.PI / 6; hexPoints.push([W / 2 + 70 * Math.cos(a), H / 2 + 70 * Math.sin(a)]); }
      ctx.beginPath(); hexPoints.forEach(([x, y], i) => i === 0 ? ctx.moveTo(x, y) : ctx.lineTo(x, y)); ctx.closePath();
      ctx.strokeStyle = `rgba(200,80,255,${0.4 + 0.3 * Math.sin(t)})`; ctx.lineWidth = 2; ctx.stroke();
      const g = ctx.createRadialGradient(W / 2, H / 2, 10, W / 2, H / 2, 70);
      g.addColorStop(0, 'rgba(200,80,255,.15)'); g.addColorStop(1, 'rgba(200,80,255,0)');
      ctx.fillStyle = g; ctx.fill();
      ctx.fillStyle = 'rgba(200,80,255,.8)'; ctx.font = 'bold 14px Orbitron'; ctx.textAlign = 'center'; ctx.fillText('NFT', W / 2, H / 2 - 4);
      ctx.font = '9px monospace'; ctx.fillStyle = 'rgba(200,80,255,.5)'; ctx.fillText('#0721', W / 2, H / 2 + 10);
      ctx.fillStyle = 'rgba(245,168,0,.7)'; ctx.font = 'bold 11px Orbitron'; ctx.fillText('3.2 ETH', W / 2, H / 2 + 30);
      requestAnimationFrame(draw);
    }
    draw();
  }

  // Data flow
  const p4 = document.getElementById('pCanvas4');
  if (p4) {
    const ctx = p4.getContext('2d'); const W = p4.width, H = p4.height; const pkts = []; let t = 0;
    function draw() {
      ctx.fillStyle = 'rgba(26,10,26,.95)'; ctx.fillRect(0, 0, W, H); t += .03;
      if (Math.random() < .06) pkts.push({ x: 0, y: 20 + Math.random() * (H - 40), sp: .5 + Math.random() * 2 });
      pkts.forEach((p, i) => {
        p.x += p.sp; ctx.fillStyle = `rgba(245,168,0,${0.3 + 0.4 * (1 - p.x / W)})`; ctx.fillRect(p.x, p.y, 8, 2);
        if (p.x > W) pkts.splice(i, 1);
      });
      for (let i = 0; i < 4; i++) { ctx.fillStyle = `rgba(245,168,0,${0.05 + 0.03 * Math.sin(t + i)})`; ctx.fillRect(i * (W / 4), 0, 1, H); }
      ctx.fillStyle = 'rgba(245,168,0,.4)'; ctx.font = '9px Orbitron'; ctx.textAlign = 'left';
      ctx.fillText('DATA FLOW', 5, 14); ctx.fillText(pkts.length + ' active streams', 5, H - 5);
      requestAnimationFrame(draw);
    }
    draw();
  }

  // Social circles
  const p5 = document.getElementById('pCanvas5');
  if (p5) {
    const ctx = p5.getContext('2d'); const W = p5.width, H = p5.height; let t = 0;
    function draw() {
      ctx.fillStyle = 'rgba(10,20,10,.95)'; ctx.fillRect(0, 0, W, H); t += .02;
      for (let i = 0; i < 4; i++) {
        ctx.beginPath(); ctx.arc(W / 2, H / 2, 30 + i * 30, 0, Math.PI * 2);
        ctx.strokeStyle = `rgba(40,200,64,${.05 + .05 * Math.sin(t + i)})`; ctx.lineWidth = i === 0 ? 3 : 1; ctx.stroke();
      }
      ctx.beginPath(); ctx.arc(W / 2, H / 2, 20, 0, Math.PI * 2); ctx.fillStyle = 'rgba(40,200,64,.2)'; ctx.fill();
      ctx.fillStyle = 'rgba(40,200,64,.8)'; ctx.font = 'bold 12px Orbitron'; ctx.textAlign = 'center'; ctx.fillText('SOCIAL', W / 2, H / 2 + 4);
      ctx.font = '8px Orbitron'; ctx.fillStyle = 'rgba(40,200,64,.4)'; ctx.fillText('200K USERS', W / 2, H - 10);
      requestAnimationFrame(draw);
    }
    draw();
  }
}

// ============================================================
// INTERSECTION OBSERVER — fade-up + skill bars
// ============================================================
function initObserver() {
  const obs = new IntersectionObserver(entries => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        e.target.classList.add('vis');
        e.target.querySelectorAll('.skill-fill').forEach(f => {
          f.style.width = f.style.getPropertyValue('--w') || '0%';
        });
      }
    });
  }, { threshold: .1 });

  document.querySelectorAll('.fu').forEach(el => obs.observe(el));
}

// ============================================================
// COUNTERS
// ============================================================
function initCounters() {
  const obs = new IntersectionObserver(entries => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        e.target.querySelectorAll('.cnt').forEach(el => {
          const target = parseInt(el.dataset.target) || 0;
          let c = 0;
          const inc = target / 50;
          const interval = setInterval(() => {
            c = Math.min(c + inc, target);
            el.textContent = Math.floor(c);
            if (c >= target) { el.textContent = target; clearInterval(interval); }
          }, 30);
        });
        obs.unobserve(e.target);
      }
    });
  }, { threshold: .5 });

  const hero = document.getElementById('hero');
  if (hero) obs.observe(hero);
}

// ============================================================
// NAV SCROLL
// ============================================================
function initNav() {
  const nav = document.getElementById('mainNav');
  if (!nav) return;
  window.addEventListener('scroll', () => {
    nav.style.background = window.scrollY > 50
      ? 'rgba(10,7,20,.97)'
      : 'rgba(10,7,20,.8)';
  });
}

// ============================================================
// CONTACT FORM
// ============================================================
function initContact() {
  const btn = document.getElementById('submitBtn');
  if (!btn) return;
  btn.addEventListener('click', () => {
    btn.textContent = "✓ Message Received! We'll be in touch within 24h.";
    btn.style.background = 'linear-gradient(135deg,#1a7f3a,#22c55e)';
    btn.style.color = 'white';
    btn.style.fontSize = '.78rem';
    setTimeout(() => { btn.textContent = '🚀 Launch My Project'; btn.style.cssText = ''; }, 4000);
  });
}

// ============================================================
// MAIN INIT — called after loader completes (or on DOMContentLoaded)
// ============================================================
function startAll() {
  initMatrix();
  initTypewriter();
  initRobot();
  initDemos();
  initGame();       // ← safe: bails out if #gameCanvas is absent
  initPortfolio();
  initObserver();
  initCounters();
  initNav();
  initContact();
}