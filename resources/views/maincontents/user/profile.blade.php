@extends('layouts.accounts_layout')

@section('accountcontents')

@php 
$user = Auth::guard('user')->user();
@endphp

<main id="main">
      @include('common.accountsidebar')
      <div class="col py-3">
        <div class="row">
          <div class="col-lg-12">
            @if (!empty($user))
            <p>{{$user->name}}</p>
            <p>{{$user->email}}</p>
            @else
            <p>No Data Found</p>
            @endif 
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