@include('includes._header_alternate')
<div class="main">
    {{-- OTP SENT MESSAGE --}}
    @include('includes._otp_message')
    {{-- USER LOG IN OR OUT MESSAGE --}}
    @include('includes._flash_message_user')
    <div class="users">
        <h1>Verify Your Account</h1>
        <span class="users-form-greeting gray-text">Continue signing in by choosing a verification method.</span>
        <span class="users-form-greeting gray-text">Followed by entering the One Time Password.</span>
        {{-- VERIFICATION FORM --}}
        <form action={{ route('login.verifyUser', $user->id) }} method="POST">
            @csrf
            {{-- EMAIL AND PHONE SELECTION --}}
            <div class="users-form-group">
                <label for="verify_by" class="verify_by">Verification Method</label><br>

                <select name="verify_by" id="verify_by" class="auth-select">
                    <option selected disabled>Select one to get the code</option>
                    <option value="{{ $user->email }}">{{ $user->email ?? email }}</option>
                    <option value="{{ $user->phone }}">{{ $user->phone ?? phone }}</option>
                </select>

                {{-- <div class="verification-list-container">
                    <input type="button" name="verify_by" id="verify_by" value="Select A Method To Verify By">
                    </input>
                    <span class="verify-button-arrow">
                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                    </span>
                    <ul class="verification-dropdown">
                        <li class="verification-selection" value="{{ $user->email }}">
                {{ $user->email ?? email }}</li>
                <li class="verification-selection" value="{{ $user->phone }}">
                    {{ $user->phone ?? phone }}</li>
                </ul>
            </div> --}}

            <span class="users-form-group-error"></span>
    </div>
    {{-- OTP BUTTON --}}
    <input type="button" id="get_otp" class='users-buttons submit' value="Get OTP"></input>
    {{-- VALIDATION CODE --}}
    <div class="users-form-group password-signin">
        <label for="verification_code">Verification Code</label>
        <input type="tel" name="verification_code" id="password" pattern="[0-9]{6}" placeholder="Enter 6 Digit Code">
    </div>
    {{-- SUBMIT BUTTON --}}
    <input type="submit" class='users-buttons submit' value="Verify User"></input>
    </form>
    {{-- DISCLAIMER --}}
    <span class="users-form-disclaimer gray-text">By clicking Sign In, Continue with Facebook, Continue with Google,
        or Continue with Apple, you agree to our <a href="#">Terms and Conditions</a> and <a href="#">Privacy
            Statement</a>.</span>
</div>
</div>
{{-- PAGE SPECIFIC SCRIPT --}}
<script src="{{ asset('js/show-verify-dropdown.js') }}"></script>
<script src="{{ asset('js/show-signin-password.js') }}"></script>
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
            var id = $('#verify_by').val();
            var userid = '{{ $user->id }}';
            $.ajax({
                url: "{{ route('send.code') }}",
                method: "POST",
                dataType: "json",

                data: {
                    _token: "{{ csrf_token() }}",
                    status: status,
                    id: id,
                    userid: userid
                },
                success: function (data) {
                    if (data['success']) {
                        var r = (data['success']);
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
