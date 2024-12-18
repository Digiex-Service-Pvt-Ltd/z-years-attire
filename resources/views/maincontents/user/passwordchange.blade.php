@extends('layouts.accounts_layout')

@section('accountcontents')

<main id="main">
      @include('common.accountsidebar')
      <div class="col py-3">
        <div class="row">
          <div class="col-lg-12">
            <div class="card card-secondary card-outline">
                <div class="card-body">
                  @if( Session::has('error') )
                    <p class="alert alert-danger">{{ Session::get('error') }}</p>
                  @elseif( Session::has('success') )
                  <p class="alert alert-success">{{ Session::get('success') }}</p>
                  @endif
                    <form action="{{ route('user.passwordchange.submit') }}" method="POST">
                              {{ csrf_field() }}
                              <div class="form-group">
                                  <label for="opss">Old Password</label>
                                  <input type="password" name="old_password" class="form-control {{($errors->first('old_password'))?'has-error':''}}" id="opss">
                                  <span class="error-txt">{{$errors->first('old_password')}}</span>
                              </div>
              
                              <div class="form-group">
                                  <label for="npass">New Password</label>
                                  <input type="password" name="new_password" class="form-control {{($errors->first('new_password'))?'has-error':''}}" id="npass">
                                  <span class="error-txt text-danger">{{$errors->first('new_password')}}</span>
                              </div>
              
                              <div class="form-group">
                                <label for="cpass">Confirm Password</label>
                                <input type="password" name="new_password_confirmation" class="form-control {{($errors->first('new_password_confirmation'))?'has-error':''}}" id="cpass">
                                <span class="error-txt text-danger">{{$errors->first('new_password_confirmation')}}</span>
                              </div>
                              <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div><!-- /.card -->
          </div>
        </div>
    </div>
  </div>
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        {{-- <div class="container">
            <div class="d-flex justify-content-between align-items-center">
            <h2>User Profile</h2>
            <ol>
                <li><a href="{{ URL('/') }}">Home</a></li>
                <li>Profile</li>
            </ol>
            </div>
        </div> --}}
    </section><!-- End Breadcrumbs -->

    {{-- <section id="" class="about-us">
      <div class="container" data-aos="fade-up">

        <div class="col-lg-10">
            <a href="{{ route('user.logout') }}" class="dropdown-item" onclick="event.preventDefault();document.getElementById('form.logout').submit()">Logout </a>
          <form id="form.logout" method="post" action="{{ route('user.logout') }}">@csrf</form>
        </div>

      </div>
    </section> --}}

</main>

@endsection