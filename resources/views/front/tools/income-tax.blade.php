@extends('layouts.front')

@php
  $locale  = app()->getLocale();
  $isAr    = $locale === 'ar';
  $siteUrl = \App\Models\Setting::getValue('canonical_url', config('app.url'));
  $pageUrl = route('tools.income-tax');
@endphp

@section('meta-title', $isAr
  ? 'حاسبة ضريبة الدخل الأردن 2024 — شرائح وإعفاءات | Alien Code'
  : 'Jordan Income Tax Calculator 2024 — Brackets & Exemptions | Alien Code')

@section('meta-desc', $isAr
  ? 'احسب ضريبة دخلك السنوية في الأردن مع تفصيل كامل للشرائح الضريبية والإعفاءات الشخصية. يشمل خصم المصاريف الطبية ورسوم الجامعة.'
  : 'Calculate your annual Jordan income tax with a full bracket breakdown. Includes personal exemptions, medical expenses, and university fee deductions.')

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
    <span style="color:var(--gold);">{{ $isAr ? 'حاسبة ضريبة الدخل' : 'Income Tax Calculator' }}</span>
  </nav>

  {{-- Hero --}}
  <div class="sec-label" style="justify-content:{{ $isAr ? 'flex-end' : 'flex-start' }};margin-bottom:.8rem;">
    {{ $isAr ? 'حاسبات الأردن' : 'Jordan Calculators' }}
  </div>
  <h1 class="sec-title" style="font-size:clamp(1.6rem,4vw,2.4rem);margin-bottom:.8rem;">
    {{ $isAr ? 'حاسبة ضريبة الدخل الأردنية 2024' : 'Jordan Income Tax Calculator 2024' }}
  </h1>
  <p style="color:var(--muted);max-width:640px;line-height:1.8;margin-bottom:2.5rem;{{ $isAr ? 'text-align:right;' : '' }}">
    {{ $isAr
      ? 'احسب ضريبة دخلك السنوية المستحقة بناءً على شرائح ضريبة الدخل الأردنية الحالية، مع تفصيل كل شريحة وإجمالي الضريبة والنسبة الفعلية.'
      : 'Calculate your annual Jordan income tax liability based on current tax brackets. See a full breakdown by bracket, total tax due, monthly payment, and effective rate.' }}
  </p>

  <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;align-items:start;">

    {{-- Inputs --}}
    <div class="wcard" style="padding:2rem;">
      <h2 style="font-family:'Orbitron',sans-serif;font-size:.9rem;color:var(--gold);letter-spacing:.06em;margin:0 0 1.5rem;">
        {{ $isAr ? '⚙ بيانات الدخل' : '⚙ INCOME INPUTS' }}
      </h2>

      @php
        $fields = [
          ['id'=>'tax-income', 'type'=>'number', 'label'=> $isAr ? 'الدخل الإجمالي السنوي (دينار)' : 'Annual Gross Income (JD)',                     'ph'=> $isAr ? 'مثال: 15000' : 'e.g. 15000'],
          ['id'=>'tax-med',    'type'=>'number', 'label'=> $isAr ? 'مصاريف طبية (بحد أقصى 1,000 دينار)' : 'Medical Expenses Deduction (max 1,000 JD)',  'ph'=> '0'],
          ['id'=>'tax-edu',    'type'=>'number', 'label'=> $isAr ? 'رسوم جامعة (بحد أقصى 1,500 دينار)' : 'University Fees Deduction (max 1,500 JD)',    'ph'=> '0'],
        ];
      @endphp

      @foreach($fields as $f)
      <div style="margin-bottom:1.2rem;">
        <label for="{{ $f['id'] }}" style="display:block;font-size:.78rem;color:var(--muted);margin-bottom:.4rem;">
          {{ $f['label'] }}
        </label>
        <input type="{{ $f['type'] }}" id="{{ $f['id'] }}" min="0" step="0.01"
               placeholder="{{ $f['ph'] }}"
               style="width:100%;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
                      border-radius:8px;padding:.7rem 1rem;color:var(--white);font-size:.9rem;
                      outline:none;box-sizing:border-box;">
      </div>
      @endforeach

      <div style="margin-bottom:1.2rem;">
        <label for="tax-marital" style="display:block;font-size:.78rem;color:var(--muted);margin-bottom:.4rem;">
          {{ $isAr ? 'الحالة الاجتماعية' : 'Marital Status' }}
        </label>
        <select id="tax-marital" style="width:100%;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
               border-radius:8px;padding:.7rem 1rem;color:var(--white);font-size:.9rem;outline:none;box-sizing:border-box;appearance:none;">
          <option value="single">{{ $isAr ? 'أعزب' : 'Single' }}</option>
          <option value="married">{{ $isAr ? 'متزوج' : 'Married' }}</option>
        </select>
      </div>

      <div style="margin-bottom:1.8rem;">
        <label for="tax-deps" style="display:block;font-size:.78rem;color:var(--muted);margin-bottom:.4rem;">
          {{ $isAr ? 'عدد المعالين (بحد أقصى 4)' : 'Number of Dependents (max 4)' }}
        </label>
        <select id="tax-deps" style="width:100%;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
               border-radius:8px;padding:.7rem 1rem;color:var(--white);font-size:.9rem;outline:none;box-sizing:border-box;appearance:none;">
          @for($i=0;$i<=4;$i++)<option value="{{ $i }}">{{ $i }}</option>@endfor
        </select>
      </div>

      <button onclick="calcTax()" class="btn-gold" style="width:100%;justify-content:center;">
        {{ $isAr ? 'احسب الضريبة' : 'Calculate Tax' }}
      </button>
    </div>

    {{-- Results --}}
    <div id="tax-results" style="display:none;">
      <div class="wcard" style="padding:2rem;margin-bottom:1rem;">
        <h2 style="font-family:'Orbitron',sans-serif;font-size:.85rem;color:var(--gold);letter-spacing:.06em;margin:0 0 1.2rem;">
          {{ $isAr ? '📊 ملخص الضريبة' : '📊 TAX SUMMARY' }}
        </h2>
        @php $sumRows = [
          ['id'=>'r-exempt',   'label'=> $isAr ? 'إجمالي الإعفاءات'         : 'Total Exemptions'],
          ['id'=>'r-taxable',  'label'=> $isAr ? 'الدخل الخاضع للضريبة'     : 'Taxable Income'],
          ['id'=>'r-total-tax','label'=> $isAr ? 'إجمالي الضريبة السنوية'   : 'Total Annual Tax',    'gold'=>true],
          ['id'=>'r-monthly',  'label'=> $isAr ? 'الدفعة الشهرية'           : 'Monthly Payment'],
          ['id'=>'r-eff',      'label'=> $isAr ? 'نسبة الضريبة الفعلية'     : 'Effective Tax Rate'],
        ]; @endphp
        @foreach($sumRows as $row)
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
          {{ $isAr ? '📋 الشرائح الضريبية' : '📋 BRACKET BREAKDOWN' }}
        </h2>
        <table style="width:100%;border-collapse:collapse;font-size:.8rem;">
          <thead>
            <tr>
              @foreach(($isAr ? ['الشريحة','النسبة','المبلغ الخاضع','الضريبة'] : ['Bracket','Rate','Taxable Slice','Tax']) as $h)
              <th style="text-align:{{ $isAr ? 'right' : 'left' }};color:var(--gold);padding:.4rem .3rem;border-bottom:1px solid rgba(245,168,0,.2);font-family:'Orbitron',sans-serif;font-size:.7rem;">{{ $h }}</th>
              @endforeach
            </tr>
          </thead>
          <tbody id="tax-bkd-tbody" style="color:var(--muted);">
            <tr><td colspan="4" style="padding:.6rem .3rem;text-align:center;">—</td></tr>
          </tbody>
        </table>
      </div>
    </div>

  </div>

  <p style="font-size:.78rem;color:var(--muted);margin-top:1.5rem;line-height:1.6;opacity:.7;{{ $isAr ? 'text-align:right;' : '' }}">
    ⚠ {{ __('front.tools_disclaimer') }}
  </p>

  {{-- Jordan Tax Brackets Info Box --}}
  <div style="margin-top:2.5rem;padding:1.5rem;background:rgba(245,168,0,.04);border:1px solid rgba(245,168,0,.15);border-radius:12px;">
    <h2 style="font-family:'Orbitron',sans-serif;font-size:.85rem;color:var(--gold);margin:0 0 1rem;">
      {{ $isAr ? '📘 شرائح ضريبة الدخل الأردنية' : '📘 JORDAN INCOME TAX BRACKETS' }}
    </h2>
    <table style="width:100%;border-collapse:collapse;font-size:.82rem;color:var(--muted);">
      <thead>
        <tr>
          @foreach(($isAr ? ['الدخل الخاضع للضريبة','نسبة الضريبة'] : ['Taxable Income','Tax Rate']) as $h)
          <th style="text-align:{{ $isAr ? 'right' : 'left' }};color:var(--white);padding:.5rem .4rem;border-bottom:1px solid rgba(255,255,255,.1);">{{ $h }}</th>
          @endforeach
        </tr>
      </thead>
      <tbody>
        @php $bracketTable = $isAr ? [
          ['0 – 5,000 دينار','5%'],['5,001 – 10,000 دينار','10%'],
          ['10,001 – 15,000 دينار','15%'],['15,001 – 20,000 دينار','20%'],
          ['أكثر من 20,000 دينار','25%'],
        ] : [
          ['0 – 5,000 JD','5%'],['5,001 – 10,000 JD','10%'],
          ['10,001 – 15,000 JD','15%'],['15,001 – 20,000 JD','20%'],
          ['Above 20,000 JD','25%'],
        ]; @endphp
        @foreach($bracketTable as $r)
        <tr>
          <td style="padding:.45rem .4rem;border-bottom:1px solid rgba(255,255,255,.05);">{{ $r[0] }}</td>
          <td style="padding:.45rem .4rem;border-bottom:1px solid rgba(255,255,255,.05);color:var(--gold);font-family:'Orbitron',sans-serif;">{{ $r[1] }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <p style="font-size:.78rem;margin:.8rem 0 0;opacity:.7;">
      {{ $isAr ? 'الإعفاء الشخصي: 9,000 دينار (أعزب) | 18,000 دينار (متزوج) | +1,000 دينار لكل معال (بحد أقصى 4)' : 'Personal exemption: 9,000 JD (single) | 18,000 JD (married) | +1,000 JD per dependent (max 4)' }}
    </p>
  </div>

  {{-- FAQ --}}
  <div style="margin-top:3rem;">
    <h2 style="font-family:'Orbitron',sans-serif;font-size:1rem;color:var(--white);margin:0 0 1.5rem;">
      {{ __('front.tools_faq') }}
    </h2>
    @php $faqs = $isAr ? [
      ['q'=>'ما هو الإعفاء الضريبي في الأردن؟',
       'a'=>'يُعفى الشخص الأعزب من ضريبة الدخل على أول 9,000 دينار سنوياً. المتزوجون يستفيدون من إعفاء مزدوج يصل إلى 18,000 دينار، ويُضاف 1,000 دينار إضافي لكل معال حتى 4 أشخاص.'],
      ['q'=>'هل المصاريف الطبية قابلة للخصم من الضريبة في الأردن؟',
       'a'=>'نعم، تُخصم المصاريف الطبية المثبتة بإيصالات بحد أقصى 1,000 دينار سنوياً، كما تُخصم رسوم التعليم الجامعي للأولاد بحد أقصى 1,500 دينار.'],
      ['q'=>'متى تُدفع ضريبة الدخل في الأردن؟',
       'a'=>'يُقتطع أصحاب العمل ضريبة الدخل شهرياً من رواتب موظفيهم. أصحاب الأعمال الحرة يُقدمون إقرارهم الضريبي سنوياً.'],
    ] : [
      ['q'=>'What is the income tax personal exemption in Jordan?',
       'a'=>'Single individuals are exempt on the first 9,000 JD/year. Married individuals benefit from an exemption of up to 18,000 JD. An additional 1,000 JD is deducted per dependent (up to 4 dependents).'],
      ['q'=>'Are medical expenses tax-deductible in Jordan?',
       'a'=>'Yes, documented medical expenses are deductible up to 1,000 JD/year. University tuition fees for dependents are deductible up to 1,500 JD/year.'],
      ['q'=>'When is income tax paid in Jordan?',
       'a'=>'Employers withhold income tax monthly from employee salaries and remit it to the Income Tax Department. Self-employed individuals file an annual tax return.'],
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
  const BRACKETS = [[5000,.05],[5000,.10],[5000,.15],[5000,.20],[1/0,.25]];
  const fmt = n => n.toLocaleString('en-US',{minimumFractionDigits:2,maximumFractionDigits:2});
  const set = (id, v) => { const el = document.getElementById(id); if (el) el.textContent = v; };
  const isAr = {{ $isAr ? 'true' : 'false' }};

  window.calcTax = function () {
    const annual = parseFloat(document.getElementById('tax-income').value) || 0;
    if (annual <= 0) { document.getElementById('tax-results').style.display = 'none'; return; }

    const marital = document.getElementById('tax-marital').value;
    const deps    = Math.min(parseInt(document.getElementById('tax-deps').value) || 0, 4);
    const med     = Math.min(parseFloat(document.getElementById('tax-med').value) || 0, 1000);
    const edu     = Math.min(parseFloat(document.getElementById('tax-edu').value) || 0, 1500);

    let exempt = marital === 'married' ? 18000 : 9000;
    exempt += deps * 1000 + med + edu;

    const taxable = Math.max(0, annual - exempt);
    let totalTax = 0, remaining = taxable;
    const rows = [];
    let from = 0;

    for (const [lim, rate] of BRACKETS) {
      if (remaining <= 0) break;
      const slice = lim === 1/0 ? remaining : Math.min(remaining, lim);
      if (slice <= 0) break;
      const taxAmt = slice * rate;
      const to = from + slice;
      rows.push(isAr
        ? `<tr><td style="padding:.45rem .3rem;border-bottom:1px solid rgba(255,255,255,.05);">${fmt(from+1)} – ${fmt(to)} دينار</td><td style="padding:.45rem .3rem;border-bottom:1px solid rgba(255,255,255,.05);color:var(--gold);">${(rate*100).toFixed(0)}%</td><td style="padding:.45rem .3rem;border-bottom:1px solid rgba(255,255,255,.05);">${fmt(slice)} دينار</td><td style="padding:.45rem .3rem;border-bottom:1px solid rgba(255,255,255,.05);color:var(--white);">${fmt(taxAmt)} دينار</td></tr>`
        : `<tr><td style="padding:.45rem .3rem;border-bottom:1px solid rgba(255,255,255,.05);">${fmt(from+1)} – ${fmt(to)} JD</td><td style="padding:.45rem .3rem;border-bottom:1px solid rgba(255,255,255,.05);color:var(--gold);">${(rate*100).toFixed(0)}%</td><td style="padding:.45rem .3rem;border-bottom:1px solid rgba(255,255,255,.05);">${fmt(slice)} JD</td><td style="padding:.45rem .3rem;border-bottom:1px solid rgba(255,255,255,.05);color:var(--white);">${fmt(taxAmt)} JD</td></tr>`
      );
      totalTax += taxAmt; from += slice; remaining -= slice;
    }

    if (rows.length === 0) {
      rows.push(`<tr><td colspan="4" style="padding:.6rem;text-align:center;color:var(--gold);">${isAr ? 'لا ضريبة مستحقة' : 'No tax due'}</td></tr>`);
    }

    set('r-exempt',    fmt(exempt) + (isAr ? ' دينار' : ' JD'));
    set('r-taxable',   fmt(taxable) + (isAr ? ' دينار' : ' JD'));
    set('r-total-tax', fmt(totalTax) + (isAr ? ' دينار' : ' JD'));
    set('r-monthly',   fmt(totalTax / 12) + (isAr ? ' دينار' : ' JD'));
    set('r-eff',       (annual > 0 ? (totalTax / annual * 100).toFixed(2) : '0') + '%');

    const tbody = document.getElementById('tax-bkd-tbody');
    if (tbody) tbody.innerHTML = rows.join('');

    document.getElementById('tax-results').style.display = 'block';
  };

  ['tax-income','tax-med','tax-edu'].forEach(id => document.getElementById(id)?.addEventListener('input', calcTax));
  ['tax-marital','tax-deps'].forEach(id => document.getElementById(id)?.addEventListener('change', calcTax));
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
      "name": "{{ $isAr ? 'حاسبة ضريبة الدخل الأردنية' : 'Jordan Income Tax Calculator' }}",
      "url": "{{ $pageUrl }}",
      "description": "{{ $isAr ? 'احسب ضريبة الدخل السنوية في الأردن مع تفصيل الشرائح' : 'Calculate annual Jordan income tax with full bracket breakdown' }}",
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
        { "@type": "ListItem", "position": 3, "name": "{{ $isAr ? 'حاسبة ضريبة الدخل' : 'Income Tax Calculator' }}", "item": "{{ $pageUrl }}" }
      ]
    }
  ]
}
</script>
@endsection
