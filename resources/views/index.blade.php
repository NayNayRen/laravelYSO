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
            <form action={{ route('deals.search') }} class="search-form" name="searchForm"
                method="GET">
                <input type="text" name="search" id="search-field" class="search-field"
                    placeholder="Search by type, city, or zip...">
                <button type="submit" id="search-button" class="search-button"><i class="fa fa-search"
                        aria-hidden="true"></i></button>
                <button type="button" id="map-button" class="search-button"><i class="fa fa-map-marker"
                        aria-hidden="true"></i></button>
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
                    <input type='button' class="filter-selection all-button" value="all">
                    </input>
                    <span class="all-button-arrow">
                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                    </span>
                    <ul class="filter-selection-dropdown">
                        @foreach($categories as $category)
                            <li>{{ $category }}</li>
                        @endforeach
                        {{-- <li>Category 1</li>
                        <li>Category 2</li>
                        <li>Category 3</li>
                        <li>Category 4</li>
                        <li>Category 5</li>
                        <li>Category 6</li>
                        <li>Category 7</li>
                        <li>Category 8</li>
                        <li>Category 9</li> --}}
                    </ul>
                </div>
                <span id="dashboard-open-button" class="user-icon"><i class="fa fa-user" aria-hidden="true"></i></span>
            </form>
        </div>
    </div>
    {{-- CASHBACK CONTAINER --}}
    <div class="container">
        {{-- HIDDEN DASHBOARD --}}
        @include('includes._dashboard')
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
                    <div class="cashback-card" onclick="showMessage(this)">
                        <div class="cashback-logo"><img
                                src="{{ asset('img/fashion/bed-bath-logo.png') }}"
                                alt="Bed Bath and Beyond Logo"></div>
                        <div class="cashback-discount">
                            <h4>2.3%</h4>
                            <p>Cash Back Rewards</p>
                        </div>
                    </div>
                    <div class="cashback-card" onclick="showMessage(this)">
                        <div class="cashback-logo"><img
                                src="{{ asset('img/tech/office-depot-logo.png') }}"
                                alt="Office Depot Logo"></div>
                        <div class="cashback-discount">
                            <h4><span>up to</span>3.5%</h4>
                            <p>Cash Back Rewards</p>
                        </div>
                    </div>
                    <div class="cashback-card" onclick="showMessage(this)">
                        <div class="cashback-logo"><img
                                src="{{ asset('img/fashion/finish-line-logo.png') }}"
                                alt="Finish Line Logo">
                        </div>
                        <div class="cashback-discount">
                            <h4>2.9%</h4>
                            <p>Cash Back Rewards</p>
                        </div>
                    </div>
                    <div class="cashback-card" onclick="showMessage(this)">
                        <div class="cashback-logo"><img
                                src="{{ asset('img/fashion/journeys-logo.png') }}"
                                alt="Journeys Logo"></div>
                        <div class="cashback-discount">
                            <h4><span>up to</span>3.5%</h4>
                            <p>Cash Back Rewards</p>
                        </div>
                    </div>
                    <div class="cashback-card" onclick="showMessage(this)">
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
            {{-- PAGE ARROWS --}}
            {{ $featuredDeals->appends(['featured' => $featuredDeals->currentPage(),$categoryHeading => $categoryDeals->currentPage(), 'tech' => $techDeals->currentPage(), 'popular' => $popularDeals->currentPage()])->links('vendor.pagination.custom-pagination') }}
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
    {{-- SELECTED CATEGORY CONTAINER --}}
    <div id='food-container' class="container">
        <div class="container-left">
            <span class="category-heading">{{ $categoryHeading }}</span>
            {{-- <a href={{ route('deals.' . $categoryHeading) }}
            class="view-all-link">View
            All</a> --}}
            <a href={{ route('deals.food') }} class="view-all-link">View
                All</a>
        </div>
        <div class="container-right">
            {{-- PAGE ARROWS --}}
            {{ $categoryDeals->appends([$categoryHeading => $categoryDeals->currentPage(), 'featured' => $featuredDeals->currentPage(), 'tech' => $techDeals->currentPage(), 'popular' => $popularDeals->currentPage()])->links('vendor.pagination.custom-pagination') }}
            {{-- CARD BLOCK --}}
            <div class="card-display">
                @foreach($categoryDeals as $deal)
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
            {{ $techDeals->appends(['tech' => $techDeals->currentPage(), 'featured' => $featuredDeals->currentPage(), $categoryHeading => $categoryDeals->currentPage(), 'popular' => $popularDeals->currentPage()])->links('vendor.pagination.custom-pagination') }}
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
            {{ $popularDeals->appends(['popular' => $popularDeals->currentPage(),'featured' => $featuredDeals->currentPage(), $categoryHeading => $categoryDeals->currentPage(), 'tech' => $techDeals->currentPage()])->links('vendor.pagination.custom-pagination') }}
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
<script src="{{ asset('js/show-all-category.js') }}"></script>
<script src="{{ asset('js/fading-ad.js') }}"></script>
<script src="{{ asset('js/show-dashboard.js') }}"></script>
<script src="{{ asset('js/show-cashback-message.js') }}"></script>
@include('includes._footer')
