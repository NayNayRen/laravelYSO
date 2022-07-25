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
        <p class="coupon-message-name">{{ $deal['name'] }}</p>
        <button type="button" class="message-button coupon-button">OK</button>
        <a href={{ route('deals.index') }}>Show me more deals</a>
    </div>
    <div class="selected-deal-container">
        {{-- SELECTED DEAL USING DEALS DATA --}}
        <h3>You scored a deal.</h3>
        <img src="{{ $deal['picture_url'] }}" class='selected-deal-logo'
            alt="{{ $deal['name'] }}">
        <span class="selected-deal-discount">{{ $deal['location'] }}</span>
        <span id='card-name' class="selected-deal-name">{{ $deal['name'] }}</span>
        {{-- REGISTERED USER CONTENT --}}
        <div class="registered-user-display">
            <div class="registered-share-fav-container">
                <button class="selected-deal-share-fav-button share-deal"
                    name="{{ $deal['name'] }}"><i class="fa fa-share"
                        aria-hidden="true"></i>Share</button>
                @php
                    $check = App\Models\Favourite::where('deal_id',(string)$deal['id'])->get()->first();
                @endphp
                @if($check != null)
                    {{-- id="registered-favorite-deal-button" --}}
                    <button class="selected-deal-share-fav-button add-favourite"
                        id="{{ $deal['id'] }}"
                        name="{{ $deal['name'] }}"><i class="fa fa-star favourite2"
                            aria-hidden="true"></i>Favorite</button>
                @else
                    {{-- id="registered-favorite-deal-button" --}}
                    <button class="selected-deal-share-fav-button add-favourite"
                        id="{{ $deal['id'] }}"
                        name="{{ $deal['name'] }}"><i class="fa fa-star"
                            aria-hidden="true"></i>Favorite</button>
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
                @csrf--}}
                <span id="registered-deal-label">Send the coupon via:</span>
                <div class='registered-text-email-button-container'>
                    <button id="registered-text-button" class="selected-deal-text-email-button">Text</button>
                    <button id="registered-email-button" class="selected-deal-text-email-button">Email</button>
                </div>
                {{-- SEND METHOD BUTTON --}}
                <span class="registered-deal-response"></span>
                <input type='hidden' value="{{ (string)$deal['id'] }}" id="deal-id">
                <input type="tel" id='registered-deal-phone' class="registered-send-method" value="{{ $user->phone }}"
                    pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"></input>
                <input type="email" id='registered-deal-email' class="registered-send-method"
                    value="{{ $user->email }}"></input>
                <span class="registered-text-redemption"></span>
                <span class="registered-email-redemption"></span>
                <button id="registered-send-button" class="registered-send-button add-coupon">Send me the deal</button>
            </div>
            {{-- </form> --}}
        </div>
    </div>
</main>
{{-- PAGE SPECIFIC SCRIPTS --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{ asset('js/registered-deal.js') }}"></script>
<script>
    $(document).ready(function () {
        const favoriteAddedMessage = document.querySelector('.favorite-added-message');
        const favoriteRemovedMessage = document.querySelector('.favorite-removed-message');
        const shareMessage = document.querySelector('.share-message');
        const favoriteAddedName = document.querySelector('#favorite-added-name');
        const favoriteRemovedName = document.querySelector('#favorite-removed-name');

        const favoriteAddedButton = document.querySelector('.favorite-added-button');
        const favoriteRemovedButton = document.querySelector('.favorite-removed-button');
        const shareMessageButton = document.querySelector('.share-message-button');

        var old_email = '{{ $user->email }}';
        var old_phone = '{{ $user->phone }}';

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#registered-text-button ').click(function () {
            $('#registered-deal-email').attr('value', " ");
        });

        $('#registered-email-button ').click(function () {
            $('#registered-deal-phone').attr('value', " ");
        });

        $('.registered-text-redemption ').click(function () {
            $('#registered-deal-phone').attr('value', old_phone);
            $('#registered-deal-email').attr('value', " ");
        });

        $('.registered-email-redemption ').click(function () {
            $('#registered-deal-phone').attr('value', " ");
            $('#registered-deal-email').attr('value', old_email);
        });
        // USER FAVORITE RESPONSE
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
                        $('#' + parseInt(id)).find('i').addClass('favourite2');
                        favoriteAddedName.innerText = name;
                        favoriteAddedMessage.classList.add('show-selected-deal-message');
                        favoriteAddedButton.addEventListener('click', () => {
                            favoriteAddedMessage.classList.remove(
                                'show-selected-deal-message');
                            // location.reload();
                        });
                        // console.log(r);
                        // alert(r);
                    }
                    if (data['delete']) {
                        var r = (data['delete']);
                        $('#' + parseInt(id)).find('i').removeClass('favourite2');
                        favoriteRemovedName.innerText = name;
                        favoriteRemovedMessage.classList.add('show-selected-deal-message');
                        favoriteRemovedButton.addEventListener('click', () => {
                            favoriteRemovedMessage.classList.remove(
                                'show-selected-deal-message');
                            // location.reload();
                        });
                        // console.log(r);
                        // alert(r);
                    }
                }
            });
        });
        // SHOWS USER SHARE RESPONSE
        $('.share-deal').click(function () {
            const name = $(this).attr('name');
            const sharedMessageName = document.querySelector('#shared-message-name');
            // console.log(name);
            sharedMessageName.innerText = name;
            shareMessage.classList.add('show-selected-deal-message');
            shareMessageButton.addEventListener('click', () => {
                shareMessage.classList.remove(
                    'show-selected-deal-message');
            });
        });
    });
    // USER COUPON ADDED RESPONSE
    $('.add-coupon').click(function () {
        var dealid = $('#deal-id').attr('value');
        var email = $('#registered-deal-email').attr('value');
        var phone = $('#registered-deal-phone').attr('value');
        const couponMessage = document.querySelector('.coupon-message');
        const couponHeading = document.querySelector('.coupon-heading');
        const couponButton = document.querySelector('.coupon-button');
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
            success: function (data) {
                if (data['emailed-already']) {
                    var r = (data['message']);
                    couponMessage.classList.add('show-selected-deal-message');
                    couponHeading.innerText = 'Coupon Already Emailed.';
                    couponButton.addEventListener('click', () => {
                        couponMessage.classList.remove('show-selected-deal-message');
                    });
                    // alert(r);
                }
                if (data['emailed']) {
                    couponMessage.classList.add('show-selected-deal-message');
                    couponHeading.innerText = 'Coupon Successfully Emailed!';
                    couponButton.addEventListener('click', () => {
                        couponMessage.classList.remove('show-selected-deal-message');
                    });
                }
                if (data['texted-already']) {
                    couponMessage.classList.add('show-selected-deal-message');
                    couponHeading.innerText = 'Coupon Already Texted.';
                    couponButton.addEventListener('click', () => {
                        couponMessage.classList.remove('show-selected-deal-message');
                    });
                }
                if (data['texted']) {
                    couponMessage.classList.add('show-selected-deal-message');
                    couponHeading.innerText = 'Coupon Successfully Texted!';
                    couponButton.addEventListener('click', () => {
                        couponMessage.classList.remove('show-selected-deal-message');
                    });
                }
            }
        });
    });

</script>

@include('includes._footer')
