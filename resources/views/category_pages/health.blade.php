@include('includes._header')
<div class="main">

    <div class="banner">
        <div class="banner-slide-container">
            {{-- SLIDE 1 --}}
            <div class="banner-slide">
                <div class="banner-gradient"></div>
                <div class="banner-container-text">
                    <span class='banner-text-one'>free!!!</span>
                    <span class='banner-text-two'>first month with referal.</span>
                    <a href="#" class="banner-redemption">Get Deal Now!</a>
                </div>
                <div class="banner-container-image banner-image-health-1">
                </div>
                <img class="banner-logo"
                    src="{{ asset('img/health/planet-fitness-banner-logo.png') }}"
                    alt="Planet Fitness Company Logo">
            </div>
            {{-- SLIDE 2 --}}
            <div class="banner-slide even">
                <img class="banner-logo" src="{{ asset('img/health/whole-foods-logo.png') }}"
                    alt="Whole Foods Market Company Logo">
                <div class="banner-gradient"></div>
                <div class="banner-container-image banner-image-health-2">
                </div>
                <div class="banner-container-text">
                    <span class='banner-text-one'>mondays</span>
                    <span class='banner-text-two'>are for 20% savings.</span>
                    <a href="#" class="banner-redemption">Get Deal Now!</a>
                </div>
            </div>
            {{-- SLIDE 3 --}}
            <div class="banner-slide">
                <div class="banner-gradient"></div>
                <div class="banner-container-text">
                    <span class='banner-text-one'>Now!!!</span>
                    <span class='banner-text-two'>open 24 hours.</span>
                    <a href="#" class="banner-redemption">Get Deal Now!</a>
                </div>
                <div class="banner-container-image banner-image-health-3">
                </div>
                <img class="banner-logo" src="{{ asset('img/health/walgreens-logo2.png') }}"
                    alt="Walgreens Company Logo">
            </div>
            {{-- SLIDE 4 --}}
            <div class="banner-slide even">
                <img class="banner-logo" src="{{ asset('img/health/natures-logo2.png') }}"
                    alt="Natures Food Patch Company Logo">
                <div class="banner-gradient"></div>
                <div class="banner-container-image banner-image-health-4">
                </div>
                <div class="banner-container-text">
                    <span class='banner-text-one'>family owned</span>
                    <span class='banner-text-two'>from ours, to yours.</span>
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
        {{-- HIDDEN MAP --}}
        @include('includes._map')
    </div>
    {{-- MAIN CONTENT CONTAINER --}}
    <div class="view-all-container-heading">
        <button id="dashboard-open-button" class="user-icon view-all-user-icon"><i class="fa fa-user"
                aria-hidden="true"></i></button>
        <h1>Healthy choices, & healthy discounts.</h1>
        <h3>For the healthy you.</h3>
    </div>
    <div class="container view-all">
        <div class="container-left">
            <span class="category-heading">Health Deals</span>
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
<script src="{{ asset('js/show-map.js') }}"></script>
@include('includes._footer')
