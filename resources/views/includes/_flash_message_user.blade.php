{{-- FLASH MESSAGE ON A SET TIMEOUT TO AUTO HIDE --}}
@if(session()->has('flash-message-user'))
    <div class="flash-message-user">
        <div>
            <img src="{{ asset('img/yso-logo2.svg') }}" class="yso-link"
                alt="Your Social Offers Logo">
        </div>
        <p>{{ session('flash-message-user') }}</p>
    </div>
@endif
