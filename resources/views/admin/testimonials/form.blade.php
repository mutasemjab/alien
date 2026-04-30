@extends('layouts.admin')
@section('page-title', $testimonial->exists ? 'Edit Testimonial' : 'New Testimonial')
@section('content')

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;">
  <h2 style="font-family:'Orbitron',sans-serif;font-size:1.1rem;color:var(--white);">
    {{ $testimonial->exists ? 'Edit Testimonial' : 'New Testimonial' }}
  </h2>
  <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline">← Back</a>
</div>

<form method="POST"
      action="{{ $testimonial->exists ? route('admin.testimonials.update', $testimonial) : route('admin.testimonials.store') }}">
  @csrf
  @if($testimonial->exists) @method('PUT') @endif

  <div class="card">
    <div class="card-header"><span class="card-title">Author Information</span></div>

    <div class="form-grid cols3">
      <div class="form-group">
        <label>Company</label>
        <input type="text" name="author_company"
               value="{{ old('author_company', $testimonial->author_company) }}"
               required maxlength="100" placeholder="NovaTrade Inc.">
        @error('author_company') <div class="error-msg">{{ $message }}</div> @enderror
      </div>
      <div class="form-group">
        <label>Sort Order</label>
        <input type="number" name="sort_order"
               value="{{ old('sort_order', $testimonial->sort_order ?? 0) }}" min="0">
      </div>
      <div class="form-group">
        <label>Rating</label>
        <div class="star-select" id="starSelect">
          @for($i = 5; $i >= 1; $i--)
            <input type="radio" name="rating" id="star{{ $i }}" value="{{ $i }}"
                   {{ old('rating', $testimonial->rating ?? 5) == $i ? 'checked' : '' }}>
            <label for="star{{ $i }}">★</label>
          @endfor
        </div>
      </div>
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
            <label>Author Name (English)</label>
            <input type="text" name="author_name_en"
                   value="{{ old('author_name_en', $testimonial->author_name_en) }}"
                   required maxlength="100" placeholder="James Rodriguez">
            @error('author_name_en') <div class="error-msg">{{ $message }}</div> @enderror
          </div>
          <div class="form-group">
            <label>Role / Title (English)</label>
            <input type="text" name="author_role_en"
                   value="{{ old('author_role_en', $testimonial->author_role_en) }}"
                   required maxlength="100" placeholder="CTO, NovaTrade Inc.">
            @error('author_role_en') <div class="error-msg">{{ $message }}</div> @enderror
          </div>
          <div class="form-group full">
            <label>Quote (English)</label>
            <textarea name="quote_en" rows="4" required
                      placeholder="What did they say about working with Alien Code?">{{ old('quote_en', $testimonial->quote_en) }}</textarea>
            @error('quote_en') <div class="error-msg">{{ $message }}</div> @enderror
          </div>
        </div>
      </div>

      <div class="lang-panel" data-lang="ar">
        <div class="form-grid">
          <div class="form-group">
            <label>اسم المؤلف (Arabic Name)</label>
            <input type="text" name="author_name_ar"
                   value="{{ old('author_name_ar', $testimonial->author_name_ar) }}"
                   dir="rtl" required maxlength="100">
            @error('author_name_ar') <div class="error-msg">{{ $message }}</div> @enderror
          </div>
          <div class="form-group">
            <label>المسمى الوظيفي (Arabic Role)</label>
            <input type="text" name="author_role_ar"
                   value="{{ old('author_role_ar', $testimonial->author_role_ar) }}"
                   dir="rtl" required maxlength="100">
            @error('author_role_ar') <div class="error-msg">{{ $message }}</div> @enderror
          </div>
          <div class="form-group full">
            <label>الاقتباس (Arabic Quote)</label>
            <textarea name="quote_ar" rows="4" dir="rtl" required>{{ old('quote_ar', $testimonial->quote_ar) }}</textarea>
            @error('quote_ar') <div class="error-msg">{{ $message }}</div> @enderror
          </div>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label>Status</label>
      <div class="toggle-wrap">
        <label class="toggle">
          <input type="checkbox" name="is_active" value="1"
                 {{ old('is_active', $testimonial->is_active ?? true) ? 'checked' : '' }}>
          <span class="toggle-slider"></span>
        </label>
        <span style="font-size:.85rem;color:var(--muted);">Show on website</span>
      </div>
    </div>
  </div>

  <div style="display:flex;gap:1rem;">
    <button type="submit" class="btn btn-gold">
      💾 {{ $testimonial->exists ? 'Update Testimonial' : 'Add Testimonial' }}
    </button>
    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline">Cancel</a>
  </div>
</form>
@endsection
