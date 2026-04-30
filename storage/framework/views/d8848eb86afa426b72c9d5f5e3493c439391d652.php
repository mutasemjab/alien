

<footer>
  <div class="footer-top">

    
    <div class="footer-brand">
      <?php $logoPath = \App\Models\Setting::getValue('logo'); ?>
      <?php if($logoPath): ?>
        <img src="<?php echo e(asset('assets/admin/uploads/' . $logoPath)); ?>" alt="Alien Code">
      <?php else: ?>
        <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Alien Code">
      <?php endif; ?>

      <p><?php echo e(\App\Models\Setting::getValue('about_desc_'.app()->getLocale(), __('front.footer_tagline'))); ?></p>

      <div class="footer-socials">
        <?php if($l = \App\Models\Setting::getValue('linkedin')): ?>
          <a href="<?php echo e($l); ?>" class="fsoc" target="_blank" rel="noopener">in</a>
        <?php endif; ?>
        <?php if($l = \App\Models\Setting::getValue('facebook')): ?>
          <a href="<?php echo e($l); ?>" class="fsoc" target="_blank" rel="noopener">f</a>
        <?php endif; ?>
        <?php if($l = \App\Models\Setting::getValue('instagram')): ?>
          <a href="<?php echo e($l); ?>" class="fsoc" target="_blank" rel="noopener">Ig</a>
        <?php endif; ?>
      </div>
    </div>

    
    <div class="footer-col">
      <h4><?php echo e(__('front.footer_services')); ?></h4>
      <ul>
        <?php $__currentLoopData = $services->take(6); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li><a href="#services"><?php echo e($s->trans('title')); ?></a></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>
    </div>

    
    <div class="footer-col">
      <h4><?php echo e(__('front.footer_company')); ?></h4>
      <ul>
        <li><a href="#about"><?php echo e(__('front.nav_about')); ?></a></li>
        <li><a href="#work"><?php echo e(__('front.portfolio_label')); ?></a></li>
        <li><a href="#clients"><?php echo e(__('front.clients_label')); ?></a></li>
        <li><a href="#branches"><?php echo e(__('front.nav_branches')); ?></a></li>
      </ul>
    </div>

    
    <div class="footer-col">
      <h4><?php echo e(__('front.footer_offices')); ?></h4>
      <ul>
        <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li>
            <a href="#branches">
              <?php echo e($b->flag_emoji); ?> <?php echo e($b->trans('city')); ?>

            </a>
          </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>
    </div>

  </div>

  <div class="footer-bottom">
    <p>
      © <?php echo e(date('Y')); ?>

      <span><?php echo e(\App\Models\Setting::getValue('site_name_'.app()->getLocale(), 'Alien Code')); ?></span>.
      <?php echo e(__('front.footer_rights')); ?>

    </p>
    <p><?php echo e(__('front.footer_made')); ?> 👽</p>
  </div>
</footer><?php /**PATH C:\xampp\htdocs\alien\resources\views/front/includes/footer.blade.php ENDPATH**/ ?>