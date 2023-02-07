{{-- ADDED FOR MERCHANTS REDIRECTS --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="images/favicon.ico" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/map.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <title>YourSocialOffers.com || {{ $pageTitle }}</title>
    <link rel="icon" href="{{ asset('img/yso-clipped-rw-outlined.png') }}" type="image/x-icon">
</head>

<body>
    {{-- PAGE DIM EFFECT --}}
    <div id="window-overlay" class="window-overlay"></div>
    {{-- BACK TO TOP ANCHOR --}}
    <a id="#top"></a>
    {{-- SCROLL POINT KICKS IN --}}
    <div id="scroll-point"></div>
    <div class="header">
        <div class="header-greeting">Find deals, share them with friends... Your Social Offers become their offers too!
            <a href="https://yourgrowthdashboard.com/" target="_blank">Learn More</a>
        </div>
        {{-- LOGO/HOME ICON BUTTON --}}
        <div class="header-navigation">
            {{-- <a href={{ url()->previous() }}> --}}
            <a href={{ route('deals.index') }}>
                <img src="{{ asset('img/yso-logo2.svg') }}" class="yso-header-link" alt="Your Social Offers Logo">
            </a>
            {{-- PAGES NAVIGATION BLOCK --}}
            <div class="links-user-container">
                <ul class="links-container">
                    <li><a href="https://yso.netrbx.com" target="__blank">cashback</a></li>
                    <li>
                        <a href={{ route('rewards') }}
                            class="{{ Request::is('navigation_pages/rewards') || Request::is('navigation_pages/rewards/*') ? 'active' : '' }}">rewards</a>
                    </li>
                    <li><a href={{ route('enhance') }}
                            class="{{ Request::is('navigation_pages/enhance') || Request::is('navigation_pages/enhance/*') ? 'active' : '' }}">enhance
                            your sales</a>
                    </li>
                    <li><a href={{ route('support') }}
                            class="{{ Request::is('navigation_pages/support') || Request::is('navigation_pages/support/*') ? 'active' : '' }}">support</a>
                    </li>
                    <li><a href={{ route('about') }}
                            class="{{ Request::is('navigation_pages/about') || Request::is('navigation_pages/about/*') ? 'active' : '' }}">about
                            yso</a></li>
                </ul>
                {{-- LOGGED IN USER INITIALS --}}
                @auth
                    <div class="user-initials-container">
                        <span>Logged In As</span>
                        <div class="user-initials">
                            {{ auth()->user()->firstName[0] . auth()->user()->lastName[0] }}</div>
                        <form action={{ route('logout') }} method="POST">
                            @csrf
                            <button type="submit" class="user-logout-button" aria-label="Logout" title="Logout"><i
                                    class="fa fa-sign-out" aria-hidden="true"></i></button>
                        </form>
                    </div>
                @else
                    {{-- LOG IN/REGISTER BUTTONS --}}
                    <div class="user-register-container">
                        <a href="https://beta.yso.co/" class="user-login-button" target="_blank">Log In</a>
                        <a href="https://beta.yso.co/" class="user-register-button" target="_blank">Sign Up</a>
                    </div>
                @endauth
            </div>
            {{-- BURGER MENU --}}
            <div class="burger-menu">
                <div id="burger-bars-1" class="burger-bars"></div>
                <div id="burger-bars-2" class="burger-bars"></div>
                <div id="burger-bars-3" class="burger-bars"></div>
            </div>
        </div>
    </div>
    {{-- ADDED FOR MERCHANTS REDIRECTS --}}
    {{-- @include('includes._header') --}}
    <div class="main">
        {{-- PAGE HERO/BANNER --}}
        <div class="page-hero enhance-background">
            <h1>Sales and Revenue</h1>
            <h2>Get more of each with YSO.</h2>
            <div class="page-hero-button-container">
                <a href="https://yourgrowthdashboard.com/" class="page-hero-button" target="_blank">Learn More</a>
                <a href="https://beta.yso.co/" class="page-hero-button" target="_blank">Sign Up</a>
            </div>
        </div>
        {{-- SCROLL POINT KICKS IN --}}
        <div id="enhance-navigation-scroll-point"></div>
        {{-- SECONDARY STICKY NAVIGATION --}}
        <ul class="enhance-navigation-container">
            <li>
                <a href="#gains" class="gains">Gains</a>
            </li>
            <li>
                <a href="#values" class="values">Values</a>
            </li>
            <li>
                <a href="#loyalties" class="loyalties">Loyalties</a>
            </li>
            <li>
                <a href="#campaigns" class="campaigns">Campaigns</a>
            </li>
        </ul>
        {{-- MAIN CONTENT CONTAINER --}}
        <div class="enhance-container">
            {{-- GAINS BLOCK --}}
            <div class="enhance-info">
                <div id="gains"></div>
                <div class="enhance-text">
                    <h1>Enhance your gains with new customers.</h1>
                    <div>
                        <p>Reaching into social media with a YSO campaign to find new customers brings a wealth of
                            people
                            you
                            cannot find otherwise. The time and budget it would take to reach the masses with a
                            conventional campaign is out of bounds for most.</p>
                        <a href="https://yourgrowthdashboard.com/" class="page-hero-button" target="_blank">Learn
                            More</a>
                    </div>
                </div>
                <div class="enhance-image">
                    <img src="{{ asset('img/navigation-pages/enhance-photo-1.jpg') }}" alt="Support Photo">
                </div>
            </div>
            {{-- VALUES BLOCK --}}
            <div class="enhance-info">
                <div id="values"></div>
                <div class="enhance-image">
                    <img src="{{ asset('img/navigation-pages/enhance-photo-2.jpg') }}" alt="Support Photo">
                </div>
                <div class="enhance-text">
                    <h1>Reach your audience with a touch of value.</h1>
                    <div>
                        <p>Customers benefit while being rewarded when shopping in store or online. Sharing their
                            experiences also benefits the merchant. We help these merchants by offering complete
                            flexibility
                            to easily create and share all of their offers and services.</p>
                        <a href="https://yourgrowthdashboard.com/" class="page-hero-button" target="_blank">Learn
                            More</a>
                    </div>
                </div>
            </div>
            {{-- MIDDLE BANNER --}}
            <div class="enhance-middle-banner">
                <h1>All inclusive, all at your fingertips.</h1>
                <h2>All within reach at YSO.</h2>
                <a href="https://beta.yso.co/" class="page-hero-button" target="_blank">Sign Up Now</a>
            </div>
            {{-- LOYALTIES BLOCK --}}
            <div class="enhance-info">
                <div id="loyalties"></div>
                <div class="enhance-text">
                    <h1>Give loyal customers a reason to be loyal.</h1>
                    <div>
                        <p>For the first time, YSO allows you to easily share your customer's recommendations with their
                            friends, creating an organic and viral marketing campaign that brings you to a vast new
                            customer
                            base. Rewards can be distributed and shared via your social media outlets. YSO lets you
                            design
                            your custom campaign and share it quickly, reaching your new and existing customers.</p>
                        <a href="https://yourgrowthdashboard.com/" class="page-hero-button" target="_blank">Learn
                            More</a>
                    </div>
                </div>
                <div class="enhance-image">
                    <img src="{{ asset('img/navigation-pages/enhance-photo-3.jpg') }}" alt="Support Photo">
                </div>
            </div>
            {{-- CAMPAIGNS BLOCK --}}
            <div class="enhance-info">
                <div id="campaigns"></div>
                <div class="enhance-image">
                    <img src="{{ asset('img/navigation-pages/enhance-photo-4.jpg') }}" alt="Support Photo">
                </div>
                <div class="enhance-text">
                    <h1>Track campaigns and know what works.</h1>
                    <div>
                        <p>Creating a unique rewards program allows you to customize incentives tailored to your
                            customers.
                            In turn, you can update and track each incentive you create, knowing which incentive hits
                            home
                            with your customers.</p>
                        <a href="https://yourgrowthdashboard.com/" class="page-hero-button" target="_blank">Learn
                            More</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    {{-- PAGE SPECIFIC SCRIPT --}}
    <script src="{{ asset('js/enhance-sticky-navigation.js') }}"></script>
    @include('includes._footer')
