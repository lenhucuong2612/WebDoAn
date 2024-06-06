<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
     
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{asset("dist/img/user1-128x128.jpg")}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{asset("dist/img/user8-128x128.jpg")}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{asset("dist/img/user3-128x128.jpg")}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      
    </ul>
  </nav>
  
  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="javascipt(0);" class="brand-link" style="text-align:center">
      <span class="brand-text font-weight-light" style="front-weight:bold !important; front-size:20px;">Ecommerce</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset("dist/img/user2-160x160.jpg")}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="{{route("admin.dashboard")}}" class="nav-link @if(Request::segment(2)=='dashboard') active @endif">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard {{Request::segment(1)}}
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route("admin.admin.list")}}" class="nav-link @if(Request::segment(2)=='admin') active @endif">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Admin
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route("admin.customer.list")}}" class="nav-link @if(Request::segment(2)=='customer') active @endif">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Customer
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route("admin.orders.list")}}" class="nav-link @if(Request::segment(2)=='orders') active @endif">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Orders
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route("admin.categories.list")}}" class="nav-link @if(Request::segment(2)=='category') active @endif">
                <i class="nav-icon fas fa-list-alt"></i>
                <p>
                  Category
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route("admin.sub_categories.list")}}" class="nav-link @if(Request::segment(2)=='sub_category') active @endif">
                <i class="nav-icon fas fa-list-alt"></i>
                <p>
                  Sub Category
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route("admin.brand.list")}}" class="nav-link @if(Request::segment(2)=='brand') active @endif">
                <i class="nav-icon fas fa-list-alt"></i>
                <p>
                  Brand
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route("admin.color.list")}}" class="nav-link @if(Request::segment(2)=='color') active @endif">
                <i class="nav-icon fas fa-list-alt"></i>
                <p>
                  Color
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route("admin.product.list")}}" class="nav-link @if(Request::segment(2)=='product') active @endif">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Product
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route("admin.discount_code.list")}}" class="nav-link @if(Request::segment(2)=='discount-code') active @endif">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Discount Code
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route("admin.shipping_charge.list")}}" class="nav-link @if(Request::segment(2)=='shipping_charge') active @endif">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Shipping Charge
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route("admin.page.list")}}" class="nav-link @if(Request::segment(2)=='page') active @endif">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Page
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route("admin.contact_us.list")}}" class="nav-link @if(Request::segment(2)=='contact-us') active @endif">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Contact Us
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route("admin.slider.list")}}" class="nav-link @if(Request::segment(2)=='slider') active @endif">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Slider
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route("admin.partner.list")}}" class="nav-link @if(Request::segment(2)=='partner') active @endif">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Partner Logo
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route("admin.blogcategory.list")}}" class="nav-link @if(Request::segment(2)=='blogcategory') active @endif">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Blog Category
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route("admin.blog.list")}}" class="nav-link @if(Request::segment(2)=='blog') active @endif">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Blog
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route("admin.system_setting")}}" class="nav-link @if(Request::segment(2)=='system-setting') active @endif">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  System Setting
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route("logout")}}" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                  Logout
                </p>
              </a>
            </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
