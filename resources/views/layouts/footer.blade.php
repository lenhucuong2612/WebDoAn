<footer class="footer footer-dark">
    <div class="footer-middle">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <div class="widget widget-about">
                        <img src="{{$getSystemSettingApp->getLogo()}}" class="footer-logo" alt="Footer Logo" width="105" height="25">
                        <p>{{$getSystemSettingApp->footer_description}}</p>

                        <div class="social-icons">
                            @if (!empty($getSystemSettingApp->facebook_link))
                            <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                            @endif
                            @if (!empty($getSystemSettingApp->twitter_link))
                            <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                            @endif
                            @if (!empty($getSystemSettingApp->instagram_link))
                            <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                            @endif
                            @if (!empty($getSystemSettingApp->youtobe_link))
                            <a href="#" class="social-icon" title="Youtube" target="_blank"><i class="icon-youtube"></i></a>
                            @endif
                            @if (!empty($getSystemSettingApp->pinterest_link))
                            <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                            @endif
                        </div><!-- End .soial-icons -->
                    </div><!-- End .widget about-widget -->
                </div><!-- End .col-sm-6 col-lg-3 -->

                <div class="col-sm-6 col-lg-3">
                    <div class="widget">
                        <h4 class="widget-title">Useful Links</h4><!-- End .widget-title -->

                        <ul class="widget-list">
                            <li><a href="{{route('home')}}">Home</a></li>
                            <li><a href="{{route('about')}}">About Us</a></li>
                            <li><a href="{{route('faq')}}">FAQ</a></li>
                            <li><a href="{{route('contact')}}">Contact us</a></li>
                            <li><a href="{{route('blog')}}">Blog</a></li>
                            <li><a href="#signin-modal" data-toggle="modal">Log in</a></li>
                        </ul><!-- End .widget-list -->
                    </div><!-- End .widget -->
                </div><!-- End .col-sm-6 col-lg-3 -->

                <div class="col-sm-6 col-lg-3">
                    <div class="widget">
                        <h4 class="widget-title">Customer Service</h4><!-- End .widget-title -->

                        <ul class="widget-list">
                            <li><a href="{{url('payment-methods')}}">Payment Methods</a></li>
                            <li><a href="{{url('money-back-guarantee')}}">Money-back guarantee!</a></li>
                            <li><a href="{{url('returns')}}">Returns</a></li>
                            <li><a href="{{url('shipping')}}">Shipping</a></li>
                            <li><a href="{{url('terms-conditions')}}">Terms and conditions</a></li>
                            <li><a href="{{url('privacy-policy')}}">Privacy Policy</a></li>
                        </ul><!-- End .widget-list -->
                    </div><!-- End .widget -->
                </div><!-- End .col-sm-6 col-lg-3 -->

                <div class="col-sm-6 col-lg-3">
                    <div class="widget">
                        <h4 class="widget-title">My Account</h4><!-- End .widget-title -->

                        <ul class="widget-list">
                            <li><a href="{{route('cart')}}">View Cart</a></li>
                            <li><a href="{{route('cart.checkout')}}">Checkout</a></li>
                            <li><a href="#">Track My Order</a></li>
                        </ul><!-- End .widget-list -->
                    </div><!-- End .widget -->
                </div><!-- End .col-sm-6 col-lg-3 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .footer-middle -->

    <div class="footer-bottom">
        <div class="container">
            <p class="footer-copyright">Copyright © 2019 Molla Store. All Rights Reserved.</p><!-- End .footer-copyright -->
            <figure class="footer-payments">
                <img src="{{$getSystemSettingApp->getFooterpayment()}}"  alt="Payment methods" width="272" height="20">
            </figure><!-- End .footer-payments -->
        </div><!-- End .container -->
    </div><!-- End .footer-bottom -->
</footer><!-- End .footer -->