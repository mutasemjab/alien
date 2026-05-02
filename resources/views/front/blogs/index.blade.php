@extends('layouts.front')
@section('meta-title', __('front.blog_meta_title'))
@section('meta-desc',  __('front.blog_meta_desc'))

@section('content')

<section id="blog-hero" style="padding:6rem 0 3rem;text-align:center;">
  <div class="fu" style="max-width:680px;margin:0 auto;">
    <div class="sec-label" style="justify-content:center;">{{ __('front.blog_label') }}</div>
    <h1 class="sec-title">
      {{ __('front.blog_title') }}
      <span class="gold-text">{{ __('front.blog_title2') }}</span>
    </h1>
    <p class="sec-desc" style="margin:0 auto;">{{ __('front.blog_desc') }}</p>
  </div>

  {{-- Category filter --}}
  @if($categories->count())
  <div style="display:flex;flex-wrap:wrap;gap:.5rem;justify-content:center;margin-top:2rem;" class="fu d1">
    <a href="{{ request()->url() }}"
       style="border:1px solid rgba(245,168,0,{{ request()->filled('category') ? '.2' : '.8' }});border-radius:50px;padding:.35rem 1rem;font-size:.75rem;color:{{ request()->filled('category') ? 'var(--muted)' : 'var(--gold)' }};font-family:'Orbitron',sans-serif;text-decoration:none;">
      All
    </a>
    @foreach($categories as $cat)
    <a href="{{ request()->url() }}?category={{ urlencode($cat) }}"
       style="border:1px solid rgba(245,168,0,{{ request('category') === $cat ? '.8' : '.2' }});border-radius:50px;padding:.35rem 1rem;font-size:.75rem;color:{{ request('category') === $cat ? 'var(--gold)' : 'var(--muted)' }};font-family:'Orbitron',sans-serif;text-decoration:none;">
      {{ $cat }}
    </a>
    @endforeach
  </div>
  @endif
</section>

<div class="divider"></div>

<section id="blog-list" style="padding:3rem 0 5rem;">
  @if($posts->count())
  <div class="work-masonry">
    @foreach($posts as $i => $post)
    <article class="wcard fu" style="transition-delay:{{ ($i % 3) * 0.08 }}s;">
      <a href="{{ route('blog.show', $post->slug) }}" style="text-decoration:none;display:block;">
        <div class="wcard-vis">
          <img src="{{ $post->image_url }}" alt="{{ $post->trans('title') }}"
               style="width:100%;aspect-ratio:16/9;object-fit:cover;display:block;">
        </div>
      </a>
      <div class="wcard-body">
        <div class="wcard-tags">
          @if($post->category_en)
            <span class="wcard-tag">{{ $post->trans('category') }}</span>
          @endif
          <span class="wcard-tag">{{ $post->reading_time }} {{ __('front.blog_min_read') }}</span>
          @foreach(array_slice($post->tags ?? [], 0, 2) as $tag)
            <span class="wcard-tag">{{ $tag }}</span>
          @endforeach
        </div>
        <h2 style="font-size:1rem;margin:.6rem 0 .4rem;">
          <a href="{{ route('blog.show', $post->slug) }}" style="color:var(--white);text-decoration:none;">
            {{ $post->trans('title') }}
          </a>
        </h2>
        <p style="font-size:.82rem;color:var(--muted);line-height:1.6;margin:0;">
          {{ Str::limit($post->trans('excerpt') ?: strip_tags($post->trans('body')), 120) }}
        </p>
        <div style="display:flex;align-items:center;justify-content:space-between;margin-top:1rem;">
          <span style="font-size:.72rem;color:var(--muted);">{{ $post->published_at?->format('d M Y') }}</span>
          <a href="{{ route('blog.show', $post->slug) }}"
             style="font-size:.75rem;color:var(--gold);font-family:'Orbitron',sans-serif;text-decoration:none;">
            {{ __('front.blog_read_more') }} →
          </a>
        </div>
      </div>
    </article>
    @endforeach
  </div>

  @if($posts->hasPages())
  <div style="display:flex;justify-content:center;margin-top:3rem;gap:.5rem;">
    {{ $posts->links() }}
  </div>
  @endif

  @else
  <div style="text-align:center;padding:4rem 0;color:var(--muted);">
    <div style="font-size:3rem;margin-bottom:1rem;">✍️</div>
    <p>{{ __('front.blog_empty') }}</p>
  </div>
  @endif
</section>

@endsection
