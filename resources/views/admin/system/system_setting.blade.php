@extends("admin.layouts.app")

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>System Setting</h1>
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
                @include('_message')
                <div class="card card-primary">
                  <form method="post" action="" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label >Website</label>
                            <input type="text" class="form-control" name="website_name" value="{{$getRecord->website_name}}">
                          </div>
                      <div class="form-group">
                        <label >Logo</label>
                        <input type="file" class="form-control" name="logo" >
                        @if (!empty($getRecord->getLogo()))
                            <img src="{{$getRecord->getLogo()}}" alt="" style="width:200px">
                        @endif
                      </div>
                      <div class="form-group">
                        <label >Fevicon</label>
                        <input type="file" class="form-control" name="fevicon" >
                        @if (!empty($getRecord->getFevicon()))
                          <img src="{{$getRecord->getFevicon()}}" alt="" style="width:50px">
                        @endif
                      </div>
                      <div class="form-group">
                        <label >Footer Description</label>
                        <textarea name="footer_description" type="file" class="form-control">{{$getRecord->footer_description}}</textarea>
                      </div>
                      <div class="form-group">
                        <label >Footer Payment Icon</label>
                        <input name="footer_payment_icon" type="file" class="form-control">
                        @if (!empty($getRecord->getFooterpayment()))
                          <img src="{{$getRecord->getFooterpayment()}}" alt="" style="width:200px">
                        @endif
                      </div>
                      <hr>
                      <div class="form-group">
                        <label >Address</label>
                        <input type="text" class="form-control" name="address" value="{{$getRecord->address}}">
                      </div>
                      <div class="form-group">
                        <label >Phone</label>
                        <input type="text" class="form-control" name="phone" value="{{$getRecord->phone}}">
                      </div>
                      <div class="form-group">
                        <label >Phone 2</label>
                        <input type="text" class="form-control" name="phone_two" value="{{$getRecord->phone_two}}">
                      </div>
                      <div class="form-group">
                        <label >Submit Contact Email</label>
                        <input type="text" class="form-control" name="submit_email" value="{{$getRecord->submit_email}}">
                      </div>
                      <div class="form-group">
                        <label >Email</label>
                        <input type="email" class="form-control" name="email" value="{{$getRecord->email}}">
                      </div>
                      <div class="form-group">
                        <label >Email 2</label>
                        <input type="email" class="form-control" name="email_two" value="{{$getRecord->email_two}}">
                      </div>
                      <div class="form-group">
                        <label >Working Hour</label>
                        <textarea type="text" class="form-control" name="working_hour" >{{$getRecord->working_hour}}</textarea>
                      </div>
                      <div class="form-group">
                        <label >Facebook</label>
                        <input type="text" class="form-control" name="facebook_link" value="{{$getRecord->facebook_link}}">
                      </div>
                      <div class="form-group">
                        <label >Twitter</label>
                        <input type="text" class="form-control" name="twitter_link" value="{{$getRecord->twitter_link}}">
                      </div>
                      <div class="form-group">
                        <label >Instagram</label>
                        <input type="text" class="form-control" name="instagram_link" value="{{$getRecord->instagram_link}}">
                      </div>
                      <div class="form-group">
                        <label >Youtobe</label>
                        <input type="text" class="form-control" name="youtobe_link" value="{{$getRecord->youtobe_link}}">
                      </div>
                      <div class="form-group">
                        <label >Pinterest</label>
                        <input type="text" class="form-control" name="pinterest_link" value="{{$getRecord->pinterest_link}}">
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