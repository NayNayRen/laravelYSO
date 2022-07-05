@include('includes._header')
<div class="main">
    <div class="banner">
        <div class="banner-slide-container">
            {{-- SLIDE 1 --}}
            <div class="banner-slide">
                <div class="banner-gradient"></div>
                <div class="banner-container-text">
                    <span class='banner-text-one'>free round</span>
                    <span class='banner-text-two'>for you & a guest after initial purchase.</span>
                    <a href="#" class="banner-redemption">Get Deal Now!</a>
                </div>
                <div class="banner-container-image banner-image-popular-1">
                </div>
                <img class="banner-logo" src="{{ asset('img/fun/congo-logo.png') }}"
                    alt="Congo River Company Logo">
            </div>
            {{-- SLIDE 2 --}}
            <div class="banner-slide even">
                <img class="banner-logo" src="{{ asset('img/fun/amc-logo.png') }}"
                    alt="Newegg Company Logo">
                <div class="banner-gradient"></div>
                <div class="banner-container-image banner-image-popular-2">
                </div>
                <div class="banner-container-text">
                    <span class='banner-text-one'>on demand</span>
                    <span class='banner-text-two'>with 20% lower rates.</span>
                    <a href="#" class="banner-redemption">Get Deal Now!</a>
                </div>
            </div>
            {{-- SLIDE 3 --}}
            <div class="banner-slide">
                <div class="banner-gradient"></div>
                <div class="banner-container-text">
                    <span class='banner-text-one'>free wipers</span>
                    <span class='banner-text-two'>with purchase of $50 or more.</span>
                    <a href="#" class="banner-redemption">Get Deal Now!</a>
                </div>
                <div class="banner-container-image banner-image-popular-3">
                </div>
                <img class="banner-logo" src="{{ asset('img/auto/advanced-auto-logo.png') }}"
                    alt="Best Buy Logo">
            </div>
            {{-- SLIDE 4 --}}
            <div class="banner-slide even">
                <img class="banner-logo" src="{{ asset('img/auto/sw-logo2.png') }}"
                    alt="Apple Store Company Logo">
                <div class="banner-gradient"></div>
                <div class="banner-container-image banner-image-popular-4">
                </div>
                <div class="banner-container-text">
                    <span class='banner-text-one'>2nd color</span>
                    <span class='banner-text-two'>free with first mix.</span>
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
    <div class="search-results-search-container">
        {{-- SEARCH CONTAINER --}}
        @include('includes._search_container')
        {{-- HIDDEN DASHBOARD --}}
        @include('includes._dashboard')
    </div>
    {{-- MAIN CONTENT CONTAINER --}}
    <div class="view-all-container-heading">
        <button id="dashboard-open-button" class="user-icon view-all-user-icon"><i class="fa fa-user"
                aria-hidden="true"></i></button>
        <h1>Our most popular selections.</h1>
        <h3>Used most, because they save you the most.</h3>
        {{-- HIDDEN DASHBOARD --}}
        {{-- @include('includes._dashboard') --}}
    </div>
    <div class="container view-all">
        <div class="container-left">
            <span class="category-heading">Most Popular</span>
            {{-- CUSTOM PAGE ARROWS --}}
            <div class="view-all-arrow-container">
                {{ $deals->links('vendor.pagination.custom-view-all-pagination') }}
            </div>
        </div>
        <div class="container-right">
            <div class="card-display-view-all">
                @foreach($deals as $deal)
                    {{-- CARD BLOCK --}}
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
    </div>
</div>
{{-- PAGE SPECIFIC SCRIPTS --}}
<script src="{{ asset('js/scrolling-banner.js') }}"></script>
<script src="{{ asset('js/show-dashboard.js') }}"></script>
@include('includes._footer')
