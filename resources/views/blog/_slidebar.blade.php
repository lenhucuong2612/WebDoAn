<div class="sidebar">
    <div class="widget widget-search">
        <h3 class="widget-title">Search</h3><!-- End .widget-title -->

        <form action="{{url('blog')}}" method="get">
            <label for="ws" class="sr-only">Search in blog</label>
            <input type="search" class="form-control" value="{{Request::get('search')}}" name="search" id="search" placeholder="Search in blog">
            <button type="submit" class="btn"><i class="icon-search"></i><span class="sr-only">Search</span></button>
        </form>
    </div><!-- End .widget -->

    <div class="widget widget-cats">
        <h3 class="widget-title">Categories</h3><!-- End .widget-title -->

        <ul>
            @foreach ($getBlogCategory as $category)
                <li><a href="{{url('blog/blog-category/'.$category->slug)}}">{{$category->name}}<span>{{$category->getCountBlog()}}</span></a></li>
            @endforeach
        </ul>
    </div><!-- End .widget -->

    <div class="widget">
        <h3 class="widget-title">Popular Posts</h3><!-- End .widget-title -->

        <ul class="posts-list">
            @foreach ($getPopular as $valueP)
            <li>
                <figure>
                    <a href="#">
                        <img src="{{$valueP->getImage()}}" alt="{{$valueP->title}}">
                    </a>
                </figure>

                <div>
                    <span>{{date('M d, Y', strtotime($valueP->created_at))}}</span>
                    <h4><a href="{{url('blog/'.$valueP->slug)}}">{{$valueP->title}}</a></h4>
                </div>
            </li>
            @endforeach
        </ul><!-- End .posts-list -->
    </div><!-- End .widget -->

    
</div><!-- End .sidebar -->