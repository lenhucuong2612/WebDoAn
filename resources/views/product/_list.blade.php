<div class="products mb-3">
    <div class="row justify-content-center">
        @foreach ($getProduct as $value)
        @php
            $getProductImage=$value->getIamgeSingle($value->id);
            $getFullProductImage=$value->getImageFull($value->id);
        @endphp
            <div class="col-12 col-md-4 col-lg-4">
                <div class="product product-7 text-center">
                    <figure class="product-media">
                        <a href="{{url($value->slug)}}">
                            @if (!empty($getProductImage) && !empty($getProductImage->getLogo()))
                                    <img  src="{{$getProductImage->getLogo()}}" alt="Product image" class="product-image">
                            @endif
                        </a>
                        <div class="product-action-vertical">
                            @if(!empty(Auth::check()))
                                    <a href="javascript:;" data-toggle="modal" class="add_to_wishlist add_to_wishlist{{$value->id}} btn-product-icon btn-wishlist btn-expandable {{!empty($value->checkWishlist($value->id))?'btn-wishlist-add':''}}" id="{{$value->id}}" title="Wishlist"><span>Add to Wishlist</span></a>
                                @else
                                <a href="#signin-modal" data-toggle="modal" class="btn-product btn-wishlist btn-expandable" title="Wishlist"><span>Add to Wishlist</span></a>
                                @endif
                            <a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                            <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                        </div><!-- End .product-action-vertical -->

                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
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
                </div><!-- End .product -->
            </div>
        @endforeach
        
       
    </div><!-- End .row -->
</div><!-- End .products -->
{{--
    <div class="justify-content-center">
    {{$getProduct->links()}}
</div>
--}}
