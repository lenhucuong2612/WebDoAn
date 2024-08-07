@extends("admin.layouts.app")

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Add New Product</h1>
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
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label >Title</label>
                            <input type="text" class="form-control @if($errors->has('title')) is-invalid @endif" name="title" placeholder="Enter title" >
                            <p class="invalid-feedback">{{$errors->first('title')}}</p>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label >Sku</label>
                            <input type="text" class="form-control @if($errors->has('sku')) is-invalid @endif" name="sku" placeholder="Enter sku" >
                            <p class="invalid-feedback">{{$errors->first('sku')}}</p>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label >Category</label>
                            <select class="form-control" id="changeCategory" name="category_id">
                              <option value="">Select</option>
                              @foreach ($getCategory as $item)
                                  <option  value="{{$item->id}}">{{$item->name}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label >Sub Category</label>
                            <select class="form-control" name="sub_category_id" id="getSubCategory">
                              <option  value="">Select</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label >Brand</label>
                            <select class="form-control" name="brand_id">
                              <option value="">Select</option>
                              @foreach ($getBrand as $item)
                                    <option  value="{{$item->id}}">{{$item->name}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label >Color</label>
                            @foreach ($getColor as $item)
                              
                              <div>
                                <labe for="">
                                  <input type="checkbox" name="color_id[]" value="{{$item->id}}"> {{$item->name}}
                                </label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                      </div>
                      
                       <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label >Price</label>
                            <input type="text" class="form-control @if($errors->has('price')) is-invalid @endif" name="price" placeholder="Enter price" >
                            <p class="invalid-feedback">{{$errors->first('price')}}</p>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label >Old Price</label>
                            <input type="text" class="form-control @if($errors->has('old_price')) is-invalid @endif" name="old_price" placeholder="Enter old price" value="0">
                            <p class="invalid-feedback">{{$errors->first('old_price')}}</p>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label >Size</label>
                            <div>
                              <table class="table table-striped">
                                <thead>
                                  <tr>
                                    <th>Quantity</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody id="AppendSize">
                                  @php
                                      $i_s=1;
                                  @endphp
                                  <tr>
                                    <td>
                                      <input type="text" placeholder="Name" name="size['+i+'][quantity]" class="form-control" required>
                                    </td>
                                    <td>
                                      <input type="text" placeholder="Name" name="size['+i+'][name]" class="form-control" required>
                                    </td>
                                    <td>
                                      <input type="text" placeholder="Price" name="size['+i+'][price]" class="form-control" required>
                                    </td>
                                    <td style="width:200px">
                                      <button type="button" class="btn btn-primary btn-sm AddSize">Add</button>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                      <hr>

                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label >Image</label>
                            <input type="file" multiple accept="image/*" class="form-control" style="padding:5px" @if($errors->has('image')) is-invalid @endif name="image[]" placeholder="Enter short description" >
                            <p class="invalid-feedback">{{$errors->first('image')}}</p>
                          </div>
                        </div>
                      </div>

                     
                      <hr>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label >Short Description</label>
                            <input type="text" class="form-control @if($errors->has('short_description')) is-invalid @endif" name="short_description" placeholder="Enter short description" >
                            <p class="invalid-feedback">{{$errors->first('short_description')}}</p>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label > Description</label>
                            <textarea type="text" class="form-control editor @if($errors->has('description')) is-invalid @endif" name="description" placeholder="Enter description" ></textarea>
                            <p class="invalid-feedback">{{$errors->first('description')}}</p>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label >Additional Information</label>
                            <textarea type="text" class="form-control editor @if($errors->has('additional_information')) is-invalid @endif" name="additional_information" placeholder="Enter additional information"></textarea>
                            <p class="invalid-feedback">{{$errors->first('additional_information')}}</p>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label >Shipping Retrun</label>
                            <textarea type="text" class="form-control editor @if($errors->has('shipping_return')) is-invalid @endif" name="shipping_return" placeholder="Enter shipping return"></textarea>
                            <p class="invalid-feedback">{{$errors->first('shipping_return')}}</p>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="">Status</label>
                        <select name="status" class="form-control">
                          <option  value="0">Active</option>
                          <option  value="1">Inactive</option>
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
@section('javascript')
<script src="{{asset('/sortable/jquery-ui.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
      $('#sortable').sortable({
        update:function(event,ui){
          var photo_id=new Array();
          $('.sortable_image').each(function(){
            var id=$(this).attr('id');
            photo_id.push(id)
          })
          $.ajax({
            type:'post',
            url:"{{route('admin.product.image.sortable')}}",
            data:{
              'photo_id':photo_id,
              "_token":"{{csrf_token()}}"
            },
            dataType:'json',
            success:function(data){

            },
            error:function(data){

            }
          })
        }
      });
    })
    var i=100;
      $('.editor').summernote({
        height: 200,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'hr']],
            ['view', ['fullscreen', 'codeview']],
            ['help', ['help']]
  ],
      });
   

    $('body').delegate('.AddSize', 'click', function(){
    var html = '<tr id="DeleteSize'+i+'">\n\
                    <td>\n\
                      <input type="text" name="size['+i+'][name]" placeholder="Name" class="form-control">\n\
                    </td>\n\
                    <td>\n\
                      <input type="text" name="size['+i+'][price]" placeholder="Price" class="form-control">\n\
                    </td>\n\
                    <td style="width:200px">\n\
                      <button type="button" id="'+i+'" class="btn btn-danger btn-sm DeleteSize">Delete</button>\n\
                    </td>\n\
                </tr>';
    i++;
    $('#AppendSize').append(html);
});

    $('body').delegate('.DeleteSize','click',function(e){
      var id=$(this).attr('id');
      $('#DeleteSize'+id).remove()
    })
     $('body').delegate('#changeCategory','change',function(e){
      var id=$(this).val();
      $.ajax({
        type:'post',
        url:"{{route('admin.get_sub_category')}}",
        data:{
          'id':id,
          "_token":"{{csrf_token()}}"
        },
        dataType:'json',
        success:function(data){
          $('#getSubCategory').html(data.html);
        },
        error:function(data){

        }
      })
     })
    </script>
@endsection