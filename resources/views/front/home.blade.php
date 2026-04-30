@extends('layouts.front')
@section('meta-title', \App\Models\Setting::getValue('meta_title_'.app()->getLocale(), 'Alien Code'))
@section('meta-desc', \App\Models\Setting::getValue('meta_desc_'.app()->getLocale(), ''))

@section('content')

{{-- ========================================================
     HERO
     ======================================================== --}}
<section id="hero">
  <canvas id="matrix-canvas"></canvas>
  <div class="orb-a hero-glow-orb"></div>
  <div class="orb-b hero-glow-orb"></div>

  <div class="hero-content">
    <div class="hero-chip">
      <div class="blink-dot"></div>
      {{ $hero->trans('badge_text') }}
    </div>

    <h1 class="hero-title">
      <span class="line">
        <span class="word" style="animation-delay:.3s;">{{ $hero->trans('title_line1') }}</span>
      </span>
      <span class="line">
        <span class="word gold-text" style="animation-delay:.5s;">{{ $hero->trans('title_line2') }}</span>
      </span>
      <span class="line">
        <span class="word" style="animation-delay:.7s;">{{ $hero->trans('title_line3') }}</span>
      </span>
    </h1>

    <div class="type-line" id="typeLine">
      &gt; <span id="typeText"></span><span class="type-cursor">|</span>
    </div>

    <p class="hero-desc">{{ $hero->trans('description') }}</p>

    <div class="hero-actions">
      <a href="{{ $hero->btn_primary_url }}" class="btn-gold">
        🚀 {{ $hero->trans('btn_primary_text') }}
      </a>
      <a href="{{ $hero->btn_secondary_url }}" class="btn-ghost">
        🎮 {{ $hero->trans('btn_secondary_text') }}
      </a>
    </div>

    <div class="hero-stats">
      <div>
        <div class="cnt" data-target="{{ $hero->stat_projects }}">0</div>
        <div class="hstat-lbl">{{ __('front.stat_projects') }}</div>
      </div>
      <div>
        <div class="cnt" data-target="{{ $hero->stat_years }}">0</div>
        <div class="hstat-lbl">{{ __('front.stat_years') }}</div>
      </div>
      <div>
        <div class="cnt" data-target="{{ $hero->stat_engineers }}">0</div>
        <div class="hstat-lbl">{{ __('front.stat_engineers') }}</div>
      </div>
      <div>
        <div class="cnt" data-target="{{ $hero->stat_satisfaction }}">0</div>
        <div class="hstat-lbl">{{ __('front.stat_satisfaction') }}</div>
      </div>
    </div>
  </div>

  <div class="hero-robot-wrap">
    <canvas id="robotCanvas" width="420" height="560"></canvas>
  </div>

  <div class="scroll-ind">
    <div class="scroll-mouse"><div class="scroll-wheel"></div></div>
    {{ __('front.scroll') }}
  </div>
</section>

{{-- MARQUEE --}}
<div class="marquee-section">
  <div class="marquee-track">
    @foreach($services->take(8) as $s)
      <div class="marquee-item">{{ $s->trans('title') }}</div>
    @endforeach
    @foreach($services->take(8) as $s)
      <div class="marquee-item">{{ $s->trans('title') }}</div>
    @endforeach
  </div>
</div>

<div class="divider"></div>

{{-- ========================================================
     ABOUT
     ======================================================== --}}
