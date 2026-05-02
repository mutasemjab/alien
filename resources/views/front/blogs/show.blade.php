@extends('layouts.front')

@php
  $locale   = app()->getLocale();
  $isAr     = $locale === 'ar';
  $seoTitle = $post->{'meta_title_'.$locale} ?: $post->trans('title');
  $seoDesc  = $post->{'meta_desc_'.$locale}  ?: Str::limit(strip_tags($post->trans('excerpt') ?: $post->trans('body')), 160);
  $siteUrl  = \App\Models\Setting::getValue('canonical_url', url('/'));
  $postUrl  = route('blog.show', $post->slug);
@endphp

@section('meta-title', $seoTitle)
@section('meta-desc',  $seoDesc)

@push('head')
{{-- Article-specific OG overrides --}}
<meta property="og:type"                   content="article">
<meta property="og:url"                    content="{{ $postUrl }}">
<meta property="og:title"                  content="{{ $seoTitle }}">
<meta property="og:description"            content="{{ $seoDesc }}">
<meta property="og:image"                  content="{{ $post->image_url }}">
<meta property="article:published_time"    content="{{ $post->published_at?->toIso8601String() }}">
<meta property="article:modified_time"     content="{{ $post->updated_at->toIso8601String() }}">
@if($post->author)<meta property="article:author" content="{{ $post->author }}">@endif
@if($post->category_en)<meta property="article:section" content="{{ $post->category_en }}">@endif
@foreach($post->tags ?? [] as $tag)
<meta property="article:tag" content="{{ $tag }}">
@endforeach
<link rel="canonical" href="{{ $postUrl }}">

{{-- Article + BreadcrumbList Schema.org --}}
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "Article",
      "@id": "{{ $postUrl }}#article",
      "headline": "{{ addslashes($seoTitle) }}",
      "description": "{{ addslashes($seoDesc) }}",
      "image": {
        "@type": "ImageObject",
        "url": "{{ $post->image_url }}",
        "width": 1200,
        "height": 630
      },
      "author": {
        "@type": "Person",
        "name": "{{ $post->author ?? 'Alien Code Team' }}"
      },
      "publisher": {
        "@type": "Organization",
        "@id": "{{ $siteUrl }}/#organization",
        "name": "Alien Code",
        "logo": {
          "@type": "ImageObject",
          "url": "{{ asset('images/logo.png') }}"
        }
      },
      "datePublished": "{{ $post->published_at?->toIso8601String() }}",
      "dateModified": "{{ $post->updated_at->toIso8601String() }}",
      "mainEntityOfPage": { "@id": "{{ $postUrl }}" },
      "keywords": "{{ implode(', ', $post->tags ?? []) }}",
      "articleSection": "{{ $post->category_en }}",
      "inLanguage": "{{ $locale }}"
    },
    {
      "@type": "BreadcrumbList",
      "itemListElement": [
        { "@type": "ListItem", "position": 1, "name": "Home",  "item": "{{ $siteUrl }}" },
        { "@type": "ListItem", "position": 2, "name": "Blog",  "item": "{{ route('blog.index') }}" },
        { "@type": "ListItem", "position": 3, "name": "{{ addslashes($seoTitle) }}", "item": "{{ $postUrl }}" }
      ]
    }
  ]
}
</script>
@endpush

@section('content')

{{-- Breadcrumb --}}
<div style="padding:5rem 0 0;max-width:860px;margin:0 auto;">
  <nav style="font-size:.75rem;color:var(--muted);font-family:'Orbitron',sans-serif;display:flex;gap:.5rem;align-items:center;flex-wrap:wrap;">
    <a href="{{ url('/') }}" style="color:var(--muted);text-decoration:none;">Home</a>
    <span>›</span>
    <a href="{{ route('blog.index') }}" style="color:var(--muted);text-decoration:none;">Blog</a>
    <span>›</span>
    <span style="color:var(--gold);">{{ Str::limit($post->trans('title'), 50) }}</span>
  </nav>
</div>

