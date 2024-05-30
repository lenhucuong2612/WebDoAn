
@extends('layouts.app')
@section('content')
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active" aria-current="page">Contact us</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->
    <div class="container">
        <div class="page-header page-header-big text-center" style="background-image: url('{{$getPage->getImage()}}')">
            <h1 class="page-title text-white">{{$getPage->title}}<span class="text-white">keep in touch with us</span></h1>
        </div><!-- End .page-header -->
    </div><!-- End .container -->

    <div class="page-content pb-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-2 mb-lg-0">
                    {!!$getPage->description!!}
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="contact-info">
                                <h3>The Office</h3>
                                
                                <ul class="contact-list">
                                    @if (!empty($getSystemSettingApp->address))
                                        <li>
                                            <i class="icon-map-marker"></i>
                                            {{$getSystemSettingApp->address}}
                                        </li>
                                    @endif
                                    @if (!empty($getSystemSettingApp->phone))
                                        <li>
                                            <i class="icon-phone"></i>
                                            <a href="tel:{{$getSystemSettingApp->phone}}">{{$getSystemSettingApp->phone}}</a>
                                        </li>
                                    @endif
                                    @if (!empty($getSystemSettingApp->phone_two))
                                        <li>
                                            <i class="icon-phone"></i>
                                            <a href="tel:#">{{$getSystemSettingApp->phone_two}}</a>
                                        </li>
                                    @endif
                                    @if (!empty($getSystemSettingApp->email))
                                        <li>
                                            <i class="icon-envelope"></i>
                                            <a href="mailto:#">{{$getSystemSettingApp->email}}</a>
                                        </li>
                                    @endif
                                    @if (!empty($getSystemSettingApp->email_two))
                                        <li>
                                            <i class="icon-envelope"></i>
                                            <a href="mailto:#">{{$getSystemSettingApp->email_two}}</a>
                                        </li>
                                    @endif
                                    
                                </ul><!-- End .contact-list -->
                            </div><!-- End .contact-info -->
                        </div><!-- End .col-sm-7 -->

                        <div class="col-sm-5">
                            <div class="contact-info">
                                <h3>The Office</h3>

                                <ul class="contact-list">
                                    <li>
                                        <i class="icon-clock-o"></i>
                                        <span class="text-dark">{!! nl2br(e($getSystemSettingApp->working_hour)) !!}</span> 
                                    </li>
                                </ul><!-- End .contact-list -->
                            </div><!-- End .contact-info -->
                        </div><!-- End .col-sm-5 -->
                    </div><!-- End .row -->
                </div><!-- End .col-lg-6 -->
                <div class="col-lg-6">
                    <h2 class="title mb-1">Got Any Questions?</h2><!-- End .title mb-2 -->
                    <p class="mb-2">Use the form below to get in touch with the sales team</p>
                    <div style="padding:10px 0">
                        @include('_message')
                    </div>
                    <form action="" class="contact-form mb-3" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="cname" class="sr-only">Name</label>
                                <input type="text" class="form-control" id="cname" name="name" placeholder="Name *" required>
                            </div><!-- End .col-sm-6 -->

                            <div class="col-sm-6">
                                <label for="cemail" class="sr-only">Email</label>
                                <input type="email" class="form-control" id="cemail" name="email" placeholder="Email *" required>
                            </div><!-- End .col-sm-6 -->
                        </div><!-- End .row -->

                        <div class="row">
                            <div class="col-sm-6">
                                <label for="cphone" class="sr-only">Phone</label>
                                <input type="tel" class="form-control" id="cphone" name="phone" placeholder="Phone">
                            </div><!-- End .col-sm-6 -->

                            <div class="col-sm-6">
                                <label for="csubject" class="sr-only">Subject</label>
                                <input type="text" class="form-control" id="csubject" name='subject' placeholder="Subject">
                            </div><!-- End .col-sm-6 -->
                        </div><!-- End .row -->

                        <label for="cmessage" class="sr-only">Message</label>
                        <textarea class="form-control" cols="30" rows="4" id="cmessage" name="message" required placeholder="Message *"></textarea>
                        <div class="row">
                            <div class="col-sm-12">
                                <label for="verification">{{$first_number}} + {{$second_number}}=?</label>
                                <input type="number" class="form-control" id="verification" name='verification' placeholder="Verification Sum">
                            </div><!-- End .col-sm-6 -->
                        </div><!-- End .row -->

                        <button type="submit" class="btn btn-outline-primary-2 btn-minwidth-sm">
                            <span>SUBMIT</span>
                            <i class="icon-long-arrow-right"></i>
                        </button>
                    </form><!-- End .contact-form -->
                </div><!-- End .col-lg-6 -->
            </div><!-- End .row -->

           
        </div>
    </div><!-- End .page-content -->
</main><!-- End .main -->
@endsection