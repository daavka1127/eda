<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{url('public/css/eda_login_styles.css')}}" rel="stylesheet">

    <link href="{{url('public/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" >
    <script src="{{url('public/js/jquery.min.js')}}"></script>
    <script src="{{url('public/bootstrap/js/bootstrap.min.js')}}"></script>

    <!--Zagvarlag alert-->
    <link rel="stylesheet" href="{{ asset('public/css/alertify.core.css') }}" />
	  <link rel="stylesheet" href="{{ asset('public/css/alertify.default.css') }}" />
    <script src="{{ asset('public/js/alertify.min.js') }}"></script>
    <!--Zagvarlag alert-->

    <title>Энхийг дэмжих ажиллагаа</title>
  </head>
  <body>

    <div id="content" class="col-sm-4">
      <h1>Нэвтрэх хэсэг</h1>
      <form class="form-horizontal" method="POST" action="{{ route('login') }}">
          {{ csrf_field() }}

          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <label for="email" class="col-md-4 control-label">Цахим хаяг</label>

              <div class="col-md-6">
                  <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                  @if ($errors->has('email'))
                      <span class="help-block">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                  @endif
              </div>
          </div>

          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              <label for="password" class="col-md-4 control-label">Нууц үг</label>

              <div class="col-md-6">
                  <input id="password" type="password" class="form-control" name="password" required>

                  @if ($errors->has('password'))
                      <span class="help-block">
                          <strong>{{ $errors->first('password') }}</strong>
                      </span>
                  @endif
              </div>
          </div>

          <div class="form-group">
              <div class="col-md-8 col-md-offset-4">
                  <button type="submit" class="btn btn-primary">
                      Нэвтрэх
                  </button>

                  {{-- <a class="btn btn-link" href="{{ route('password.request') }}">
                      Forgot Your Password?
                  </a> --}}
              </div>
          </div>
      </form>

    </div>
  </body>
</html>
