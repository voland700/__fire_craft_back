@php
    function get_valueFromStringUrl($url , $parameter_name) {
        $parts = parse_url($url);
        if(isset($parts['query'])) {
            parse_str($parts['query'], $query);
            if(isset($query[$parameter_name])) {
            return $query[$parameter_name];
            } else {
            return null;
            }
        } else {
            return null;
        }
    }
@endphp


@if ($paginator->hasPages())
    <nav aria-label="Page navigation example">
        <ul class="pagination" id="DiscountPagination">
            @if ($paginator->onFirstPage())
                <li class="page-item disabled"><a class="page-link">Previous</a></li>
            @else
                <li class="page-item"><a href="#" class="page-link d_pag"
                    data-category="{{get_valueFromStringUrl($paginator->previousPageUrl() , 'category')}}"
                    data-page="{{get_valueFromStringUrl($paginator->previousPageUrl() , 'page')}}">Previous</a></li>
            @endif
             @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item disabled"><a href="#" class="page-link d_pag"
                    data-category="{{get_valueFromStringUrl($url, 'category')}}"
                    data-page="{{get_valueFromStringUrl($url, 'page')}}">{{ $element }}</a></li>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a href="#" class="page-link d_pag"
                            data-category="{{get_valueFromStringUrl($url, 'category')}}"
                            data-page="{{get_valueFromStringUrl($url, 'page')}}">{{ $page }}</a></li>
                         @endif
                     @endforeach
                @endif
             @endforeach
             @if ($paginator->hasMorePages())
                <li class="page-item"><a href="#" class="page-link d_pag"
                    data-category="{{get_valueFromStringUrl($paginator->nextPageUrl(), 'category')}}"
                    data-page="{{get_valueFromStringUrl($paginator->nextPageUrl(), 'page')}}">Next</a></li>
             @else
                <li class="page-item disabled"><a class="page-link">Next</a></li>
             @endif
        </ul>
    </nav>
@endif
