<!DOCTYPE html>
<html lang="en">
<head>
  @include('common.head')
</head>
<body>

  <header>
    @include('common.header')
  </header>

<!------------------------------body---------------------------->

<section>
  @yield('accountcontents')
</section>

<!------------------------------bodyend---------------------------->

<!----------------------------footer--------------------------------->

<footer class="mt-60">
  @include('common.footer')
</footer>


<!----------------------------footerend--------------------------------->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="{{ asset('js/owl.carousel.min.js')}}"></script>
<script src="{{ asset('js/myscript-js.js')}}"></script>


</body>
</html>