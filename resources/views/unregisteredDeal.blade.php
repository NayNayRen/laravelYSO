@include('includes._header_alternate')
<main class="main">
    {{-- GUEST ERROR MESSAGE --}}
    @include('includes._guest_error_message')
    <div class="selected-deal-container">
        {{-- SELECTED DEAL USING DEALS DATA --}}
        <h3>You scored a deal.</h3>
        <img src="{{ $deal['picture_url'] }}" class='selected-deal-logo' alt="{{ $deal['name'] }}">
        <span class="selected-deal-discount">{{ $deal['location'] }}</span>
        <span id='card-name' class="selected-deal-name">{{ $deal['name'] }}</span>
        {{-- UNREGISTERED USER CONTENT --}}
        <div class="unregistered-user-display">

            <div class="unregistered-location-container">
                @php
                    $dealLocation = App\Models\CouponLocation::where('deal_id', $deal->id)->first();
                @endphp
                @if ($dealLocation === null)
                    - <span class="card-location inactive" aria-label="No location for this deal.">Location <i
                            class="fa fa-map-marker" aria-hidden="true"></i></span> -
                @elseif($deal->id != $dealLocation->deal_id)
                    - <span class="card-location inactive" aria-label="No location for this deal.">Location <i
                            class="fa fa-map-marker" aria-hidden="true"></i></span> -
                @else
                    @php
                        $locationAddress = App\Models\Location::where('id', $dealLocation->location_id)->first();
                    @endphp
                    @if ($locationAddress->lat === null)
                        - <span class="card-location inactive" aria-label="No location for this deal.">Location <i
                                class="fa fa-map-marker" aria-hidden="true"></i></span> -
                    @elseif($locationAddress->lon === null)
                        - <span class="card-location inactive" aria-label="No location for this deal.">Location <i
                                class="fa fa-map-marker" aria-hidden="true"></i></span> -
                    @else
                        <form action={{ route('locations.show', $dealLocation->location_id) }} method="GET">
                            <button type="submit" class="card-location active" title="{{ $locationAddress->location }}"
                                aria-label="View this deal's location." value="map" name="submit">- Location <i
                                    class=" fa fa-map-marker" aria-hidden="true"></i> -
                            </button>
                        </form>
                    @endif
                @endif
            </div>

            <p class="unregistered-user-heading">Let's get that coupon ready.</p>
            {{-- UNREGISTERED SEND METHOD --}}
            <div class="unregistered-text-email-container">
                <span id="unregistered-deal-label">Send the deal by:</span>
                <div class='unregistered-text-email-button-container'>
                    <button id="unregistered-text-button" class="selected-deal-text-email-button">Text</button>
                    <button id="unregistered-email-button" class="selected-deal-text-email-button">Email</button>
                </div>
                {{-- SEND METHOD BUTTON --}}
                <span class="unregistered-deal-response"></span>
                <input type="tel" id='unregistered-deal-phone' class="unregistered-send-method"
                    placeholder="123-456-7890" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"></input>
                <input type="email" id='unregistered-deal-email' class="unregistered-send-method"
                    placeholder="mail@mail.com"></input>
                <span class="unregistered-text-redemption"></span>
                <span class="unregistered-email-redemption"></span>
                <button id="unregistered-send-button" class="unregistered-send-button add-coupon">Send Me The
                    Deal</button>
            </div>
            <div class="unregistered-user-wallet-container">
                <div class="unregistered-user-wallet-buttons">
                    <img src="{{ asset('img/apple-wallet.png') }}" alt="Apple Wallet"> Add to Apple
                    Wallet
                </div>
                <div class="unregistered-user-wallet-buttons"><img src="{{ asset('img/google-wallet.png') }}"
                        alt="Google Wallet">Add to Google
                    Wallet</div>
            </div>
            {{-- DISCLAIMER --}}
            <div class="unregistered-disclaimer">
                <span>This is not the actual coupon. Your coupon will be sent to you at the location of your choice,
                    choose either text or email address below. Coupon may expire and can only be used once. You can
                    modify preferences after you log In to
                    YourSocialOffers.com</span>
                <span>No cash value. May be redeemed in person only.</span>
            </div>
            {{-- SHARE OR FAVORITE SELECTION --}}
            <div class="unregistered-share-fav-container">
                <button id="unregistered-share-deal-button" class="selected-deal-share-fav-button share-deal"><i
                        class="fa fa-share" aria-hidden="true"></i>Share</button>
                <button id="unregistered-favorite-deal-button " class="selected-deal-share-fav-button add-favorite"><i
                        class="fa fa-star" aria-hidden="true"></i>Favorite</button>
            </div>
        </div>
    </div>
</main>
{{-- PAGE SPECIFIC SCRIPTS --}}
<script src="{{ asset('js/unregistered-deal.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // GUEST FAVORITE RESPONSE
        $('.add-favorite').click(function() {
            var id = $(this).attr('id');
            // alert(id);
            // console.log(id);
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
        // GUEST SHARE RESPONSE
        $('.share-deal').click(function() {
            $('.guest-error-message').addClass('show-selected-deal-message');
            $('.guest-error-button').click(() => {
                $('.guest-error-message').removeClass(
                    'show-selected-deal-message');
            });
        });
        // GUEST COUPON RESPONSE
        $('.add-coupon').click(function() {
            var dealid = $('#deal-id').attr('value');
            var email = $('#registered-deal-email').attr('value');
            // console.log(dealid);
            $.ajax({
                url: "{{ route('add.coupon') }}",
                method: "POST",
                dataType: "json",

                data: {
                    _token: "{{ csrf_token() }}",
                    dealid: dealid,
                    email: email
                },
                success: function(data) {
                    if (data['message']) {
                        $('.guest-error-message').addClass('show-selected-deal-message');
                        $('.guest-error-button').click(() => {
                            $('.guest-error-message').removeClass(
                                'show-selected-deal-message');
                        });
                    }
                }
            });
        });
        // GOOGLE & APPLE WALLET BUTTONS RESPONSE
        $('.unregistered-user-wallet-buttons').click(function() {
            $('.guest-error-message').addClass('show-selected-deal-message');
            $('.guest-error-button').click(() => {
                $('.guest-error-message').removeClass(
                    'show-selected-deal-message');
            });
        });
    });
</script>
@include('includes._footer')
