<div class="container">
    <div class="row">
        <div class="col-md-3" style="border: 1px solid #e7e7e7;">
            <ui class="d_menu_wrap">

                @foreach ($categories as $category)
                    <ul class="d_item">
                        <li><span class="d_label {{(count($category->children)>0) ? 'd_label-closed'  : 'd_label-none' }}"></span><a href="#" class="d_link d_update" data-id="{{$category->id}}">{{$category->name}}</a></li>
                        @if(count($category->children)>0)
                        <ul class="d_item d_closed">
                            @foreach ($category->children as $childCategory)
                                @include('admin.catalog.discounts.ajax.child_categories_update', ['childCategory' => $childCategory])
                            @endforeach
                        </ul>
                        @endif
                    </ul>
                @endforeach
            </ui>
        </div>
        <div class="col-md-9" class="d_contemt" id="DiscountContemt" style="display: flex; flex-direction: column; justify-content: space-between; min-height: 350px;">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px"> </th>
                        <th>Наименование</th>
                        <th style="width: 20px">ID</th>
                    </tr>
                </thead>
                <tbody class="d_table">
                @forelse ($products as $product)
                <tr>
                    <td>
                        <span class="d_btn btn btn-block {{ (in_array($product->id, $items_id)) ? 'btn-success' : 'btn-default' }}" data-id="{{ $product->id }}" data-name="{{ $product->name }}"><i class="far fa-check-square fa-sm"></i></span>
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->id }}</td>
                </tr>
                @empty
                    <tr><td colspan="3"><p>В данном разделе товаров нет.</p></td></tr>
                @endforelse
                </tbody>
            </table>



            {{ $products->appends(['category' => $categoryId])->links('admin.catalog.discounts.ajax.ajax_paginate_update') }}
        </div>
    </div>
</div>
