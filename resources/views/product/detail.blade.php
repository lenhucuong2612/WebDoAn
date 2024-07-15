@extends('layouts.app')
@section('style')

<link rel="stylesheet" href="{{asset('assets/css/plugins/nouislider/nouislider.css')}}">
@endsection
@section('content')
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container d-flex align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{url($getProduct->getSubCategory->getCategory->slug)}}">{{$getProduct->getSubCategory->getCategory->name}}</a></li>
                <li class="breadcrumb-item"><a href="{{url($getProduct->getSubCategory->getCategory->slug .'/'.$getProduct->getSubCategory->slug)}}">{{$getProduct->getSubCategory->name}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$getProduct->title}}</li>
            </ol>

            
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="product-details-top mb-2">
                <div class="row">
                    <div class="col-md-6">
                        <div class="product-gallery">
                            <figure class="product-main-image">
                                @php
                                    $getProductImage=$getProduct->getIamgeSingle($getProduct->id)
                                @endphp
                                @if (!empty($getProductImage) && !empty($getProductImage->getLogo()))
                                    <img  id="product-zoom" src="{{$getProductImage->getLogo()}}" data-zoom-image="{{$getProductImage->getLogo()}}" alt="product image">

                                    <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                        <i class="icon-arrows"></i>
                                    </a>    
                                @endif
                            </figure><!-- End .product-main-image -->

                            <div id="product-zoom-gallery" class="product-image-gallery">
                                @foreach ($getProduct->getImage as $image)
                                <a class="product-gallery-item" href="#" data-image="{{$image->getLogo()}}" data-zoom-image="{{$image->getLogo()}}">
                                    <img  src="{{$image->getLogo()}}" alt="product side">
                                </a>
                                @endforeach
                            </div><!-- End .product-image-gallery -->
                        </div><!-- End .product-gallery -->
                    </div><!-- End .col-md-6 -->

                    <div class="col-md-6">
                        <div class="product-details">
                            <h1 class="product-title">{{$getProduct->title}}</h1><!-- End .product-title -->

                            <div class="ratings-container">
                                <div class="ratings">
                                    <div class="ratings-val" style="width: {{$getProduct->getReviewRaiting($getProduct->id)}}%;"></div><!-- End .ratings-val -->
                                </div><!-- End .ratings -->
                                <a class="ratings-text" href="#product-review-link" id="review-link">( {{$getProduct->getTotalReview() }} Reviews )</a>
                            </div><!-- End .rating-container -->

                            <div class="product-price">
                                $<span id="getTotalprice">{{number_format($getProduct->price,2)}}</span>
                            </div><!-- End .product-price -->

                            <div class="product-content">
                                <p>{{$getProduct->short_description}}</p>
                            </div><!-- End .product-content -->

                            <form action="{{route('product.add-to-cart')}}" method="post">
                                @csrf
                                <input type="hidden" name="product_id" value="{{$getProduct->id}}">
                                @if(!empty($getProduct->getColor->count()))
                                <div class="details-filter-row details-row-size">
                                    <label>Color:</label>
                                    <div class="select-custom">
                                        <select name="color_id" id="color_id" required class="form-control">
                                            <option value="" >Select a color</option>
                                            @foreach ($getProduct->getColor as $color)
                                                <option value="{{$color->getColor->id}}">{{$color->getColor->name}}</option>
                                            @endforeach
                                        </select>
                                    </div><!-- End .select-custom -->
                                </div><!-- End .details-filter-row -->
                                @endif

                                @if(!empty($getProduct->getSize->count()))
                                <div class="details-filter-row details-row-size">
                                    <label for="size">Size:</label>
                                    <div class="select-custom">
                                        <select name="size_id" id="size" required class="form-control getSizePrice getCheckAmount">
                                            <option data-price="0" value="">Select a size</option>
                                            @foreach ($getProduct->getSize as $size)
                                                <option data-price="{{!empty($size->price)?$size->price:0}}" value="{{$size->id}}">{{$size->name}} @if(!empty($size->price)) (${{number_format($size->price,2)}}) @endif</option>
                                            @endforeach>
                                        </select>
                                    </div><!-- End .select-custom -->

                                    <a href="#" class="size-guide"><i class="icon-th-list"></i>size guide</a>
                                </div><!-- End .details-filter-row -->
                                @endif
                                <div class="details-filter-row details-row-size">
                                    <label for="qty">Qty:</label>
                                    <div class="product-details-quantity">
                                        <input type="number" id="qty" class="form-control" required  name="qty" value="1" min="1" max="100" step="1" data-decimals="0" required>
                                    </div><!-- End .product-details-quantity -->
                                    <p style="color:red">{{$errors->first('qty')}}</p>
                                </div><!-- End .details-filter-row -->
                                <div class="details-filter-row details-row-size">
                                    <label for="amount">Amount:</label>
                                    <div class="product-details-quantity">
                                        <input type="text" value="{{$getProduct->quantity}}" class="form-control"   name="amount" id="amountInput">
                                    </div><!-- End .product-details-quantity -->
                                </div><!-- End .details-filter-row -->
                                <div class="product-details-action">
                                    <button type="submit" class="btn-product btn-cart">Add to cart</button>

                                    <div class="details-action-wrapper">
                                        @if(!empty(Auth::check()))

                                           <a href="javascript:;" class="add_to_wishlist add_to_wishlist{{$getProduct->id}} {{!empty($getProduct->checkWishlist($getProduct->id))?'btn-wishlist-add':''}}  btn-product btn-wishlist " id="{{$getProduct->id}}" title="Wishlist"><span>Add to Wishlist</span></a>
                                        @else
                                        <a href="#signin-modal" data-toggle="modal" class="btn-product btn-wishlist" title="Wishlist"><span>Add to Wishlist</span></a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                            <div class="product-details-footer">
                                <div class="product-cat">
                                    <span>Category:</span>
                                    <a href="{{url($getProduct->getSubCategory->getCategory->slug)}}">{{$getProduct->getSubCategory->getCategory->name}}</a>,
                                    <a href="{{url($getProduct->getSubCategory->getCategory->slug .'/'.$getProduct->getSubCategory->slug)}}">{{$getProduct->getSubCategory->name}}</a>
                                </div><!-- End .product-cat -->

                                <div class="social-icons social-icons-sm">
                                    <span class="social-label">Share:</span>
                                    <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                    <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                    <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                    <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                                </div>
                            </div><!-- End .product-details-footer -->
                        </div><!-- End .product-details -->
                    </div><!-- End .col-md-6 -->
                </div><!-- End .row -->
            </div><!-- End .product-details-top -->
        </div><!-- End .container -->

        <div class="product-details-tab product-details-extended">
            <div class="container">
                <ul class="nav nav-pills justify-content-center" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab" aria-controls="product-desc-tab" aria-selected="true">Description</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product-info-link" data-toggle="tab" href="#product-info-tab" role="tab" aria-controls="product-info-tab" aria-selected="false">Additional information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product-shipping-link" data-toggle="tab" href="#product-shipping-tab" role="tab" aria-controls="product-shipping-tab" aria-selected="false">Shipping & Returns</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab" role="tab" aria-controls="product-review-tab" aria-selected="false">Reviews ({{$getProduct->getTotalReview() }})</a>
                    </li>
                </ul>
            </div><!-- End .container -->

            <div class="tab-content">
                <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
                    <div class="product-desc-content">
                        <div class="container" style="margin-top:20px;">
                            {!! $getProduct->description !!}
                        </div><!-- End .container -->
                    </div><!-- End .product-desc-content -->
                </div><!-- .End .tab-pane -->
                <div class="tab-pane fade" id="product-info-tab" role="tabpanel" aria-labelledby="product-info-link">
                    <div class="product-desc-content" style="margin-top:20px;">
                        <div class="container">
                            {!! $getProduct->additional_information !!}
                        </div><!-- End .container -->
                    </div><!-- End .product-desc-content -->
                </div><!-- .End .tab-pane -->
                <div class="tab-pane fade" id="product-shipping-tab" role="tabpanel" aria-labelledby="product-shipping-link">
                    <div class="product-desc-content" style="margin-top:20px;">
                        <div class="container">
                            {!! $getProduct->shipping_returns !!}
                        </div><!-- End .container -->
                    </div><!-- End .product-desc-content -->
                </div><!-- .End .tab-pane -->
                <div class="tab-pane fade" id="product-review-tab" role="tabpanel" aria-labelledby="product-review-link">
                    <div class="reviews">
                        <div class="container">
                            <h3>Reviews ({{$getProduct->getTotalReview() }})</h3>
                           @foreach ($getReviewProduct as $review)
                           <div class="review">
                                <div class="row no-gutters">
                                    <div class="col-auto">
                                        <h4>{{$review->name}}</h4>
                                        <div class="ratings-container">
                                            <div class="ratings">
                                                <div class="ratings-val" style="width: {{$review->getPercent()}}%;"></div><!-- End .ratings-val -->
                                            </div><!-- End .ratings -->
                                        </div><!-- End .rating-container -->
                                        <span class="review-date">
                                            {{Carbon\Carbon::parse($review->created_at)->diffForHumans()}}
                                        </span>
                                    </div><!-- End .col -->
                                    <div class="col">
                                        <h4>{{$review->review}}</h4>
                                    </div><!-- End .col-auto -->
                                </div><!-- End .row -->
                            </div><!-- End .review -->
                           @endforeach
                           <div>
                            {{$getProduct->links}}
                        </div>
                        </div><!-- End .container -->
                    </div><!-- End .reviews -->
                </div><!-- .End .tab-pane -->
            </div><!-- End .tab-content -->
        </div><!-- End .product-details-tab -->

        <div class="container">
            <h2 class="title text-center mb-4">You May Also Like</h2><!-- End .title text-center -->
            <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                data-owl-options='{
                    "nav": false, 
                    "dots": true,
                    "margin": 20,
                    "loop": false,
                    "responsive": {
                        "0": {
                            "items":1
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
                @foreach ($getRelatedProduct as $product)
                @php
                    $getProductImage=$product->getIamgeSingle($product->id);
                @endphp
                    <div class="product product-7">
                        <figure class="product-media">
                            @if (!empty($getProductImage) && !empty($getProductImage->getLogo()))
                                <a href="{{url($product->slug)}}">
                                    <img style="height:280px;width:100%;object-fit:cover" src="{{$getProductImage->getLogo()}}" alt="Product image" class="product-image">
                                </a>
                            @endif
                            <div class="product-action-vertical">
                                @if(!empty(Auth::check()))
                                    <a href="javascript:;" data-toggle="modal" class="add_to_wishlist add_to_wishlist{{$product->id}} btn-product-icon btn-wishlist btn-expandable {{!empty($product->checkWishlist($product->id))?'btn-wishlist-add':''}}" id="{{$product->id}}" title="Wishlist"><span>Add to Wishlist</span></a>
                                @else
                                <a href="#signin-modal" data-toggle="modal" class="btn-product btn-wishlist btn-expandable" title="Wishlist"><span>Add to Wishlist</span></a>
                                @endif
                                <a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                                <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                            </div><!-- End .product-action-vertical -->

                            <div class="product-action">
                                <a href="" class="btn-product btn-cart"><span>add to cart</span></a>
                            </div><!-- End .product-action -->
                        </figure><!-- End .product-media -->

                        <div class="product-body">
                            <div class="product-cat">
                                <a href="{{url($product->category_slug.'/'.$product->sub_category_slug)}}">{{$product->sub_category_name}}</a>
                            </div><!-- End .product-cat -->
                            <h3 class="product-title"><a href=" {{url($product->slug)}}">{{$product->title}}</a></h3><!-- End .product-title -->
                            <div class="product-price">
                                ${{number_format($product->price)}}
                            </div><!-- End .product-price -->
                            <div class="ratings-container">
                                <div class="ratings">
                                    <div class="ratings-val" style="width: {{$product->getReviewRaiting($product->id)}}%;"></div><!-- End .ratings-val -->
                                </div><!-- End .ratings -->
                                <span class="ratings-text">( {{$product->getTotalReview()}} Reviews )</span>
                            </div><!-- End .rating-container -->
    

                        
                        </div><!-- End .product-body -->
                    </div><!-- End .product -->
                @endforeach

            </div><!-- End .owl-carousel -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
@if(session('message'))
    <script>
        // Lấy thông báo từ session và hiển thị alert
        let message = {!! json_encode(session('message')) !!};
        alert(message);
    </script>
@endif


@endsection
@section('script')
<script src="{{asset('assets/js/bootstrap-input-spinner.js')}}"></script>
<script src="{{asset('assets/js/jquery.elevateZoom.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap-input-spinner.js')}}"></script>
<script src="{{asset('assets/js/jquery.magnific-popup.min.js')}}"></script>

<script type="text/javascript">
    $('.getSizePrice').change(function(){
        var product_price='{{$getProduct->price}}';
        var price=$('option:selected',this).attr('data-price');
        var total=parseFloat(product_price)+parseFloat(price);
        $('#getTotalprice').html(total.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
    })

    $('body').delegate('.getCheckAmount','click',function(){
        var size_id=$(this).val();
        var name='{{$size->name}}';
        
        var data = []; // Khai báo và khởi tạo mảng
        data.push({ size_id: size_id, name: name }); // Thêm phần tử vào mảng
        console.log(data);
        $.ajax({
            url:"{{url('seen_quantity_product_of_size')}}",
            type:'post',
            data:{
                "_token":"{{csrf_token()}}",
                data:data,
            },
            dataType:'json',
            success: function(response) {
                if (response.success) {
                var amount = response.amount;
                $('#amountInput').val(amount);
            } else {
                // Xử lý trường hợp không thành công (response.success === false)
                console.log('Failed to fetch amount.');
            }
        // Xử lý dữ liệu JSON nhận được từ server
    },
        })
    })
</script>
@endsection