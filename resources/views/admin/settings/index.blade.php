@extends('layouts.admin')
@section('page-title', 'Site Settings')
@section('content')

<div style="margin-bottom:1.5rem;">
  <h2 style="font-family:'Orbitron',sans-serif;font-size:1.1rem;color:var(--white);">Site Settings</h2>
</div>

<form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
  @csrf

  {{-- GENERAL --}}
  <div class="card">
    <div class="card-header"><span class="card-title">🌐 General</span></div>
    <div class="form-grid">
      <div class="form-group">
        <label>Site Name (English)</label>
        <input type="text" name="settings[site_name_en]"
               value="{{ old('settings.site_name_en', \App\Models\Setting::getValue('site_name_en', 'Alien Code')) }}">
      </div>
      <div class="form-group">
        <label>Site Name (Arabic) — اسم الموقع</label>
        <input type="text" name="settings[site_name_ar]"
               value="{{ old('settings.site_name_ar', \App\Models\Setting::getValue('site_name_ar', 'ألين كود')) }}"
               dir="rtl">
      </div>
      <div class="form-group full">
        <label>Site Logo</label>
        @php $logo = \App\Models\Setting::getValue('logo'); @endphp
        @if($logo)
          <div style="margin-bottom:.8rem;">
            <img src="{{ asset('assets/admin/uploads/'.$logo) }}" style="height:44px;filter:drop-shadow(0 0 8px rgba(245,168,0,.4));">
          </div>
        @endif
        <div class="img-upload-wrap" style="position:relative;display:inline-block;">
          <button type="button" class="btn btn-outline btn-sm">📁 Upload Logo</button>
          <input type="file" name="settings_logo" accept="image/*">
        </div>
        <div class="hint">WebP or PNG, transparent background preferred</div>
      </div>
    </div>
  </div>

  {{-- SEO --}}
  <div class="card">
    <div class="card-header"><span class="card-title">🔍 SEO & Meta</span></div>
    <div class="lang-tabs-wrap">
      <div class="lang-tabs">
        <button type="button" class="lang-tab active" data-lang="en">🇬🇧 English</button>
        <button type="button" class="lang-tab" data-lang="ar">🇸🇦 العربية</button>
      </div>
      <div class="lang-panel active" data-lang="en">
        <div class="form-group">
          <label>Meta Title (EN)</label>
          <input type="text" name="settings[meta_title_en]"
                 value="{{ \App\Models\Setting::getValue('meta_title_en', 'Alien Code — Next-Gen Software') }}">
        </div>
        <div class="form-group">
          <label>Meta Description (EN)</label>
          <textarea name="settings[meta_desc_en]" rows="2">{{ \App\Models\Setting::getValue('meta_desc_en') }}</textarea>
        </div>
      </div>
      <div class="lang-panel" data-lang="ar">
        <div class="form-group">
          <label>عنوان الصفحة (AR Meta Title)</label>
          <input type="text" name="settings[meta_title_ar]"
                 value="{{ \App\Models\Setting::getValue('meta_title_ar', 'ألين كود — برمجيات الجيل القادم') }}"
                 dir="rtl">
        </div>
        <div class="form-group">
          <label>وصف الصفحة (AR Meta Description)</label>
          <textarea name="settings[meta_desc_ar]" rows="2" dir="rtl">{{ \App\Models\Setting::getValue('meta_desc_ar') }}</textarea>
        </div>
      </div>
    </div>
  </div>

  {{-- CONTACT --}}
  <div class="card">
    <div class="card-header"><span class="card-title">📞 Contact Information</span></div>
    <div class="form-grid">
      <div class="form-group">
        <label>Contact Email</label>
        <input type="email" name="settings[contact_email]"
               value="{{ \App\Models\Setting::getValue('contact_email', 'hello@alien-code.io') }}">
      </div>
      <div class="form-group">
        <label>Support Phone</label>
        <input type="text" name="settings[contact_phone]"
               value="{{ \App\Models\Setting::getValue('contact_phone') }}">
      </div>
      <div class="form-group">
        <label>WhatsApp Number (with country code)</label>
        <input type="text" name="settings[whatsapp]"
               value="{{ \App\Models\Setting::getValue('whatsapp') }}"
               placeholder="962600000000">
      </div>
    </div>
  </div>

  {{-- SOCIAL --}}
  <div class="card">
    <div class="card-header"><span class="card-title">📱 Social Media</span></div>
    <div class="form-grid">
      @foreach(['linkedin' => 'LinkedIn', 'facebook' => 'facebook', 'instagram' => 'instagram'] as $key => $label)
      <div class="form-group">
        <label>{{ $label }}</label>
        <input type="url" name="settings[{{ $key }}]"
               value="{{ \App\Models\Setting::getValue($key) }}"
               placeholder="https://...">
      </div>
      @endforeach
    </div>
  </div>

  {{-- ABOUT SECTION TEXT --}}
  <div class="card">
    <div class="card-header"><span class="card-title">ℹ️ About Section Text</span></div>
    <div class="lang-tabs-wrap">
      <div class="lang-tabs">
        <button type="button" class="lang-tab active" data-lang="en">🇬🇧 English</button>
        <button type="button" class="lang-tab" data-lang="ar">🇸🇦 العربية</button>
      </div>
      <div class="lang-panel active" data-lang="en">
        <div class="form-group">
          <label>About Title (EN)</label>
          <input type="text" name="settings[about_title_en]"
                 value="{{ \App\Models\Setting::getValue('about_title_en', 'We Don\'t Write Code. We Write the Future.') }}">
        </div>
        <div class="form-group">
          <label>About Description (EN)</label>
          <textarea name="settings[about_desc_en]" rows="3">{{ \App\Models\Setting::getValue('about_desc_en') }}</textarea>
        </div>
      </div>
      <div class="lang-panel" data-lang="ar">
        <div class="form-group">
          <label>عنوان قسم من نحن (AR)</label>
          <input type="text" name="settings[about_title_ar]"
                 value="{{ \App\Models\Setting::getValue('about_title_ar') }}"
                 dir="rtl">
        </div>
        <div class="form-group">
          <label>وصف قسم من نحن (AR)</label>
          <textarea name="settings[about_desc_ar]" rows="3" dir="rtl">{{ \App\Models\Setting::getValue('about_desc_ar') }}</textarea>
        </div>
      </div>
    </div>
  </div>

  <div style="display:flex;gap:1rem;">
    <button type="submit" class="btn btn-gold">💾 Save All Settings</button>
  </div>
</form>
@endsection
