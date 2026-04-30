<?php $__env->startSection('page-title', 'Hero Section'); ?>

<?php $__env->startSection('content'); ?>
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;">
  <h2 style="font-family:'Orbitron',sans-serif;font-size:1.1rem;color:var(--white);">Edit Hero Section</h2>
</div>

<form method="POST" action="<?php echo e(route('admin.hero.update')); ?>">
  <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>

  
  <div class="card">
    <div class="card-header"><span class="card-title">Badge Text</span></div>
    <div class="form-grid">
      <div class="form-group">
        <label>Badge (English)</label>
        <input type="text" name="badge_text_en" value="<?php echo e(old('badge_text_en', $hero->badge_text_en)); ?>" required>
      </div>
      <div class="form-group">
        <label>Badge (Arabic) — النص بالعربية</label>
        <input type="text" name="badge_text_ar" value="<?php echo e(old('badge_text_ar', $hero->badge_text_ar)); ?>" dir="rtl" required>
      </div>
    </div>
  </div>

  
  <div class="card">
    <div class="card-header"><span class="card-title">Title Lines</span><span style="font-size:.75rem;color:var(--muted);">3 lines displayed in hero</span></div>
    <div class="form-grid">
      <div class="form-group"><label>Line 1 (EN)</label><input type="text" name="title_line1_en" value="<?php echo e(old('title_line1_en', $hero->title_line1_en)); ?>" required></div>
      <div class="form-group"><label>Line 1 (AR)</label><input type="text" name="title_line1_ar" value="<?php echo e(old('title_line1_ar', $hero->title_line1_ar)); ?>" dir="rtl" required></div>
      <div class="form-group"><label>Line 2 (EN) — Gold highlight</label><input type="text" name="title_line2_en" value="<?php echo e(old('title_line2_en', $hero->title_line2_en)); ?>" required></div>
      <div class="form-group"><label>Line 2 (AR)</label><input type="text" name="title_line2_ar" value="<?php echo e(old('title_line2_ar', $hero->title_line2_ar)); ?>" dir="rtl" required></div>
      <div class="form-group"><label>Line 3 (EN)</label><input type="text" name="title_line3_en" value="<?php echo e(old('title_line3_en', $hero->title_line3_en)); ?>" required></div>
      <div class="form-group"><label>Line 3 (AR)</label><input type="text" name="title_line3_ar" value="<?php echo e(old('title_line3_ar', $hero->title_line3_ar)); ?>" dir="rtl" required></div>
    </div>
  </div>

  
  <div class="card">
    <div class="card-header"><span class="card-title">Description</span></div>
    <div class="form-grid">
      <div class="form-group"><label>Description (EN)</label><textarea name="description_en" required><?php echo e(old('description_en', $hero->description_en)); ?></textarea></div>
      <div class="form-group"><label>Description (AR)</label><textarea name="description_ar" dir="rtl" required><?php echo e(old('description_ar', $hero->description_ar)); ?></textarea></div>
    </div>
  </div>

  
  <div class="card">
    <div class="card-header"><span class="card-title">CTA Buttons</span></div>
    <div class="form-grid cols3">
      <div class="form-group"><label>Primary Button (EN)</label><input type="text" name="btn_primary_text_en" value="<?php echo e(old('btn_primary_text_en', $hero->btn_primary_text_en)); ?>" required></div>
      <div class="form-group"><label>Primary Button (AR)</label><input type="text" name="btn_primary_text_ar" value="<?php echo e(old('btn_primary_text_ar', $hero->btn_primary_text_ar)); ?>" dir="rtl" required></div>
      <div class="form-group"><label>Primary Button URL</label><input type="text" name="btn_primary_url" value="<?php echo e(old('btn_primary_url', $hero->btn_primary_url)); ?>" required></div>
      <div class="form-group"><label>Secondary Button (EN)</label><input type="text" name="btn_secondary_text_en" value="<?php echo e(old('btn_secondary_text_en', $hero->btn_secondary_text_en)); ?>" required></div>
      <div class="form-group"><label>Secondary Button (AR)</label><input type="text" name="btn_secondary_text_ar" value="<?php echo e(old('btn_secondary_text_ar', $hero->btn_secondary_text_ar)); ?>" dir="rtl" required></div>
      <div class="form-group"><label>Secondary Button URL</label><input type="text" name="btn_secondary_url" value="<?php echo e(old('btn_secondary_url', $hero->btn_secondary_url)); ?>" required></div>
    </div>
  </div>

  
  <div class="card">
    <div class="card-header"><span class="card-title">Statistics Counter</span></div>
    <div class="form-grid">
      <div class="form-group"><label>Projects Delivered</label><input type="number" name="stat_projects" value="<?php echo e(old('stat_projects', $hero->stat_projects)); ?>" min="0" required></div>
      <div class="form-group"><label>Years Active</label><input type="number" name="stat_years" value="<?php echo e(old('stat_years', $hero->stat_years)); ?>" min="0" required></div>
      <div class="form-group"><label>Engineers</label><input type="number" name="stat_engineers" value="<?php echo e(old('stat_engineers', $hero->stat_engineers)); ?>" min="0" required></div>
      <div class="form-group"><label>Satisfaction %</label><input type="number" name="stat_satisfaction" value="<?php echo e(old('stat_satisfaction', $hero->stat_satisfaction)); ?>" min="0" max="100" required></div>
    </div>
  </div>

  <div style="display:flex;gap:1rem;">
    <button type="submit" class="btn btn-gold">💾 Save Hero Section</button>
  </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\alien\resources\views/admin/hero/edit.blade.php ENDPATH**/ ?>