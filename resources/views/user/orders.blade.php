@extends('layouts.app')
@section('content')
<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">My Account<span>Shop</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">My Account</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="dashboard">
            <div class="container">
                <div class="row">
                   @include('user.slidebar')
                    <div class="col-md-8 col-lg-9">
                        <div class="tab-content">
                            <table class="table table-striped" >
                                <thead>
                                  <tr>
                                    <th>Order Number</th>
                                    <th>TotalAmount</th>
                                    <th>Payment Method</th>
                                    <th>Status</th>
                                    <th>Create Date</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @if ($getRecord->isNotEmpty())
                                      @foreach ($getRecord as $value)
                                          <tr  class="active">
                                            <td>{{$value->order_number}}</td>
                                            <td>${{number_format($value->total_amount,2)}}</td>
                                            <td>{{$value->payment_method}}</td>
                                            <td>
                                                @if($value->status=='0')
                                                   Pedding
                                                @elseif($value->status=='1')
                                                   In Progress
                                                @elseif($value->status=='2')
                                                   Delivered
                                                @elseif($value->status=='3')
                                                   Completed
                                                @elseif($value->status=='4')
                                                   Cancelled
                                                @endif
                                            </td>
                                            <td>{{date('d-m-Y',strtotime($value->created_at))}}</td>
                                            <td>
                                              <a href="{{route("user.order.detail",$value->id)}}"  class="btn btn-primary">Detail</a>
                                            </td>
                                          </tr>
                                      @endforeach
                                  @else
                                      <tr rowspan="9">List admin null</tr>
                                  @endif
                                </tbody>
                              </table>
                        </div>
                    </div><!-- End .col-lg-9 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .dashboard -->
    </div><!-- End .page-content -->
</main>
@endsection
@section('script')
@endsection