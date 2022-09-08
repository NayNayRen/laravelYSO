{{-- UPDATE PASSWORD MESSAGE --}}
@if(session()->has('update-password-message'))
    <div class="update-password-message">
        <div>
            <img src="{{ asset('img/yso-logo2.svg') }}" class="yso-link"
                alt="Your Social Offers Logo">
        </div>
        <p>{{ session('update-password-message') }}</p>
        <span class="update-password-disclaimer">Note:<br>If this is the first time doing so, we recommend you
            log out
            and update
            your
            password.</span>
        <button type="button" class="message-button update-password-button">OK</button>
    </div>
@endif
