@include('includes._header')
<div class="main">

    <div class="banner">
        <div class="banner-slide-container">
            {{-- SLIDE 1 --}}
            <div class="banner-slide">
                <div class="banner-gradient"></div>
                <div class="banner-container-text">
                    <span class='banner-text-one'>free!!!</span>
                    <span class='banner-text-two'>stuffed crust with next delivery.</span>
                    <a href="#" class="banner-redemption">Get Deal Now!</a>
                </div>
                <div class="banner-container-image banner-image-food-1">
                </div>
                <img class="banner-logo" src="{{ asset('img/food/pizza-hut-banner-logo.png') }}"
                    alt="Pizza Hut Company Logo">
            </div>
            {{-- SLIDE 2 --}}
            <div class="banner-slide even">
                <img class="banner-logo" src="{{ asset('img/food/hooters-banner-logo.png') }}"
                    alt="Hooters Company Logo">
                <div class="banner-gradient"></div>
                <div class="banner-container-image banner-image-food-2">
                </div>
                <div class="banner-container-text">
                    <span class='banner-text-one'>buy 10!!!</span>
                    <span class='banner-text-two'>get 10, bone or boneless.</span>
                    <a href="#" class="banner-redemption">Get Deal Now!</a>
                </div>
            </div>
            {{-- SLIDE 3 --}}
            <div class="banner-slide">
                <div class="banner-gradient"></div>
                <div class="banner-container-text">
                    <span class='banner-text-one'>$5 sub</span>
                    <span class='banner-text-two'>with purchase of one footlong.</span>
                    <a href="#" class="banner-redemption">Get Deal Now!</a>
                </div>
                <div class="banner-container-image banner-image-food-3">
                </div>
                <img class="banner-logo" src="{{ asset('img/food/subway-logo2.png') }}"
                    alt="Subway Company Logo">
            </div>
            {{-- SLIDE 4 --}}
            <div class="banner-slide even">
                <img class="banner-logo" src="{{ asset('img/food/checkers-banner-logo.png') }}"
                    alt="Checkers Company Logo">
                <div class="banner-gradient"></div>
                <div class="banner-container-image banner-image-food-4">
                </div>
                <div class="banner-container-text">
                    <span class='banner-text-one'>2 for $5</span>
                    <span class='banner-text-two'>mix from a limited menu.</span>
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
        <h1>All of your Food choices.</h1>
        <h3>For when that hunger arrives.</h3>
    </div>
    <div class="container view-all">
        <div class="container-left">
            <span class="category-heading">Food Deals</span>
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
