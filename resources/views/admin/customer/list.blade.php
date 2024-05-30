@extends("admin.layouts.app")

@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Customer List (Total:{{$getRecord->total()}})</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <form action="" class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Order Search</h3>
                  </div>
                  <div class="card-body" >
                    <div class="row">
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="">ID</label>
                          <input placeholder="ID" type="text" name="id" class="form-control" value="{{Request::get('id')}}">
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="">Name</label>
                          <input placeholder="Name" type="text" name="name" class="form-control" value="{{Request::get('name')}}">
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="">Email</label>
                          <input placeholder="Email" type="text" name="email" class="form-control" value="{{Request::get('email')}}">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="">From Date</label>
                          <input type="date" style="padding:6px" name="from_date" class="form-control" value="{{Request::get('from_date')}}">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="">To Date</label>
                          <input type="date" style="padding:6px" name="to_date" class="form-control" value="{{Request::get('to_date')}}">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <button class="btn btn-primary">Search</button>
                        <a class="btn btn-primary" href="{{route("admin.customer.list")}}">Reset</a>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
          <!-- /.col -->
          <div class="col-md-12">
            @include("_message")
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Customer List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Status</th>
                      <th>Create Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if ($getRecord->isNotEmpty())
                        @foreach ($getRecord as $value)
                            <tr  class="active">
                              <td>{{$value->id}}</td>
                              <td>{{$value->name}}</td>
                              <td>{{$value->email}}</td>
                              <td>{{date('d-m-Y', strtotime($value->created_at))}}</td>
                              <td>
                                {{($value->status==0)?'Active':'Inactive'}}
                              </td>
                              <td>
                                <a href="{{route("admin.admin.remove",$value->id)}}" onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger">Remove</a>
                              </td>
                            </tr>
                        @endforeach
                    @else
                        <tr colspan="4">List admin null</tr>
                    @endif
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <!-- /.col -->
        </div>
        <div>
            {{$getRecord->links()}}
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
@section('javascript')
    
@endsection