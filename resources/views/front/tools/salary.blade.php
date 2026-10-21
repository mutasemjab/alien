@extends('layouts.front')

@php
  $locale  = app()->getLocale();
  $isAr    = $locale === 'ar';
  $siteUrl = \App\Models\Setting::getValue('canonical_url', config('app.url'));
  $pageUrl = route('tools.salary');
@endphp

@section('meta-title', $isAr
  ? 'حاسبة الراتب والضمان الاجتماعي الأردن 2024 | Alien Code'
  : 'Jordan Salary & Social Security Calculator 2024 | Alien Code')

@section('meta-desc', $isAr
  ? 'احسب راتبك الصافي بعد اقتطاع الضمان الاجتماعي 6.5% وضريبة الدخل الأردنية. معرفة تكلفة الموظف الكاملة على صاحب العمل.'
  : 'Calculate your monthly net salary after Jordan Social Security (6.5%) and income tax deductions. See the full employer cost including 14.25% SSC.')

@section('canonical', $pageUrl)

@section('content')

<section style="padding:6rem 0 2rem;max-width:960px;margin:0 auto;{{ $isAr ? 'direction:rtl;' : '' }}">

  {{-- Breadcrumb --}}
  <nav aria-label="breadcrumb" style="font-size:.75rem;color:var(--muted);font-family:'Orbitron',sans-serif;
       display:flex;gap:.5rem;align-items:center;flex-wrap:wrap;margin-bottom:2.5rem;">
    <a href="{{ route('home') }}"       style="color:var(--muted);text-decoration:none;">{{ $isAr ? 'الرئيسية' : 'Home' }}</a>
    <span>›</span>
    <a href="{{ route('tools.index') }}" style="color:var(--muted);text-decoration:none;">{{ $isAr ? 'أدوات مجانية' : 'Free Tools' }}</a>
    <span>›</span>
    <span style="color:var(--gold);">{{ $isAr ? 'حاسبة الراتب' : 'Salary Calculator' }}</span>
  </nav>

  {{-- Hero --}}
  <div class="sec-label" style="justify-content:{{ $isAr ? 'flex-end' : 'flex-start' }};margin-bottom:.8rem;">
    {{ $isAr ? 'حاسبات الأردن' : 'Jordan Calculators' }}
  </div>
  <h1 class="sec-title" style="font-size:clamp(1.6rem,4vw,2.4rem);margin-bottom:.8rem;">
    {{ $isAr ? 'حاسبة الراتب الصافي والضمان الاجتماعي' : 'Salary & Social Security Calculator' }}
  </h1>
  <p style="color:var(--muted);max-width:620px;line-height:1.8;margin-bottom:2.5rem;{{ $isAr ? 'text-align:right;' : '' }}">
    {{ $isAr
      ? 'احسب راتبك الصافي الشهري بعد اقتطاع الضمان الاجتماعي (6.5%) وضريبة الدخل الأردنية، واستعرض التكلفة الكاملة على صاحب العمل.'
      : 'Calculate your monthly take-home pay after Jordan SSC (6.5%) and income tax deductions, plus the full employer cost including the 14.25% SSC contribution.' }}
  </p>

  {{-- Calculator + Results --}}
  <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;align-items:start;">

    {{-- Inputs --}}
    <div class="wcard" style="padding:2rem;">
      <h2 style="font-family:'Orbitron',sans-serif;font-size:.9rem;color:var(--gold);letter-spacing:.06em;margin:0 0 1.5rem;">
        {{ $isAr ? '⚙ بيانات الراتب' : '⚙ SALARY INPUTS' }}
      </h2>

      <div style="margin-bottom:1.2rem;">
        <label for="sal-gross" style="display:block;font-size:.78rem;color:var(--muted);margin-bottom:.4rem;">
          {{ __('front.tool_salary_gross') }}
        </label>
        <input type="number" id="sal-gross" min="0" step="0.01"
               placeholder="{{ $isAr ? 'مثال: 800' : 'e.g. 800' }}"
               style="width:100%;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
                      border-radius:8px;padding:.7rem 1rem;color:var(--white);font-size:1rem;
                      outline:none;box-sizing:border-box;">
      </div>

      <div style="margin-bottom:1.2rem;">
        <label for="sal-marital" style="display:block;font-size:.78rem;color:var(--muted);margin-bottom:.4rem;">
          {{ __('front.tool_salary_marital') }}
        </label>
        <select id="sal-marital"
                style="width:100%;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
                       border-radius:8px;padding:.7rem 1rem;color:var(--white);font-size:.9rem;
                       outline:none;box-sizing:border-box;appearance:none;">
          <option value="single">{{ __('front.tool_salary_single') }}</option>
          <option value="married">{{ __('front.tool_salary_married') }}</option>
        </select>
      </div>

      <div style="margin-bottom:1.8rem;">
        <label for="sal-deps" style="display:block;font-size:.78rem;color:var(--muted);margin-bottom:.4rem;">
          {{ __('front.tool_salary_deps') }}
        </label>
        <select id="sal-deps"
                style="width:100%;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
                       border-radius:8px;padding:.7rem 1rem;color:var(--white);font-size:.9rem;
                       outline:none;box-sizing:border-box;appearance:none;">
          @for($i = 0; $i <= 4; $i++)
            <option value="{{ $i }}">{{ $i }}</option>
          @endfor
        </select>
      </div>

      <button onclick="calcSalary()" class="btn-gold" style="width:100%;justify-content:center;">
        {{ __('front.tool_salary_btn') }}
      </button>
    </div>

    {{-- Results --}}
    <div id="sal-results" style="display:none;">
      <div class="wcard" style="padding:2rem;margin-bottom:1rem;">
        <h2 style="font-family:'Orbitron',sans-serif;font-size:.85rem;color:var(--gold);letter-spacing:.06em;margin:0 0 1.2rem;">
          {{ $isAr ? '💰 الراتب الشهري' : '💰 MONTHLY BREAKDOWN' }}
        </h2>
        @php
          $rows = [
            ['id'=>'r-gross',    'label'=> $isAr ? 'الراتب الإجمالي'           : 'Gross Salary',         'gold'=>false],
            ['id'=>'r-ssc-emp',  'label'=> $isAr ? 'ضمان اجتماعي (موظف 6.5%)' : 'SSC — Employee (6.5%)','gold'=>false,'minus'=>true],
            ['id'=>'r-tax-mon',  'label'=> $isAr ? 'ضريبة الدخل الشهرية'      : 'Monthly Income Tax',    'gold'=>false,'minus'=>true],
            ['id'=>'r-net',      'label'=> $isAr ? 'الراتب الصافي'             : 'Net Take-Home',         'gold'=>true, 'big'=>true],
          ];
        @endphp
        @foreach($rows as $row)
        <div style="display:flex;justify-content:space-between;align-items:center;
                    padding:.7rem 0;{{ !$loop->last ? 'border-bottom:1px solid rgba(255,255,255,.06);' : '' }}">
          <span style="color:var(--muted);font-size:.83rem;">{{ $row['label'] }}</span>
          <span id="{{ $row['id'] }}"
                style="font-family:'Orbitron',sans-serif;
                       font-size:{{ !empty($row['big']) ? '1.05rem' : '.88rem' }};
                       color:{{ !empty($row['gold']) ? 'var(--gold)' : 'var(--white)' }};">
            —
          </span>
        </div>
        @endforeach
      </div>

      <div class="wcard" style="padding:2rem;margin-bottom:1rem;">
        <h2 style="font-family:'Orbitron',sans-serif;font-size:.85rem;color:var(--gold);letter-spacing:.06em;margin:0 0 1.2rem;">
          {{ $isAr ? '🏢 تكلفة صاحب العمل' : '🏢 EMPLOYER COST' }}
        </h2>
        @php
          $erRows = [
            ['id'=>'r-ssc-er',  'label'=> $isAr ? 'ضمان اجتماعي (صاحب العمل 14.25%)' : 'SSC — Employer (14.25%)'],
            ['id'=>'r-er-total','label'=> $isAr ? 'إجمالي تكلفة الموظف'               : 'Total Employer Cost', 'gold'=>true],
          ];
        @endphp
        @foreach($erRows as $row)
        <div style="display:flex;justify-content:space-between;align-items:center;
                    padding:.7rem 0;{{ !$loop->last ? 'border-bottom:1px solid rgba(255,255,255,.06);' : '' }}">
          <span style="color:var(--muted);font-size:.83rem;">{{ $row['label'] }}</span>
          <span id="{{ $row['id'] }}"
                style="font-family:'Orbitron',sans-serif;font-size:.88rem;
                       color:{{ !empty($row['gold']) ? 'var(--gold)' : 'var(--white)' }};">—</span>
        </div>
        @endforeach
      </div>

      <div class="wcard" style="padding:2rem;">
        <h2 style="font-family:'Orbitron',sans-serif;font-size:.85rem;color:var(--gold);letter-spacing:.06em;margin:0 0 1.2rem;">
          {{ $isAr ? '📊 تفاصيل الضريبة السنوية' : '📊 ANNUAL TAX DETAILS' }}
        </h2>
        @php
          $taxRows = [
            ['id'=>'r-exempt',   'label'=> $isAr ? 'الإعفاء السنوي'             : 'Annual Exemption'],
            ['id'=>'r-taxable',  'label'=> $isAr ? 'الدخل الخاضع للضريبة'       : 'Taxable Income'],
            ['id'=>'r-tax-ann',  'label'=> $isAr ? 'الضريبة السنوية الإجمالية'  : 'Total Annual Tax'],
            ['id'=>'r-eff-rate', 'label'=> $isAr ? 'نسبة الضريبة الفعلية'       : 'Effective Tax Rate'],
          ];
        @endphp
        @foreach($taxRows as $row)
        <div style="display:flex;justify-content:space-between;align-items:center;
                    padding:.7rem 0;{{ !$loop->last ? 'border-bottom:1px solid rgba(255,255,255,.06);' : '' }}">
          <span style="color:var(--muted);font-size:.83rem;">{{ $row['label'] }}</span>
          <span id="{{ $row['id'] }}" style="font-family:'Orbitron',sans-serif;font-size:.88rem;color:var(--white);">—</span>
        </div>
        @endforeach
      </div>
    </div>

  </div>

  {{-- Disclaimer --}}
  <p style="font-size:.78rem;color:var(--muted);margin-top:1.5rem;line-height:1.6;opacity:.7;{{ $isAr ? 'text-align:right;' : '' }}">
    ⚠ {{ __('front.tools_disclaimer') }}
  </p>

  {{-- FAQ --}}
  <div style="margin-top:3.5rem;">
    <h2 style="font-family:'Orbitron',sans-serif;font-size:1rem;color:var(--white);margin:0 0 1.5rem;">
      {{ __('front.tools_faq') }}
    </h2>
    @php
      $faqs = $isAr ? [
        ['q'=>'كم نسبة الضمان الاجتماعي في الأردن؟',
         'a'=>'يُشترط على الموظف دفع 6.5% من الراتب الإجمالي اشتراكاً في مؤسسة الضمان الاجتماعي، بينما يدفع صاحب العمل 14.25%، ليكون إجمالي الاشتراك 20.75% من الراتب.'],
        ['q'=>'كيف تُحسب ضريبة الدخل للموظف في الأردن؟',
         'a'=>'يُعفى من الضريبة أول 9,000 دينار سنوياً للأعزب و18,000 دينار للمتزوج. ثم تُطبَّق شرائح ضريبية تبدأ بـ5% على أول 5,000 دينار خاضع للضريبة وصولاً إلى 25% على ما زاد عن 20,000 دينار.'],
        ['q'=>'هل يُخصم الضمان الاجتماعي من الراتب الإجمالي أم الصافي؟',
         'a'=>'يُحتسب اشتراك الضمان الاجتماعي من الراتب الإجمالي قبل أي خصومات أخرى.'],
        ['q'=>'هل يستطيع الموظف الأجنبي الاشتراك في الضمان الاجتماعي الأردني؟',
         'a'=>'نعم، الموظفون الأجانب العاملون في الأردن ملزمون بالاشتراك في الضمان الاجتماعي بنفس النسب المطبقة على المواطنين الأردنيين.'],
      ] : [
        ['q'=>'What is the Social Security rate in Jordan?',
         'a'=>'Employees contribute 6.5% of gross salary to the Social Security Corporation (SSC). Employers contribute 14.25%, making the total contribution 20.75% of gross salary.'],
        ['q'=>'How is income tax calculated for employees in Jordan?',
         'a'=>'The first 9,000 JD/year is tax-exempt for singles (18,000 JD for married). Tax brackets apply on the remaining taxable income: 5% on the first 5,000 JD, rising to 25% above 20,000 JD.'],
        ['q'=>'Is Social Security deducted before or after income tax?',
         'a'=>'SSC is calculated on gross salary before any other deductions. Income tax is calculated on annual gross minus the personal exemption.'],
        ['q'=>'Do foreign employees pay Social Security in Jordan?',
         'a'=>'Yes, foreign workers employed in Jordan are required to contribute to the SSC at the same rates as Jordanian citizens.'],
      ];
    @endphp
    @foreach($faqs as $faq)
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

  {{-- Back link --}}
  <div style="margin-top:2.5rem;">
    <a href="{{ route('tools.index') }}"
       style="font-size:.8rem;font-family:'Orbitron',sans-serif;color:var(--gold);text-decoration:none;">
      {{ __('front.tools_back') }}
    </a>
  </div>

