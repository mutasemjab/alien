@extends('layouts.front')

@php
  $locale  = app()->getLocale();
  $isAr    = $locale === 'ar';
  $siteUrl = \App\Models\Setting::getValue('canonical_url', config('app.url'));
  $pageUrl = route('tools.vat');
@endphp

@section('meta-title', $isAr
  ? 'حاسبة ضريبة المبيعات الأردن 16% — إضافة وإزالة وتقسيم | Alien Code'
  : 'Jordan Sales Tax GST Calculator 16% — Add, Remove, Split | Alien Code')

@section('meta-desc', $isAr
  ? 'أضف أو احذف ضريبة المبيعات العامة الأردنية (16%) بشكل فوري. يشمل وضع تقسيم الفاتورة بين عدة أشخاص.'
  : 'Instantly add or remove Jordan\'s 16% General Sales Tax (GST). Includes split-bill mode for dividing any total among multiple people.')

@section('canonical', $pageUrl)

@section('content')

<section style="padding:6rem 0 2rem;max-width:800px;margin:0 auto;{{ $isAr ? 'direction:rtl;' : '' }}">

  {{-- Breadcrumb --}}
  <nav aria-label="breadcrumb" style="font-size:.75rem;color:var(--muted);font-family:'Orbitron',sans-serif;
       display:flex;gap:.5rem;align-items:center;flex-wrap:wrap;margin-bottom:2.5rem;">
    <a href="{{ route('home') }}"        style="color:var(--muted);text-decoration:none;">{{ $isAr ? 'الرئيسية' : 'Home' }}</a>
    <span>›</span>
    <a href="{{ route('tools.index') }}"  style="color:var(--muted);text-decoration:none;">{{ $isAr ? 'أدوات مجانية' : 'Free Tools' }}</a>
    <span>›</span>
    <span style="color:var(--gold);">{{ $isAr ? 'حاسبة ضريبة المبيعات' : 'GST Calculator' }}</span>
  </nav>

  <div class="sec-label" style="justify-content:{{ $isAr ? 'flex-end' : 'flex-start' }};margin-bottom:.8rem;">
    {{ $isAr ? 'حاسبات الأردن' : 'Jordan Calculators' }}
  </div>
  <h1 class="sec-title" style="font-size:clamp(1.6rem,4vw,2.4rem);margin-bottom:.8rem;">
    {{ $isAr ? 'حاسبة ضريبة المبيعات العامة 16%' : 'Sales Tax / GST Calculator (16%)' }}
  </h1>
  <p style="color:var(--muted);max-width:580px;line-height:1.8;margin-bottom:2.5rem;{{ $isAr ? 'text-align:right;' : '' }}">
    {{ $isAr
      ? 'أضف أو احذف ضريبة المبيعات العامة الأردنية بنسبة 16% على أي مبلغ بشكل فوري. يشمل وضع تقسيم الفاتورة.'
      : 'Instantly add or remove Jordan\'s 16% General Sales Tax on any amount. Use split mode to divide a total bill among any number of people.' }}
  </p>

  <div class="wcard" style="padding:2rem;max-width:540px;margin:0 auto;">
    <h2 style="font-family:'Orbitron',sans-serif;font-size:.9rem;color:var(--gold);letter-spacing:.06em;margin:0 0 1.5rem;">
      {{ $isAr ? '⚙ إعدادات الحساب' : '⚙ CALCULATOR SETTINGS' }}
    </h2>

    {{-- Mode --}}
    <div style="margin-bottom:1.2rem;">
      <label for="vat-mode" style="display:block;font-size:.78rem;color:var(--muted);margin-bottom:.4rem;">
        {{ $isAr ? 'طريقة الحساب' : 'Calculation Mode' }}
      </label>
      <select id="vat-mode" style="width:100%;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
             border-radius:8px;padding:.7rem 1rem;color:var(--white);font-size:.9rem;outline:none;box-sizing:border-box;appearance:none;">
        <option value="add">{{ $isAr ? 'إضافة ضريبة 16% على السعر' : 'Add 16% GST to price' }}</option>
        <option value="remove">{{ $isAr ? 'حذف ضريبة 16% من السعر الإجمالي' : 'Remove 16% GST from total price' }}</option>
        <option value="split">{{ $isAr ? 'تقسيم الفاتورة الإجمالية شاملة الضريبة' : 'Split total bill including GST' }}</option>
      </select>
    </div>

    {{-- Amount --}}
    <div style="margin-bottom:1.2rem;">
      <label for="vat-amount" id="vat-amount-label" style="display:block;font-size:.78rem;color:var(--muted);margin-bottom:.4rem;">
        {{ $isAr ? 'المبلغ (دينار)' : 'Amount (JD)' }}
      </label>
      <input type="number" id="vat-amount" min="0" step="0.01"
             placeholder="{{ $isAr ? 'مثال: 100' : 'e.g. 100' }}"
             style="width:100%;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
                    border-radius:8px;padding:.7rem 1rem;color:var(--white);font-size:1rem;
                    outline:none;box-sizing:border-box;">
    </div>

    {{-- Custom rate --}}
    <div style="margin-bottom:1.2rem;">
      <label for="vat-rate" style="display:block;font-size:.78rem;color:var(--muted);margin-bottom:.4rem;">
        {{ $isAr ? 'نسبة ضريبة مخصصة (%) — الافتراضي 16' : 'Custom GST Rate (%) — default 16' }}
      </label>
      <input type="number" id="vat-rate" min="0" max="100" step="0.1" value="16"
             style="width:100%;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
                    border-radius:8px;padding:.7rem 1rem;color:var(--white);font-size:.9rem;
                    outline:none;box-sizing:border-box;">
    </div>

    {{-- Persons (split mode) --}}
    <div id="persons-row" style="margin-bottom:1.8rem;display:none;">
      <label for="vat-persons" style="display:block;font-size:.78rem;color:var(--muted);margin-bottom:.4rem;">
        {{ $isAr ? 'عدد الأشخاص' : 'Number of Persons' }}
      </label>
      <input type="number" id="vat-persons" min="1" max="50" value="2"
             style="width:100%;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
                    border-radius:8px;padding:.7rem 1rem;color:var(--white);font-size:.9rem;
                    outline:none;box-sizing:border-box;">
    </div>

    {{-- Results --}}
    <div id="vat-results" style="display:none;margin-top:1.5rem;padding-top:1.5rem;border-top:1px solid rgba(255,255,255,.08);">
      @php $vatRows = [
        ['id'=>'rv-net',    'label'=> $isAr ? 'المبلغ بدون ضريبة'      : 'Net Amount (excl. tax)'],
        ['id'=>'rv-tax',    'label'=> $isAr ? 'مبلغ الضريبة'           : 'Tax Amount'],
        ['id'=>'rv-total',  'label'=> $isAr ? 'الإجمالي شامل الضريبة'  : 'Total (incl. tax)',    'gold'=>true, 'big'=>true],
        ['id'=>'rv-person', 'label'=> $isAr ? 'لكل شخص'                : 'Per Person'],
      ]; @endphp
      @foreach($vatRows as $row)
      <div id="{{ $row['id'] }}-row"
           style="display:flex;justify-content:space-between;align-items:center;
                  padding:.6rem 0;{{ !$loop->last ? 'border-bottom:1px solid rgba(255,255,255,.06);' : '' }}">
        <span style="color:var(--muted);font-size:.83rem;">{{ $row['label'] }}</span>
        <span id="{{ $row['id'] }}"
              style="font-family:'Orbitron',sans-serif;
                     font-size:{{ !empty($row['big']) ? '1.05rem' : '.88rem' }};
                     color:{{ !empty($row['gold']) ? 'var(--gold)' : 'var(--white)' }};">—</span>
      </div>
      @endforeach
    </div>
  </div>

  <p style="font-size:.78rem;color:var(--muted);margin-top:1.5rem;line-height:1.6;opacity:.7;text-align:center;">
    ⚠ {{ $isAr ? 'بعض السلع والخدمات تخضع لنسب مختلفة. راجع دائرة ضريبة الدخل والمبيعات للتأكد.' : 'Some goods and services are subject to different GST rates. Always verify with the Income Tax & Sales Department.' }}
  </p>

  {{-- FAQ --}}
  <div style="margin-top:3rem;max-width:540px;margin-left:auto;margin-right:auto;">
    <h2 style="font-family:'Orbitron',sans-serif;font-size:1rem;color:var(--white);margin:0 0 1.5rem;">
      {{ __('front.tools_faq') }}
    </h2>
    @php $faqs = $isAr ? [
      ['q'=>'ما هي نسبة ضريبة المبيعات في الأردن؟',
       'a'=>'النسبة القياسية لضريبة المبيعات العامة في الأردن هي 16%، وتُطبَّق على معظم السلع والخدمات. بعض السلع الأساسية معفاة أو تخضع لنسب مخفضة.'],
      ['q'=>'ما الفرق بين إضافة الضريبة وإزالتها؟',
       'a'=>'إضافة الضريبة: إذا كان السعر المعطى لا يشمل الضريبة وتريد معرفة الإجمالي. إزالة الضريبة: إذا كان السعر يشمل الضريبة وتريد معرفة السعر الأصلي.'],
      ['q'=>'هل يجب أن يكون السعر المعروض للمستهلك شاملاً الضريبة؟',
       'a'=>'نعم، وفق الأنظمة الأردنية، يجب أن يعكس السعر المعروض للمستهلك النهائي القيمة الشاملة لضريبة المبيعات.'],
    ] : [
      ['q'=>'What is the sales tax rate in Jordan?',
       'a'=>'Jordan\'s standard General Sales Tax (GST) rate is 16%, applied to most goods and services. Some essential goods are zero-rated or exempt.'],
      ['q'=>'What is the difference between "add GST" and "remove GST"?',
       'a'=>'"Add GST": the price given does not include tax — use this to find the final customer price. "Remove GST": the price includes tax — use this to find the original pre-tax price.'],
      ['q'=>'Does the displayed price in Jordan include GST?',
       'a'=>'Yes, under Jordanian regulations, prices displayed to end consumers must be GST-inclusive. Businesses may display prices excluding tax only in B2B contexts.'],
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

  <div style="margin-top:2.5rem;text-align:center;">
    <a href="{{ route('tools.index') }}" style="font-size:.8rem;font-family:'Orbitron',sans-serif;color:var(--gold);text-decoration:none;">
      {{ __('front.tools_back') }}
    </a>
  </div>

</section>

<script>
(function () {
  const fmt = n => n.toLocaleString('en-US', {minimumFractionDigits:2, maximumFractionDigits:2}) + ' JD';
  const set = (id, v) => { const el = document.getElementById(id); if (el) el.textContent = v; };
  const show = (id, visible) => { const el = document.getElementById(id); if (el) el.style.display = visible ? 'flex' : 'none'; };
  const isAr = {{ $isAr ? 'true' : 'false' }};

  function calc() {
    const amount  = parseFloat(document.getElementById('vat-amount').value) || 0;
    const mode    = document.getElementById('vat-mode').value;
    const rate    = (parseFloat(document.getElementById('vat-rate').value) || 16) / 100;
    const persons = Math.max(1, parseInt(document.getElementById('vat-persons').value) || 1);

    // Show/hide persons row
    const pRow = document.getElementById('persons-row');
    if (pRow) pRow.style.display = mode === 'split' ? 'block' : 'none';

    if (amount <= 0) { document.getElementById('vat-results').style.display = 'none'; return; }

    let net, tax, total;

    if (mode === 'add') {
      net   = amount;
      tax   = amount * rate;
      total = amount + tax;
    } else {
      total = amount;
      net   = amount / (1 + rate);
      tax   = total - net;
    }

    const perPerson = total / persons;

    set('rv-net',   fmt(net));
    set('rv-tax',   fmt(tax));
    set('rv-total', fmt(total));
    set('rv-person',fmt(perPerson));

    show('rv-person-row', mode === 'split' && persons > 1);

    document.getElementById('vat-results').style.display = 'block';
  }

  ['vat-amount','vat-rate','vat-persons'].forEach(id => document.getElementById(id)?.addEventListener('input', calc));
  ['vat-mode'].forEach(id => document.getElementById(id)?.addEventListener('change', calc));

  // Also re-calc on mode change to toggle persons row immediately
  document.getElementById('vat-mode')?.addEventListener('change', calc);
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
      "name": "{{ $isAr ? 'حاسبة ضريبة المبيعات الأردن 16%' : 'Jordan Sales Tax GST Calculator 16%' }}",
      "url": "{{ $pageUrl }}",
      "description": "{{ $isAr ? 'أضف أو احذف ضريبة المبيعات الأردنية 16% على أي مبلغ' : 'Add or remove Jordan 16% General Sales Tax from any amount' }}",
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
        { "@type": "ListItem", "position": 3, "name": "{{ $isAr ? 'حاسبة ضريبة المبيعات' : 'GST Calculator' }}", "item": "{{ $pageUrl }}" }
      ]
    }
  ]
}
</script>
@endsection
