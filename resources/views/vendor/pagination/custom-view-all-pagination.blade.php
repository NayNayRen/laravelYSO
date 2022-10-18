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

    {{-- item count --}}
    <div class="view-all-item-counter">
        {{-- @if($paginator->firstItem())
            <span>{{ $paginator->firstItem() }}</span>
        to
        <span>{{ $paginator->lastItem() }}</span>
    @else
        {{ $paginator->count() }}
@endif
of
<span>{{ $paginator->total() }}</span> --}}

@foreach($elements as $element)
    {{-- ARRAY OF PAGE COUNTERS --}}
    @if(is_array($element))
        @foreach($element as $page => $url)
            @if($page == $paginator->currentPage())
                <a class="item active" href="{{ $url }}" aria-current="page">{{ $page }}</a>
            @else
                <a class="item" href="{{ $url }}">{{ $page }}</a>
            @endif
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
