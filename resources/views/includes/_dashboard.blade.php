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
                <ul class="c-list wrapper al-center">
                    <li class="c-list__item">
                        <a link="#fav1" class="c-list__link active">
                            <h4>Favorite Coupons</h4>
                        </a>
                    </li>
                    <li class="c-list__item">
                        <a link="#fav2" class="c-list__link">
                            <h4>All Coupons</h4>
                        </a>
                    </li>
                    <li class="c-list__item">
                        <a link="#fav3" class="c-list__link">
                            <h4>Redeemed Coupons</h4>
                        </a>
                    </li>
                </ul>
                <div class="favBox active" id="fav1">
                    <!-- Favourite Coupons -->
                    @if($deals!=null && $deals->count() > 0)
                        @if($deals->count() < 3)
                            <div style="display: flex;">
                                @foreach($deals as $deal)
                                    <div class="card card--favourite">
                                        <div>
                                            <div class="card-logo-container">
                                                <img src="{{ $deal->picture_url }}" class="card-logo"
                                                    alt="{{ $deal->name }}">
                                            </div>
                                            <span class="card-discount">{{ $deal->location }}</span><br>
                                            <span class="card-name">{{ $deal->name }}</span><br>
                                        </div>
                                        <div>
                                            <div class="views-likes-container">
                                                <div>
                                                    <span>Views: {{ $deal->views }}</span><br>
                                                    <span>Likes:</span>
                                                </div>
                                                <div class="views-likes-icons">
                                                    <i class="fa fa-share" aria-hidden="true"></i>
                                                    <i class="fa fa-star add-favourite favourite" id="{{ $deal->id }}"
                                                        aria-hidden="true"></i>

                                                    <!-- <i class="fa fa-star" aria-hidden="true"></i> -->
                                                </div>
                                            </div>
                                            <a href="/deals/{{ $deal->id }}">
                                                <div class="get-deal-button">Get Deal Now!</div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="card-display card-display--favourite owl-carousel owl-theme">
                                @foreach($deals as $deal)
                                    <div class="card card--favourite">
                                        <div>
                                            <div class="card-logo-container">
                                                <img src="{{ $deal->picture_url }}" class="card-logo"
                                                    alt="{{ $deal->name }}">
                                            </div>
                                            <span class="card-discount">{{ $deal->location }}</span><br>
                                            <span class="card-name">{{ $deal->name }}</span><br>
                                        </div>
                                        <div>
                                            <div class="views-likes-container">
                                                <div>
                                                    <span>Views: {{ $deal->views }}</span><br>
                                                    <span>Likes:</span>
                                                </div>
                                                <div class="views-likes-icons">
                                                    <i class="fa fa-share" aria-hidden="true"></i>
                                                    <i class="fa fa-star add-favourite favourite" id="{{ $deal->id }}"
                                                        aria-hidden="true"></i>

                                                    <!-- <i class="fa fa-star" aria-hidden="true"></i> -->
                                                </div>
                                            </div>
                                            <a href="/deals/{{ $deal->id }}">
                                                <div class="get-deal-button">Get Deal Now!</div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @else
                        <div class="dashboard-right-container">
                            <h4 class="mb-3">Favorites</h4>
                            <h5 class="mb-3">No items in your Favorites list.</h5>
                        </div>
                    @endif
                </div>

                <div class="favBox" id="fav2">
                    @if( $coupons!=null && $coupons->count() > 0)
                        @if($coupons->count() < 3)
                            <div style="display: flex; column-gap: 20px;">
                                @foreach($coupons as $coupon)
                                    <div class="card card--favourite">
                                        <div>
                                            <div class="card-logo-container">
                                                <img src="{{ $coupon->picture_url }}" class="card-logo"
                                                    alt="{{ $coupon->name }}">
                                            </div>
                                            <span class="card-discount">{{ $coupon->location }}</span><br>
                                            <span class="card-name">{{ $coupon->name }}</span><br>
                                        </div>
                                        <div>
                                            <div class="views-likes-container">
                                                <div>
                                                    <span>Views: {{ $coupon->views }}</span><br>
                                                    <span>Likes:</span>
                                                </div>
                                                <div class="views-likes-icons">
                                                    <i class="fa fa-share" aria-hidden="true"></i>
                                                    @php
                                                        if(auth()->user())
                                                        {
                                                        $check =
                                                        App\Models\Favourite::where('deal_id',$coupon->id)->where('user_id',auth()->user()->id)->first();
                                                        }
                                                        else
                                                        {
                                                        $check = null;
                                                        }
                                                    @endphp
                                                    @if($check !=null)
                                                        <i class="fa fa-star add-favourite favourite"
                                                            id="{{ $coupon->id }}" aria-hidden="true"></i>
                                                    @else
                                                        <i class="fa fa-star add-favourite" id="{{ $coupon->id }}"
                                                            aria-hidden="true"></i>
                                                    @endif
                                                </div>
                                            </div>
                                            <a href="/deals/{{ $coupon->id }}">
                                                <div class="get-deal-button">Get Deal Now!</div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="card-display card-display--favourite owl-carousel owl-theme">
                                @foreach($coupons as $coupon)
                                    <div class="card card--favourite">
                                        <div>
                                            <div class="card-logo-container">
                                                <img src="{{ $coupon->picture_url }}" class="card-logo"
                                                    alt="{{ $coupon->name }}">
                                            </div>
                                            <span class="card-discount">{{ $coupon->location }}</span><br>
                                            <span class="card-name">{{ $coupon->name }}</span><br>
                                        </div>
                                        <div>
                                            <div class="views-likes-container">
                                                <div>
                                                    <span>Views: {{ $coupon->views }}</span><br>
                                                    <span>Likes:</span>
                                                </div>
                                                <div class="views-likes-icons">
                                                    <i class="fa fa-share" aria-hidden="true"></i>
                                                    @php
                                                        if(auth()->user())
                                                        {
                                                        $check =
                                                        App\Models\Favourite::where('deal_id',$coupon->id)->where('user_id',auth()->user()->id)->first();
                                                        }
                                                        else
                                                        {
                                                        $check = null;
                                                        }
                                                    @endphp
                                                    @if($check !=null)
                                                        <i class="fa fa-star add-favourite favourite"
                                                            id="{{ $coupon->id }}" aria-hidden="true"></i>
                                                    @else
                                                        <i class="fa fa-star add-favourite" id="{{ $coupon->id }}"
                                                            aria-hidden="true"></i>
                                                    @endif
                                                </div>
                                            </div>
                                            <a href="/deals/{{ $coupon->id }}">
                                                <div class="get-deal-button">Get Deal Now!</div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                    @else
                        <div class="dashboard-right-container">
                            <h4 class="mb-3">All Coupons</h4>
                            <h5 class="mb-3">No items in your Coupons list.</h5>
                        </div>
                    @endif
                </div>
                <div class="favBox" id="fav3">
                    <!-- user Coupons -->

                    <!-- <h4>Redeems Coupons </h4> -->
                    @if( $redeems!=null &&  $redeems->count() > 0)
                        @if($redeems->count() < 3)
                            <div style="display: flex;">
                                @foreach($redeems as $redeem)
                                    <div class="card card--favourite">
                                        <div>
                                            <div class="card-logo-container">
                                                <img src="{{ $redeem->picture_url }}" class="card-logo"
                                                    alt="{{ $redeem->name }}">
                                            </div>
                                            <span class="card-discount">{{ $redeem->location }} Share this offer with
                                                friends and receive $3.00 off</span><br>
                                            <span class="card-name">{{ $redeem->name }}</span><br>
                                        </div>
                                        <div>
                                            <div class="views-likes-container">
                                                <div>
                                                    <span>Views: {{ $redeem->views }}</span><br>
                                                    <span>Likes:</span>
                                                </div>
                                                <div class="views-likes-icons">
                                                    <i class="fa fa-share" aria-hidden="true"></i>
                                                    @php
                                                        if(auth()->user())
                                                        {
                                                        $check =
                                                        App\Models\Favourite::where('deal_id',$redeem->id)->where('user_id',auth()->user()->id)->first();
                                                        }
                                                        else
                                                        {
                                                        $check = null;
                                                        }
                                                    @endphp
                                                    @if($check !=null)
                                                        <i class="fa fa-star add-favourite favourite"
                                                            id="{{ $redeem->id }}" aria-hidden="true"></i>
                                                    @else
                                                        <i class="fa fa-star add-favourite" id="{{ $redeem->id }}"
                                                            aria-hidden="true"></i>
                                                    @endif
                                                </div>
                                            </div>
                                            <a href="/deals/{{ $redeem->id }}">
                                                <div class="get-deal-button">Get Deal Now!</div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="card-display card-display--favourite owl-carousel owl-theme">
                                @foreach($redeems as $redeem)
                                    <div class="card card--favourite">
                                        <div>
                                            <div class="card-logo-container">
                                                <img src="{{ $redeem->picture_url }}" class="card-logo"
                                                    alt="{{ $redeem->name }}">
                                            </div>
                                            <span class="card-discount">{{ $redeem->location }}</span><br>
                                            <span class="card-name">{{ $redeem->name }}</span><br>
                                        </div>
                                        <div>
                                            <div class="views-likes-container">
                                                <div>
                                                    <span>Views: {{ $redeem->views }}</span><br>
                                                    <span>Likes:</span>
                                                </div>
                                                <div class="views-likes-icons">
                                                    <i class="fa fa-share" aria-hidden="true"></i>
                                                    @php
                                                        if(auth()->user())
                                                        {
                                                        $check =
                                                        App\Models\Favourite::where('deal_id',$redeem->id)->where('user_id',auth()->user()->id)->first();
                                                        }
                                                        else
                                                        {
                                                        $check = null;
                                                        }
                                                    @endphp
                                                    @if($check !=null)
                                                        <i class="fa fa-star add-favourite favourite"
                                                            id="{{ $redeem->id }}" aria-hidden="true"></i>
                                                    @else
                                                        <i class="fa fa-star add-favourite" id="{{ $redeem->id }}"
                                                            aria-hidden="true"></i>
                                                    @endif
                                                </div>
                                            </div>
                                            <a href="/deals/{{ $redeem->id }}">
                                                <div class="get-deal-button">Get Deal Now!</div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @else
                        <div class="dashboard-right-container">
                            <h4 class="mb-3">Redeemed Coupons</h4>
                            <h5 class="mb-3">No items in your Redeemed list.</h5>
                        </div>
                    @endif
                </div>
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
                <h4 class="mb-3">My Coupons</h4>
                <h5 class="mb-3">Kindly login to see your Favorites.</h5>

            </div>
        @endauth
    </div>
</div>
<!-- <script>
	$(document).ready(function() {

		$(".c-list__link").click(function() {
		$(".c-list__link").removeClass('active');
		$(this).addClass("active");
		var activeCard = $(this).attr('link');
		$(activeCard).addClass('active');
		$(activeCard).nextAll().removeClass('active');
		$(activeCard).prevAll().removeClass('active');
		});
	});
</script> -->
