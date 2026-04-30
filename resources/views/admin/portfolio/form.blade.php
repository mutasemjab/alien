@extends('layouts.admin')
@section('page-title', $item->exists ? 'Edit Project' : 'New Project')
@section('content')

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;">
  <h2 style="font-family:'Orbitron',sans-serif;font-size:1.1rem;color:var(--white);">
    {{ $item->exists ? 'Edit Project' : 'New Project' }}
  </h2>
  <a href="{{ route('admin.portfolio.index') }}" class="btn btn-outline">← Back</a>
</div>

<form method="POST"
      action="{{ $item->exists ? route('admin.portfolio.update', $item) : route('admin.portfolio.store') }}"
      enctype="multipart/form-data">
  @csrf
  @if($item->exists) @method('PUT') @endif

  <div class="card">
    <div class="card-header"><span class="card-title">Project Details</span></div>

    {{-- IMAGE --}}
    <div class="form-group">
      <label>Project Image</label>
      @if($item->image)
        <div style="margin-bottom:.8rem;">
          <img src="{{ $item->image_url }}" style="height:120px;border-radius:8px;border:1px solid rgba(245,168,0,.2);object-fit:cover;">
        </div>
      @endif
      <div class="img-upload-wrap" style="position:relative;display:inline-block;">
        <button type="button" class="btn btn-outline btn-sm">📁 Choose Image</button>
        <input type="file" name="image" accept="image/*" onchange="previewImg(this)">
      </div>
      <div class="hint">Max 3MB — JPG, PNG, WebP. Displayed in portfolio grid.</div>
      <img id="imgPreview" src="" style="display:none;margin-top:.8rem;height:100px;border-radius:6px;border:1px solid rgba(245,168,0,.2);">
    </div>

    {{-- LANG TABS --}}
    <div class="lang-tabs-wrap">
      <div class="lang-tabs">
        <button type="button" class="lang-tab active" data-lang="en">🇬🇧 English</button>
        <button type="button" class="lang-tab" data-lang="ar">🇸🇦 العربية</button>
      </div>

      <div class="lang-panel active" data-lang="en">
        <div class="form-grid">
          <div class="form-group">
            <label>Title (English)</label>
            <input type="text" name="title_en" value="{{ old('title_en', $item->title_en) }}" required maxlength="150">
            @error('title_en') <div class="error-msg">{{ $message }}</div> @enderror
          </div>
          <div class="form-group">
            <label>Category (English)</label>
            <input type="text" name="category_en" value="{{ old('category_en', $item->category_en) }}" required maxlength="60" placeholder="FinTech, AI, Mobile...">
            @error('category_en') <div class="error-msg">{{ $message }}</div> @enderror
          </div>
          <div class="form-group full">
            <label>Description (English)</label>
            <textarea name="description_en" rows="3" required>{{ old('description_en', $item->description_en) }}</textarea>
            @error('description_en') <div class="error-msg">{{ $message }}</div> @enderror
          </div>
        </div>
      </div>

      <div class="lang-panel" data-lang="ar">
        <div class="form-grid">
          <div class="form-group">
            <label>العنوان (Arabic Title)</label>
            <input type="text" name="title_ar" value="{{ old('title_ar', $item->title_ar) }}" dir="rtl" required maxlength="150">
            @error('title_ar') <div class="error-msg">{{ $message }}</div> @enderror
          </div>
          <div class="form-group">
            <label>الفئة (Arabic Category)</label>
            <input type="text" name="category_ar" value="{{ old('category_ar', $item->category_ar) }}" dir="rtl" required maxlength="60">
            @error('category_ar') <div class="error-msg">{{ $message }}</div> @enderror
          </div>
          <div class="form-group full">
            <label>الوصف (Arabic Description)</label>
            <textarea name="description_ar" rows="3" dir="rtl" required>{{ old('description_ar', $item->description_ar) }}</textarea>
            @error('description_ar') <div class="error-msg">{{ $message }}</div> @enderror
          </div>
        </div>
      </div>
    </div>

    {{-- TAGS & URLS --}}
    <div class="form-grid">
      <div class="form-group">
        <label>Tags (comma-separated)</label>
        <input type="text" name="tags"
               value="{{ old('tags', is_array($item->tags) ? implode(', ', $item->tags) : '') }}"
               placeholder="FinTech, AI, React, AWS">
        <div class="hint">Displayed as colored badges on the project card</div>
      </div>
      <div class="form-group">
        <label>Sort Order</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $item->sort_order ?? 0) }}" min="0">
      </div>
      <div class="form-group">
        <label>Live Project URL</label>
        <input type="url" name="project_url" value="{{ old('project_url', $item->project_url) }}" placeholder="https://...">
      </div>
      <div class="form-group">
        <label>GitHub URL</label>
        <input type="url" name="github_url" value="{{ old('github_url', $item->github_url) }}" placeholder="https://github.com/...">
      </div>
    </div>

    <div class="form-group">
      <label>Status</label>
      <div class="toggle-wrap">
        <label class="toggle">
          <input type="checkbox" name="is_active" value="1"
                 {{ old('is_active', $item->is_active ?? true) ? 'checked' : '' }}>
          <span class="toggle-slider"></span>
        </label>
        <span style="font-size:.85rem;color:var(--muted);">Show on website</span>
      </div>
    </div>
  </div>

  <div style="display:flex;gap:1rem;">
    <button type="submit" class="btn btn-gold">
      💾 {{ $item->exists ? 'Update Project' : 'Create Project' }}
    </button>
    <a href="{{ route('admin.portfolio.index') }}" class="btn btn-outline">Cancel</a>
  </div>
</form>

@push('scripts')
<script>
function previewImg(input) {
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = e => {
      const prev = document.getElementById('imgPreview');
      prev.src = e.target.result;
      prev.style.display = 'block';
    };
    reader.readAsDataURL(input.files[0]);
  }
}
</script>
@endpush
@endsection
