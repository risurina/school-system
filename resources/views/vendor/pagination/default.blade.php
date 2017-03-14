@if ($paginator->hasPages())
    <div class="btn-group pull-right pagination" style="margin:-0px;">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a class="btn btn-white btn-sm disabled">
                <i class="fa fa-chevron-left"></i>
            </a>
        @else
            <a class="btn btn-white btn-sm" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                <i class="fa fa-chevron-left"></i>
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <a class="btn btn-white btn-sm disabled"><span>{{ $element }}</span></a>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a class="btn btn-white btn-sm active"><span>{{ $page }}</span></a>
                    @else
                        <a class="btn btn-white btn-sm btn btn-white btn-sm" href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a class="btn btn-white btn-sm" href="{{ $paginator->nextPageUrl() }}" rel="next">
                <i class="fa fa-chevron-right"></i>
            </a>
        @else
            <a class="btn btn-white btn-sm disabled">
                <i class="fa fa-chevron-right"></i>
            </a>
        @endif
    </div>
@endif
