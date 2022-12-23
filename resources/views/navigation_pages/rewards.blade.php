@include('includes._header')
<div class="main">
    {{-- PAGE HERO/BANNER --}}
    <div class="page-hero rewards-background">
        <h1>Rewards and Deals</h1>
        <h2>For you, and those that matter to you.</h2>
        <div class="page-hero-button-container">
            <a href={{ route('support') }} class="page-hero-button">Learn
                More</a>
            <a href={{ route('user.create') }} class="page-hero-button">Sign Up</a>
        </div>
    </div>
    {{-- MAIN CONTENT CONTAINER --}}
    <div class="rewards-container">
        {{-- TOP BANNER --}}
        <div class="rewards-top-banner">
            <h1>Say hello to your new deals.</h1>
            <h2>Share them with a friend...</h2>
            <h3>Now it's their deal, and they can share it too!</h3>
            <p>Pretty simple huh?</p>
            <span>Keep reading...</span>
        </div>
        {{-- FIRST BLOCK --}}
        <div class="rewards-info">
            <div class="rewards-text">
                <h1>We think of it as crowd sourcing deals.</h1>
                <div>
                    <p>Crowd sourced takes the "I Got You!" approach a whole lot farther. Deals come to you by
                        automated DealSeek. It also comes to those who are a part of your circle, while being shared
                        based on
                        like-minded interests.</p>
                    <a href={{ route('support') }} class="page-hero-button">Learn
                        More</a>
                </div>
            </div>
            <div class="rewards-image">
                <img src="{{ asset('img/navigation-pages/rewards-photo-2.jpg') }}"
                    alt="Rewards Photo">
            </div>
        </div>
        {{-- SECOND BLOCK --}}
        <div class="rewards-info">
            <div class="rewards-image">
                <img src="{{ asset('img/navigation-pages/rewards-photo-1.jpg') }}"
                    alt="Rewards Photo">
            </div>
            <div class="rewards-text">
                <h1>Nothing beats a qualified referral.</h1>
                <div>
                    <p>We've all heard that before, and it's still true. Crowd sourced opportunities mimic this intent
                        with the speed of remote communications. I share a deal with you THAT I JUST USED!!! How could
                        it be more qualified than that?</p>
                    <a href={{ route('support') }} class="page-hero-button">Learn
                        More</a>
                </div>
            </div>
        </div>
        {{-- BOTTOM BANNER --}}
        <div class="rewards-bottom-banner">
            <h1>All inclusive, all at your fingertips.</h1>
            <h2>All within reach at YSO.</h2>
            <a href={{ route('user.create') }} class="page-hero-button">Sign Up Now</a>
        </div>
    </div>
</div>
@include('includes._footer')
