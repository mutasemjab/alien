{{-- resources/views/front/includes/navbar.blade.php --}}

<nav id="mainNav">

  {{-- Logo --}}
  <a href="{{ LaravelLocalization::localizeURL('/') }}" style="display:flex;align-items:center;flex-shrink:0;">
    @php $logoPath = \App\Models\Setting::getValue('logo'); @endphp
    @if($logoPath)
      <img src="{{ asset('assets/admin/uploads/' . $logoPath) }}"
           alt="{{ \App\Models\Setting::getValue('site_name_'.app()->getLocale(), 'Alien Code') }}">
    @else
      <img src="{{ asset('images/logo.png') }}" alt="Alien Code">
    @endif
  </a>

  {{-- Hamburger button (mobile only) --}}
  <button class="nav-toggle" id="navToggle" aria-label="Toggle menu" aria-expanded="false">
    <span></span>
    <span></span>
    <span></span>
  </button>

  {{-- Nav links --}}
  <ul id="navMenu">
    @php $currentRoute = \Illuminate\Support\Facades\Route::currentRouteName(); @endphp
    <li><a href="{{ \Illuminate\Support\Facades\Route::currentRouteName() === 'home' ? '#about' : route('home').'#about' }}">{{ __('front.nav_about') }}</a></li>
    <li><a href="{{ route('services') }}"  {{ $currentRoute === 'services'  ? 'aria-current="page"' : '' }}>{{ __('front.nav_services') }}</a></li>
    <li><a href="{{ route('portfolio') }}" {{ $currentRoute === 'portfolio' ? 'aria-current="page"' : '' }}>{{ __('front.nav_work') }}</a></li>
    <li><a href="{{ \Illuminate\Support\Facades\Route::currentRouteName() === 'home' ? '#clients' : route('home').'#clients' }}">{{ __('front.nav_clients') }}</a></li>
    <li><a href="{{ \Illuminate\Support\Facades\Route::currentRouteName() === 'home' ? '#game' : route('home').'#game' }}">{{ __('front.nav_game') }}</a></li>
    <li><a href="{{ \Illuminate\Support\Facades\Route::currentRouteName() === 'home' ? '#branches' : route('home').'#branches' }}">{{ __('front.nav_branches') }}</a></li>
    <li><a href="{{ route('blog.index') }}" {{ $currentRoute === 'blog.index' ? 'aria-current="page"' : '' }}>{{ __('front.blog_label') ?? 'Blog' }}</a></li>
    <li><a href="{{ route('contact') }}" class="nav-cta" {{ $currentRoute === 'contact' ? 'aria-current="page"' : '' }}>{{ __('front.nav_contact') }}</a></li>

    {{-- Language switcher --}}
    <li style="{{ app()->getLocale() === 'ar' ? 'margin-right:1rem;' : 'margin-left:1rem;' }}">
      @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        @if($localeCode !== app()->getLocale())
          <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
             style="display:inline-flex;align-items:center;gap:.3rem;
                    background:rgba(245,168,0,.1);border:1px solid rgba(245,168,0,.25);
                    border-radius:4px;padding:.3rem .8rem;color:var(--gold);
                    font-size:.72rem;font-family:'Orbitron',sans-serif;
                    white-space:nowrap;letter-spacing:.04em;">
            {{ $localeCode === 'ar' ? '🇸🇦 العربية' : '🇬🇧 EN' }}
          </a>
        @endif
      @endforeach
    </li>
  </ul>

</nav>