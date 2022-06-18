@include('includes._header')
<main class="main">
    {{-- USER LOG IN OR OUT MESSAGE --}}
    @include('includes._flash_message_user')
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
            <span id='prev'><i class="fa fa-arrow-left" aria-hidden="true"></i></span>
            <span id='next'><i class="fa fa-arrow-right" aria-hidden="true"></i></span>
        </div>
    </div>
    {{-- SEARCH BLOCK --}}
    <div class="filter-search-container">
        <div class="search-container">
            <form id="search-form">
                <input type="text" id="search-field" class="search-field" placeholder="Search by type, city, or zip...">
                <button type="submit" id="search-button" class="search-button"><i class="fa fa-search"
                        aria-hidden="true"></i></button>
                <button type="button" id="map-button" class="search-button"><i class="fa fa-map-marker"
                        aria-hidden="true"></i></button>
            </form>
        </div>
        {{-- FILTER BLOCK --}}
        <div class="filter-container">
            <button id="food" class="filter-selection" value="food">Food</button>
            <button id="fashion" class="filter-selection" value="fashion">Fashion</button>
            <button id="auto" class="filter-selection" value="auto">Auto</button>
            <button id="fun" class="filter-selection" value="fun">Fun</button>
            <button id="health" class="filter-selection" value="health">Health</button>
            <button id="all" class="filter-selection">All</button>
            <button id="dashboard-open-button" class="user-icon"><i class="fa fa-user" aria-hidden="true"></i></button>
        </div>
    </div>
    {{-- FOOD CONTAINER --}}
    <div id='food-container' class="container">
        <div class="container-left">
            <span class="category-heading">Cashback</span>

        </div>
        <div class="container-right">

            {{-- CARD BLOCK --}}
            <div class="cashback-display">
                <div class="card-cashback">
                    <div class="cashback-logo"><img
                            src="{{ asset('img/fashion/bed-bath-logo.png') }}"
                            alt="Bed Bath and Beyond Logo"></div>
                    <div class="cashback-discount">
                        <span>up to</span>
                        <h4>1.15%</h4>
                        <p>Cash Back Rewards</p>
                    </div>
                </div>
                <div class="card-cashback">
                    <div class="cashback-logo"><img
                            src="{{ asset('img/fashion/earthbound-logo.png') }}"
                            alt="Earthbound Logo"></div>
                    <div class="cashback-discount">
                        <span>up to</span>
                        <h4>2.3%</h4>
                        <p>Cash Back Rewards</p>
                    </div>
                </div>
                <div class="card-cashback">
                    <div class="cashback-logo"><img
                            src="{{ asset('img/fashion/pacsun-logo.png') }}" alt="PacSun Logo">
                    </div>
                    <div class="cashback-discount">
                        <h4>3.2%</h4>
                        <p>Cash Back Rewards</p>
                    </div>
                </div>
                <div class="card-cashback">
                    <div class="cashback-logo"><img src="{{ asset('img/fashion/puma-logo.png') }}"
                            alt="Puma Logo"></div>
                    <div class="cashback-discount">
                        <span>up to</span>
                        <h4>1.5%</h4>
                        <p>Cash Back Rewards</p>
                    </div>
                </div>
                <div class="card-cashback">
                    <div class="cashback-logo"><img
                            src="{{ asset('img/food/papa-johns-logo.png') }}"
                            alt="Papa Johns Logo"></div>
                    <div class="cashback-discount">
                        <span>up to</span>
                        <h4>1.75%</h4>
                        <p>Cash Back Rewards</p>
                    </div>
                </div>
                <div class="card-cashback">
                    <div class="cashback-logo"><img src="{{ asset('img/food/dominos-logo.png') }}"
                            alt="Dominos Logo"></div>
                    <div class="cashback-discount">
                        <h4>5%</h4>
                        <p>Cash Back Rewards</p>
                    </div>
                </div>
                <div class="card-cashback">
                    <div class="cashback-logo"><img
                            src="{{ asset('img/fun/busch-gardens-logo.png') }}"
                            alt="Busch Gardens Logo"></div>
                    <div class="cashback-discount">
                        <span>up to</span>
                        <h4>1.25%</h4>
                        <p>Cash Back Rewards</p>
                    </div>
                </div>
                <div class="card-cashback">
                    <div class="cashback-logo"><img src="{{ asset('img/fun/top-golf-logo.png') }}"
                            alt="Top Golf Logo"></div>
                    <div class="cashback-discount">
                        <h4>5%</h4>
                        <p>Cash Back Rewards</p>
                    </div>
                </div>
                <div class="card-cashback">
                    <div class="cashback-logo"><img
                            src="{{ asset('img/health/planet-fitness-logo.png') }}"
                            alt="Planet Fitness Logo"></div>
                    <div class="cashback-discount">
                        <span>up to</span>
                        <h4>2.2%</h4>
                        <p>Cash Back Rewards</p>
                    </div>
                </div>
                <div class="card-cashback">
                    <div class="cashback-logo"><img
                            src="{{ asset('img/tech/google-play-logo.png') }}"
                            alt="Google Play Logo"></div>
                    <div class="cashback-discount">
                        <span>up to</span>
                        <h4>1.25%</h4>
                        <p>Cash Back Rewards</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- FEATURED CONTAINER USING DEALS DATA --}}
    <div class="container">
        {{-- HIDDEN DASHBOARD --}}
        @include('includes._dashboard')
        <div class="container-left">
            <span class="category-heading">Featured</span>
            <a href={{ route('deals.featured') }} class="view-all-link">View All</a>
        </div>
        <div class="container-right">
            {{-- PAGE ARROWS --}}
            {{ $featuredDeals->appends(['Restaurant' => $foodDeals->currentPage()], ['Nail Salon' => $fashionDeals->currentPage()], ['Pizza' => $techDeals->currentPage()], ['popular' => $popularDeals->currentPage()])->links('vendor.pagination.custom-pagination') }}
            {{-- CARD BLOCK --}}
            <div class="card-display">
                @foreach($featuredDeals as $deal)
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
    {{-- FOOD CONTAINER --}}
    <div id='food-container' class="container">
        <div class="container-left">
            <span class="category-heading">Food</span>
            <a href={{ route('deals.food') }} class="view-all-link">View All</a>
        </div>
        <div class="container-right">
            {{-- PAGE ARROWS --}}
            {{ $foodDeals->appends(['featured' => $featuredDeals->currentPage()], ['Nail Salon' => $fashionDeals->currentPage()], ['Pizza' => $techDeals->currentPage()], ['popular' => $popularDeals->currentPage()])->links('vendor.pagination.custom-pagination') }}
            {{-- CARD BLOCK --}}
            <div class="card-display">
                @foreach($foodDeals as $deal)
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
    {{-- FASHION CONTAINER --}}
    <div id='fashion-container' class="container">
        <div class="container-left">
            <span class="category-heading">Fashion</span>
            <a href={{ route('deals.fashion') }} class="view-all-link">View All</a>
        </div>
        <div class="container-right">
            {{-- PAGE ARROWS --}}
            {{ $fashionDeals->appends(['featured' => $featuredDeals->currentPage()], ['Restaurant' => $foodDeals->currentPage()], ['Pizza' => $techDeals->currentPage()], ['popular' => $popularDeals->currentPage()])->links('vendor.pagination.custom-pagination') }}
            {{-- CARD BLOCK --}}
            <div class="card-display">
                @foreach($fashionDeals as $deal)
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
    {{-- TECH CONTAINER --}}
    <div class="container">
        <div class="container-left">
            <span class="category-heading">Tech</span>
            <a href={{ route('deals.tech') }} class="view-all-link">View All</a>
        </div>
        <div class="container-right">
            {{-- PAGE ARROWS --}}
            {{ $techDeals->appends(['featured' => $featuredDeals->currentPage()], ['Restaurant' => $foodDeals->currentPage()], ['Nail Salon' => $fashionDeals->currentPage()], ['popular' => $popularDeals->currentPage()])->links('vendor.pagination.custom-pagination') }}
            {{-- CARD BLOCK --}}
            <div class="card-display">
                @foreach($techDeals as $deal)
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
            {{-- PAGE ARROWS --}}
            {{ $popularDeals->appends(['featured' => $featuredDeals->currentPage()], ['Restaurant' => $foodDeals->currentPage()], ['Nail Salon' => $fashionDeals->currentPage()], ['Pizza' => $techDeals->currentPage()])->links('vendor.pagination.custom-pagination') }}
            {{-- CARD BLOCK --}}
            <div class="card-display">
                @foreach($popularDeals as $deal)
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
</main>
{{-- PAGE SPECIFIC SCRIPTS --}}
<script src="{{ asset('js/scrolling-banner.js') }}"></script>
<script src="{{ asset('js/change-category.js') }}"></script>
<script src="{{ asset('js/fading-ad.js') }}"></script>
<script src="{{ asset('js/show-dashboard.js') }}"></script>
@include('includes._footer')
