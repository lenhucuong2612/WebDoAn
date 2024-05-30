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
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">Order Detail</h1>
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
                        @include('_message')
                        <div class="tab-content">
                            <div class="container">
               
                                <form action="" id="SubmitForm" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-9">
                                            <h2 class="checkout-title" style="margin-top:0px">Profile Details</h2><!-- End .checkout-title -->
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label>First Name *</label>
                                                        <input type="text" name="first_name" value="{{explode(' ',$getRecord->name)[0]}}" class="form-control" >
                                                    </div><!-- End .col-sm-6 -->
                
                                                    <div class="col-sm-6">
                                                        <label>Last Name *</label>
                                                        <input type="text" name="last_name" value="{{explode(' ',$getRecord->name)[1]}}" class="form-control" >
                                                    </div><!-- End .col-sm-6 -->
                                                </div><!-- End .row -->
                
                                                <label>Company Name (Optional)</label>
                                                <input type="text" name="company_name" value="{{$getRecord->company_name}}" class="form-control">
                
                                                <label>Country *</label>
                                                <input type="text" name="country" value="{{$getRecord->country}}" class="form-control" >
                
                                                <label>Street address *</label>
                                                <input type="text" name="address_one" value="{{$getRecord->address_one}}" class="form-control" placeholder="House number and Street name" >
                                                <input type="text" name="address_two" value="{{$getRecord->address_two}}" class="form-control" placeholder="Appartments, suite, unit etc ..." >
                
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label>Town / City *</label>
                                                        <input type="text" name="city" value="{{$getRecord->city}}" class="form-control" >
                                                    </div><!-- End .col-sm-6 -->
                
                                                    <div class="col-sm-6">
                                                        <label>State / County *</label>
                                                        <input type="text" name="state" value="{{$getRecord->state}}" class="form-control" >
                                                    </div><!-- End .col-sm-6 -->
                                                </div><!-- End .row -->
                
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label>Postcode / ZIP *</label>
                                                        <input type="text" name="postcode" value="{{$getRecord->postcode}}" class="form-control" >
                                                    </div><!-- End .col-sm-6 -->
                
                                                    <div class="col-sm-6">
                                                        <label>Phone *</label>
                                                        <input type="tel" name="phone" value="{{$getRecord->phone}}" class="form-control" >
                                                    </div><!-- End .col-sm-6 -->
                                                </div><!-- End .row -->
                                                <button type="submit" style="width:100px" class="btn btn-outline-primary-2 btn-order btn-block">
                                                    Submit
                                                </button>
                                        </div><!-- End .col-lg-9 -->
                                    </div><!-- End .row -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .dashboard -->
    </div><!-- End .page-content -->
</main>
@endsection
@section('script')
@endsection