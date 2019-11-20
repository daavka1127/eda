
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

    <title>ЗХЖШ-Энхийг дэмжих цэргийн хамтын ажиллагааны хэлтэс</title>
    <link href="{{url('public/css/eda_print.css')}}" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="{{url('public/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{url('public/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">

    <!-- bootstrap-daterangepicker -->
    <link href="{{url('public/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{url('public/build/css/custom.min.css')}}" rel="stylesheet">


    <!-- jQuery -->
    <script src="{{url('public/vendors/jquery/dist/jquery.min.js')}}"></script>

    <!--Zagvarlag alert-->
    <link rel="stylesheet" href="{{ asset('public/css/alertify.core.css') }}" />
	  <link rel="stylesheet" href="{{ asset('public/css/alertify.default.css') }}" />
    <script src="{{ asset('public/js/alertify.min.js') }}"></script>
    <!--Zagvarlag alert-->
  </head>

  <body>
    <div class="container body">
      <div class="main_container">

          <div class="right_col" role="main">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-12 d-flex flex-column">
                    @yield("content")
                </div>
            </div>

          </div>
      </div>
    </div>


    <!-- Bootstrap -->
    <script src="{{url('public/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>

    <!-- DateJS -->
    <script src="{{url('public/vendors/DateJS/build/date.js')}}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{url('public/vendors/moment/min/moment.min.js')}}"></script>
    <script src="{{url('public/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{url('public/build/js/custom.min.js')}}"></script>

  </body>
</html>
