@include('includes._header')
<div class="main">
    {{-- PAGE HERO/BANNER --}}
    <div class="page-hero enhance-background">
        <h1>Sales and Revenue</h1>
        <h2>Get more of each with YSO.</h2>
        <div class="page-hero-button-container">
            <a href="/navigation_pages/support" class="page-hero-button">Learn
                More</a>
            <a href="/register" class="page-hero-button">Sign Up</a>
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
                    <p>Reaching into Social media with a YSO campaign to find new customers brings a depth of people you
                        can not find otherwise. The time and budget it would take to reach the masses with a
                        conventional campaign is out of reach for most.</p>
                    <a href="/navigation_pages/support" class="page-hero-button">Learn
                        More</a>
                </div>
            </div>
            <div class="enhance-image">
                <img src="{{ asset('img/navigation-pages/enhance-photo-1.jpg') }}"
                    alt="Support Photo">
            </div>
        </div>
        {{-- VALUES BLOCK --}}
        <div class="enhance-info">
            <div id="values"></div>
            <div class="enhance-image">
                <img src="{{ asset('img/navigation-pages/enhance-photo-2.jpg') }}"
                    alt="Support Photo">
            </div>
            <div class="enhance-text">
                <h1>Reach your audience with a touch of value.</h1>
                <div>
                    <p>Customers benefit while being rewarded when shopping in-store or online. Sharing their
                        experiences also benefits the merchant. We help these merchants by offering complete flexibility
                        to easily create and share all of their offers and services.</p>
                    <a href="/navigation_pages/support" class="page-hero-button">Learn
                        More</a>
                </div>
            </div>
        </div>
        {{-- MIDDLE BANNER --}}
        <div class="enhance-middle-banner">
            <h1>All inclusive, all at your fingertips.</h1>
            <h2>All within reach at YSO.</h2>
            <a href="/register" class="page-hero-button">Sign Up Now</a>
        </div>
        {{-- LOYALTIES BLOCK --}}
        <div class="enhance-info">
            <div id="loyalties"></div>
            <div class="enhance-text">
                <h1>Give loyal customers a reason to be loyal.</h1>
                <div>
                    <p>For the first time, YSO allows you to easily share your customer's recommendations with their
                        friends, creating an organic and viral marketing campaign that brings you to a vast new customer
                        base. Rewards can be distributed and shared via your social media outlets. YSO lets you design
                        your custom campaign and share it quickly, reaching your new and existing customers.</p>
                    <a href="/navigation_pages/support" class="page-hero-button">Learn
                        More</a>
                </div>
            </div>
            <div class="enhance-image">
                <img src="{{ asset('img/navigation-pages/enhance-photo-3.jpg') }}"
                    alt="Support Photo">
            </div>
        </div>
        {{-- CAMPAIGNS BLOCK --}}
        <div class="enhance-info">
            <div id="campaigns"></div>
            <div class="enhance-image">
                <img src="{{ asset('img/navigation-pages/enhance-photo-4.jpg') }}"
                    alt="Support Photo">
            </div>
            <div class="enhance-text">
                <h1>Track campaigns and know what works.</h1>
                <div>
                    <p>Creating a unique rewards program allows you to customize incentives tailored to your customers.
                        In turn you can update, and track each incentive you create, knowing which incentive hits home
                        with your customers.</p>
                    <a href="/navigation_pages/support" class="page-hero-button">Learn
                        More</a>
                </div>
            </div>
        </div>
    </div>

</div>
{{-- PAGE SPECIFIC SCRIPT --}}
<script src="{{ asset('js/enhance-sticky-navigation.js') }}"></script>
@include('includes._footer')
