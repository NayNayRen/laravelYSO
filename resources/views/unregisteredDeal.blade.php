@include('includes._header_alternate')
<main class="main">
    <div class="selected-deal-container">
        {{-- SELECTED DEAL USING DEALS DATA --}}
        <h3>You scored a deal.</h3>
        <img src="{{ $deal['picture_url'] }}" class='selected-deal-logo'
            alt="{{ $deal['name'] }}">
        <span class="selected-deal-discount">{{ $deal['location'] }}</span>
        <span class="selected-deal-name">{{ $deal['name'] }}</span>
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
                <button id="unregistered-send-button" class="unregistered-send-button">Send me the deal</button>
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
                <button id="unregistered-share-deal-button" class="selected-deal-share-fav-button"><i
                        class="fa fa-share" aria-hidden="true"></i>Share</button>
                <button id="unregistered-favorite-deal-button" class="selected-deal-share-fav-button"><i
                        class="fa fa-star-o" aria-hidden="true"></i>Favorite</button>
            </div>
        </div>
    </div>
</main>
{{-- PAGE SPECIFIC SCRIPTS --}}
<script src="{{ asset('js/unregistered-deal.js') }}"></script>
@include('includes._footer')
