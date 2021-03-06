@include('includes._header_alternate')
<div class="main">
    {{-- USER LOG IN OR OUT MESSAGE --}}
    @include('includes._flash_message_user')
    <div class="users">
        <h1>Create New Password</h1>
        {{-- SIGN IN FORM --}}
        <form action={{ route('login.savepasswrod') }} method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user_id }}">
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
            <button type="submit" class='verify_btn submit' value="Verify">Save</button>
        </form>
        {{-- DISCLAIMER --}}
        <span class="users-form-disclaimer gray-text">By clicking Verify, you agree to our
            <a href="#">Terms and Conditions</a> and <a href="#">Privacy
                Statement
            </a>
        </span>
    </div>
</div>

{{-- var id = $('#verify_by').val();
        var value = '';
        if(id=='email')
        {
            value = $('#email').val();
        }
        if(id=='phone')
        {
            value = $('#phone').val();
        }
        console.log(id);
        alert(value); --}}


{{-- PAGE SPECIFIC SCRIPT --}}
<script src="{{ asset('js/show-signin-password.js') }}"></script>
<script src="{{ asset('js/register-password-length.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@include('includes._footer')
