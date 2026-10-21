@extends('layouts.front')

@php
  $locale  = app()->getLocale();
  $isAr    = $locale === 'ar';
  $siteUrl = \App\Models\Setting::getValue('canonical_url', config('app.url'));
  $pageUrl = route('locations.show', $city['slug']);

  $cityName    = $isAr ? $city['name_ar']   : $city['name_en'];
  $regionName  = $isAr ? $city['region_ar'] : $city['region_en'];
  $seoTitle    = $isAr
    ? "شركة برمجة في {$city['name_ar']}, الأردن | Alien Code"
    : "Software Development Company in {$city['name_en']}, Jordan | Alien Code";
  $seoDesc = $isAr
    ? "Alien Code — شركة تطوير برمجيات في {$city['name_ar']}. نبني مواقع إلكترونية وتطبيقات جوال وأنظمة ERP مخصصة للشركات في {$city['name_ar']} والأردن."
    : "Alien Code is a software development company serving {$city['name_en']}, Jordan. We build websites, mobile apps, ERP systems, and custom software for businesses in {$city['name_en']}.";
@endphp

@section('meta-title',  $seoTitle)
@section('meta-desc',   $seoDesc)
@section('canonical',   $pageUrl)

@section('content')

<section style="padding:6rem 0 2rem;max-width:960px;margin:0 auto;{{ $isAr ? 'direction:rtl;' : '' }}">

  {{-- Breadcrumb --}}
  <nav aria-label="breadcrumb" style="font-size:.75rem;color:var(--muted);font-family:'Orbitron',sans-serif;
       display:flex;gap:.5rem;align-items:center;flex-wrap:wrap;margin-bottom:2.5rem;">
    <a href="{{ route('home') }}" style="color:var(--muted);text-decoration:none;">{{ $isAr ? 'الرئيسية' : 'Home' }}</a>
    <span>›</span>
    <a href="{{ route('services') }}" style="color:var(--muted);text-decoration:none;">{{ $isAr ? 'الخدمات' : 'Services' }}</a>
    <span>›</span>
    <span style="color:var(--gold);">{{ $cityName }}</span>
  </nav>

  {{-- Hero --}}
  <div class="sec-label" style="justify-content:{{ $isAr ? 'flex-end' : 'flex-start' }};margin-bottom:.8rem;">
    {{ $isAr ? 'الأردن' : 'Jordan' }} — {{ $regionName }}
  </div>

  <h1 class="sec-title" style="font-size:clamp(1.8rem,5vw,3rem);margin-bottom:1rem;">
    {{ $isAr
      ? "شركة برمجة في {$city['name_ar']}"
      : "Software Development Company in {$city['name_en']}, Jordan" }}
  </h1>

  <p style="font-size:1.05rem;color:var(--muted);max-width:680px;line-height:1.85;margin-bottom:2.5rem;{{ $isAr ? 'text-align:right;' : '' }}">
    {{ $isAr ? $city['intro_ar'] : $city['intro_en'] }}
  </p>

  {{-- Stats bar --}}
  <div style="display:flex;flex-wrap:wrap;gap:1rem;margin-bottom:3rem;">
    @php $stats = [
      ['icon'=>'👥', 'val'=> $city['pop_en'], 'val_ar'=> $city['pop_ar'],        'label'=>'Population',           'label_ar'=>'عدد السكان'],
      ['icon'=>'🏙', 'val'=> $city['name_en'],'val_ar'=> $city['name_ar'],       'label'=>'City',                 'label_ar'=>'المدينة'],
      ['icon'=>'🗺', 'val'=> $city['region_en'], 'val_ar'=> $city['region_ar'],  'label'=>'Governorate',          'label_ar'=>'المحافظة'],
      ['icon'=>'🚀', 'val'=>'48h',              'val_ar'=>'٤٨ ساعة',              'label'=>'Kickoff Guarantee',    'label_ar'=>'ضمان الانطلاق'],
    ]; @endphp
    @foreach($stats as $stat)
    <div style="flex:1;min-width:140px;background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.07);
                border-radius:10px;padding:1rem;text-align:center;">
      <div style="font-size:1.4rem;margin-bottom:.3rem;">{{ $stat['icon'] }}</div>
      <div style="font-family:'Orbitron',sans-serif;font-size:.85rem;color:var(--gold);">
        {{ $isAr ? $stat['val_ar'] : $stat['val'] }}
      </div>
      <div style="font-size:.72rem;color:var(--muted);margin-top:.2rem;">
        {{ $isAr ? $stat['label_ar'] : $stat['label'] }}
      </div>
    </div>
    @endforeach
  </div>

  {{-- Sectors served --}}
  <div class="wcard" style="padding:2rem;margin-bottom:2rem;">
    <h2 style="font-family:'Orbitron',sans-serif;font-size:.9rem;color:var(--gold);letter-spacing:.06em;margin:0 0 1.2rem;">
      {{ $isAr ? "✦ القطاعات التي نخدمها في {$city['name_ar']}" : "✦ SECTORS WE SERVE IN {$city['name_en']}" }}
    </h2>
    <div style="display:flex;flex-wrap:wrap;gap:.6rem;">
      @foreach($isAr ? $city['sectors_ar'] : $city['sectors_en'] as $sector)
      <span style="background:rgba(245,168,0,.08);border:1px solid rgba(245,168,0,.25);
                   color:var(--gold);border-radius:50px;padding:.3rem 1rem;
                   font-size:.78rem;font-family:'Orbitron',sans-serif;">
        {{ $sector }}
      </span>
      @endforeach
    </div>
  </div>

  {{-- Services grid --}}
  <h2 style="font-family:'Orbitron',sans-serif;font-size:1rem;color:var(--white);margin:2rem 0 1.2rem;">
    {{ $isAr
      ? "🛠 ما نبنيه للشركات في {$city['name_ar']}"
      : "🛠 WHAT WE BUILD FOR {$city['name_en']} BUSINESSES" }}
  </h2>
  <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:1rem;margin-bottom:2.5rem;">
    @foreach($services as $service)
    <div style="background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.07);
                border-radius:10px;padding:1.2rem;display:flex;gap:.8rem;align-items:flex-start;">
      <span style="font-size:1.5rem;flex-shrink:0;">{{ $service->icon }}</span>
      <div>
        <h3 style="font-family:'Orbitron',sans-serif;font-size:.82rem;color:var(--white);margin:0 0 .3rem;">
          @if($service->has_detail)
            <a href="{{ route('services.show', $service->slug) }}" style="color:inherit;text-decoration:none;">
              {{ $service->trans('title') }}
            </a>
          @else
            {{ $service->trans('title') }}
          @endif
        </h3>
        <p style="font-size:.78rem;color:var(--muted);margin:0;line-height:1.6;">
          {{ \Illuminate\Support\Str::limit($service->trans('description'), 90) }}
        </p>
      </div>
    </div>
    @endforeach
  </div>

  {{-- Why choose us in this city --}}
  <div class="wcard" style="padding:2rem;margin-bottom:2rem;border:1px solid rgba(245,168,0,.2);">
    <h2 style="font-family:'Orbitron',sans-serif;font-size:.9rem;color:var(--gold);letter-spacing:.06em;margin:0 0 1.2rem;">
      {{ $isAr
        ? "⭐ لماذا تختار Alien Code في {$city['name_ar']}؟"
        : "⭐ WHY CHOOSE ALIEN CODE IN {$city['name_en']}?" }}
    </h2>
    <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:.8rem;">
      @foreach($isAr ? $city['why_ar'] : $city['why_en'] as $point)
      <li style="font-size:.9rem;color:rgba(255,255,255,.85);line-height:1.7;
                 padding:.6rem 0;border-bottom:1px solid rgba(255,255,255,.06);">
        {{ $point }}
      </li>
      @endforeach
    </ul>
  </div>

  {{-- CTA --}}
  <div style="margin:2.5rem 0;padding:2.5rem;background:rgba(245,168,0,.05);
              border:1px solid rgba(245,168,0,.2);border-radius:14px;text-align:center;">
    <div class="orb-a" style="opacity:.2;"></div>
    <h2 style="font-family:'Orbitron',sans-serif;font-size:1.2rem;color:var(--white);margin:0 0 .8rem;">
      {{ $isAr
        ? "هل أنت في {$city['name_ar']}؟ نحن جاهزون."
        : "Based in {$city['name_en']}? Let\'s Build." }}
    </h2>
    <p style="color:var(--muted);max-width:500px;margin:.5rem auto 1.8rem;line-height:1.7;">
      {{ $isAr
        ? 'احصل على استشارة مجانية مع فريق Alien Code وعرض تقني مفصل خلال 24 ساعة.'
        : 'Get a free consultation with the Alien Code team and a detailed technical proposal within 24 hours.' }}
    </p>
    <a href="{{ route('contact') }}" class="btn-gold">
      🚀 {{ $isAr ? 'ابدأ مشروعك' : 'Start Your Project' }}
    </a>
  </div>

  {{-- FAQ --}}
  <div style="margin-top:2.5rem;">
    <h2 style="font-family:'Orbitron',sans-serif;font-size:1rem;color:var(--white);margin:0 0 1.5rem;">
      {{ $isAr ? 'أسئلة شائعة' : 'Frequently Asked Questions' }}
    </h2>
    @foreach($isAr ? $city['faqs_ar'] : $city['faqs_en'] as $faq)
    <details style="border-bottom:1px solid rgba(255,255,255,.06);padding:.8rem 0;">
      <summary style="font-size:.88rem;color:var(--white);cursor:pointer;list-style:none;
                      display:flex;justify-content:space-between;align-items:center;gap:1rem;">
        <span>{{ $faq['q'] }}</span>
        <span style="color:var(--gold);flex-shrink:0;">+</span>
      </summary>
      <p style="margin:.8rem 0 0;color:var(--muted);font-size:.85rem;line-height:1.75;">{{ $faq['a'] }}</p>
    </details>
    @endforeach
  </div>

  {{-- Other cities --}}
  <div style="margin-top:3rem;">
    <h2 style="font-family:'Orbitron',sans-serif;font-size:.85rem;color:var(--gold);letter-spacing:.06em;margin:0 0 1rem;">
      {{ $isAr ? 'نخدم كذلك' : 'WE ALSO SERVE' }}
    </h2>
    <div style="display:flex;flex-wrap:wrap;gap:.7rem;">
      @php $others = [
        ['amman','Amman','عمّان'],['zarqa','Zarqa','الزرقاء'],
        ['irbid','Irbid','إربد'],['aqaba','Aqaba','العقبة'],
      ]; @endphp
      @foreach($others as [$slug, $nameEn, $nameAr])
        @if($slug !== $city['slug'])
        <a href="{{ route('locations.show', $slug) }}"
           style="background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.08);
                  border-radius:8px;padding:.5rem 1.2rem;font-size:.8rem;font-family:'Orbitron',sans-serif;
                  color:var(--muted);text-decoration:none;transition:color .2s,border-color .2s;"
           onmouseover="this.style.color='var(--gold)';this.style.borderColor='rgba(245,168,0,.3)'"
           onmouseout="this.style.color='var(--muted)';this.style.borderColor='rgba(255,255,255,.08)'">
          {{ $isAr ? $nameAr : $nameEn }}
        </a>
        @endif
      @endforeach
    </div>
  </div>

