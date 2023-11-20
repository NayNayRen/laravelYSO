@include('includes._header_alternate')
<div class="main">
    {{-- USER LOG IN ERROR MESSAGE --}}
    @include('includes._flash_message_user')
    {{-- VERIFICATION MESSAGE --}}
    @include('includes._verification_message')
    <div class="users">
        <h1>Sign In</h1>
        <span class="users-form-greeting grey-text">New to YSO? <a href={{ route('user.create') }}>Sign Up</a></span>
        {{-- SOCIAL MEDIA SIGN INS --}}
        <div class="users-buttons-container">
            <a href="/auth/facebook/redirect" class="users-buttons facebook" aria-label="Continue with Facebook">
                <i class="fa fa-facebook-official" aria-hidden="true"></i>
                Continue with Facebook
            </a>
            <a href="/auth/google/redirect" class="users-buttons google" aria-label="Continue with Google">
                <i class="fa fa-google" aria-hidden="true"></i>
                Continue with Google
            </a>
            <div class="users-buttons apple" aria-label="Continue with Apple">
                <i class="fa fa-apple" aria-hidden="true"></i>
                Continue with Apple
            </div>
        </div>
        <span class="grey-text">Continue signing in using your email below.</span>
        {{-- SIGN IN FORM --}}
        <form action={{ route('login') }} method="POST">
            @csrf
            {{-- EMAIL --}}
            <div class="users-form-group">
                <label for="email">Email</label><br>
                <input type="email" name="email" id="email" value="{{ old('email') }}">
                @error('email')
                    <span class="users-form-group-error">{{ $message }}</span>
                @enderror
            </div>
            {{-- PASSWORD --}}
            <div class="users-form-group password-signin">
                <label for="password">Password</label>
                <a href="{{ route('login.showForgotForm') }}"><span
                        class="dark-grey-text password-message forgot-password-link">Forgot your
                        password?</span></a>
                <input type="password" name="password" id="password">
                {{-- SHOW/HIDE PASSWORD EYE --}}
                <i id="hide-password" class="fa fa-eye-slash" aria-hidden="false" aria-label="Show Password."
                    onclick="hideLogin()"></i>
                <i id="show-password" class="fa fa-eye" aria-hidden="false" aria-label="Hide Password."
                    onclick="showLogin()"></i>
                @error('password')
                    <span class="users-form-group-error">{{ $message }}</span>
                @enderror
            </div>
            {{-- SUBMIT BUTTON --}}
            <input type="submit" class='users-buttons submit' value="Sign In">
        </form>
        {{-- DISCLAIMER --}}
        <span class="users-form-disclaimer grey-text">By clicking Sign In, Continue with Facebook, Continue with Google,
            or Continue with Apple, you agree to our <a href="#">Terms and Conditions</a> and <a
                href="#">Privacy
                Statement</a>.</span>
    </div>

</div>
{{-- PAGE SPECIFIC SCRIPT --}}
<script src="{{ asset('js/show-signin-password.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(document).ready(() => {
        // VERIFICATION MESSAGE AFTER FIRST TIME SIGN UP
        if ($(window).width() > 400) {
            $('.verification-message').css('top', '150px');
        }
        if ($(window).width() <= 400) {
            $('.verification-message').css('top', '0');
        }
        $('.verification-button').click(() => {
            $('.verification-message').css('top', '-100%');
        });
        // FLASH MESSAGE DISPLAY WITH TIMER TO REMOVE
        // waits for 250ms then shows message
        setTimeout(() => {
            if ($(window).width() > 400) {
                $('.flash-message-user').css('top', '150px');
            }
            if ($(window).width() <= 400) {
                $('.flash-message-user').css('top', '0');
            }
            // after displaying for 5000ms(5s) message hides itself
            setTimeout(() => {
                $('.flash-message-user').css('top', '-100%');
            }, 5000);
        }, 250);
    })
</script>
@include('includes._footer')
