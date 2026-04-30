<?php $__env->startSection('meta-title', \App\Models\Setting::getValue('meta_title_'.app()->getLocale(), 'Alien Code')); ?>
<?php $__env->startSection('meta-desc', \App\Models\Setting::getValue('meta_desc_'.app()->getLocale(), '')); ?>

<?php $__env->startSection('content'); ?>


<section id="hero">
  <canvas id="matrix-canvas"></canvas>
  <div class="orb-a hero-glow-orb"></div>
  <div class="orb-b hero-glow-orb"></div>

  <div class="hero-content">
    <div class="hero-chip">
      <div class="blink-dot"></div>
      <?php echo e($hero->trans('badge_text')); ?>

    </div>

    <h1 class="hero-title">
      <span class="line">
        <span class="word" style="animation-delay:.3s;"><?php echo e($hero->trans('title_line1')); ?></span>
      </span>
      <span class="line">
        <span class="word gold-text" style="animation-delay:.5s;"><?php echo e($hero->trans('title_line2')); ?></span>
      </span>
      <span class="line">
        <span class="word" style="animation-delay:.7s;"><?php echo e($hero->trans('title_line3')); ?></span>
      </span>
    </h1>

    <div class="type-line" id="typeLine">
      &gt; <span id="typeText"></span><span class="type-cursor">|</span>
    </div>

    <p class="hero-desc"><?php echo e($hero->trans('description')); ?></p>

    <div class="hero-actions">
      <a href="<?php echo e($hero->btn_primary_url); ?>" class="btn-gold">
        🚀 <?php echo e($hero->trans('btn_primary_text')); ?>

      </a>
      <a href="<?php echo e($hero->btn_secondary_url); ?>" class="btn-ghost">
        🎮 <?php echo e($hero->trans('btn_secondary_text')); ?>

      </a>
    </div>

    <div class="hero-stats">
      <div>
        <div class="cnt" data-target="<?php echo e($hero->stat_projects); ?>">0</div>
        <div class="hstat-lbl"><?php echo e(__('front.stat_projects')); ?></div>
      </div>
      <div>
        <div class="cnt" data-target="<?php echo e($hero->stat_years); ?>">0</div>
        <div class="hstat-lbl"><?php echo e(__('front.stat_years')); ?></div>
      </div>
      <div>
        <div class="cnt" data-target="<?php echo e($hero->stat_engineers); ?>">0</div>
        <div class="hstat-lbl"><?php echo e(__('front.stat_engineers')); ?></div>
      </div>
      <div>
        <div class="cnt" data-target="<?php echo e($hero->stat_satisfaction); ?>">0</div>
        <div class="hstat-lbl"><?php echo e(__('front.stat_satisfaction')); ?></div>
      </div>
    </div>
  </div>

  <div class="hero-robot-wrap">
    <canvas id="robotCanvas" width="420" height="560"></canvas>
  </div>

  <div class="scroll-ind">
    <div class="scroll-mouse"><div class="scroll-wheel"></div></div>
    <?php echo e(__('front.scroll')); ?>

  </div>
</section>


<div class="marquee-section">
  <div class="marquee-track">
    <?php $__currentLoopData = $services->take(8); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="marquee-item"><?php echo e($s->trans('title')); ?></div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php $__currentLoopData = $services->take(8); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="marquee-item"><?php echo e($s->trans('title')); ?></div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
</div>

<div class="divider"></div>


