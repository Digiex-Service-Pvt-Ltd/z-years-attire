@extends('layouts.home_layout');

@section('maincontent')
  <main class="loginbody">
    <div class="container">
      <div class="row">
          <div class="col-lg-12">
              <div class="loginbox">
                  <div class="loginboxmain">
                      <div class="loginboxmainlogo">
                          <img src="{{ asset('img/logo1.png') }}" alt="" class="img-fluid" style="width: 100px;">
                      </div>
                      <div class="loginboxmainlogin">
                          <h4>Registration</h4>
                          <div class="loginboxmainloginform">
                              <form action="{{ route('user.submit.registration') }}" method="post" class="php-email-form">
                                @csrf
                                   <div class="form-floating mb-3">
                                      <input type="text" name="name" class="form-control" id="floatingInput" placeholder="name" value="{{ old('name') }}">
                                      <label for="floatingInput">Name</label>
                                      <span class="text-danger">@error('name'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="form-floating mb-3">
                                      <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" value="{{ old('email') }}">
                                      <label for="floatingInput">Email address</label>
                                      <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="form-floating">
                                      <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                                      <label for="floatingPassword">Password</label>
                                      <span class="text-danger">@error('password'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="form-floating">
                                      <input type="password" name="conf_password" class="form-control" id="floatingPassword" placeholder="Confirm Password">
                                      <label for="floatingPassword">Confirm Password</label>
                                      <span class="text-danger">@error('conf_password'){{ $message }}@enderror</span>
                                    </div>

                                    <button type="submit" class="btn btn-secondary">Sign Up</button>

                                    @if(session()->has('msg'))
                                      <div class="text-center">{{ session()->get('msg') }}</div>
                                    @endif

                                  <p>If you Have An Account? <span><a href="{{Route('user.login')}}">Log In</a></span></p>
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



    {{-- <section id="" class="about-us">
      <div class="container" data-aos="fade-up">

      <div class="col-lg-10">
            <form action="{{ route('user.submit.registration') }}" method="post" class="php-email-form">
              @csrf
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" placeholder="Your Name" value="{{ old('name') }}">
                  <span class="text-danger">
                    @error('name')
                      {{ $message }}
                    @enderror
                  </span>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" placeholder="Your Email" value="{{ old('email') }}">
                  <span class="text-danger">
                    @error('email')
                      {{ $message }}
                    @enderror
                  </span>
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="password" class="form-control" name="password" placeholder="Password">
                <span class="text-danger">
                    @error('password')
                      {{ $message }}
                    @enderror
                  </span>
              </div>
              <div class="form-group mt-3">
                <input type="password" class="form-control" name="conf_password" placeholder="Password">
                <span class="text-danger">
                    @error('conf_password')
                      {{ $message }}
                    @enderror
                  </span>
              </div>
              
              <div class="text-center"><button type="submit">Submit</button></div>
              @if(session()->has('msg'))
                <div class="text-center">{{ session()->get('msg') }}</div>
              @endif
            </form>
          </div>

      </div>
    </section> --}}