<section id="about">
  <div class="about-grid">
    <div class="about-visual-wrap fu">
      {{-- Code window --}}
      <div class="about-holo">
        <div class="holo-screen">
          <div class="holo-header">
            <div class="holo-dots"><span class="d1"></span><span class="d2"></span><span class="d3"></span></div>
            <div class="holo-title">alien_code_core.js — v3.7.0</div>
          </div>
          <div class="code-block">
            <span class="code-line"><span class="code-num">01</span><span class="code-comment">// Alien Code — Software DNA</span></span>
            <span class="code-line"><span class="code-num">03</span><span class="code-keyword">class</span> <span class="code-func">AlienCode</span> {</span>
            <span class="code-line"><span class="code-num">04</span>  <span class="code-keyword">constructor</span>() {</span>
            <span class="code-line"><span class="code-num">05</span>    <span class="code-var">this</span>.<span class="code-func">mission</span> = <span class="code-string">"{{ addslashes(\App\Models\Setting::getValue('about_title_en', 'Build the future')) }}"</span>;</span>
            <span class="code-line"><span class="code-num">06</span>    <span class="code-var">this</span>.<span class="code-func">years</span> = <span class="code-string">{{ $hero->stat_years }}</span>;</span>
            <span class="code-line"><span class="code-num">07</span>    <span class="code-var">this</span>.<span class="code-func">engineers</span> = <span class="code-string">{{ $hero->stat_engineers }}</span>;</span>
            <span class="code-line"><span class="code-num">08</span>  }</span>
            <span class="code-line"><span class="code-num">10</span>  <span class="code-keyword">async</span> <span class="code-func">buildProject</span>(vision) {</span>
            <span class="code-line"><span class="code-num">11</span>    <span class="code-keyword">return</span> <span class="code-var">solution</span>.<span class="code-func">exceedsExpectations</span>();</span>
            <span class="code-line"><span class="code-num">12</span>  }</span>
            <span class="code-line"><span class="code-num">13</span>}</span>
          </div>
        </div>
        <div class="float-badge fb1">⚡ {{ __('front.badge_uptime') }}</div>
        <div class="float-badge fb2">🔒 {{ __('front.badge_security') }}</div>
        <div class="float-badge fb3">🤖 {{ __('front.badge_ai') }}</div>
      </div>
    </div>

    <div class="fu d1">
      <div class="sec-label">{{ __('front.about_label') }}</div>
      <h2 class="sec-title">
        {{ \App\Models\Setting::getValue('about_title_'.app()->getLocale(), __('front.about_title')) }}
      </h2>
      <p class="sec-desc">
        {{ \App\Models\Setting::getValue('about_desc_'.app()->getLocale(), __('front.about_desc')) }}
      </p>

      <div style="margin-top:2.5rem;" class="fu d2">
        <div class="skill-row">
          <div class="skill-meta"><span>{{ __('front.skill_web') }}</span><span>97%</span></div>
          <div class="skill-track"><div class="skill-fill" style="--w:97%"></div></div>
        </div>
        <div class="skill-row">
          <div class="skill-meta"><span>{{ __('front.skill_ai') }}</span><span>92%</span></div>
          <div class="skill-track"><div class="skill-fill" style="--w:92%"></div></div>
        </div>
        <div class="skill-row">
          <div class="skill-meta"><span>{{ __('front.skill_cloud') }}</span><span>95%</span></div>
          <div class="skill-track"><div class="skill-fill" style="--w:95%"></div></div>
        </div>
      </div>

      <div style="display:flex;gap:1rem;margin-top:2rem;" class="fu d3">
        <a href="#contact" class="btn-gold" style="font-size:.8rem;padding:.85rem 1.8rem;">
          {{ __('front.cta_start') }}
        </a>
        <a href="#work" class="btn-ghost" style="font-size:.8rem;padding:.85rem 1.8rem;">
          {{ __('front.cta_work') }}
        </a>
      </div>
    </div>
  </div>
</section>

<div class="divider"></div>

{{-- ========================================================
     SERVICES
     ======================================================== --}}
