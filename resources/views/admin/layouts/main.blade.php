<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Z Years Attire - Control Panel</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin/css/adminlte.min.css') }}">

  <link href="{{asset('admin/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{asset('admin/plugins/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{asset('admin/plugins/toastr/toastr.min.css')}}" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">

  <style>
    .has-error .form-control {
        border-color: #e73d4a;
    }
    .error-txt{
      color:#e73d4a;
    }
  </style>

  @stack('PAGE_ASSETS_CSS')

</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  @include('../admin.common.header')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('../admin.common.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('maincontent')
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    @include('../admin.common.footer')
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin/js/adminlte.min.js') }}"></script>
<script src="{{ asset('admin/plugins/toastr/toastr.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin/plugins/sweetalert2/sweetalert2.min.js') }}" type="text/javascript"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="{{ asset('admin/js/demo.js') }}"></script> -->
<script>
  
  $(function(){

      $.fn.select2.defaults.set("theme", "bootstrap");

      $(".select2, .select2-multiple").select2({
          placeholder: "Select",
          width: null
      });

      $(".select2-allow-clear").select2({
          allowClear: true,
          placeholder: "Select",
          width: null
      });

      toastr.options = {
          "closeButton": true,
          "debug": false,
          "positionClass": "toast-top-right", //toast-bottom-full-width
          "onclick": null,
          "showDuration": "1000",
          "hideDuration": "1000",
          "timeOut": "5000",
          "extendedTimeOut": "1000",
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut",
          "progressBar": true,
      }

      @if (Session::has('status'))
        @if (Session::has('toast'))
          toastr["{{session('status')}}"]("{{session('message')}}", "{{session('title')}}");
        @endif

        @if (Session::has('sweetalert'))
          let sweet_status = "{{session('status')}}";
          let sweet_message = "{{session('message')}}";
          let sweet_position = "{{session('popup_position')}}";
            showSweetAlertMessage(sweet_status, sweet_message, sweet_position);
        @endif

      @endif

      
        
      


  });

  function showSweetAlertMessage(sweet_status_icon, sweet_message, sweet_position)
  {
    
      const Toast = Swal.mixin({
        toast: true,
        position: sweet_position,
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.onmouseenter = Swal.stopTimer;
          toast.onmouseleave = Swal.resumeTimer;
        }
      });
      Toast.fire({
        icon: sweet_status_icon,
        title: sweet_message
      });
  }

</script>
@stack('PAGE_ASSETS_JS')

</body>
</html>
