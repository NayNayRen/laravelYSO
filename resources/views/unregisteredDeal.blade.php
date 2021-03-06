@include('includes._header_alternate')
<main class="main">
    {{-- GUEST ERROR MESSAGE --}}
    @include('includes._guest_error_message')
    <div class="selected-deal-container">
        {{-- SELECTED DEAL USING DEALS DATA --}}
        <h3>You scored a deal.</h3>
        <img src="{{ $deal['picture_url'] }}" class='selected-deal-logo'
            alt="{{ $deal['name'] }}">
        <span class="selected-deal-discount">{{ $deal['location'] }}</span>
        <span id='card-name' class="selected-deal-name">{{ $deal['name'] }}</span>
        {{-- UNREGISTERED USER CONTENT --}}
        <div class="unregistered-user-display">
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
                <button id="unregistered-send-button" class="unregistered-send-button add-coupon">Send me the
                    deal</button>
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
                <button id="unregistered-favorite-deal-button " class="selected-deal-share-fav-button add-favourite"><i
                        class="fa fa-star-o" aria-hidden="true"></i>Favorite</button>
            </div>
        </div>
    </div>
</main>
{{-- PAGE SPECIFIC SCRIPTS --}}
<script src="{{ asset('js/unregistered-deal.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        const guestErrorMessage = document.querySelector('.guest-error-message');
        const guestErrorButton = document.querySelector('.guest-error-button');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // GUEST FAVORITE RESPONSE
        $('.add-favourite').click(function () {
            var id = $(this).attr('id');
            // alert(id);
            // console.log(id);
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
        // GUEST SHARE RESPONSE
        $('.share-deal').click(function () {
            guestErrorMessage.classList.add('show-selected-deal-message');
            guestErrorButton.addEventListener('click', () => {
                guestErrorMessage.classList.remove(
                    'show-selected-deal-message');
            });
        });
    });
    // GUEST COUPON RESPONSE
    $('.add-coupon').click(function () {
        var dealid = $('#deal-id').attr('value');
        var email = $('#registered-deal-email').attr('value');
        const guestErrorMessage = document.querySelector('.guest-error-message');
        const guestErrorButton = document.querySelector('.guest-error-button');
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
            success: function (data) {
                if (data['message']) {
                    var r = (data['message']);
                    guestErrorMessage.classList.add('show-selected-deal-message');
                    guestErrorButton.addEventListener('click', () => {
                        guestErrorMessage.classList.remove(
                            'show-selected-deal-message');
                    });
                    // alert(r);
                }
            }
        });
    });

</script>
@include('includes._footer')
