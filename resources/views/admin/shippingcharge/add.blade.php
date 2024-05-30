@extends("admin.layouts.app")

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Add New DShipping Charge</h1>
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
                        <label >Shipping Charge Name</label>
                        <input type="text" class="form-control @if($errors->has('name')) is-invalid @endif" name="name" placeholder="Enter shipping charge" value="{{old('name')}}">
                        <p class="invalid-feedback">{{$errors->first('name')}}</p>
                      </div>
                      <div class="form-group">
                        <label>Price</label>
                        <input type="number" class="form-control @if($errors->has('price')) is-invalid @endif" name="price" placeholder="Enter charge" value="{{old('price')}}">
                        <p class="invalid-feedback">{{$errors->first('price')}}</p>
                      </div>
                      <div class="form-group">
                        <label for="">Status</label>
                        <select name="status" class="form-control">
                          <option {{(old('status')==0)?'selected':''}} value="0">Active</option>
                          <option {{(old('status')==1)?'selected':''}} value="1">Inactive</option>
                        </select>
                      </div>
                    </div>
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
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