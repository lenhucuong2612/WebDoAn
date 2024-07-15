@extends("admin.layouts.app")

@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Partner Logo List</h1>
          </div>
          <div class="col-sm-6" style="text-align: right">
            <a href="{{route("admin.partner.add")}}" class="btn btn-primary">Add new partner logo</a>
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
                <h3 class="card-title">Partner Logo List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Image</th>
                      <th>Button Link</th>
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
                              <td>
                                @if (!empty($value->getImage()))
                                    <img src="{{$value->getImage()}}" alt="" style="width:200px">
                                @endif
                              </td>
                              <td>{{$value->button_link}}</td>
                              <td>
                                {{($value->status==0)?'Active':'Inactive'}}
                              </td>
                              <td>{{date('d-m-Y',strtotime($value->created_at))}}</td>
                              <td>
                                <a href="{{route("admin.partner.edit",$value->id)}}"><i style="width: 30px; font-size:20px" class="far fas fa-pencil-alt nav-icon"></i></a>
                                <a href="{{route("admin.partner.remove",$value->id)}}" onclick="return confirm('Are you want to delete')" ><i style="width: 30px; font-size:20px; color: red" class="far fas fa-trash nav-icon"></i></a>
                              </td>
                            </tr>
                        @endforeach
                    @else
                        <tr rowspan="9">List brand null</tr>
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
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
@section('javascript')
    
@endsection