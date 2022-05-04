<table class="table table-bordered">

    <thead>
    <tr><th>Наименование товара и опций</th></tr>
    </thead>
    <tbody class="d_table">
    @forelse ($products as $product)
        <tr>
            <td>
                @if(!count($product->offers))
                    <span class="d-product {{ (in_array($product->id, $items_id)) ? 'd-chosen' : 'd-link'}}" data-id="{{ $product->id }}"  data-name="{{ $product->name }}"  data-type="product">{{ $product->name }}</span> <span class="d-id">({{$product->id}})</span>
                @else
                    <span class="d-item">{{$product->name }}</span> <span class="d-id">({{$product->id}})</span>
                    <ul class="d-offer-list">
                        @foreach($product->offers as $offer)
                            <li><span class="d-offer {{ (in_array($offer->id, $offers_id)) ? 'd-chosen' : 'd-link'}}" data-id="{{ $offer->id }}"  data-name="{{ $offer->name }}"  data-type="offer">{{ $offer->name }}</span> <span class="d-id">({{$offer->id}})</span></li>
                        @endforeach
                    </ul>
                @endif
            </td>
        </tr>
    @empty
        <tr><td><p>В данном разделе товаров нет.</p></td></tr>
    @endforelse
    </tbody>
</table>
{{ $products->appends(['category' => $categoryId])->links('admin.catalog.discounts.ajax.ajax_paginate_update') }}
