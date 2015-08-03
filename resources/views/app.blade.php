<!doctype html>
<html lang="en">
<head>
    <meta charset= "UTF-8" >
    <title>IronEater</title>

    {!! Html::style('assets/vendor/bootstrap/dist/css/bootstrap.min.css') !!}
    {!! Html::style('assets/vendor/font-awesome/css/font-awesome.min.css') !!}
    {!! Html::script('/assets/vendor/jquery/dist/jquery.min.js'); !!}
    {!! Html::script('/assets/vendor/bootstrap/dist/js/bootstrap.min.js') !!}
    {!! Html::script('/assets/vendor/jquery.countdown/dist/jquery.countdown.min.js') !!}
    
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>

</head>
<body>

  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ url('/') }}">Iron Eater</a>
      </div>

      <div class="collapse navbar-collapse" id="collapse-1">
        <ul class="nav navbar-nav">
          <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
          <li><a href="{{ url('/exercises') }}">Exercises</a></li>
          <li><a href="{{ url('/sessions') }}">Workout History</a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right hidden-xs">
        @if (Auth::check())
          <li><a href="{{ url('auth/logout') }}">Logout</a></li>
        @else
          <li><a href="{{ url('auth/login') }}">Login</a></li>
          <li><a href="{{ url('auth/register') }}">Register</a></li>
        @endif
        </ul>
      </div>
    </div>
  </nav>

  @yield('content')
</body>
</html>