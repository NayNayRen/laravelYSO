<div id='dashboard' class="dashboard">
    <div class="dashboard-content">
        <span id="dashboard-close-button" class="dashboard-close-button">Close
        </span>
        <span id="dashboard-user-preferences-button" class="dashboard-user-preferences-button"
            aria-label="User details." title="User details."><i class="fa fa-ellipsis-h" aria-hidden="false"></i>
        </span>
        @auth
            <div class="dashboard-user-container">
                <span>User Preferences</span>
                <div class="registered-user-profile">
                    <img src="{{ asset('img/male-profile.png') }}"
                        class="registered-user-profile-picture" alt="Profile Picture">
                </div>
                <div>Logged in as:</div>
                <span>{{ ucfirst(auth()->user()->firstName) }}</span>
                <div>Location:</div>
                <span>{{ auth()->user()->email }}</span>
            </div>
            <div class="dashboard-right-container">
                <h4>My Coupons</h4>
                <h4>My Categories</h4>
            </div>
        @else
            <div class="dashboard-user-container">
                <span>User Preferences</span>
                <div class="registered-user-profile">
                    <img src="{{ asset('img/male-profile.png') }}"
                        class="registered-user-profile-picture" alt="Profile Picture">
                </div>
                <div>Logged in as:</div>
                <span>Guest</span>
                <div>Location:</div>
                <span>N/A</span>
            </div>
            <div class="dashboard-right-container">
                <h4>My Coupons</h4>
                <h4>My Categories</h4>
            </div>
        @endauth
    </div>
</div>
