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
    {{-- SEARCH CONTAINER --}}
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
        <h1>The choices you want.</h1>
        <h3>That's why you searched for them.</h3>
        <p>You searched for :
            @foreach($searchedWords as $searchedWord)
                <span>{{ $searchedWord }}</span>
            @endforeach
        </p>
    </div>
    {{-- IF SEARCH DOESN'T RETURN ANY RESULTS OR LEFT EMPTY --}}
    @if($searchedDeals === 0 || $searchedDeals->count() === 0)
        <div class="search-results-message-container">
            <h1>Your search didn't return any results.</h1>
            <p>Return back home to browse...</p>
            <span>or...</span>
            <p>Continue your search above.</p>
        </div>
        {{-- IF A SEARCH TERM WAS TYPED --}}
    @else
        <div class="container view-all">
            <div class="container-left">
                <span class="category-heading">Search Results</span>
                {{-- CUSTOM PAGE ARROWS --}}
                <div class="view-all-arrow-container">
                    {{ $searchedDeals
                    ->withQueryString()->links('vendor.pagination.custom-view-all-pagination') }}
                </div>
            </div>
            <div class="container-right">
                {{-- CARD BLOCK --}}
                <div class="card-display-view-all">
                    @foreach($searchedDeals as $deal)
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
{{-- PAGE SPECIFIC SCRIPTS --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{ asset('js/show-search-error.js') }}"></script>
<script src="{{ asset('js/scrolling-banner.js') }}"></script>
<script src="{{ asset('js/show-dashboard.js') }}"></script>
<script src="{{ asset('js/show-map.js') }}"></script>
<script>
    $(document).ready(function () {
        const favoriteAddedMessage = document.querySelector('.favorite-added-message');
        const favoriteRemovedMessage = document.querySelector('.favorite-removed-message');
        const guestErrorMessage = document.querySelector('.guest-error-message');
        const shareMessage = document.querySelector('.share-message');
        const favoriteAddedName = document.querySelector('#favorite-added-name');
        const favoriteRemovedName = document.querySelector('#favorite-removed-name');

        const favoriteAddedButton = document.querySelector('.favorite-added-button');
        const favoriteRemovedButton = document.querySelector('.favorite-removed-button');
        const guestErrorButton = document.querySelector('.guest-error-button');
        const shareMessageButton = document.querySelector('.share-message-button');

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
                        favoriteAddedName.innerText = name;
                        favoriteAddedMessage.classList.add('show-selected-deal-message');
                        favoriteAddedButton.addEventListener('click', () => {
                            favoriteAddedMessage.classList.remove(
                                'show-selected-deal-message');
                        });
                        // console.log(r);
                        // alert(r);
                    }
                    if (data['delete']) {
                        var r = (data['delete']);
                        $('#' + parseInt(id)).removeClass('favourite');
                        favoriteRemovedName.innerText = name;
                        favoriteRemovedMessage.classList.add('show-selected-deal-message');
                        favoriteRemovedButton.addEventListener('click', () => {
                            favoriteRemovedMessage.classList.remove(
                                'show-selected-deal-message');
                        });
                        // console.log(r);
                        // alert(r);
                    }
                    if (data['error']) {
                        var r = (data['error']);
                        guestErrorMessage.classList.add('show-selected-deal-message');
                        guestErrorButton.addEventListener('click', () => {
                            guestErrorMessage.classList.remove(
                                'show-selected-deal-message');
                        });
                        // console.log(r);
                        // alert(r);
                    }
                }
            });
        });
        // SHOWS APPROPRIATE SHARE RESPONSE
        $('.share-deal').click(function () {
            const name = $(this).attr('name');
            const sharedMessageName = document.querySelector('#shared-message-name');
            // console.log(name);
            if ($('.share-deal').hasClass('user')) {
                sharedMessageName.innerText = name;
                shareMessage.classList.add('show-selected-deal-message');
                shareMessageButton.addEventListener('click', () => {
                    shareMessage.classList.remove(
                        'show-selected-deal-message');
                });
            }
            if ($('.share-deal').hasClass('guest')) {
                guestErrorMessage.classList.add('show-selected-deal-message');
                guestErrorButton.addEventListener('click', () => {
                    guestErrorMessage.classList.remove(
                        'show-selected-deal-message');
                });
            }
        });
    });

</script>
@include('includes._footer')
