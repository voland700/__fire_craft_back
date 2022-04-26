@extends('front.layouts.layout')
@section('meta-title',  $category->title)
@section('meta-description', $category->decrip)
@section('meta-keywords', $category->keys)
@section('h1', $category->named)

@section('breadcrumbs')
    {{ Breadcrumbs::render('catalog.category', $category) }}
@endsection
@section('content')

    @if(!$categories->isEmpty())
        <div class="category_list">
            @foreach($categories as $categoryItem)
                <div class="category_item" onclick="location.href='{{route('catalog.category', $categoryItem->slug)}}';">
                    <a href="{{route('catalog.category', $categoryItem->slug)}}" class="category_link">{{$categoryItem->name}}</a>
                    <div class="category_img_wrup">
                        <img src="{{asset($categoryItem->thumbnail)}}" alt="{{$categoryItem->name}}" class="category_img">
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

    <div class="text">{!! $category->description !!}</div>
@endsection
