@extends('layouts.home_layout');

@section('maincontent')

<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
            <h2>User Profile</h2>
            <ol>
                <li><a href="{{ URL('/') }}">Home</a></li>
                <li>Profile</li>
            </ol>
            </div>
        </div>
    </section><!-- End Breadcrumbs -->

    <section id="" class="about-us">
      <div class="container" data-aos="fade-up">

        <div class="col-lg-10">
            <a href="{{ route('user.logout') }}" class="dropdown-item" onclick="event.preventDefault();document.getElementById('form.logout').submit()">Logout </a>
          <form id="form.logout" method="post" action="{{ route('user.logout') }}">@csrf</form>
        
        </div>

      </div>
    </section>

</main>
@endsection