{{-- HIDDEN GUEST ERROR MESSAGE --}}
<div class="guest-error-message">
    <div class="guest-error-content">
        <h2>You're Visiting As A Guest</h2>
        <div>
            <span>Kindly</span>
            <a href={{ route('user.create') }}>Register</a>
            <span>and/or</span>
            <a href={{ route('login.showLoginForm') }}>Log In</a>
            <span>to continue.</span>
        </div>
        <button type="button" class="message-button guest-error-button">OK</button>
    </div>
</div>
