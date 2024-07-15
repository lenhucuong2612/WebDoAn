@extends("admin.layouts.app")

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Page List</h1>
            </div>
            <div class="col-sm-6" style="text-align: right">
              <a href="{{route("admin.page.add")}}" class="btn btn-primary">Add new page</a>
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
                  <h3 class="card-title">Page List</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Title</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if ($getRecord->isNotEmpty())
                          @foreach ($getRecord as $value)
                              <tr  class="active">
                                <td>{{$value->id}}</td>
                                <td>{{$value->name}}</td>
                                <td>{{$value->title}}</td>
                                <td>
                                  <a href="{{route("admin.page.edit",$value->id)}}" ><i style="width: 30px; font-size:20px" class="far fas fa-pencil-alt nav-icon"></i></a>
                                  <a href="{{route("admin.page.remove",$value->id)}}" onclick="return confirm('Are you want to delete')"><i style="width: 30px; font-size:20px; color: red" class="far fas fa-trash nav-icon"></i></a>
                                </td>
                              </tr>
                          @endforeach
                      @else
                          <tr rowspan="9">List Page null</tr>
                      @endif
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
            </div>
            <!-- /.col -->
          </div>
        </div><!-- /.container-fluid -->
      </section>
    </div>
@endsection
      