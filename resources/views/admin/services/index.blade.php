{{-- resources/views/admin/services/index.blade.php --}}
@extends('layouts.admin')
@section('page-title', 'Services')
@section('content')
<div class="table-toolbar">
  <h2 style="font-family:'Orbitron',sans-serif;font-size:1.1rem;color:var(--white);">Services</h2>
  <a href="{{ route('admin.services.create') }}" class="btn btn-gold">➕ Add Service</a>
</div>

<div class="card">
  <div class="table-wrap">
    <table id="servicesTable">
      <thead>
        <tr>
          <th style="width:40px;">⣿</th>
          <th>#</th>
          <th>Icon</th>
          <th>Title (EN / AR)</th>
          <th>Tags</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody id="sortable">
        @foreach($services as $s)
        <tr data-id="{{ $s->id }}">
          <td><span class="drag-handle">⣿</span></td>
          <td>{{ $s->sort_order }}</td>
          <td style="font-size:1.5rem;">{{ $s->icon }}</td>
          <td>
            <strong style="color:var(--white);">{{ $s->title_en }}</strong><br>
            <span style="color:var(--muted);font-size:.8rem;direction:rtl;display:block;">{{ $s->title_ar }}</span>
          </td>
          <td>
            @foreach($s->tags ?? [] as $tag)
              <span style="background:rgba(245,168,0,.08);border:1px solid rgba(245,168,0,.15);border-radius:50px;padding:.1rem .5rem;font-size:.7rem;color:var(--gold);margin-right:.2rem;">{{ $tag }}</span>
            @endforeach
          </td>
          <td>
            <span class="badge {{ $s->is_active ? 'badge-active' : 'badge-inactive' }}">
              {{ $s->is_active ? 'Active' : 'Hidden' }}
            </span>
          </td>
          <td>
            <div style="display:flex;gap:.5rem;">
              <a href="{{ route('admin.services.edit', $s) }}" class="btn btn-outline btn-sm">✏️ Edit</a>
              <form method="POST" action="{{ route('admin.services.destroy', $s) }}" style="display:inline;">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" data-confirm="Delete this service?">🗑️</button>
              </form>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
@push('scripts')
<script>
// Simple drag-to-reorder via SortableJS (include in layout or use native drag)
document.querySelectorAll('[data-confirm]').forEach(b =>
  b.addEventListener('click', e => { if(!confirm(b.dataset.confirm)) e.preventDefault(); })
);
</script>
@endpush
