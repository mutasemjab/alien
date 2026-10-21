@extends('layouts.front')

@php
  $locale  = app()->getLocale();
  $isAr    = $locale === 'ar';
  $siteUrl = \App\Models\Setting::getValue('canonical_url', config('app.url'));
  $pageUrl = route('tools.index');
@endphp

@section('meta-title', $isAr
  ? 'أدوات مالية مجانية للأردن — ضريبة دخل، رواتب، نهاية خدمة | Alien Code'
  : 'Free Jordan Financial Tools — Income Tax, Salary, End of Service | Alien Code')

@section('meta-desc', $isAr
  ? 'مجموعة أدوات ومحاسبات مجانية مخصصة للأردن: حاسبة الراتب الصافي، ضريبة الدخل، نهاية الخدمة، ضريبة المبيعات، وتكلفة المشاريع البرمجية.'
  : 'Free Jordan-specific calculators: net salary & SSC, income tax brackets, end of service gratuity, GST, and software project cost estimator.')

@section('canonical', $pageUrl)

@section('content')

{{-- Hero --}}
<section style="padding:7rem 0 4rem;text-align:center;">
  <div class="sec-label" style="justify-content:center;">
    {{ __('front.tools_label') }}
  </div>
  <h1 class="sec-title" style="font-size:clamp(2rem,5vw,3rem);">
    {{ __('front.tools_title') }}
    <span class="gold-text"> {{ __('front.tools_title2') }}</span>
  </h1>
  <p style="max-width:600px;margin:1.2rem auto 0;color:var(--muted);line-height:1.8;">
    {{ __('front.tools_desc') }}
  </p>
</section>

{{-- Tools Grid --}}
<section style="padding:1rem 0 6rem;">
  @php
    $tools = [
      [
        'route'   => 'tools.salary',
        'icon'    => '💰',
        'tag'     => $isAr ? 'رواتب' : 'HR',
        'title'   => $isAr ? 'حاسبة الراتب الصافي' : 'Salary & SSC Calculator',
        'desc'    => $isAr
          ? 'احسب الراتب الصافي بعد الضمان الاجتماعي (6.5%) وضريبة الدخل. ويشمل تكلفة صاحب العمل.'
          : 'Calculate net take-home pay after SSC (6.5%) and income tax. Includes total employer cost.',
        'badge'   => $isAr ? 'الأكثر استخداماً' : 'Most Popular',
      ],
      [
        'route'   => 'tools.income-tax',
        'icon'    => '📊',
        'tag'     => $isAr ? 'ضرائب' : 'Tax',
        'title'   => $isAr ? 'حاسبة ضريبة الدخل' : 'Income Tax Calculator',
        'desc'    => $isAr
          ? 'احسب ضريبة دخلك السنوية مع تفصيل كامل للشرائح والإعفاءات الشخصية والنسبة الفعلية.'
          : 'Full annual income tax breakdown with brackets, personal exemptions, and effective rate.',
      ],
      [
        'route'   => 'tools.end-of-service',
        'icon'    => '📋',
        'tag'     => $isAr ? 'قانون العمل' : 'Labour Law',
        'title'   => $isAr ? 'حاسبة نهاية الخدمة' : 'End of Service Calculator',
        'desc'    => $isAr
          ? 'احسب مكافأة نهاية الخدمة وفق قانون العمل الأردني — للاستقالة والفصل على حد سواء.'
          : 'Calculate end-of-service gratuity under Jordan Labour Law for both resignation and termination.',
      ],
      [
        'route'   => 'tools.vat',
        'icon'    => '🧾',
        'tag'     => $isAr ? 'ضريبة المبيعات' : 'GST',
        'title'   => $isAr ? 'حاسبة ضريبة المبيعات 16%' : 'Sales Tax / GST Calculator',
        'desc'    => $isAr
          ? 'أضف أو احذف ضريبة المبيعات العامة الأردنية بنسبة 16% بشكل فوري. يشمل وضع تقسيم الفاتورة.'
          : 'Instantly add or remove Jordan\'s 16% GST. Includes split-bill mode for groups.',
      ],
      [
        'route'   => 'tools.project-estimator',
        'icon'    => '🚀',
        'tag'     => $isAr ? 'برمجيات' : 'Software',
        'title'   => $isAr ? 'مُقدِّر تكلفة المشروع البرمجي' : 'Software Project Cost Estimator',
        'desc'    => $isAr
          ? 'احصل على نطاق تكلفة استرشادي لموقعك أو تطبيقك أو نظام ERP بناءً على أسعار السوق الأردني.'
          : 'Get an indicative cost range for your website, mobile app, or ERP based on Jordan market rates.',
        'badge'   => $isAr ? 'مدعوم من Alien Code' : 'By Alien Code',
      ],
    ];
  @endphp

  <div class="work-masonry" style="--cols:3;">
    @foreach($tools as $i => $tool)
    <article class="wcard fu" style="transition-delay:{{ $i * 0.07 }}s;padding:2rem;display:flex;flex-direction:column;">
      <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:1rem;">
        <div style="font-size:2.2rem;">{{ $tool['icon'] }}</div>
        @if(!empty($tool['badge']))
        <span style="font-size:.65rem;font-family:'Orbitron',sans-serif;background:rgba(245,168,0,.12);
                     border:1px solid rgba(245,168,0,.3);color:var(--gold);border-radius:50px;
                     padding:.2rem .7rem;white-space:nowrap;">
          {{ $tool['badge'] }}
        </span>
        @endif
      </div>

      <div class="wcard-tags" style="margin-bottom:.7rem;">
        <span class="wcard-tag">{{ $tool['tag'] }}</span>
      </div>

      <h2 style="font-family:'Orbitron',sans-serif;font-size:.9rem;color:var(--white);margin:0 0 .7rem;line-height:1.4;">
        {{ $tool['title'] }}
      </h2>
      <p style="font-size:.83rem;color:var(--muted);line-height:1.7;margin:0 0 1.5rem;flex:1;">
        {{ $tool['desc'] }}
      </p>

      <a href="{{ route($tool['route']) }}"
         style="display:inline-flex;align-items:center;gap:.4rem;
                font-size:.78rem;font-family:'Orbitron',sans-serif;
                color:var(--gold);text-decoration:none;letter-spacing:.04em;
                margin-top:auto;">
        {{ __('front.tools_try') }}
      </a>
    </article>
    @endforeach
  </div>
