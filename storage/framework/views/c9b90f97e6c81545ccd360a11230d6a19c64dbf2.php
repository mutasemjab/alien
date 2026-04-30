<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>"
      dir="<?php echo e(app()->getLocale() === 'ar' ? 'rtl' : 'ltr'); ?>"
      prefix="og: https://ogp.me/ns#">
<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">

  <?php
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
  ?>

  
  <title><?php echo e($metaTitle); ?></title>
  <meta name="description"   content="<?php echo e($metaDesc); ?>">
  <?php if($metaKw): ?><meta name="keywords" content="<?php echo e($metaKw); ?>"><?php endif; ?>
  <meta name="robots"        content="<?php echo e($robots); ?>">
  <meta name="author"        content="<?php echo e($orgName); ?>">
  <meta name="theme-color"   content="#f5a800">
  <link rel="canonical"      href="<?php echo e($canonical); ?>">

  
  <link rel="alternate" hreflang="en"        href="<?php echo e(LaravelLocalization::getLocalizedURL('en',null,[],true)); ?>">
  <link rel="alternate" hreflang="ar"        href="<?php echo e(LaravelLocalization::getLocalizedURL('ar',null,[],true)); ?>">
  <link rel="alternate" hreflang="x-default" href="<?php echo e($siteUrl); ?>">

  
  <meta property="og:type"             content="website">
  <meta property="og:url"              content="<?php echo e($canonical); ?>">
  <meta property="og:site_name"        content="<?php echo e($siteName); ?>">
  <meta property="og:title"            content="<?php echo e($ogTitle); ?>">
  <meta property="og:description"      content="<?php echo e($ogDesc); ?>">
  <meta property="og:image"            content="<?php echo e($ogImage); ?>">
  <meta property="og:image:width"      content="1200">
  <meta property="og:image:height"     content="630">
  <meta property="og:image:alt"        content="<?php echo e($siteName); ?>">
  <meta property="og:locale"           content="<?php echo e($isAr ? 'ar_JO' : 'en_US'); ?>">
  <meta property="og:locale:alternate" content="<?php echo e($isAr ? 'en_US' : 'ar_JO'); ?>">

  
  <meta name="twitter:card"        content="<?php echo e($hero->twitter_card ?? 'summary_large_image'); ?>">
  <meta name="twitter:site"        content="<?php echo e($s('twitter_site','@aliencode')); ?>">
  <meta name="twitter:title"       content="<?php echo e($isAr ? ($hero->twitter_title_ar ?? $ogTitle) : ($hero->twitter_title_en ?? $ogTitle)); ?>">
  <meta name="twitter:description" content="<?php echo e($isAr ? ($hero->twitter_description_ar ?? $ogDesc) : ($hero->twitter_description_en ?? $ogDesc)); ?>">
  <meta name="twitter:image"       content="<?php echo e($ogImage); ?>">

  
  <link rel="icon"             type="image/svg+xml" href="<?php echo e(asset('images/favicon.svg')); ?>">
  <link rel="icon"             type="image/png"     href="<?php echo e(asset('images/favicon-32.png')); ?>" sizes="32x32">
  <link rel="apple-touch-icon"                      href="<?php echo e(asset('images/apple-touch-icon.png')); ?>">
  <link rel="manifest"                              href="<?php echo e(asset('site.webmanifest')); ?>">

  
  <?php if($gv = $s('google_site_verify')): ?><meta name="google-site-verification" content="<?php echo e($gv); ?>"><?php endif; ?>

  
  <?php if($gtmId): ?>
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','<?php echo e($gtmId); ?>');</script>
  <?php endif; ?>

  
  <?php if($gaId && !$gtmId): ?>
  <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo e($gaId); ?>"></script>
  <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','<?php echo e($gaId); ?>');</script>
  <?php endif; ?>

  
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@graph": [
      {
        "@type": "<?php echo e($orgType); ?>",
        "@id": "<?php echo e($orgUrl); ?>/#organization",
        "name": "<?php echo e($orgName); ?>",
        "url": "<?php echo e($orgUrl); ?>",
        "logo": { "@type": "ImageObject", "url": "<?php echo e($orgLogo); ?>", "width": 200, "height": 60 },
        "description": "<?php echo e(addslashes($orgDesc)); ?>",
        "foundingDate": "<?php echo e($orgYear); ?>",
        "numberOfEmployees": { "@type": "QuantitativeValue", "value": <?php echo e($hero->schema_org_number_of_employees ?? 50); ?> },
        "contactPoint": {
          "@type": "ContactPoint",
          "telephone": "<?php echo e($s('contact_phone','+962 6 500 0000')); ?>",
          "email": "<?php echo e($s('contact_email','hello@alien-code.io')); ?>",
          "contactType": "customer service",
          "availableLanguage": ["English","Arabic"]
        },
        "sameAs": [<?php echo e(implode(',', array_map(fn($u)=>'"'.$u.'"', $sameAs))); ?>],
        "address": [
          <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bi => $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          { "@type":"PostalAddress","addressLocality":"<?php echo e($branch->city_en); ?>","addressCountry":"<?php echo e($branch->country_en); ?>","streetAddress":"<?php echo e($branch->address_en); ?>" }<?php echo e($bi < $branches->count()-1 ? ',' : ''); ?>

          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        ]
      },
      {
        "@type": "WebSite",
        "@id": "<?php echo e($orgUrl); ?>/#website",
        "url": "<?php echo e($orgUrl); ?>",
        "name": "<?php echo e($orgName); ?>",
        "publisher": { "@id": "<?php echo e($orgUrl); ?>/#organization" },
        "potentialAction": { "@type":"SearchAction","target":{ "@type":"EntryPoint","urlTemplate":"<?php echo e($orgUrl); ?>/search?q={search_term_string}" },"query-input":"required name=search_term_string" },
        "inLanguage": ["en","ar"]
      },
      {
        "@type": "WebPage",
        "@id": "<?php echo e($canonical); ?>/#webpage",
        "url": "<?php echo e($canonical); ?>",
        "name": "<?php echo e(addslashes($metaTitle)); ?>",
        "description": "<?php echo e(addslashes($metaDesc)); ?>",
        "isPartOf": { "@id": "<?php echo e($orgUrl); ?>/#website" },
        "about": { "@id": "<?php echo e($orgUrl); ?>/#organization" },
        "inLanguage": "<?php echo e($locale); ?>"
      },
      {
        "@type": "BreadcrumbList",
        "itemListElement": [{ "@type":"ListItem","position":1,"name":"Home","item":"<?php echo e($orgUrl); ?>" }]
      }
    ]
  }
  </script>

  
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [
      { "@type":"Question","name":"What services does Alien Code provide?","acceptedAnswer":{ "@type":"Answer","text":"Alien Code provides web development, mobile app development, AI and machine learning, cloud and DevOps, blockchain and Web3 development, and UI/UX design services." } },
      { "@type":"Question","name":"Where is Alien Code located?","acceptedAnswer":{ "@type":"Answer","text":"Alien Code is headquartered in Amman, Jordan with offices in Dubai (UAE), London (UK), and New York (USA)." } },
      { "@type":"Question","name":"How many projects has Alien Code delivered?","acceptedAnswer":{ "@type":"Answer","text":"Alien Code has delivered over <?php echo e($hero->stat_projects); ?> projects worldwide with a <?php echo e($hero->stat_satisfaction); ?>% client satisfaction rate." } },
      { "@type":"Question","name":"Does Alien Code work with startups?","acceptedAnswer":{ "@type":"Answer","text":"Yes. Alien Code works with both early-stage startups and Fortune 500 enterprises, building scalable software solutions tailored to each client's needs." } }
    ]
  }
  </script>

  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Exo+2:ital,wght@0,300;0,400;0,600;0,700;1,400&family=Share+Tech+Mono&family=Cairo:wght@400;600;700;900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="<?php echo e(asset('assets_front/css/style.css')); ?>">
  <?php echo $__env->yieldPushContent('head'); ?>
