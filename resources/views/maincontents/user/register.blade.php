@extends('layouts.home_layout');

@section('maincontent')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      {{-- <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>User Registration</h2>
          <ol>
            <li><a href="{{ URL('/') }}">Home</a></li>
            <li>User Registration</li>
          </ol>
        </div>

      </div> --}}
    </section><!-- End Breadcrumbs -->
    
    <section id="" class="about-us">
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
    </section>

  </main><!-- End #main -->

@endsection