<div class="products mb-3">
    <div class="row justify-content-center">
        @if ($getProduct->count()==0)
            <p>No product</p>
        @else
            
        @foreach ($getProduct as $value)
        @php
            $getProductImage=$value->getIamgeSingle($value->id);
            $getFullProductImage=$value->getImageFull($value->id);
        @endphp
            <div class="col-12 @if(!empty($is_home)) col-md-3 col-lg-3 @else col-md-4 col-lg-4  @endif">
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
                </div><!-- End .product -->
            </div>
        @endforeach
        @endif
        
       
    </div><!-- End .row -->
</div><!-- End .products -->
<div>
    {{$getProduct->links()}}
</div>

