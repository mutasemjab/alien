@extends('layouts.admin')
@section('page-title', 'Job Positions')
@section('content')

<div class="table-toolbar">
  <h2 style="font-family:'Orbitron',sans-serif;font-size:1.1rem;color:var(--white);">Job Positions</h2>
  <a href="{{ route('admin.job-positions.create') }}" class="btn btn-gold">➕ Add Position</a>
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
          <th>Title (EN / AR)</th>
          <th>Department</th>
          <th>Location</th>
          <th>Type</th>
          <th>Apps</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($positions as $p)
        <tr>
          <td>{{ $p->sort_order ?: $p->id }}</td>
          <td>
            <strong style="color:var(--white);">{{ $p->title_en }}</strong><br>
            <span style="color:var(--muted);font-size:.8rem;direction:rtl;display:block;">{{ $p->title_ar }}</span>
          </td>
          <td style="color:var(--gold);font-size:.82rem;">{{ $p->department_en }}</td>
          <td style="color:var(--muted);font-size:.82rem;">{{ $p->location_en }}</td>
          <td>
            <span style="background:{{ $p->type_color }}0.12);border:1px solid {{ $p->type_color }}0.4);border-radius:50px;padding:.2rem .7rem;font-size:.7rem;font-family:'Orbitron',sans-serif;color:{{ $p->type_color }}0.9);">
              {{ $p->type_label }}
            </span>
          </td>
          <td style="color:var(--muted);font-size:.82rem;">{{ $p->applications()->count() }}</td>
          <td>
            <span class="badge {{ $p->is_active ? 'badge-active' : 'badge-inactive' }}">
              {{ $p->is_active ? 'Active' : 'Hidden' }}
            </span>
          </td>
          <td>
            <div style="display:flex;gap:.5rem;">
              <a href="{{ route('admin.job-positions.edit', $p) }}" class="btn btn-outline btn-sm">✏️ Edit</a>
              <form method="POST" action="{{ route('admin.job-positions.destroy', $p) }}" style="display:inline;">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" data-confirm="Delete this position?">🗑️</button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="8" style="text-align:center;color:var(--muted);padding:2rem;">
            No positions yet. <a href="{{ route('admin.job-positions.create') }}" style="color:var(--gold);">Add your first →</a>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
@push('scripts')
<script>document.querySelectorAll('[data-confirm]').forEach(b=>b.addEventListener('click',e=>{if(!confirm(b.dataset.confirm))e.preventDefault();}));</script>
@endpush
