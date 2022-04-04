<li><span class="d_label {{(count($childCategory->children)>0) ? 'd_label-closed'  : 'd_label-none' }}"></span><a href="/" class="d_link d_update" data-id="{{$childCategory->id}}">{{$childCategory->name}}</a></li>
@if(count($childCategory->children)>0)
    <ul class="d_item d_closed">
        @foreach ($childCategory->children as $childCategory)
            @include('admin.catalog.discounts.ajax.child_categories_update', ['childCategory' => $childCategory])
        @endforeach
    </ul>
@endif
