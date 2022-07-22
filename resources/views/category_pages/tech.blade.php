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
                    <span class='banner-text-one'>early deal</span>
                    <span class='banner-text-two'>notices when you join our mailing list.</span>
                    <a href="#" class="banner-redemption">Get Deal Now!</a>
                </div>
                <div class="banner-container-image banner-image-tech-1">
                </div>
                <img class="banner-logo"
                    src="{{ asset('img/tech/micro-center-banner-logo.png') }}"
                    alt="Micro Center Company Logo">
            </div>
            {{-- SLIDE 2 --}}
            <div class="banner-slide even">
                <img class="banner-logo" src="{{ asset('img/tech/newegg-logo2.png') }}"
                    alt="Newegg Company Logo">
                <div class="banner-gradient"></div>
                <div class="banner-container-image banner-image-tech-2">
                </div>
                <div class="banner-container-text">
                    <span class='banner-text-one'>free shipping!!!</span>
                    <span class='banner-text-two'>on orders of $75 or more.</span>
                    <a href="#" class="banner-redemption">Get Deal Now!</a>
                </div>
            </div>
            {{-- SLIDE 3 --}}
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
                    alt="Best Buy Company Logo">
            </div>
            {{-- SLIDE 4 --}}
            <div class="banner-slide even">
                <img class="banner-logo" src="{{ asset('img/tech/apple-store-logo2.png') }}"
                    alt="Apple Store Company Logo">
                <div class="banner-gradient"></div>
                <div class="banner-container-image banner-image-tech-4">
                </div>
                <div class="banner-container-text">
                    <span class='banner-text-one'>discounted</span>
                    <span class='banner-text-two'>rates with in store repairs.</span>
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
        <h1>Looking for Tech deals?</h1>
        <h3>We've got just the selection.</h3>
    </div>
    <div class="container view-all">
        <div class="container-left">
            <span class="category-heading">Tech Deals</span>
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
                    <div class="card">
                        @include('includes._card')
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
{{-- PAGE SPECIFIC SCRIPTS --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
