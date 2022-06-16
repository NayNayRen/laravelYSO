    {{-- BACK TO TOP ARROW --}}
    <span id="up-arrow-message" class="up-arrow-message">To Top</span>
    <a href="#top" id="up-arrow" class="up-arrow"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
    {{-- FOOTER BLOCK --}}
    <div class="footer">
        <div class="footer-top-section">
            <div class="footer-top-section-left">
                <div class="footer-top-section-left-header">
                    <a href={{ route('deals.index') }}>
                        <img src="{{ asset('img/yso-logo2.svg') }}" class="yso-link"
                            alt="Your Social Offers Logo">
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
                    <a href="mailto: Support@YourSocialOffers.com" class="footer-social-media-links">
                        <img src="{{ asset('img/social/mail.png') }}" alt="Email link">
                    </a>
                    <a href="https://www.facebook.com/yoursocialoffers/?ref=py_c" class="footer-social-media-links">
                        <img src="{{ asset('img/social/facebook.png') }}" alt="Facebook link">
                    </a>
                    <a href="https://twitter.com/ysoffers" class="footer-social-media-links">
                        <img src="{{ asset('img/social/twitter.png') }}" alt="Twitter link">
                    </a>
                    <a href="https://www.instagram.com/yoursocialoffers/" class="footer-social-media-links">
                        <img src="{{ asset('img/social/instagram.png') }}" alt="Instagram link">
                    </a>
                    <a href="https://www.youtube.com/channel/UCWH7dsxheL2ZOTrpfNiVBAA"
                        class="footer-social-media-links">
                        <img src="{{ asset('img/social/youtube.png') }}" alt="Youtube link">
                    </a>
                    <a href="#" class="footer-social-media-links">
                        <img src="{{ asset('img/social/linkedin.png') }}" alt="LinkedIn link">
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
                <span>&copy; Copyright July 2021, <a href="https://pennexx.net/">PENNEXX</a>. All rights
                    reserved.</span>
                <span>YourSocialOffers (YSO) is a subsidiary of <a href="https://pennexx.net">pennexx.net</a> listed on
                    OTC Markets as
                    <a href="https://www.otcmarkets.com/stock/PNNX/overview">PNNX</a></span>
            </div>
            <div class="footer-bottom-section-policy-terms">
                <span>Privacy Policy</span><span>Terms of Use</span>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/main.js') }}"></script>
    </body>

    </html>
