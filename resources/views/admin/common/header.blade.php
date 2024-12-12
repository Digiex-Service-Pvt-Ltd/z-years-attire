<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <form class="form-inline">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
      </form>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <li class="nav-item dropdown">
        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
          <div class="user-panel">
            <div class="image">
              <img src="{{ asset('img/avtar.png') }}" class="img-circle elevation-3" alt="User Image">
            </div>
          </div>
        </a>

        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
          <li><a href="{{ route('admin.profile') }}" class="dropdown-item">Profile</a></li>
          <li><a href="{{ route('admin.changepassword') }}" class="dropdown-item">Change Password</a></li>
          <li><a href="{{ route('admin.logout') }}" class="dropdown-item" onclick="event.preventDefault();document.getElementById('form.logout').submit()">Logout </a>
          <form id="form.logout" method="post" action="{{ route('admin.logout') }}">@csrf</form>
        </li>
        </ul>
      </li>


    </ul>
  </nav>