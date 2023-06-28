@if ($isSlide)
<div class="swiper-slide">
  <picture>
    <source media="(min-width: 1600px)" data-srcset="/assets/media/{{ $slug }}/{{ $slug }}-{{ $image }}-xl.webp" type="image/webp">
    <source media="(min-width: 1600px)" data-srcset="/assets/media/{{ $slug }}/{{ $slug }}-{{ $image }}-xl.jpg">
    <source media="(min-width: 1200px)" data-srcset="/assets/media/{{ $slug }}/{{ $slug }}-{{ $image }}-lg.webp" type="image/webp">
    <source media="(min-width: 1200px)" data-srcset="/assets/media/{{ $slug }}/{{ $slug }}-{{ $image }}-lg.jpg">
    <source media="(min-width: 800px)" data-srcset="/assets/media/{{ $slug }}/{{ $slug }}-{{ $image }}-md.webp" type="image/webp">
    <source media="(min-width: 800px)" data-srcset="/assets/media/{{ $slug }}/{{ $slug }}-{{ $image }}-md.jpg">
    <img src="/assets/img/blank.png" data-src="/assets/media/{{ $slug }}/{{ $slug }}-{{ $image }}-sm.jpg" 
      alt="{{ $caption }}" 
      title="{{ $caption }}" 
      height="{{ $height }}" 
      width="{{ $width }}"
      class="{{ $cssClass }} lazyload">
  </picture>
</div>
@else
  <picture>
    <source media="(min-width: 800px)" srcset="/assets/media/{{ $image }}-lg.jpg">
    <source srcset="/assets/media/{{ $image }}-sm.jpg">
    <img src="/assets/media/{{ $image }}-sm.jpg" 
      alt="" 
      title="" 
      height="667" 
      width="1000" 
      class="{{ $cssClass }}">
  </picture>
@endif

