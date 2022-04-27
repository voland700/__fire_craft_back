@extends('front.layouts.layout')
@section('meta-title', $q.' - результаты поиска по каталогу')
@section('meta-description', $q.' - поисковый запрос, вывод результатов поиска по каталогу сайта')
@section('meta-keywords', $q.', поиск, сайт, магазин, запрос, ')
@section('h1', 'Поиск по запросу: '.$q)

@section('breadcrumbs')
    {{ Breadcrumbs::render('search') }}
@endsection

@section('content')
    <div class="items_list _pt_3">
        @forelse($products as $product)
            @include('front.catalog.product_item', ['product' => $product])
        @empty
            <p>По запросу {{$q}} товаров нет.</p>
        @endforelse
    </div>
    {{$products->links('front.layouts.pagination')}}
@endsection
