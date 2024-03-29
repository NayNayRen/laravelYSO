@include('includes._header')
<main class="main">
    {{-- UPDATE PASSWORD MESSAGE --}}
    @include('includes._update_password_message')
    {{-- HIDDEN SHARE MESSAGE --}}
    @include('includes._share_message')
    {{-- HIDDEN FAVORITED ADDED MESSAGE --}}
    @include('includes._favorite_added_message')
    {{-- HIDDEN FAVORITED REMOVED MESSAGE --}}
    @include('includes._favorite_removed_message')
    {{-- USER LOG IN OR OUT MESSAGE --}}
    @include('includes._flash_message_user')
    {{-- GUEST ERROR MESSAGE --}}
    @include('includes._guest_error_message')
    {{-- BANNER BLOCK --}}
    <div class="banner">
        {{-- HERO BANNER SLIDES --}}
        @include('includes._top_hero_banner')
        {{-- BANNER ARROWS --}}
        <div class="banner-arrows">
            <span id='prev' aria-label="Previous Slide"><i class="fa fa-arrow-left" aria-hidden="false"></i></span>
            <span id='next' aria-label="Next Slide"><i class="fa fa-arrow-right" aria-hidden="false"></i></span>
        </div>
    </div>
    {{-- SEARCH BLOCK --}}
    <div class="filter-search-container">
        {{-- HIDDEN DASHBOARD --}}
        @include('includes._dashboard')
        {{-- SEARCH CONTAINER --}}
        <div class="search-container">
            <form action={{ route('deals.search') }} class="search-form" name="searchForm" method="GET">
                <input type="text" name="search" id="search-field" class="search-field"
                    placeholder="Search by type, city, or zip...">
                {{-- <span class="search-form-error">{{ $message }}</span> --}}
                <button type="submit" class="search-button" value="text" name="submit" aria-label="Search"
                    title="Search for a deal."><i class="fa fa-search" aria-hidden="false"></i></button>
                <button type="submit" class="search-button" value="map" name="submit" aria-label="Open map."
                    title="Search for a deal."><i class="fa fa-map-marker" aria-hidden="false"></i></button>
            </form>
        </div>
        {{-- FILTER BLOCK --}}
        <div class="filter-container">
            <form action={{ route('deals.index') }} method="GET">
                <input type='submit' class="filter-selection" name="food" value="food"></input>
                <input type='submit' class="filter-selection" name="fashion" value="fashion"></input>
                <input type='submit' class="filter-selection" name="auto" value="auto"></input>
                <input type='submit' class="filter-selection" name="fun" value="fun"></input>
                <input type='submit' class="filter-selection" name="health" value="health"></input>
                <div>
                    <input type='button' class="all-button" value="all">
                    </input>
                    <span class="all-button-arrow">
                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                    </span>
                    <ul class="all-button-dropdown">
                        @foreach ($categories as $category)
                            <li class="category-item">{{ $category }}</li>
                        @endforeach
                    </ul>
                </div>
                <span id="dashboard-open-button" class="user-icon" aria-label="Open dashboard."
                    title="Open the dashboard."><i class="fa fa-user" aria-hidden="false"></i></span>
            </form>
        </div>
    </div>
    {{-- CASHBACK CONTAINER --}}
    @include('includes._cashback_slides')
    <div>
    </div>
    {{-- FEATURED CONTAINER --}}
    <div class="container">
        <div class="container-left">
            <span class="category-heading">Featured</span>
            <a href={{ route('deals.featured') }} class="view-all-link">View All</a>
        </div>
        <div id="featured" class="container-right">
            {{-- CARD BLOCK --}}
            @if ($featuredDeals->count() === 0)
                <div class="no-deals-container">
                    <h2>Unfortunately...</h2>
                    <p>There were no deals to be shown.</p>
                    <h3>However...</h3>
                    <p>There are plenty more.</p>
                    <h3>Please continue your search.</h3>
                </div>
            @elseif($featuredDeals->count() === 1 || $featuredDeals->count() === 2)
                <div class="card-display-limited-amount">
                    @foreach ($featuredDeals as $deal)
                        {{-- CARD COMPONENT --}}
                        <div class="card">
                            @include('includes._card')
                        </div>
                    @endforeach
                </div>
            @else
                <div class="card-display card-display1 owl-carousel owl-theme featured-carousel">
                    @foreach ($featuredDeals as $deal)
                        {{-- CARD COMPONENT --}}
                        <div class="card">
                            @include('includes._card')
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    {{-- SELECTED CATEGORY CONTAINER --}}
    <div class="container">
        <div class="container-left">
            <span class="category-heading">{{ $categoryHeading }}</span>
            <a href={{ route('deals.' . $categoryHeading) }} class="view-all-link">View
                All</a>
        </div>
        <div id="selected-category" class="container-right">
            {{-- CARD BLOCK --}}
            @if ($categoryDeals->count() === 0)
                <div class="no-deals-container">
                    <h2>Unfortunately...</h2>
                    <p>There were no deals to be shown.</p>
                    <h3>However...</h3>
                    <p>There are plenty more.</p>
                    <h3>Please continue your search.</h3>
                </div>
            @elseif($categoryDeals->count() === 1 || $categoryDeals->count() === 2)
                <div class="card-display-limited-amount">
                    @foreach ($categoryDeals as $deal)
                        {{-- CARD COMPONENT --}}
                        <div class="card">
                            @include('includes._card')
                        </div>
                    @endforeach
                </div>
            @else
                <div class="card-display owl-carousel owl-theme selected-category-carousel">
                    @foreach ($categoryDeals as $deal)
                        {{-- CARD COMPONENT --}}
                        <div class="card">
                            @include('includes._card')
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    {{-- TECH CONTAINER --}}
    <div class="container">
        <div class="container-left">
            <span class="category-heading">Tech</span>
            <a href={{ route('deals.tech') }} class="view-all-link">View All</a>
        </div>
        <div id="tech" class="container-right">
            {{-- CARD BLOCK --}}
            @if ($techDeals->count() === 0)
                <div class="no-deals-container">
                    <h2>Unfortunately...</h2>
                    <p>There were no deals to be shown.</p>
                    <h3>However...</h3>
                    <p>There are plenty more.</p>
                    <h3>Please continue your search.</h3>
                </div>
            @elseif($techDeals->count() === 1 || $techDeals->count() === 2)
                <div class="card-display-limited-amount">
                    @foreach ($techDeals as $deal)
                        {{-- CARD COMPONENT --}}
                        <div class="card">
                            @include('includes._card')
                        </div>
                    @endforeach
                </div>
            @else
                <div class="card-display owl-carousel owl-theme tech-carousel">
                    @foreach ($techDeals as $deal)
                        {{-- CARD COMPONENT --}}
                        <div class="card">
                            @include('includes._card')
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    {{-- FADING AD BLOCK --}}
    <div class="ad-container">
        <a href="#" id="ad-link" class="ad" target="_blank">
            <img id="ad" name='slide'>
            {{-- BANNER IS INJECTED DYNAMICALLY --}}
        </a>
    </div>
    {{-- POPULAR CONTAINER --}}
    <div class="container gray-background">
        <div class="container-left">
            <span class="category-heading">Popular</span>
            <a href={{ route('deals.popular') }} class="view-all-link">View All</a>
        </div>
        <div id="popular" class="container-right">
            {{-- CARD BLOCK --}}
            @if ($popularDeals->count() === 0)
                <div class="no-deals-container">
                    <h2>Unfortunately...</h2>
                    <p>There were no deals to be shown.</p>
                    <h3>However...</h3>
                    <p>There are plenty more.</p>
                    <h3>Please continue your search.</h3>
                </div>
            @elseif($popularDeals->count() === 1 || $popularDeals->count() === 2)
                <div class="card-display-limited-amount">
                    @foreach ($popularDeals as $deal)
                        {{-- CARD COMPONENT --}}
                        <div class="card">
                            @include('includes._card')
                        </div>
                    @endforeach
                </div>
            @else
                <div class="card-display owl-carousel owl-theme popular-carousel">
                    @foreach ($popularDeals as $deal)
                        {{-- CARD COMPONENT --}}
                        <div class="card">
                            @include('includes._card')
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</main>
{{-- PAGE SPECIFIC SCRIPTS --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{ asset('js/scrolling-banner.js') }}"></script>
<script src="{{ asset('js/show-all-dropdown.js') }}"></script>
<script src="{{ asset('js/fading-ad.js') }}"></script>
<script src="{{ asset('js/show-dashboard.js') }}"></script>
<script src="{{ asset('js/show-cashback-message.js') }}"></script>
</script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // HOMEPAGE CAROUSEL
        const featuredCarousel = $(".featured-carousel");
        const selectedCategoryCarousel = $(".selected-category-carousel");
        const techCarousel = $(".tech-carousel");
        const popularCarousel = $(".popular-carousel");
        const homepageCarouselOptions = {
            loop: true,
            nav: true,
            items: 3,
            autoplay: false,
            autoplayTimeout: 3000,
            smartSpeed: 500, // scroll in ms
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
                700: {
                    items: 2,
                },
                1400: {
                    items: 3,
                },
            },
        };
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
        featuredCarousel.owlCarousel(homepageCarouselOptions);
        selectedCategoryCarousel.owlCarousel(homepageCarouselOptions);
        techCarousel.owlCarousel(homepageCarouselOptions);
        popularCarousel.owlCarousel(homepageCarouselOptions);
        // FAVORITE RESPONSE
        $(document).on('click', '.add-favorite', function() {
            var id = $(this).attr('id');
            const name = $(this).attr('name');
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
                            //     $('#dashboard-right-container').load(window
                            //         .location +
                            //         ' #dashboard-right-container>*', "",
                            //         function() {
                            //             $(".dashboard-carousel")
                            //                 .owlCarousel(
                            //                     dashboardCarouselOptions
                            //                 );
                            //         });
                            //     // console.log($(location).attr("href"));
                            //     // $.get($(location).attr("href"), function(
                            //     //     response) {
                            //     //     const reloadPopular = $(
                            //     //         response).find(
                            //     //         '#popular')
                            //     //     console.log(reloadPopular);
                            //     // });
                            //     // // featured reload
                            //     // $('#featured').load(window
                            //     //     .location +
                            //     //     ' #featured>*', "",
                            //     //     function() {
                            //     //         $(".featured-carousel")
                            //     //             .owlCarousel(
                            //     //                 homepageCarouselOptions
                            //     //             );
                            //     //     });
                            //     // // selected category reload
                            //     // $('#selected-category').load(window
                            //     //     .location +
                            //     //     ' #selected-category>*', "",
                            //     //     function() {
                            //     //         $(".selected-category-carousel")
                            //     //             .owlCarousel(
                            //     //                 homepageCarouselOptions
                            //     //             );
                            //     //     });
                            //     // // tech reload
                            //     // $('#tech').load(window
                            //     //     .location +
                            //     //     ' #tech>*', "",
                            //     //     function() {
                            //     //         $(".tech-carousel")
                            //     //             .owlCarousel(
                            //     //                 homepageCarouselOptions
                            //     //             );
                            //     //     });
                            //     // // popular reload
                            //     // $('#popular').load(window
                            //     //     .location +
                            //     //     ' #popular>*', "",
                            //     //     function() {
                            //     //         $(".popular-carousel")
                            //     //             .owlCarousel(
                            //     //                 homepageCarouselOptions
                            //     //             );
                            //     //     });
                            //     // $(document).ajaxStop(function() {
                            //     //     window.location.reload();
                            //     // });
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
                            //     $('#dashboard-right-container').load(window
                            //         .location +
                            //         ' #dashboard-right-container>*', "",
                            //         function() {
                            //             $(".dashboard-carousel")
                            //                 .owlCarousel(
                            //                     dashboardCarouselOptions
                            //                 );
                            //         });
                            //     // // featured reload
                            //     // $('#featured').load(window
                            //     //     .location +
                            //     //     ' #featured>*', "",
                            //     //     function() {
                            //     //         $(".featured-carousel")
                            //     //             .owlCarousel(
                            //     //                 homepageCarouselOptions
                            //     //             );
                            //     //     });
                            //     // // selected category reload
                            //     // $('#selected-category').load(window
                            //     //     .location +
                            //     //     ' #selected-category>*', "",
                            //     //     function() {
                            //     //         $(".selected-category-carousel")
                            //     //             .owlCarousel(
                            //     //                 homepageCarouselOptions
                            //     //             );
                            //     //     });
                            //     // // tech reload
                            //     // $('#tech').load(window
                            //     //     .location +
                            //     //     ' #tech>*', "",
                            //     //     function() {
                            //     //         $(".tech-carousel")
                            //     //             .owlCarousel(
                            //     //                 homepageCarouselOptions
                            //     //             );
                            //     //     });
                            //     // // popular reload
                            //     // $('#popular').load(window
                            //     //     .location +
                            //     //     ' #popular>*', "",
                            //     //     function() {
                            //     //         $(".popular-carousel")
                            //     //             .owlCarousel(
                            //     //                 homepageCarouselOptions
                            //     //             );
                            //     //     });
                            //     // $(document).ajaxStop(function() {
                            //     //     window.location.reload();
                            //     // });
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
        // UPDATE PASSWORD MESSAGE WHEN MEDIA IS USED TO LOG IN
        if ($(window).width() > 400) {
            $('.update-password-message').css('top', '150px');
        }
        if ($(window).width() <= 400) {
            $('.update-password-message').css('top', '0');
        }
        $('.update-password-button').click(() => {
            $('.update-password-message').css('top', '-100%');
        });

        // FLASH MESSAGE DISPLAY WITH TIMER TO REMOVE
        // waits for 250ms then shows message
        setTimeout(() => {
            if ($(window).width() > 400) {
                $('.flash-message-user').css('top', '150px');
            }
            if ($(window).width() <= 400) {
                $('.flash-message-user').css('top', '0');
            }
            // after displaying for 7000ms(7s) message hides itself
            setTimeout(() => {
                $('.flash-message-user').css('top', '-100%');
            }, 5000);
        }, 250);
    });
</script>
@include('includes._footer')
