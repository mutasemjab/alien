@extends('layouts.admin')
@section('page-title', $position->exists ? 'Edit Position' : 'New Position')
@section('content')

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;">
  <h2 style="font-family:'Orbitron',sans-serif;font-size:1.1rem;color:var(--white);">
    {{ $position->exists ? 'Edit Position' : 'New Job Position' }}
  </h2>
  <a href="{{ route('admin.job-positions.index') }}" class="btn btn-outline">← Back</a>
</div>

<form method="POST"
      action="{{ $position->exists ? route('admin.job-positions.update', $position) : route('admin.job-positions.store') }}">
  @csrf
  @if($position->exists) @method('PUT') @endif

  <div class="card">
    <div class="card-header"><span class="card-title">📋 Position Details</span></div>

    <div class="lang-tabs-wrap">
      <div class="lang-tabs">
        <button type="button" class="lang-tab active" data-lang="en">🇬🇧 English</button>
        <button type="button" class="lang-tab" data-lang="ar">🇸🇦 العربية</button>
      </div>

      <div class="lang-panel active" data-lang="en">
        <div class="form-grid">
          <div class="form-group">
            <label>Job Title (English) *</label>
            <input type="text" name="title_en" value="{{ old('title_en', $position->title_en) }}" required maxlength="200">
            @error('title_en')<div class="error-msg">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label>Department (EN)</label>
            <input type="text" name="department_en" value="{{ old('department_en', $position->department_en) }}" placeholder="Engineering, Design, Marketing…">
          </div>
          <div class="form-group">
            <label>Location (EN)</label>
            <input type="text" name="location_en" value="{{ old('location_en', $position->location_en) }}" placeholder="Amman, Remote, Dubai…">
          </div>
          <div class="form-group full">
            <label>Description (EN)</label>
            <textarea name="description_en" rows="3">{{ old('description_en', $position->description_en) }}</textarea>
          </div>
          <div class="form-group full">
            <label>Requirements (EN)</label>
            <textarea name="requirements_en" rows="4" placeholder="• 3+ years experience&#10;• Strong communication skills">{{ old('requirements_en', $position->requirements_en) }}</textarea>
          </div>
        </div>
      </div>

      <div class="lang-panel" data-lang="ar">
        <div class="form-grid">
          <div class="form-group">
            <label>المسمى الوظيفي (Arabic)</label>
            <input type="text" name="title_ar" value="{{ old('title_ar', $position->title_ar) }}" dir="rtl">
          </div>
          <div class="form-group">
            <label>القسم (Department AR)</label>
            <input type="text" name="department_ar" value="{{ old('department_ar', $position->department_ar) }}" dir="rtl">
          </div>
          <div class="form-group">
            <label>الموقع (Location AR)</label>
            <input type="text" name="location_ar" value="{{ old('location_ar', $position->location_ar) }}" dir="rtl">
          </div>
          <div class="form-group full">
            <label>الوصف (Description AR)</label>
            <textarea name="description_ar" rows="3" dir="rtl">{{ old('description_ar', $position->description_ar) }}</textarea>
          </div>
          <div class="form-group full">
            <label>المتطلبات (Requirements AR)</label>
            <textarea name="requirements_ar" rows="4" dir="rtl">{{ old('requirements_ar', $position->requirements_ar) }}</textarea>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header"><span class="card-title">⚙️ Settings</span></div>
    <div class="form-grid">
      <div class="form-group">
        <label>Employment Type</label>
        <select name="type">
          @foreach(['full-time' => 'Full-time', 'part-time' => 'Part-time', 'remote' => 'Remote', 'hybrid' => 'Hybrid', 'internship' => 'Internship', 'contract' => 'Contract'] as $val => $label)
            <option value="{{ $val }}" {{ old('type', $position->type) === $val ? 'selected' : '' }}>{{ $label }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label>Sort Order</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $position->sort_order ?? 0) }}" min="0">
      </div>
      <div class="form-group" style="display:flex;align-items:center;gap:1rem;padding-top:1.5rem;">
        <label class="toggle">
          <input type="checkbox" name="is_active" value="1" {{ old('is_active', $position->is_active ?? true) ? 'checked' : '' }}>
          <span class="toggle-slider"></span>
        </label>
        <span style="font-size:.85rem;color:var(--muted);">Show on website</span>
      </div>
    </div>
  </div>

  <div style="display:flex;gap:1rem;">
    <button type="submit" class="btn btn-gold">💾 {{ $position->exists ? 'Update' : 'Create Position' }}</button>
    <a href="{{ route('admin.job-positions.index') }}" class="btn btn-outline">Cancel</a>
  </div>
</form>
@endsection
