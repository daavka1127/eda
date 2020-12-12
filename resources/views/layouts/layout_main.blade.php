
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

    <link href="{{url('public/css/eda_styles.css')}}" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="{{url('public/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{url('public/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{url('public/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{url('public/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="{{url('public/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{url('public/vendors/jqvmap/dist/jqvmap.min.css')}}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{url('public/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{url('public/build/css/custom.min.css')}}" rel="stylesheet">

    <script src="{{url('public/js/vue.js')}}"></script>

    <!-- jQuery -->
    <script src="{{url('public/vendors/jquery/dist/jquery.min.js')}}"></script>

    <script src="{{url('public/js/fullscreenTab.js')}}"></script>

    <!--Zagvarlag alert-->
    <link rel="stylesheet" href="{{ asset('public/css/alertify.core.css') }}" />
	  <link rel="stylesheet" href="{{ asset('public/css/alertify.default.css') }}" />
    <script src="{{ asset('public/js/alertify.min.js') }}"></script>
    <!--Zagvarlag alert-->
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{url('/home')}}" class="site_title"><i class="fa fa-paw"></i> <span>ЗХЖШ</span></a>
            </div>

            <div class="clearfix"></div>
            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="{{url('public/images/gsmaf_logo.png')}}" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Сайн байна уу,</span>
                <h2>{{ Auth::user()->name }}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Цэс</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-globe"></i> Ажиллагааны лавлах <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('/mission/search')}}">Хайлт хийх</a></li>
                      <li><a href="{{url('/missions')}}">ЭДА-ны бүртгэл</a></li>
                      <li><a href="{{url('/awards')}}">Шагнал</a></li>
                      <li><a href="{{url('/punishments')}}">Шийтгэл</a></li>
                    </ul>
                  </li>
                  <li><a href="{{url('/trainings')}}"><i class="fa fa-book"></i> Сургууль, дамжааны лавлах <span class="fa fa-chevron-down"></span></a></li>
                  <li><a><i class="fa fa-gear"></i> Нэмэлт, засвар хийх <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('/ajillagaa')}}">Ажиллагааны улс нэмэх</a></li>
                      <li><a href="{{url('/ajillagaa/eelj')}}">Ажиллагааны ээлж нэмэх</a></li>
                      <li><a href="{{url('/sectors')}}">Цэргийн багийн салбар, нэгж нэмэх</a></li>
                      <li><a href="{{url('/units')}}">Анги байгууллага нэмэх</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-file-excel-o"></i> Excel файл <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      {{-- <li><a href="{{url('/upload/pdf')}}">PDF файл оруулах</a></li> --}}
                      <li><a href="{{url('/download/excel')}}">Excel файлын толгой татаж авах</a></li>
                      <li><a href="{{url('/import/excel')}}">Excel файл оруулах</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-user"></i>Админ эрх <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('/register')}}">Админ нэмэх</a></li>
                      <li><a href="{{url('/admins')}}">Админ засах</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li><a href="{{url("/changePassword")}}"><i class="fa fa-unlock-alt"></i> Нууц үг солих <span class="fa fa-chevron-down"></span></a></li>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" id="fullscreenTab" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ route('logout') }}" onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="{{url('public/images/gsmaf_logo.png')}}" alt="">{{ Auth::user()->name }}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="{{url("/changePassword")}}">Нууц үг солих</a></li>
                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();"><i class="fa fa-sign-out pull-right"></i> Гарах</a></li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          @yield("content")
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Зэвсэгт хүчний программ хангажийн төв Ахлах дэслэгч Б.Даваабат
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
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
