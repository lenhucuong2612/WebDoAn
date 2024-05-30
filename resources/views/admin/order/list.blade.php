@extends("admin.layouts.app")

@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <h3>Order List (Total:{{$getRecord->total()}})</h3>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <form action="">
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
                      <label for="">First Name</label>
                      <input placeholder="First Name" type="text" name="first_name" class="form-control" value="{{Request::get('first_name')}}">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="">Last Name</label>
                      <input placeholder="Last Name" type="text" name="last_name" class="form-control" value="{{Request::get('last_name')}}">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="">Company Name</label>
                      <input placeholder="Company Name" type="text" name="company_name" class="form-control" value="{{Request::get('company_name')}}">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="">Email</label>
                      <input placeholder="Email" type="email" name="email" class="form-control" value="{{Request::get('email')}}">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="">Country</label>
                      <input placeholder="Country" type="text" name="country" class="form-control" value="{{Request::get('country')}}">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="">State</label>
                      <input placeholder="State" type="text" name="state" class="form-control" value="{{Request::get('state')}}">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="">City</label>
                      <input placeholder="City" type="text" name="city" class="form-control" value="{{Request::get('city')}}">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="">Phone</label>
                      <input placeholder="Phone" type="text" name="phone" class="form-control" value="{{Request::get('phone')}}">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="">Post Code</label>
                      <input placeholder="Post code" type="text" name="post_code" class="form-control" value="{{Request::get('post_codee')}}">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="">From Date</label>
                      <input type="date" style="padding:6px" name="from_date" class="form-control" value="{{Request::get('from_date')}}">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="">To Date</label>
                      <input type="date" style="padding:6px" name="to_date" class="form-control" value="{{Request::get('to_date')}}">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <button class="btn btn-primary">Search</button>
                    <a class="btn btn-primary" href="{{route("admin.orders.list")}}">Reset</a>
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
                <h3 class="card-title">Orders List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0" style="overflow: auto">
                <table class="table table-striped" >
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Order Number</th>
                      <th>Company Name</th>
                      <th>Country</th>
                      <th>Address</th>
                      <th>City</th>
                      <th>State</th>
                      <th>Postcode</th>
                      <th>Phone</th>
                      <th>Email</th>
                      <th>Discount Code</th>
                      <th>Discount Amount</th>
                      <th>Shipping Amount</th>
                      <th>TotalAmount</th>
                      <th>Payment Method</th>
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
                              <td>{{$value->first_name}} {{$value->last_name}}</td>
                              <td>{{$value->order_number}}</td>
                              <td>{{$value->company_name}}</td>
                              <td>{{$value->country}}</td>
                              <td>{{$value->address_one}}/<br> {{$value->address_two}}</td>
                              <td>{{$value->city}}</td>
                              <td>{{$value->state}}</td>
                              <td>{{$value->postcode}}</td>
                              <td>{{$value->phone}}</td>
                              <td>{{$value->email}}</td>
                              <td>{{$value->discount_code}}</td>
                              <td>${{number_format($value->discount_amount,2)}}</td>
                              <td>${{number_format($value->shipping_amount,2)}}</td>
                              <td>${{number_format($value->total_amount,2)}}</td>
                              <td>{{$value->payment_method}}</td>
                              <td>
                                <select name="" class="form-control ChangeStatus" id="{{$value->id}}" style="width:150px">
                                  <option  {{($value->status==0) ?'selected':''}} value="0">Pedding</option>
                                  <option {{($value->status==1) ?'selected':''}} value="1">Inprogress</option>
                                  <option {{($value->status==2) ?'selected':''}} value="2">Delivered</option>
                                  <option {{($value->status==3) ?'selected':''}} value="3">Completed</option>
                                  <option {{($value->status==4) ?'selected':''}} value="4">Cancelled</option>
                                </select>
                              </td>
                              <td>{{date('d-m-Y',strtotime($value->created_at))}}</td>
                              <td>
                                <a href="{{route("admin.orders.detail",$value->id)}}"  class="btn btn-primary">Detail</a>
                              </td>
                            </tr>
                        @endforeach
                    @else
                        <tr rowspan="9">List admin null</tr>
                    @endif
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <!-- /.col -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
@section('javascript')
    <script type="text/javascript">
     $('body').delegate('.ChangeStatus', 'change', function(){
      var status=$(this).val();
      var order_id=$(this).attr('id');
      $.ajax({
        type:"get",
        url:"{{route('admin.order_status')}}",
        data:{
          status:status,
          order_id:order_id
        },
        dataType:"json",
        success:function(data){
          alert(data.message)
        }
      })
     })
    </script>
@endsection