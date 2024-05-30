@extends("admin.layouts.app")
@section('style')
    <style type="text/css">
        .form-group{
            margin-bottom:5px;
         }
    </style>
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <h1>Order Detail</h1>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">ID : <span style="font-weight: normal">{{$getRecord->id}}</span></label>
                        </div>
                        <div class="form-group">
                            <label for="">Transaction_id : <span style="font-weight: normal">{{$getRecord->transaction_id}}</span></label>
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
                            <label for="">Discount Amount($) : <span style="font-weight: normal">{{$getRecord->discount_amount}}</span></label>
                        </div>
                        <div class="form-group">
                            <label for="">Shipping Name : <span style="font-weight: normal">{{$getRecord->getShipping->name}}</span></label>
                        </div>
                        <div class="form-group">
                            <label for="">Shipping Amount($) : <span style="font-weight: normal">{{$getRecord->shipping_amount}}</span></label>
                        </div>
                        <div class="form-group">
                            <label for="">TotalAmount($) : <span style="font-weight: normal">{{$getRecord->total_amount}}</span></label>
                        </div>
                        <div class="form-group">
                            <label for="">Payment Method : <span style="font-weight: normal">{{$getRecord->payment_method}}</span></label>
                        </div>
                        <div class="form-group">
                            <label for="">Status : <span style="font-weight: normal">{{$getRecord->status}}</span></label>
                        </div>
                        <div class="form-group">
                            <label for="">Notes : <span style="font-weight: normal">{{$getRecord->note}}</span></label>
                        </div>
                        <div class="form-group">
                            <label for="">Create Date: <span style="font-weight: normal">{{date('d-m-Y',strtotime($getRecord->created_at))}}</span></label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
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
                            <th>Price</th>
                            <th>Size Name</th>
                            <th>Color Name</th>
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
                                    <td><a target="_blank" href="{{url($item->getProduct->slug)}}">{{$item->getProduct->title}}</a></td>
                                    <td>{{$item->quantity}}</td>
                                    <td>{{$item->price}}</td>
                                    <td>{{$item->size_name}}</td>
                                    <td>{{$item->color_name}}</td>
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
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
@section('javascript')
    
@endsection