@include('includes._header')
<div class="main">
    <div class="container view-all">
        {{-- IF NO SEARCH TERM WAS TYPED --}}
        @if($request->search === null)
            <div class="container-left">
                <span class="category-heading">Search Results</span>
            </div>
            <div class="container-right">
                <div class="search-results-message-container">
                    <h1>You did not enter a search term.</h1>
                    <p>Return back to our homepage and try again.</p>
                </div>
            </div>
            {{-- IF A SEARCH TERM WAS TYPED --}}
        @else
            <div class="container-left">
                <span class="category-heading">Search Results</span>
                {{-- CUSTOM PAGE ARROWS --}}
                <div class="view-all-arrow-container">
                    {{ $searchedDeals
                    ->withQueryString()->links('vendor.pagination.custom-view-all-pagination') }}
                </div>
            </div>
            <div class="container-right">
                <div class="card-display-view-all">
                    @foreach($searchedDeals as $deal)
                        <div class="card">
                            <div>
                                <div class="card-logo-container">
                                    <img src="{{ $deal->picture_url }}" class="card-logo" alt="{{ $deal->name }}">
                                </div>
                                <span class="card-discount">{{ $deal->location }}</span><br>
                                <span class="card-name">{{ $deal->name }}</span><br>
                            </div>
                            <div>
                                <div class="views-likes-container">
                                    <div>
                                        <span>Views: {{ $deal->views }}</span><br>
                                        <span>Likes:</span>
                                    </div>
                                    <div class="views-likes-icons">
                                        <i class="fa fa-share" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <a href="/deals/{{ $deal->id }}">
                                    <div class="get-deal-button">Get Deal Now!</div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@include('includes._footer')
