@extends('front.layouts.layout')
@section('meta-title', $product->title)
@section('meta-description', $product->descrip)
@section('meta-keywords', $product->keys)
@section('h1', $product->named)
@section('breadcrumbs')
    {{ Breadcrumbs::render('catalog.product', $category, $product) }}
@endsection

@section('content')
<div class="prodact_wrap">
    <div class="product_images_wrap">
        @if($offer == null)
            <div class="product_img_block">
                <span class="product_label_list">
                    @if($product->hit)<span class="product_lable hit">Хит</span>@endif
                    @if($product->stock)<span class="product_lable discont">Акция</span>@endif
                    @if($product->new)<span class="product_lable new">Новинка</span>@endif
                    @if($product->advice)<span class="product_lable tip">Советуем</span>@endif
                </span>
                @if($product->img)
                <a href="{{asset($product->img)}}" class="product_img_link">
                    <img src="{{asset($product->img)}}" alt="Печь" class="product_img" id="mainImg">
                </a>
                @else
                <a class="product_img_link">
                    <img src="{{asset($product->picture)}}" alt="Печь" class="product_img" id="mainImg">
                </a>
                @endif
                @if($product->percent)<span class="product_discount">{{'-'.$product->percent.'%'}}</span>@endif
            </div>

            @if($product->images->isNotEmpty() )
            <div class="product_prev_wrap">
                <span class="product_images_next" id="ImagesSliderNext"><span class="icon-cheveron-left"></span></span>
                <div class="swiper-container product_prev_gallery" id="ImagesSlider">
                    <div class="swiper-wrapper product_prev_list">
                        @if($product->img)
                            <div class="swiper-slide product_prev active">
                                <a href="{{asset($product->picture)}}" class="product_prev_link">
                                    <img src="{{asset($product->miniature)}}" alt="{{$product->name}}" class="product_prev_img">
                                </a>
                            </div>
                        @endif
                        @foreach($product->images as $image)
                            <div class="swiper-slide product_prev active">
                                <a href="{{asset($image->img)}}" class="product_prev_link">
                                    <img src="{{asset($image->thumbnail)}}" alt="{{$product->name}}" class="product_prev_img">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <span class="product_images_prev" id="ImagesSliderPrev"><span class="icon-cheveron-right"></span></span>
            </div>
            @endif
        @else
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
                                <div class="swiper-slide product_prev active">
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
        @endif
    </div><!-- IMAGES -->


    <div class="product_info_wrap"></div>
    <div class="product_contact_wrap"></div>






</div>


@endsection
