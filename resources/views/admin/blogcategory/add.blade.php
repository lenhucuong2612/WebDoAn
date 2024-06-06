@extends("admin.layouts.app")

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Add New Blog Category</h1>
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
                        <input type="text" class="form-control @if($errors->has('blog_category_name')) is-invalid @endif" name="blog_category_name" placeholder="Enter Cateogry name" value="{{old('blog_category_name')}}">
                        <p class="invalid-feedback">{{$errors->first('blog_category_name')}}</p>
                      </div>
                      <div class="form-group">
                        <label >Title</label>
                        <input type="text" class="form-control @if($errors->has('title')) is-invalid @endif" name="title" placeholder="Enter Cateogry name" value="{{old('title')}}">
                        <p class="invalid-feedback">{{$errors->first('title')}}</p>
                      </div>
                      <div class="form-group">
                        <label >Slug</label>
                        <input type="text" class="form-control @if($errors->has('slug')) is-invalid @endif" name="slug" placeholder="Slug EX.url" value="{{old('slug')}}">
                        <p class="invalid-feedback">{{$errors->first('slug')}}</p>
                      </div>
                      <div class="form-group">
                        <label for="">Status</label>
                        <select name="status" class="form-control">
                          <option value="0">Active</option>
                          <option value="1">Inactive</option>
                        </select>
                      </div>
                      <hr>
                      <div class="form-group">
                        <label >Meta title</label>
                        <input type="text" class="form-control" name="meta_title" placeholder="Meta title">
                      </div>
                      <div class="form-group">
                        <label >Meta Description</label>
                        <textarea  class="form-control " name="meta_description" placeholder="Meta description" ></textarea>
                      </div>
                      <div class="form-group">
                        <label >Meta Keywords</label>
                        <input type="text" class="form-control" name="meta_keywords" placeholder="Meta keywords">
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