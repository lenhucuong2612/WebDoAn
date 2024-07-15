@extends("admin.layouts.app")

@section('content')
@if(session('message'))
        <script>
            // Lấy thông báo từ session và hiển thị alert
            let message = @json(session('message'));
            alert(message);
        </script>
    @endif
    <!-- Content Wrapper. Contains page content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    @php
                    $getProductImage=$getProduct->getIamgeSingle($getProduct->id)
                @endphp
               
                    <div class="col-md-4">
                        <div class=" m-auto" style="width: 333px;">
                            <img class="w-100" src="{{$getProductImage->getLogo()}}" data-zoom-image="{{$getProductImage->getLogo()}}" alt="">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="w-50">
                            <img class="w-100" src="{{$getProductImage->getLogo()}}" data-zoom-image="{{$getProductImage->getLogo()}}" alt="">
                        </div>
                        
                        {{--
                            <p> <b>Ngày công chiếu: </b> {{ \Carbon\Carbon::parse($movie->release_date)->format('d/m/Y') }}</p>
                        <p>
                            <b>Nhà sản xuất: </b>
                            @if($movie->producer)
                                {{ $movie->producer }}
                            @else
                                Đang cập nhật
                            @endif
                        </p>
                        <p>
                            <b>Thể loại phim: </b>
                            @if($movie->categories->isEmpty())
                                <a href="{{ route('category_movie.create') }}" class="btn btn-success float-right m-4">Thêm phim</a>
                            @else
                                {{ $movie->categories->implode('name', ', ') }}
                            @endif
                        </p>
                        <p> <b>Đạo diễn: </b> {{ $movie->director->name }}</p>
                        <p>
                            <b>Diễn viên: </b>
                            @if($movie->performers->isEmpty())
                                <a href="{{ route('category_movie.create') }}" class="btn btn-success float-right m-4">Thêm phim</a>
                            @else
                                {{ $movie->performers->implode('name', ', ') }}
                            @endif
                        </p>
                        <p>
                            <b>Trạng thái của phim: </b>
                            @if($movie->status == 1 && $movie->release_date > now())
                                Sắp công chiếu
                            @elseif($movie->status == 1 && $movie->release_date <= now())
                                Đang công chiếu
                            @else
                                Dừng công chiếu
                            @endif
                        </p>
                        <p> <b>Link trailer phim: </b> {{ $movie->trailer }}</p>
                        <p> <b>Nội dung phim: </b> {{ $movie->describe }}</p>

                        <div class="mr-2">
                            <a href="{{ route('movie.edit', $movie->id) }}" class="btn btn-info">Sửa thông tin phim</a>
                        </div>
                        --}}
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    
@endsection