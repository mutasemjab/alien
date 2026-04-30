<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', 'Admin') — Alien Code Dashboard</title>
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Exo+2:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/admin/css/mycustomstyle.css') }}">

</head>
<body>



{{-- MAIN --}}
<div class="main-wrap">
  <header class="topbar">
    <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
    <div class="topbar-right">
      <span class="topbar-user">👤 {{ auth()->user()->name ?? 'Admin' }}</span>
    </div>
  </header>

  <main class="content">
    @if(session('success'))
      <div class="alert alert-success">✅ {{ session('success') }}</div>
    @endif
    @if(session('error'))
      <div class="alert alert-error">❌ {{ session('error') }}</div>
    @endif
    @if($errors->any())
      <div class="alert alert-error">
        ❌ @foreach($errors->all() as $e) {{ $e }}<br> @endforeach
      </div>
    @endif

    @yield('content')
  </main>
</div>

@include('admin.includes.sidebar')

<script>
// Lang tabs
document.querySelectorAll('.lang-tab').forEach(tab => {
  tab.addEventListener('click', () => {
    const lang = tab.dataset.lang;
    const parent = tab.closest('.lang-tabs-wrap');
    parent.querySelectorAll('.lang-tab').forEach(t => t.classList.remove('active'));
    parent.querySelectorAll('.lang-panel').forEach(p => p.classList.remove('active'));
    tab.classList.add('active');
    parent.querySelector('.lang-panel[data-lang="'+lang+'"]').classList.add('active');
  });
});

// Confirm delete
document.querySelectorAll('[data-confirm]').forEach(btn => {
  btn.addEventListener('click', e => {
    if (!confirm(btn.dataset.confirm || 'Are you sure?')) e.preventDefault();
  });
});
</script>
@stack('scripts')
</body>
</html>
