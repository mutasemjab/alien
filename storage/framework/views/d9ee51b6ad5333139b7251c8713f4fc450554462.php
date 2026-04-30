<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<title><?php echo $__env->yieldContent('title', 'Admin'); ?> — Alien Code Dashboard</title>
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Exo+2:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/mycustomstyle.css')); ?>">

</head>
<body>




<div class="main-wrap">
  <header class="topbar">
    <div class="topbar-title"><?php echo $__env->yieldContent('page-title', 'Dashboard'); ?></div>
    <div class="topbar-right">
      <span class="topbar-user">👤 <?php echo e(auth()->user()->name ?? 'Admin'); ?></span>
    </div>
  </header>

  <main class="content">
    <?php if(session('success')): ?>
      <div class="alert alert-success">✅ <?php echo e(session('success')); ?></div>
    <?php endif; ?>
    <?php if(session('error')): ?>
      <div class="alert alert-error">❌ <?php echo e(session('error')); ?></div>
    <?php endif; ?>
    <?php if($errors->any()): ?>
      <div class="alert alert-error">
        ❌ <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($e); ?><br> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    <?php endif; ?>

    <?php echo $__env->yieldContent('content'); ?>
  </main>
</div>

<?php echo $__env->make('admin.includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script>
// Lang tabs
document.querySelectorAll('.lang-tab').forEach(tab => {
  tab.addEventListener('click', () => {
    const lang = tab.dataset.lang;
    const parent = tab.closest('.lang-tabs-wrap');
    parent.querySelectorAll('.lang-tab').forEach(t => t.classList.remove('active'));
    parent.querySelectorAll('.lang-panel').forEach(p => p.classList.remove('active'));
    tab.classList.add('active');
    parent.querySelector('.lang-panel[data-lang="'+lang+'"]').classList.add('active');
  });
});

// Confirm delete
document.querySelectorAll('[data-confirm]').forEach(btn => {
  btn.addEventListener('click', e => {
    if (!confirm(btn.dataset.confirm || 'Are you sure?')) e.preventDefault();
  });
});
</script>
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\alien\resources\views/layouts/admin.blade.php ENDPATH**/ ?>