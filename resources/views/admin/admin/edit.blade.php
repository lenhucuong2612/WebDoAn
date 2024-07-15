@extends("admin.layouts.app")

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Edit Admin</h1>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>
    
        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <!-- left column -->
              <div class="col-md-12">
                <div class="card card-primary">
                  <form method="post" action="">
                    @csrf
                    <div class="card-body">
                      <div class="form-group">
                        <label >Name</label>
                        <input type="text" class="form-control @if($errors->has('name')) is-invalid @endif" name="name" value="{{old('name',$user->name)}}"  placeholder="Enter name">
                        <p class="invalid-feedback">{{$errors->first('name')}}</p>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control @if($errors->has('email')) is-invalid @endif" name="email" value="{{old('email',$user->email)}}"  placeholder="Enter email">
                        <p class="invalid-feedback">{{$errors->first('email')}}</p>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control"  name="password"  placeholder="Password">
                        <p>Do you want to change password</p>
                      </div>
                      <div class="form-group">
                        <label for="">Status</label>
                        <select name="status" class="form-control">
                          <option {{($user->status==0)?'selected':''}} value="0">Acitve</option>
                          <option {{($user->status==1)?'selected':''}} value="1">Inactive</option>
                        </select>
                      </div>
                    </div>
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- /.row -->
          </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
      </div>
  <!-- /.content-wrapper -->
@endsection