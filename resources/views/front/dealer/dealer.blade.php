@extends('front.layouts.layout')
@section('meta-title',  $dealer->meta_title ?? $dealer->name.': официальный представитель JOTUL и MORSO в регионе - '.$dealer->region->name )
@section('meta-description', $dealer->meta_description ?? $dealer->name.': продажа печей и каминов Скандинавских произволдителей JOTUL и MORSO в регионе - '.$dealer->region->name.' Гарантия, быстрая доставка')
@section('meta-keywords',  $dealer->meta_keywords ?? "печь, камин, jotul, morso, официальный, представитель, куаить, йотул, морсо, скан,".$dealer->region->name)
@section('h1', $dealer->h1 ?? $dealer->name)

@section('breadcrumbs')
    {{ Breadcrumbs::render('dealer.detail', $dealer) }}
@endsection

@section('content')
    <div class="region_item_wrap">
        <div class="region_item_info">
            <ul class="region_item_ul">
                @if($dealer->address)<li><b>Адрес</b>: {{$dealer->address}}</li>@endif
                @if($dealer->time)<li><b>Время работы:</b> {{$dealer->time}}</li>@endif
                @if($dealer->phone)<li><b>Тел:</b><span> {{$dealer->phone}}</span></li>@endif
                @if($dealer->mail)<li><b>E-mail:</b> <a href="mailto:{{$dealer->mail}}">{{$dealer->mail}}</a></li>@endif
                @if($dealer->site)<li><b>Сайт:</b> <a href="{{$dealer->is_http}}"  target="_blank">{{$dealer->site}}</a></li>@endif
            </ul>
            <div class="region__desc">{!! $dealer->description !!}</div>

        </div>
        <div class="region_item_img_wrap">
            <img src="/images/src/viking.png" alt="Продажа Jotul и Morso" class="region_item_img">
        </div>
    </div>

    @if($products->isNotEmpty())
        <h2 class="title-line">{{$dealer->name}} - лучшие предложения</h2>
        <div class="region_offer_wrap" style="margin-bottom: 70px">
            @foreach($products as $product)
                <div class="region_offer_item">
                    <div class="region_offer_img_wrap">
                        <a href="{{route('catalog.product', $product->slug)}}" class="region_offer_img_link">
                            <img src="{{asset($product->small)}}" alt="{{$product->name}}" class="region_offer_img">
                        </a>
                    </div>
                    <h3 class="region_offer_name"><a href="{{route('catalog.product', $product->slug)}}">{{$product->name}}</a></h3>
                </div>
            @endforeach
        </div>
    @endif


@endsection