<section id="services">
  <div class="fu" style="text-align:center;max-width:600px;margin:0 auto;">
    <div class="sec-label" style="justify-content:center;">{{ __('front.services_label') }}</div>
    <h2 class="sec-title">{{ __('front.services_title') }}</h2>
  </div>

  <div class="services-hex">
    @foreach($services as $i => $service)
    <div class="svc-hex fu" style="transition-delay:{{ $i * 0.1 }}s;"
         onmousemove="this.style.setProperty('--mx',((event.offsetX/this.offsetWidth)*100)+'%');this.style.setProperty('--my',((event.offsetY/this.offsetHeight)*100)+'%')">
      <div class="svc-num">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</div>
      <div class="svc-icon-wrap">{{ $service->icon }}</div>
      <h3>{{ $service->trans('title') }}</h3>
      <p>{{ $service->trans('description') }}</p>
      @if($service->tags)
        <div class="svc-tags-wrap">
          @foreach($service->tags as $tag)
            <span class="stag">{{ $tag }}</span>
          @endforeach
        </div>
      @endif
    </div>
    @endforeach
  </div>
</section>

<div class="divider"></div>

{{-- ========================================================
     PORTFOLIO
     ======================================================== --}}
<section id="work">
  <div class="fu">
    <div class="sec-label">{{ __('front.portfolio_label') }}</div>
    <h2 class="sec-title">{{ __('front.portfolio_title') }} <span class="gold-text">{{ __('front.portfolio_title2') }}</span></h2>
    <p class="sec-desc">{{ __('front.portfolio_desc') }}</p>
  </div>

  <div class="work-masonry">
    @foreach($portfolio as $i => $item)
    <div class="wcard fu" style="transition-delay:{{ ($i % 3) * 0.1 }}s;">
      <div class="wcard-vis">
        @if($item->image)
          <img src="{{ $item->image_url }}" alt="{{ $item->trans('title') }}"
               style="width:100%;aspect-ratio:4/3;object-fit:cover;display:block;">
        @else
          {{-- Fallback animated canvas --}}
          <div style="background:linear-gradient(135deg,#0d0a1a,#1f1630);aspect-ratio:4/3;display:flex;align-items:center;justify-content:center;">
            <canvas class="portfolio-canvas" data-index="{{ $i }}"
                    width="280" height="180" style="max-width:100%;"></canvas>
          </div>
        @endif
      </div>
      <div class="wcard-body">
        <div class="wcard-tags">
          <span class="wcard-tag">{{ $item->trans('category') }}</span>
          @foreach(array_slice($item->tags ?? [], 0, 3) as $tag)
            <span class="wcard-tag">{{ $tag }}</span>
          @endforeach
        </div>
        <h3>{{ $item->trans('title') }}</h3>
        <p>{{ $item->trans('description') }}</p>
        @if($item->project_url)
          <a href="{{ $item->project_url }}" target="_blank"
             style="display:inline-flex;align-items:center;gap:.4rem;color:var(--gold);font-size:.78rem;margin-top:.8rem;text-decoration:none;font-family:'Orbitron',sans-serif;">
            🔗 {{ __('front.view_project') }}
          </a>
        @endif
      </div>
      <div class="wcard-num">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</div>
    </div>
    @endforeach
  </div>
</section>

<div class="divider"></div>

{{-- ========================================================
     CLIENTS
     ======================================================== --}}
<section id="clients">
  <div class="fu" style="text-align:center;">
    <div class="sec-label" style="justify-content:center;">{{ __('front.clients_label') }}</div>
    <h2 class="sec-title">{{ __('front.clients_title') }} <span class="gold-text">{{ __('front.clients_title2') }}</span></h2>
  </div>

  @if($clients->count())
  <div class="clients-ticker fu d1">
    <div class="ticker-row">
      @foreach($clients as $client)
        <div class="client-pill">
          @if($client->logo)
            <img src="{{ $client->logo_url }}" alt="{{ $client->name }}"
                 style="height:24px;object-fit:contain;filter:brightness(0) invert(1);opacity:.5;margin-right:.4rem;vertical-align:middle;">
          @endif
          {{ $client->name }}
        </div>
      @endforeach
      @foreach($clients as $client)
        <div class="client-pill">
          @if($client->logo)
            <img src="{{ $client->logo_url }}" alt="{{ $client->name }}"
                 style="height:24px;object-fit:contain;filter:brightness(0) invert(1);opacity:.5;margin-right:.4rem;vertical-align:middle;">
          @endif
          {{ $client->name }}
        </div>
      @endforeach
    </div>
  </div>
  @endif
