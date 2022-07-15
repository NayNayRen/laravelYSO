@include('includes._header')
<div class="main">
    <div class="banner">
        <div class="banner-slide-container">
            {{-- SLIDE 1 --}}
            <div class="banner-slide">
                <div class="banner-gradient"></div>
                <div class="banner-container-text">
                    <span class='banner-text-one'>free round</span>
                    <span class='banner-text-two'>for you & a guest after initial purchase.</span>
                    <a href="#" class="banner-redemption">Get Deal Now!</a>
                </div>
                <div class="banner-container-image banner-image-fun-1">
                </div>
                <img class="banner-logo" src="{{ asset('img/fun/congo-logo.png') }}"
                    alt="Congo River Company Logo">
            </div>
            {{-- SLIDE 2 --}}
            <div class="banner-slide even">
                <img class="banner-logo" src="{{ asset('img/fun/amc-logo2.png') }}"
                    alt="AMC Company Logo">
                <div class="banner-gradient"></div>
                <div class="banner-container-image banner-image-fun-2">
                </div>
                <div class="banner-container-text">
                    <span class='banner-text-one'>on demand</span>
                    <span class='banner-text-two'>with 20% lower rates.</span>
                    <a href="#" class="banner-redemption">Get Deal Now!</a>
                </div>
            </div>
            {{-- SLIDE 3 --}}
            <div class="banner-slide">
                <div class="banner-gradient"></div>
                <div class="banner-container-text">
                    <span class='banner-text-one'>lower</span>
                    <span class='banner-text-two'>rates with groups of 4 or more.</span>
                    <a href="#" class="banner-redemption">Get Deal Now!</a>
                </div>
                <div class="banner-container-image banner-image-fun-3">
                </div>
                <img class="banner-logo" src="{{ asset('img/fun/top-golf-banner-logo.png') }}"
                    alt="Top Golf Company Logo">
            </div>
            {{-- SLIDE 4 --}}
            <div class="banner-slide even">
                <img class="banner-logo" src="{{ asset('img/fun/adventure-island-logo2.png') }}"
                    alt="Adventure Island Company Logo">
                <div class="banner-gradient"></div>
                <div class="banner-container-image banner-image-fun-4">
                </div>
                <div class="banner-container-text">
                    <span class='banner-text-one'>free admission</span>
                    <span class='banner-text-two'>for florida residents.</span>
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
        <h1>All the fun & entertainment you need.</h1>
        <h3>For when life gets in the way.</h3>
    </div>
    <div class="container view-all">
        <div class="container-left">
            <span class="category-heading">Fun Deals</span>
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
                    @include('includes._card')
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.add-favourite').click(function () {
            var id = $(this).attr('id');
            console.log(id);
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
                        console.log(r);
                        alert(r);
                    }
                    if (data['delete']) {
                        var r = (data['delete']);
                        $('#' + parseInt(id)).removeClass('favourite')
                        console.log(r);
                        alert(r);
                    }
                    if (data['error']) {
                        var r = (data['error']);
                        console.log(r);
                        alert(r);
                    }

                }
            });
        });

    });

</script>
@include('includes._footer')
