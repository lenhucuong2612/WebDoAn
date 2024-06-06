@extends("admin.layouts.app")

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Edit Partner</h1>
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
                  <form method="post" action="" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                      <div class="form-group">
                        <label >Image</label>
                        <input type="file" class="form-control @if($errors->has('image_name')) is-invalid @endif" name="image_name" placeholder="Enter image name" value="{{old('image_name')}}">
                        @if (!empty($getRecord->getImage()))
                            <img src="{{$getRecord->getImage()}}" alt="" style="width:200px">
                        @endif
                        <p class="invalid-feedback">{{$errors->first('image_name')}}</p>
                      </div>
                      <div class="form-group">
                        <label >Button Link</label>
                        <input type="text" class="form-control @if($errors->has('button_link')) is-invalid @endif" name="button_link" placeholder="Enter button link" value="{{old('button_link',$getRecord->button_link)}}">
                        <p class="invalid-feedback">{{$errors->first('button_link')}}</p>
                      </div>
                      <div class="form-group">
                        <label for="">Status</label>
                        <select name="status" class="form-control">
                          <option {{$getRecord->status==0?'selected':''}} value="0">Active</option>
                          <option {{$getRecord->status==1?'selected':''}} value="1">Inactive</option>
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