</section>

@endsection

@section('page-schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "ItemList",
      "name": "{{ $isAr ? 'أدوات مالية مجانية للأردن' : 'Free Jordan Financial Tools' }}",
      "url": "{{ $pageUrl }}",
      "numberOfItems": 5,
      "itemListElement": [
        { "@type": "ListItem", "position": 1, "name": "{{ $isAr ? 'حاسبة الراتب الصافي' : 'Salary & SSC Calculator' }}", "url": "{{ route('tools.salary') }}" },
        { "@type": "ListItem", "position": 2, "name": "{{ $isAr ? 'حاسبة ضريبة الدخل' : 'Income Tax Calculator' }}", "url": "{{ route('tools.income-tax') }}" },
        { "@type": "ListItem", "position": 3, "name": "{{ $isAr ? 'حاسبة نهاية الخدمة' : 'End of Service Calculator' }}", "url": "{{ route('tools.end-of-service') }}" },
        { "@type": "ListItem", "position": 4, "name": "{{ $isAr ? 'حاسبة ضريبة المبيعات' : 'GST Calculator' }}", "url": "{{ route('tools.vat') }}" },
        { "@type": "ListItem", "position": 5, "name": "{{ $isAr ? 'مُقدِّر تكلفة المشروع البرمجي' : 'Software Project Cost Estimator' }}", "url": "{{ route('tools.project-estimator') }}" }
      ]
    },
    {
      "@type": "BreadcrumbList",
      "itemListElement": [
        { "@type": "ListItem", "position": 1, "name": "Home", "item": "{{ $siteUrl }}" },
        { "@type": "ListItem", "position": 2, "name": "{{ $isAr ? 'أدوات مجانية' : 'Free Tools' }}", "item": "{{ $pageUrl }}" }
      ]
    }
  ]
}
</script>
@endsection
