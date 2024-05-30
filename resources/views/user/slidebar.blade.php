<aside class="col-md-4 col-lg-3">
    <ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
        <li class="nav-item">
            <a class="nav-link @if(Request::segment(2)=='dashboard') active @endif"  href="{{route('user.dashboard')}}" >Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if(Request::segment(2)=='orders') active @endif" href="{{route('user.orders')}}" >Orders</a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if(Request::segment(2)=='edit-profile') active @endif" href="{{route('user.edit_profile')}}">Edit Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if(Request::segment(2)=='change-password') active @endif" href="{{route('user.change_password')}}">Change Password</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('logout')}}">Logout</a>
        </li>
    </ul>
</aside><!-- End .col-lg-3 -->
