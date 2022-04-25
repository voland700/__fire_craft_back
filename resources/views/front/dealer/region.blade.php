@extends('front.layouts.layout')
@section('meta-title',  $region->meta_title)
@section('meta-description', $region->meta_description)
@section('meta-keywords',  $region->meta_keywords)
@section('h1', $region->h1)

@section('breadcrumbs')
    {{ Breadcrumbs::render('dealer.region', $region) }}
@endsection

@section('content')
@if($dealers->isNotEmpty())
    <div class="dealer_wrap">
        @if($dealers->isNotEmpty())
            @foreach($dealers as $dealer)
                <section class="dealer_item">
                    <h3 class="dealer_name"><a href="{{route('dealer.detail', $dealer->slug)}}" class="dealer_link">{{$dealer->name}}</a></h3>
                    <ul class="dealer_list">
                        @if($dealer->address)<li><b>Адрес</b>: {{$dealer->address}}</li>@endif
                        @if($dealer->time)<li><b>Время работы: </b>{{$dealer->time}}</li>@endif
                        @if($dealer->phone)<li><b>Тел:</b> {{$dealer->phone}}</li>@endif
                        @if($dealer->mail)<li><b>E-mail:</b> {{$dealer->mail}}</li>@endif
                        @if($dealer->site)<li><b>Сайт:</b> <a href="{{$dealer->site}}"  target="_blank">{{$dealer->site}}</a></li>@endif
                    </ul>
                </section>
            @endforeach
        @endif
    </div>
    {{$dealers->onEachSide(2)->links('front.layouts.pagination')}}
@else
    <div class="region">{!! $region->description !!}</div>
@endif
@if($products->isNotEmpty())
<h2 class="title-line">Лучшие предложения для региона: {{$region->name}}</h2>
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
