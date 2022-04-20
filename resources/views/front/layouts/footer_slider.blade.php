<div class="footer_slider swiper animated-scrol fadeInUp2" id="bottomSlider">
    @if($footerSlider)
    <div class="swiper-wrapper footer_slider_wrap">
        @foreach($footerSlider as $slide)
        <div class="swiper-slide footer_slider_item" style="background-image: url({{asset($slide->img)}})"></div>
        @endforeach
    </div>
    <div class="swiper-pagination"></div>
    <div class="button-prev">‹</div>
    <div class="button-next">›</div>
    @endif
</div>
