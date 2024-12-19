@php 
$user = Auth::guard('admin')->user();
@endphp

<aside class="main-sidebar sidebar-dark-primary elevation-4 bg-colormain">
    <!-- Brand Logo -->
    <a href="{{route('admin.dashboard')}}" class="brand-link ">
      <img src="{{ asset('img/logo1.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <p>Admin Panel</p>
      {{-- <span class="brand-text font-weight-light">{{ $user->account_type; }}</span> --}}
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('img/avtar.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{ route('admin.profile') }}" class="d-block">{{ $user->name; }}</a>
        </div>
      </div>
      

      <!-- Sidebar Menu -->
      <nav class="mt-2 .bg-colormain">
        <ul class="nav nav-pills nav-sidebar flex-column dashboardheight" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          

            <li class="nav-item dashboardbodyboder">
                <a href="{{ route('admin.dashboard') }}" class="nav-link dashboardbody {{request()->is('admin/dashboard')?'active': ''}}">
                  <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-layout-dashboard"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1" /><path d="M5 16h4a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-2a1 1 0 0 1 1 -1" /><path d="M15 12h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1" /><path d="M15 4h4a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-2a1 1 0 0 1 1 -1" /></svg>
                  <p>Dashboard</p>
                </a>
            </li>

            <li class="nav-item dashboardbodyboder">
                <a href="{{ route('admin.category.list') }}" class="nav-link dashboardbody {{request()->is('admin/category')?'active': ''}}">
                  <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-list-details"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M13 5h8" /><path d="M13 9h5" /><path d="M13 15h8" /><path d="M13 19h5" /><path d="M3 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /><path d="M3 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /></svg>
                  <p>Categories</p>
                </a>
            </li>

            <li class="nav-item dashboardbodyboder">
                <a href="{{ route('admin.attribute.list') }}" class="nav-link dashboardbody {{request()->is('admin/attribute*')?'active': ''}}">
                  <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-align-box-center-top"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 19v-14a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" /><path d="M11 13h2" /><path d="M9 10h6" /><path d="M10 7h4" /></svg>
                  <p>Attributes</p>
                </a>
            </li>

            <li class="nav-item dashboardbodyboder">
                <a href="{{ route('admin.product.list') }}" class="nav-link dashboardbody {{request()->is('admin/product*')?'active': ''}}">
                  <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-bag-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12.5 21h-3.926a3 3 0 0 1 -2.965 -2.544l-1.255 -8.152a2 2 0 0 1 1.977 -2.304h11.339a2 2 0 0 1 1.977 2.304l-.263 1.708" /><path d="M16 19h6" /><path d="M19 16v6" /><path d="M9 11v-5a3 3 0 0 1 6 0v5" /></svg>
                  <p>Products</p>
                </a>
            </li>

            <li class="nav-item dashboardbodyboder">
              <a href="{{ route('admin.userdata') }}" class="nav-link dashboardbody {{request()->is('admin/userdata*')?'active': ''}}">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-users"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>
                <p>User Details</p>
              </a>
          </li>

            {{-- <li class="nav-item 3">
                <a href="" class="nav-link dashboardbody">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>Dashboard
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                 <ul class="nav nav-treeview">
                  <li class="dashboardbodyboder nav-item">
                    <a href="" class="nav-link dashboardbody">
                      <i class="nav-icon fas fa-tachometer-alt"></i>
                      <p>Dashboard</p>
                    </a>
                  </li>
                </ul>
            </li> --}}
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>