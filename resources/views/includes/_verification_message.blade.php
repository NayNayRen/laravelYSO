{{-- FIRST TIME LOG IN VERIFICATION MESSAGE --}}
@if (session()->has('verification-message'))
    <div class="verification-message">
        <div>
            {{-- YSO LOGO --}}
            <img src="{{ asset('img/yso-logo2.svg') }}" class="yso-link" alt="Your Social Offers Logo">
        </div>
        {{-- VERIFICATION MESSAGE --}}
        <div>{!! session('verification-message') !!}</div>
        {{-- MEDIA USED AND PASSWORD DISCLAIMER --}}
        <span class="verification-disclaimer">- Note -<br>If you used a social media for first time sign up, you should
            use the same
            media once to sign in so you can update your passwor to something you know.</span>
        <button type="button" class="message-button verification-button">OK</button>
    </div>
@endif
