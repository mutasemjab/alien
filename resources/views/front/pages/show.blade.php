@extends('layouts.front')

@php
  $locale   = app()->getLocale();
  $isAr     = $locale === 'ar';
  $siteUrl  = \App\Models\Setting::getValue('canonical_url', config('app.url'));
  $seoTitle = $post->{'meta_title_'.$locale} ?: $post->trans('title');
  $seoDesc  = $post->{'meta_desc_'.$locale}  ?: Str::limit(strip_tags($post->trans('excerpt') ?: $post->trans('body')), 160);
  $pageUrl  = route('blog.show', $post->slug);
@endphp

@section('meta-title', $seoTitle)
@section('meta-desc',  $seoDesc)
@section('canonical',  $pageUrl)

@push('head')
<meta property="og:type"        content="website">
<meta property="og:url"         content="{{ $pageUrl }}">
<meta property="og:title"       content="{{ $seoTitle }}">
<meta property="og:description" content="{{ $seoDesc }}">
@if($post->image)
<meta property="og:image"       content="{{ $post->image_url }}">
@endif
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
    <span style="color:var(--gold);">{{ Str::limit($post->trans('title'), 60) }}</span>
  </nav>
</div>

{{-- Page header --}}
<article style="max-width:900px;margin:0 auto;padding:2rem 0 5rem;">

  <header style="margin-bottom:2.5rem;">
    @if($post->category_en)
    <div style="display:flex;flex-wrap:wrap;gap:.5rem;margin-bottom:1.2rem;">
      <span style="background:rgba(245,168,0,.1);border:1px solid rgba(245,168,0,.3);
                   color:var(--gold);border-radius:50px;padding:.25rem .9rem;
                   font-size:.75rem;font-family:'Orbitron',sans-serif;">
        {{ $post->trans('category') }}
      </span>
      @foreach($post->tags ?? [] as $tag)
        <span style="background:var(--bg-section);border:1px solid var(--border);
                     color:var(--muted);border-radius:50px;padding:.25rem .9rem;font-size:.72rem;">
          {{ $tag }}
        </span>
      @endforeach
    </div>
    @endif

    <h1 style="font-family:'Orbitron',sans-serif;font-size:clamp(1.5rem,4vw,2.4rem);
               line-height:1.25;color:var(--ink);margin:0 0 1.2rem;
               {{ $isAr ? 'direction:rtl;' : '' }}">
      {{ $post->trans('title') }}
    </h1>

    @if($post->trans('excerpt'))
    <p style="font-size:1.05rem;line-height:1.8;color:var(--body);
              border-left:3px solid var(--gold);padding-left:1.2rem;
              {{ $isAr ? 'border-left:none;border-right:3px solid var(--gold);padding-left:0;padding-right:1.2rem;direction:rtl;' : '' }}">
      {{ $post->trans('excerpt') }}
    </p>
    @endif
  </header>

  {{-- Featured image --}}
  @if($post->image)
  <div style="margin-bottom:2.5rem;border-radius:12px;overflow:hidden;border:1px solid rgba(245,168,0,.15);">
    <img src="{{ $post->image_url }}" alt="{{ $post->trans('title') }}"
         loading="eager"
         style="width:100%;max-height:460px;object-fit:cover;display:block;">
  </div>
  @endif

  {{-- Body --}}
  <div class="page-body" style="{{ $isAr ? 'direction:rtl;text-align:right;' : '' }}">
    {!! $post->trans('body') !!}
  </div>

  {{-- Primary CTA --}}
  <div style="margin-top:3rem;padding:2rem;background:rgba(245,168,0,.05);
              border:1px solid rgba(245,168,0,.2);border-radius:12px;text-align:center;">
    <h2 style="font-family:'Orbitron',sans-serif;font-size:1.1rem;color:var(--ink);margin:0 0 .8rem;">
      {{ $isAr ? 'هل تريد البدء؟' : 'Ready to Start Your Project?' }}
    </h2>
    <p style="color:var(--muted);font-size:.9rem;margin:0 0 1.5rem;">
      {{ $isAr
        ? 'تواصل مع فريق Alien Code للحصول على استشارة مجانية.'
        : 'Contact the Alien Code team today for a free, no-obligation consultation.' }}
    </p>
    <a href="{{ route('contact') }}" class="btn-gold">
      {{ $isAr ? '🚀 احصل على استشارة مجانية' : '🚀 Get a Free Consultation' }}
    </a>
  </div>

  {{-- Related articles --}}
  @if(isset($related) && $related->count())
  <div class="divider" style="margin:3rem 0;"></div>
  <h2 style="font-family:'Orbitron',sans-serif;font-size:.9rem;color:var(--gold);
             letter-spacing:.07em;margin:0 0 1.5rem;">
    {{ $isAr ? 'مقالات ذات صلة' : 'RELATED ARTICLES' }}
  </h2>
  <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:1.2rem;">
    @foreach($related as $rel)
    <a href="{{ route('blog.show', $rel->slug) }}"
       style="background:var(--surface);border:1px solid var(--border);
              border-radius:10px;padding:1.4rem;text-decoration:none;display:block;
              box-shadow:var(--shadow-xs);transition:box-shadow .2s,border-color .2s;">
      <span style="font-size:.7rem;font-family:'Orbitron',sans-serif;color:var(--gold);">
        {{ $rel->trans('category') }}
      </span>
      <p style="font-size:.88rem;color:var(--ink);margin:.5rem 0 0;line-height:1.5;">
        {{ Str::limit($rel->trans('title'), 70) }}
      </p>
    </a>
    @endforeach
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
      "@type": "WebPage",
      "@id": "{{ $pageUrl }}#webpage",
      "url": "{{ $pageUrl }}",
      "name": "{{ addslashes($seoTitle) }}",
      "description": "{{ addslashes($seoDesc) }}",
      "isPartOf": { "@id": "{{ $siteUrl }}/#website" },
      "about": { "@id": "{{ $siteUrl }}/#organization" },
      "inLanguage": "{{ $locale }}"
    },
    {
      "@type": "BreadcrumbList",
      "itemListElement": [
        { "@type": "ListItem", "position": 1, "name": "Home", "item": "{{ $siteUrl }}" },
        { "@type": "ListItem", "position": 2, "name": "{{ addslashes($seoTitle) }}", "item": "{{ $pageUrl }}" }
      ]
    }
  ]
}
</script>
@endsection

@push('head')
<style>
.page-body {
  font-size: .95rem;
  line-height: 1.9;
  color: var(--body);
}
.page-body p  { margin-bottom: 1.2rem; }
.page-body h2 { font-family:'Orbitron',sans-serif;font-size:1.15rem;color:var(--ink);margin:2.2rem 0 .8rem; }
.page-body h3 { font-family:'Orbitron',sans-serif;font-size:.95rem;color:var(--gold);margin:1.6rem 0 .6rem; }
.page-body ul,
.page-body ol { padding-left:1.5rem;margin-bottom:1.2rem; }
.page-body li { margin-bottom:.5rem; color:var(--body); }
.page-body a  { color:var(--gold);text-underline-offset:3px; }
.page-body strong { color:var(--ink); }
.page-body blockquote {
  border-left:3px solid var(--gold);
  padding-left:1.2rem;
  margin:1.5rem 0;
  color:var(--muted);
  font-style:italic;
}
.page-body table { width:100%;border-collapse:collapse;margin-bottom:1.5rem; }
.page-body th,
.page-body td { padding:.6rem .9rem;border:1px solid var(--border);font-size:.88rem; }
.page-body th { background:rgba(180,83,9,.06);color:var(--gold); }
</style>
@endpush
