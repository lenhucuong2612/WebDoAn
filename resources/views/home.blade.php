
@extends('layouts.app')
@section('content')
        <main class="main">
            <div class="intro-section bg-lighter pt-5 pb-6">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="intro-slider-container slider-container-ratio slider-container-1 mb-2 mb-lg-0">
                                <div class="intro-slider intro-slider-1 owl-carousel owl-simple owl-light owl-nav-inside" data-toggle="owl" data-owl-options='{
                                        "nav": false, 
                                        "responsive": {
                                            "768": {
                                                "nav": true
                                            }
                                        }
                                    }'>
                                    @foreach ($getSlider as $slider)
                                    <div class="intro-slide">
                                        <figure class="slide-image">
                                            <picture>
                                                <source media="(max-width: 480px)" srcset="assets/images/slider/slide-1-480w.jpg">
                                                <img src="{{$slider->getImage()}}" alt="Image Desc" >
                                            </picture>
                                        </figure><!-- End .slide-image -->

                                        <div class="intro-content">
                                            <h1 class="intro-title">{!! $slider->title !!}</h1><!-- End .intro-title -->
                                            @if (!empty($slider->button_name) && !empty($slider->button_link))
                                                <a href="{{$slider->button_link}}" class="btn btn-outline-white">
                                                    <span>{{$slider->button_name}}</span>
                                                    <i class="icon-long-arrow-right"></i>
                                                </a>
                                            @endif
                                        </div><!-- End .intro-content -->
                                    </div><!-- End .intro-slide -->
                                    @endforeach
                                </div><!-- End .intro-slider owl-carousel owl-simple -->
                                
                                <span class="slider-loader"></span><!-- End .slider-loader -->
                            </div><!-- End .intro-slider-container -->
                        </div><!-- End .col-lg-8 -->
                        
                    </div><!-- End .row -->
                    @if ($getPartnerLogo->count())
                    <div class="mb-6"></div><!-- End .mb-6 -->
                    <div class="owl-carousel owl-simple" data-toggle="owl" 
                        data-owl-options='{
                            "nav": false, 
                            "dots": false,
                            "margin": 30,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":2
                                },
                                "420": {
                                    "items":3
                                },
                                "600": {
                                    "items":4
                                },
                                "900": {
                                    "items":5
                                },
                                "1024": {
                                    "items":6
                                }
                            }
                        }'>
                        @foreach ($getPartnerLogo as $partner)
                            @if (!empty($partner->getImage()))
                                <a href="{{!empty($partner->button_link)?$partner->button_link:'#'}}" class="brand">
                                    <img src="{{$partner->getImage()}}" alt="Brand Name" >
                                </a>
                            @endif
                        @endforeach
                    </div><!-- End .owl-carousel -->
                    @endif
                </div><!-- End .container -->
            </div><!-- End .bg-lighter -->

            <div class="mb-6"></div><!-- End .mb-6 -->

            <div class="container">
                <div class="heading heading-center mb-3">
                    <h2 class="title-lg">Trendy Products</h2><!-- End .title -->
                </div><!-- End .heading -->

                <div class="tab-content tab-content-carousel">
                    
                        <div class="tab-pane p-0 fade show active" id="trendy-all-tab" role="tabpanel" aria-labelledby="trendy-all-link">
                            <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                                data-owl-options='{
                                    "nav": false, 
                                    "dots": true,
                                    "margin": 20,
                                    "loop": true,
                                    "responsive": {
                                        "0": {
                                            "items":2
                                        },
                                        "480": {
                                            "items":2
                                        },
                                        "768": {
                                            "items":3
                                        },
                                        "992": {
                                            "items":4
                                        },
                                        "1200": {
                                            "items":4,
                                            "nav": true,
                                            "dots": false
                                        }
                                    }
                                }'>
                                @if ($getProductTrendy->isNotEmpty())
                                @foreach ($getProductTrendy as $value)
                                        @php
                                        $getProductImage=$value->getIamgeSingle($value->id);
                                        $getFullProductImage=$value->getImageFull($value->id);
                                    @endphp
                                        <div class="product product-7 text-center">
                                            <figure class="product-media">
                                                @if (date_diff(date_create(date('d-m-Y')), date_create(date('d-m-Y', strtotime($value->created_at))))->days <= 7)
                                                <span class="product-label label-new">NEW</span>
                                                @elseif(!empty($value->old_price))
                                                @if ($value->old_price > $value->price)
                                                        <span class="product-label label-sale">{{($value->old_price-$value->price)/$value->old_price*100}}% OFF</span>
                                                @endif
                                                @endif
                                                <a href="{{url($value->slug)}}">
                                                    @if (!empty($getProductImage) && !empty($getProductImage->getLogo()))
                                                            <img  src="{{$getProductImage->getLogo()}}" alt="Product image" class="product-image">
                                                    @endif
                                                </a>
                                                <div class="product-action-vertical">
                                                    @if(!empty(Auth::check()))
                                                            <a href="javascript:;" data-toggle="modal" class="add_to_wishlist add_to_wishlist{{$value->id}} btn-product-icon btn-wishlist btn-expandable {{!empty($value->checkWishlist($value->id))?'btn-wishlist-add':''}}" id="{{$value->id}}" title="Wishlist"><span>Add to Wishlist</span></a>
                                                        @else
                                                        <a href="#signin-modal" data-toggle="modal" class="btn-product-icon btn-wishlist btn-expandable" title="Wishlist"><span>Add to Wishlist</span></a>
                                                        @endif
                                                </div><!-- End .product-action-vertical -->
                        
                                                <div class="product-action">
                                                    <a href="{{url($value->slug)}}" class="btn-product btn-cart"><span>add to cart</span></a>
                                                </div><!-- End .product-action -->
                                            </figure><!-- End .product-media -->
                        
                                            <div class="product-body">
                                                <div class="product-cat">
                                                    <a href="{{url($value->category_slug.'/'.$value->sub_category_slug)}}">{{$value->sub_category_name}}</a>
                                                </div><!-- End .product-cat -->
                                                <h3 class="product-title"><a href="{{url($value->slug)}}">{{$value->title}}</a></h3><!-- End .product-title -->
                                                <div class="product-price">
                                                ${{number_format($value->price,2)}}
                                                </div><!-- End .product-price -->
                                                <div class="ratings-container">
                                                    <div class="ratings">
                                                        <div class="ratings-val" style="width: {{$value->getReviewRaiting($value->id)}}%;"></div><!-- End .ratings-val -->
                                                    </div><!-- End .ratings -->
                                                    <span class="ratings-text">( {{$value->getTotalReview()}} Reviews )</span>
                                                </div><!-- End .rating-container -->
                        
                                                <div class="product-nav product-nav-thumbs">
                                                    @foreach($getFullProductImage as $value)
                                                        <a href="#" class="active">
                                                            <img src="{{$value->getLogo()}}" alt="product desc">
                                                        </a>
                                            @endforeach
                                            
                                        </div><!-- End .product-nav -->
                                    </div><!-- End .product-body -->
                                </div>
                                @endforeach
                                    
                                @endif
                            </div><!-- End .owl-carousel -->
                        </div>
                </div><!-- End .tab-content -->
            </div><!-- End .container -->
            @if (!empty($getCategory->count()))
    		<div class="container categories pt-6">
        		<h2 class="title-lg text-center mb-4">Shop by Categories</h2><!-- End .title-lg text-center -->

        		<div class="row">
        			@foreach ($getCategory as $category)
                    <div class="col-sm-12 col-lg-4 banners-sm">
            				@if (!empty($category->getImage()))
                                <div class="banner banner-display banner-link-anim col-lg-12 col-6">
                                    <a href="{{url($category->slug)}}">
                                        <img src="{{$category->getImage()}}" alt="{{$category->name}}" style="height: 300px">
                                    </a>

                                    <div class="banner-content banner-content-center">
                                        <h3 class="banner-title text-white"><a href="{{url($category->slug)}}">{{$category->name}}</a></h3><!-- End .banner-title -->
                                        @if (!empty($category->button_name))
                                        <a href="{{url($category->slug)}}" class="btn btn-outline-white banner-link">{{$category->button_name}}<i class="icon-long-arrow-right"></i></a>
                                        @endif
                                    </div><!-- End .banner-content -->
                                </div><!-- End .banner -->
                            @endif
        			</div><!-- End .col-sm-6 col-lg-3 -->
                    @endforeach
        		</div><!-- End .row -->
    		</div><!-- End .container -->
            @endif
            <div class="mb-5"></div><!-- End .mb-6 -->

            
            <div class="container">
                <div class="heading heading-center mb-6">
                    <h2 class="title">Recent Arrivals</h2><!-- End .title -->

                    <ul class="nav nav-pills nav-border-anim justify-content-center" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="top-all-link" data-toggle="tab" href="#top-all-tab" role="tab" aria-controls="top-all-tab" aria-selected="true">All</a>
                        </li>
                        @foreach ($getCategory as $category)
                        <li class="nav-item">
                            <a class="nav-link getCategoryProduct" data-val="{{$category->id}}" id="top-{{$category->slug}}-link" data-toggle="tab" href="#top-{{$category->slug}}-tab" role="tab" aria-controls="top-{{$category->slug}}-tab" aria-selected="false">{{$category->name}}</a>
                        </li>
                        @endforeach
                    </ul>
                </div><!-- End .heading -->

                <div class="tab-content">
                    <div class="tab-pane p-0 fade show active" id="top-all-tab" role="tabpanel" aria-labelledby="top-all-link">
                        <div class="products">
                            @php
                                $is_home=1;
                            @endphp
                            @include("product._listCate")
                        </div><!-- End .products -->
                        <div class="more-container text-center">
                            <a href="{{url('/search')}}" class="btn btn-outline-darker btn-more"><span>Load more products</span><i class="icon-long-arrow-down"></i></a>
                        </div><!-- End .more-container -->
                    </div><!-- .End .tab-pane -->
                   @foreach ($getCategory as $category)
                   <div class="tab-pane p-0 fade getCategoryProduct{{$category->id}}" id="top-{{$category->slug}}-tab" role="tabpanel" aria-labelledby="#top-{{$category->slug}}-link">
                    
                  </div><!-- .End .tab-pane -->
                   @endforeach
                </div>
            </div><!-- End .container -->

            <div class="container">
                <hr>
            	<div class="row justify-content-center">
                    <div class="col-lg-4 col-sm-6">
                        <div class="icon-box icon-box-card text-center">
                            <span class="icon-box-icon">
                                <i class="icon-rocket"></i>
                            </span>
                            <div class="icon-box-content">
                                <h3 class="icon-box-title">Payment & Delivery</h3><!-- End .icon-box-title -->
                                <p>Free shipping for orders over $50</p>
                            </div><!-- End .icon-box-content -->
                        </div><!-- End .icon-box -->
                    </div><!-- End .col-lg-4 col-sm-6 -->

                    <div class="col-lg-4 col-sm-6">
                        <div class="icon-box icon-box-card text-center">
                            <span class="icon-box-icon">
                                <i class="icon-rotate-left"></i>
                            </span>
                            <div class="icon-box-content">
                                <h3 class="icon-box-title">Return & Refund</h3><!-- End .icon-box-title -->
                                <p>Free 100% money back guarantee</p>
                            </div><!-- End .icon-box-content -->
                        </div><!-- End .icon-box -->
                    </div><!-- End .col-lg-4 col-sm-6 -->

                    <div class="col-lg-4 col-sm-6">
                        <div class="icon-box icon-box-card text-center">
                            <span class="icon-box-icon">
                                <i class="icon-life-ring"></i>
                            </span>
                            <div class="icon-box-content">
                                <h3 class="icon-box-title">Quality Support</h3><!-- End .icon-box-title -->
                                <p>Alway online feedback 24/7</p>
                            </div><!-- End .icon-box-content -->
                        </div><!-- End .icon-box -->
                    </div><!-- End .col-lg-4 col-sm-6 -->
                </div><!-- End .row -->

                <div class="mb-2"></div><!-- End .mb-2 -->
            </div><!-- End .container -->
            <div class="blog-posts pt-7 pb-7" style="background-color: #fafafa;">
                <div class="container">
                   <h2 class="title-lg text-center mb-3 mb-md-4">From Our Blog</h2><!-- End .title-lg text-center -->

                    <div class="owl-carousel owl-simple carousel-with-shadow" data-toggle="owl" 
                        data-owl-options='{
                            "nav": false, 
                            "dots": true,
                            "items": 3,
                            "margin": 20,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":1
                                },
                                "600": {
                                    "items":2
                                },
                                "992": {
                                    "items":3
                                }
                            }
                        }'>
                        @foreach ($getBlog as $item)
                            <article class="entry entry-display">
                                <figure class="entry-media">
                                    <a href="{{url('/blog/'.$item->slug)}}">
                                        <img src="{{$item->getImage()}}" alt="image desc">
                                    </a>
                                </figure><!-- End .entry-media -->

                                <div class="entry-body pb-4 text-center">
                                    <div class="entry-meta">
                                        <a href="{{url('/blog/'.$item->slug)}}">{{date('M d,Y',strtotime($item->created_at))}}</a>
                                    </div><!-- End .entry-meta -->

                                    <h3 class="entry-title">
                                        <a href="{{url('/blog/'.$item->slug)}}">{{$item->title}}</a>
                                    </h3><!-- End .entry-title -->

                                    <div class="entry-content">
                                        <p>{!! $item->description !!}</p>
                                        <a href="{{url('/blog/blog-category/'.$item->getCategory->slug)}}" class="read-more">Read More</a>
                                    </div><!-- End .entry-content -->
                                </div><!-- End .entry-body -->
                            </article><!-- End .entry -->
                        @endforeach
                    </div><!-- End .owl-carousel -->
                </div><!-- container -->

                <div class="more-container text-center mb-0 mt-3">
                    <a href="{{url('/blog/blog-category')}}" class="btn btn-outline-darker btn-more"><span>View more articles</span><i class="icon-long-arrow-right"></i></a>
                </div><!-- End .more-container -->
            </div>
            <div class="cta cta-display bg-image pt-4 pb-4" style="background-image: url(assets/images/backgrounds/cta/bg-6.jpg);">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-10 col-lg-9 col-xl-8">
                            <div class="row no-gutters flex-column flex-sm-row align-items-sm-center">
                                <div class="col">
                                    <h3 class="cta-title text-white">Sign Up & Get 10% Off</h3><!-- End .cta-title -->
                                    <p class="cta-desc text-white">Molla presents the best in interior design</p><!-- End .cta-desc -->
                                </div><!-- End .col -->

                                <div class="col-auto">
                                    <a href="login.html" class="btn btn-outline-white"><span>SIGN UP</span><i class="icon-long-arrow-right"></i></a>
                                </div><!-- End .col-auto -->
                            </div><!-- End .row no-gutters -->
                        </div><!-- End .col-md-10 col-lg-9 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .cta -->
        </main><!-- End .main -->
@endsection
@section('script')

<script type="text/javascript">
    $('body').delegate('.getCategoryProduct','click',function(){
        var category_id=$(this).attr('data-val');
        console.log(category_id)
        $.ajax({
            url:"{{url('recent_arrival_category_product')}}",
            type:'post',
            data:{
                "_token":"{{csrf_token()}}",
                category_id:category_id,
            },
            dataType:'json',
            success:function(response){
                $('.getCategoryProduct'+category_id).html(response.success)
            }
        })
    })
</script>
@endsection