{{-- Article header --}}
<article style="max-width:860px;margin:0 auto;padding:2rem 0 5rem;">

  <header style="margin-bottom:2.5rem;">
    <div style="display:flex;flex-wrap:wrap;gap:.5rem;margin-bottom:1.2rem;">
      @if($post->category_en)
        <span style="background:rgba(245,168,0,.1);border:1px solid rgba(245,168,0,.3);color:var(--gold);border-radius:50px;padding:.25rem .9rem;font-size:.75rem;font-family:'Orbitron',sans-serif;">
          {{ $post->trans('category') }}
        </span>
      @endif
      @foreach($post->tags ?? [] as $tag)
        <span style="background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.08);color:var(--muted);border-radius:50px;padding:.25rem .9rem;font-size:.72rem;">
          {{ $tag }}
        </span>
      @endforeach
    </div>

    <h1 style="font-family:'Orbitron',sans-serif;font-size:clamp(1.4rem,4vw,2.2rem);line-height:1.25;color:var(--white);margin:0 0 1.2rem;{{ $isAr ? 'direction:rtl;' : '' }}">
      {{ $post->trans('title') }}
    </h1>

    <div style="display:flex;flex-wrap:wrap;gap:1.5rem;align-items:center;font-size:.78rem;color:var(--muted);">
      @if($post->author)
        <span>✍️ {{ $post->author }}</span>
      @endif
      <span>📅 {{ $post->published_at?->format('d F Y') }}</span>
      <span>⏱ {{ $post->reading_time }} {{ __('front.blog_min_read') }}</span>
    </div>
  </header>

  {{-- Featured image --}}
  @if($post->image)
  <div style="margin-bottom:2.5rem;border-radius:12px;overflow:hidden;border:1px solid rgba(245,168,0,.15);">
    <img src="{{ $post->image_url }}" alt="{{ $post->trans('title') }}"
         style="width:100%;max-height:460px;object-fit:cover;display:block;">
  </div>
  @endif

  {{-- Excerpt / lead paragraph --}}
  @if($post->trans('excerpt'))
  <p style="font-size:1.05rem;line-height:1.8;color:rgba(255,255,255,.75);border-left:3px solid var(--gold);padding-left:1.2rem;margin-bottom:2rem;{{ $isAr ? 'border-left:none;border-right:3px solid var(--gold);padding-left:0;padding-right:1.2rem;direction:rtl;' : '' }}">
    {{ $post->trans('excerpt') }}
  </p>
  @endif

  {{-- Body --}}
  <div class="blog-body" style="{{ $isAr ? 'direction:rtl;text-align:right;' : '' }}">
    {!! nl2br(e($post->trans('body'))) !!}
  </div>

  {{-- Share --}}
  <div style="margin-top:3rem;padding-top:2rem;border-top:1px solid rgba(255,255,255,.06);">
    <p style="font-size:.78rem;color:var(--muted);font-family:'Orbitron',sans-serif;margin-bottom:.8rem;">SHARE THIS ARTICLE</p>
    <div style="display:flex;gap:.7rem;flex-wrap:wrap;">
      <a href="https://twitter.com/intent/tweet?text={{ urlencode($seoTitle) }}&url={{ urlencode($postUrl) }}"
         target="_blank" rel="noopener"
         style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);color:var(--text);padding:.5rem 1rem;border-radius:8px;font-size:.8rem;text-decoration:none;display:flex;align-items:center;gap:.4rem;">
        𝕏 Twitter
      </a>
      <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode($postUrl) }}"
         target="_blank" rel="noopener"
         style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);color:var(--text);padding:.5rem 1rem;border-radius:8px;font-size:.8rem;text-decoration:none;display:flex;align-items:center;gap:.4rem;">
        💼 LinkedIn
      </a>
      <a href="https://wa.me/?text={{ urlencode($seoTitle.' '.$postUrl) }}"
         target="_blank" rel="noopener"
         style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);color:var(--text);padding:.5rem 1rem;border-radius:8px;font-size:.8rem;text-decoration:none;display:flex;align-items:center;gap:.4rem;">
        💬 WhatsApp
      </a>
    </div>
  </div>
</article>

{{-- Related posts --}}
@if($related->count())
<div class="divider"></div>
<section style="padding:3rem 0 5rem;">
  <div style="text-align:center;margin-bottom:2rem;">
    <div class="sec-label" style="justify-content:center;">{{ __('front.blog_related_label') }}</div>
    <h2 class="sec-title">{{ __('front.blog_related_title') }}</h2>
  </div>
  <div class="work-masonry" style="--cols:3;">
    @foreach($related as $i => $rel)
    <article class="wcard fu" style="transition-delay:{{ $i * 0.1 }}s;">
      <a href="{{ route('blog.show', $rel->slug) }}" style="text-decoration:none;display:block;">
        <div class="wcard-vis">
          <img src="{{ $rel->image_url }}" alt="{{ $rel->trans('title') }}"
               style="width:100%;aspect-ratio:16/9;object-fit:cover;display:block;">
        </div>
      </a>
      <div class="wcard-body">
        <div class="wcard-tags">
          @if($rel->category_en)<span class="wcard-tag">{{ $rel->trans('category') }}</span>@endif
        </div>
        <h3 style="font-size:.92rem;margin:.5rem 0;">
          <a href="{{ route('blog.show', $rel->slug) }}" style="color:var(--white);text-decoration:none;">
            {{ $rel->trans('title') }}
          </a>
        </h3>
        <span style="font-size:.72rem;color:var(--muted);">{{ $rel->published_at?->format('d M Y') }}</span>
      </div>
    </article>
    @endforeach
  </div>
</section>
@endif

@endsection

@push('head')
<style>
.blog-body {
  font-size: .95rem;
  line-height: 1.9;
  color: rgba(255,255,255,.78);
}
.blog-body p { margin-bottom: 1.2rem; }
</style>
@endpush
