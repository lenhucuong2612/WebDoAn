@extends('layouts.app')
@section('content')
<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">{{$getPage->title}}</h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('blog')}}">Blog</a></li>
                <li class="breadcrumb-item active" aria-current="page">Grid With Sidebar</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="entry-container max-col-2" data-layout="fitRows">
                        @foreach ($getBlog as $value)
                        <div class="entry-item col-sm-6">
                            <article class="entry entry-grid">
                                <figure class="entry-media">
                                    <a href="{{url('blog/'.$value->slug)}}">
                                        <img src="{{$value->getImage()}}" alt="image desc">
                                    </a>
                                </figure><!-- End .entry-media -->

                                <div class="entry-body">
                                    <div class="entry-meta">
                                        <a href="#">{{date('M d,Y',strtotime($value->created_at))}}</a>
                    
                                    </div><!-- End .entry-meta -->

                                    <h2 class="entry-title">
                                        <a href="{{url('blog/'.$value->slug)}}">{{$value->slug}}</a>
                                    </h2><!-- End .entry-title -->

                                </div><!-- End .entry-body -->
                            </article><!-- End .entry -->
                        </div><!-- End .entry-item -->
                        @endforeach
                    </div><!-- End .entry-container -->

                   <div>
                    {{$getBlog->links()}}
                   </div>
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