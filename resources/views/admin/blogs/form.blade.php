@extends('layouts.admin')
@section('page-title', $post->exists ? 'Edit Post' : 'New Blog Post')
@section('content')

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;">
  <h2 style="font-family:'Orbitron',sans-serif;font-size:1.1rem;color:var(--white);">
    {{ $post->exists ? 'Edit Post' : 'New Blog Post' }}
  </h2>
  <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline">← Back</a>
</div>

<form method="POST"
      action="{{ $post->exists ? route('admin.blogs.update', $post) : route('admin.blogs.store') }}"
      enctype="multipart/form-data">
  @csrf
  @if($post->exists) @method('PUT') @endif

  {{-- FEATURED IMAGE --}}
  <div class="card">
    <div class="card-header"><span class="card-title">📸 Featured Image</span></div>
    <div class="form-group">
      @if($post->image)
        <div style="margin-bottom:.8rem;">
          <img src="{{ $post->image_url }}" style="height:120px;border-radius:8px;border:1px solid rgba(245,168,0,.2);object-fit:cover;">
        </div>
      @endif
      <div class="img-upload-wrap" style="position:relative;display:inline-block;">
        <button type="button" class="btn btn-outline btn-sm">📁 Choose Image</button>
        <input type="file" name="image" accept="image/*" onchange="previewImg(this)">
      </div>
      <div class="hint">Recommended: 1200×630px — used as OG image for social sharing too</div>
      <img id="imgPreview" src="" style="display:none;margin-top:.8rem;height:100px;border-radius:6px;border:1px solid rgba(245,168,0,.2);">
    </div>
  </div>

  {{-- CONTENT --}}
  <div class="card">
    <div class="card-header"><span class="card-title">✍️ Content</span></div>

    <div class="lang-tabs-wrap">
      <div class="lang-tabs">
        <button type="button" class="lang-tab active" data-lang="en">🇬🇧 English</button>
        <button type="button" class="lang-tab" data-lang="ar">🇸🇦 العربية</button>
      </div>

      <div class="lang-panel active" data-lang="en">
        <div class="form-group">
          <label>Title (English) <span style="color:#f87171;">*</span></label>
          <input type="text" name="title_en" value="{{ old('title_en', $post->title_en) }}" required maxlength="200">
          @error('title_en') <div class="error-msg">{{ $message }}</div> @enderror
        </div>
        <div class="form-group">
          <label>Excerpt / Summary (English)</label>
          <textarea name="excerpt_en" rows="2" placeholder="Short description shown on listing pages and in Google snippets…">{{ old('excerpt_en', $post->excerpt_en) }}</textarea>
          <div class="hint">Keep under 160 chars for best SEO results</div>
        </div>
        <div class="form-group">
          <label>Body / Full Content (English)</label>
          <textarea name="body_en" rows="14" placeholder="Write your full article content here…">{{ old('body_en', $post->body_en) }}</textarea>
        </div>
      </div>

      <div class="lang-panel" data-lang="ar">
        <div class="form-group">
          <label>العنوان (Arabic Title)</label>
          <input type="text" name="title_ar" value="{{ old('title_ar', $post->title_ar) }}" dir="rtl" maxlength="200">
        </div>
        <div class="form-group">
          <label>ملخص قصير (Arabic Excerpt)</label>
          <textarea name="excerpt_ar" rows="2" dir="rtl">{{ old('excerpt_ar', $post->excerpt_ar) }}</textarea>
        </div>
        <div class="form-group">
          <label>المحتوى الكامل (Arabic Body)</label>
          <textarea name="body_ar" rows="14" dir="rtl">{{ old('body_ar', $post->body_ar) }}</textarea>
        </div>
      </div>
    </div>
  </div>

  {{-- META --}}
  <div class="card">
    <div class="card-header"><span class="card-title">⚙️ Post Settings</span></div>
    <div class="form-grid">
      <div class="form-group">
        <label>URL Slug</label>
        <input type="text" name="slug" value="{{ old('slug', $post->slug) }}" maxlength="200"
               placeholder="auto-generated-from-title">
        <div class="hint">Leave blank to auto-generate from English title</div>
      </div>
      <div class="form-group">
        <label>Author</label>
        <input type="text" name="author" value="{{ old('author', $post->author) }}" maxlength="100" placeholder="Alien Code Team">
      </div>
      <div class="form-group">
        <label>Category (English)</label>
        <input type="text" name="category_en" value="{{ old('category_en', $post->category_en) }}" maxlength="100" placeholder="Web Development, AI, Cloud…">
      </div>
      <div class="form-group">
        <label>الفئة (Arabic Category)</label>
        <input type="text" name="category_ar" value="{{ old('category_ar', $post->category_ar) }}" dir="rtl" maxlength="100">
      </div>
      <div class="form-group">
        <label>Tags (comma-separated)</label>
        <input type="text" name="tags"
               value="{{ old('tags', is_array($post->tags) ? implode(', ', $post->tags) : '') }}"
               placeholder="Laravel, SEO, React, AI">
      </div>
      <div class="form-group">
        <label>Publish Date</label>
        <input type="datetime-local" name="published_at"
               value="{{ old('published_at', $post->published_at?->format('Y-m-d\TH:i') ?? now()->format('Y-m-d\TH:i')) }}">
      </div>
      <div class="form-group">
        <label>Sort Order</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $post->sort_order ?? 0) }}" min="0">
      </div>
      <div class="form-group" style="display:flex;align-items:center;gap:1rem;padding-top:1.5rem;">
        <label class="toggle">
          <input type="checkbox" name="is_active" value="1"
                 {{ old('is_active', $post->is_active ?? true) ? 'checked' : '' }}>
          <span class="toggle-slider"></span>
        </label>
        <span style="font-size:.85rem;color:var(--muted);">Published / Visible</span>
      </div>
    </div>
  </div>

  {{-- SEO --}}
  <div class="card">
    <div class="card-header"><span class="card-title">🔍 SEO Meta (optional override)</span></div>
    <div class="lang-tabs-wrap">
      <div class="lang-tabs">
        <button type="button" class="lang-tab active" data-lang="seo-en">🇬🇧 English</button>
        <button type="button" class="lang-tab" data-lang="seo-ar">🇸🇦 العربية</button>
      </div>
      <div class="lang-panel active" data-lang="seo-en">
        <div class="form-group">
          <label>Meta Title (EN)</label>
          <input type="text" name="meta_title_en" value="{{ old('meta_title_en', $post->meta_title_en) }}" maxlength="200"
                 placeholder="Defaults to post title if empty">
          <div class="hint">60 chars max for Google</div>
        </div>
        <div class="form-group">
          <label>Meta Description (EN)</label>
          <textarea name="meta_desc_en" rows="2" placeholder="Defaults to excerpt if empty">{{ old('meta_desc_en', $post->meta_desc_en) }}</textarea>
          <div class="hint">160 chars max for Google</div>
        </div>
      </div>
      <div class="lang-panel" data-lang="seo-ar">
        <div class="form-group">
          <label>عنوان السيو (AR)</label>
          <input type="text" name="meta_title_ar" value="{{ old('meta_title_ar', $post->meta_title_ar) }}" dir="rtl" maxlength="200">
        </div>
        <div class="form-group">
          <label>وصف السيو (AR)</label>
          <textarea name="meta_desc_ar" rows="2" dir="rtl">{{ old('meta_desc_ar', $post->meta_desc_ar) }}</textarea>
        </div>
      </div>
    </div>
  </div>

  <div style="display:flex;gap:1rem;">
    <button type="submit" class="btn btn-gold">
      💾 {{ $post->exists ? 'Update Post' : 'Publish Post' }}
    </button>
    <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline">Cancel</a>
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
