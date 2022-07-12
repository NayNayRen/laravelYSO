@include('includes._header')
<div class="main">
    {{-- HIDDEN SHARE MESSAGE --}}
    @include('includes._share_message')
    <div class="banner">
        <div class="banner-slide-container">
            {{-- SLIDE 1 --}}
            <div class="banner-slide">
                <div class="banner-gradient"></div>
                <div class="banner-container-text">
                    <span class='banner-text-one'>$25 gift card</span>
                    <span class='banner-text-two'>after spending $75 or more.</span>
                    <a href="#" class="banner-redemption">Get Deal Now!</a>
                </div>
                <div class="banner-container-image banner-image-fashion-1">
                </div>
                <img class="banner-logo" src="{{ asset('img/fashion/pacsun-logo2.png') }}"
                    alt="Pacsun Company Logo">
            </div>
            {{-- SLIDE 2 --}}
            <div class="banner-slide even">
                <img class="banner-logo" src="{{ asset('img/fashion/puma-logo.png') }}"
                    alt="Puma Company Logo">
                <div class="banner-gradient"></div>
                <div class="banner-container-image banner-image-fashion-2">
                </div>
                <div class="banner-container-text">
                    <span class='banner-text-one'>50% off!!!</span>
                    <span class='banner-text-two'>extra set of spikes with purchase.</span>
                    <a href="#" class="banner-redemption">Get Deal Now!</a>
                </div>
            </div>
            {{-- SLIDE 3 --}}
            <div class="banner-slide">
                <div class="banner-gradient"></div>
                <div class="banner-container-text">
                    <span class='banner-text-one'>1/2 off</span>
                    <span class='banner-text-two'>second pair + a set of laces.</span>
                    <a href="#" class="banner-redemption">Get Deal Now!</a>
                </div>
                <div class="banner-container-image banner-image-fashion-3">
                </div>
                <img class="banner-logo" src="{{ asset('img/fashion/adidas-logo.png') }}"
                    alt="Adidas Company Logo">
            </div>
            {{-- SLIDE 4 --}}
            <div class="banner-slide even">
                <img class="banner-logo left"
                    src="{{ asset('img/fashion/fantastic-sams-banner-logo.png') }}"
                    alt="Fantastic Sams Company Logo">
                <div class="banner-gradient"></div>
                <div class="banner-container-image banner-image-fashion-4">
                </div>
                <div class="banner-container-text">
                    <span class='banner-text-one'><img
                            src="{{ asset('img/fashion/fantastic-sams-logo.png') }}"
                            alt="Fantastic Sams Company Logo"></span>
                    <span class='banner-text-two'>$10 gift card.</span>
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
        <button id="dashboard-open-button" class="user-icon view-all-user-icon" aria-label="Open dashboard."
            title="Open your dashboard."><i class="fa fa-user" aria-hidden="false"></i></button>
        <h1>The latest fashion trends.</h1>
        <h3>All season long.</h3>
    </div>
    <div class="container view-all">
        <div class="container-left">
            <span class="category-heading">Fashion Deals</span>
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
<script src="{{ asset('js/show-shared-message.js') }}"></script>
@include('includes._footer')
