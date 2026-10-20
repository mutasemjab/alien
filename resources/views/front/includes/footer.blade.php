{{-- resources/views/front/includes/footer.blade.php --}}

<footer>
  <div class="footer-top">
  @php
    $services = \App\Models\Service::active()->ordered()->take(6)->get();
    $branches = $branches ?? \App\Models\Branch::active()->ordered()->get();
  @endphp
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
          <li>
            @if($s->has_detail)
              <a href="{{ route('services.show', $s->slug) }}">{{ $s->trans('title') }}</a>
            @else
              <a href="{{ route('services') }}">{{ $s->trans('title') }}</a>
            @endif
          </li>
        @endforeach
      </ul>
    </div>

    {{-- Company --}}
    <div class="footer-col">
      <h4>{{ __('front.footer_company') }}</h4>
      <ul>
        <li><a href="{{ route('services') }}">{{ __('front.nav_services') }}</a></li>
        <li><a href="{{ route('portfolio') }}">{{ __('front.portfolio_label') }}</a></li>
        <li><a href="{{ route('blog.index') }}">{{ __('front.blog_label') }}</a></li>
        <li><a href="{{ route('contact') }}">{{ __('front.nav_contact') }}</a></li>
      </ul>
    </div>

    {{-- Contact --}}
    <div class="footer-col">
      <h4>{{ __('front.footer_offices') }}</h4>
      <ul>
        @foreach($branches as $b)
          <li>
            <a href="{{ route('contact') }}">
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