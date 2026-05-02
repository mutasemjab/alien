{{-- SIDEBAR --}}
<aside class="sidebar">
  <div class="sidebar-logo">
    <img src="{{ asset('images/logo.png') }}" alt="Alien Code">
    <span>Admin Dashboard</span>
  </div>

  <nav class="sidebar-nav">
    <div class="nav-group-label">Overview</div>
    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
      <span class="nav-icon">📊</span> Dashboard
    </a>

    <div class="nav-group-label">Content</div>
    <a href="{{ route('admin.hero.edit') }}" class="{{ request()->routeIs('admin.hero.*') ? 'active' : '' }}">
      <span class="nav-icon">🎯</span> Hero Section
    </a>
    <a href="{{ route('admin.services.index') }}" class="{{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
      <span class="nav-icon">⚙️</span> Services
    </a>
    <a href="{{ route('admin.portfolio.index') }}" class="{{ request()->routeIs('admin.portfolio.*') ? 'active' : '' }}">
      <span class="nav-icon">🖼️</span> Portfolio
    </a>
    <a href="{{ route('admin.clients.index') }}" class="{{ request()->routeIs('admin.clients.*') ? 'active' : '' }}">
      <span class="nav-icon">🤝</span> Clients
    </a>
    <a href="{{ route('admin.testimonials.index') }}" class="{{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
      <span class="nav-icon">💬</span> Testimonials
    </a>
    <a href="{{ route('admin.branches.index') }}" class="{{ request()->routeIs('admin.branches.*') ? 'active' : '' }}">
      <span class="nav-icon">🌍</span> Branches
    </a>

    <a href="{{ route('admin.blogs.index') }}" class="{{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
      <span class="nav-icon">✍️</span> Blog Posts
    </a>

    <div class="nav-group-label">Careers</div>
    <a href="{{ route('admin.job-positions.index') }}" class="{{ request()->routeIs('admin.job-positions.*') ? 'active' : '' }}">
      <span class="nav-icon">💼</span> Job Positions
    </a>
    <a href="{{ route('admin.job-applications.index') }}" class="{{ request()->routeIs('admin.job-applications.*') ? 'active' : '' }}">
      <span class="nav-icon">📬</span> Applications
      @php $newCount = \App\Models\JobApplication::where('status','new')->count(); @endphp
      @if($newCount)
        <span style="background:var(--gold);color:var(--dark);border-radius:50px;padding:.1rem .5rem;font-size:.65rem;font-weight:700;margin-left:.4rem;">{{ $newCount }}</span>
      @endif
    </a>

    <div class="nav-group-label">Configuration</div>
    <a href="{{ route('admin.settings.index') }}" class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
      <span class="nav-icon">🔧</span> Site Settings
    </a>
  </nav>

  <div class="sidebar-footer">
    <a href="{{ url('/') }}" target="_blank">
      <span>🌐</span> View Website
    </a>
    <br><br>
    <form method="POST" action="{{ route('admin.logout') }}" style="margin-top:.5rem;">
      @csrf
      <button type="submit" style="background:none;border:none;cursor:pointer;color:var(--muted);font-size:.82rem;display:flex;align-items:center;gap:.5rem;">
        <span>🚪</span> Logout
      </button>
    </form>
  </div>
</aside>