</section>

<div class="divider"></div>

{{-- ========================================================
     TESTIMONIALS
     ======================================================== --}}
<section id="testimonials">
  <div class="fu" style="text-align:center;max-width:600px;margin:0 auto;">
    <div class="sec-label" style="justify-content:center;">{{ __('front.testi_label') }}</div>
    <h2 class="sec-title">{{ __('front.testi_title') }} <span class="gold-text">{{ __('front.testi_title2') }}</span></h2>
  </div>

  <div class="testi-wrap">
    @foreach($testimonials as $i => $t)
    <div class="tc fu" style="transition-delay:{{ ($i % 3) * 0.1 }}s;">
      <div class="tc-stars">
        @for($s = 1; $s <= 5; $s++)
          <span>{{ $s <= $t->rating ? '★' : '☆' }}</span>
        @endfor
      </div>
      <p class="tc-text">"{{ $t->trans('quote') }}"</p>
      <div class="tc-person">
        <div class="tc-av">{{ $t->initials }}</div>
        <div>
          <div class="tc-name">{{ $t->trans('author_name') }}</div>
          <div class="tc-role">{{ $t->trans('author_role') }}, {{ $t->author_company }}</div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</section>

<div class="divider"></div>

{{-- ========================================================
     BRANCHES
     ======================================================== --}}
<section id="branches">
  <div class="fu" style="text-align:center;max-width:600px;margin:0 auto;">
    <div class="sec-label" style="justify-content:center;">{{ __('front.branches_label') }}</div>
    <h2 class="sec-title">{{ __('front.branches_title') }} <span class="gold-text">{{ __('front.branches_title2') }}</span></h2>
    <p class="sec-desc" style="margin:0 auto;">{{ __('front.branches_desc') }}</p>
  </div>

  <div class="branches-wrap">
    @foreach($branches as $i => $branch)
    <div class="branch fu" style="transition-delay:{{ $i * 0.1 }}s;">
      <span class="branch-emoji">{{ $branch->flag_emoji }}</span>
      <div class="branch-city">{{ $branch->trans('city') }}</div>
      <div class="branch-country">
        {{ strtoupper($branch->trans('country')) }}
        @if($branch->trans('label')) — {{ strtoupper($branch->trans('label')) }} @endif
      </div>
      <div class="branch-status">
        <div class="status-dot"></div>
        {{ __('front.branch_open') }}
      </div>
      <div class="branch-addr">
        {{ $branch->trans('address') }}<br>
        @if($branch->phone) {{ $branch->phone }}<br> @endif
        @if($branch->trans('working_hours')) {{ $branch->trans('working_hours') }} @endif
      </div>
    </div>
    @endforeach
  </div>
</section>

<div class="divider"></div>

{{-- ========================================================
     CONTACT
     ======================================================== --}}