<section id="about">
  <div class="about-grid">
    <div class="about-visual-wrap fu">
      
      <div class="about-holo">
        <div class="holo-screen">
          <div class="holo-header">
            <div class="holo-dots"><span class="d1"></span><span class="d2"></span><span class="d3"></span></div>
            <div class="holo-title">alien_code_core.js — v3.7.0</div>
          </div>
          <div class="code-block">
            <span class="code-line"><span class="code-num">01</span><span class="code-comment">// Alien Code — Software DNA</span></span>
            <span class="code-line"><span class="code-num">03</span><span class="code-keyword">class</span> <span class="code-func">AlienCode</span> {</span>
            <span class="code-line"><span class="code-num">04</span>  <span class="code-keyword">constructor</span>() {</span>
            <span class="code-line"><span class="code-num">05</span>    <span class="code-var">this</span>.<span class="code-func">mission</span> = <span class="code-string">"<?php echo e(addslashes(\App\Models\Setting::getValue('about_title_en', 'Build the future'))); ?>"</span>;</span>
            <span class="code-line"><span class="code-num">06</span>    <span class="code-var">this</span>.<span class="code-func">years</span> = <span class="code-string"><?php echo e($hero->stat_years); ?></span>;</span>
            <span class="code-line"><span class="code-num">07</span>    <span class="code-var">this</span>.<span class="code-func">engineers</span> = <span class="code-string"><?php echo e($hero->stat_engineers); ?></span>;</span>
            <span class="code-line"><span class="code-num">08</span>  }</span>
            <span class="code-line"><span class="code-num">10</span>  <span class="code-keyword">async</span> <span class="code-func">buildProject</span>(vision) {</span>
            <span class="code-line"><span class="code-num">11</span>    <span class="code-keyword">return</span> <span class="code-var">solution</span>.<span class="code-func">exceedsExpectations</span>();</span>
            <span class="code-line"><span class="code-num">12</span>  }</span>
            <span class="code-line"><span class="code-num">13</span>}</span>
          </div>
        </div>
        <div class="float-badge fb1">⚡ <?php echo e(__('front.badge_uptime')); ?></div>
        <div class="float-badge fb2">🔒 <?php echo e(__('front.badge_security')); ?></div>
        <div class="float-badge fb3">🤖 <?php echo e(__('front.badge_ai')); ?></div>
      </div>
    </div>

    <div class="fu d1">
      <div class="sec-label"><?php echo e(__('front.about_label')); ?></div>
      <h2 class="sec-title">
        <?php echo e(\App\Models\Setting::getValue('about_title_'.app()->getLocale(), __('front.about_title'))); ?>

      </h2>
      <p class="sec-desc">
        <?php echo e(\App\Models\Setting::getValue('about_desc_'.app()->getLocale(), __('front.about_desc'))); ?>

      </p>

      <div style="margin-top:2.5rem;" class="fu d2">
        <div class="skill-row">
          <div class="skill-meta"><span><?php echo e(__('front.skill_web')); ?></span><span>97%</span></div>
          <div class="skill-track"><div class="skill-fill" style="--w:97%"></div></div>
        </div>
        <div class="skill-row">
          <div class="skill-meta"><span><?php echo e(__('front.skill_ai')); ?></span><span>92%</span></div>
          <div class="skill-track"><div class="skill-fill" style="--w:92%"></div></div>
        </div>
        <div class="skill-row">
          <div class="skill-meta"><span><?php echo e(__('front.skill_cloud')); ?></span><span>95%</span></div>
          <div class="skill-track"><div class="skill-fill" style="--w:95%"></div></div>
        </div>
      </div>

      <div style="display:flex;gap:1rem;margin-top:2rem;" class="fu d3">
        <a href="#contact" class="btn-gold" style="font-size:.8rem;padding:.85rem 1.8rem;">
          <?php echo e(__('front.cta_start')); ?>

        </a>
        <a href="#work" class="btn-ghost" style="font-size:.8rem;padding:.85rem 1.8rem;">
          <?php echo e(__('front.cta_work')); ?>

        </a>
      </div>
    </div>
  </div>
</section>

<div class="divider"></div>


<section id="services">
  <div class="fu" style="text-align:center;max-width:600px;margin:0 auto;">
    <div class="sec-label" style="justify-content:center;"><?php echo e(__('front.services_label')); ?></div>
    <h2 class="sec-title"><?php echo e(__('front.services_title')); ?></h2>
  </div>

  <div class="services-hex">
    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="svc-hex fu" style="transition-delay:<?php echo e($i * 0.1); ?>s;"
         onmousemove="this.style.setProperty('--mx',((event.offsetX/this.offsetWidth)*100)+'%');this.style.setProperty('--my',((event.offsetY/this.offsetHeight)*100)+'%')">
      <div class="svc-num"><?php echo e(str_pad($i + 1, 2, '0', STR_PAD_LEFT)); ?></div>
      <div class="svc-icon-wrap"><?php echo e($service->icon); ?></div>
      <h3><?php echo e($service->trans('title')); ?></h3>
      <p><?php echo e($service->trans('description')); ?></p>
      <?php if($service->tags): ?>
        <div class="svc-tags-wrap">
          <?php $__currentLoopData = $service->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <span class="stag"><?php echo e($tag); ?></span>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      <?php endif; ?>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
