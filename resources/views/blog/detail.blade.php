
@extends('layouts.app')
@section('content')
<main class="main">
    <div class="page-header text-center" style="background-image: url('{{asset('assets/images/page-header-bg.jpg')}}')">
        <div class="container">
            <h1 class="page-title">{{$getBlog->title}}<span>Single Post</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('blog')}}">Blog</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$getBlog->title}}</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <article class="entry single-entry">
                        <figure class="entry-media">
                            <img src="{{$getBlog->getImage()}}" alt="{{$getBlog->title}}">
                        </figure><!-- End .entry-media -->

                        <div class="entry-body">
                            <div class="entry-meta">
                                <span class="meta-separator">|</span>
                                <a href="#">{{date('M d, Y', strtotime($getBlog->created_at))}}</a>
                                
                                <span class="meta-separator">|</span>
                                @if (!empty($getBlog->getCategory->title))
                                <a href="{{url('blog/category')}}">{{$getBlog->getCategory->name}}</a>
                                @endif
                            </div><!-- End .entry-meta -->
                            <div class="entry-content editor-content">
                               {!! $getBlog->description !!}
                            </div><!-- End .entry-content -->

                        </div><!-- End .entry-body -->

                      
                    </article><!-- End .entry -->

                    <div class="related-posts">
                        <h3 class="title">Related Posts</h3><!-- End .title -->

                        <div class="owl-carousel owl-simple" data-toggle="owl" 
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
                                    }
                                }
                            }'>
                            @foreach ($getRalatedPost as $related)
                            <article class="entry entry-grid">
                                <figure class="entry-media">
                                    <a href="{{url('blog/'.$related->slug)}}">
                                        <img src="{{$related->getImage()}}" alt="{{$related->title}}">
                                    </a>
                                </figure><!-- End .entry-media -->

                                <div class="entry-body">
                                    <div class="entry-meta">
                                        <a href="#">Nov 22, 2018</a>
                                        <span class="meta-separator">|</span>
                                        <a href="#">2 Comments</a>
                                    </div><!-- End .entry-meta -->

                                    <h2 class="entry-title">
                                        <a href="single.html">Cras ornare tristique elit.</a>
                                    </h2><!-- End .entry-title -->

                                    <div class="entry-cats">
                                        in <a href="#">Lifestyle</a>,
                                        <a href="#">Shopping</a>
                                    </div><!-- End .entry-cats -->
                                </div><!-- End .entry-body -->
                            </article><!-- End .entry -->
                            @endforeach
                        </div><!-- End .owl-carousel -->
                    </div><!-- End .related-posts -->

                </div><!-- End .col-lg-9 -->

                <aside class="col-lg-3">
                    @include('blog._slidebar')
                </aside><!-- End .col-lg-3 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
@endsection
@section('script')

<script type="text/javascript">
</script>
@endsection