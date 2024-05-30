@extends("admin.layouts.app")

@section('content')
     <!-- Content Wrapper. Contains page content -->
     <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">Dashboard v3</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Dashboard v3</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    
        <!-- Main content -->
        <div class="content">
          <div class="container-fluid">
            <div class="row">
            
              <div class="col-12 col-sm-6 col-md-2">
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-success elevation-1"><i class="fas fa-list-alt"></i></span>
    
                  <div class="info-box-content">
                    <span class="info-box-text">Total Orders</span>
                    <span class="info-box-number">{{$TotalOrder}}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <div class="col-12 col-sm-6 col-md-2">
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-success elevation-1"><i class="fas fa-list-alt"></i></span>
    
                  <div class="info-box-content">
                    <span class="info-box-text">Today Orders</span>
                    <span class="info-box-number">{{$TotalTodayOrder}}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <div class="col-12 col-sm-6 col-md-2">
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
    
                  <div class="info-box-content">
                    <span class="info-box-text">Total Payments</span>
                    <span class="info-box-number">${{number_format($TotalAmount,2)}}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <div class="col-12 col-sm-6 col-md-2">
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
    
                  <div class="info-box-content">
                    <span class="info-box-text">Today Payments</span>
                    <span class="info-box-number">${{number_format($TotalTodayAmount,2)}}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <div class="col-12 col-sm-6 col-md-2">
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>
    
                  <div class="info-box-content">
                    <span class="info-box-text">Total Customer</span>
                    <span class="info-box-number">{{$TotalCustomer}}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <div class="col-12 col-sm-6 col-md-2">
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>
    
                  <div class="info-box-content">
                    <span class="info-box-text">Total Today Customer</span>
                    <span class="info-box-number">{{$TotalTodayCustomer}}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                      <h3 class="card-title">Sales</h3>
                      <select class="form-control ChangeYear" style="width:100px;">
                        @for($i=2023;$i<=date('Y');$i++)
                        <option {{($year==$i)?'selected':''}} value="{{$i}}">{{$i}}</option>
                        @endfor
                      </select>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="d-flex">
                      <p class="d-flex flex-column">
                        <span class="text-bold text-lg">${{number_format($total_amount,2)}}</span>
                        <span>Sales Over Time</span>
                      </p>
                    </div>
                    <!-- /.d-flex -->
    
                    <div class="position-relative mb-4">
                      <canvas id="sales-chart-order" height="200"></canvas>
                    </div>
    
                    <div class="d-flex flex-row justify-content-end">
                      <span class="mr-2">
                        <i class="fas fa-square text-primary"></i> Customer
                      </span>
    
                      <span class="mr-2">
                        <i class="fas fa-square text-gray"></i> Order
                      </span>

                      <span class="mr-2">
                        <i class="fas fa-square text-danger"></i> Amount
                      </span>
                    </div>
                  </div>
                </div>
                <!-- /.card -->
    
                <div class="card">
                  <div class="card-header border-0">
                    <h3 class="card-title">Lastest Orders</h3>
                    <div class="card-tools">
                      <a href="#" class="btn btn-tool btn-sm">
                        <i class="fas fa-download"></i>
                      </a>
                      <a href="#" class="btn btn-tool btn-sm">
                        <i class="fas fa-bars"></i>
                      </a>
                    </div>
                  </div>
                  <div class="card-body table-responsive p-0">
                    <table class="table table-striped table-valign-middle" >
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Name</th>
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
                          <th>Create Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if ($getLastestOrder->isNotEmpty())
                            @foreach ($getLastestOrder as $value)
                                <tr  class="active">
                                  <td>{{$value->id}}</td>
                                  <td>{{$value->first_name}} {{$value->last_name}}</td>
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
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col-md-6 -->
             
              <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
      </div>
  <!-- /.content-wrapper -->
@endsection
@section('javascript')
    
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script type="text/javascript">
  $('.ChangeYear').change(function(){
    var year=$(this).val();
    window.location.href="{{url('admin/dashboard?year=')}}"+year;
  })
  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }

  var mode = 'index'
  var intersect = true

  var $salesChart = $('#sales-chart-order')
  // eslint-disable-next-line no-unused-vars
  var salesChart = new Chart($salesChart, {
    type: 'bar',
    data: {
      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
      datasets: [
        {
          backgroundColor: '#007bff',
          borderColor: '#007bff',
          data: [{{$getTotalCustomerMonth}}]
        },
        {
          backgroundColor: '#ced4da',
          borderColor: '#ced4da',
          data: [{{$getTotalOrderMonth}}]
        },
        {
          backgroundColor: 'red',
          borderColor: 'red',
          data: [{{$getTotalOrderAmountMonth}}]
        }
      ]
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        mode: mode,
        intersect: intersect
      },
      hover: {
        mode: mode,
        intersect: intersect
      },
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          // display: false,
          gridLines: {
            display: true,
            lineWidth: '4px',
            color: 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks: $.extend({
            beginAtZero: true,

            // Include a dollar sign in the ticks
            callback: function (value) {
              if (value >= 1000) {
                value /= 1000
                value += 'k'
              }

              return '$' + value
            }
          }, ticksStyle)
        }],
        xAxes: [{
          display: true,
          gridLines: {
            display: false
          },
          ticks: ticksStyle
        }]
      }
    }
  })

</script>
@endsection
