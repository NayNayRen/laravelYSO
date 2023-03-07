{{-- UPDATE PASSWORD AND LOGGED IN WITH SOCIAL MEDIA MESSAGE --}}
@if (session()->has('update-password-message'))
    <div class="update-password-message">
        <div>
            {{-- YSO LOGO --}}
            <img src="{{ asset('img/yso-logo2.svg') }}" class="yso-link" alt="Your Social Offers Logo">
        </div>
        {{-- MESSAGE AND SOCIAL MEDIA USED --}}
        <div>{!! session('update-password-message') !!}</div>
        <span class='update-password-media-icon' aria-label="Social Media Icon"><i class="fa fa-{{ session('mediaName') }}"
                aria-hidden="true"></i>
        </span>
        {{-- MEDIA USED AND PASSWORD DISCLAIMER --}}
        <span class="update-password-disclaimer">- Note -<br>If you would like to change your password, log out and do
            so. Or, use the gear icon in the Dashboard to update your details.
            Otherwise, continue using the same media to log in.</span>
        <button type="button" class="message-button update-password-button">OK</button>
    </div>
@endif
