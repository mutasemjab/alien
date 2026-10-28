@extends('layouts.front')

@php
  $locale  = app()->getLocale();
  $isAr    = $locale === 'ar';
  $siteUrl = \App\Models\Setting::getValue('canonical_url', config('app.url'));

  $seoTitle = $service->{'meta_title_'.$locale} ?: $service->trans('title') . ' | Alien Code';
  $seoDesc  = $service->{'meta_desc_'.$locale}  ?: Str::limit(strip_tags($service->trans('description')), 160);
  $pageUrl  = route('services.show', $service->slug);
@endphp

@section('meta-title', $seoTitle)
@section('meta-desc',  $seoDesc)
@section('canonical',  $pageUrl)

@push('head')
<meta property="og:type"        content="website">
<meta property="og:url"         content="{{ $pageUrl }}">
<meta property="og:title"       content="{{ $seoTitle }}">
<meta property="og:description" content="{{ $seoDesc }}">
<link rel="canonical"           href="{{ $pageUrl }}">
@endpush

@section('content')

{{-- Breadcrumb --}}
<div style="padding:5rem 0 0;max-width:900px;margin:0 auto;">
  <nav aria-label="breadcrumb"
       style="font-size:.75rem;color:var(--muted);font-family:'Orbitron',sans-serif;
              display:flex;gap:.5rem;align-items:center;flex-wrap:wrap;">
    <a href="{{ route('home') }}"     style="color:var(--muted);text-decoration:none;">
      {{ $isAr ? 'الرئيسية' : 'Home' }}
    </a>
    <span aria-hidden="true">›</span>
    <a href="{{ route('services') }}" style="color:var(--muted);text-decoration:none;">
      {{ $isAr ? 'الخدمات' : 'Services' }}
    </a>
    <span aria-hidden="true">›</span>
    <span style="color:var(--gold);">{{ Str::limit($service->trans('title'), 50) }}</span>
  </nav>
</div>

{{-- Service Header --}}
<article style="max-width:900px;margin:0 auto;padding:2rem 0 5rem;">

  <header style="margin-bottom:2.5rem;">
    <div style="font-size:3rem;margin-bottom:1rem;">{{ $service->icon }}</div>

    @if($service->tags)
    <div style="display:flex;flex-wrap:wrap;gap:.5rem;margin-bottom:1.2rem;">
      @foreach($service->tags as $tag)
        <span style="background:rgba(245,168,0,.1);border:1px solid rgba(245,168,0,.3);
                     color:var(--gold);border-radius:50px;padding:.25rem .9rem;
                     font-size:.75rem;font-family:'Orbitron',sans-serif;">
          {{ $tag }}
        </span>
      @endforeach
    </div>
    @endif

    <h1 style="font-family:'Orbitron',sans-serif;font-size:clamp(1.6rem,4vw,2.4rem);
               line-height:1.2;color:var(--ink);margin:0 0 1rem;
               {{ $isAr ? 'direction:rtl;' : '' }}">
      {{ $service->trans('title') }}
    </h1>

    <p style="font-size:1.05rem;line-height:1.8;color:var(--body);
              border-left:3px solid var(--gold);padding-left:1.2rem;
              {{ $isAr ? 'border-left:none;border-right:3px solid var(--gold);padding-left:0;padding-right:1.2rem;direction:rtl;' : '' }}">
      {{ $service->trans('description') }}
    </p>
  </header>

  {{-- Body content --}}
  @if($service->trans('body'))
  <div class="service-body" style="{{ $isAr ? 'direction:rtl;text-align:right;' : '' }}">
    {!! $service->trans('body') !!}
  </div>
  @endif

  {{-- CTA --}}
  <div style="margin-top:3rem;padding:2rem;background:rgba(245,168,0,.05);
              border:1px solid rgba(245,168,0,.2);border-radius:12px;text-align:center;">
    <h2 style="font-family:'Orbitron',sans-serif;font-size:1.1rem;color:var(--ink);margin:0 0 .8rem;">
      {{ $isAr ? 'هل تحتاج هذه الخدمة؟' : 'Interested in This Service?' }}
    </h2>
    <p style="color:var(--muted);font-size:.9rem;margin:0 0 1.5rem;">
      {{ $isAr
        ? 'تواصل مع فريقنا للحصول على استشارة مجانية وعرض سعر مخصص.'
        : 'Contact our team for a free consultation and a tailored project quote.' }}
    </p>
    <a href="{{ route('contact') }}" class="btn-gold">
      {{ $isAr ? '🚀 احصل على عرض سعر' : '🚀 Get a Free Quote' }}
    </a>
  </div>

  {{-- Related Services --}}
  @if($relatedServices->count())
  <div style="margin-top:3.5rem;">
    <h2 style="font-family:'Orbitron',sans-serif;font-size:.95rem;color:var(--gold);
               letter-spacing:.05em;margin:0 0 1.5rem;">
      {{ $isAr ? 'خدمات ذات صلة' : 'RELATED SERVICES' }}
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:1rem;">
      @foreach($relatedServices as $rel)
      <a href="{{ route('services.show', $rel->slug) }}"
         style="background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.07);
                border-radius:10px;padding:1.2rem;text-decoration:none;
                display:flex;align-items:center;gap:.8rem;
                transition:border-color .2s;">
        <span style="font-size:1.6rem;">{{ $rel->icon }}</span>
        <span style="font-size:.85rem;color:var(--text);font-family:'Orbitron',sans-serif;">
          {{ $rel->trans('title') }}
        </span>
      </a>
      @endforeach
    </div>
  </div>
  @endif

</article>

@endsection

@section('page-schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "Service",
      "@id": "{{ $pageUrl }}#service",
      "name": "{{ addslashes($service->trans('title')) }}",
      "description": "{{ addslashes($seoDesc) }}",
      "provider": { "@id": "{{ $siteUrl }}/#organization" },
      "areaServed": { "@type": "Country", "name": "Jordan" },
      "url": "{{ $pageUrl }}"
    },
    {
      "@type": "BreadcrumbList",
      "itemListElement": [
        { "@type": "ListItem", "position": 1, "name": "Home",     "item": "{{ $siteUrl }}" },
        { "@type": "ListItem", "position": 2, "name": "Services", "item": "{{ route('services') }}" },
        { "@type": "ListItem", "position": 3, "name": "{{ addslashes($service->trans('title')) }}", "item": "{{ $pageUrl }}" }
      ]
    }
  ]
}
</script>
@endsection

@push('head')
<style>
.service-body {
  font-size: .95rem;
  line-height: 1.9;
  color: var(--body);
}
.service-body p  { margin-bottom: 1.2rem; }
.service-body h2 { font-family:'Orbitron',sans-serif;font-size:1.1rem;color:var(--ink);margin:2rem 0 .8rem; }
.service-body h3 { font-family:'Orbitron',sans-serif;font-size:.95rem;color:var(--gold);margin:1.5rem 0 .6rem; }
.service-body ul,
.service-body ol { padding-left:1.5rem;margin-bottom:1.2rem; }
.service-body li { margin-bottom:.5rem; color:var(--body); }
.service-body a  { color:var(--gold);text-underline-offset:3px; }
.service-body strong { color:var(--ink); }
.service-body table { border-collapse:collapse; width:100%; margin-bottom:1.2rem; }
.service-body th { color:var(--ink); border-bottom:2px solid var(--border-gold); padding:.5rem; font-size:.82rem; }
.service-body td { color:var(--body); padding:.5rem; border-bottom:1px solid var(--border); font-size:.82rem; }
</style>
@endpush
