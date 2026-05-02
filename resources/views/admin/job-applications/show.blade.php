@extends('layouts.admin')
@section('page-title', 'Application — '.$application->full_name)
@section('content')

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;">
  <h2 style="font-family:'Orbitron',sans-serif;font-size:1.1rem;color:var(--white);">Application Details</h2>
  <a href="{{ route('admin.job-applications.index') }}" class="btn btn-outline">← Back</a>
</div>

@if(session('success'))
  <div style="background:rgba(34,197,94,.1);border:1px solid rgba(34,197,94,.3);color:#4ade80;padding:.85rem 1rem;border-radius:8px;margin-bottom:1rem;font-size:.88rem;">✅ {{ session('success') }}</div>
@endif

<div style="display:grid;grid-template-columns:1fr 320px;gap:1.5rem;align-items:start;">

  {{-- Main info --}}
  <div>
    <div class="card">
      <div class="card-header"><span class="card-title">👤 Applicant Info</span></div>
      <div class="form-grid">
        @foreach(['Full Name' => $application->full_name, 'Email' => $application->email, 'Phone' => $application->phone, 'Applied For' => $application->position, 'Heard Via' => $application->hear_about_us, 'Applied On' => $application->created_at->format('d M Y — H:i')] as $label => $value)
        <div class="form-group">
          <label style="font-size:.72rem;color:var(--muted);text-transform:uppercase;letter-spacing:.1em;">{{ $label }}</label>
          <div style="color:var(--white);padding:.5rem 0;font-size:.9rem;border-bottom:1px solid rgba(245,168,0,.06);">{{ $value }}</div>
        </div>
        @endforeach
      </div>
    </div>

    @if($application->cover_letter)
    <div class="card" style="margin-top:1rem;">
      <div class="card-header"><span class="card-title">✉️ Cover Letter</span></div>
      <div style="color:rgba(255,255,255,.75);font-size:.88rem;line-height:1.8;white-space:pre-wrap;">{{ $application->cover_letter }}</div>
    </div>
    @endif

    @if($application->resume)
    <div class="card" style="margin-top:1rem;">
      <div class="card-header"><span class="card-title">📄 Resume</span></div>
      <a href="{{ $application->resume_url }}" target="_blank" class="btn btn-gold" style="display:inline-flex;align-items:center;gap:.5rem;">
        📥 Download Resume
      </a>
    </div>
    @endif
  </div>

  {{-- Status panel --}}
  <div class="card">
    <div class="card-header"><span class="card-title">⚙️ Status & Notes</span></div>
    <form method="POST" action="{{ route('admin.job-applications.update', $application) }}">
      @csrf @method('PUT')
      <div class="form-group">
        <label>Application Status</label>
        <select name="status" style="width:100%;">
          @foreach(['new'=>'🆕 New','reviewing'=>'👁 Reviewing','shortlisted'=>'⭐ Shortlisted','rejected'=>'❌ Rejected','hired'=>'✅ Hired'] as $val => $label)
            <option value="{{ $val }}" {{ $application->status === $val ? 'selected' : '' }}>{{ $label }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label>Internal Notes</label>
        <textarea name="notes" rows="5" placeholder="Private notes about this candidate…">{{ $application->notes }}</textarea>
      </div>
      <button type="submit" class="btn btn-gold" style="width:100%;justify-content:center;">💾 Save Changes</button>
    </form>
  </div>

</div>
@endsection
