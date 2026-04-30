{{-- resources/views/admin/clients/index.blade.php --}}
@extends('layouts.admin')
@section('page-title', 'Clients')
@section('content')

<div class="table-toolbar">
  <h2 style="font-family:'Orbitron',sans-serif;font-size:1.1rem;color:var(--white);">Clients</h2>
  <a href="{{ route('admin.clients.create') }}" class="btn btn-gold">➕ Add Client</a>
</div>

<div class="card">
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Logo</th>
          <th>Name</th>
          <th>Website</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($clients as $client)
        <tr>
          <td>{{ $client->sort_order }}</td>
          <td>
            @if($client->logo)
              <img src="{{ $client->logo_url }}" class="img-preview" alt="{{ $client->name }}">
            @else
              <div style="width:80px;height:40px;background:rgba(245,168,0,.05);border:1px solid rgba(245,168,0,.1);border-radius:4px;display:flex;align-items:center;justify-content:center;font-size:.65rem;color:var(--muted);">No logo</div>
            @endif
          </td>
          <td style="font-weight:600;color:var(--white);">{{ $client->name }}</td>
          <td>
            @if($client->website_url)
              <a href="{{ $client->website_url }}" target="_blank" style="color:var(--gold);font-size:.8rem;">
                🔗 {{ parse_url($client->website_url, PHP_URL_HOST) }}
              </a>
            @else
              <span style="color:var(--muted);font-size:.8rem;">—</span>
            @endif
          </td>
          <td>
            <span class="badge {{ $client->is_active ? 'badge-active' : 'badge-inactive' }}">
              {{ $client->is_active ? 'Active' : 'Hidden' }}
            </span>
          </td>
          <td>
            <div style="display:flex;gap:.5rem;">
              <a href="{{ route('admin.clients.edit', $client) }}" class="btn btn-outline btn-sm">✏️ Edit</a>
              <form method="POST" action="{{ route('admin.clients.destroy', $client) }}">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" data-confirm="Delete {{ $client->name }}?">🗑️</button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="6" style="text-align:center;color:var(--muted);padding:2rem;">No clients yet. <a href="{{ route('admin.clients.create') }}" style="color:var(--gold);">Add one.</a></td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
