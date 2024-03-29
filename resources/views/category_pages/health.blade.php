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
        {{-- HERO BANNER SLIDES --}}
        @include('includes._top_hero_banner')
        {{-- BANNER ARROWS --}}
        <div class="banner-arrows banner-arrows-alternate">
            <span id='prev' aria-label="Previous Slide"><i class="fa fa-arrow-left" aria-hidden="false"></i></span>
            <span id='next' aria-label="Next Slide"><i class="fa fa-arrow-right" aria-hidden="false"></i></span>
        </div>
    </div>
    {{-- HEADING AND MAP DISCLAIMER --}}
    <div class="view-all-container-heading">
        <h1>Healthy choices & healthy discounts</h1>
        @if (count($locations) === 0)
            <span class="map-use-disclaimer">No location results came back to show on the map <i
                    class="fa fa-map-marker" aria-hidden="true"></i> , it
                could just be a merchant hasn't registered any yet. Check
                to
                see if any came back below.</span>
        @else
            <span class="map-use-disclaimer">Use the map button <i class="fa fa-map-marker" aria-hidden="true"></i>
                below
                to
                see the <span>{{ count($locations) }}</span>
                @if (count($locations) > 1)
                    locations
                @else
                    location
                @endif
                returned from your search.
            </span>
        @endif
        {{-- HIDDEN DASHBOARD --}}
        @include('includes._dashboard')
    </div>
    <div class="search-results-search-container">
        {{-- SEARCH CONTAINER --}}
        @include('includes._search_container')
        {{-- USER DASHBOARD BUTTON --}}
        <button id="dashboard-open-button" class="user-icon view-all-user-icon"><i class="fa fa-user"
                aria-label="Open dashboard." title="Open the dashboard." aria-hidden="false"></i></button>
    </div>
    {{-- USED TO PULL LOCATION SEARCH DATA FOR GOOGLE MAP PINS --}}
    <span class="current-page" hidden>health</span>
    <span class="submit-method">{{ $submitMethod }}</span>
    <span hidden>{{ count($locations) }}</span>
    @foreach ($locations as $location)
        @if (!empty($location->lat) && !empty($location->lon))
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

    <div class="alternate-container">
        @if (count($deals) === 0 || $deals === null)
            <div class="card-display-limited-amount">
                <h1>No deals available.</h1>
            </div>
        @else
            <div class="alternate-container-heading">
                Our Healthy Deals
            </div>
            <span class="alternate-container-count">
                {{ $deals->links('vendor.pagination.custom-view-all-pagination') }}
            </span>
            <div class="container-right">
                {{-- CARD BLOCK --}}
                @if ($deals->count() === 1)
                    <div class="alternate-count">
                        - {{ count($deals) }} Deal -
                    </div>
                    <div id="card-display" class="card-display-limited-amount">
                        @foreach ($deals as $deal)
                            {{-- CARD COMPONENT --}}
                            <div class="limited-amount-card">
                                @include('includes._alternate_card')
                            </div>
                        @endforeach
                    </div>
                @elseif($deals->count() === 2)
                    <div class="alternate-count">
                        - {{ count($deals) }} Deals -
                    </div>
                    <div id="card-display" class="card-display-limited-amount">
                        @foreach ($deals as $deal)
                            {{-- CARD COMPONENT --}}
                            <div class="limited-amount-card">
                                @include('includes._alternate_card')
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alternate-count">
                        - {{ count($deals) }} Deals -
                    </div>
                    <div id="card-display" class="card-display-view-all">
                        @foreach ($deals as $deal)
                            {{-- CARD COMPONENT --}}
                            <div class="limited-amount-card">
                                @include('includes._alternate_card')
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @endif
    </div>

</div>
{{-- PAGE SPECIFIC SCRIPTS --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{ asset('js/scrolling-banner.js') }}"></script>
<script src="{{ asset('js/show-dashboard.js') }}"></script>
<script src="{{ asset('js/show-map.js') }}"></script>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAqYr4C7xfuJFJOEUGVmMSBtakLS-9ajSA&libraries=geometry&callback=Function.prototype"
    async defer></script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        const dashboardCarouselOptions = {
            loop: true,
            nav: true,
            items: 3,
            autoplay: false,
            autoplayTimeout: 3000,
            smartSpeed: 500, // length of time to scroll in ms
            // autoplayHoverPause: true, set to true causes autoplay on mobile
            autoplayHoverPause: false,
            dots: false,
            touchDrag: true,
            navText: [
                "<div class='container-arrow-left' aria-label='Previous Arrow'><i class='fa fa-arrow-left' aria-hidden='false'></i></div>",
                "<div class='container-arrow-right' aria-label='Next Arrow'><i class='fa fa-arrow-right' aria-hidden='false'></i></div>",
            ],
            responsive: {
                0: {
                    // < 540
                    items: 1,
                    dots: false,
                },
                540: {
                    // 540 - 1100
                    items: 1,
                },
                1100: {
                    // > 1100
                    items: 2,
                },
            },
        };
        // FAVORITE RESPONSE
        $(document).on('click', '.add-favorite', function() {
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
                success: function(data) {
                    if (data['success']) {
                        $('#' + id).addClass('favorite');
                        $('#favorite-added-name').text(name);
                        $('.favorite-added-message').addClass('show-selected-deal-message');
                        $(document).on('click', '.favorite-added-button', function() {
                            $('.favorite-added-message').removeClass(
                                'show-selected-deal-message');
                            setTimeout(() => {
                                $('#card-display').load(window.location +
                                    ' #card-display>*', "");
                                // AJAX RELOADS DASHBOARD
                                // $('#dashboard-right-container').load(window
                                //     .location +
                                //     ' #dashboard-right-container>*', "",
                                //     function() {
                                //         $(".dashboard-carousel")
                                //             .owlCarousel(
                                //                 dashboardCarouselOptions
                                //             );
                                //     });
                            }, 750);
                        });
                    }
                    if (data['delete']) {
                        $('#' + parseInt(id)).removeClass('favorite');
                        $('#favorite-removed-name').text(name);
                        $('.favorite-removed-message').addClass(
                            'show-selected-deal-message');
                        $(document).on('click', '.favorite-removed-button', function() {
                            $('.favorite-removed-message').removeClass(
                                'show-selected-deal-message');
                            setTimeout(() => {
                                $('#card-display').load(window.location +
                                    ' #card-display>*', "");
                                // AJAX RELOADS DASHBOARD
                                // $('#dashboard-right-container').load(window
                                //     .location +
                                //     ' #dashboard-right-container>*', "",
                                //     function() {
                                //         $(".dashboard-carousel")
                                //             .owlCarousel(
                                //                 dashboardCarouselOptions
                                //             );
                                //     });
                            }, 750);
                        });
                    }
                    if (data['error']) {
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
        $(document).on('click', '.share-deal', function() {
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
