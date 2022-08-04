@include('includes._header_alternate')
<div class="main">
    {{-- USER LOG IN OR OUT MESSAGE --}}
    @include('includes._flash_message_user')
    <div class="users">
        <h1>Create New Password</h1>
        <span class="users-form-greeting gray-text">Continue by creating a new password below.</span>
        <span class="users-form-greeting gray-text">Followed by confirming that new password.</span>
        <span class="users-form-greeting gray-text">You'll then be redirected to log in.</span>
        {{-- SAVE PASSWORD FORM --}}
        <form action={{ route('login.savePassword') }} method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user_id }}">
            {{-- INITIAL PASSWORD --}}
            <div class="users-form-group password-register">
                <label for="password">New Password</label><br>
                <span class="gray-text password-message">At least 8 characters long.</span>
                <input type="password" name="password" id="password">
                <div class="password-length-icon">
                    <span class="password-length-incorrect-icon">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </span>
                </div>
                @error('password')
                    <span class="users-form-group-error">{{ $message }}</span>
                @enderror
            </div>
            {{-- CONFIRM PASSWORD --}}
            <div class="users-form-group password-signin">
                <label for="password_confirmation">Confirm Password</label><br>
                <input type="password" name="password_confirmation" id="confirm-password">
                {{-- SHOW/HIDE PASSWORD EYE --}}
                <i id="hide-password" class="fa fa-eye-slash" aria-hidden="false" aria-label="Show Password."
                    onclick="hideConfirm()"></i>
                <i id="show-password" class="fa fa-eye" aria-hidden="false" aria-label="Hide Password."
                    onclick="showConfirm()"></i>
                @error('password_confirmation')
                    <span class="users-form-group-error">{{ $message }}</span>
                @enderror
            </div>
            {{-- UPDATE PASSWORD BUTTON --}}
            <input type="submit" class='users-buttons submit' value="Update Password"></input>
        </form>
        {{-- DISCLAIMER --}}
        <span class="users-form-disclaimer gray-text">By clicking Sign In, Continue with Facebook, Continue with Google,
            or Continue with Apple, you agree to our <a href="#">Terms and Conditions</a> and <a href="#">Privacy
                Statement</a>.</span>
    </div>
</div>
{{-- PAGE SPECIFIC SCRIPT --}}
<script src="{{ asset('js/show-signin-password.js') }}"></script>
<script src="{{ asset('js/register-password-length.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(document).ready(() => {
        // console.log('loaded');
        // FLASH MESSAGE DISPLAY WITH TIMER TO REMOVE
        // waits for 250ms then shows message
        setTimeout(() => {
            if ($(window).width() > 400) {
                $('.flash-message-user').css('top', '150px');
            }
            if ($(window).width() <= 400) {
                $('.flash-message-user').css('top', '0');
            }
            // after displaying for 7000ms(7s) message hides itself
            setTimeout(() => {
                $('.flash-message-user').css('top', '-100%');
            }, 5000);
        }, 250);
    })

</script>
@include('includes._footer')
