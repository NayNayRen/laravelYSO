{{-- UPDATE PASSWORD MESSAGE --}}
@if(session()->has('update-password-message'))
    <div class="update-password-message">
        <div>
            <img src="{{ asset('img/yso-logo2.svg') }}" class="yso-link"
                alt="Your Social Offers Logo">
        </div>
        <p>{{ session('update-password-message') }}</p>
        <span class='update-password-media-icon' aria-label="Social Media Icon"><i
                class="fa fa-{{ session('mediaName') }}" aria-hidden="true"></i>
        </span>
        <span class="update-password-disclaimer">- Note -<br>If you would like to change your password, log out and do
            so.
            Otherwise, continue using the same media to log in.</span>
        <button type="button" class="message-button update-password-button">OK</button>
    </div>
@endif
