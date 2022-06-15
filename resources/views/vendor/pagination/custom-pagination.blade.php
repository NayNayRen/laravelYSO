@if($paginator->hasPages())

    {{-- previous button (left arrow) --}}
    @if($paginator->onFirstPage())
        <span class="container-arrow-left"><i class="fa fa-arrow-left" aria-hidden="true"></i>
        </span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" class="container-arrow-left"><i class="fa fa-arrow-left"
                aria-hidden="true"></i>
        </a>
    @endif

    {{-- next button (right arrow) --}}
    @if($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="container-arrow-right"><i class="fa fa-arrow-right"
                aria-hidden="true"></i>
        </a>
    @else
        <span class="container-arrow-right"><i class="fa fa-arrow-right" aria-hidden="true"></i>
        </span>
    @endif

    {{-- item count --}}
    <div class="container-item-counter">
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
