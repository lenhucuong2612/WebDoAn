@extends('layouts.app')
@section('style')
    <style type="text/css">
        .form-group{
            margin-bottom:5px;
         }
    </style>
    
@endsection
@section('content')
<main class="main">
    <div class="page-header text-center" style="background-image: {{url('assets/images/page-header-bg.jpg')}}">
        <div class="container">
            <h1 class="page-title">Order Detail</h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
   
    <div class="page-content">
        <div class="dashboard">
            <div class="container">
                <div class="row">
                   @include('user.slidebar')
                    <div class="col-md-8 col-lg-9">
                        <div class="tab-content" style="margin-top: 10px">
                            @include('_message')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">ID : <span style="font-weight: normal">{{$getRecord->order_number}}</span></label>
                                </div>
                                <div class="form-group">
                                    <label for="">Name : <span style="font-weight: normal">{{$getRecord->first_name}} {{$getRecord->last_name}}</span></label>
                                </div>
                                <div class="form-group">
                                    <label for="">Company Name : <span style="font-weight: normal">{{$getRecord->company_name}}</span></label>
                                </div>
                                <div class="form-group">
                                    <label for="">Country : <span style="font-weight: normal">{{$getRecord->country}}</span></label>
                                </div>
                                <div class="form-group">
                                    <label for="">Address:<span style="font-weight: normal"> {{$getRecord->address_one}} / {{$getRecord->address_two}}</span></label>
                                </div>
                                <div class="form-group">
                                    <label for="">City : <span style="font-weight: normal">{{$getRecord->city}}</span></label>
                                </div>
                                <div class="form-group">
                                    <label for="">State : <span style="font-weight: normal">{{$getRecord->state}}</span></label>
                                </div>
                                <div class="form-group">
                                    <label for="">Postcode : <span style="font-weight: normal">{{$getRecord->postcode}}</span></label>
                                </div>
                                <div class="form-group">
                                    <label for="">Phone: <span style="font-weight: normal">{{$getRecord->phone}}</span></label>
                                </div>
                                <div class="form-group">
                                    <label for="">Email : <span style="font-weight: normal">{{$getRecord->email}}</span></label>
                                </div>
                                <div class="form-group">
                                    <label for="">Discount Code : <span style="font-weight: normal">{{$getRecord->discount_code}}</span></label>
                                </div>
                                <div class="form-group">
                                    <label for="">Discount Amount($) : <span style="font-weight: normal">{{number_format($getRecord->discount_amount,2)}}</span></label>
                                </div>
                                <div class="form-group">
                                    <label for="">Shipping Name : <span style="font-weight: normal">{{$getRecord->getShipping->name}}</span></label>
                                </div>
                                <div class="form-group">
                                    <label for="">Shipping Amount($) : <span style="font-weight: normal">{{number_format($getRecord->shipping_amount,2)}}</span></label>
                                </div>
                                <div class="form-group">
                                    <label for="">TotalAmount($) : <span style="font-weight: normal">{{number_format($getRecord->total_amount,2)}}</span></label>
                                </div>
                                <div class="form-group">
                                    <label for="">Payment Method : <span style="font-weight: normal">{{$getRecord->payment_method}}</span></label>
                                </div>
                                <div class="form-group">
                                    <label for="">Status : 
                                        @if($getRecord->status=='0')
                                        Pedding
                                     @elseif($getRecord->status=='1')
                                        In Progress
                                     @elseif($getRecord->status=='2')
                                        Delivered
                                     @elseif($getRecord->status=='3')
                                        Completed
                                     @elseif($getRecord->status=='4')
                                        Cancelled
                                     @endif
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="">Notes : <span style="font-weight: normal">{{$getRecord->note}}</span></label>
                                </div>
                                <div class="form-group">
                                    <label for="">Create Date: <span style="font-weight: normal">{{date('d-m-Y',strtotime($getRecord->created_at))}}</span></label>
                                </div>
                            </div>
                        </div>
                    </div><!-- End .col-lg-9 -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header" style="margin-top:20px">
                              <h3 class="card-title">Orders List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0" style="overflow: auto">
                              <table class="table table-striped" >
                                <thead>
                                  <tr>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>QTY</th>
                                    <th>Price($)</th>
                                    <th>Size Amount($)</th>
                                    <th>Total Amount($)</th>
                                  </tr>
                                </thead>
                                      @foreach ($getRecord->getItem as $item)
                                      @php
                                          $getProductImage=$item->getProduct->getIamgeSingle($item->getProduct->id);
                                      @endphp
                                          <tr>
                                            <td>
                                                <img style="width:100px;height:100px;" src="{{$getProductImage->getLogo()}}" alt="">
                                            </td>
                                            <td style="max-witdh:250px">
                                                <a target="_blank" href="{{url($item->getProduct->slug)}}">{{$item->getProduct->title}}</a>
                                                <br>
                                                Color Name: {{$item->color_name}} <br>
                                                Size Name: {{$item->size_name}} <br>
                                                @if ($getRecord->status==3)
                                                    @php
                                                     $getReview=$item->getReview($item->getProduct->id,$getRecord->id);
                                                    @endphp
                                                    @if (!@empty($getReview))
                                                    How many raiting: {{$getReview->raiting}} <br>
                                                    Review: {{$getReview->review}} <br>
                                                    @else
                                                    <button class="btn btn-primary MakeReview" id="{{$item->getProduct->id}}" data-order={{$getRecord->id}}>Make Reviews</button>
                                                    @endif
                                                @endif
                                            </td>
                                            <td>{{$item->quantity}}</td>
                                            <td>{{number_format($item->price,2)}}</td>
                                            <td>{{number_format($item->size_amount,2)}}</td>
                                            <td>{{number_format($item->total_price,2)}}</td>
                                          </tr>
                                      @endforeach
                                </tbody>
                              </table>
                            </div>
                            <!-- /.card-body -->
                          </div>
                    </div>
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .dashboard -->
    </div><!-- End .page-content -->
</main>

  <!-- Modal -->
  <div class="modal fade" id="MakeReviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
        <form action="{{url('user/make-reivew')}}" method="post">
            @csrf
            <input type="hidden" required id="getProductId" name="product_id">
            <input type="hidden" required id="getOrderId" name="order_id">
            <div class="modal-body" style="padding: 20px">
                <div class="form-group" style="margin-top:15px">
                 <label for=""> How many star?</label>
                 <select class="form-control" name="raiting" >
                   <option value="0">Select</option>
                   <option value="1">1</option>
                   <option value="2">2</option>
                   <option value="3">3</option>
                   <option value="4">4</option>
                   <option value="5">5</option>
                 </select>
                </div>
                <div class="form-group">
                  <label for="">Reviews</label>
                  <textarea class="form-control" name="review"></textarea>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
        </form>
        
      </div>
    </div>
  </div>
@endsection
@section('script')
<script type="text/javascript">
    $('body').delegate('.MakeReview','click',function(){
        var product_id=$(this).attr('id')
        var order_id=$(this).attr('data-order')
        $('#getProductId').val(product_id)
        $('#getOrderId').val(order_id)
        $('#MakeReviewModal').modal('show')
    })
</script>
@endsection