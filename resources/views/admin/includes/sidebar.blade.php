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