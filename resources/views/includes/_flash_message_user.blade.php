{{-- FLASH MESSAGE ON A SET TIMEOUT TO AUTO HIDE --}}
{{-- USED FOR LOG IN, UPDATE, LOG OUT, AND USER REMOVAL --}}
@if (session()->has('flash-message-user'))
    <div class="flash-message-user">
        <div>
            {{-- YSO LOGO --}}
            <img src="{{ asset('img/yso-logo2.svg') }}" class="yso-link" alt="Your Social Offers Logo">
        </div>
        <div>{!! session('flash-message-user') !!}</div>
    </div>
@endif
