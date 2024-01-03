<!DOCTYPE html>
<html lang="en">
<head>
<meta name="csrf-token" content="{{ csrf_token() }}" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dev Matka</title>


  <!-- Google Font: Source Sans Pro -->

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css"
  href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <link rel="stylesheet" href="{{asset('assets')}}/plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="{{asset('assets')}}/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <link rel="stylesheet" href="{{asset('assets')}}/plugins/toastr/toastr.min.css">



 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('assets')}}/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('assets')}}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- add -->
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">


  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('assets')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('assets')}}/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets')}}/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('assets')}}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('assets')}}/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('assets')}}/plugins/summernote/summernote-bs4.min.css">
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{asset('assets')}}/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
{{--  --}}
  {{-- <style>
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
    }

    .section {
        width: 100%;
        max-width: 1200px; /* Adjust as needed */
        margin: 0 auto;
        padding: 20px;
        box-sizing: border-box;
    }

    @media only screen and (max-width: 600px) {
        .section {
            padding: 10px;
            width: 10px;
        }
    }
</style> --}}

</head>



<body class="hold-transition sidebar-mini layout-fixed" style="width: 100vw;height: 100vh">
<div class="wrapper" >

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{asset('assets')}}/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>


      </ul>
    {{-- <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('dashboard')}}" class="nav-link">Home</a>
      </li>

    </ul> --}}

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">

        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{asset('assets')}}/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{asset('assets')}}/dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{asset('assets')}}/dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('dashboard')}}" class="brand-link">
      <!-- <img src="#" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
      <span class="brand-text font-weight-light" style="margin: 25px;">Dev Matka App</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">

        <div class="info">
        <div class="info">
          <a href="#" class="d-block"><p>Username : <b>{{auth()->user()->name}}</b></p></a>
        </div>
        </div>
      </div> -->

      <!-- SidebarSearch Form -->


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->


               @php
              $uicongfig['active'] = isset($uicongfig['active'])?$uicongfig['active']:"";
           @endphp
          <li class="nav-item">
            <a href="{{route('dashboard')}}" class="nav-link {{($uicongfig['active'] == 'dashboard')?'active':''}}">
              <i class="fa fa-home"></i>
              <p>
             Dashboard
              </p>
            </a>
          </li>


            <li class="nav-item menu-close">
                <a href="#" class="nav-link">
                    <i class="fa fa-hashtag"></i>
                    <p>
                    Games & Number
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('types.games') }}" class="nav-link active">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Single Digit</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('types.JodiDigit') }}" class="nav-link active">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Jodi Digit</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('types.SinglePana') }}" class="nav-link active">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Single Pana</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('types.DoublePana') }}" class="nav-link active">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Double Pana</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('types.TripplePana') }}" class="nav-link active">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Tripple Pana</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('types.HalfSangamNumbers') }}" class="nav-link active">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Half Sangam</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('types.FullSangam') }}" class="nav-link active">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Full Sangam</p>
                    </a>
                  </li>
                </ul>
              </li>


              <li class="nav-item menu-close">
                <a href="#" class="nav-link">
                    <i class="fa fa-gamepad"></i>
                    <p>
                        Games Management
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('games.index')}}" class="nav-link active">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Game Name</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('types.Gamesrated')}}" class="nav-link active">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Game Rates</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('howtoplay')}}" class="nav-link active">
                      <i class="far fa-circle nav-icon"></i>
                      <p>How To Play</p>
                    </a>
                  </li>
                </ul>
              </li>


              <li class="nav-item menu-close">
                <a href="#" class="nav-link">
                    <i class="fa fa-user"></i>
                    <p>
                        User Managment
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('customer.index')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>User Managment</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item menu-close">
                <a href="#" class="nav-link">
                    <i class="fa fa-bug"></i>
                    <p>
                       Starline Game
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('starline')}}" class="nav-link active">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Game Name</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('starlinetypes.Gamesrated')}}" class="nav-link active">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Starline Rates</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="#" class="nav-link active">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Bid History</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="#" class="nav-link active">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Declare Result</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="#" class="nav-link active">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Starline Result History</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item menu-close">
                <a href="#" class="nav-link">
                    <i class="fa fa-university"></i>
                    <p>
                      Wallet Management
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('withdrawadmin')}}" class="nav-link active">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Withdraw Fund (Wallet)</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('addfunduser')}}" class="nav-link active">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Add Fund (Wallet)</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item menu-close">
                <a href="#" class="nav-link">
                    <i class="fa fa-trophy"></i>
                    <p>
                     Result Management
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('games.result')}}" class="nav-link active">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Declare Result</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('resulthistory')}}" class="nav-link active">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Result History</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item menu-close">
                <a href="#" class="nav-link">
                    <i class="fa fa-cog"></i>
                    <p>
                    Settings Management
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('adminuserlist')}}" class="nav-link active">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Admin Settings Managment</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('contactmanagemnt')}}" class="nav-link active">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Contact Settings Management</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item menu-close">
                <a href="#" class="nav-link">
                    <i class="fa fa-bell"></i>
                    <p>
                    Notice Management
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('notification')}}" class="nav-link active">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Send Notification</p>
                    </a>
                  </li>
                </ul>

              </li>

          <li class="nav-item">
            <a href="{{route('logout')}}" class="nav-link">
              <i class="fas fa-power-off"></i>
              <p>
                Logout
              </p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  @yield('content')

        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="#">Dev Matka App</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- jQuery -->
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
 </script>
  <script>
    @if(Session::has('success'))
    toastr.options =
    {
      "closeButton" : true,
      "progressBar" : true
    }
        toastr.success("{{ session('success') }}");
    @endif

    @if(Session::has('danger'))
    toastr.options =
    {
      "closeButton" : true,
      "progressBar" : true
    }
        toastr.error("{{ session('danger') }}");
    @endif

  </script>
  <script>
 function printErrorMsg (msg,el) {
  $.each( msg, function( key, value ) {
  // console.log(key)
    $(el).find('.'+key+'').text(value);
  })

}
</script>
<script>
$(function () {
  $('.timepicker1').datetimepicker({
    format: 'h:m:s'
  });
});
  // DropzoneJS Demo Code End
</script>
<!-- <script>
$(document).ready(function () {
    $('.timepicker').timepicker({
      format: 'LT'
    });
});
</script> -->


<script src="{{asset('assets')}}/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('assets')}}/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.20/dist/sweetalert2.all.min.js" integrity="sha256-6DBhCk8kLxWN6B/oKVfvB0ieNTCY2r0rlFlkAjLmrsM=" crossorigin="anonymous"></script>
<script src="{{asset('assets')}}/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Bootstrap 4 -->

<script src="{{asset('assets')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="{{asset('assets')}}/plugins/chart.js/Chart.min.js"></script>
<!-- add -->
<script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<!-- Sparkline -->
<script src="{{asset('assets')}}/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="{{asset('assets')}}/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="{{asset('assets')}}/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('assets')}}/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{asset('assets')}}/plugins/moment/moment.min.js"></script>
<script src="{{asset('assets')}}/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('assets')}}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="{{asset('assets')}}/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{asset('assets')}}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets')}}/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
{{-- <script src="{{asset('assets')}}/dist/js/demo.js"></script> --}}
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('assets')}}/dist/js/pages/dashboard.js"></script>

<script src="{{asset('assets')}}/plugins/toastr/toastr.min.js"></script>
<script src="{{asset('assets')}}/dist/js/appct.js"></script>
<script src="{{asset('assets')}}/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="{{asset('assets')}}/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
