@extends('layouts.admin')
@section('page-title', $client->exists ? 'Edit Client' : 'New Client')
@section('content')

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;">
  <h2 style="font-family:'Orbitron',sans-serif;font-size:1.1rem;color:var(--white);">
    {{ $client->exists ? 'Edit Client' : 'New Client' }}
  </h2>
  <a href="{{ route('admin.clients.index') }}" class="btn btn-outline">← Back</a>
</div>

<form method="POST"
      action="{{ $client->exists ? route('admin.clients.update', $client) : route('admin.clients.store') }}"
      enctype="multipart/form-data">
  @csrf
  @if($client->exists) @method('PUT') @endif

  <div class="card">
    <div class="card-header"><span class="card-title">Client Information</span></div>

    <div class="form-grid">
      <div class="form-group">
        <label>Client Name</label>
        <input type="text" name="name" value="{{ old('name', $client->name) }}" required maxlength="100" placeholder="NEXACORE">
        @error('name') <div class="error-msg">{{ $message }}</div> @enderror
      </div>
      <div class="form-group">
        <label>Website URL</label>
        <input type="url" name="website_url" value="{{ old('website_url', $client->website_url) }}" placeholder="https://...">
      </div>
      <div class="form-group">
        <label>Logo Image</label>
        @if($client->logo)
          <div style="margin-bottom:.8rem;">
            <img src="{{ $client->logo_url }}" style="height:60px;object-fit:contain;background:white;padding:6px;border-radius:6px;">
          </div>
        @endif
        <div class="img-upload-wrap" style="position:relative;display:inline-block;">
          <button type="button" class="btn btn-outline btn-sm">📁 Upload Logo</button>
          <input type="file" name="logo" accept="image/*" onchange="previewImg(this,'logoPreview')">
        </div>
        <div class="hint">Recommended: PNG with transparent background, max 2MB</div>
        <img id="logoPreview" src="" style="display:none;margin-top:.8rem;height:60px;object-fit:contain;background:white;padding:6px;border-radius:6px;">
      </div>
      <div class="form-group">
        <label>Sort Order</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $client->sort_order ?? 0) }}" min="0" style="width:100px;">
      </div>
    </div>

    <div class="form-group">
      <label>Status</label>
      <div class="toggle-wrap">
        <label class="toggle">
          <input type="checkbox" name="is_active" value="1"
                 {{ old('is_active', $client->is_active ?? true) ? 'checked' : '' }}>
          <span class="toggle-slider"></span>
        </label>
        <span style="font-size:.85rem;color:var(--muted);">Show in clients strip</span>
      </div>
    </div>
  </div>

  <div style="display:flex;gap:1rem;">
    <button type="submit" class="btn btn-gold">
      💾 {{ $client->exists ? 'Update Client' : 'Add Client' }}
    </button>
    <a href="{{ route('admin.clients.index') }}" class="btn btn-outline">Cancel</a>
  </div>
</form>

@push('scripts')
<script>
function previewImg(input, previewId) {
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = e => {
      const prev = document.getElementById(previewId);
      prev.src = e.target.result;
      prev.style.display = 'block';
    };
    reader.readAsDataURL(input.files[0]);
  }
}
</script>
@endpush
@endsection
