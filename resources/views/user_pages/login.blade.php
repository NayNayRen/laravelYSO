@include('includes._header_alternate')
<div class="main">
    {{-- USER LOG IN OR OUT MESSAGE --}}
    @include('includes._flash_message_user')
    <div class="users">
        <h1>Sign In</h1>
        <span class="users-form-greeting gray-text">New to YSO? <a
                href={{ route('user.create') }}>Sign Up</a></span>
        {{-- SOCIAL MEDIA SIGN INS --}}
        <div class="users-buttons-container">
            <a href="#" class="users-buttons facebook">
                <i class="fa fa-facebook-official" aria-hidden="true"></i>
                Continue with Facebook
            </a>
            <a href="#" class="users-buttons google">
                <i class="fa fa-google" aria-hidden="true"></i>
                Continue with Google
            </a>
            <a href="#" class="users-buttons apple">
                <i class="fa fa-apple" aria-hidden="true"></i>
                Continue with Apple
            </a>
        </div>
        <span class="gray-text">Continue signing in using email bellow.</span>
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
                <label for="password">Password</label><span class="gray-text password-message">Forgot your
                    password?</span>
                <input type="password" name="password" id="password">
                {{-- SHOW/HIDE PASSWORD EYE --}}
                <i id="hide-password" class="fa fa-eye-slash" aria-hidden="true" onclick="hide()"></i>
                <i id="show-password" class="fa fa-eye" aria-hidden="true" onclick="show()"></i>
                @error('password')
                    <span class="users-form-group-error">{{ $message }}</span>
                @enderror
            </div>
            {{-- SUBMIT BUTTON --}}
            <input type="submit" class='users-buttons submit' value="Sign In">
        </form>
        {{-- DISCLAIMER --}}
        <span class="users-form-disclaimer gray-text">By clicking Sign In, Continue with Facebook, Continue with Google,
            or Continue with Apple, you agree to our <a href="#">Terms and Conditions</a> and <a href="#">Privacy
                Statement</a>.</span>
    </div>

</div>
{{-- PAGE SPECIFIC SCRIPT --}}
<script src="{{ asset('js/show-signin-password.js') }}"></script>
@include('includes._footer')
