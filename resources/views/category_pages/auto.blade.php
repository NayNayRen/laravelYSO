@include('includes._header')
<div class="main">

    <div class="banner">
        <div class="banner-slide-container">
            {{-- SLIDE 1 --}}
            <div class="banner-slide">
                <div class="banner-gradient"></div>
                <div class="banner-container-text">
                    <span class='banner-text-one'>free wipers</span>
                    <span class='banner-text-two'>with purchase of $50 or more.</span>
                    <a href="#" class="banner-redemption">Get Deal Now!</a>
                </div>
                <div class="banner-container-image banner-image-auto-1">
                </div>
                <img class="banner-logo" src="{{ asset('img/auto/advanced-auto-logo.png') }}"
                    alt="Advanced Auto Parts Company Logo">
            </div>
            {{-- SLIDE 2 --}}
            <div class="banner-slide even">
                <img class="banner-logo" src="{{ asset('img/auto/aamco-logo.png') }}"
                    alt="Aamco Transmission Company Logo">
                <div class="banner-gradient"></div>
                <div class="banner-container-image banner-image-auto-2">
                </div>
                <div class="banner-container-text">
                    <span class='banner-text-one'>30% off!!!</span>
                    <span class='banner-text-two'>your next transmission fluid change.</span>
                    <a href="#" class="banner-redemption">Get Deal Now!</a>
                </div>
            </div>
            {{-- SLIDE 3 --}}
            <div class="banner-slide">
                <div class="banner-gradient"></div>
                <div class="banner-container-text">
                    <span class='banner-text-one'>free rotation!!!</span>
                    <span class='banner-text-two'>with purchase of 2 tires.</span>
                    <a href="#" class="banner-redemption">Get Deal Now!</a>
                </div>
                <div class="banner-container-image banner-image-auto-3">
                </div>
                <img class="banner-logo" src="{{ asset('img/auto/tires-plus-logo2.png') }}"
                    alt="Tires Plus Company Logo">
            </div>
            {{-- SLIDE 4 --}}
            <div class="banner-slide even">
                <img class="banner-logo" src="{{ asset('img/auto/sw-logo.png') }}"
                    alt="Sherwin Williams Company Logo">
                <div class="banner-gradient"></div>
                <div class="banner-container-image banner-image-auto-4">
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
            <span id='prev' aria-label="Previous Slide"><i class="fa fa-arrow-left" aria-hidden="false"></i></span>
            <span id='next' aria-label="Next Slide"><i class="fa fa-arrow-right" aria-hidden="false"></i></span>
        </div>
    </div>
    <div class="search-results-search-container">
        {{-- SEARCH CONTAINER --}}
        @include('includes._search_container')
        {{-- HIDDEN DASHBOARD --}}
        @include('includes._dashboard')
        {{-- HIDDEN MAP --}}
        @include('includes._map')
    </div>
    {{-- MAIN CONTENT CONTAINER --}}
    <div class="view-all-container-heading">
        <button id="dashboard-open-button" class="user-icon view-all-user-icon"><i class="fa fa-user"
                aria-label="Open dashboard." title="Open your dashboard." aria-hidden="false"></i></button>
        <h1>The automotive deals you're looking for.</h1>
        <h3>To keep you running in top shape.</h3>
    </div>
    <div class="container view-all">
        <div class="container-left">
            <span class="category-heading">Auto Deals</span>
            {{-- CUSTOM PAGE ARROWS --}}
            <div class="view-all-arrow-container">
                {{ $deals->links('vendor.pagination.custom-view-all-pagination') }}
            </div>
        </div>
        <div class="container-right">
            {{-- CARD BLOCK --}}
            <div class="card-display-view-all">
                @foreach($deals as $deal)
                    {{-- CARD COMPONENT --}}
                    @include('includes._card')
                @endforeach
            </div>
        </div>
    </div>
</div>
{{-- PAGE SPECIFIC SCRIPTS --}}
<script src="{{ asset('js/scrolling-banner.js') }}"></script>
<script src="{{ asset('js/show-dashboard.js') }}"></script>
<script src="{{ asset('js/show-map.js') }}"></script>
@include('includes._footer')
