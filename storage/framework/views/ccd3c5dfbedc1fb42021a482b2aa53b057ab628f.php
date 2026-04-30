

<nav id="mainNav">

  
  <a href="<?php echo e(LaravelLocalization::localizeURL('/')); ?>" style="display:flex;align-items:center;flex-shrink:0;">
    <?php $logoPath = \App\Models\Setting::getValue('logo'); ?>
    <?php if($logoPath): ?>
      <img src="<?php echo e(asset('assets/admin/uploads/' . $logoPath)); ?>"
           alt="<?php echo e(\App\Models\Setting::getValue('site_name_'.app()->getLocale(), 'Alien Code')); ?>">
    <?php else: ?>
      <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Alien Code">
    <?php endif; ?>
  </a>

  
  <button class="nav-toggle" id="navToggle" aria-label="Toggle menu" aria-expanded="false">
    <span></span>
    <span></span>
    <span></span>
  </button>

  
  <ul id="navMenu">
    <li><a href="#about"><?php echo e(__('front.nav_about')); ?></a></li>
    <li><a href="#services"><?php echo e(__('front.nav_services')); ?></a></li>
    <li><a href="#work"><?php echo e(__('front.nav_work')); ?></a></li>
    <li><a href="#clients"><?php echo e(__('front.nav_clients')); ?></a></li>
    <li><a href="#branches"><?php echo e(__('front.nav_branches')); ?></a></li>
    <li><a href="#contact" class="nav-cta"><?php echo e(__('front.nav_contact')); ?></a></li>

    
    <li style="<?php echo e(app()->getLocale() === 'ar' ? 'margin-right:1rem;' : 'margin-left:1rem;'); ?>">
      <?php $__currentLoopData = LaravelLocalization::getSupportedLocales(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $localeCode => $properties): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($localeCode !== app()->getLocale()): ?>
          <a href="<?php echo e(LaravelLocalization::getLocalizedURL($localeCode, null, [], true)); ?>"
             style="display:inline-flex;align-items:center;gap:.3rem;
                    background:rgba(245,168,0,.1);border:1px solid rgba(245,168,0,.25);
                    border-radius:4px;padding:.3rem .8rem;color:var(--gold);
                    font-size:.72rem;font-family:'Orbitron',sans-serif;
                    white-space:nowrap;letter-spacing:.04em;">
            <?php echo e($localeCode === 'ar' ? '🇸🇦 العربية' : '🇬🇧 EN'); ?>

          </a>
        <?php endif; ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </li>
  </ul>

</nav><?php /**PATH C:\xampp\htdocs\alien\resources\views/front/includes/navbar.blade.php ENDPATH**/ ?>