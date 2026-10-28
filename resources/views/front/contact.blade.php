@extends('layouts.front')

@php
  $locale  = app()->getLocale();
  $isAr    = $locale === 'ar';
  $siteUrl = \App\Models\Setting::getValue('canonical_url', config('app.url'));
  $s       = fn($k,$d='') => \App\Models\Setting::getValue($k, $d);
@endphp

@section('meta-title', $isAr
  ? 'تواصل معنا | Alien Code — شركة برمجيات في عمّان'
  : 'Contact Us | Alien Code — Software Company in Amman, Jordan')

@section('meta-desc', $isAr
  ? 'تواصل مع فريق Alien Code في عمّان للحصول على استشارة مجانية أو طلب عرض سعر لمشروعك البرمجي.'
  : 'Get in touch with the Alien Code team in Amman, Jordan for a free consultation or project quote. We respond within one business day.')

@section('content')

{{-- Page Hero --}}
<section style="padding:8rem 0 4rem;text-align:center;">
  <div class="sec-label" style="justify-content:center;">
    {{ $isAr ? __('front.contact_label') : __('front.contact_label') }}
  </div>
  <h1 class="sec-title" style="font-size:clamp(2rem,5vw,3rem);">
    {{ $isAr ? "دعنا نبني شيئاً" : "Let's Build Something" }}
    <span class="gold-text"> {{ $isAr ? 'استثنائياً' : 'Extraordinary' }}</span>
  </h1>
  <p style="max-width:580px;margin:1.2rem auto 0;color:var(--muted);line-height:1.8;">
    {{ $isAr
      ? 'سواء كان لديك فكرة جاهزة أو تريد مجرد استشارة — فريقنا هنا للمساعدة.'
      : 'Whether you have a fully-formed idea or just want to explore possibilities, our team is ready to help.' }}
  </p>
</section>

