@include('includes._header')
<div class="main">
    {{-- PAGE HERO/BANNER --}}
    <div class="page-hero support-background">
        <h1>Our Business Support</h1>
        <h2>1-866-633-8231</h2>
        <p>If you are having difficulty with our system trying to register for or redeem a reward, please give us a call
            or contact us via email.</p>
        <div class="page-hero-button-container">
            <a href={{ route('user.create') }} class="page-hero-button">Sign Up</a>
        </div>
    </div>
    {{-- MAIN CONTENT CONTAINER --}}
    <div class="support-container">
        {{-- BUSINESS SUPPORT BLOCK --}}
        <div class="support-info">
            <div class="support-image">
                <img src="{{ asset('img/navigation-pages/support-photo-2.jpg') }}"
                    alt="Support Photo">
            </div>
            <div class="support-text">
                <h1>Business Support</h1>
                <h3>We are here to help you build your personalized campaigns, social media endevours, and marketing
                    ideas.</h3>
                <a href="mailto: Support@YourSocialOffers.com">Support@YourSocialOffers.com</a>
                <p>Regardless of your social media marketing needs, we can help. Users and merchants can call us for
                    assistance with any of our products. </p>
            </div>
        </div>
        {{-- USER SUPPORT BLOCK --}}
        <div class="support-info">
            <div class="support-text">
                <h1>User Support</h1>
                <h3>Our friendly support staff is standing by to assist you with any of your needs.</h3>
                <a href="mailto: Support@YourSocialOffers.com">Support@YourSocialOffers.com</a>
                <p>We are available by email and by phone for any questions or concerns regarding any issues faced while
                    using our application. Let us guide you through the process of setting up a personalized social
                    media marketing campaign or redeeming rewards. </p>
            </div>
            <div class="support-image">
                <img src="{{ asset('img/navigation-pages/support-photo-1.jpg') }}"
                    alt="Support Photo">
            </div>
        </div>
    </div>

</div>
@include('includes._footer')
