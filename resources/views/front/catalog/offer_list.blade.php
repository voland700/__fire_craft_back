<div class="item_img_wrap">
    <a href="{{ route('catalog.product', ['slug' => $product->slug]) }}" class="item_link_img">
		<span class="item_lable_wrap">
            @if($offer->hit)<span class="item_lable hit">Хит</span>@endif
            @if($offer->stock)<span class="item_lable discont">Акция</span>@endif
            @if($offer->new)<span class="item_lable new">Новинка</span>@endif
            @if($offer->advice)<span class="item_lable tip">Советуем</span>@endif
		</span>
        <img src="{{asset($offer->small)}}" alt="{{$product->name}}" class="item_img">
        @if($offer->percent)<span class="item_discont">{{'-'.$offer->percent.'%'}}</span>@endif
    </a>
</div>
<h3 class="item_title">
    <a href="{{ route('catalog.product', ['slug' => $product->slug]) }}" class="item_titl_link">{{$product->name}}</a>
</h3>
<div class="item_price">
    @if($offer->price>0)
        <span class="item_price_real">{{ $offer->cost.' руб' }}</span>
        @if($offer->old_price)<span class="item_price_old">{{$offer->old_price.' руб'}}</span>@endif
    @else
        <span class="item_price_real">Цена: по запросу</span>
    @endif
</div>
<div class="item_offers">
    @foreach($product->offers as $itemOffer)
        <a href="javascript:void(0)" class="item_offer_link @if($offer->id == $itemOffer->id) active @endif" data-product="{{$product->id}}" data-offer="{{$itemOffer->id}}"
           style="background-image:url({{asset($itemOffer->color_file)}});"></a>
    @endforeach
</div>
