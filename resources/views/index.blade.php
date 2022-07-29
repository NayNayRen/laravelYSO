@include('includes._header')
<main class="main">
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
                <img class="banner-logo"
                    src="{{ asset('img/fashion/fantastic-sams-banner-logo.png') }}"
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
            {{-- BANNER ARROWS --}}
        </div>
        <div class="banner-arrows">
            <span id='prev' aria-label="Previous Slide"><i class="fa fa-arrow-left" aria-hidden="false"></i></span>
            <span id='next' aria-label="Next Slide"><i class="fa fa-arrow-right" aria-hidden="false"></i></span>
        </div>
    </div>
    {{-- SEARCH BLOCK --}}
    <div class="filter-search-container">
        {{-- SEARCH CONTAINER --}}
        @include('includes._search_container')
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
                        @foreach($categories as $category)
                            <li class="category-item">{{ $category }}</li>
                        @endforeach
                    </ul>
                </div>
                <span id="dashboard-open-button" class="user-icon" aria-label="Open dashboard."
                    title="Open your dashboard."><i class="fa fa-user" aria-hidden="false"></i></span>
            </form>
        </div>
    </div>
    {{-- CASHBACK CONTAINER --}}
    <div class="container">
        {{-- HIDDEN DASHBOARD --}}
        @include('includes._dashboard')
        {{-- HIDDEN MAP --}}
        @include('includes._map')
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
                            <div class="cashback-logo"><img
                                    src="{{ asset('img/fashion/bed-bath-logo.png') }}"
                                    alt="Bed Bath and Beyond Logo"></div>
                            <div class="cashback-discount">
                                <h4>2.3%</h4>
                                <p>Cash Back Rewards</p>
                            </div>
                        </div>
                    </a>
                    <a href="https://yso.netrbx.com/stores/1108-office-depot" target="_blank">
                        <div class="cashback-card">
                            <div class="cashback-logo"><img
                                    src="{{ asset('img/tech/office-depot-logo.png') }}"
                                    alt="Office Depot Logo"></div>
                            <div class="cashback-discount">
                                <h4><span>up to</span>3.5%</h4>
                                <p>Cash Back Rewards</p>
                            </div>
                        </div>
                    </a>
                    <a href="https://yso.netrbx.com/stores/579-finish-line" target="_blank">
                        <div class="cashback-card">
                            <div class="cashback-logo"><img
                                    src="{{ asset('img/fashion/finish-line-logo.png') }}"
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
                            <div class="cashback-logo"><img
                                    src="{{ asset('img/fashion/journeys-logo.png') }}"
                                    alt="Journeys Logo"></div>
                            <div class="cashback-discount">
                                <h4><span>up to</span>3.5%</h4>
                                <p>Cash Back Rewards</p>
                            </div>
                        </div>
                    </a>
                    <a href="https://yso.netrbx.com/stores/9280-best-buy-u-s" target="_blank">
                        <div class="cashback-card">
                            <div class="cashback-logo"><img
                                    src="{{ asset('img/tech/best-buy-logo2.png') }}"
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
                        <div class="cashback-logo"><img
                                src="{{ asset('img/fashion/bed-bath-logo.png') }}"
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
                        <div class="cashback-logo"><img
                                src="{{ asset('img/tech/office-depot-logo.png') }}"
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
                        <div class="cashback-logo"><img
                                src="{{ asset('img/fashion/finish-line-logo.png') }}"
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
                        <div class="cashback-logo"><img
                                src="{{ asset('img/fashion/journeys-logo.png') }}"
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
                        <div class="cashback-logo"><img
                                src="{{ asset('img/tech/best-buy-logo2.png') }}"
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
    {{-- FEATURED CONTAINER USING DEALS DATA --}}
    <div class="container">
        <div class="container-left">
            <span class="category-heading">Featured</span>
            <a href={{ route('deals.featured') }} class="view-all-link">View All</a>
        </div>
        <div class="container-right">
            {{-- CARD BLOCK --}}
            <div class="card-display card-display1 owl-carousel owl-theme">
                @foreach($featuredDeals as $deal)
                    {{-- CARD COMPONENT --}}
                    <div class="card">
                        @include('includes._card')
                    </div>
                @endforeach
            </div>
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
            <div class="card-display owl-carousel owl-theme">
                @foreach($categoryDeals as $deal)
                    {{-- CARD COMPONENT --}}
                    <div class="card">
                        @include('includes._card')
                    </div>
                @endforeach
            </div>
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
            <div class="card-display owl-carousel owl-theme">
                @foreach($techDeals as $deal)
                    {{-- CARD COMPONENT --}}
                    <div class="card">
                        @include('includes._card')
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    {{-- FADING AD BLOCK --}}
    <div class="ad-container">
        <a id="ad-link" class="ad">
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
            <div class="card-display  owl-carousel owl-theme">
                @foreach($popularDeals as $deal)
                    {{-- CARD COMPONENT --}}
                    <div class="card">
                        @include('includes._card')
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</main>
{{-- PAGE SPECIFIC SCRIPTS --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{ asset('js/scrolling-banner.js') }}"></script>
<script src="{{ asset('js/show-all-dropdown.js') }}"></script>
<script src="{{ asset('js/fading-ad.js') }}"></script>
<script src="{{ asset('js/show-dashboard.js') }}"></script>
<script src="{{ asset('js/show-map.js') }}"></script>
<script src="{{ asset('js/show-cashback-message.js') }}"></script>
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // FAVORITE RESPONSE
        $('.add-favourite').click(function () {
            var id = $(this).attr('id');
            const name = $(this).attr('name');
            // console.log(name);
            $.ajax({
                url: "{{ route('add.favourite') }}",
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
                        $('#' + id).addClass('favourite');
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
                        $('#' + parseInt(id)).removeClass('favourite');
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
                    // location.reload();
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