</section>

<div class="divider"></div>


<section id="work">
  <div class="fu">
    <div class="sec-label"><?php echo e(__('front.portfolio_label')); ?></div>
    <h2 class="sec-title"><?php echo e(__('front.portfolio_title')); ?> <span class="gold-text"><?php echo e(__('front.portfolio_title2')); ?></span></h2>
    <p class="sec-desc"><?php echo e(__('front.portfolio_desc')); ?></p>
  </div>

  <div class="work-masonry">
    <?php $__currentLoopData = $portfolio; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="wcard fu" style="transition-delay:<?php echo e(($i % 3) * 0.1); ?>s;">
      <div class="wcard-vis">
        <?php if($item->image): ?>
          <img src="<?php echo e($item->image_url); ?>" alt="<?php echo e($item->trans('title')); ?>"
               style="width:100%;aspect-ratio:4/3;object-fit:cover;display:block;">
        <?php else: ?>
          
          <div style="background:linear-gradient(135deg,#0d0a1a,#1f1630);aspect-ratio:4/3;display:flex;align-items:center;justify-content:center;">
            <canvas class="portfolio-canvas" data-index="<?php echo e($i); ?>"
                    width="280" height="180" style="max-width:100%;"></canvas>
          </div>
        <?php endif; ?>
      </div>
      <div class="wcard-body">
        <div class="wcard-tags">
          <span class="wcard-tag"><?php echo e($item->trans('category')); ?></span>
          <?php $__currentLoopData = array_slice($item->tags ?? [], 0, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <span class="wcard-tag"><?php echo e($tag); ?></span>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <h3><?php echo e($item->trans('title')); ?></h3>
        <p><?php echo e($item->trans('description')); ?></p>
        <?php if($item->project_url): ?>
          <a href="<?php echo e($item->project_url); ?>" target="_blank"
             style="display:inline-flex;align-items:center;gap:.4rem;color:var(--gold);font-size:.78rem;margin-top:.8rem;text-decoration:none;font-family:'Orbitron',sans-serif;">
            🔗 <?php echo e(__('front.view_project')); ?>

          </a>
        <?php endif; ?>
      </div>
      <div class="wcard-num"><?php echo e(str_pad($i + 1, 2, '0', STR_PAD_LEFT)); ?></div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
</section>

<div class="divider"></div>


<section id="clients">
  <div class="fu" style="text-align:center;">
    <div class="sec-label" style="justify-content:center;"><?php echo e(__('front.clients_label')); ?></div>
    <h2 class="sec-title"><?php echo e(__('front.clients_title')); ?> <span class="gold-text"><?php echo e(__('front.clients_title2')); ?></span></h2>
  </div>

  <?php if($clients->count()): ?>
  <div class="clients-ticker fu d1">
    <div class="ticker-row">
      <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="client-pill">
          <?php if($client->logo): ?>
            <img src="<?php echo e($client->logo_url); ?>" alt="<?php echo e($client->name); ?>"
                 style="height:24px;object-fit:contain;filter:brightness(0) invert(1);opacity:.5;margin-right:.4rem;vertical-align:middle;">
          <?php endif; ?>
          <?php echo e($client->name); ?>

        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="client-pill">
          <?php if($client->logo): ?>
            <img src="<?php echo e($client->logo_url); ?>" alt="<?php echo e($client->name); ?>"
                 style="height:24px;object-fit:contain;filter:brightness(0) invert(1);opacity:.5;margin-right:.4rem;vertical-align:middle;">
          <?php endif; ?>
          <?php echo e($client->name); ?>

        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>
  <?php endif; ?>
</section>

<div class="divider"></div>


<section id="testimonials">
  <div class="fu" style="text-align:center;max-width:600px;margin:0 auto;">
    <div class="sec-label" style="justify-content:center;"><?php echo e(__('front.testi_label')); ?></div>
    <h2 class="sec-title"><?php echo e(__('front.testi_title')); ?> <span class="gold-text"><?php echo e(__('front.testi_title2')); ?></span></h2>
  </div>

  <div class="testi-wrap">
    <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="tc fu" style="transition-delay:<?php echo e(($i % 3) * 0.1); ?>s;">
      <div class="tc-stars">
        <?php for($s = 1; $s <= 5; $s++): ?>
          <span><?php echo e($s <= $t->rating ? '★' : '☆'); ?></span>
        <?php endfor; ?>
      </div>
      <p class="tc-text">"<?php echo e($t->trans('quote')); ?>"</p>
      <div class="tc-person">
        <div class="tc-av"><?php echo e($t->initials); ?></div>
        <div>
          <div class="tc-name"><?php echo e($t->trans('author_name')); ?></div>
          <div class="tc-role"><?php echo e($t->trans('author_role')); ?>, <?php echo e($t->author_company); ?></div>
        </div>
      </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
</section>

<div class="divider"></div>


<section id="branches">
  <div class="fu" style="text-align:center;max-width:600px;margin:0 auto;">
    <div class="sec-label" style="justify-content:center;"><?php echo e(__('front.branches_label')); ?></div>
    <h2 class="sec-title"><?php echo e(__('front.branches_title')); ?> <span class="gold-text"><?php echo e(__('front.branches_title2')); ?></span></h2>
    <p class="sec-desc" style="margin:0 auto;"><?php echo e(__('front.branches_desc')); ?></p>
  </div>

  <div class="branches-wrap">
    <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="branch fu" style="transition-delay:<?php echo e($i * 0.1); ?>s;">
      <span class="branch-emoji"><?php echo e($branch->flag_emoji); ?></span>
      <div class="branch-city"><?php echo e($branch->trans('city')); ?></div>
      <div class="branch-country">
        <?php echo e(strtoupper($branch->trans('country'))); ?>

        <?php if($branch->trans('label')): ?> — <?php echo e(strtoupper($branch->trans('label'))); ?> <?php endif; ?>
      </div>
      <div class="branch-status">
        <div class="status-dot"></div>
        <?php echo e(__('front.branch_open')); ?>

      </div>
      <div class="branch-addr">
        <?php echo e($branch->trans('address')); ?><br>
        <?php if($branch->phone): ?> <?php echo e($branch->phone); ?><br> <?php endif; ?>
        <?php if($branch->trans('working_hours')): ?> <?php echo e($branch->trans('working_hours')); ?> <?php endif; ?>
      </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
</section>

<div class="divider"></div>


<section id="contact">
  <div class="fu" style="text-align:center;max-width:600px;margin:0 auto;">
    <div class="sec-label" style="justify-content:center;"><?php echo e(__('front.contact_label')); ?></div>
    <h2 class="sec-title"><?php echo e(__('front.contact_title')); ?> <span class="gold-text"><?php echo e(__('front.contact_title2')); ?></span></h2>
  </div>

  <div class="contact-wrap">
    <div class="fu">
      <?php if($branches->first()): ?>
        <?php $hq = $branches->first(); ?>
        <div class="contact-info-item">
          <div class="cii-icon">📍</div>
          <div>
            <div class="cii-label"><?php echo e(__('front.hq')); ?></div>
            <div class="cii-val"><?php echo e($hq->trans('address')); ?>, <?php echo e($hq->trans('city')); ?></div>
          </div>
        </div>
      <?php endif; ?>
      <div class="contact-info-item">
        <div class="cii-icon">✉️</div>
        <div>
          <div class="cii-label"><?php echo e(__('front.email')); ?></div>
          <div class="cii-val"><?php echo e(\App\Models\Setting::getValue('contact_email', 'hello@alien-code.io')); ?></div>
        </div>
      </div>
      <div class="contact-info-item">
        <div class="cii-icon">📞</div>
        <div>
          <div class="cii-label"><?php echo e(__('front.phone')); ?></div>
          <div class="cii-val"><?php echo e(\App\Models\Setting::getValue('contact_phone', '+962 6 500 0000')); ?></div>
        </div>
      </div>
      <?php if($branches->first()): ?>
      <div class="contact-info-item">
        <div class="cii-icon">🕐</div>
        <div>
          <div class="cii-label"><?php echo e(__('front.hours')); ?></div>
          <div class="cii-val"><?php echo e($hq->trans('working_hours')); ?></div>
        </div>
      </div>
      <?php endif; ?>
    </div>

    <div class="contact-card fu d1">
      <?php if(session('success')): ?>
        <div style="background:rgba(34,197,94,.1);border:1px solid rgba(34,197,94,.3);color:#4ade80;padding:.85rem 1rem;border-radius:8px;margin-bottom:1rem;font-size:.88rem;">
          ✅ <?php echo e(session('success')); ?>

        </div>
      <?php endif; ?>

      <form method="POST" action="<?php echo e(route('contact.send')); ?>">
        <?php echo csrf_field(); ?>
        <div class="form-row-2" style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
          <div class="form-field" style="margin-bottom:1rem;">
            <label style="display:block;font-size:.72rem;color:var(--muted);letter-spacing:.1em;text-transform:uppercase;margin-bottom:.4rem;font-family:'Orbitron',sans-serif;">
              <?php echo e(__('front.form_name')); ?>

            </label>
            <input type="text" name="name" value="<?php echo e(old('name')); ?>"
                   style="width:100%;background:rgba(10,7,20,.7);border:1px solid rgba(245,168,0,.12);border-radius:8px;padding:.75rem 1rem;color:var(--text);font-family:'Exo 2','Cairo',sans-serif;font-size:.88rem;outline:none;"
                   dir="<?php echo e(app()->getLocale() === 'ar' ? 'rtl' : 'ltr'); ?>" required>
            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div style="color:#f87171;font-size:.75rem;margin-top:.2rem;"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>
          <div class="form-field" style="margin-bottom:1rem;">
            <label style="display:block;font-size:.72rem;color:var(--muted);letter-spacing:.1em;text-transform:uppercase;margin-bottom:.4rem;font-family:'Orbitron',sans-serif;">
              <?php echo e(__('front.form_email')); ?>

            </label>
            <input type="email" name="email" value="<?php echo e(old('email')); ?>"
                   style="width:100%;background:rgba(10,7,20,.7);border:1px solid rgba(245,168,0,.12);border-radius:8px;padding:.75rem 1rem;color:var(--text);font-family:'Exo 2','Cairo',sans-serif;font-size:.88rem;outline:none;"
                   required>
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div style="color:#f87171;font-size:.75rem;margin-top:.2rem;"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>
        </div>

        <div style="margin-bottom:1rem;">
          <label style="display:block;font-size:.72rem;color:var(--muted);letter-spacing:.1em;text-transform:uppercase;margin-bottom:.4rem;font-family:'Orbitron',sans-serif;">
            <?php echo e(__('front.form_message')); ?>

          </label>
          <textarea name="message" rows="4" required
                    style="width:100%;background:rgba(10,7,20,.7);border:1px solid rgba(245,168,0,.12);border-radius:8px;padding:.75rem 1rem;color:var(--text);font-family:'Exo 2','Cairo',sans-serif;font-size:.88rem;outline:none;resize:vertical;"
                    dir="<?php echo e(app()->getLocale() === 'ar' ? 'rtl' : 'ltr'); ?>"><?php echo e(old('message')); ?></textarea>
          <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div style="color:#f87171;font-size:.75rem;margin-top:.2rem;"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <button type="submit" class="btn-gold" style="width:100%;justify-content:center;font-size:.85rem;">
          🚀 <?php echo e(__('front.form_submit')); ?>

        </button>
      </form>
    </div>
  </div>
</section>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\alien\resources\views/front/home.blade.php ENDPATH**/ ?>