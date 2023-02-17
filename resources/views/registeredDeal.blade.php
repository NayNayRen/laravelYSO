@include('includes._header_alternate')
<main class="main">
    {{-- HIDDEN SHARE MESSAGE --}}
    @include('includes._share_message')
    {{-- HIDDEN FAVORITED ADDED MESSAGE --}}
    @include('includes._favorite_added_message')
    {{-- HIDDEN FAVORITED REMOVED MESSAGE --}}
    @include('includes._favorite_removed_message')
    {{-- COUPON MESSAGE --}}
    <div class="coupon-message">
        <h2 class="coupon-heading"></h2>
        <p class="coupon-message-method"></p>
        <p class="coupon-message-name">{{ $deal['name'] }}</p>
        <button type="button" class="message-button coupon-button">OK</button>
        <a href={{ route('deals.index') }}>Show Me More Deals</a>
    </div>
    <div class="selected-deal-container">
        {{-- SELECTED DEAL USING DEALS DATA --}}
        <h3>You scored a deal.</h3>
        <img src="{{ $deal['picture_url'] }}" class='selected-deal-logo' alt="{{ $deal['name'] }}">
        <span class="selected-deal-discount">{{ $deal['location'] }}</span>
        <span id='card-name' class="selected-deal-name">{{ $deal['name'] }}</span>
        {{-- REGISTERED USER CONTENT --}}
        <div class="registered-user-display">

            <div class="registered-location-container">
                @php
                    $dealLocation = App\Models\CouponLocation::where('cid', $deal->id)->first();
                @endphp
                @if ($dealLocation === null)
                    - <span class="card-location inactive" aria-label="No location for this deal.">Location <i
                            class="fa fa-map-marker" aria-hidden="true"></i></span> -
                @elseif($deal->id != $dealLocation->cid)
                    - <span class="card-location inactive" aria-label="No location for this deal.">Location <i
                            class="fa fa-map-marker" aria-hidden="true"></i></span> -
                @else
                    @php
                        $locationAddress = App\Models\Location::where('id', $dealLocation->lid)->first();
                    @endphp
                    @if ($locationAddress->lat === null)
                        - <span class="card-location inactive" aria-label="No location for this deal.">Location <i
                                class="fa fa-map-marker" aria-hidden="true"></i></span> -
                    @elseif($locationAddress->lon === null)
                        - <span class="card-location inactive" aria-label="No location for this deal.">Location <i
                                class="fa fa-map-marker" aria-hidden="true"></i></span> -
                    @else
                        <form action={{ route('locations.show', $dealLocation->lid) }} method="GET">
                            <button type="submit" class="card-location active" title="{{ $locationAddress->location }}"
                                aria-label="View this deal's location." value="map" name="submit">- Location <i
                                    class=" fa fa-map-marker" aria-hidden="true"></i> -
                            </button>
                        </form>
                    @endif
                @endif
            </div>

            <div class="registered-share-fav-container">
                <button class="selected-deal-share-fav-button share-deal" name="{{ $deal['name'] }}"><i
                        class="fa fa-share" aria-hidden="true"></i>Share</button>
                @php
                    $check = App\Models\Favorite::where('deal_id', (string) $deal['id'])
                        ->get()
                        ->first();
                @endphp
                @if ($check != null)
                    <button class="selected-deal-share-fav-button add-favorite" id="{{ $deal['id'] }}"
                        name="{{ $deal['name'] }}"><i class="fa fa-star favorite2"
                            aria-hidden="true"></i>Favorite</button>
                @else
                    <button class="selected-deal-share-fav-button add-favorite" id="{{ $deal['id'] }}"
                        name="{{ $deal['name'] }}"><i class="fa fa-star" aria-hidden="true"></i>Favorite</button>
                @endif
            </div>
            {{-- DISCLAIMER --}}
            <div class="registered-disclaimer">
                <span>This is not the actual coupon. Your coupon will be sent to you at the location of your choice,
                    choose either text or email address below. Coupon may expire and can only be used once. You can
                    modify preferences after you log In to
                    YourSocialOffers.com</span>
                <span>No cash value. May be redeemed in person only.</span>
            </div>
            {{-- REGISTERED USER INFO --}}
            <p class="registered-user-heading">We'll send the deal information to:</p>
            <div class="registered-user-profile">
                <img src="{{ asset('img/male-profile.png') }}" id="registered-user-profile-picture"
                    class="registered-user-profile-picture" alt="Profile Picture">
                <span id="registered-user-profile-name">{{ ucfirst($user->firstName) }}
                    {{ ucfirst($user->lastName) }}</span>
                <span id="not-registered-user"><a href={{ route('user.create') }}>Not
                        {{ ucfirst($user->firstName) }}?</a></span>
            </div>
            {{-- REGISTERED SEND METHOD --}}
            <div class="registered-text-email-container">
                {{-- <form action="{{ route('add.coupon') }}" method="POST">
                @csrf --}}
                <span id="registered-deal-label">Send the coupon via:</span>
                <div class='registered-text-email-button-container'>
                    <button id="registered-text-button" class="selected-deal-text-email-button">Text</button>
                    <button id="registered-email-button" class="selected-deal-text-email-button">Email</button>
                </div>
                {{-- SEND METHOD BUTTON --}}
                <span class="registered-deal-response"></span>
                <input type='hidden' value="{{ (string) $deal['id'] }}" id="deal-id">
                <input type="tel" id='registered-deal-phone' class="registered-send-method"
                    value="{{ $user->phone }}" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"></input>
                <input type="email" id='registered-deal-email' class="registered-send-method"
                    value="{{ $user->email }}"></input>
                <span class="registered-text-redemption"></span>
                <span class="registered-email-redemption"></span>
                <button id="registered-send-button" class="registered-send-button add-coupon">Send Me The Deal</button>
            </div>
            {{-- </form> --}}
            <div class="registered-user-wallet-container">
                <a href="#" class="registered-user-wallet-buttons">
                    <img src="{{ asset('img/apple-wallet.png') }}" alt="Apple Wallet"> Add to Apple
                    Wallet</a>
                <a href="#" class="registered-user-wallet-buttons"><img
                        src="{{ asset('img/google-wallet.png') }}" alt="Google Wallet">Add to Google
                    Wallet</a>
            </div>
        </div>
    </div>
