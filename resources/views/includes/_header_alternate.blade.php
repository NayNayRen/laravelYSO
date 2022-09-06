<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="images/favicon.ico" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style2.css') }}">
    <title>YourSocialOffers.com || {{ $pageTitle }}</title>
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
        {{-- BACK BUTTON --}}
        <div class="header-navigation">
            <a href="{{ url()->previous() }}" class="back-button" aria-label='Previous Page'><i
                    class="fa fa-chevron-left" aria-hidden="false"
                    title="Back to previous page."></i><span>Back</span></a>
            <a href={{ route('deals.index') }}>
                <img src="{{ asset('img/yso-logo2.svg') }}" class="yso-header-link-alternate"
                    alt="Your Social Offers Logo">
            </a>
            {{-- PAGES NAVIGATION BLOCK --}}
            <div class="links-user-container dont-display">
                <ul class="links-container">
                    <li><a href="https://yso.netrbx.com" target="__blank">cashback</a></li>
                    <li><a href={{ route('rewards') }}>rewards</a></li>
                    <li><a href={{ route('enhance') }}>enhance your sales</a>
                    </li>
                    <li><a href={{ route('support') }}>support</a></li>
                    <li><a href={{ route('about') }}>about yso</a></li>
                </ul>
                {{-- LOGGED IN USER INITIALS --}}
                @auth
                    <div class="user-initials-container">
                        <span>Logged in as:</span>
                        <div class="user-initials">
                            {{ auth()->user()->firstName[0] . auth()->user()->lastName[0] }}</div>
                        <form action={{ route('logout') }} method="POST">
                            @csrf
                            <button type="submit" class="user-logout-button" aria-label="Logout">Logout <i
                                    class="fa fa-sign-out" aria-hidden="true"></i></button>
                        </form>
                    </div>
                @else
                    {{-- LOG IN/REGISTER BUTTONS --}}
                    <div class="user-register-container">
                        <a href={{ route('login.showLoginForm') }} class="user-login-button">Log
                            In</a>
                        <a href={{ route('user.create') }} class="user-register-button">Sign
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
