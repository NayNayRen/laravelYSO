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
        <h1>Your Selected Location</h1>
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
    <span class="current-page" hidden>single location</span>
    <span class="submit-method" hidden>{{ $submitMethod }}</span>
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
        <div class="alternate-container-heading">
            Your Location Deals
        </div>
        <div class="alternate-container-location-info">
            @if (count($locationDeals) === 0)
                <div>No deals available for this location yet.</div>
            @else
                <div>
                    - <span>{{ count($locationDeals) }}</span>
                    @if (count($locationDeals) > 1)
                        Deals
                    @else
                        Deal
                    @endif
                    From
                    <span>{{ ucwords($location->name) }}</span> -<br>
                    {{ $location->location }}
                </div>
            @endif
        </div>
        <div id="card-display" class="container-right">
            {{-- CARD BLOCK --}}
            @if ($locationDeals->count() === 1)
                <div class="card-display-limited-amount">
                    @foreach ($locationDeals as $deal)
                        {{-- CARD COMPONENT --}}
                        <div class="limited-amount-card">
                            @include('includes._alternate_card')
                        </div>
                    @endforeach
                </div>
            @elseif($locationDeals->count() === 2)
                <div class="card-display-limited-amount">
                    @foreach ($locationDeals as $deal)
                        {{-- CARD COMPONENT --}}
                        <div class="limited-amount-card">
                            @include('includes._alternate_card')
                        </div>
                    @endforeach
                </div>
            @else
                <div class="card-display-view-all owl-carousel owl-theme location-carousel">
                    @foreach ($locationDeals as $deal)
                        {{-- CARD COMPONENT --}}
                        <div class="alternate-card">
                            @include('includes._alternate_card')
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
{{-- PAGE SPECIFIC SCRIPTS --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{ asset('js/show-search-error.js') }}"></script>
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
        var locationCarousel = $(".location-carousel");
        const dashboardCarouselOptions = {
            loop: true,
            nav: true,
            items: 3,
            autoplay: false,
            autoplayTimeout: 3000,
            smartSpeed: 500, // scroll in ms
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
        const locationCarouselOptions = {
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
                    items: 1,
                    dots: false,
                },
                540: {
                    items: 2,
                },
                1300: {
                    items: 3,
                },
            },
        };
        // LOCATION PAGE CAROUSEL
        locationCarousel.owlCarousel(locationCarouselOptions);
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
                            // setTimeout(() => {
                            //     // AJAX RELOADS PAGE CAROUSEL
                            //     $('#card-display').load(window.location +
                            //         ' #card-display>*', "",
                            //         function() {
                            //             $(".location-carousel")
                            //                 .owlCarousel(
                            //                     locationCarouselOptions
                            //                 );
                            //         });
                            //     // AJAX RELOADS DASHBOARD
                            //     $('#dashboard-right-container').load(window
                            //         .location +
                            //         ' #dashboard-right-container>*', "",
                            //         function() {
                            //             $(".dashboard-carousel")
                            //                 .owlCarousel(
                            //                     dashboardCarouselOptions
                            //                 );
                            //         });
                            // }, 750);
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
                            // setTimeout(() => {
                            //     // AJAX RELOADS PAGE CAROUSEL
                            //     $('#card-display').load(window.location +
                            //         ' #card-display>*', "",
                            //         function() {
                            //             $(".location-carousel")
                            //                 .owlCarousel(
                            //                     locationCarouselOptions
                            //                 );
                            //         });
                            //     // AJAX RELOADS DASHBOARD
                            //     $('#dashboard-right-container').load(window
                            //         .location +
                            //         ' #dashboard-right-container>*', "",
                            //         function() {
                            //             $(".dashboard-carousel")
                            //                 .owlCarousel(
                            //                     dashboardCarouselOptions
                            //                 );
                            //         });
                            // }, 750);
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
