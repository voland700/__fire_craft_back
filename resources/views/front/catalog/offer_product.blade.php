    <div class="product_img_block">
        @if($offer->img)
            <a href="{{asset($offer->img)}}" class="product_img_link">
                <img src="{{asset($offer->img)}}" alt="Печь" class="product_img" id="mainImg">
            </a>
        @else
            <a class="product_img_link">
                <img src="{{asset($offer->photo)}}" alt="Печь" class="product_img" id="mainImg">
            </a>
        @endif
    </div>
    @if($offer->photos->isNotEmpty() )
        <div class="product_prev_wrap">
            <span class="product_images_next" id="ImagesSliderNext"><span class="icon-cheveron-left"></span></span>
            <div class="swiper-container product_prev_gallery" id="ImagesSlider">
                <div class="swiper-wrapper product_prev_list">
                    @if($offer->img)
                        <div class="swiper-slide product_prev active">
                            <a href="{{asset($offer->img)}}" class="product_prev_link">
                                <img src="{{asset($offer->small)}}" alt="{{$offer->name}}" class="product_prev_img">
                            </a>
                        </div>
                    @endif
                    @foreach($offer->photos as $photo)
                        <div class="swiper-slide product_prev">
                            <a href="{{asset($photo->img)}}" class="product_prev_link">
                                <img src="{{asset($photo->thumbnail)}}" alt="{{$offer->name}}" class="product_prev_img">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            <span class="product_images_prev" id="ImagesSliderPrev"><span class="icon-cheveron-right"></span></span>
        </div>
    @endif
