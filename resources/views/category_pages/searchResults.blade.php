@include('includes._header')
<div class="main">
    <div class="banner">
        <div class="banner-slide-container">
            {{-- SLIDE 1 --}}
            <div class="banner-slide">
                <div class="banner-gradient"></div>
                <div class="banner-container-text">
                    <span class='banner-text-one'>20% off</span>
                    <span class='banner-text-two'>first use of geek squad.</span>
                    <a href="#" class="banner-redemption">Get Deal Now!</a>
                </div>
                <div class="banner-container-image banner-image-tech-3">
                </div>
                <img class="banner-logo" src="{{ asset('img/tech/best-buy-logo.png') }}"
                    alt="Best Buy Logo">
            </div>
            {{-- SLIDE 2 --}}
            <div class="banner-slide even">
                <img class="banner-logo" src="{{ asset('img/food/checkers-banner-logo.png') }}"
                    alt="Micro Center Company Logo">
                <div class="banner-gradient"></div>
                <div class="banner-container-image banner-image-food-4">
                </div>
                <div class="banner-container-text">
                    <span class='banner-text-one'>2 for $5</span>
                    <span class='banner-text-two'>mix from a limited menu.</span>
                    <a href="#" class="banner-redemption">Get Deal Now!</a>
                </div>
            </div>
            {{-- SLIDE 3 --}}
            <div class="banner-slide even">
                <img class="banner-logo left"
                    src="{{ asset('img/fashion/adidas-banner-logo.png') }}"
                    alt="Adidas Company Logo">
                <div class="banner-gradient"></div>
                <div class="banner-container-image banner-image-main-4">
                </div>
                <div class="banner-container-text">
                    <span class='banner-text-one'>1/2 off</span>
                    <span class='banner-text-two'>second pair + a set of laces.</span>
                    <a href="#" class="banner-redemption">Get Deal Now!</a>
                </div>
            </div>
            {{-- SLIDE 4 --}}
            <div class="banner-slide even">
                <img class="banner-logo"
                    src="{{ asset('img/tech/micro-center-banner-logo.png') }}"
                    alt="Micro Center Company Logo">
                <div class="banner-gradient"></div>
                <div class="banner-container-image banner-image-featured-4">
                </div>
                <div class="banner-container-text">
                    <span class='banner-text-one'>free!!!</span>
                    <span class='banner-text-two'>tech support with first purchase.</span>
                    <a href="#" class="banner-redemption">Get Deal Now!</a>
                </div>
            </div>
        </div>
        {{-- BANNER ARROWS --}}
        <div class="banner-arrows banner-arrows-alternate">
            <span id='prev'><i class="fa fa-arrow-left" aria-hidden="true"></i></span>
            <span id='next'><i class="fa fa-arrow-right" aria-hidden="true"></i></span>
        </div>
    </div>
    {{-- SEARCH CONTAINER --}}
    <div class="search-results-search-container">
        <div class="search-container">
            <form action={{ route('deals.search') }} class="search-form" name="searchForm"
                method="GET">
                <input type="text" name="search" id="search-field" class="search-field"
                    placeholder="Search by type, city, or zip...">
                <button type="submit" id="search-button" class="search-button"><i class="fa fa-search"
                        aria-hidden="true"></i></button>
                {{-- <button type="button" id="map-button" class="search-button"><i class="fa fa-map-marker"
                        aria-hidden="true"></i></button> --}}
            </form>
        </div>
        {{-- HIDDEN DASHBOARD --}}
        @include('includes._dashboard')
    </div>
    {{-- MAIN CONTENT CONTAINER --}}
    <div class="view-all-container-heading">
        <button id="dashboard-open-button" class="user-icon view-all-user-icon"><i class="fa fa-user"
                aria-hidden="true"></i></button>
        <h1>The choices you want.</h1>
        <h3>That's why you searched for them.</h3>
    </div>
    {{-- IF NO SEARCH TERM WAS TYPED --}}
    @if($request->search === null)
        <div class="search-results-message-container">
            <h1>You did not enter a term to search by.</h1>
            <p>Return back home to browse...</p>
            <span>or...</span>
            <p>Continue your search above.</p>
        </div>
        {{-- IF SEARCH DOESN'T RETURN ANY RESULTS --}}
    @elseif($searchedDeals->count() === 0)
        <div class="search-results-message-container">
            <h1>Youre search did not return any results.</h1>
            <p>Return back home to browse...</p>
            <span>or...</span>
            <p>Continue your search above.</p>
        </div>
        {{-- IF A SEARCH TERM WAS TYPED --}}
    @else
        <div class="container view-all">
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
{{-- PAGE SPECIFIC SCRIPTS --}}
<script src="{{ asset('js/scrolling-banner.js') }}"></script>
<script src="{{ asset('js/show-dashboard.js') }}"></script>
@include('includes._footer')