<section id="contact">
  <div class="fu" style="text-align:center;max-width:600px;margin:0 auto;">
    <div class="sec-label" style="justify-content:center;">{{ __('front.contact_label') }}</div>
    <h2 class="sec-title">{{ __('front.contact_title') }} <span class="gold-text">{{ __('front.contact_title2') }}</span></h2>
  </div>

  <div class="contact-wrap">
    <div class="fu">
      @if($branches->first())
        @php $hq = $branches->first(); @endphp
        <div class="contact-info-item">
          <div class="cii-icon">📍</div>
          <div>
            <div class="cii-label">{{ __('front.hq') }}</div>
            <div class="cii-val">{{ $hq->trans('address') }}, {{ $hq->trans('city') }}</div>
          </div>
        </div>
      @endif
      <div class="contact-info-item">
        <div class="cii-icon">✉️</div>
        <div>
          <div class="cii-label">{{ __('front.email') }}</div>
          <div class="cii-val">{{ \App\Models\Setting::getValue('contact_email', 'hello@alien-code.io') }}</div>
        </div>
      </div>
      <div class="contact-info-item">
        <div class="cii-icon">📞</div>
        <div>
          <div class="cii-label">{{ __('front.phone') }}</div>
          <div class="cii-val">{{ \App\Models\Setting::getValue('contact_phone', '+962 6 500 0000') }}</div>
        </div>
      </div>
      @if($branches->first())
      <div class="contact-info-item">
        <div class="cii-icon">🕐</div>
        <div>
          <div class="cii-label">{{ __('front.hours') }}</div>
          <div class="cii-val">{{ $hq->trans('working_hours') }}</div>
        </div>
      </div>
      @endif
    </div>

    <div class="contact-card fu d1">
      @if(session('success'))
        <div style="background:rgba(34,197,94,.1);border:1px solid rgba(34,197,94,.3);color:#4ade80;padding:.85rem 1rem;border-radius:8px;margin-bottom:1rem;font-size:.88rem;">
          ✅ {{ session('success') }}
        </div>
      @endif

      <form method="POST" action="{{ route('contact.send') }}">
        @csrf
        <div class="form-row-2" style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
          <div class="form-field" style="margin-bottom:1rem;">
            <label style="display:block;font-size:.72rem;color:var(--muted);letter-spacing:.1em;text-transform:uppercase;margin-bottom:.4rem;font-family:'Orbitron',sans-serif;">
              {{ __('front.form_name') }}
            </label>
            <input type="text" name="name" value="{{ old('name') }}"
                   style="width:100%;background:rgba(10,7,20,.7);border:1px solid rgba(245,168,0,.12);border-radius:8px;padding:.75rem 1rem;color:var(--text);font-family:'Exo 2','Cairo',sans-serif;font-size:.88rem;outline:none;"
                   dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" required>
            @error('name') <div style="color:#f87171;font-size:.75rem;margin-top:.2rem;">{{ $message }}</div> @enderror
          </div>
          <div class="form-field" style="margin-bottom:1rem;">
            <label style="display:block;font-size:.72rem;color:var(--muted);letter-spacing:.1em;text-transform:uppercase;margin-bottom:.4rem;font-family:'Orbitron',sans-serif;">
              {{ __('front.form_email') }}
            </label>
            <input type="email" name="email" value="{{ old('email') }}"
                   style="width:100%;background:rgba(10,7,20,.7);border:1px solid rgba(245,168,0,.12);border-radius:8px;padding:.75rem 1rem;color:var(--text);font-family:'Exo 2','Cairo',sans-serif;font-size:.88rem;outline:none;"
                   required>
            @error('email') <div style="color:#f87171;font-size:.75rem;margin-top:.2rem;">{{ $message }}</div> @enderror
          </div>
        </div>

        <div style="margin-bottom:1rem;">
          <label style="display:block;font-size:.72rem;color:var(--muted);letter-spacing:.1em;text-transform:uppercase;margin-bottom:.4rem;font-family:'Orbitron',sans-serif;">
            {{ __('front.form_message') }}
          </label>
          <textarea name="message" rows="4" required
                    style="width:100%;background:rgba(10,7,20,.7);border:1px solid rgba(245,168,0,.12);border-radius:8px;padding:.75rem 1rem;color:var(--text);font-family:'Exo 2','Cairo',sans-serif;font-size:.88rem;outline:none;resize:vertical;"
                    dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">{{ old('message') }}</textarea>
          @error('message') <div style="color:#f87171;font-size:.75rem;margin-top:.2rem;">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn-gold" style="width:100%;justify-content:center;font-size:.85rem;">
          🚀 {{ __('front.form_submit') }}
        </button>
      </form>
    </div>
  </div>
</section>



@endsection
