@include('includes._header_alternate')
<div class="main">
    {{-- USER LOG IN OR OUT MESSAGE --}}
    @include('includes._flash_message_user')
    <div class="users">
        <h1>Change Your Password</h1>
        <span class="users-form-greeting gray-text">Continue by using an email below.</span>
        <span class="users-form-greeting gray-text">Followed by entering the one time password.</span>
        {{-- SIGN IN FORM --}}
        <form action={{ route('login.resetpasswrod') }} method="POST">
            @csrf
            {{-- EMAIL --}}
            <div class="users-form-group input-type-email">
                <label for="email">Email</label><br>
                <span class="gray-text password-message">smith@mail.com</span>
                <input type="email" name="email" id="email" value="{{ old('email') }}">
                @error('email')
                    <span class="users-form-group-error">{{ $message }}</span>
                @enderror
            </div>
            {{-- OTP BUTTON --}}
            {{-- <div class="users-form-group">
                <a href="#" id="get_otp">
                    <div class="verify_btn">Get The OTP</div>
                </a>
            </div> --}}
            <input type="button" id="get_otp" class='users-buttons submit' value="Get OTP"></input>
            {{-- VARIFICATION CODE --}}
            <div class="users-form-group password-signin">
                <label for="verification_code">Verification Code</label>
                <input type="tel" name="verification_code" id="password" pattern="[0-9]{6}"
                    placeholder="Enter 6 digit code">
                {{-- SHOW/HIDE PASSWORD EYE --}}
                <i id="hide-password" class="fa fa-eye-slash" aria-hidden="true" onclick="hide()"></i>
                <i id="show-password" class="fa fa-eye" aria-hidden="true" onclick="show()"></i>
                @error('verification_code')
                    <span class="users-form-group-error">{{ $message }}</span>
                @enderror
            </div>
            {{-- CHANGE PASSWORD BUTTON --}}
            {{-- <button type="submit" class='verify_btn' value="Verify">Change</button> --}}
            <input type="submit" class='users-buttons submit' value="Change Password"></input>
        </form>
        {{-- DISCLAIMER --}}
        <span class="users-form-disclaimer gray-text">By clicking Sign In, Continue with Facebook, Continue with Google,
            or Continue with Apple, you agree to our <a href="#">Terms and Conditions</a> and <a href="#">Privacy
                Statement</a>.</span>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#verify_by').change(function () {
            var id = $(this).val();
            if (id == 'phone') {
                alert('phone');
                $('.input-type-phone').removeClass('d-none');
                if (!$('.input-type-email').hasClass('d-none')) {
                    $('.input-type-email').addClass('d-none');
                }
            }
            if (id == 'email') {
                alert('email')
                $('.input-type-email').removeClass('d-none');
                if (!$('.input-type-phone').hasClass('d-none')) {
                    $('.input-type-phone').addClass('d-none');
                }
            }
        });

        $('#get_otp').click(function () {
            var email = $('#email').val();
            $.ajax({
                url: "{{ route('send.reset_code') }}",
                method: "POST",
                dataType: "json",

                data: {
                    _token: "{{ csrf_token() }}",
                    status: status,
                    email: email,
                },
                success: function (data) {
                    if (data['success']) {
                        var r = (data['success']);
                        $('#get_otp').addClass('d-none');
                        console.log(r);
                        alert(r);
                    }
                    if (data['error']) {
                        var r = (data['error']);
                        console.log(r);
                        alert(r);
                    }
                }
            });
        });
    });

</script>
@include('includes._footer')
