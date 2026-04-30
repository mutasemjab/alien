
<aside class="sidebar">
  <div class="sidebar-logo">
    <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Alien Code">
    <span>Admin Dashboard</span>
  </div>

  <nav class="sidebar-nav">
    <div class="nav-group-label">Overview</div>
    <a href="<?php echo e(route('admin.dashboard')); ?>" class="<?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
      <span class="nav-icon">📊</span> Dashboard
    </a>

    <div class="nav-group-label">Content</div>
    <a href="<?php echo e(route('admin.hero.edit')); ?>" class="<?php echo e(request()->routeIs('admin.hero.*') ? 'active' : ''); ?>">
      <span class="nav-icon">🎯</span> Hero Section
    </a>
    <a href="<?php echo e(route('admin.services.index')); ?>" class="<?php echo e(request()->routeIs('admin.services.*') ? 'active' : ''); ?>">
      <span class="nav-icon">⚙️</span> Services
    </a>
    <a href="<?php echo e(route('admin.portfolio.index')); ?>" class="<?php echo e(request()->routeIs('admin.portfolio.*') ? 'active' : ''); ?>">
      <span class="nav-icon">🖼️</span> Portfolio
    </a>
    <a href="<?php echo e(route('admin.clients.index')); ?>" class="<?php echo e(request()->routeIs('admin.clients.*') ? 'active' : ''); ?>">
      <span class="nav-icon">🤝</span> Clients
    </a>
    <a href="<?php echo e(route('admin.testimonials.index')); ?>" class="<?php echo e(request()->routeIs('admin.testimonials.*') ? 'active' : ''); ?>">
      <span class="nav-icon">💬</span> Testimonials
    </a>
    <a href="<?php echo e(route('admin.branches.index')); ?>" class="<?php echo e(request()->routeIs('admin.branches.*') ? 'active' : ''); ?>">
      <span class="nav-icon">🌍</span> Branches
    </a>

    <div class="nav-group-label">Configuration</div>
    <a href="<?php echo e(route('admin.settings.index')); ?>" class="<?php echo e(request()->routeIs('admin.settings.*') ? 'active' : ''); ?>">
      <span class="nav-icon">🔧</span> Site Settings
    </a>
  </nav>

  <div class="sidebar-footer">
    <a href="<?php echo e(url('/')); ?>" target="_blank">
      <span>🌐</span> View Website
    </a>
    <br><br>
    <form method="POST" action="<?php echo e(route('admin.logout')); ?>" style="margin-top:.5rem;">
      <?php echo csrf_field(); ?>
      <button type="submit" style="background:none;border:none;cursor:pointer;color:var(--muted);font-size:.82rem;display:flex;align-items:center;gap:.5rem;">
        <span>🚪</span> Logout
      </button>
    </form>
  </div>
</aside><?php /**PATH C:\xampp\htdocs\alien\resources\views/admin/includes/sidebar.blade.php ENDPATH**/ ?>