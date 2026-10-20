@extends('layouts.front')

@php
  $locale  = app()->getLocale();
  $isAr    = $locale === 'ar';
  $siteUrl = \App\Models\Setting::getValue('canonical_url', config('app.url'));
@endphp

@section('meta-title', $isAr
  ? 'معرض أعمالنا | Alien Code'
  : 'Portfolio — Our Work | Alien Code')

@section('meta-desc', $isAr
  ? 'استعرض مشاريع تطوير البرمجيات والمواقع والتطبيقات التي نفذتها Alien Code للشركات في الأردن والمنطقة.'
  : 'Browse Alien Code\'s portfolio of software development, web, and mobile app projects delivered for businesses in Jordan and the Middle East.')

@section('content')

{{-- Page Hero --}}
<section style="padding:8rem 0 4rem;text-align:center;">
  <div class="sec-label" style="justify-content:center;">
    {{ $isAr ? 'أعمالنا' : __('front.portfolio_label') }}
  </div>
  <h1 class="sec-title" style="font-size:clamp(2rem,5vw,3.2rem);">
    {{ $isAr ? 'مشاريعنا المختارة' : 'Selected Projects' }}
  </h1>
  <p style="max-width:640px;margin:1.2rem auto 0;color:var(--muted);line-height:1.8;">
    {{ $isAr
      ? 'مجموعة من المشاريع التي تعكس قدراتنا التقنية وجودة تنفيذنا.'
      : 'A selection of projects that showcase our technical craft and commitment to quality.' }}
  </p>
</section>

{{-- Portfolio Grid --}}
<section style="padding:2rem 0 6rem;">
  <div class="work-masonry" style="--cols:3;">
    @foreach($portfolio as $i => $item)
    <article class="wcard fu" style="transition-delay:{{ $i * 0.08 }}s;">
      @if($item->image)
      <div class="wcard-vis">
        <img src="{{ $item->image_url }}"
             alt="{{ $item->trans('title') }}"
             loading="{{ $i < 3 ? 'eager' : 'lazy' }}"
             style="width:100%;aspect-ratio:16/9;object-fit:cover;display:block;">
      </div>
      @endif
      <div class="wcard-body">
        <div class="wcard-tags">
          @if($item->category_en)
            <span class="wcard-tag">{{ $item->trans('category') }}</span>
          @endif
          @foreach(($item->tags ?? []) as $tag)
            <span class="wcard-tag" style="background:rgba(255,255,255,.04);">{{ $tag }}</span>
          @endforeach
        </div>
        <h2 style="font-family:'Orbitron',sans-serif;font-size:.95rem;color:var(--white);margin:.6rem 0 .5rem;">
          {{ $item->trans('title') }}
        </h2>
        <p style="font-size:.83rem;color:var(--muted);line-height:1.6;margin:0 0 1rem;">
          {{ $item->trans('description') }}
        </p>
        <div style="display:flex;gap:.7rem;flex-wrap:wrap;">
          @if($item->project_url)
          <a href="{{ $item->project_url }}" target="_blank" rel="noopener"
             style="font-size:.75rem;font-family:'Orbitron',sans-serif;color:var(--gold);text-decoration:none;">
            {{ $isAr ? '← عرض المشروع' : 'View Project →' }}
          </a>
          @endif
        </div>
      </div>
    </article>
    @endforeach
  </div>
</section>

{{-- CTA --}}
<section style="padding:4rem 0 6rem;text-align:center;">
  <h2 class="sec-title">
    {{ $isAr ? 'هل لديك مشروع؟' : 'Have a Project in Mind?' }}
  </h2>
  <p style="color:var(--muted);max-width:500px;margin:.8rem auto 2rem;">
    {{ $isAr
      ? 'نحن نحب التحديات الجديدة. أخبرنا بفكرتك وسنتولى البناء.'
      : "We love new challenges. Tell us your idea and we'll take it from concept to launch." }}
  </p>
  <a href="{{ route('contact') }}" class="btn-gold">
    {{ $isAr ? '🚀 ابدأ مشروعك' : '🚀 Start Your Project' }}
  </a>
</section>

@endsection

@section('page-schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    { "@type": "ListItem", "position": 1, "name": "Home",      "item": "{{ $siteUrl }}" },
    { "@type": "ListItem", "position": 2, "name": "Portfolio", "item": "{{ url()->current() }}" }
  ]
}
</script>
@endsection
