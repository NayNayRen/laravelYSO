@include('includes._header_alternate')
<div class="main">
    <div class="users">
        <h1>Update Details</h1>

        <span class="users-form-greeting grey-text">You can change or update any of your details. Supply your
            current password, or a new one, along with the password
            confirmation, then click
            Update to continue.</span>
        <p></p>
        <span class="users-form-greeting">Account Created : {{ auth()->user()->created_at }}</span><br>
        <span class="users-form-greeting">Last Updated : {{ auth()->user()->updated_at }}</span>
        {{-- REGISTER FORM --}}
        <form action={{ route('user.update', auth()->user()->id) }} method="POST">
            @csrf
            @method('PUT')
            <div class="users-name-register">
                {{-- FIRST NAME --}}
                <div class="users-form-group">
                    <label for="firstName">First Name</label><br>
                    <input type="text" name="firstName" id="firstName" value="{{ auth()->user()->firstName }}">
                    @error('firstName')
                        <span class="users-form-group-error">{{ $message }}</span>
                    @enderror
                </div>
                {{-- LAST NAME --}}
                <div class="users-form-group">
                    <label for="lastName">Last Name</label><br>
                    <input type="text" name="lastName" id="lastName" value="{{ auth()->user()->lastName }}">
                    @error('lastName')
                        <span class="users-form-group-error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            {{-- EMAIL --}}
            <div class="users-form-group">
                <label for="email">Email</label><br>
                <span class="dark-grey-text password-message">smith@mail.com</span>
                <input type="email" name="email" id="email" value="{{ auth()->user()->email }}">
                @error('email')
                    <span class="users-form-group-error">{{ $message }}</span>
                @enderror
            </div>
            {{-- PHONE NUMBER --}}
            <div class="users-form-group">
                <label for="phone">Mobile Phone</label><br>
                <span class="dark-grey-text password-message">123-456-7890</span>
                <input type="tel" name="phone" id="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
                    value="{{ auth()->user()->phone }}">
                @error('phone')
                    <span class="users-form-group-error">{{ $message }}</span>
                @enderror
            </div>
            <span class="users-form-greeting grey-text">If the password input below is left empty, your current password
                will
                be kept. However, if a new password is used, then you must also confirm that new password to update
                it.</span>
            <p></p>
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
            <input type="submit" class='users-buttons submit' value="Update">
        </form>
        {{-- DELETE FORM --}}
        <form action={{ route('user.delete', auth()->user()->id) }} method="POST">
            @csrf
            @method('DELETE')
            <div class="users-form-group">
                <div class="users-deletion-warning">
                    <h1>Delete Account</h1>
                    <div>
                        <span aria-label="Delete Account Warning">
                            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                        </span>
                        <span>DANGER</span>
                        <span aria-label="Delete Account Warning">
                            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div>
                        <span class="users-form-disclaimer grey-text">By continuing below, you will be deleting your
                            account. All user details will be removed.
                            To do
                            so, provide your current email as confirmation of intent, then click Delete.</span>
                    </div>
                </div>
                <label for="email">Delete Using Email</label><br>
                <input type="email" name="deletion_email">
                @error('deletion_email')
                    <span class="users-form-group-error">{{ $message }}</span>
                @enderror
            </div>
            {{-- DELETE BUTTON --}}
            <input type="submit" class='users-buttons submit' value="Delete">
        </form>
        <span class="users-form-disclaimer grey-text">By clicking Update or Delete to continue, you agree to our <a
                href="#">Terms
                and
                Conditions</a> and <a href="#">Privacy
                Statement</a>.</span>
    </div>
</div>
{{-- PAGE SPECIFIC SCRIPT --}}
<script src="{{ asset('js/show-signin-password.js') }}"></script>
<script src="{{ asset('js/register-password-length.js') }}"></script>
@include('includes._footer')
