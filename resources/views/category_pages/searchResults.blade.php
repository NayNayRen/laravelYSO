@include('includes._header')
<div class="main">
    {{-- HIDDEN SHARE MESSAGE --}}
    @include('includes._share_message')
    {{-- HIDDEN FAVORITED ADDED MESSAGE --}}
    @include('includes._favorite_added_message')
    {{-- HIDDEN FAVORITED REMOVED MESSAGE --}}
    @include('includes._favorite_removed_message')
    {{-- GUEST ERROR MESSAGE --}}
    @include('includes._guest_error_message')
    {{-- HIDDEN MAP --}}
    @include('includes._map')
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
            <span id='prev' aria-label="Previous Slide"><i class="fa fa-arrow-left" aria-hidden="false"></i></span>
            <span id='next' aria-label="Next Slide"><i class="fa fa-arrow-right" aria-hidden="false"></i></span>
        </div>
    </div>
    {{-- HEADING AND MAP DISCLAIMER --}}
    <div class="view-all-container-heading">
        <h1>The Search results you want.</h1>
        @if(count($locations) === 0)
            <span class="map-use-disclaimer">No location results came back to show on the map <i
                    class="fa fa-map-marker" aria-hidden="true"></i> , it
                could just be a merchant hasn't registered any yet.</span>
        @else
            <span class="map-use-disclaimer">Use the map button <i class="fa fa-map-marker" aria-hidden="true"></i>
                below
                to
                see the <span>{{ count($locations) }}</span>
                @if(count($locations) > 1)
                    locations
                @else
                    location
                @endif
                returned.
            </span>
        @endif
        {{-- HIDDEN DASHBOARD --}}
        @include('includes._dashboard')
    </div>
    <div class="search-results-search-container">
        {{-- SEARCH CONTAINER --}}
        @include('includes._search_container')
        {{-- USER DASHBOARD BUTTON --}}
        <button id="dashboard-open-button" class="user-icon view-all-user-icon" aria-label="Open dashboard."
            title="Open the dashboard."><i class="fa fa-user" aria-hidden="false"></i></button>
    </div>
    {{-- USED TO PULL LOCATION SEARCH DATA FOR GOOGLE MAP PINS --}}
    <span class="submit-method" hidden>{{ $submitMethod }}</span>
    <span hidden>{{ count($locations) }}</span>
    @foreach($locations as $location)
        @if(!empty($location->lat) && !empty($location->lon))
            <div class="location-results" hidden>
                <span class="location-id">{{ $location->id }}</span><br>
                <span class="location-name">{{ $location->name }}</span><br>
                <span>Lat: <span class="location-lat">{{ $location->lat }}</span></span><br>
                <span>Lng: <span class="location-lng">{{ $location->lon }}</span></span><br>
                <span class="location-address">{{ $location->location }}</span><br>
                <span class="location-phone">{{ $location->Phone }}</span><br>
                <span class="location-email">{{ $location->email }}</span>
            </div>
        @endif
    @endforeach
    {{-- MAIN CONTENT CONTAINER --}}
    <p class="searched-words">You searched for :
        @foreach($searchedWords as $searchedWord)
            <span>{{ $searchedWord }}</span>
        @endforeach
    </p>
    {{-- SEARCH RESULTS RESPONSE MESSAGES --}}
    {{-- if search was left empty --}}
    @if($searchedDeals === 0 || $searchedDeals->count() === 0)
        <div class="search-results-message-container">
            <h1>Your search didn't return any results.</h1>
            <p>Return back <a href={{ route('deals.index') }}> home</a> to browse...</p>
            <span>or...</span>
            <p>Continue your search above.</p>
        </div>
        {{-- if search has no results --}}
        {{-- @elseif(count($locations) === 0)
        <div class="search-results-message-container">
            <h1>Your search didn't return any results.</h1>
            <p>Return back <a href={{ route('deals.index') }}> home</a> to browse...</p>
        <span>or...</span>
        <p>Continue your search above.</p>
</div> --}}
{{-- if search was successful --}}
@else
<div class="alternate-container">
    <div class="alternate-container-heading">
        Your Searched Deals
    </div>
    <span class="alternate-container-count">
        {{ $searchedDeals->withQueryString()->links('vendor.pagination.custom-view-all-pagination') }}
    </span>
    <div class="container-right">
        @if($searchedDeals->count() === 1)
            <span class="alternate-container-count">
                {{ count($searchedDeals) }} Deal
            </span>
            <div class="card-display-limited-amount">
                @foreach($searchedDeals as $deal)
                    {{-- CARD COMPONENT --}}
                    <div class="limited-amount-card">
                        @include('includes._alternate_card')
                    </div>
                @endforeach
            </div>
        @elseif($searchedDeals->count() === 2)
            <span class="alternate-container-count">
                {{ count($searchedDeals) }} Deals
            </span>
            <div class="card-display-limited-amount">
                @foreach($searchedDeals as $deal)
                    {{-- CARD COMPONENT --}}
                    <div class="limited-amount-card">
                        @include('includes._alternate_card')
                    </div>
                @endforeach
            </div>
        @else
            <div class="alternate-count">
                {{ count($searchedDeals) }} Deals
            </div>
            <div class="card-display-view-all">
                @foreach($searchedDeals as $deal)
                    {{-- CARD COMPONENT --}}
                    <div class="limited-amount-card">
                        @include('includes._alternate_card')
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endif

