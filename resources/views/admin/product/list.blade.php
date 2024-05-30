@extends("admin.layouts.app")

@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Product List</h1>
          </div>
          <div class="col-sm-6" style="text-align: right">
            <a href="{{route("admin.product.add")}}" class="btn btn-primary">Add new cateogry</a>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
         
          <!-- /.col -->
          <div class="col-md-12">
            @include("_message")
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Product List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Title</th>
                      <th>Slug</th>
                      <th>Created By</th>
                      <th>Status</th>
                      <th>Created At</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if ($getRecord->isNotEmpty())
                        @foreach ($getRecord as $value)
                            <tr  class="active">
                              <td>{{$value->id}}</td>
                              <td>{{$value->title}}</td>
                              <td>{{$value->slug}}</td>
                              <td>{{$value->created_by_name}}</td>
                              <td>
                                {{($value->status==0)?'Active':'Inactive'}}
                              </td>
                              <td>{{date('d-m-Y',strtotime($value->created_at))}}</td>
                              <td>
                                <a href="{{route("admin.product.edit",$value->id)}}" class="btn btn-primary">Edit</a>
                                <a href="{{route("admin.category.remove",$value->id)}}" onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger">Remove</a>
                              </td>
                            </tr>
                        @endforeach
                    @else
                        <tr rowspan="9">List admin null</tr>
                    @endif
                  </tbody>
                </table>
              </div>
              <div>
                {{$getRecord->links()}}
              </div>
            </div>
          </div>
          <!-- /.col -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
@section('javascript')
    
@endsection