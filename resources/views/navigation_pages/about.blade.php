@include('includes._header')
<div class="main">
    {{-- PAGE HERO/BANNER --}}
    <div class="page-hero about-us-background">
        <h1>Who We Are</h1>
        <h2>Innovators of Social Media Marketing</h2>
        <p>
            <a href={{ route('deals.index') }} class="page-hero-logo">
                <span>
                    Y<span class="grey-text">our</span>S<span class="grey-text">ocial</span>O<span
                        class="grey-text">ffers</span><span class="red-background">.com</span>
                </span>
            </a> re-defines the way social media can be used to create growth potential and capitalize on the social
            media billion-dollar marketplace.
        </p>
        <div class="page-hero-button-container">
            <a href={{ route('support') }} class="page-hero-button">Learn
                More</a>
            <a href={{ route('user.create') }} class="page-hero-button">Sign Up</a>
        </div>
    </div>
    {{-- MAIN CONTENT CONTAINER --}}
    <div class="about-us-container">
        {{-- VINCE BLOCK --}}
        <div class="about-us-personal-info">
            <h1>Vincent Risalvato</h1>
            <h2>Chief Technology Officer</h2>
            <p>Mr. Risalvato is a Computer Scientist and entrepreneur. He has created and sold companies worth more than
                20 million dollars. Mr. Risalvato's designs have shipped internationally. He has been accepted by the
                courts as an expert in the field of computer science and his testimony has been relied upon to determine
                the outcome of billion dollar cases.
            </p>
            <div class="about-us-profile-pic">
                <img src="{{ asset('img/male-profile.png') }}">
            </div>
        </div>
        {{-- JOE BLOCK --}}
        <div class="about-us-personal-info">
            <h1>Joe Candito</h1>
            <h2>President</h2>
            <p>Mr. Candito has a Master's Degree in Management and Supervision from Central Michigan University with an
                extensive history as a business consultant, entrepreneur, investor, and in commercial real estate
                development. Mr. Candito has over 30 years of experience in technology, marketing, sales, management,
                retail, consulting, and franchising experience.
            </p>
            <div class="about-us-profile-pic">
                <img src="{{ asset('img/male-profile.png') }}">
            </div>
        </div>
    </div>

</div>
@include('includes._footer')
