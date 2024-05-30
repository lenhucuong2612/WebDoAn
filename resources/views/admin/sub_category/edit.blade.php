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
                  <form method="post" action="">
                    @csrf
                    <div class="card-body">
                      <div class="form-group">
                        <label >Cateogory Name</label>
                        {{--<input type="text" class="form-control @if($errors->has('sub_category_name')) is-invalid @endif" name="sub_category_name" placeholder="Enter Sub Cateogry name" value="{{old('sub_category_name')}}">--}}
                        <select class="form-control @if($errors->has('category_name')) is-invalid @endif" name="category_name">
                          <option value="">Select</option>
                          @foreach($getCategory as $value)
                          <option {{($value->id==$getRecord->category_id)?'selected':''}} value="{{$value->id}}">{{$value->name}}</option>
                          @endforeach
                        </select>
                        <p class="invalid-feedback">{{$errors->first('category_name')}}</p>
                      </div>
                      <div class="form-group">
                        <label >Sub Category Name</label>
                        <input type="text" class="form-control @if($errors->has('sub_category_name')) is-invalid @endif" name="sub_category_name" placeholder="Enter Cateogry name" value="{{old('category_name',$getRecord->name)}}">
                        <p class="invalid-feedback">{{$errors->first('sub_category_name')}}</p>
                      </div>
                      <div class="form-group">
                        <label >Slug</label>
                        <input type="text" class="form-control @if($errors->has('slug')) is-invalid @endif" name="slug" placeholder="Slug EX.url" value="{{old('slug',$getRecord->slug)}}">
                        <p class="invalid-feedback">{{$errors->first('slug')}}</p>
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