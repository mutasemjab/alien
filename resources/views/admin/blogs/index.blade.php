@extends('layouts.admin')
@section('page-title', 'Blog Posts')
@section('content')

<div class="table-toolbar">
  <h2 style="font-family:'Orbitron',sans-serif;font-size:1.1rem;color:var(--white);">Blog Posts</h2>
  <a href="{{ route('admin.blogs.create') }}" class="btn btn-gold">➕ New Post</a>
</div>

@if(session('success'))
  <div style="background:rgba(34,197,94,.1);border:1px solid rgba(34,197,94,.3);color:#4ade80;padding:.85rem 1rem;border-radius:8px;margin-bottom:1rem;font-size:.88rem;">
    ✅ {{ session('success') }}
  </div>
@endif

<div class="card">
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Image</th>
          <th>Title (EN / AR)</th>
          <th>Category</th>
          <th>Author</th>
          <th>Published</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($posts as $post)
        <tr>
          <td>{{ $post->id }}</td>
          <td>
            @if($post->image)
              <img src="{{ $post->image_url }}" style="width:60px;height:40px;object-fit:cover;border-radius:4px;border:1px solid rgba(245,168,0,.2);">
            @else
              <div style="width:60px;height:40px;background:rgba(245,168,0,.05);border-radius:4px;border:1px solid rgba(245,168,0,.1);display:flex;align-items:center;justify-content:center;font-size:1.2rem;">✍️</div>
            @endif
          </td>
          <td>
            <strong style="color:var(--white);">{{ $post->title_en }}</strong><br>
            <span style="color:var(--muted);font-size:.8rem;direction:rtl;display:block;">{{ $post->title_ar }}</span>
            <span style="color:var(--muted);font-size:.72rem;font-family:'Orbitron',sans-serif;">/blog/{{ $post->slug }}</span>
          </td>
          <td><span style="color:var(--gold);font-size:.82rem;">{{ $post->category_en }}</span></td>
          <td style="color:var(--muted);font-size:.82rem;">{{ $post->author ?? '—' }}</td>
          <td style="color:var(--muted);font-size:.82rem;">{{ $post->published_at?->format('d M Y') }}</td>
          <td>
            <span class="badge {{ $post->is_active ? 'badge-active' : 'badge-inactive' }}">
              {{ $post->is_active ? 'Active' : 'Hidden' }}
            </span>
          </td>
          <td>
            <div style="display:flex;gap:.5rem;">
              <a href="{{ route('admin.blogs.edit', $post) }}" class="btn btn-outline btn-sm">✏️ Edit</a>
              <form method="POST" action="{{ route('admin.blogs.destroy', $post) }}" style="display:inline;">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" data-confirm="Delete this post?">🗑️</button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="8" style="text-align:center;color:var(--muted);padding:2rem;">
            No blog posts yet. <a href="{{ route('admin.blogs.create') }}" style="color:var(--gold);">Create your first post →</a>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
  @if($posts->hasPages())
    <div style="padding:1rem;">{{ $posts->links() }}</div>
  @endif
</div>

@endsection
@push('scripts')
<script>
document.querySelectorAll('[data-confirm]').forEach(b =>
  b.addEventListener('click', e => { if(!confirm(b.dataset.confirm)) e.preventDefault(); })
);
</script>
@endpush
