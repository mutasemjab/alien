@extends('layouts.admin')
@section('page-title', 'Dashboard')

@section('content')
<div class="stats-grid">
  <div class="stat-card">
    <div class="icon">🎯</div>
    <div class="num">1</div>
    <div class="lbl">Hero Section</div>
  </div>
  <div class="stat-card">
    <div class="icon">⚙️</div>
    <div class="num">{{ $stats['services'] }}</div>
    <div class="lbl">Services</div>
  </div>
  <div class="stat-card">
    <div class="icon">🖼️</div>
    <div class="num">{{ $stats['portfolio'] }}</div>
    <div class="lbl">Portfolio Items</div>
  </div>
  <div class="stat-card">
    <div class="icon">🤝</div>
    <div class="num">{{ $stats['clients'] }}</div>
    <div class="lbl">Clients</div>
  </div>
  <div class="stat-card">
    <div class="icon">🌍</div>
    <div class="num">{{ $stats['branches'] }}</div>
    <div class="lbl">Branches</div>
  </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;">
  <div class="card">
    <div class="card-header">
      <span class="card-title">Quick Actions</span>
    </div>
    <div style="display:flex;flex-direction:column;gap:.7rem;">
      <a href="{{ route('admin.hero.edit') }}" class="btn btn-outline">🎯 Edit Hero Section</a>
      <a href="{{ route('admin.services.create') }}" class="btn btn-outline">➕ Add Service</a>
      <a href="{{ route('admin.portfolio.create') }}" class="btn btn-outline">➕ Add Portfolio Item</a>
      <a href="{{ route('admin.testimonials.create') }}" class="btn btn-outline">➕ Add Testimonial</a>
      <a href="{{ route('admin.branches.create') }}" class="btn btn-outline">➕ Add Branch</a>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
      <span class="card-title">Site Overview</span>
    </div>
    <table>
      <tbody>
        <tr><td>Services Active</td><td><span class="badge badge-active">{{ \App\Models\Service::active()->count() }} Active</span></td></tr>
        <tr><td>Portfolio Items</td><td><span class="badge badge-active">{{ \App\Models\PortfolioItem::active()->count() }} Active</span></td></tr>
        <tr><td>Testimonials</td><td><span class="badge badge-active">{{ \App\Models\Testimonial::active()->count() }} Active</span></td></tr>
        <tr><td>Clients</td><td><span class="badge badge-active">{{ \App\Models\Client::active()->count() }} Active</span></td></tr>
        <tr><td>Branches</td><td><span class="badge badge-active">{{ \App\Models\Branch::active()->count() }} Active</span></td></tr>
      </tbody>
    </table>
    <div style="margin-top:1.5rem;">
      <a href="{{ url('/') }}" target="_blank" class="btn btn-gold">🌐 View Website Live</a>
    </div>
  </div>
</div>
@endsection
