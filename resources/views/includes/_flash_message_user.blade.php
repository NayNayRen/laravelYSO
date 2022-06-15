{{-- using alpine.js to remove the flash after 3 seconds --}}
@if(session()->has('flash-message-user'))
    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 5000)" x-show="show"
        x-transition:leave.duration.400ms class="flash-message-user">
        <p>{{ session('flash-message-user') }}</p>
    </div>
@endif
