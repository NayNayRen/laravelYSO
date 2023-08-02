{{-- FOOTER COMPONENT --}}
{{-- BACK TO TOP ARROW --}}
<span id="up-arrow-message" class="up-arrow-message">To Top</span>
<a href="#top" id="up-arrow" class="up-arrow" aria-label="Back to top."><i class="fa fa-arrow-up"
        aria-hidden="false"></i></a>
{{-- FOOTER BLOCK --}}
<div class="footer">
    <div class="footer-top-section">
        <div class="footer-top-section-left">
            <div class="footer-top-section-left-header">
                <a href={{ route('deals.index') }}>
                    <img src="{{ asset('img/yso-logo2.svg') }}" class="yso-link" alt="Your Social Offers Logo">
                </a>
            </div>
            <h3>Corporate Headquarters</h3>
            <div class="footer-address">
                <span>2420 Enterprise Rd.</span>
                <span>Clearwater, FL 33763</span>
                <span>(866) 928-6409</span>
            </div>
            {{-- SOCIAL MEDIA BLOCK --}}
            <div class="footer-social-media-container">
                <a href="#" class="footer-social-media-links" aria-label="Contact via email.">
                    <i class="fa fa-envelope-o" aria-hidden="false"></i>
                </a>
                <a href="#" class="footer-social-media-links" aria-label="Contact via Facebook.">
                    <i class="fa fa-facebook-official" aria-hidden="false"></i>
                </a>
                <a href="#" class="footer-social-media-links" aria-label="Contact via Twitter.">
                    <i class="fa fa-twitter" aria-hidden="false"></i>
                </a>
                <a href="#" class="footer-social-media-links" aria-label="Contact via Instagram.">
                    <i class="fa fa-instagram" aria-hidden="false"></i>
                </a>
                <a href="#" class="footer-social-media-links" aria-label="Visit us on YouTube.">
                    <i class="fa fa-youtube" aria-hidden="false"></i>
                </a>
                <a href="#" class="footer-social-media-links" aria-label="Contact via LinkedIn.">
                    <i class="fa fa-linkedin" aria-hidden="false"></i>
                </a>
            </div>
        </div>
        {{-- CATEGORY BLOCK --}}
        <div class="footer-top-section-right">
            <div class="footer-top-section-right-header">
                <span>Categories</span>
            </div>
            <div class="footer-categories">
                <span>Food</span>
                <span>Fashion</span>
                <span>Automotive</span>
                <span>Entertainment</span>
                <span>Health and Fitness</span>
                <span>Electronics</span>
            </div>
        </div>
    </div>
    {{-- FOOTER DISCLAIMER --}}
    <div class="footer-bottom-section">
        <div class="footer-bottom-section-disclaimer">
            <span>&copy; Copyright January 2021, <a href="#">PENNEXX</a>. All
                rights reserved.
            </span>
            <span>YourSocialOffers (YSO) is a subsidiary of
                <a href="#">pennexx.net</a> listed on OTC Markets as
                <a href="#">PNNX</a>
            </span>
        </div>
        <div class="footer-bottom-section-policy-terms">
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Use</a>
        </div>
    </div>
</div>
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
