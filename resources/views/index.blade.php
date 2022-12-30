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
        <div class="banner-slide-container">
            {{-- SLIDE 1 --}}
            <div class="banner-slide">
                <div class="banner-gradient"></div>
                <div class="banner-container-text">
                    <span class='banner-text-one'>
                        <img src="{{ asset('img/fashion/fantastic-sams-logo.png') }}"
                            alt="Fantastic Sams Company Logo"></span>
                    <span class='banner-text-two'>$10 gift card.</span>
                    <a href="#" class="banner-redemption">Get Deal Now!</a>
                </div>
                <div class="banner-container-image banner-image-main-1">
                </div>
                <img class="banner-logo" src="{{ asset('img/fashion/fantastic-sams-banner-logo.png') }}"
                    alt="Fantastic Sams Company Logo">
            </div>
            {{-- SLIDE 2 --}}
            <div class="banner-slide even">
                <img class="banner-logo left" src="{{ asset('img/food/bk-banner-logo.png') }}"
                    alt="Burger King Company Logo">
                <div class="banner-gradient"></div>
                <div class="banner-container-image banner-image-main-2">
                </div>
                <div class="banner-container-text">
                    <span class='banner-text-one'>free!!!</span>
                    <span class='banner-text-two'>medium fry with sandwich purchase.</span>
                    <a href="#" class="banner-redemption">Get Deal Now!</a>
                </div>
            </div>
            {{-- SLIDE 3 --}}
            <div class="banner-slide">
                <div class="banner-gradient"></div>
                <div class="banner-container-text">
                    <span class='banner-text-one'>$5 off</span>
                    <span class='banner-text-two'>any order of $15 or more.</span>
                    <a href="#" class="banner-redemption">Get Deal Now!</a>
                </div>
                <div class="banner-container-image banner-image-main-3">
                </div>
                <img class="banner-logo" src="{{ asset('img/food/mcdonalds-banner-logo.png') }}"
                    alt="McDonalds Company Logo">
            </div>
            {{-- SLIDE 4 --}}
            <div class="banner-slide even">
                <img class="banner-logo left" src="{{ asset('img/fashion/adidas-banner-logo.png') }}"
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
            {{-- BANNER ARROWS --}}
        </div>
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
    <div class="container">
        <div class="container-left">
            <span class="category-heading">Cashback</span>
        </div>
        <div class="container-right">
            {{-- CARD BLOCK --}}
            <div class="cashback-display">
                {{-- CASHBACK CARDS WHEN LOGGED IN --}}
                @auth
                    <a href="https://yso.netrbx.com/stores/188-bed-bath-beyond" target="_blank">
                        <div class="cashback-card">
                            <div class="cashback-logo"><img src="{{ asset('img/fashion/bed-bath-logo.png') }}"
                                    alt="Bed Bath and Beyond Logo"></div>
                            <div class="cashback-discount">
                                <h4>2.3%</h4>
                                <p>Cash Back Rewards</p>
                            </div>
                        </div>
                    </a>
                    <a href="https://yso.netrbx.com/stores/1108-office-depot" target="_blank">
                        <div class="cashback-card">
                            <div class="cashback-logo"><img src="{{ asset('img/tech/office-depot-logo.png') }}"
                                    alt="Office Depot Logo"></div>
                            <div class="cashback-discount">
                                <h4><span>up to</span>3.5%</h4>
                                <p>Cash Back Rewards</p>
                            </div>
                        </div>
                    </a>
                    <a href="https://yso.netrbx.com/stores/579-finish-line" target="_blank">
                        <div class="cashback-card">
                            <div class="cashback-logo"><img src="{{ asset('img/fashion/finish-line-logo.png') }}"
                                    alt="Finish Line Logo">
                            </div>
                            <div class="cashback-discount">
                                <h4>2.9%</h4>
                                <p>Cash Back Rewards</p>
                            </div>
                        </div>
                    </a>
                    <a href="https://yso.netrbx.com/stores/837-journeys" target="_blank">
                        <div class="cashback-card">
                            <div class="cashback-logo"><img src="{{ asset('img/fashion/journeys-logo.png') }}"
                                    alt="Journeys Logo"></div>
                            <div class="cashback-discount">
                                <h4><span>up to</span>3.5%</h4>
                                <p>Cash Back Rewards</p>
                            </div>
                        </div>
                    </a>
                    <a href="https://yso.netrbx.com/stores/9280-best-buy-u-s" target="_blank">
                        <div class="cashback-card">
                            <div class="cashback-logo"><img src="{{ asset('img/tech/best-buy-logo2.png') }}"
                                    alt="Best Buy Logo">
                            </div>
                            <div class="cashback-discount">
                                <h4>0.3%</h4>
                                <p>Cash Back Rewards</p>
                            </div>
                        </div>
                    </a>
                    {{-- CASHBACK CARDS WHEN NOT LOGGED IN --}}
                @else
                    <div class="cashback-card guest">
                        <div class="cashback-card-message">
                            <a href={{ route('user.create') }}>Register</a>
                            <span>and/or</span>
                            <a href={{ route('login.showLoginForm') }}>Log In</a>
                            <span>to continue.</span>
                        </div>
                        <div class="cashback-logo"><img src="{{ asset('img/fashion/bed-bath-logo.png') }}"
                                alt="Bed Bath and Beyond Logo"></div>
                        <div class="cashback-discount">
                            <h4>2.3%</h4>
                            <p>Cash Back Rewards</p>
                        </div>
                    </div>
                    <div class="cashback-card guest">
                        <div class="cashback-card-message">
                            <a href={{ route('user.create') }}>Register</a>
                            <span>and/or</span>
                            <a href={{ route('login.showLoginForm') }}>Log In</a>
                            <span>to continue.</span>
                        </div>
                        <div class="cashback-logo"><img src="{{ asset('img/tech/office-depot-logo.png') }}"
                                alt="Office Depot Logo"></div>
                        <div class="cashback-discount">
                            <h4><span>up to</span>3.5%</h4>
                            <p>Cash Back Rewards</p>
                        </div>
                    </div>
                    <div class="cashback-card guest">
                        <div class="cashback-card-message">
                            <a href={{ route('user.create') }}>Register</a>
                            <span>and/or</span>
                            <a href={{ route('login.showLoginForm') }}>Log In</a>
                            <span>to continue.</span>
                        </div>
                        <div class="cashback-logo"><img src="{{ asset('img/fashion/finish-line-logo.png') }}"
                                alt="Finish Line Logo">
                        </div>
                        <div class="cashback-discount">
                            <h4>2.9%</h4>
                            <p>Cash Back Rewards</p>
                        </div>
                    </div>
                    <div class="cashback-card guest">
                        <div class="cashback-card-message">
                            <a href={{ route('user.create') }}>Register</a>
                            <span>and/or</span>
                            <a href={{ route('login.showLoginForm') }}>Log In</a>
                            <span>to continue.</span>
                        </div>
                        <div class="cashback-logo"><img src="{{ asset('img/fashion/journeys-logo.png') }}"
                                alt="Journeys Logo"></div>
                        <div class="cashback-discount">
                            <h4><span>up to</span>3.5%</h4>
                            <p>Cash Back Rewards</p>
                        </div>
                    </div>
                    <div class="cashback-card guest">
                        <div class="cashback-card-message">
                            <a href={{ route('user.create') }}>Register</a>
                            <span>and/or</span>
                            <a href={{ route('login.showLoginForm') }}>Log In</a>
                            <span>to continue.</span>
                        </div>
                        <div class="cashback-logo"><img src="{{ asset('img/tech/best-buy-logo2.png') }}"
                                alt="Best Buy Logo">
                        </div>
                        <div class="cashback-discount">
                            <h4>0.3%</h4>
                            <p>Cash Back Rewards</p>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>
    <div>
    </div>
    {{-- FEATURED CONTAINER USING DEALS DATA --}}
    <div class="container">
        <div class="container-left">
            <span class="category-heading">Featured</span>
            <a href={{ route('deals.featured') }} class="view-all-link">View All</a>
        </div>
        <div class="container-right">
            {{-- CARD BLOCK --}}
            @if ($featuredDeals->count() === 1)
                <div class="card-display-limited-amount">
                    @foreach ($featuredDeals as $deal)
                        {{-- CARD COMPONENT --}}
                        <div class="card">
                            @include('includes._card')
                        </div>
                    @endforeach
                </div>
            @elseif($featuredDeals->count() === 2)
                <div class="card-display-limited-amount">
                    @foreach ($featuredDeals as $deal)
                        {{-- CARD COMPONENT --}}
                        <div class="card">
                            @include('includes._card')
                        </div>
                    @endforeach
                </div>
            @else
                <div id="featured">
                    <div class="card-display card-display1 owl-carousel owl-theme homepage-carousel">
                        @foreach ($featuredDeals as $deal)
                            {{-- CARD COMPONENT --}}
                            <div class="card">
                                @include('includes._card')
                            </div>
                        @endforeach
                    </div>
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
        <div class="container-right">
            {{-- CARD BLOCK --}}
            @if ($categoryDeals->count() === 1)
                <div class="card-display-limited-amount">
                    @foreach ($categoryDeals as $deal)
                        {{-- CARD COMPONENT --}}
                        <div class="card">
                            @include('includes._card')
                        </div>
                    @endforeach
                </div>
            @elseif($categoryDeals->count() === 2)
                <div class="card-display-limited-amount">
                    @foreach ($categoryDeals as $deal)
                        {{-- CARD COMPONENT --}}
                        <div class="card">
                            @include('includes._card')
                        </div>
                    @endforeach
                </div>
            @else
                <div id="selected-category">
                    <div class="card-display owl-carousel owl-theme homepage-carousel">
                        @foreach ($categoryDeals as $deal)
                            {{-- CARD COMPONENT --}}
                            <div class="card">
                                @include('includes._card')
                            </div>
                        @endforeach
                    </div>
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
        <div class="container-right">
            {{-- CARD BLOCK --}}
            @if ($techDeals->count() === 1)
                <div class="card-display-limited-amount">
                    @foreach ($techDeals as $deal)
                        {{-- CARD COMPONENT --}}
                        <div class="card">
                            @include('includes._card')
                        </div>
                    @endforeach
                </div>
            @elseif($techDeals->count() === 2)
                <div class="card-display-limited-amount">
                    @foreach ($techDeals as $deal)
                        {{-- CARD COMPONENT --}}
                        <div class="card">
                            @include('includes._card')
                        </div>
                    @endforeach
                </div>
            @else
                <div id="tech">
                    <div class="card-display owl-carousel owl-theme homepage-carousel">
                        @foreach ($techDeals as $deal)
                            {{-- CARD COMPONENT --}}
                            <div class="card">
                                @include('includes._card')
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
    {{-- FADING AD BLOCK --}}
    <div class="ad-container">
        <a href="#" id="ad-link" class="ad">
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
        <div class="container-right">
            {{-- CARD BLOCK --}}
            @if ($popularDeals->count() === 1)
                <div class="card-display-limited-amount">
                    @foreach ($popularDeals as $deal)
                        {{-- CARD COMPONENT --}}
                        <div class="card">
                            @include('includes._card')
                        </div>
                    @endforeach
                </div>
            @elseif($popularDeals->count() === 2)
                <div class="card-display-limited-amount">
                    @foreach ($popularDeals as $deal)
                        {{-- CARD COMPONENT --}}
                        <div class="card">
                            @include('includes._card')
                        </div>
                    @endforeach
                </div>
            @else
                <div id="popular">
                    <div class="card-display owl-carousel owl-theme homepage-carousel">
                        @foreach ($popularDeals as $deal)
                            {{-- CARD COMPONENT --}}
                            <div class="card">
                                @include('includes._card')
                            </div>
                        @endforeach
                    </div>
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
        var owl = $(".homepage-carousel");
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
                540: {
                    items: 2,
                },
                1300: {
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
        owl.owlCarousel(homepageCarouselOptions);
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
                        var r = (data['success']);
                        $('#' + id).addClass('favorite');
                        $('#favorite-added-name').text(name);
                        $('.favorite-added-message').addClass('show-selected-deal-message');
                        $(document).on('click', '.favorite-added-button', function() {
                            $('.favorite-added-message').removeClass(
                                'show-selected-deal-message');
                            setTimeout(() => {
                                $('#dashboard-right-container').load(window
                                    .location +
                                    ' #dashboard-right-container>*', "",
                                    function() {
                                        $(".dashboard-carousel")
                                            .owlCarousel(
                                                dashboardCarouselOptions
                                            );
                                    });
                                // featured reload
                                $('#featured').load(window
                                    .location +
                                    ' #featured>*', "",
                                    function() {
                                        $(".homepage-carousel")
                                            .owlCarousel(
                                                homepageCarouselOptions
                                            );
                                    });
                                // selected category reload
                                $('#selected-category').load(window
                                    .location +
                                    ' #selected-category>*', "",
                                    function() {
                                        $(".homepage-carousel")
                                            .owlCarousel(
                                                homepageCarouselOptions
                                            );
                                    });
                                // tech reload
                                $('#tech').load(window
                                    .location +
                                    ' #tech>*', "",
                                    function() {
                                        $(".homepage-carousel")
                                            .owlCarousel(
                                                homepageCarouselOptions
                                            );
                                    });
                                // popular reload
                                $('#popular').load(window
                                    .location +
                                    ' #popular>*', "",
                                    function() {
                                        $(".homepage-carousel")
                                            .owlCarousel(
                                                homepageCarouselOptions
                                            );
                                    });
                            }, 750);
                        });
                    }
                    if (data['delete']) {
                        var r = (data['delete']);
                        $('#' + parseInt(id)).removeClass('favorite');
                        $('#favorite-removed-name').text(name);
                        $('.favorite-removed-message').addClass(
                            'show-selected-deal-message');
                        $(document).on('click', '.favorite-removed-button', function() {
                            $('.favorite-removed-message').removeClass(
                                'show-selected-deal-message');
                            setTimeout(() => {
                                $('#dashboard-right-container').load(window
                                    .location +
                                    ' #dashboard-right-container>*', "",
                                    function() {
                                        $(".dashboard-carousel")
                                            .owlCarousel(
                                                dashboardCarouselOptions
                                            );
                                    });
                                // featured reload
                                $('#featured').load(window
                                    .location +
                                    ' #featured>*', "",
                                    function() {
                                        $(".homepage-carousel")
                                            .owlCarousel(
                                                homepageCarouselOptions
                                            );
                                    });
                                // selected category reload
                                $('#selected-category').load(window
                                    .location +
                                    ' #selected-category>*', "",
                                    function() {
                                        $(".homepage-carousel")
                                            .owlCarousel(
                                                homepageCarouselOptions
                                            );
                                    });
                                // tech reload
                                $('#tech').load(window
                                    .location +
                                    ' #tech>*', "",
                                    function() {
                                        $(".homepage-carousel")
                                            .owlCarousel(
                                                homepageCarouselOptions
                                            );
                                    });
                                // popular reload
                                $('#popular').load(window
                                    .location +
                                    ' #popular>*', "",
                                    function() {
                                        $(".homepage-carousel")
                                            .owlCarousel(
                                                homepageCarouselOptions
                                            );
                                    });
                            }, 750);
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
