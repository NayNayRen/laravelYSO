@include('includes._header_alternate')
<div class="main">
    <div class="users">
        <h1>Sign Up</h1>
        <span class="users-form-greeting grey-text">Already have an account? <a
                href={{ route('login.showLoginForm') }}>Sign
                In</a></span>
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
        <span class="grey-text">Continue signing up using your email below.</span>
        {{-- REGISTER FORM --}}
        <form action={{ route('user.store') }} method="POST">
            @csrf
            <div class="users-name-register">
                {{-- FIRST NAME --}}
                <div class="users-form-group">
                    <label for="firstName">First Name</label><br>
                    <input type="text" name="firstName" id="firstName" value="{{ old('firstName') }}">
                    @error('firstName')
                        <span class="users-form-group-error">{{ $message }}</span>
                    @enderror
                </div>
                {{-- LAST NAME --}}
                <div class="users-form-group">
                    <label for="lastName">Last Name</label><br>
                    <input type="text" name="lastName" id="lastName" value="{{ old('lastName') }}">
                    @error('lastName')
                        <span class="users-form-group-error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            {{-- EMAIL --}}
            <div class="users-form-group">
                <label for="email">Email</label><br>
                <span class="dark-grey-text password-message">smith@mail.com</span>
                <input type="email" name="email" id="email" value="{{ old('email') }}">
                @error('email')
                    <span class="users-form-group-error">{{ $message }}</span>
                @enderror
            </div>
            {{-- PHONE NUMBER --}}
            <div class="users-form-group">
                <label for="phone">Mobile Phone</label><br>
                <span class="dark-grey-text password-message">123-456-7890</span>
                <input type="tel" name="phone" id="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
                    value="{{ old('phone') }}">
                @error('phone')
                    <span class="users-form-group-error">{{ $message }}</span>
                @enderror
            </div>
            {{-- INITIAL PASSWORD --}}
            <div class="users-form-group password-register">
                <label for="password">Password</label><br>
                <span class="dark-grey-text password-message">At Least 8 Characters Long</span>
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
                <input type="password" name="password_confirmation" id="register-password">
                {{-- SHOW/HIDE PASSWORD EYE --}}
                <i id="hide-password" class="fa fa-eye-slash" aria-hidden="false" aria-label="Show Password."
                    onclick="hideRegister()"></i>
                <i id="show-password" class="fa fa-eye" aria-hidden="false" aria-label="Hide Password."
                    onclick="showRegister()"></i>
                @error('password_confirmation')
                    <span class="users-form-group-error">{{ $message }}</span>
                @enderror
            </div>
            {{-- SUBMIT BUTTON --}}
            <input type="submit" class='users-buttons submit' value="Sign Up">
        </form>
        <span class="users-form-disclaimer grey-text">By clicking Sign In, Continue with Facebook, Continue with Google,
            or Continue with Apple, you agree to our <a href="#">Terms and Conditions</a> and <a
                href="#">Privacy
                Statement</a>.</span>
    </div>

</div>
{{-- PAGE SPECIFIC SCRIPT --}}
<script src="{{ asset('js/show-signin-password.js') }}"></script>
<script src="{{ asset('js/register-password-length.js') }}"></script>
@include('includes._footer')
