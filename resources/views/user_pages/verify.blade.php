@include('includes._header_alternate')
<div class="main">
    {{-- USER LOG IN OR OUT MESSAGE --}}
    @include('includes._flash_message_user')
    <div class="users">
        <h1>Verify Your Account</h1>
        <span class="users-form-greeting gray-text">Continue signing in by choosing a varification method.</span>
        <span class="users-form-greeting gray-text">Followed by entering the one time password.</span>
        {{-- VERIFICATION FORM --}}
        <form action={{ route('login.VerifyForm',$user->id  ) }} method="POST">
            @csrf
            {{-- EMAIL AND PHONE SELECTION --}}
            <div class="users-form-group">
                <label for="verify_by" class="verify_by">Varification Method</label><br>
                <select name="verify_by" id="verify_by" class="auth-select">
                    <option selected disabled>Select one to get the code</option>
                    <option value="{{ $user->email }}">{{ $user->email ?? email }} </option>
                    <option value="{{ $user->phone }}">{{ $user->phone ?? phone }}</option>
                </select>
                @error('verify_by')
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
            {{-- VALIDATION CODE --}}
            <div class="users-form-group password-signin">
                <label for="verification_code">Verification code</label>
                <input type="tel" name="verification_code" id="password" pattern="[0-9]{6}"
                    placeholder="Enter 6 digit Code">
                {{-- SHOW/HIDE PASSWORD EYE --}}
                <i id="hide-password" class="fa fa-eye-slash" aria-hidden="true" onclick="hide()"></i>
                <i id="show-password" class="fa fa-eye" aria-hidden="true" onclick="show()"></i>
                @error('verification_code')
                    <span class="users-form-group-error">{{ $message }}</span>
                @enderror
            </div>
            {{-- SUBMIT BUTTON --}}
            {{-- <button type="submit" class='verify_btn submit' value="Verify">Verify</button> --}}
            <input type="submit" class='users-buttons submit' value="Verify User"></input>
        </form>
        {{-- DISCLAIMER --}}
        <span class="users-form-disclaimer gray-text">By clicking Sign In, Continue with Facebook, Continue with Google,
            or Continue with Apple, you agree to our <a href="#">Terms and Conditions</a> and <a href="#">Privacy
                Statement</a>.</span>
    </div>
</div>
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

        $('#get_otp').click(function () {
            var id = $('#verify_by').val();
            var userid = '{{ $user->id }}';
            console.log(id);
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
