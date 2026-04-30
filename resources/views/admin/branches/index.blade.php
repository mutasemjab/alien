{{-- resources/views/admin/branches/index.blade.php --}}
@extends('layouts.admin')
@section('page-title', 'Branches')
@section('content')

<div class="table-toolbar">
  <h2 style="font-family:'Orbitron',sans-serif;font-size:1.1rem;color:var(--white);">Branches / Offices</h2>
  <a href="{{ route('admin.branches.create') }}" class="btn btn-gold">➕ Add Branch</a>
</div>

<div class="card">
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Flag</th>
          <th>City (EN / AR)</th>
          <th>Country</th>
          <th>Label</th>
          <th>Phone</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($branches as $b)
        <tr>
          <td>{{ $b->sort_order }}</td>
          <td style="font-size:1.8rem;">{{ $b->flag_emoji }}</td>
          <td>
            <strong style="color:var(--white);">{{ $b->city_en }}</strong><br>
            <span style="color:var(--muted);font-size:.8rem;direction:rtl;display:block;">{{ $b->city_ar }}</span>
          </td>
          <td style="font-size:.85rem;">
            {{ $b->country_en }}<br>
            <span style="color:var(--muted);font-size:.78rem;direction:rtl;display:block;">{{ $b->country_ar }}</span>
          </td>
          <td>
            @if($b->label_en)
              <span style="background:rgba(245,168,0,.1);border:1px solid rgba(245,168,0,.2);border-radius:4px;padding:.15rem .5rem;font-size:.7rem;color:var(--gold);">
                {{ $b->label_en }}
              </span>
            @else
              <span style="color:var(--muted);">—</span>
            @endif
          </td>
          <td style="font-size:.82rem;color:var(--muted);">{{ $b->phone ?? '—' }}</td>
          <td>
            <span class="badge {{ $b->is_active ? 'badge-active' : 'badge-inactive' }}">
              {{ $b->is_active ? 'Active' : 'Hidden' }}
            </span>
          </td>
          <td>
            <div style="display:flex;gap:.5rem;">
              <a href="{{ route('admin.branches.edit', $b) }}" class="btn btn-outline btn-sm">✏️</a>
              <form method="POST" action="{{ route('admin.branches.destroy', $b) }}">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm"
                        data-confirm="Delete {{ $b->city_en }} branch?">🗑️</button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="8" style="text-align:center;color:var(--muted);padding:2rem;">No branches yet.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
