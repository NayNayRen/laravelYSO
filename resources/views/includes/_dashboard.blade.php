<div id='dashboard' class="dashboard">
    <div class="dashboard-content">
        <span id="dashboard-close-button" class="dashboard-close-button">Close
        </span>
        <span id="dashboard-user-preferences-button" class="dashboard-user-preferences-button"
            aria-label="User details." title="User details."><i class="fa fa-ellipsis-h" aria-hidden="false"></i>
        </span>
        @auth
            <div class="dashboard-user-container">
                <div class="dashboard-user-container-sections">

                    <h3>User Preferences</h3>
                    <div class="registered-user-profile">
                        <img src="{{ asset('img/male-profile.png') }}"
                            class="registered-user-profile-picture" alt="Profile Picture">
                    </div>
                    <div>Logged in as:</div>
                    <span>{{ ucfirst(auth()->user()->firstName) }} {{ ucfirst(auth()->user()->lastName) }}</span>
                    <div>Location:</div>
                    <span>{{ auth()->user()->email }}</span>
                </div>
                <div class="dashboard-user-container-sections">
                    <img src="{{ asset('img/yso-logo2.svg') }}" class="yso-link"
                        alt="Your Social Offers Logo">
                </div>
            </div>
            <div class="dashboard-right-container">
                <ul class="c-list wrapper al-center">
                    <li class="c-list__item">
                        <a link="#fav1" class="c-list__link active">
                            <h4>Favorite Coupons</h4>
                            @if($favorites === null)
                                <div>0</div>
                            @else
                                <div>{{ $favorites->count() }}</div>
                            @endif
                        </a>
                    </li>
                    <li class="c-list__item">
                        <a link="#fav2" class="c-list__link">
                            <h4>All Coupons</h4>
                            @if($coupons === null)
                                <div>0</div>
                            @else
                                <div>{{ $coupons->count() }}</div>
                            @endif
                        </a>
                    </li>
                    <li class="c-list__item">
                        <a link="#fav3" class="c-list__link">
                            <h4>Redeemed Coupons</h4>
                            @if($redeems === null)
                                <div>0</div>
                            @else
                                <div>{{ $redeems->count() }}</div>
                            @endif
                        </a>
                    </li>
                </ul>
                <div class="favBox active" id="fav1">
                    {{-- USER FAVORITES --}}
                    @if($favorites != null && $favorites->count() > 0)
                        @if($favorites->count() < 3)
                            <div style="display: flex; padding-bottom: 10px;">
                                @foreach($favorites as $deal)
                                    <div class="card card--favorite">
                                        @include('includes._card')
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="card-display card-display--favorite owl-carousel owl-theme">
                                @foreach($favorites as $deal)
                                    <div class="card card--favorite">
                                        @include('includes._card')
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @else
                        <div class="dashboard-right-container">
                            <h4 class="mb-3">My Favorites</h4>
                            <h5 class="mb-3">No items in my Favorites list.</h5>
                        </div>
                    @endif
                </div>
                {{-- USER COUPONS --}}
                <div class="favBox" id="fav2">
                    @if($coupons != null && $coupons->count() > 0)
                        @if($coupons->count() < 3)
                            <div style="display: flex; padding-bottom: 10px;">
                                @foreach($coupons as $deal)
                                    <div class="card card--favorite">
                                        @include('includes._card')
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="card-display card-display--favorite owl-carousel owl-theme">
                                @foreach($coupons as $deal)
                                    <div class="card card--favorite">
                                        @include('includes._card')
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @else
                        <div class="dashboard-right-container">
                            <h4 class="mb-3">My Coupons</h4>
                            <h5 class="mb-3">No items in my Coupons list.</h5>
                        </div>
                    @endif
                </div>
                <div class="favBox" id="fav3">
                    {{-- USER REDEEMABLES --}}
                    @if($redeems != null &&  $redeems->count() > 0)
                        @if($redeems->count() < 3)
                            <div style="display: flex; padding-bottom: 10px;">
                                @foreach($redeems as $deal)
                                    <div class="card card--favorite">
                                        @include('includes._card')
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="card-display card-display--favorite owl-carousel owl-theme">
                                @foreach($redeems as $deal)
                                    <div class="card card--favorite">
                                        @include('includes._card')
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @else
                        <div class="dashboard-right-container">
                            <h4 class="mb-3">My Redeemed Coupons</h4>
                            <h5 class="mb-3">No items in my Redeemed list.</h5>
                        </div>
                    @endif
                </div>
            </div>
        @else
            <div class="dashboard-user-container">
                <div class="dashboard-user-container-sections">
                    <h3>User Preferences</h3>
                    <div class="registered-user-profile">
                        <img src="{{ asset('img/male-profile.png') }}"
                            class="registered-user-profile-picture" alt="Profile Picture">
                    </div>
                    <div>Logged in as:</div>
                    <span>Guest</span>
                    <div>Location:</div>
                    <span>N/A</span>
                </div>
                <div class="dashboard-user-container-sections">
                    <img src="{{ asset('img/yso-logo2.svg') }}" class="yso-link"
                        alt="Your Social Offers Logo">
                </div>
            </div>
            <div class="dashboard-right-container">
                <h4 class="mb-3">You're visiting as a guest.</h4>
                <h5 class="mb-3">Please head over to <a href={{ route('user.create') }}>Register</a>
                    and/or <a href={{ route('login.showLoginForm') }}>Log In</a> to continue.</h5>
            </div>
        @endauth
    </div>
</div>
