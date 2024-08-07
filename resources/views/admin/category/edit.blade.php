@extends("admin.layouts.app")

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Add New Category</h1>
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
                        <label >Name</label>
                        <input type="text" class="form-control @if($errors->has('category_name')) is-invalid @endif" name="category_name" placeholder="Enter Cateogry name" value="{{old('category_name',$getRecord->name)}}">
                        <p class="invalid-feedback">{{$errors->first('category_name')}}</p>
                      </div>
                      <div class="form-group">
                        <label for="">Status</label>
                        <select name="status" class="form-control">
                          <option {{(old('status',$getRecord->status)==0)?'selected':''}} value="0">Active</option>
                          <option {{(old('status',$getRecord->status)==1)?'selected':''}}  value="1">Inactive</option>
                        </select>
                      </div>
                      <hr>
                      <div class="form-group">
                        <label >Image</label>
                        <input type="file" class="form-control" name="image_name">
                        @if (!empty($getRecord->getImage()))
                            <img src="{{$getRecord->getImage()}}" alt="" style="height: 100px">
                        @endif
                      </div>
                      <div class="form-group">
                        <label >Butotn Name</label>
                        <input type="text" class="form-control @if($errors->has('button_name')) is-invalid @endif" name="button_name" placeholder="Button name" value="{{old('button_name',$getRecord->button_name)}}">
                        <p class="invalid-feedback">{{$errors->first('button_name')}}</p>
                      </div>
                      <div class="form-group">
                        <label style="display: block">Home Screen</label>
                        <input type="checkbox" {{!empty($getRecord->is_home)?'checked':''}} class=" @if($errors->has('is_home')) is-invalid @endif" name="is_home">
                        <p class="invalid-feedback">{{$errors->first('is_home')}}</p>
                      </div>
                      <hr>
                      <div class="form-group">
                        <label >Meta title</label>
                        <input type="text" class="form-control" value="{{old('meta_title',$getRecord->meta_title)}}"  name="meta_title" placeholder="Meta title">
                      </div>
                      <div class="form-group">
                        <label >Meta Description</label>
                        <textarea  class="form-control " name="meta_description" placeholder="Meta description" >{{old('meta_description',$getRecord->meta_description)}}</textarea>
                      </div>
                      <div class="form-group">
                        <label >Meta Keywords</label>
                        <input type="text" class="form-control" value="{{old('meta_keywords',$getRecord->meta_keywords)}}" name="meta_keywords" placeholder="Meta keywords">
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