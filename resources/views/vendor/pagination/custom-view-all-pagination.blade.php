@if($paginator->hasPages())

    {{-- previous button (left arrow) --}}
    @if($paginator->onFirstPage())
        <span class="view-all-left-arrow"><i class="fa fa-arrow-left" aria-hidden="true"></i>
        </span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" class="view-all-left-arrow"><i class="fa fa-arrow-left"
                aria-hidden="true"></i>
        </a>
    @endif

    {{-- next button (right arrow) --}}
    @if($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="view-all-right-arrow"><i class="fa fa-arrow-right"
                aria-hidden="true"></i>
        </a>
    @else
        <span class="view-all-right-arrow"><i class="fa fa-arrow-right" aria-hidden="true"></i>
        </span>
    @endif

    {{-- item count --}}
    <div class="view-all-item-counter">
        @if($paginator->firstItem())
            <span>{{ $paginator->firstItem() }}</span>
            to
            <span>{{ $paginator->lastItem() }}</span>
        @else
            {{ $paginator->count() }}
        @endif
        of
        <span>{{ $paginator->total() }}</span>
    </div>
@endif
