@include('includes._header_alternate')
<div class="main">
    {{-- OTP SENT MESSAGE --}}
    @include('includes._otp_message')
    {{-- USER LOG IN OR OUT MESSAGE --}}
    @include('includes._flash_message_user')
    <div class="users">
        <h1>Change Your Password</h1>
        <span class="users-form-greeting gray-text">Continue by using an email below.</span>
        <span class="users-form-greeting gray-text">Followed by entering the One Time Password.</span>
        <span class="users-form-greeting gray-text">You'll then create and confirm that new password.</span>
        {{-- SIGN IN FORM --}}
        {{-- HAD TO CHANGE FROM POST TO GET --}}
        {{-- <form action={{ route('login.showResetForm') }} method="POST"> --}}
        <form action={{ route('login.showResetForm') }} method="GET">
            @csrf
            {{-- EMAIL --}}
            <div class="users-form-group input-type-email">
                <label for="email">Email</label><br>
                <span class="gray-text password-message">smith@mail.com</span>
                <input type="email" name="email" id="email" value="{{ old('email') }}">
                @error('email')
                    <span class="users-form-group-error">{{ $message }}</span>
                @enderror
                <span class="input-error-forgot"></span>
            </div>
            {{-- OTP BUTTON --}}
            <input type="button" id="get_otp" class='users-buttons submit' value="Get OTP"></input>
            {{-- VARIFICATION CODE --}}
            <div class="users-form-group password-signin">
                <label for="verification_code">Verification Code</label>
                <input type="tel" name="verification_code" id="password" pattern="[0-9]{6}"
                    placeholder="Enter 6 Digit Code">
                @error('verification_code')
                    <span class="users-form-group-error">{{ $message }}</span>
                @enderror
            </div>
            {{-- CHANGE PASSWORD BUTTON --}}
            <input type="submit" class='users-buttons submit' value="Change Password"></input>
        </form>
        {{-- DISCLAIMER --}}
        <span class="users-form-disclaimer gray-text">By clicking Sign In, Continue with Facebook, Continue with Google,
            or Continue with Apple, you agree to our <a href="#">Terms and Conditions</a> and <a href="#">Privacy
                Statement</a>.</span>
    </div>
</div>
{{-- PAGE SPECIFIC SCRIPT --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // SHOW MESSAGES FOR OTP RESPONSE
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
                        $('.input-error-forgot').text('');
                        $('.users-form-group-error').css('display', 'none');
                        $('#get_otp').addClass('d-none');
                        $('.otp-method').text(r);
                        setTimeout(() => {
                            if ($(window).width() > 400) {
                                $('.otp-message').css('top', '150px');
                            }
                            if ($(window).width() <= 400) {
                                $('.otp-message').css('top', '0');
                            }
                            // after displaying for 7000ms(7s) message hides itself
                            setTimeout(() => {
                                $('.otp-message').css('top',
                                    '-100%');
                            }, 5000);
                        }, 50);
                    }
                    if (data['error']) {
                        var r = (data['error']);
                        // $('.otp-method').text(r);
                        $('.input-error-forgot').text(r);
                        $('.users-form-group-error').css('display', 'none');
                        // setTimeout(() => {
                        //     if ($(window).width() > 400) {
                        //         $('.otp-message').css('top', '150px');
                        //     }
                        //     if ($(window).width() <= 400) {
                        //         $('.otp-message').css('top', '0');
                        //     }
                        //     // after displaying for 5000ms(5s) message hides itself
                        //     setTimeout(() => {
                        //         $('.otp-message').css('top',
                        //             '-100%');
                        //     }, 5000);
                        // }, 50);
                    }
                }
            });
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
            // after displaying for 7000ms(7s) message hides itself
            setTimeout(() => {
                $('.flash-message-user').css('top', '-100%');
            }, 5000);
        }, 250);
    });

</script>
@include('includes._footer')