</main>
{{-- PAGE SPECIFIC SCRIPTS --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{ asset('js/registered-deal.js') }}"></script>
<script>
    $(document).ready(function() {
        var old_email = '{{ $user->email }}';
        var old_phone = '{{ $user->phone }}';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#registered-text-button ').click(function() {
            $('#registered-deal-email').attr('value', " ");
        });

        $('#registered-email-button ').click(function() {
            $('#registered-deal-phone').attr('value', " ");
        });

        $('.registered-text-redemption ').click(function() {
            $('#registered-deal-phone').attr('value', old_phone);
            $('#registered-deal-email').attr('value', " ");
        });

        $('.registered-email-redemption ').click(function() {
            $('#registered-deal-phone').attr('value', " ");
            $('#registered-deal-email').attr('value', old_email);
        });
        // USER FAVORITE RESPONSE
        $('.add-favorite').click(function() {
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
                        $('#' + parseInt(id)).find('i').addClass('favorite2');
                        $('#favorite-added-name').text(name);
                        $('.favorite-added-message').addClass('show-selected-deal-message');
                        $('.favorite-added-button').click(() => {
                            $('.favorite-added-message').removeClass(
                                'show-selected-deal-message');
                            // location.reload();
                        });
                    }
                    if (data['delete']) {
                        $('#' + parseInt(id)).find('i').removeClass('favorite2');
                        $('#favorite-removed-name').text(name);
                        $('.favorite-removed-message').addClass(
                            'show-selected-deal-message');
                        $('.favorite-removed-button').click(() => {
                            $('.favorite-removed-message').removeClass(
                                'show-selected-deal-message');
                            // location.reload();
                        });
                    }
                }
            });
        });
        // SHOWS USER SHARE RESPONSE
        $('.share-deal').click(function() {
            const name = $(this).attr('name');
            $('#shared-message-name').text(name);
            $('.share-message').addClass('show-selected-deal-message');
            $('.share-message-button').click(() => {
                $('.share-message').removeClass(
                    'show-selected-deal-message');
            });
        });
        // USER COUPON ADDED RESPONSE
        $('.add-coupon').click(() => {
            var dealid = $('#deal-id').attr('value');
            var email = $('#registered-deal-email').attr('value');
            var phone = $('#registered-deal-phone').attr('value');
            // console.log(dealid);
            $.ajax({
                url: "{{ route('add.coupon') }}",
                method: "POST",
                dataType: "json",

                data: {
                    _token: "{{ csrf_token() }}",
                    dealid: dealid,
                    email: email,
                    phone: phone
                },
                success: function(data) {
                    if (data['emailed-already']) {
                        $('.coupon-message').addClass('show-selected-deal-message');
                        $('.coupon-heading').text('Coupon Already Emailed To');
                        $('.coupon-message-method').text(email);
                        $('.coupon-button').click(() => {
                            $('.coupon-message').removeClass(
                                'show-selected-deal-message');
                        });
                    }
                    if (data['emailed']) {
                        $('.coupon-message').addClass('show-selected-deal-message');
                        $('.coupon-heading').text('Coupon Successfully Emailed To');
                        $('.coupon-message-method').text(email);
                        $('.coupon-button').click(() => {
                            $('.coupon-message').removeClass(
                                'show-selected-deal-message');
                        });
                    }
                    if (data['texted-already']) {
                        $('.coupon-message').addClass('show-selected-deal-message');
                        $('.coupon-heading').text('Coupon Already Texted To');
                        $('.coupon-message-method').text(phone);
                        $('.coupon-button').click(() => {
                            $('.coupon-message').removeClass(
                                'show-selected-deal-message');
                        });
                    }
                    if (data['texted']) {
                        $('.coupon-message').addClass('show-selected-deal-message');
                        $('.coupon-heading').text('Coupon Successfully Texted To');
                        $('.coupon-message-method').text(phone);
                        $('.coupon-button').click(() => {
                            $('.coupon-message').removeClass(
                                'show-selected-deal-message');
                        });
                    }
                }
            });
        });
    });
</script>

@include('includes._footer')
