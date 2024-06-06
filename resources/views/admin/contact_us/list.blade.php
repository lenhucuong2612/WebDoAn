@extends("admin.layouts.app")

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Contact Us List</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
  
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            
            <!-- /.col -->
            <div class="col-md-12">
              @include("_message")
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Contact Us List</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Login Name</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Created Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if ($getRecord->isNotEmpty())
                          @foreach ($getRecord as $value)
                              <tr  class="active">
                                <td>{{$value->id}}</td>
                                <td>{{!empty($value->getUser)?$value->getUser->name:'User not login'}}</td>
                                <td>{{$value->name}}</td>
                                <td>{{$value->email}}</td>
                                <td>{{$value->phone}}</td>
                                <td>{{$value->subject}}</td>
                                <td>{{$value->message}}</td>
                                <td>{{$value->created_at}}</td>
                                <td>
                                  <a href="{{route("admin.contact_us.delete",$value->id)}}" onclick="return confirm('Are you want to delete?')" class="btn btn-danger">Remove</a>
                                </td>
                              </tr>
                          @endforeach
                      @else
                          <tr rowspan="9">List Page null</tr>
                      @endif
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <div>
                {{$getRecord->links()}}
              </div>
            </div>
            <!-- /.col -->
          </div>
        </div><!-- /.container-fluid -->
      </section>
    </div>
@endsection
      