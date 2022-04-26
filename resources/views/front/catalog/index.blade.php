@extends('front.layouts.layout')
@section('meta-title',  'Каталог печей и каминов Скандинавских производителй: Jotul, Morso, Scan, фициальный сайт в России, цена, фото')
@section('meta-description', 'Печи, камины и аксессуары JOTUL, MORSO, SCAN - в каталоге официального предстаителя в России - Фаир-Крафт, Скандинавские камины - продажа оптом и в Розницу на территории России')
@section('meta-keywords',  'каталог, печи, камины, аксессуары, jotul, morso, scan, йотул, морсо, скан, чугунные, на дровах, со стеклом, для дома, отопление, цена, фото, купить')
@section('h1', 'Каталог')

@section('breadcrumbs')
    {{ Breadcrumbs::render('catalog.index') }}
@endsection

@section('content')
    @if(!$categories->isEmpty())
        <div class="category_list">
        @foreach($categories as $category)
            <div class="category_item" onclick="location.href='{{route('catalog.category', $category->slug)}}';">
                <a href="{{route('catalog.category', $category->slug)}}" class="category_link">{{$category->name}}</a>
                <div class="category_img_wrup">
                    <img src="{{asset($category->thumb)}}" alt="{{$category->name}}" class="category_img">
                </div>
            </div>
        @endforeach
        </div>
    @endif

    @if(!$products->isEmpty())
        <div class="items_list _pt_3">
            @foreach($products as $product)
                @include('front.catalog.product_item', ['product' => $product])
            @endforeach
        </div>
    @endif
    {{$products->onEachSide(2)->links('front.layouts.pagination')}}
@endsection