</section>

<script>
(function () {
  const BRACKETS = [[5000,.05],[5000,.10],[5000,.15],[5000,.20],[1/0,.25]];

  function taxOnAmount(amt) {
    let t = 0, r = amt;
    for (const [lim, rate] of BRACKETS) {
      if (r <= 0) break;
      const s = lim === 1/0 ? r : Math.min(r, lim);
      t += s * rate; r -= s;
    }
    return t;
  }

  function fmt(n)  { return n.toLocaleString('en-US', {minimumFractionDigits:2, maximumFractionDigits:2}) + ' JD'; }
  function fmtP(n) { return n.toFixed(1) + '%'; }
  function set(id, v) { const el = document.getElementById(id); if (el) el.textContent = v; }

  window.calcSalary = function () {
    const gross = parseFloat(document.getElementById('sal-gross').value) || 0;
    if (gross <= 0) { document.getElementById('sal-results').style.display = 'none'; return; }

    const marital = document.getElementById('sal-marital').value;
    const deps    = Math.min(parseInt(document.getElementById('sal-deps').value) || 0, 4);

    const sscEmp  = gross * 0.065;
    const sscEmr  = gross * 0.1425;
    const annual  = gross * 12;
    let   exempt  = marital === 'married' ? 18000 : 9000;
    exempt += deps * 1000;

    const taxable   = Math.max(0, annual - exempt);
    const annualTax = taxOnAmount(taxable);
    const monthTax  = annualTax / 12;
    const net       = Math.max(0, gross - sscEmp - monthTax);

    set('r-gross',   fmt(gross));
    set('r-ssc-emp', fmt(sscEmp));
    set('r-tax-mon', fmt(monthTax));
    set('r-net',     fmt(net));
    set('r-ssc-er',  fmt(sscEmr));
    set('r-er-total',fmt(gross + sscEmr));
    set('r-exempt',  fmt(exempt));
    set('r-taxable', fmt(taxable));
    set('r-tax-ann', fmt(annualTax));
    set('r-eff-rate',annual > 0 ? fmtP(annualTax / annual * 100) : '0%');

    document.getElementById('sal-results').style.display = 'block';
  };

  document.getElementById('sal-gross')?.addEventListener('input', calcSalary);
  document.getElementById('sal-marital')?.addEventListener('change', calcSalary);
  document.getElementById('sal-deps')?.addEventListener('change', calcSalary);
})();
</script>

