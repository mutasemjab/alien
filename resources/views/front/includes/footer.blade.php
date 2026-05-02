{{-- resources/views/front/includes/footer.blade.php --}}

<footer>
  <div class="footer-top">
  @php $services = \App\Models\Service::take(6)->get(); @endphp
{{-- Brand --}}
    <div class="footer-brand">
      @php $logoPath = \App\Models\Setting::getValue('logo'); @endphp
      @if($logoPath)
        <img src="{{ asset('assets/admin/uploads/' . $logoPath) }}" alt="Alien Code">
      @else
        <img src="{{ asset('images/logo.png') }}" alt="Alien Code">
      @endif

      <p>{{ \App\Models\Setting::getValue('about_desc_'.app()->getLocale(), __('front.footer_tagline')) }}</p>

      <div class="footer-socials">
        @if($l = \App\Models\Setting::getValue('linkedin'))
          <a href="{{ $l }}" class="fsoc" target="_blank" rel="noopener">in</a>
        @endif
        @if($l = \App\Models\Setting::getValue('facebook'))
          <a href="{{ $l }}" class="fsoc" target="_blank" rel="noopener">f</a>
        @endif
        @if($l = \App\Models\Setting::getValue('instagram'))
          <a href="{{ $l }}" class="fsoc" target="_blank" rel="noopener">Ig</a>
        @endif
      </div>
    </div>

    {{-- Services --}}
    <div class="footer-col">
      <h4>{{ __('front.footer_services') }}</h4>
      <ul>
        @foreach($services as $s)
          <li><a href="#services">{{ $s->trans('title') }}</a></li>
        @endforeach
      </ul>
    </div>

    {{-- Company --}}
    <div class="footer-col">
      <h4>{{ __('front.footer_company') }}</h4>
      <ul>
        <li><a href="#about">{{ __('front.nav_about') }}</a></li>
        <li><a href="#work">{{ __('front.portfolio_label') }}</a></li>
        <li><a href="#clients">{{ __('front.clients_label') }}</a></li>
        <li><a href="#branches">{{ __('front.nav_branches') }}</a></li>
      </ul>
    </div>

    {{-- Offices --}}
    <div class="footer-col">
      <h4>{{ __('front.footer_offices') }}</h4>
      <ul>
        @foreach($branches as $b)
          <li>
            <a href="#branches">
              {{ $b->flag_emoji }} {{ $b->trans('city') }}
            </a>
          </li>
        @endforeach
      </ul>
    </div>

  </div>

  <div class="footer-bottom">
    <p>
      © {{ date('Y') }}
      <span>{{ \App\Models\Setting::getValue('site_name_'.app()->getLocale(), 'Alien Code') }}</span>.
      {{ __('front.footer_rights') }}
    </p>
    <p>{{ __('front.footer_made') }} 👽</p>
  </div>
</footer>