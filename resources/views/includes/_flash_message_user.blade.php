{{-- using alpine.js to remove the flash after 3 seconds --}}
@if(session()->has('flash-message-user'))
    {{-- <div x-data="{show: true}" x-init="setTimeout(() => show = false, 5000)" x-show="show"
        y-transition:leave.duration.400ms class="flash-message-user">
        <img src="{{ asset('img/yso-logo2.svg') }}" class="yso-link" alt="Your Social Offers Logo">
    <p>{{ session('flash-message-user') }}</p>
    </div> --}}
    <div class="flash-message-user">
        <div>
            <img src="{{ asset('img/yso-logo2.svg') }}" class="yso-link"
                alt="Your Social Offers Logo">
        </div>
        <p>{{ session('flash-message-user') }}</p>
    </div>

    <script>
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

    </script>
@endif
