<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>HOSPITAL CRM</title>

    <!-- Bootstrap -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Toastr Message -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>

    <!-- Custom Theme Style -->
    <link href="{{asset('css/custom.min.css')}}" rel="stylesheet">

    <style>
      .align_right{
        text-align: right;
      }
      .error{
        color: red;
      }
    </style>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        

        <!--  Sidebar  Content -->

          @include('layouts.sidebar')
          
        <!--  /Sidebar  Content -->
          
        <!-- top navigation -->

          @include('layouts.navbar')
          
        <!-- /top navigation -->


        @yield('content')

        <!-- footer content -->
    <footer>
        <div class="clearfix"></div>
    </footer>
        <!-- /footer content -->
    </div>
    </div>

    <!-- jQuery -->
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <!-- Custom Theme Scripts -->
    <script src="{{asset('js/custom.min.js')}}"></script>

    <!-- Toastr Message -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

    
    <!-- Datatable Script -->
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    @stack('scripts')
    
  </body>
</html>
