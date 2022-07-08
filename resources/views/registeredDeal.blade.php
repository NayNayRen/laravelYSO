@include('includes._header_alternate')
<main class="main">
    <div class="selected-deal-container">
        {{-- HIDDEN SHARE MESSAGE --}}
        @include('includes._share_message')
        {{-- SELECTED DEAL USING DEALS DATA --}}
        <h3>You scored a deal.</h3>
        <img src="{{ $deal['picture_url'] }}" class='selected-deal-logo'
            alt="{{ $deal['name'] }}">
        <span class="selected-deal-discount">{{ $deal['location'] }}</span>
        <span class="selected-deal-name">{{ $deal['name'] }}</span>
        {{-- REGISTERED USER CONTENT --}}
        <div class="registered-user-display">
            <div class="registered-share-fav-container">
                <button id='share-button' class="selected-deal-share-fav-button"><i class="fa fa-share"
                        aria-hidden="true"></i>Share</button>
                <button id='favorite-button' class="selected-deal-share-fav-button"><i class="fa fa-star-o"
                        aria-hidden="true"></i>Favorite</button>
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
                <span id="registered-deal-label">Send the coupon via:</span>
                <div class='registered-text-email-button-container'>
                    <button id="registered-text-button" class="selected-deal-text-email-button">Text</button>
                    <button id="registered-email-button" class="selected-deal-text-email-button">Email</button>
                </div>
                {{-- SEND METHOD BUTTON --}}
                <span class="registered-deal-response"></span>
                <input type="tel" id='registered-deal-phone' class="registered-send-method" value="{{ $user->phone }}"
                    pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"></input>
                <input type="email" id='registered-deal-email' class="registered-send-method"
                    value="{{ $user->email }}"></input>
                <span class="registered-text-redemption"></span>
                <span class="registered-email-redemption"></span>
                <button id="registered-send-button" class="registered-send-button">Send me the deal</button>
            </div>
        </div>
    </div>
</main>
{{-- PAGE SPECIFIC SCRIPTS --}}
<script src="{{ asset('js/registered-deal.js') }}"></script>
<script src="{{ asset('js/show-selected-deal-message.js') }}"></script>
@include('includes._footer')
