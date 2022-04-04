<li><span class="d_label {{(count($childCategory->children)>0) ? 'd_label-closed'  : 'd_label-none' }}"></span><a href="/" class="d_link" onclick="ChoiceGoodsCategory({{$childCategory->id}}); return false;">{{$childCategory->name}}</a></li>
@if(count($childCategory->children)>0)
    <ul class="d_item d_closed">
        @foreach ($childCategory->children as $childCategory)
            @include('admin.catalog.discounts.ajax.child_categories', ['childCategory' => $childCategory])
        @endforeach
    </ul>
@endif