</head>
<body>

  <?php if($gtmId): ?>
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo e($gtmId); ?>" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <?php endif; ?>

  <div id="cursor"></div>
  <div id="cursor-ring"></div>

  <div id="loader">
    <div class="loader-logo">ALIEN CODE</div>
    <div class="loader-bar"><div class="loader-fill" id="loaderFill"></div></div>
    <div class="loader-text" id="loaderText"><?php echo e($isAr ? 'جاري تشغيل الأنظمة...' : 'Initializing systems...'); ?></div>
  </div>

  <?php echo $__env->make('front.includes.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->yieldContent('content'); ?>
  <?php echo $__env->make('front.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <script src="<?php echo e(asset('assets_front/js/main.js')); ?>"></script>
  <script>
    const _t=document.getElementById('navToggle'),_m=document.getElementById('navMenu');
    if(_t&&_m){_t.addEventListener('click',()=>{const o=_t.classList.toggle('open');_m.classList.toggle('open',o);_t.setAttribute('aria-expanded',o);});_m.querySelectorAll('a').forEach(a=>a.addEventListener('click',()=>{_t.classList.remove('open');_m.classList.remove('open');_t.setAttribute('aria-expanded',false);}));}
  </script>
  <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH C:\xampp\htdocs\alien\resources\views/layouts/front.blade.php ENDPATH**/ ?>