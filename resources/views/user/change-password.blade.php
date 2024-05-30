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
                        <div class="tab-content">
                            @include('_message')
                            <div class="container">
                                <form action="" id="SubmitForm" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-9">
                                            <label>Old Password</label>
                                            <input type="password" name="old_password"  class="form-control @if($errors->has('old_password')) is-invalid @endif" >
                                            <p class="invalid-feedback">{{$errors->first('old_password')}}</p>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label>Password</label>
                                                    <input type="password" name="password" class="form-control @if($errors->has('password')) is-invalid @endif" >
                                                    <p class="invalid-feedback">{{$errors->first('password')}}</p>
                                                </div><!-- End .col-sm-6 -->
            
                                                <div class="col-sm-6">
                                                    <label>Confirm Password</label>
                                                    <input type="password" name="confirm_password" class="form-control @if($errors->has('confirm_password')) is-invalid @endif" >
                                                    <p class="invalid-feedback">{{$errors->first('confirm_password')}}</p>
                                                </div><!-- End .col-sm-6 -->
                                                
                                            </div>
                                            <button type="submit" style="width:100px" class="btn btn-outline-primary-2 btn-order btn-block">
                                                Submit
                                            </button>
                                        </div>
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