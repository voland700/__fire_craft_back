@if ($paginator->hasPages())
    <nav class="pagination_wrap" aria-label="Page navigation example">
        <ul class="pagination_list">
            @if ($paginator->onFirstPage())
                <li class="pagination_direct dormant"><a class="pagination_direct_link prev" data-label="Назад" tabindex="-1" aria-disabled="true">←</a></li>
            @else
                <li class="pagination_direct"><a class="pagination_direct_link prev" href="{{ $paginator->previousPageUrl() }}" data-label="Назад" tabindex="-1" aria-disabled="true">←</a></li>
            @endif
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item dormant">{{ $element }}</li>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="pagination_item active"><span class="pagination_link">{{ $page }}</span></li>
                        @else
                            <li class="pagination_item"><a class="pagination_link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
            @if ($paginator->hasMorePages())
                <li class="pagination_direct">
                    <a class="pagination_direct_link next" href="{{ $paginator->nextPageUrl() }}" data-label="Вперед">→</a>
                </li>
            @else
                <li class="pagination_direct dormant">
                    <a class="pagination_direct_link next" data-label="Вперед">→</a>
                </li>
            @endif
        </ul>
    </nav>
@endif