</section>

@endsection

@section('page-schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": ["LocalBusiness", "SoftwareApplication"],
      "@id": "{{ $siteUrl }}/#organization",
      "name": "Alien Code",
      "description": "{{ $isAr ? "شركة تطوير برمجيات في {$city['name_ar']}, الأردن" : "Software development company in {$city['name_en']}, Jordan" }}",
      "url": "{{ $pageUrl }}",
      "telephone": "{{ \App\Models\Setting::getValue('phone', '') }}",
      "address": {
        "@type": "PostalAddress",
        "addressLocality": "{{ $city['name_en'] }}",
        "addressRegion": "{{ $city['region_en'] }}",
        "addressCountry": "JO"
      },
      "areaServed": {
        "@type": "City",
        "name": "{{ $city['name_en'] }}"
      },
      "serviceType": "Software Development",
      "priceRange": "$$",
      "image": "{{ $siteUrl }}/images/og-default.jpg",
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": {{ $city['lat'] }},
        "longitude": {{ $city['lng'] }}
      }
    },
    {
      "@type": "BreadcrumbList",
      "itemListElement": [
        { "@type": "ListItem", "position": 1, "name": "Home",     "item": "{{ $siteUrl }}" },
        { "@type": "ListItem", "position": 2, "name": "Services", "item": "{{ route('services') }}" },
        { "@type": "ListItem", "position": 3, "name": "{{ $cityName }}", "item": "{{ $pageUrl }}" }
      ]
    }
  ]
}
</script>
@endsection
