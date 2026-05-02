@extends('layouts.admin')
@section('page-title', 'Job Applications')
@section('content')

<div class="table-toolbar">
  <h2 style="font-family:'Orbitron',sans-serif;font-size:1.1rem;color:var(--white);">
    Job Applications
    <span style="font-size:.78rem;color:var(--muted);font-family:monospace;margin-left:.8rem;">{{ $applications->total() }} total</span>
  </h2>
  {{-- Status filter --}}
  <form method="GET" style="display:flex;gap:.5rem;align-items:center;">
    <select name="status" onchange="this.form.submit()" style="background:rgba(31,22,48,.8);border:1px solid rgba(245,168,0,.2);border-radius:6px;padding:.4rem .8rem;color:var(--text);font-size:.82rem;">
      <option value="">All Status</option>
      @foreach(['new'=>'🆕 New','reviewing'=>'👁 Reviewing','shortlisted'=>'⭐ Shortlisted','rejected'=>'❌ Rejected','hired'=>'✅ Hired'] as $val => $label)
        <option value="{{ $val }}" {{ request('status') === $val ? 'selected' : '' }}>{{ $label }}</option>
      @endforeach
    </select>
  </form>
</div>

@if(session('success'))
  <div style="background:rgba(34,197,94,.1);border:1px solid rgba(34,197,94,.3);color:#4ade80;padding:.85rem 1rem;border-radius:8px;margin-bottom:1rem;font-size:.88rem;">✅ {{ session('success') }}</div>
@endif

<div class="card">
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Applicant</th>
          <th>Position</th>
          <th>Heard Via</th>
          <th>Resume</th>
          <th>Applied</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($applications as $app)
        <tr>
          <td>{{ $app->id }}</td>
          <td>
            <strong style="color:var(--white);">{{ $app->full_name }}</strong><br>
            <span style="color:var(--muted);font-size:.78rem;">{{ $app->email }}</span><br>
            <span style="color:var(--muted);font-size:.78rem;">{{ $app->phone }}</span>
          </td>
          <td style="color:var(--gold);font-size:.82rem;">{{ $app->position }}</td>
          <td style="color:var(--muted);font-size:.78rem;">{{ $app->hear_about_us }}</td>
          <td>
            @if($app->resume)
              <a href="{{ $app->resume_url }}" target="_blank" class="btn btn-outline btn-sm">📄 Download</a>
            @else
              <span style="color:var(--muted);font-size:.78rem;">—</span>
            @endif
          </td>
          <td style="color:var(--muted);font-size:.78rem;">{{ $app->created_at->format('d M Y') }}</td>
          <td>
            <span style="background:{{ $app->status_color }}22;border:1px solid {{ $app->status_color }}66;color:{{ $app->status_color }};border-radius:50px;padding:.2rem .7rem;font-size:.7rem;">
              {{ $app->status_label }}
            </span>
          </td>
          <td>
            <div style="display:flex;gap:.5rem;">
              <a href="{{ route('admin.job-applications.show', $app) }}" class="btn btn-outline btn-sm">👁 View</a>
              <form method="POST" action="{{ route('admin.job-applications.destroy', $app) }}" style="display:inline;">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" data-confirm="Delete this application?">🗑️</button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="8" style="text-align:center;color:var(--muted);padding:2rem;">No applications yet.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
  @if($applications->hasPages())
    <div style="padding:1rem;">{{ $applications->links() }}</div>
  @endif
</div>
@endsection
@push('scripts')
<script>document.querySelectorAll('[data-confirm]').forEach(b=>b.addEventListener('click',e=>{if(!confirm(b.dataset.confirm))e.preventDefault();}));</script>
@endpush
