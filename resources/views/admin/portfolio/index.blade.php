{{-- resources/views/admin/portfolio/index.blade.php --}}
@extends('layouts.admin')
@section('page-title', 'Portfolio')
@section('content')
<div class="table-toolbar">
  <h2 style="font-family:'Orbitron',sans-serif;font-size:1.1rem;color:var(--white);">Portfolio Items</h2>
  <a href="{{ route('admin.portfolio.create') }}" class="btn btn-gold">➕ Add Project</a>
</div>
<div class="card">
  <div class="table-wrap">
    <table>
      <thead><tr><th>#</th><th>Image</th><th>Title (EN / AR)</th><th>Category</th><th>Tags</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
        @foreach($items as $item)
        <tr>
          <td>{{ $item->sort_order }}</td>
          <td>
            @if($item->image)
              <img src="{{ $item->image_url }}" class="img-preview" alt="">
            @else
              <span style="color:var(--muted);font-size:.75rem;">No image</span>
            @endif
          </td>
          <td>
            <strong style="color:var(--white);">{{ $item->title_en }}</strong><br>
            <span style="color:var(--muted);font-size:.8rem;direction:rtl;display:block;">{{ $item->title_ar }}</span>
          </td>
          <td style="font-size:.8rem;">{{ $item->category_en }}<br><span style="color:var(--muted);direction:rtl;">{{ $item->category_ar }}</span></td>
          <td>@foreach($item->tags ?? [] as $t)<span style="background:rgba(245,168,0,.08);border:1px solid rgba(245,168,0,.15);border-radius:50px;padding:.1rem .4rem;font-size:.65rem;color:var(--gold);margin-right:.2rem;">{{ $t }}</span>@endforeach</td>
          <td><span class="badge {{ $item->is_active ? 'badge-active' : 'badge-inactive' }}">{{ $item->is_active ? 'Active' : 'Hidden' }}</span></td>
          <td>
            <div style="display:flex;gap:.5rem;">
              <a href="{{ route('admin.portfolio.edit', $item) }}" class="btn btn-outline btn-sm">✏️</a>
              <form method="POST" action="{{ route('admin.portfolio.destroy', $item) }}">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" data-confirm="Delete this project?">🗑️</button>
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
