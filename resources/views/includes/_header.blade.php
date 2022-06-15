<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/favicon.ico" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="//unpkg.com/alpinejs" defer></script>
    <title>YourSocialOffers.com</title>
    <link rel="icon" href="{{ asset('img/yso-clipped-rw.png') }}" type="image/x-icon">
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
            <a href="{{ asset('navigation_pages/support') }}">Learn More</a>
        </div>
        {{-- BACK BUTTON AND LOGO --}}
        <div class="header-navigation">
            <a href="/">
                <img src="{{ asset('img/yso-logo2.svg') }}" class="yso-header-link"
                    alt="Your Social Offers Logo">
            </a>
            {{-- PAGES NAVIGATION BLOCK --}}
            <div class="links-user-container">
                <ul class="links-container">
                    <li><a href="https://yso.netrbx.com" target="__blank">cashback</a></li>
                    <li>
                        <a href="{{ asset('navigation_pages/rewards') }}"
                            class="{{ (Request::is('navigation_pages/rewards') || Request::is('navigation_pages/rewards/*')) ? 'active' : '' }}">rewards</a>
                    </li>
                    <li><a href="{{ asset('navigation_pages/enhance') }}"
                            class="{{ (Request::is('navigation_pages/enhance') || Request::is('navigation_pages/enhance/*')) ? 'active' : '' }}">enhance
                            your sales</a>
                    </li>
                    <li><a href="{{ asset('navigation_pages/support') }}"
                            class="{{ (Request::is('navigation_pages/support') || Request::is('navigation_pages/support/*')) ? 'active' : '' }}">support</a>
                    </li>
                    <li><a href="{{ asset('navigation_pages/about') }}"
                            class="{{ (Request::is('navigation_pages/about') || Request::is('navigation_pages/about/*')) ? 'active' : '' }}">about
                            yso</a></li>
                </ul>
                {{-- LOGGED IN USER INITIALS --}}
                @auth
                    <div class="user-initials-container">
                        <span>Logged in as:</span>
                        <div class="user-initials">
                            {{ auth()->user()->firstName[0] . auth()->user()->lastName[0] }}</div>
                        <form action="/logout" method="POST">
                            @csrf
                            <button type="submit" class="user-logout-button">Logout <i
                                    class="fa fa-sign-out"></i></button>
                        </form>
                    </div>
                @else
                    {{-- LOG IN/REGISTER BUTTONS --}}
                    <div class="user-register-container">
                        <a href="/login" class="user-login-button">Log In</a>
                        <a href="/register" class="user-register-button">Sign
                            Up</a>
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
