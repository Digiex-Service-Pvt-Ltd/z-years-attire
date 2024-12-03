@php 
$user = Auth::guard('admin')->user();
@endphp

<aside class="main-sidebar sidebar-dark-primary elevation-4 bg-colormain">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link ">
      <img src="{{ asset('admin/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{ $user->account_type; }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('admin/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ $user->name; }}</a>
        </div>
      </div>
      

      <!-- Sidebar Menu -->
      <nav class="mt-2 .bg-colormain">
        <ul class="nav nav-pills nav-sidebar flex-column dashboardheight" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          

            <li class="dashboardbodyboder">
                <a href="{{ route('admin.dashboard') }}" class="dashboardbody">
                  <i class="nav-icon fas fa-tachometer-alt"></i><p>Dashboard</p>
                </a>
            </li>

            <li class="dashboardbodyboder">
                <a href="{{ route('admin.category.list') }}" class="dashboardbody">
                  <i class="nav-icon fas fa-tachometer-alt"></i><p>Categories</p>
                </a>
            </li>

            <li class="dashboardbodyboder">
                <a href="{{ route('admin.attribute.list') }}" class="dashboardbody">
                  <i class="nav-icon fas fa-tachometer-alt"></i><p>Attributes</p>
                </a>
            </li>

            <li class="dashboardbodyboder">
                <a href="{{ route('admin.product.list') }}" class="dashboardbody">
                  <i class="nav-icon fas fa-tachometer-alt"></i><p>Products</p>
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