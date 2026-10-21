@extends('layouts.front')

@php
  $locale  = app()->getLocale();
  $isAr    = $locale === 'ar';
  $siteUrl = \App\Models\Setting::getValue('canonical_url', config('app.url'));
  $pageUrl = route('tools.end-of-service');
@endphp

@section('meta-title', $isAr
  ? 'حاسبة مكافأة نهاية الخدمة الأردن — قانون العمل | Alien Code'
  : 'Jordan End of Service Gratuity Calculator — Labour Law | Alien Code')

@section('meta-desc', $isAr
  ? 'احسب مكافأة نهاية الخدمة وفق قانون العمل الأردني رقم 8 لسنة 1996. يحدد نسبة الاستحقاق حسب سنوات الخدمة وسبب الترك.'
  : 'Calculate your end-of-service gratuity under Jordan Labour Law No. 8 of 1996. Accounts for years of service and reason for leaving.')

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
    <span style="color:var(--gold);">{{ $isAr ? 'حاسبة نهاية الخدمة' : 'End of Service Calculator' }}</span>
  </nav>

  <div class="sec-label" style="justify-content:{{ $isAr ? 'flex-end' : 'flex-start' }};margin-bottom:.8rem;">
    {{ $isAr ? 'حاسبات الأردن' : 'Jordan Calculators' }}
  </div>
  <h1 class="sec-title" style="font-size:clamp(1.6rem,4vw,2.4rem);margin-bottom:.8rem;">
    {{ $isAr ? 'حاسبة مكافأة نهاية الخدمة' : 'End of Service Gratuity Calculator' }}
  </h1>
  <p style="color:var(--muted);max-width:640px;line-height:1.8;margin-bottom:2.5rem;{{ $isAr ? 'text-align:right;' : '' }}">
    {{ $isAr
      ? 'احسب مستحقات نهاية الخدمة وفق قانون العمل الأردني. تتوقف نسبة الاستحقاق على سنوات الخدمة وما إذا كنت فُصلت أم استقلت.'
      : 'Calculate end-of-service entitlement under Jordan Labour Law. Entitlement percentage depends on years of service and whether you were terminated or resigned.' }}
  </p>

  <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;align-items:start;">

    {{-- Inputs --}}
    <div class="wcard" style="padding:2rem;">
      <h2 style="font-family:'Orbitron',sans-serif;font-size:.9rem;color:var(--gold);letter-spacing:.06em;margin:0 0 1.5rem;">
        {{ $isAr ? '⚙ بيانات الخدمة' : '⚙ SERVICE INPUTS' }}
      </h2>

      <div style="margin-bottom:1.2rem;">
        <label for="eos-salary" style="display:block;font-size:.78rem;color:var(--muted);margin-bottom:.4rem;">
          {{ $isAr ? 'آخر راتب شهري (دينار)' : 'Last Monthly Salary (JD)' }}
        </label>
        <input type="number" id="eos-salary" min="0" step="0.01"
               placeholder="{{ $isAr ? 'مثال: 700' : 'e.g. 700' }}"
               style="width:100%;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
                      border-radius:8px;padding:.7rem 1rem;color:var(--white);font-size:.9rem;
                      outline:none;box-sizing:border-box;">
      </div>

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:.8rem;margin-bottom:1.2rem;">
        <div>
          <label for="eos-years" style="display:block;font-size:.78rem;color:var(--muted);margin-bottom:.4rem;">
            {{ $isAr ? 'سنوات الخدمة' : 'Years' }}
          </label>
          <input type="number" id="eos-years" min="0" max="50" value="0"
                 style="width:100%;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
                        border-radius:8px;padding:.7rem 1rem;color:var(--white);font-size:.9rem;
                        outline:none;box-sizing:border-box;">
        </div>
        <div>
          <label for="eos-months" style="display:block;font-size:.78rem;color:var(--muted);margin-bottom:.4rem;">
            {{ $isAr ? 'أشهر إضافية' : 'Extra Months' }}
          </label>
          <select id="eos-months" style="width:100%;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
                 border-radius:8px;padding:.7rem 1rem;color:var(--white);font-size:.9rem;outline:none;box-sizing:border-box;appearance:none;">
            @for($i=0;$i<=11;$i++)<option value="{{ $i }}">{{ $i }}</option>@endfor
          </select>
        </div>
      </div>

      <div style="margin-bottom:1.8rem;">
        <label for="eos-reason" style="display:block;font-size:.78rem;color:var(--muted);margin-bottom:.4rem;">
          {{ $isAr ? 'سبب ترك العمل' : 'Reason for Leaving' }}
        </label>
        <select id="eos-reason" style="width:100%;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
               border-radius:8px;padding:.7rem 1rem;color:var(--white);font-size:.9rem;outline:none;box-sizing:border-box;appearance:none;">
          <option value="termination">{{ $isAr ? 'فصل من قِبل صاحب العمل' : 'Terminated by Employer' }}</option>
          <option value="resignation">{{ $isAr ? 'استقالة' : 'Resignation' }}</option>
        </select>
      </div>

      <button onclick="calcEOS()" class="btn-gold" style="width:100%;justify-content:center;">
        {{ $isAr ? 'احسب المكافأة' : 'Calculate Gratuity' }}
      </button>
    </div>

    {{-- Results --}}
    <div id="eos-results" style="display:none;">
      <div class="wcard" style="padding:2rem;margin-bottom:1rem;">
        <h2 style="font-family:'Orbitron',sans-serif;font-size:.85rem;color:var(--gold);letter-spacing:.06em;margin:0 0 1.2rem;">
          {{ $isAr ? '💰 المستحقات' : '💰 ENTITLEMENT' }}
        </h2>
        @php $eosRows = [
          ['id'=>'r-entitlement','label'=> $isAr ? 'نسبة الاستحقاق'   : 'Entitlement Percentage'],
          ['id'=>'r-equiv',      'label'=> $isAr ? 'ما يعادل من الأشهر': 'Equivalent Months'],
          ['id'=>'r-gratuity',   'label'=> $isAr ? 'مبلغ المكافأة'     : 'Gratuity Amount', 'gold'=>true, 'big'=>true],
        ]; @endphp
        @foreach($eosRows as $row)
        <div style="display:flex;justify-content:space-between;align-items:center;
                    padding:.7rem 0;{{ !$loop->last ? 'border-bottom:1px solid rgba(255,255,255,.06);' : '' }}">
          <span style="color:var(--muted);font-size:.83rem;">{{ $row['label'] }}</span>
          <span id="{{ $row['id'] }}"
                style="font-family:'Orbitron',sans-serif;
                       font-size:{{ !empty($row['big']) ? '1.1rem' : '.88rem' }};
                       color:{{ !empty($row['gold']) ? 'var(--gold)' : 'var(--white)' }};">—</span>
        </div>
        @endforeach
      </div>

      {{-- Resignation tiers info --}}
      <div id="resign-info" style="display:none;padding:1rem 1.2rem;background:rgba(245,168,0,.05);
           border:1px solid rgba(245,168,0,.15);border-radius:10px;font-size:.82rem;color:var(--muted);line-height:1.7;">
        <strong style="color:var(--gold);font-family:'Orbitron',sans-serif;font-size:.78rem;display:block;margin-bottom:.5rem;">
          {{ $isAr ? '⚖ مستحقات الاستقالة' : '⚖ RESIGNATION ENTITLEMENT TIERS' }}
        </strong>
        {{ $isAr
          ? '• أقل من سنة: لا مستحقات | • 1–3 سنوات: 50% | • 3–6 سنوات: 67% | • 6 سنوات فأكثر: 100%'
          : '• < 1 year: no entitlement | • 1–3 years: 50% | • 3–6 years: 67% | • 6+ years: 100%' }}
      </div>
    </div>

  </div>

  <p style="font-size:.78rem;color:var(--muted);margin-top:1.5rem;line-height:1.6;opacity:.7;{{ $isAr ? 'text-align:right;' : '' }}">
    ⚠ {{ __('front.tools_disclaimer') }}
  </p>

  {{-- FAQ --}}
  <div style="margin-top:3rem;">
    <h2 style="font-family:'Orbitron',sans-serif;font-size:1rem;color:var(--white);margin:0 0 1.5rem;">
      {{ __('front.tools_faq') }}
    </h2>
    @php $faqs = $isAr ? [
      ['q'=>'ما هي مكافأة نهاية الخدمة في قانون العمل الأردني؟',
       'a'=>'وفق قانون العمل الأردني رقم 8 لسنة 1996، يستحق الموظف المفصول راتب شهر كامل عن كل سنة خدمة. أما المستقيل فيستحق نسبة من المكافأة تتدرج بحسب سنوات الخدمة.'],
      ['q'=>'هل يستحق الموظف المستقيل نهاية خدمة في الأردن؟',
       'a'=>'نعم، بشرط أن تبلغ مدة الخدمة سنة كاملة على الأقل. يستحق 50% من السنة الأولى حتى ثلاث سنوات، و67% من ثلاث إلى ست سنوات، و100% إذا تجاوزت ست سنوات.'],
      ['q'=>'هل تحتسب الأشهر الجزئية في مكافأة نهاية الخدمة؟',
       'a'=>'نعم، تُحتسب الأشهر الجزئية بالتناسب مع الراتب الشهري ومعامل الاستحقاق.'],
      ['q'=>'هل يمكن لصاحب العمل رفض دفع مكافأة نهاية الخدمة؟',
       'a'=>'لا يحق لصاحب العمل الامتناع عن دفع المكافأة المستحقة. في حال الإخلال، يحق للموظف اللجوء إلى وزارة العمل أو القضاء.'],
    ] : [
      ['q'=>'What is end of service gratuity under Jordan Labour Law?',
       'a'=>'Under Jordan Labour Law No. 8 of 1996, a terminated employee is entitled to one month\'s salary for each year of service. Resigned employees receive a graduated percentage based on years of service.'],
      ['q'=>'Is an employee who resigns entitled to gratuity in Jordan?',
       'a'=>'Yes, provided they have completed at least one year of service. Entitlement is 50% for 1–3 years, 67% for 3–6 years, and 100% for 6+ years of service.'],
      ['q'=>'Are partial months included in the gratuity calculation?',
       'a'=>'Yes, partial months are pro-rated proportionally based on the monthly salary and the applicable entitlement percentage.'],
      ['q'=>'Can an employer refuse to pay end of service in Jordan?',
       'a'=>'No. Withholding earned gratuity is unlawful. Employees can file a complaint with the Ministry of Labour or pursue the matter through the courts.'],
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
  const fmt = n => n.toLocaleString('en-US', {minimumFractionDigits:2, maximumFractionDigits:2}) + ' JD';
  const set = (id, v) => { const el = document.getElementById(id); if (el) el.textContent = v; };
  const isAr = {{ $isAr ? 'true' : 'false' }};

  window.calcEOS = function () {
    const salary = parseFloat(document.getElementById('eos-salary').value) || 0;
    if (salary <= 0) { document.getElementById('eos-results').style.display = 'none'; return; }

    const years  = parseInt(document.getElementById('eos-years').value) || 0;
    const months = parseInt(document.getElementById('eos-months').value) || 0;
    const reason = document.getElementById('eos-reason').value;
    const totalYears = years + months / 12;

    let multiplier = 1.0;
    if (reason === 'resignation') {
      if (totalYears < 1)       multiplier = 0;
      else if (totalYears < 3)  multiplier = 0.5;
      else if (totalYears < 6)  multiplier = 0.6667;
      else                      multiplier = 1.0;
    }

    const gratuity   = salary * totalYears * multiplier;
    const equivMon   = totalYears * multiplier;

    set('r-entitlement', (multiplier * 100).toFixed(0) + '%');
    set('r-equiv',       equivMon.toFixed(1) + (isAr ? ' شهراً' : ' months'));
    set('r-gratuity',    multiplier > 0 ? fmt(gratuity) : (isAr ? 'لا يوجد استحقاق' : 'No entitlement'));

    const resignInfo = document.getElementById('resign-info');
    if (resignInfo) resignInfo.style.display = reason === 'resignation' ? 'block' : 'none';

    document.getElementById('eos-results').style.display = 'block';
  };

  ['eos-salary','eos-years'].forEach(id => document.getElementById(id)?.addEventListener('input', calcEOS));
  ['eos-months','eos-reason'].forEach(id => document.getElementById(id)?.addEventListener('change', calcEOS));
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
      "name": "{{ $isAr ? 'حاسبة مكافأة نهاية الخدمة الأردن' : 'Jordan End of Service Gratuity Calculator' }}",
      "url": "{{ $pageUrl }}",
      "description": "{{ $isAr ? 'احسب مكافأة نهاية الخدمة وفق قانون العمل الأردني' : 'Calculate end-of-service gratuity under Jordan Labour Law' }}",
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
        { "@type": "ListItem", "position": 3, "name": "{{ $isAr ? 'حاسبة نهاية الخدمة' : 'End of Service Calculator' }}", "item": "{{ $pageUrl }}" }
      ]
    }
  ]
}
</script>
@endsection
