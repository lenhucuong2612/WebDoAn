@extends("admin.layouts.app")

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Edit Disocunt Code</h1>
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
                        <label >Discount Code Name</label>
                        <input type="text" class="form-control @if($errors->has('name')) is-invalid @endif" name="name" placeholder="Enter disccount code name" value="{{old('name',$getRecord->name)}}">
                        <p class="invalid-feedback">{{$errors->first('name')}}</p>
                      </div>
                      <div class="form-group">
                        <label for="">Type</label>
                        <select name="type" class="form-control">
                          <option {{(old('status')==0)?'selected':''}} value="Amount">Amount</option>
                          <option {{(old('status')==1)?'selected':''}} value="Percent">Percent</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label >Precent / Amount</label>
                        <input type="text" class="form-control @if($errors->has('precent_amount')) is-invalid @endif" name="precent_amount" placeholder="Precent / Amount" value="{{old('percent_amount',$getRecord->percent_amount)}}">
                        <p class="invalid-feedback">{{$errors->first('percent-amount')}}</p>
                      </div>
                      <div class="form-group">
                        <label >Expire Date</label>
                        <input type="date" class="form-control @if($errors->has('expire_date')) is-invalid @endif" name="expire_date"  value="{{old('expire_date',$getRecord->expire_date)}}">
                        <p class="invalid-feedback">{{$errors->first('expire_date')}}</p>
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