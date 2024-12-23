@extends('layouts.home_layout');

@section('maincontent')
<main id="main">
    <div class="container">
      <div class="row">
          <div class="col-lg-12">
              <div class="loginbox">
                  <div class="loginboxmain">
                      {{-- <div class="loginboxmainlogo">
                          <img src="{{ asset('img/logo1.png') }}" alt="" class="img-fluid" style="width: 100px;">
                      </div> --}}
                      <div class="loginboxmainlogin">
                          <h4>Welcome</h4>
                          <div class="loginboxmainloginform">
                              @if( Session::has('error') )
                                <p class="alert alert-danger">{{ Session::get('error') }}</p>
                              @endif
                              <form action="{{ route('user.submit.login') }}" method="post" class="php-email-form">
                                @csrf
                                    <div class="form-floating mb-3">
                                      <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com" value="{{ old('email') }}">
                                      <label for="floatingInput">Email address</label>
                                      <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="form-floating">
                                      <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
                                      <label for="floatingPassword">Password</label>
                                      <span class="text-danger">@error('password'){{ $message }}@enderror</span>
                                    </div>

                                    <button type="submit" class="btn btn-secondary">Login</button>
                                    @if(session()->has('msg'))
                                      <div class="text-center">{{ session()->get('msg') }}</div>
                                    @endif

                                  <p>Don't Have An Account? <span><a href="{{Route('user.registration')}}">Sign Up</a></span></p>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

  </main><!-- End #main -->

@endsection


      {{-- <div class="col-lg-10">
            @if( Session::has('error') )
              <p class="alert alert-danger">{{ Session::get('error') }}</p>
            @endif
            <form action="{{ route('user.submit.login') }}" method="post" class="php-email-form">
              @csrf
              <div class="row">
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" placeholder="Your Email" value="{{ old('email') }}">
                  <span class="text-danger">
                    @error('email')
                      {{ $message }}
                    @enderror
                  </span>
                </div>
              </div>
              <div class="col-md-6 form-group mt-3">
                <input type="password" class="form-control" name="password" placeholder="Password">
                <span class="text-danger">
                    @error('password')
                      {{ $message }}
                    @enderror
                  </span>
              </div>
              <div>
                <a href="{{Route('user.registration')}}"><p>Click Here To Registration</p></a>
              </div>
              
              <div class="mt-3"><button type="submit">Submit</button></div>
              @if(session()->has('msg'))
                <div class="text-center">{{ session()->get('msg') }}</div>
              @endif
            </form>
          </div>

      </div> --}}