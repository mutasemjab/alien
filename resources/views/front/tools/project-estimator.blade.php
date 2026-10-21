@extends('layouts.front')

@php
  $locale  = app()->getLocale();
  $isAr    = $locale === 'ar';
  $siteUrl = \App\Models\Setting::getValue('canonical_url', config('app.url'));
  $pageUrl = route('tools.project-estimator');
@endphp

@section('meta-title', $isAr
  ? 'مُقدِّر تكلفة المشروع البرمجي الأردن 2024 | Alien Code'
  : 'Software Project Cost Estimator Jordan 2024 | Alien Code')

@section('meta-desc', $isAr
  ? 'احصل على تقدير فوري لتكلفة موقعك الإلكتروني أو تطبيق الجوال أو نظام ERP في الأردن. مبني على أسعار السوق الأردني والشرق الأوسط.'
  : 'Get an instant cost estimate for your website, mobile app, or ERP system in Jordan. Based on Jordan and MENA market rates from a leading Amman software company.')

@section('canonical', $pageUrl)

@section('content')

<section style="padding:6rem 0 2rem;max-width:960px;margin:0 auto;{{ $isAr ? 'direction:rtl;' : '' }}">

  {{-- Breadcrumb --}}
  <nav aria-label="breadcrumb" style="font-size:.75rem;color:var(--muted);font-family:'Orbitron',sans-serif;
       display:flex;gap:.5rem;align-items:center;flex-wrap:wrap;margin-bottom:2.5rem;">
    <a href="{{ route('home') }}"        style="color:var(--muted);text-decoration:none;">{{ $isAr ? 'الرئيسية' : 'Home' }}</a>
    <span>›</span>
    <a href="{{ route('tools.index') }}"  style="color:var(--muted);text-decoration:none;">{{ $isAr ? 'أدوات مجانية' : 'Free Tools' }}</a>
    <span>›</span>
    <span style="color:var(--gold);">{{ $isAr ? 'مُقدِّر التكلفة' : 'Cost Estimator' }}</span>
  </nav>

  <div class="sec-label" style="justify-content:{{ $isAr ? 'flex-end' : 'flex-start' }};margin-bottom:.8rem;">
    {{ $isAr ? 'حاسبات الأردن' : 'Jordan Market Rates' }}
  </div>
  <h1 class="sec-title" style="font-size:clamp(1.6rem,4vw,2.4rem);margin-bottom:.8rem;">
    {{ $isAr ? 'مُقدِّر تكلفة المشروع البرمجي' : 'Software Project Cost Estimator' }}
  </h1>
  <p style="color:var(--muted);max-width:640px;line-height:1.8;margin-bottom:2.5rem;{{ $isAr ? 'text-align:right;' : '' }}">
    {{ $isAr
      ? 'اختر نوع مشروعك والميزات المطلوبة لتحصل على نطاق تكلفة استرشادي بناءً على أسعار السوق الأردني والمنطقة. هذه الأداة لا تُغني عن عرض السعر الرسمي.'
      : 'Select your project type and required features to get an indicative cost range based on current Jordan and MENA market rates. This tool gives a starting point — not a final quote.' }}
  </p>

  <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;align-items:start;">

    {{-- Inputs --}}
    <div>
      {{-- Step 1: Project type --}}
      <div class="wcard" style="padding:2rem;margin-bottom:1.5rem;">
        <h2 style="font-family:'Orbitron',sans-serif;font-size:.85rem;color:var(--gold);letter-spacing:.06em;margin:0 0 1.2rem;">
          {{ $isAr ? '01 — نوع المشروع' : '01 — PROJECT TYPE' }}
        </h2>
        @php
          $types = $isAr ? [
            ['id'=>'landing',   'icon'=>'🌐', 'name'=>'صفحة هبوط / موقع بسيط',   'desc'=>'صفحة واحدة أو موقع عرض'],
            ['id'=>'website',   'icon'=>'💼', 'name'=>'موقع أعمال + نظام إدارة', 'desc'=>'موقع مع لوحة تحكم CMS'],
            ['id'=>'ecommerce', 'icon'=>'🛍', 'name'=>'متجر إلكتروني',            'desc'=>'منصة تجارة إلكترونية'],
            ['id'=>'mobile',    'icon'=>'📱', 'name'=>'تطبيق جوال',               'desc'=>'iOS و/أو Android'],
            ['id'=>'webapp',    'icon'=>'⚡', 'name'=>'تطبيق ويب / SaaS',         'desc'=>'منصة ويب متقدمة'],
            ['id'=>'erp',       'icon'=>'🏢', 'name'=>'نظام ERP / مؤسسي',         'desc'=>'نظام متكامل للمؤسسات'],
            ['id'=>'ai',        'icon'=>'🤖', 'name'=>'حل ذكاء اصطناعي',          'desc'=>'نماذج AI، تحليل بيانات'],
          ] : [
            ['id'=>'landing',   'icon'=>'🌐', 'name'=>'Landing Page / Brochure',  'desc'=>'Single-page or simple site'],
            ['id'=>'website',   'icon'=>'💼', 'name'=>'Business Website + CMS',   'desc'=>'Site with admin panel'],
            ['id'=>'ecommerce', 'icon'=>'🛍', 'name'=>'E-commerce Store',          'desc'=>'Online shopping platform'],
            ['id'=>'mobile',    'icon'=>'📱', 'name'=>'Mobile App',                'desc'=>'iOS and/or Android'],
            ['id'=>'webapp',    'icon'=>'⚡', 'name'=>'Web App / SaaS Platform',   'desc'=>'Advanced web application'],
            ['id'=>'erp',       'icon'=>'🏢', 'name'=>'ERP / Enterprise System',   'desc'=>'Full enterprise solution'],
            ['id'=>'ai',        'icon'=>'🤖', 'name'=>'AI-Powered Solution',        'desc'=>'ML models, data pipelines'],
          ];
        @endphp
        <div style="display:grid;gap:.5rem;">
          @foreach($types as $t)
          <label style="display:flex;align-items:center;gap:.8rem;padding:.7rem .9rem;
                        background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.07);
                        border-radius:8px;cursor:pointer;transition:border-color .2s;"
                 class="est-type-label">
            <input type="radio" name="est-type" value="{{ $t['id'] }}" style="accent-color:var(--gold);">
            <span style="font-size:1.1rem;">{{ $t['icon'] }}</span>
            <span>
              <span style="font-size:.85rem;color:var(--white);font-family:'Orbitron',sans-serif;">{{ $t['name'] }}</span>
              <span style="display:block;font-size:.75rem;color:var(--muted);">{{ $t['desc'] }}</span>
            </span>
          </label>
          @endforeach
        </div>
      </div>

      {{-- Step 2: Features --}}
      <div class="wcard" style="padding:2rem;">
        <h2 style="font-family:'Orbitron',sans-serif;font-size:.85rem;color:var(--gold);letter-spacing:.06em;margin:0 0 1.2rem;">
          {{ $isAr ? '02 — الميزات المطلوبة' : '02 — REQUIRED FEATURES' }}
        </h2>
        @php
          $features = $isAr ? [
            ['id'=>'auth',       'icon'=>'🔑', 'name'=>'نظام تسجيل الدخول والمستخدمين'],
            ['id'=>'payment',    'icon'=>'💳', 'name'=>'بوابة دفع إلكتروني'],
            ['id'=>'admin',      'icon'=>'🖥',  'name'=>'لوحة تحكم إدارية'],
            ['id'=>'multilang',  'icon'=>'🌍', 'name'=>'دعم متعدد اللغات'],
            ['id'=>'push',       'icon'=>'🔔', 'name'=>'إشعارات فورية (Push)'],
            ['id'=>'api',        'icon'=>'🔌', 'name'=>'تكامل مع APIs خارجية'],
            ['id'=>'ai',         'icon'=>'🤖', 'name'=>'ميزات ذكاء اصطناعي'],
            ['id'=>'analytics',  'icon'=>'📊', 'name'=>'تحليلات وتقارير متقدمة'],
            ['id'=>'multitenant','icon'=>'🏗',  'name'=>'نظام Multi-Tenant (SaaS)'],
            ['id'=>'workflow',   'icon'=>'⚙',  'name'=>'محرك سير عمل مخصص'],
          ] : [
            ['id'=>'auth',       'icon'=>'🔑', 'name'=>'User Authentication & Roles'],
            ['id'=>'payment',    'icon'=>'💳', 'name'=>'Payment Gateway Integration'],
            ['id'=>'admin',      'icon'=>'🖥',  'name'=>'Admin Dashboard'],
            ['id'=>'multilang',  'icon'=>'🌍', 'name'=>'Multi-language Support'],
            ['id'=>'push',       'icon'=>'🔔', 'name'=>'Push Notifications'],
            ['id'=>'api',        'icon'=>'🔌', 'name'=>'Third-party API Integrations'],
            ['id'=>'ai',         'icon'=>'🤖', 'name'=>'AI / ML Features'],
            ['id'=>'analytics',  'icon'=>'📊', 'name'=>'Analytics & Reporting'],
            ['id'=>'multitenant','icon'=>'🏗',  'name'=>'Multi-Tenant SaaS Architecture'],
            ['id'=>'workflow',   'icon'=>'⚙',  'name'=>'Custom Workflow Engine'],
          ];
        @endphp
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:.4rem;">
          @foreach($features as $f)
          <label style="display:flex;align-items:center;gap:.5rem;padding:.5rem .7rem;
                        background:rgba(255,255,255,.02);border:1px solid rgba(255,255,255,.05);
                        border-radius:6px;cursor:pointer;font-size:.8rem;color:var(--muted);">
            <input type="checkbox" class="est-feature" value="{{ $f['id'] }}" style="accent-color:var(--gold);">
            <span>{{ $f['icon'] }}</span>
            <span>{{ $f['name'] }}</span>
          </label>
          @endforeach
        </div>
      </div>
    </div>

    {{-- Results --}}
    <div>
      <div id="est-results" style="display:none;">
        <div class="wcard" style="padding:2rem;margin-bottom:1.5rem;border:1px solid rgba(245,168,0,.25);">
          <h2 style="font-family:'Orbitron',sans-serif;font-size:.85rem;color:var(--gold);letter-spacing:.06em;margin:0 0 1.5rem;">
            {{ $isAr ? '💡 التقدير الاسترشادي' : '💡 INDICATIVE ESTIMATE' }}
          </h2>
          <div style="text-align:center;padding:1rem 0;">
            <p style="font-size:.78rem;color:var(--muted);margin:0 0 .4rem;">
              {{ $isAr ? 'النطاق التقديري للتكلفة' : 'Estimated Cost Range' }}
            </p>
            <div id="r-range" style="font-family:'Orbitron',sans-serif;font-size:1.4rem;color:var(--gold);margin:.4rem 0;">
              —
            </div>
            <p style="font-size:.75rem;color:var(--muted);margin:.3rem 0 0;">USD</p>
          </div>
          <div style="display:flex;justify-content:space-between;padding:.7rem 0;border-top:1px solid rgba(255,255,255,.06);margin-top:.8rem;">
            <span style="color:var(--muted);font-size:.83rem;">{{ $isAr ? 'المدة الزمنية المعتادة' : 'Typical Timeline' }}</span>
            <span id="r-timeline" style="font-family:'Orbitron',sans-serif;font-size:.85rem;color:var(--white);">—</span>
          </div>
        </div>

        {{-- CTA --}}
        <div class="wcard" style="padding:2rem;text-align:center;background:rgba(245,168,0,.04);border:1px solid rgba(245,168,0,.2);">
          <h2 style="font-family:'Orbitron',sans-serif;font-size:1rem;color:var(--white);margin:0 0 .7rem;">
            {{ __('front.tool_est_cta_title') }}
          </h2>
          <p style="color:var(--muted);font-size:.85rem;line-height:1.7;margin:0 0 1.5rem;">
            {{ __('front.tool_est_cta_desc') }}
          </p>
          <a href="{{ route('contact') }}" class="btn-gold">
            🚀 {{ __('front.tool_est_cta_btn') }}
          </a>
          <p style="font-size:.75rem;color:var(--muted);margin:1rem 0 0;opacity:.7;">
            {{ __('front.tool_est_disclaimer') }}
          </p>
        </div>
      </div>

      {{-- Placeholder before selection --}}
      <div id="est-placeholder" class="wcard" style="padding:2.5rem;text-align:center;border:1px dashed rgba(255,255,255,.1);">
        <div style="font-size:2.5rem;margin-bottom:.8rem;">📋</div>
        <p style="color:var(--muted);font-size:.88rem;line-height:1.7;">
          {{ $isAr ? 'اختر نوع المشروع من القائمة على اليسار للحصول على التقدير.' : 'Select a project type from the left to see the cost estimate.' }}
        </p>
      </div>

      {{-- What's included note --}}
      <div style="margin-top:1.5rem;padding:1.2rem;background:rgba(255,255,255,.02);border:1px solid rgba(255,255,255,.06);border-radius:10px;font-size:.8rem;color:var(--muted);line-height:1.7;">
        <strong style="color:var(--white);display:block;margin-bottom:.4rem;">
          {{ $isAr ? '💬 ماذا يشمل التقدير؟' : '💬 What\'s included in the estimate?' }}
        </strong>
        {{ $isAr
          ? 'التصميم، التطوير، الاختبار، والنشر الأولي. لا يشمل الصيانة المستمرة، استضافة الخوادم، أو أعمال المحتوى.'
          : 'Design, development, testing, and initial deployment. Excludes ongoing maintenance, server hosting, and content creation.' }}
      </div>
    </div>

  </div>

  <p style="font-size:.78rem;color:var(--muted);margin-top:1.5rem;line-height:1.6;opacity:.7;{{ $isAr ? 'text-align:right;' : '' }}">
    ⚠ {{ __('front.tool_est_disclaimer') }}
  </p>

  {{-- FAQ --}}
  <div style="margin-top:3rem;">
    <h2 style="font-family:'Orbitron',sans-serif;font-size:1rem;color:var(--white);margin:0 0 1.5rem;">
      {{ __('front.tools_faq') }}
    </h2>
    @php $faqs = $isAr ? [
      ['q'=>'كم تكلفة تطوير تطبيق جوال في الأردن؟',
       'a'=>'تتراوح تكلفة تطوير تطبيق جوال أساسي في الأردن بين 8,000 و20,000 دولار، وتزيد للتطبيقات المعقدة أو التي تتطلب ميزات متقدمة مثل الدفع الإلكتروني أو الذكاء الاصطناعي.'],
      ['q'=>'كم تكلفة تطوير موقع إلكتروني في الأردن؟',
       'a'=>'الموقع البسيط يبدأ من 800 دولار. الموقع مع نظام إدارة محتوى يتراوح بين 2,000 و6,000 دولار. متاجر التجارة الإلكترونية تبدأ من 4,000 دولار.'],
      ['q'=>'ما هي عوامل التأثير على تكلفة المشروع البرمجي؟',
       'a'=>'أبرز العوامل: تعقيد المشروع وعدد الميزات المطلوبة، جودة التصميم، عدد الأنظمة المتكاملة، خبرة الفريق المطور، والمدة الزمنية المحددة.'],
      ['q'=>'هل تقدم Alien Code عروض أسعار مجانية؟',
       'a'=>'نعم، يقدم فريق Alien Code دراسة تقنية ومالية مجانية لكل مشروع. تواصل معنا لتحصل على عرض سعر مخصص خلال 24 ساعة.'],
    ] : [
      ['q'=>'How much does mobile app development cost in Jordan?',
       'a'=>'A basic mobile app developed in Jordan typically costs between $8,000 and $20,000. Complex apps with payment gateways, AI features, or advanced integrations can exceed $40,000.'],
      ['q'=>'How much does a website cost to build in Jordan?',
       'a'=>'A simple brochure site starts around $800. A business site with CMS ranges from $2,000 to $6,000. E-commerce stores start at $4,000 and go up based on features.'],
      ['q'=>'What factors affect software project cost?',
       'a'=>'Key cost drivers include: number of features and screens, custom design requirements, third-party integrations, team experience level, performance requirements, and delivery timeline.'],
      ['q'=>'Does Alien Code offer free project estimates?',
       'a'=>'Yes. Our team provides a free technical and financial review for every project inquiry. Contact us to receive a tailored proposal within 24 hours.'],
    ]; @endphp
    @foreach($faqs as $faq)
    <details style="border-bottom:1px solid rgba(255,255,255,.06);padding:.8rem 0;">
      <summary style="font-size:.88rem;color:var(--white);cursor:pointer;list-style:none;display:flex;justify-content:space-between;align-items:center;gap:1rem;">
        <span>{{ $faq['q'] }}</span>
        <span style="color:var(--gold);flex-shrink:0;">+</span>
      </summary>
      <p style="margin:.8rem 0 0;color:var(--muted);font-size:.85rem;line-height:1.75;">{{ $faq['a'] }}</p>
    </details>
    @endforeach
  </div>

  <div style="margin-top:2.5rem;">
    <a href="{{ route('tools.index') }}" style="font-size:.8rem;font-family:'Orbitron',sans-serif;color:var(--gold);text-decoration:none;">
      {{ __('front.tools_back') }}
    </a>
  </div>

</section>

<script>
(function () {
  const BASE = {
    landing:   {min:800,   max:2500,  timeline:'2–4 weeks'},
    website:   {min:2000,  max:6000,  timeline:'4–8 weeks'},
    ecommerce: {min:4000,  max:12000, timeline:'6–12 weeks'},
    mobile:    {min:8000,  max:20000, timeline:'10–20 weeks'},
    webapp:    {min:10000, max:35000, timeline:'12–24 weeks'},
    erp:       {min:20000, max:80000, timeline:'20–40 weeks'},
    ai:        {min:15000, max:50000, timeline:'16–32 weeks'},
  };
  const BASE_AR = {
    landing:'أسبوعان إلى ٤', website:'٤ إلى ٨ أسابيع', ecommerce:'٦ إلى ١٢ أسبوع',
    mobile:'١٠ إلى ٢٠ أسبوع', webapp:'١٢ إلى ٢٤ أسبوع', erp:'٢٠ إلى ٤٠ أسبوع', ai:'١٦ إلى ٣٢ أسبوع',
  };
  const FEATURES = {
    auth:500, payment:800, admin:1000, multilang:500, push:500,
    api:800, ai:3000, analytics:800, multitenant:3000, workflow:2000,
  };
  const FEATURES_MAX = {
    auth:1500, payment:2000, admin:3000, multilang:1500, push:1000,
    api:2500, ai:10000, analytics:2000, multitenant:8000, workflow:6000,
  };
  const isAr = {{ $isAr ? 'true' : 'false' }};
  const fmt  = n => n.toLocaleString('en-US');
  const set  = (id, v) => { const el = document.getElementById(id); if (el) el.textContent = v; };

  function calc() {
    const typeInput = document.querySelector('input[name="est-type"]:checked');
    if (!typeInput) return;
    const type = typeInput.value;
    const base = BASE[type];
    if (!base) return;

    let extraMin = 0, extraMax = 0;
    document.querySelectorAll('.est-feature:checked').forEach(cb => {
      extraMin += FEATURES[cb.value] || 0;
      extraMax += FEATURES_MAX[cb.value] || 0;
    });

    const totalMin = base.min + extraMin;
    const totalMax = base.max + extraMax;

    set('r-range', '$' + fmt(totalMin) + ' – $' + fmt(totalMax));
    set('r-timeline', isAr ? (BASE_AR[type] || base.timeline) : base.timeline);

    document.getElementById('est-placeholder').style.display = 'none';
    document.getElementById('est-results').style.display = 'block';
  }

  document.querySelectorAll('input[name="est-type"]').forEach(r => r.addEventListener('change', calc));
  document.querySelectorAll('.est-feature').forEach(cb => cb.addEventListener('change', calc));
})();
</script>

@push('head')
<style>
.est-type-label:has(input:checked) {
  border-color: var(--gold);
  background: rgba(245,168,0,.06);
}
</style>
@endpush

@endsection

@section('page-schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "WebApplication",
      "name": "{{ $isAr ? 'مُقدِّر تكلفة المشروع البرمجي — الأردن' : 'Software Project Cost Estimator — Jordan' }}",
      "url": "{{ $pageUrl }}",
      "description": "{{ $isAr ? 'تقدير فوري لتكلفة مشروعك البرمجي بناءً على أسعار السوق الأردني' : 'Instant cost estimate for your software project based on Jordan market rates' }}",
      "applicationCategory": "BusinessApplication",
      "operatingSystem": "Web browser",
      "inLanguage": "{{ $locale }}",
      "offers": { "@type": "Offer", "price": "0", "priceCurrency": "USD" },
      "publisher": { "@id": "{{ $siteUrl }}/#organization" }
    },
    {
      "@type": "BreadcrumbList",
      "itemListElement": [
        { "@type": "ListItem", "position": 1, "name": "Home", "item": "{{ $siteUrl }}" },
        { "@type": "ListItem", "position": 2, "name": "{{ $isAr ? 'أدوات مجانية' : 'Free Tools' }}", "item": "{{ route('tools.index') }}" },
        { "@type": "ListItem", "position": 3, "name": "{{ $isAr ? 'مُقدِّر التكلفة' : 'Cost Estimator' }}", "item": "{{ $pageUrl }}" }
      ]
    }
  ]
}
</script>
@endsection
