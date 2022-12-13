<div id='dashboard' class="dashboard">
    <div class="dashboard-content">
        <span id="dashboard-close-button" class="dashboard-close-button">Close
        </span>
        <span id="dashboard-user-preferences-button" class="dashboard-user-preferences-button" aria-label="User Details"
            title="User Details"><i class="fa fa-ellipsis-h" aria-hidden="false"></i>
        </span>
        @auth
            <div class="dashboard-user-container">
                <div class="dashboard-user-container-sections">

                    <h3>User Preferences</h3>
                    <div class="registered-user-profile">
                        <img src="{{ asset('img/male-profile.png') }}"
                            class="registered-user-profile-picture" alt="Profile Picture">
                    </div>
                    <div>
                        <span>- Logged In As -</span>
                        <span>{{ ucfirst(auth()->user()->firstName) }}
                            {{ ucfirst(auth()->user()->lastName) }}</span>
                    </div>
                    <div>
                        <span>- Email -</span>
                        <span>{{ auth()->user()->email }}</span>
                    </div>
                    <div>
                        <span>- Phone -</span>
                        <span>{{ auth()->user()->phone }}</span>
                    </div>
                    <form action={{ route('user.showUpdateForm', auth()->user()->id) }}
                        method="GET">
                        <button type="submit" class="dashboard-user-update-button" title="Update User Info"
                            aria-label="Update User Info"><i class=" fa fa-cog" aria-hidden="false"></i>
                        </button>
                    </form>
                    {{-- <span>Use the cog to update your details.</span> --}}
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
                            <h4>Favorites</h4>
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
                            <h4>Redeemed</h4>
                            @if($redeems === null)
                                <div>0</div>
                            @else
                                <div>{{ $redeems->count() }}</div>
                            @endif
                        </a>
                    </li>
                </ul>
                {{-- USER FAVORITES --}}
                <div class="favBox active" id="fav1">
                    @if($favorites != null && $favorites->count() > 0)
                        {{-- CARD BLOCK --}}
                        @if($favorites->count() === 1)
                            <div class="card-display-limited-amount">
                                @foreach($favorites as $deal)
                                    {{-- CARD COMPONENT --}}
                                    <div class="limited-amount-card limited-amount-card--favorite">
                                        @include('includes._alternate_card')
                                    </div>
                                @endforeach
                            </div>
                        @elseif($favorites->count() === 2)
                            <div class="card-display-limited-amount">
                                @foreach($favorites as $deal)
                                    {{-- CARD COMPONENT --}}
                                    <div class="limited-amount-card limited-amount-card--favorite">
                                        @include('includes._alternate_card')
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div
                                class="card-display-view-all card-display-view-all--favorite owl-carousel owl-theme dashboard-carousel">
                                @foreach($favorites as $deal)
                                    {{-- CARD COMPONENT --}}
                                    <div class="alternate-card alternate-card--favorite">
                                        @include('includes._alternate_card')
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
                        {{-- CARD BLOCK --}}
                        @if($coupons->count() === 1)
                            <div class="card-display-limited-amount">
                                @foreach($coupons as $deal)
                                    {{-- CARD COMPONENT --}}
                                    <div class="limited-amount-card limited-amount-card--favorite">
                                        @include('includes._alternate_card')
                                    </div>
                                @endforeach
                            </div>
                        @elseif($coupons->count() === 2)
                            <div class="card-display-limited-amount">
                                @foreach($coupons as $deal)
                                    {{-- CARD COMPONENT --}}
                                    <div class="limited-amount-card limited-amount-card--favorite">
                                        @include('includes._alternate_card')
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div
                                class="card-display-view-all card-display-view-all--favorite owl-carousel owl-theme dashboard-carousel">
                                @foreach($coupons as $deal)
                                    {{-- CARD COMPONENT --}}
                                    <div class="alternate-card alternate-card--favorite">
                                        @include('includes._alternate_card')
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
                {{-- USER REDEEMABLES --}}
                <div class="favBox" id="fav3">
                    @if($redeems != null &&  $redeems->count() > 0)
                        {{-- CARD BLOCK --}}
                        @if($redeems->count() === 1)
                            <div class="card-display-limited-amount">
                                @foreach($redeems as $deal)
                                    {{-- CARD COMPONENT --}}
                                    <div class="limited-amount-card limited-amount-card--favorite">
                                        @include('includes._alternate_card')
                                    </div>
                                @endforeach
                            </div>
                        @elseif($redeems->count() === 2)
                            <div class="card-display-limited-amount">
                                @foreach($redeems as $deal)
                                    {{-- CARD COMPONENT --}}
                                    <div class="limited-amount-card limited-amount-card--favorite">
                                        @include('includes._alternate_card')
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div
                                class="card-display-view-all card-display-view-all--favorite owl-carousel owl-theme dashboard-carousel">
                                @foreach($redeems as $deal)
                                    {{-- CARD COMPONENT --}}
                                    <div class="alternate-card alternate-card--favorite">
                                        @include('includes._alternate_card')
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
                    <div>
                        <span>- Logged In As -</span>
                        <span>Guest</span>
                    </div>
                    <div>
                        <span>- Email -</span>
                        <span>N/A</span>
                    </div>
                    <div>
                        <span>- Phone -</span>
                        <span>N/A</span>
                    </div>
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
