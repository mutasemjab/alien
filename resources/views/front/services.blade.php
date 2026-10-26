@extends('layouts.front')

@php
  $locale = app()->getLocale();
  $isAr   = $locale === 'ar';
  $siteUrl = \App\Models\Setting::getValue('canonical_url', config('app.url'));
@endphp

@section('meta-title', $isAr
  ? 'خدمات شركة برمجة في الأردن | تطوير مواقع وتطبيقات | Alien Code'
  : 'Software Development Services in Jordan | Web & App Development | Alien Code')

@section('meta-desc', $isAr
  ? 'نقدم خدمات تطوير المواقع والتطبيقات والأنظمة المخصصة وتطبيقات الجوال وحلول التجارة الإلكترونية وتكامل الذكاء الاصطناعي للشركات في الأردن والمنطقة.'
  : 'Alien Code delivers web development, custom software, mobile apps, ERP systems, e-commerce platforms, and AI solutions for businesses in Jordan and the Middle East.')

@section('content')

{{-- Page Hero --}}
<section style="padding:8rem 0 4rem;text-align:center;">
  <div class="sec-label" style="justify-content:center;">
    {{ $isAr ? 'ما نقدمه' : 'What We Do' }}
  </div>
  <h1 class="sec-title" style="font-size:clamp(2rem,5vw,3.2rem);">
    {{ $isAr ? 'خدماتنا' : 'Our Services' }}
  </h1>
  <p style="max-width:640px;margin:1.2rem auto 0;color:var(--muted);line-height:1.8;">
    {{ $isAr
      ? 'نبني حلول برمجية متكاملة للشركات والمؤسسات — من تطبيقات الويب والجوال إلى الأنظمة المخصصة وحلول الذكاء الاصطناعي.'
      : 'We build end-to-end software solutions for businesses of all sizes — from web and mobile applications to custom enterprise systems and AI integrations.' }}
  </p>
</section>

{{-- Services Grid --}}
<section style="padding:2rem 0 6rem;">
  <div class="work-masonry" style="--cols:3;">
    @foreach($services as $i => $service)
    <article class="wcard fu" style="transition-delay:{{ $i * 0.08 }}s;">
      <div class="wcard-body" style="padding:2rem;">

        <div style="font-size:2.5rem;margin-bottom:1rem;">{{ $service->icon }}</div>

        <div class="wcard-tags" style="margin-bottom:.8rem;">
          @foreach(($service->tags ?? []) as $tag)
            <span class="wcard-tag">{{ $tag }}</span>
          @endforeach
        </div>

        <h2 style="font-family:'Orbitron',sans-serif;font-size:1rem;color:var(--white);margin:0 0 .8rem;">
          @if($service->has_detail)
            <a href="{{ route('services.show', $service->slug) }}"
               style="color:inherit;text-decoration:none;">
              {{ $service->trans('title') }}
            </a>
          @else
            {{ $service->trans('title') }}
          @endif
        </h2>

        <p style="font-size:.88rem;color:var(--muted);line-height:1.7;margin:0;">
          {{ $service->trans('description') }}
        </p>

        @if($service->has_detail)
        <a href="{{ route('services.show', $service->slug) }}"
           style="display:inline-flex;align-items:center;gap:.4rem;margin-top:1.4rem;
                  font-size:.8rem;font-family:'Orbitron',sans-serif;color:var(--gold);
                  text-decoration:none;letter-spacing:.04em;">
          {{ $isAr ? 'اعرف المزيد ←' : 'Learn More →' }}
        </a>
        @endif

      </div>
    </article>
    @endforeach
  </div>
</section>

{{-- CTA --}}
<section style="padding:4rem 0 6rem;text-align:center;">
  <div class="orb-a" style="opacity:.3;"></div>
  <h2 class="sec-title">
    {{ $isAr ? 'هل تحتاج حلاً مخصصاً؟' : 'Need a Custom Solution?' }}
  </h2>
  <p style="color:var(--muted);max-width:500px;margin:.8rem auto 2rem;">
    {{ $isAr
      ? 'فريقنا مستعد لدراسة متطلباتك وتقديم عرض تقني واضح.'
      : "Our team is ready to study your requirements and deliver a clear technical proposal." }}
  </p>
  <a href="{{ route('contact') }}" class="btn-gold">
    {{ $isAr ? '🚀 تواصل معنا' : '🚀 Contact Us' }}
  </a>
</section>

@endsection

@section('page-schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    { "@type": "ListItem", "position": 1, "name": "Home",     "item": "{{ $siteUrl }}" },
    { "@type": "ListItem", "position": 2, "name": "Services", "item": "{{ url()->current() }}" }
  ]
}
</script>
@endsection
