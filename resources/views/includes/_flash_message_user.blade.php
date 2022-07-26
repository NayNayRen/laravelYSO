{{-- using alpine.js to remove the flash after 3 seconds --}}
@if(session()->has('flash-message-user'))
    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 5000)" x-show="show"
        y-transition:leave.duration.400ms class="flash-message-user">
        <img src="{{ asset('img/yso-logo2.svg') }}" class="yso-link" alt="Your Social Offers Logo">
        <p>{{ session('flash-message-user') }}</p>
    </div>
@endif
