@include('includes._header_alternate')
<div class="main">
    <div class="users">
        <h1>Sign Up</h1>
        <span class="users-form-greeting gray-text">Already have an account? <a
                href={{ route('login.showLoginForm') }}>Sign
                In</a></span>
        {{-- SOCIAL MEDIA SIGN INS --}}
        <div class="users-buttons-container">
            <a href="#" class="users-buttons facebook" aria-label="Continue with Facebook">
                <i class="fa fa-facebook-official" aria-hidden="true"></i>
                Continue with Facebook
            </a>
            <a href="#" class="users-buttons google" aria-label="Continue with Google">
                <i class="fa fa-google" aria-hidden="true"></i>
                Continue with Google
            </a>
            <a href="#" class="users-buttons apple" aria-label="Continue with Apple">
                <i class="fa fa-apple" aria-hidden="true"></i>
                Continue with Apple
            </a>
        </div>
        <span class="gray-text">Continue signing up using your email below.</span>
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
                <span class="gray-text password-message">smith@mail.com</span>
                <input type="email" name="email" id="email" value="{{ old('email') }}">
                @error('email')
                    <span class="users-form-group-error">{{ $message }}</span>
                @enderror
            </div>
            {{-- PHONE NUMBER --}}
            <div class="users-form-group">
                <label for="phone">Mobile Phone</label><br>
                <span class="gray-text password-message">123-456-7890</span>
                <input type="tel" name="phone" id="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
                    value="{{ old('phone') }}">
                @error('phone')
                    <span class="users-form-group-error">{{ $message }}</span>
                @enderror
            </div>
            {{-- INITIAL PASSWORD --}}
            <div class="users-form-group password-register">
                <label for="password">Password</label><br>
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
            <div class="users-form-group">
                <label for="password_confirmation">Confirm Password</label><br>
                <input type="password" name="password_confirmation" id="confirm-password">
                @error('password_confirmation')
                    <span class="users-form-group-error">{{ $message }}</span>
                @enderror
            </div>
            {{-- SUBMIT BUTTON --}}
            <input type="submit" class='users-buttons submit' value="Sign Up">
        </form>
        <span class="users-form-disclaimer gray-text">By clicking Sign In, Continue with Facebook, Continue with Google,
            or Continue with Apple, you agree to our <a href="#">Terms and Conditions</a> and <a href="#">Privacy
                Statement</a>.</span>
    </div>

</div>
{{-- PAGE SPECIFIC SCRIPT --}}
<script src="{{ asset('js/register-password-length.js') }}"></script>
@include('includes._footer')