<section style="padding:2rem 0 6rem;">
  <div style="display:grid;grid-template-columns:1fr 1fr;gap:3rem;max-width:1000px;margin:0 auto;align-items:start;">

    {{-- Contact Info --}}
    <div>

      {{-- HQ branch --}}
      @php $hq = $branches->first(); @endphp
      @if($hq)
      <div class="wcard" style="padding:2rem;margin-bottom:1.5rem;">
        <p style="font-size:.7rem;font-family:'Orbitron',sans-serif;color:var(--gold);letter-spacing:.1em;margin:0 0 1rem;">
          {{ $isAr ? 'المقر الرئيسي' : 'HEADQUARTERS' }}
        </p>
        <p style="color:var(--text);line-height:1.7;margin:0 0 .6rem;">
          {{ $hq->flag_emoji }} {{ $hq->trans('city') }}, {{ $hq->trans('country') }}
        </p>
        <p style="color:var(--muted);font-size:.88rem;margin:0 0 .4rem;">
          📍 {{ $hq->trans('address') }}
        </p>
        @if($hq->phone)
        <p style="margin:0 0 .4rem;">
          <a href="tel:{{ $hq->phone }}" style="color:var(--gold);text-decoration:none;font-size:.88rem;">
            📞 {{ $hq->phone }}
          </a>
        </p>
        @endif
        @if($hq->email)
        <p style="margin:0;">
          <a href="mailto:{{ $hq->email }}" style="color:var(--gold);text-decoration:none;font-size:.88rem;">
            ✉️ {{ $hq->email }}
          </a>
        </p>
        @endif
        @if($hq->working_hours_en)
        <p style="color:var(--muted);font-size:.8rem;margin:.6rem 0 0;">
          🕐 {{ $hq->trans('working_hours') }}
        </p>
        @endif
      </div>
      @endif

      {{-- Social & WhatsApp --}}
      @if($wa = $s('whatsapp'))
      <a href="https://wa.me/{{ $wa }}" target="_blank" rel="noopener"
         style="display:flex;align-items:center;gap:.7rem;padding:1rem 1.5rem;
                background:rgba(37,211,102,.08);border:1px solid rgba(37,211,102,.25);
                border-radius:10px;color:#25d366;text-decoration:none;font-size:.88rem;margin-bottom:1rem;">
        💬 {{ $isAr ? 'راسلنا على واتساب' : 'Chat on WhatsApp' }}
      </a>
      @endif

      @if($email = $s('contact_email'))
      <a href="mailto:{{ $email }}"
         style="display:flex;align-items:center;gap:.7rem;padding:1rem 1.5rem;
                background:rgba(245,168,0,.06);border:1px solid rgba(245,168,0,.2);
                border-radius:10px;color:var(--gold);text-decoration:none;font-size:.88rem;">
        ✉️ {{ $email }}
      </a>
      @endif
    </div>

    {{-- Contact Form --}}
    <div class="wcard" style="padding:2rem;">
      <h2 style="font-family:'Orbitron',sans-serif;font-size:1rem;color:var(--ink);margin:0 0 1.5rem;">
        {{ $isAr ? 'أرسل لنا رسالة' : 'Send Us a Message' }}
      </h2>

      @if(session('success'))
        <div style="background:rgba(37,211,102,.1);border:1px solid rgba(37,211,102,.3);
                    border-radius:8px;padding:1rem;margin-bottom:1.5rem;color:#25d366;font-size:.88rem;">
          ✅ {{ session('success') }}
        </div>
      @endif

      <form action="{{ route('contact.send') }}" method="POST">
        @csrf
        <div style="margin-bottom:1rem;">
          <label style="display:block;font-size:.78rem;color:var(--muted);margin-bottom:.4rem;"
                 for="contact_name">
            {{ $isAr ? 'الاسم الكامل' : __('front.form_name') }}
          </label>
          <input type="text" id="contact_name" name="name"
                 value="{{ old('name') }}"
                 required maxlength="100"
                 placeholder="{{ $isAr ? 'اسمك' : 'Your name' }}"
                 style="width:100%;background:#fff;border:1px solid var(--border-mid);
                        border-radius:8px;padding:.7rem 1rem;color:var(--ink);font-size:.9rem;
                        outline:none;box-sizing:border-box;">
          @error('name')<p style="color:#ff6b6b;font-size:.78rem;margin:.3rem 0 0;">{{ $message }}</p>@enderror
        </div>

        <div style="margin-bottom:1rem;">
          <label style="display:block;font-size:.78rem;color:var(--muted);margin-bottom:.4rem;"
                 for="contact_email">
            {{ $isAr ? 'البريد الإلكتروني' : __('front.form_email') }}
          </label>
          <input type="email" id="contact_email" name="email"
                 value="{{ old('email') }}"
                 required
                 placeholder="{{ $isAr ? 'بريدك الإلكتروني' : 'your@email.com' }}"
                 style="width:100%;background:#fff;border:1px solid var(--border-mid);
                        border-radius:8px;padding:.7rem 1rem;color:var(--ink);font-size:.9rem;
                        outline:none;box-sizing:border-box;">
          @error('email')<p style="color:#ff6b6b;font-size:.78rem;margin:.3rem 0 0;">{{ $message }}</p>@enderror
        </div>

        <div style="margin-bottom:1.5rem;">
          <label style="display:block;font-size:.78rem;color:var(--muted);margin-bottom:.4rem;"
                 for="contact_message">
            {{ $isAr ? 'رسالتك' : __('front.form_message') }}
          </label>
          <textarea id="contact_message" name="message"
                    required rows="5"
                    placeholder="{{ $isAr ? 'أخبرنا عن مشروعك...' : 'Tell us about your project...' }}"
                    style="width:100%;background:#fff;border:1px solid var(--border-mid);
                           border-radius:8px;padding:.7rem 1rem;color:var(--ink);font-size:.9rem;
                           outline:none;box-sizing:border-box;resize:vertical;">{{ old('message') }}</textarea>
          @error('message')<p style="color:#ff6b6b;font-size:.78rem;margin:.3rem 0 0;">{{ $message }}</p>@enderror
        </div>

        <button type="submit" class="btn-gold" style="width:100%;justify-content:center;">
          {{ $isAr ? '🚀 إرسال الرسالة' : '🚀 ' . __('front.form_submit') }}
        </button>
      </form>
    </div>

  </div>
</section>

@endsection

@section('page-schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    { "@type": "ListItem", "position": 1, "name": "Home",    "item": "{{ $siteUrl }}" },
    { "@type": "ListItem", "position": 2, "name": "Contact", "item": "{{ url()->current() }}" }
  ]
}
</script>
@endsection
