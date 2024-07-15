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
            <li class="nav-header">Statistical</li>
            <li class="nav-item">
              <a href="{{route("admin.dashboard")}}" class="nav-link @if(Request::segment(2)=='dashboard') active @endif">
                <i class="far fa fa-industry nav-icon"></i>
                <p>
                  Dashboard {{Request::segment(1)}}
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route("admin.orders.list")}}" class="nav-link @if(Request::segment(2)=='orders') active @endif">
                <i class="far fas fa-shopping-basket nav-icon"></i>
                <p>
                  Orders
                </p>
              </a>
            </li>
            <li class="nav-header">Users</li>
            <li class="nav-item">
              <a href="{{route("admin.admin.list")}}" class="nav-link @if(Request::segment(2)=='admin') active @endif">
                <i class="far fa fa-user nav-icon"></i>
                <p>
                  Admin
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route("admin.customer.list")}}" class="nav-link @if(Request::segment(2)=='customer') active @endif">
                <i class="far fa fa-users nav-icon"></i>
                <p>
                   Customer
                </p>
              </a>
            </li>
            <li class="nav-header">Product Data</li>
            <li class="nav-item">
              <a href="{{route("admin.categories.list")}}" class="nav-link @if(Request::segment(2)=='category') active @endif">
                <i class="far fa fa-bars nav-icon"></i>
                <p>
                   Category
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route("admin.sub_categories.list")}}" class="nav-link @if(Request::segment(2)=='sub_category') active @endif">
                <i class="far fa fa-minus-square nav-icon"></i>
                <p>
                  Sub Category
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route("admin.brand.list")}}" class="nav-link @if(Request::segment(2)=='brand') active @endif">
                <i class="far fa fa-bookmark nav-icon"></i>
                <p>
                  Brand
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route("admin.color.list")}}" class="nav-link @if(Request::segment(2)=='color') active @endif">
                <i class="far fa fa-paint-brush nav-icon"></i>
                <p>
                  Color
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route("admin.product.list")}}" class="nav-link @if(Request::segment(2)=='product') active @endif">
                <i class="far fa fa-cubes nav-icon"></i>
                <p>
                  Product
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route("admin.discount_code.list")}}" class="nav-link @if(Request::segment(2)=='discount-code') active @endif">
                <i class="far fa fa fa-code nav-icon"></i>
                <p>
                  Discount Code
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route("admin.shipping_charge.list")}}" class="nav-link @if(Request::segment(2)=='shipping_charge') active @endif">
                <i class="far fa fa-motorcycle nav-icon"></i>
                <p>
                  Shipping Charge
                </p>
              </a>
            </li>
            <li class="nav-header">Website</li>
            <li class="nav-item">
              <a href="{{route("admin.page.list")}}" class="nav-link @if(Request::segment(2)=='page') active @endif">
                <i class="far far fa-file nav-icon"></i>
                <p>
                  Page
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route("admin.contact_us.list")}}" class="nav-link @if(Request::segment(2)=='contact-us') active @endif">
                <i class="far fa-comment nav-icon"></i>
                <p>
                  Contact Us
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route("admin.slider.list")}}" class="nav-link @if(Request::segment(2)=='slider') active @endif">
                <i class="far	fas fa-sliders-h nav-icon"></i>
                <p>
                  Slider
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route("admin.partner.list")}}" class="nav-link @if(Request::segment(2)=='partner') active @endif">
                <i class="far fa-image nav-icon"></i>
                <p>
                  Partner Logo
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route("admin.blogcategory.list")}}" class="nav-link @if(Request::segment(2)=='blogcategory') active @endif">
                <i class="far fa-clone nav-icon"></i>
                <p>
                  Blog Category
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route("admin.blog.list")}}" class="nav-link @if(Request::segment(2)=='blog') active @endif">
                <i class="far fa-newspaper nav-icon"></i>
                <p>
                  Blog
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route("admin.system_setting")}}" class="nav-link @if(Request::segment(2)=='system-setting') active @endif">
                <i class="far	fa fa-cog nav-icon"></i>
                <p>
                  System Setting
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route("home")}}" class="nav-link">
                <i class="far	fa fa-home nav-icon"></i>
                <p>
                  Home
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route("logout")}}" class="nav-link">
                <i class="far	fas fa-redo nav-icon"></i>
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
