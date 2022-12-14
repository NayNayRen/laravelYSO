@if($paginator->hasPages())

    {{-- previous button (left arrow) --}}
    @if($paginator->onFirstPage())
        <span class="view-all-left-arrow" aria-label="Previous Deal"><i class="fa fa-arrow-left"
                aria-hidden="false"></i>
        </span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" class="view-all-left-arrow" aria-label="Previous Deal"><i
                class="fa fa-arrow-left" aria-hidden="false"></i>
        </a>
    @endif

    {{-- item pagination --}}
    <div class="view-all-item-counter">

@foreach($elements as $element)
    {{-- ARRAY OF PAGE COUNTERS --}}
    @if(is_array($element))
        @foreach($element as $page => $url)

        @if ($paginator->currentPage() > 4 && $page === 2)
            <span class="disabled">...</span>
        @endif

            {{-- @if($page == $paginator->currentPage())
                <a class="item active" href="{{ $url }}" aria-current="page">{{ $page }}</a>
            @else
                <a class="item" href="{{ $url }}">{{ $page }}</a>
            @endif --}}

            {{-- REMOVE IF NOT LIKED --}}
            @if($page == $paginator->currentPage())
                <a class="item active" href="{{ $url }}" aria-current="page">{{ $page }}</a>
            {{-- @elseif ($page === $paginator->currentPage() + 1 || $page === $paginator->currentPage() + 2 || $page === $paginator->currentPage() - 1 || $page === $paginator->currentPage() - 2 || $page === $paginator->lastPage() || $page === 1) --}}
            @elseif ($page === $paginator->currentPage() + 1 || $page === $paginator->currentPage() - 1 || $page === $paginator->lastPage() || $page === 1)
                <a class="item" href="{{ $url }}">{{ $page }}</a>
            @endif

        @if ($paginator->currentPage() < $paginator->lastPage() - 3 && $page === $paginator->lastPage() - 1)
            <span class="disabled">...</span>
        @endif
        {{-- REMOVE IF NOT LIKED --}}

        @endforeach
    @endif
@endforeach
</div>

{{-- next button (right arrow) --}}
@if($paginator->hasMorePages())
    <a href="{{ $paginator->nextPageUrl() }}" class="view-all-right-arrow" aria-label="Next Deal"><i
            class="fa fa-arrow-right" aria-hidden="false"></i>
    </a>
@else
    <span class="view-all-right-arrow" aria-label="Next Deal"><i class="fa fa-arrow-right" aria-hidden="false"></i>
    </span>
@endif

@endif
