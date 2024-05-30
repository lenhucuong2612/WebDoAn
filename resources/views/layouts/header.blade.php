<header class="header">
    <div class="header-top">
        <div class="container">
            <div class="header-left">
                <div class="header-dropdown">
                    <a href="#">USD</a>
                    <div class="header-menu">
                        <ul>
                            <li><a href="#">Usd</a></li>
                        </ul>
                    </div><!-- End .header-menu -->
                </div><!-- End .header-dropdown -->

                <div class="header-dropdown">
                    <a href="#">ENG</a>
                    <div class="header-menu">
                        <ul>
                            <li><a href="#">English</a></li>
                        </ul>
                    </div><!-- End .header-menu -->
                </div><!-- End .header-dropdown -->
            </div><!-- End .header-left -->

            <div class="header-right">
                <ul class="top-menu">
                    <li>
                        <a href="#">Links</a>
                        <ul>
                            <li><a href="tel:#"><i class="icon-phone"></i>Call: {{$getSystemSettingApp->phone}}</a></li>
                            @if (!empty(Auth::check()))
                            <li><a href="{{route('my_wishlist')}}"><i class="icon-heart-o"></i>My Wishlist </a></li> 
                            @else
                            <li><a href="#signin-modal" data-toggle="modal"><i class="icon-heart-o"></i>My Wishlist </a></li>
                            @endif
                            <li><a href="">About Us</a></li>
                            <li><a href="contact.html">Contact Us</a></li>
                            @if (!empty(Auth::check()))
                                <li><a href="{{route('user.dashboard')}}"><i class="icon-user"></i>{{Auth::user()->name}}</a></li>
                                <li><a href="{{route('logout')}}" ><i class="icon-close"></i>Logout</a></li>
                            @else
                            <li><a href="#signin-modal" data-toggle="modal"><i class="icon-user"></i>Login</a></li>
                            @endif
                            
                        </ul>
                    </li>
                </ul><!-- End .top-menu -->
            </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div><!-- End .header-top -->

    <div class="header-middle sticky-header">
        <div class="container">
            <div class="header-left">
                <button class="mobile-menu-toggler">
                    <span class="sr-only">Toggle mobile menu</span>
                    <i class="icon-bars"></i>
                </button>

                <a href="#" class="logo">
                    <img src="{{$getSystemSettingApp->getLogo()}}" alt="Molla Logo" width="105" height="25">
                </a>

                <nav class="main-nav">
                    <ul class="menu sf-arrows">
                        <li class="megamenu-container active">
                            <a href="{{route('home')}}" class="sf-with-ul">Home</a>
                        </li>
                        <li>
                            <a href="javascrip:void(0)" class="sf-with-ul">Shop</a>
                            <div class="megamenu megamenu-md">
                                <div class="row no-gutters">
                                    <div class="col-md-12">
                                        <div class="menu-col">
                                            <div class="row">
                                                @php
                                                    $getCategoryHeader=\App\Models\CategoryModel::getRecordMenu();
                                                @endphp
                                               @foreach ($getCategoryHeader as $value_category_header)
                                               @if (!empty($value_category_header->getSubCategory->count()))
                                                <div class="col-md-4" style="margin-top:20px">
                                                    <a href="{{url($value_category_header->slug)}}" class="menu-title">{{$value_category_header->name}}</a><!-- End .menu-title -->
                                                    <ul>
                                                        @foreach ($value_category_header->getSubCategory as $value_h_sub)
                                                        <li><a href="{{url($value_category_header->slug.'/'.$value_h_sub->slug)}}">{{$value_h_sub->name}}</a></li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                               @endif
                                               @endforeach
                                            </div><!-- End .row -->
                                        </div><!-- End .menu-col -->
                                    </div><!-- End .col-md-8 -->

                                    
                                </div><!-- End .row -->
                            </div><!-- End .megamenu megamenu-md -->
                        </li>
                       
                    </ul><!-- End .menu -->
                </nav><!-- End .main-nav -->
            </div><!-- End .header-left -->

            <div class="header-right">
                <div class="header-search">
                    <a href="#" class="search-toggle" role="button" title="Search"><i class="icon-search"></i></a>
                    <form action="{{url('search')}}" method="get">
                        <div class="header-search-wrapper">
                            <label for="q" class="sr-only">Search</label>
                            <input type="search" class="form-control" name="q" id="q" placeholder="Search in..." value="{{!empty(Request::get('q'))?Request::get('q'):''}}" required>
                        </div><!-- End .header-search-wrapper -->
                    </form>
                </div><!-- End .header-search -->

                <div class="dropdown cart-dropdown">
                    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                        <i class="icon-shopping-cart"></i>
                        @php
                            $TotalQuantity=0;
                            foreach(Cart::getContent() as $cart){
                                $TotalQuantity+=$cart->quantity;
                            }
                        @endphp
                        <span class="cart-count">{{$TotalQuantity}}</span>
                    </a>

                    @if (!empty(Cart::getContent()->count()))
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-cart-products">
                            @foreach (Cart::getContent() as $header_cart)
                            @php
                                $getCartProduct=App\Models\ProductModel::getSingle($header_cart->id);
                            @endphp
                            @if(!empty($getCartProduct))
                            @php
                                $getProductImage=$getCartProduct->getIamgeSingle($getCartProduct->id);
                            @endphp
                                <div class="product">
                                    <div class="product-cart-details">
                                        <h4 class="product-title">
                                            <a href="{{url($getCartProduct->slug)}}">
                                                {{$getCartProduct->title}}
                                            </a>
                                        </h4>

                                        <span class="cart-product-info">
                                            <span class="cart-product-qty">{{$header_cart->quantity}}</span>
                                            x {{number_format($header_cart->price,2)}}
                                        </span>
                                    </div><!-- End .product-cart-details -->

                                    <figure class="product-image-container">
                                        <a href="{{url($getCartProduct->slug)}}" class="product-image">
                                            <img src="{{$getProductImage->getLogo()}}" alt="product">
                                        </a>
                                    </figure>
                                    <a href="{{url('cart/delete',$header_cart->id)}}" class="btn-remove" title="Remove Product"><i class="icon-close"></i></a>
                                </div>
                            @endif
                            @endforeach
                        </div><!-- End .cart-product -->

                        <div class="dropdown-cart-total">
                            <span>Total</span>

                            <span class="cart-total-price">${{number_format(Cart::getSubTotal(),2)}}</span>
                        </div><!-- End .dropdown-cart-total -->

                        <div class="dropdown-cart-action">
                            <a href="{{route('cart')}}" class="btn btn-primary">View Cart</a>
                            <a href="{{route('cart.checkout')}}" class="btn btn-outline-primary-2"><span>Checkout</span><i class="icon-long-arrow-right"></i></a>
                        </div><!-- End .dropdown-cart-total -->
                    </div><!-- End .dropdown-menu -->
                    @endif
                </div><!-- End .cart-dropdown -->
            </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div><!-- End .header-middle -->
</header><!-- End .header -->