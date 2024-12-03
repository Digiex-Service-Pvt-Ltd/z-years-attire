@extends('layouts.home_layout');

@section('maincontent')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>User Login</h2>
          <ol>
            <li><a href="{{ URL('/') }}">Home</a></li>
            <li>Login</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->
    
    <section id="" class="about-us">
      <div class="container" data-aos="fade-up">

      <div class="col-lg-10">
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
              
              <div class="mt-3"><button type="submit">Submit</button></div>
              @if(session()->has('msg'))
                <div class="text-center">{{ session()->get('msg') }}</div>
              @endif
            </form>
          </div>

      </div>
    </section>

  </main><!-- End #main -->

@endsection