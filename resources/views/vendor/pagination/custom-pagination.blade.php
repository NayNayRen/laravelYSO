@if($paginator->hasPages())

    {{-- previous button (left arrow) --}}
    @if($paginator->onFirstPage())
        <span class="container-arrow-left" aria-label="Previous Deal"><i class="fa fa-arrow-left"
                aria-hidden="false"></i>
        </span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" class="container-arrow-left" aria-label="Previuos Deal"><i
                class="fa fa-arrow-left" aria-hidden="false"></i>
        </a>
    @endif

    {{-- next button (right arrow) --}}
    @if($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="container-arrow-right" aria-label="Next Deal"><i
                class="fa fa-arrow-right" aria-hidden="false"></i>
        </a>
    @else
        <span class="container-arrow-right" aria-label="Next Deal"><i class="fa fa-arrow-right" aria-hidden="false"></i>
        </span>
    @endif

    {{-- item count --}}
    <div class="container-item-counter">
        
        {{ $paginator->count() }}
        of
        <span>{{ $paginator->total() }}</span>


        {{-- old pagination  --}}
        {{-- @if($paginator->firstItem())
            <span>{{ $paginator->firstItem() }}</span>
            to
            <span>{{ $paginator->lastItem() }}</span>
        @else
            {{ $paginator->count() }}
        @endif
        of
        <span>{{ $paginator->total() }}</span> --}}
    </div>
@endif
