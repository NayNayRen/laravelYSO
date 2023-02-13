{{-- TO USE --}}
{{-- UNCOMMENT ON INDEX PAGE AND UNCOMMEMT SCRIPT FILE TOO --}}
<div class="container">
    <div class="container-left">
        <span class="category-heading">Cashback</span>
    </div>
    <div class="container-right">
        {{-- CARD BLOCK --}}
        <div class="cashback-display">
            {{-- CASHBACK CARDS WHEN LOGGED IN --}}
            @auth
                <a href="https://yso.netrbx.com/stores/188-bed-bath-beyond" target="_blank">
                    <div class="cashback-card">
                        <div class="cashback-logo"><img src="{{ asset('img/fashion/bed-bath-logo.png') }}"
                                alt="Bed Bath and Beyond Logo"></div>
                        <div class="cashback-discount">
                            <h4>2.3%</h4>
                            <p>Cash Back Rewards</p>
                        </div>
                    </div>
                </a>
                <a href="https://yso.netrbx.com/stores/1108-office-depot" target="_blank">
                    <div class="cashback-card">
                        <div class="cashback-logo"><img src="{{ asset('img/tech/office-depot-logo.png') }}"
                                alt="Office Depot Logo"></div>
                        <div class="cashback-discount">
                            <h4><span>up to</span>3.5%</h4>
                            <p>Cash Back Rewards</p>
                        </div>
                    </div>
                </a>
                <a href="https://yso.netrbx.com/stores/579-finish-line" target="_blank">
                    <div class="cashback-card">
                        <div class="cashback-logo"><img src="{{ asset('img/fashion/finish-line-logo.png') }}"
                                alt="Finish Line Logo">
                        </div>
                        <div class="cashback-discount">
                            <h4>2.9%</h4>
                            <p>Cash Back Rewards</p>
                        </div>
                    </div>
                </a>
                <a href="https://yso.netrbx.com/stores/837-journeys" target="_blank">
                    <div class="cashback-card">
                        <div class="cashback-logo"><img src="{{ asset('img/fashion/journeys-logo.png') }}"
                                alt="Journeys Logo"></div>
                        <div class="cashback-discount">
                            <h4><span>up to</span>3.5%</h4>
                            <p>Cash Back Rewards</p>
                        </div>
                    </div>
                </a>
                <a href="https://yso.netrbx.com/stores/9280-best-buy-u-s" target="_blank">
                    <div class="cashback-card">
                        <div class="cashback-logo"><img src="{{ asset('img/tech/best-buy-logo2.png') }}"
                                alt="Best Buy Logo">
                        </div>
                        <div class="cashback-discount">
                            <h4>0.3%</h4>
                            <p>Cash Back Rewards</p>
                        </div>
                    </div>
                </a>
                {{-- CASHBACK CARDS WHEN NOT LOGGED IN --}}
            @else
                <div class="cashback-card guest">
                    <div class="cashback-card-message">
                        <a href={{ route('user.create') }}>Register</a>
                        <span>and/or</span>
                        <a href={{ route('login.showLoginForm') }}>Log In</a>
                        <span>to continue.</span>
                    </div>
                    <div class="cashback-logo"><img src="{{ asset('img/fashion/bed-bath-logo.png') }}"
                            alt="Bed Bath and Beyond Logo"></div>
                    <div class="cashback-discount">
                        <h4>2.3%</h4>
                        <p>Cash Back Rewards</p>
                    </div>
                </div>
                <div class="cashback-card guest">
                    <div class="cashback-card-message">
                        <a href={{ route('user.create') }}>Register</a>
                        <span>and/or</span>
                        <a href={{ route('login.showLoginForm') }}>Log In</a>
                        <span>to continue.</span>
                    </div>
                    <div class="cashback-logo"><img src="{{ asset('img/tech/office-depot-logo.png') }}"
                            alt="Office Depot Logo"></div>
                    <div class="cashback-discount">
                        <h4><span>up to</span>3.5%</h4>
                        <p>Cash Back Rewards</p>
                    </div>
                </div>
                <div class="cashback-card guest">
                    <div class="cashback-card-message">
                        <a href={{ route('user.create') }}>Register</a>
                        <span>and/or</span>
                        <a href={{ route('login.showLoginForm') }}>Log In</a>
                        <span>to continue.</span>
                    </div>
                    <div class="cashback-logo"><img src="{{ asset('img/fashion/finish-line-logo.png') }}"
                            alt="Finish Line Logo">
                    </div>
                    <div class="cashback-discount">
                        <h4>2.9%</h4>
                        <p>Cash Back Rewards</p>
                    </div>
                </div>
                <div class="cashback-card guest">
                    <div class="cashback-card-message">
                        <a href={{ route('user.create') }}>Register</a>
                        <span>and/or</span>
                        <a href={{ route('login.showLoginForm') }}>Log In</a>
                        <span>to continue.</span>
                    </div>
                    <div class="cashback-logo"><img src="{{ asset('img/fashion/journeys-logo.png') }}" alt="Journeys Logo">
                    </div>
                    <div class="cashback-discount">
                        <h4><span>up to</span>3.5%</h4>
                        <p>Cash Back Rewards</p>
                    </div>
                </div>
                <div class="cashback-card guest">
                    <div class="cashback-card-message">
                        <a href={{ route('user.create') }}>Register</a>
                        <span>and/or</span>
                        <a href={{ route('login.showLoginForm') }}>Log In</a>
                        <span>to continue.</span>
                    </div>
                    <div class="cashback-logo"><img src="{{ asset('img/tech/best-buy-logo2.png') }}" alt="Best Buy Logo">
                    </div>
                    <div class="cashback-discount">
                        <h4>0.3%</h4>
                        <p>Cash Back Rewards</p>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</div>
