{{-- resources/views/admin/testimonials/index.blade.php --}}
@extends('layouts.admin')
@section('page-title', 'Testimonials')
@section('content')

<div class="table-toolbar">
  <h2 style="font-family:'Orbitron',sans-serif;font-size:1.1rem;color:var(--white);">Testimonials</h2>
  <a href="{{ route('admin.testimonials.create') }}" class="btn btn-gold">➕ Add Testimonial</a>
</div>

<div class="card">
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Author</th>
          <th>Company</th>
          <th>Quote (EN)</th>
          <th>Rating</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($testimonials as $t)
        <tr>
          <td>{{ $t->sort_order }}</td>
          <td>
            <div style="display:flex;align-items:center;gap:.6rem;">
              <div style="width:34px;height:34px;border-radius:50%;background:linear-gradient(135deg,#f5a800,#ffcc44);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.78rem;color:#0a0714;flex-shrink:0;">
                {{ $t->initials }}
              </div>
              <div>
                <div style="font-weight:600;font-size:.88rem;color:var(--white);">{{ $t->author_name_en }}</div>
                <div style="font-size:.75rem;color:var(--muted);">{{ $t->author_role_en }}</div>
              </div>
            </div>
          </td>
          <td style="font-size:.85rem;">{{ $t->author_company }}</td>
          <td style="font-size:.8rem;color:var(--muted);max-width:260px;">
            <span style="font-style:italic;">"{{ Str::limit($t->quote_en, 80) }}"</span>
          </td>
          <td style="color:#f5a800;">{{ str_repeat('★', $t->rating) }}{{ str_repeat('☆', 5 - $t->rating) }}</td>
          <td>
            <span class="badge {{ $t->is_active ? 'badge-active' : 'badge-inactive' }}">
              {{ $t->is_active ? 'Active' : 'Hidden' }}
            </span>
          </td>
          <td>
            <div style="display:flex;gap:.5rem;">
              <a href="{{ route('admin.testimonials.edit', $t) }}" class="btn btn-outline btn-sm">✏️</a>
              <form method="POST" action="{{ route('admin.testimonials.destroy', $t) }}">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm"
                        data-confirm="Delete testimonial from {{ $t->author_name_en }}?">🗑️</button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="7" style="text-align:center;color:var(--muted);padding:2rem;">No testimonials yet.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
