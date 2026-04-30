<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"
      dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}"
      prefix="og: https://ogp.me/ns#">
<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">

  @php
    $locale = app()->getLocale();
    $isAr   = $locale === 'ar';
    $hero   = \App\Models\HeroSection::active();
    $s      = fn($k, $d='') => \App\Models\Setting::getValue($k, $d);

    $metaTitle = trim(View::yieldContent('meta-title'))
        ?: ($isAr ? $hero->meta_title_ar : $hero->meta_title_en);

    $metaDesc  = trim(View::yieldContent('meta-desc'))
        ?: ($isAr ? $hero->meta_description_ar : $hero->meta_description_en);

    $metaKw    = $isAr
        ? ($hero->meta_keywords_ar ?: $s('meta_keywords_ar'))
        : ($hero->meta_keywords_en ?: $s('meta_keywords_en'));

    $ogTitle   = $isAr ? ($hero->og_title_ar ?: $metaTitle) : ($hero->og_title_en ?: $metaTitle);
    $ogDesc    = $isAr ? ($hero->og_description_ar ?: $metaDesc) : ($hero->og_description_en ?: $metaDesc);
    $ogImage   = $hero->og_image ? asset('storage/'.$hero->og_image) : asset('images/og-default.jpg');
    $canonical = $isAr ? ($hero->canonical_url_ar ?: url()->current()) : ($hero->canonical_url_en ?: url()->current());
    $robots    = $hero->robots ?? 'index, follow';
    $siteName  = $s('site_name_'.$locale, 'Alien Code');
    $siteUrl   = $s('canonical_url', 'https://alien-code.io');
    $gaId      = $s('ga_id');
    $gtmId     = $s('gtm_id');

    $orgName   = $hero->schema_org_name ?? 'Alien Code';
    $orgType   = $hero->schema_org_type ?? 'SoftwareCompany';
    $orgUrl    = $hero->schema_org_url  ?? $siteUrl;
    $orgLogo   = $hero->schema_org_logo ? asset('storage/'.$hero->schema_org_logo) : asset('images/logo.png');
    $orgDesc   = $isAr ? ($hero->schema_org_description_ar ?? $metaDesc) : ($hero->schema_org_description_en ?? $metaDesc);
    $orgYear   = $hero->schema_org_founding_year ?? '2016';
    $branches  = \App\Models\Branch::active()->ordered()->get();
    $sameAs    = array_values(array_filter([$s('linkedin'),$s('twitter'),$s('github'),$s('instagram'),$s('dribbble')]));
  @endphp

  {{-- ── Title & Basic Meta ─────────────────────────────── --}}
  <title>{{ $metaTitle }}</title>
  <meta name="description"   content="{{ $metaDesc }}">
  @if($metaKw)<meta name="keywords" content="{{ $metaKw }}">@endif
  <meta name="robots"        content="{{ $robots }}">
  <meta name="author"        content="{{ $orgName }}">
  <meta name="theme-color"   content="#f5a800">
  <link rel="canonical"      href="{{ $canonical }}">

  {{-- ── Hreflang ─────────────────────────────────────────── --}}
  <link rel="alternate" hreflang="en"        href="{{ LaravelLocalization::getLocalizedURL('en',null,[],true) }}">
  <link rel="alternate" hreflang="ar"        href="{{ LaravelLocalization::getLocalizedURL('ar',null,[],true) }}">
  <link rel="alternate" hreflang="x-default" href="{{ $siteUrl }}">

  {{-- ── Open Graph ──────────────────────────────────────── --}}
  <meta property="og:type"             content="website">
  <meta property="og:url"              content="{{ $canonical }}">
  <meta property="og:site_name"        content="{{ $siteName }}">
  <meta property="og:title"            content="{{ $ogTitle }}">
  <meta property="og:description"      content="{{ $ogDesc }}">
  <meta property="og:image"            content="{{ $ogImage }}">
  <meta property="og:image:width"      content="1200">
  <meta property="og:image:height"     content="630">
  <meta property="og:image:alt"        content="{{ $siteName }}">
  <meta property="og:locale"           content="{{ $isAr ? 'ar_JO' : 'en_US' }}">
  <meta property="og:locale:alternate" content="{{ $isAr ? 'en_US' : 'ar_JO' }}">

  {{-- ── Twitter Card ────────────────────────────────────── --}}
  <meta name="twitter:card"        content="{{ $hero->twitter_card ?? 'summary_large_image' }}">
  <meta name="twitter:site"        content="{{ $s('twitter_site','@aliencode') }}">
  <meta name="twitter:title"       content="{{ $isAr ? ($hero->twitter_title_ar ?? $ogTitle) : ($hero->twitter_title_en ?? $ogTitle) }}">
  <meta name="twitter:description" content="{{ $isAr ? ($hero->twitter_description_ar ?? $ogDesc) : ($hero->twitter_description_en ?? $ogDesc) }}">
  <meta name="twitter:image"       content="{{ $ogImage }}">

  {{-- ── Favicons ─────────────────────────────────────────── --}}
  <link rel="icon"             type="image/svg+xml" href="{{ asset('images/favicon.svg') }}">
  <link rel="icon"             type="image/png"     href="{{ asset('images/favicon-32.png') }}" sizes="32x32">
  <link rel="apple-touch-icon"                      href="{{ asset('images/apple-touch-icon.png') }}">
  <link rel="manifest"                              href="{{ asset('site.webmanifest') }}">

  {{-- ── Google Verification ────────────────────────────── --}}
  @if($gv = $s('google_site_verify'))<meta name="google-site-verification" content="{{ $gv }}">@endif

  {{-- ── GTM head ─────────────────────────────────────────── --}}
  @if($gtmId)
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','{{ $gtmId }}');</script>
  @endif

  {{-- ── GA4 (only if no GTM) ───────────────────────────── --}}
  @if($gaId && !$gtmId)
  <script async src="https://www.googletagmanager.com/gtag/js?id={{ $gaId }}"></script>
  <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','{{ $gaId }}');</script>
  @endif

  {{-- ── Schema.org JSON-LD ─────────────────────────────── --}}
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@graph": [
      {
        "@type": "{{ $orgType }}",
        "@id": "{{ $orgUrl }}/#organization",
        "name": "{{ $orgName }}",
        "url": "{{ $orgUrl }}",
        "logo": { "@type": "ImageObject", "url": "{{ $orgLogo }}", "width": 200, "height": 60 },
        "description": "{{ addslashes($orgDesc) }}",
        "foundingDate": "{{ $orgYear }}",
        "numberOfEmployees": { "@type": "QuantitativeValue", "value": {{ $hero->schema_org_number_of_employees ?? 50 }} },
        "contactPoint": {
          "@type": "ContactPoint",
          "telephone": "{{ $s('contact_phone','+962 6 500 0000') }}",
          "email": "{{ $s('contact_email','hello@alien-code.io') }}",
          "contactType": "customer service",
          "availableLanguage": ["English","Arabic"]
        },
        "sameAs": [{{ implode(',', array_map(fn($u)=>'"'.$u.'"', $sameAs)) }}],
        "address": [
          @foreach($branches as $bi => $branch)
          { "@type":"PostalAddress","addressLocality":"{{ $branch->city_en }}","addressCountry":"{{ $branch->country_en }}","streetAddress":"{{ $branch->address_en }}" }{{ $bi < $branches->count()-1 ? ',' : '' }}
          @endforeach
        ]
      },
      {
        "@type": "WebSite",
        "@id": "{{ $orgUrl }}/#website",
        "url": "{{ $orgUrl }}",
        "name": "{{ $orgName }}",
        "publisher": { "@id": "{{ $orgUrl }}/#organization" },
        "potentialAction": { "@type":"SearchAction","target":{ "@type":"EntryPoint","urlTemplate":"{{ $orgUrl }}/search?q={search_term_string}" },"query-input":"required name=search_term_string" },
        "inLanguage": ["en","ar"]
      },
      {
        "@type": "WebPage",
        "@id": "{{ $canonical }}/#webpage",
        "url": "{{ $canonical }}",
        "name": "{{ addslashes($metaTitle) }}",
        "description": "{{ addslashes($metaDesc) }}",
        "isPartOf": { "@id": "{{ $orgUrl }}/#website" },
        "about": { "@id": "{{ $orgUrl }}/#organization" },
        "inLanguage": "{{ $locale }}"
      },
      {
        "@type": "BreadcrumbList",
        "itemListElement": [{ "@type":"ListItem","position":1,"name":"Home","item":"{{ $orgUrl }}" }]
      }
    ]
  }
  </script>

  {{-- ── FAQ Schema ───────────────────────────────────────── --}}
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [
      { "@type":"Question","name":"What services does Alien Code provide?","acceptedAnswer":{ "@type":"Answer","text":"Alien Code provides web development, mobile app development, AI and machine learning, cloud and DevOps, blockchain and Web3 development, and UI/UX design services." } },
      { "@type":"Question","name":"Where is Alien Code located?","acceptedAnswer":{ "@type":"Answer","text":"Alien Code is headquartered in Amman, Jordan with offices in Dubai (UAE), London (UK), and New York (USA)." } },
      { "@type":"Question","name":"How many projects has Alien Code delivered?","acceptedAnswer":{ "@type":"Answer","text":"Alien Code has delivered over {{ $hero->stat_projects }} projects worldwide with a {{ $hero->stat_satisfaction }}% client satisfaction rate." } },
      { "@type":"Question","name":"Does Alien Code work with startups?","acceptedAnswer":{ "@type":"Answer","text":"Yes. Alien Code works with both early-stage startups and Fortune 500 enterprises, building scalable software solutions tailored to each client's needs." } }
    ]
  }
  </script>

  {{-- ── Fonts ────────────────────────────────────────────── --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Exo+2:ital,wght@0,300;0,400;0,600;0,700;1,400&family=Share+Tech+Mono&family=Cairo:wght@400;600;700;900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('assets_front/css/style.css') }}">
  @stack('head')
</head>
<body>

  @if($gtmId)
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ $gtmId }}" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  @endif

  <div id="cursor"></div>
  <div id="cursor-ring"></div>

  <div id="loader">
    <div class="loader-logo">ALIEN CODE</div>
    <div class="loader-bar"><div class="loader-fill" id="loaderFill"></div></div>
    <div class="loader-text" id="loaderText">{{ $isAr ? 'جاري تشغيل الأنظمة...' : 'Initializing systems...' }}</div>
  </div>

  @include('front.includes.navbar')
  @yield('content')
  @include('front.includes.footer')

  <script src="{{ asset('assets_front/js/main.js') }}"></script>
  <script>
    const _t=document.getElementById('navToggle'),_m=document.getElementById('navMenu');
    if(_t&&_m){_t.addEventListener('click',()=>{const o=_t.classList.toggle('open');_m.classList.toggle('open',o);_t.setAttribute('aria-expanded',o);});_m.querySelectorAll('a').forEach(a=>a.addEventListener('click',()=>{_t.classList.remove('open');_m.classList.remove('open');_t.setAttribute('aria-expanded',false);}));}
  </script>
  @stack('scripts')
</body>
</html>