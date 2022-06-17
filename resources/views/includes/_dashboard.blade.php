<div id='dashboard' class="dashboard">
    <div class="dashboard-content">
        <span id="dashboard-close-button" class="dashboard-close-button">Close
        </span>
        <span id="dashboard-user-preferences-button" class="dashboard-user-preferences-button"><i class="fa fa-bars"
                aria-hidden="true"></i>
        </span>
        @auth
            <div class="dashboard-user-container">
                <div>User Preferences</div>
                <div class="registered-user-profile">
                    <img src="{{ asset('img/male-profile.png') }}"
                        class="registered-user-profile-picture" alt="Profile Picture">
                </div>
                <div>Welcome {{ ucfirst(auth()->user()->firstName) }}</div>
            </div>
            <div class="dashboard-right-container">
                {{-- <span>Right Side Container</span> --}}
            </div>
        @else
            <div class="dashboard-user-container">
                <div>User Preferences</div>
                <div class="registered-user-profile">
                    <img src="{{ asset('img/male-profile.png') }}"
                        class="registered-user-profile-picture" alt="Profile Picture">
                </div>
                <div>Hello Guest</div>
            </div>
            <div class="dashboard-right-container">
                {{-- <span>Right Side Container</span> --}}
            </div>
        @endauth
    </div>
</div>
