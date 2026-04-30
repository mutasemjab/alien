@extends('layouts.admin')
@section('page-title', $branch->exists ? 'Edit Branch' : 'New Branch')
@section('content')

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;">
  <h2 style="font-family:'Orbitron',sans-serif;font-size:1.1rem;color:var(--white);">
    {{ $branch->exists ? 'Edit Branch' : 'New Branch' }}
  </h2>
  <a href="{{ route('admin.branches.index') }}" class="btn btn-outline">← Back</a>
</div>

<form method="POST"
      action="{{ $branch->exists ? route('admin.branches.update', $branch) : route('admin.branches.store') }}">
  @csrf
  @if($branch->exists) @method('PUT') @endif

  <div class="card">
    <div class="card-header"><span class="card-title">Location Details</span></div>

    <div class="form-grid cols3">
      <div class="form-group">
        <label>Flag Emoji</label>
        <input type="text" name="flag_emoji"
               value="{{ old('flag_emoji', $branch->flag_emoji ?? '🏢') }}"
               maxlength="10" style="font-size:1.5rem;width:80px;">
        <div class="hint">e.g. 🇯🇴 🇦🇪 🇬🇧 🇺🇸</div>
      </div>
      <div class="form-group">
        <label>Label (EN) — optional</label>
        <input type="text" name="label_en"
               value="{{ old('label_en', $branch->label_en) }}"
               maxlength="40" placeholder="HQ, Regional Office...">
      </div>
      <div class="form-group">
        <label>Label (AR) — اختياري</label>
        <input type="text" name="label_ar"
               value="{{ old('label_ar', $branch->label_ar) }}"
               dir="rtl" maxlength="40" placeholder="المقر الرئيسي...">
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
            <label>City (English)</label>
            <input type="text" name="city_en"
                   value="{{ old('city_en', $branch->city_en) }}"
                   required maxlength="80" placeholder="Amman">
            @error('city_en') <div class="error-msg">{{ $message }}</div> @enderror
          </div>
          <div class="form-group">
            <label>Country (English)</label>
            <input type="text" name="country_en"
                   value="{{ old('country_en', $branch->country_en) }}"
                   required maxlength="80" placeholder="Jordan">
            @error('country_en') <div class="error-msg">{{ $message }}</div> @enderror
          </div>
          <div class="form-group full">
            <label>Address (English)</label>
            <input type="text" name="address_en"
                   value="{{ old('address_en', $branch->address_en) }}"
                   required maxlength="200" placeholder="King Abdullah II Street, Amman 11183">
            @error('address_en') <div class="error-msg">{{ $message }}</div> @enderror
          </div>
          <div class="form-group">
            <label>Working Hours (English)</label>
            <input type="text" name="working_hours_en"
                   value="{{ old('working_hours_en', $branch->working_hours_en) }}"
                   maxlength="100" placeholder="Sun–Thu: 9am–6pm AST">
          </div>
        </div>
      </div>

      <div class="lang-panel" data-lang="ar">
        <div class="form-grid">
          <div class="form-group">
            <label>المدينة (Arabic City)</label>
            <input type="text" name="city_ar"
                   value="{{ old('city_ar', $branch->city_ar) }}"
                   dir="rtl" required maxlength="80" placeholder="عمّان">
            @error('city_ar') <div class="error-msg">{{ $message }}</div> @enderror
          </div>
          <div class="form-group">
            <label>الدولة (Arabic Country)</label>
            <input type="text" name="country_ar"
                   value="{{ old('country_ar', $branch->country_ar) }}"
                   dir="rtl" required maxlength="80" placeholder="الأردن">
            @error('country_ar') <div class="error-msg">{{ $message }}</div> @enderror
          </div>
          <div class="form-group full">
            <label>العنوان (Arabic Address)</label>
            <input type="text" name="address_ar"
                   value="{{ old('address_ar', $branch->address_ar) }}"
                   dir="rtl" required maxlength="200">
            @error('address_ar') <div class="error-msg">{{ $message }}</div> @enderror
          </div>
          <div class="form-group">
            <label>ساعات العمل (Arabic Working Hours)</label>
            <input type="text" name="working_hours_ar"
                   value="{{ old('working_hours_ar', $branch->working_hours_ar) }}"
                   dir="rtl" maxlength="100" placeholder="الأحد–الخميس: 9ص–6م">
          </div>
        </div>
      </div>
    </div>

    {{-- CONTACT & MAP --}}
    <div class="form-grid">
      <div class="form-group">
        <label>Phone Number</label>
        <input type="text" name="phone"
               value="{{ old('phone', $branch->phone) }}"
               maxlength="30" placeholder="+962 6 500 0000">
      </div>
      <div class="form-group">
        <label>Email</label>
        <input type="email" name="email"
               value="{{ old('email', $branch->email) }}"
               maxlength="100" placeholder="amman@alien-code.io">
      </div>
      <div class="form-group">
        <label>Latitude</label>
        <input type="number" name="latitude"
               value="{{ old('latitude', $branch->latitude) }}"
               step="0.0000001" placeholder="31.9539">
        <div class="hint">For map pin — find on Google Maps</div>
      </div>
      <div class="form-group">
        <label>Longitude</label>
        <input type="number" name="longitude"
               value="{{ old('longitude', $branch->longitude) }}"
               step="0.0000001" placeholder="35.9106">
      </div>
      <div class="form-group">
        <label>Sort Order</label>
        <input type="number" name="sort_order"
               value="{{ old('sort_order', $branch->sort_order ?? 0) }}" min="0" style="width:100px;">
      </div>
    </div>

    <div class="form-group">
      <label>Status</label>
      <div class="toggle-wrap">
        <label class="toggle">
          <input type="checkbox" name="is_active" value="1"
                 {{ old('is_active', $branch->is_active ?? true) ? 'checked' : '' }}>
          <span class="toggle-slider"></span>
        </label>
        <span style="font-size:.85rem;color:var(--muted);">Show on website</span>
      </div>
    </div>
  </div>

  <div style="display:flex;gap:1rem;">
    <button type="submit" class="btn btn-gold">
      💾 {{ $branch->exists ? 'Update Branch' : 'Add Branch' }}
    </button>
    <a href="{{ route('admin.branches.index') }}" class="btn btn-outline">Cancel</a>
  </div>
</form>
@endsection