</div>
{{-- PAGE SPECIFIC SCRIPTS --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{ asset('js/show-search-error.js') }}"></script>
<script src="{{ asset('js/scrolling-banner.js') }}"></script>
<script src="{{ asset('js/show-dashboard.js') }}"></script>
<script src="{{ asset('js/show-map.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAqYr4C7xfuJFJOEUGVmMSBtakLS-9ajSA" async defer>
</script>
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // FAVORITE RESPONSE
        $('.add-favorite').click(function () {
            var id = $(this).attr('id');
            const name = $(this).attr('name');
            // console.log(name);
            $.ajax({
                url: "{{ route('add.favorite') }}",
                method: "POST",
                dataType: "json",

                data: {
                    _token: "{{ csrf_token() }}",
                    status: status,
                    id: id,
                },
                success: function (data) {
                    if (data['success']) {
                        var r = (data['success']);
                        $('#' + id).addClass('favorite');
                        $('#favorite-added-name').text(name);
                        $('.favorite-added-message').addClass('show-selected-deal-message');
                        $('.favorite-added-button').click(() => {
                            $('.favorite-added-message').removeClass(
                                'show-selected-deal-message');
                            // location.reload();
                        });
                    }
                    if (data['delete']) {
                        var r = (data['delete']);
                        $('#' + parseInt(id)).removeClass('favorite');
                        $('#favorite-removed-name').text(name);
                        $('.favorite-removed-message').addClass(
                            'show-selected-deal-message');
                        $('.favorite-removed-button').click(() => {
                            $('.favorite-removed-message').removeClass(
                                'show-selected-deal-message');
                            // location.reload();
                        });
                    }
                    if (data['error']) {
                        var r = (data['error']);
                        $('.guest-error-message').addClass('show-selected-deal-message');
                        $('.guest-error-button').click(() => {
                            $('.guest-error-message').removeClass(
                                'show-selected-deal-message');
                        });
                    }
                }
            });
        });
        // SHOWS APPROPRIATE SHARE RESPONSE
        $('.share-deal').click(function () {
            const name = $(this).attr('name');
            if ($('.share-deal').hasClass('user')) {
                $('#shared-message-name').text(name);
                $('.share-message').addClass('show-selected-deal-message');
                $('.share-message-button').click(() => {
                    $('.share-message').removeClass(
                        'show-selected-deal-message');
                });
            }
            if ($('.share-deal').hasClass('guest')) {
                $('.guest-error-message').addClass('show-selected-deal-message');
                $('.guest-error-button').click(() => {
                    $('.guest-error-message').removeClass(
                        'show-selected-deal-message');
                });
            }
        });
    });

</script>
@include('includes._footer')
