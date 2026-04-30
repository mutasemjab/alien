@extends('layouts.admin')
@section('page-title', $service->exists ? 'Edit Service' : 'New Service')
@section('content')

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;">
  <h2 style="font-family:'Orbitron',sans-serif;font-size:1.1rem;color:var(--white);">
    {{ $service->exists ? 'Edit Service' : 'New Service' }}
  </h2>
  <a href="{{ route('admin.services.index') }}" class="btn btn-outline">← Back</a>
</div>

<form method="POST" action="{{ $service->exists ? route('admin.services.update', $service) : route('admin.services.store') }}">
  @csrf
  @if($service->exists) @method('PUT') @endif

  <div class="card">
    <div class="card-header"><span class="card-title">Service Details</span></div>

    <div class="form-grid">
      <div class="form-group">
        <label>Icon (emoji)</label>
        <input type="text" name="icon" value="{{ old('icon', $service->icon) }}"
               placeholder="🌐" maxlength="10" required
               style="font-size:1.5rem;width:80px;">
        <div class="hint">Paste any emoji: 🌐 📱 🤖 ☁️ 🔗 🎨</div>
      </div>
      <div class="form-group">
        <label>Sort Order</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $service->sort_order ?? 0) }}" min="0" style="width:100px;">
      </div>
    </div>

    {{-- LANG TABS --}}
    <div class="lang-tabs-wrap">
      <div class="lang-tabs">
        <button type="button" class="lang-tab active" data-lang="en">🇬🇧 English</button>
        <button type="button" class="lang-tab" data-lang="ar">🇸🇦 العربية</button>
      </div>

      <div class="lang-panel active" data-lang="en">
        <div class="form-group">
          <label>Title (English)</label>
          <input type="text" name="title_en" value="{{ old('title_en', $service->title_en) }}" required maxlength="100">
          @error('title_en') <div class="error-msg">{{ $message }}</div> @enderror
        </div>
        <div class="form-group">
          <label>Description (English)</label>
          <textarea name="description_en" rows="4" required>{{ old('description_en', $service->description_en) }}</textarea>
          @error('description_en') <div class="error-msg">{{ $message }}</div> @enderror
        </div>
      </div>

      <div class="lang-panel" data-lang="ar">
        <div class="form-group">
          <label>العنوان (Arabic)</label>
          <input type="text" name="title_ar" value="{{ old('title_ar', $service->title_ar) }}" dir="rtl" required maxlength="100">
          @error('title_ar') <div class="error-msg">{{ $message }}</div> @enderror
        </div>
        <div class="form-group">
          <label>الوصف (Arabic Description)</label>
          <textarea name="description_ar" rows="4" dir="rtl" required>{{ old('description_ar', $service->description_ar) }}</textarea>
          @error('description_ar') <div class="error-msg">{{ $message }}</div> @enderror
        </div>
      </div>
    </div>

    <div class="form-group">
      <label>Tags (comma-separated)</label>
      <input type="text" name="tags" value="{{ old('tags', is_array($service->tags) ? implode(', ', $service->tags) : '') }}" placeholder="React, Next.js, Vue, TypeScript">
      <div class="hint">Separate tags with commas — shown as colored badges on website</div>
    </div>

    <div class="form-group">
      <label>Status</label>
      <div class="toggle-wrap">
        <label class="toggle">
          <input type="checkbox" name="is_active" value="1" {{ old('is_active', $service->is_active ?? true) ? 'checked' : '' }}>
          <span class="toggle-slider"></span>
        </label>
        <span style="font-size:.85rem;color:var(--muted);">Show on website</span>
      </div>
    </div>
  </div>

  <div style="display:flex;gap:1rem;">
    <button type="submit" class="btn btn-gold">
      💾 {{ $service->exists ? 'Update Service' : 'Create Service' }}
    </button>
    <a href="{{ route('admin.services.index') }}" class="btn btn-outline">Cancel</a>
  </div>
</form>
@endsection