@endsection

@section('page-schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "WebApplication",
      "name": "{{ $isAr ? 'حاسبة الراتب والضمان الاجتماعي الأردن' : 'Jordan Salary & Social Security Calculator' }}",
      "url": "{{ $pageUrl }}",
      "description": "{{ $isAr ? 'احسب الراتب الصافي بعد الضمان الاجتماعي وضريبة الدخل الأردنية' : 'Calculate net salary after Jordan SSC and income tax deductions' }}",
      "applicationCategory": "FinanceApplication",
      "operatingSystem": "Web browser",
      "inLanguage": "{{ $locale }}",
      "offers": { "@type": "Offer", "price": "0", "priceCurrency": "JOD" },
      "publisher": { "@id": "{{ $siteUrl }}/#organization" }
    },
    {
      "@type": "BreadcrumbList",
      "itemListElement": [
        { "@type": "ListItem", "position": 1, "name": "Home", "item": "{{ $siteUrl }}" },
        { "@type": "ListItem", "position": 2, "name": "{{ $isAr ? 'أدوات مجانية' : 'Free Tools' }}", "item": "{{ route('tools.index') }}" },
        { "@type": "ListItem", "position": 3, "name": "{{ $isAr ? 'حاسبة الراتب' : 'Salary Calculator' }}", "item": "{{ $pageUrl }}" }
      ]
    }
  ]
}
</script>
@endsection
