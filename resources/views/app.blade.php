<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IronEater</title>

    {!! Html::style('assets/vendor/bootstrap/dist/css/bootstrap.min.css') !!}
    {!! Html::style('assets/vendor/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') !!}
    {{-- {!! Html::style('assets/vendor/font-awesome/css/font-awesome.min.css') !!} --}}
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />

    {!! Html::script('/assets/vendor/jquery/dist/jquery.min.js') !!}
    {!! Html::script('/assets/vendor/moment/min/moment.min.js') !!}
    {{-- {!! Html::script('/assets/vendor/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') !!} --}}
    {!! Html::script('/assets/js/index.js') !!}
    {!! Html::style('/assets/vendor/fullcalendar/dist/fullcalendar.min.css') !!}
    {!! Html::script('/assets/vendor/fullcalendar/dist/fullcalendar.min.js') !!}
    
    {!! Html::style('/assets/vendor/tooltip-js/dist/tooltip.css') !!}
    {!! Html::script('/assets/vendor/tooltip-js/dist/tooltip.min.js') !!}

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
          <li><a href="{{ url('/showLog') }}">Log</a></li>
          <li><a href="{{ url('/plans') }}">Plans</a></li>
          <li><a href="{{ url('/workouts') }}">Workouts</a></li>
          <li><a href="{{ url('/exercises') }}">Exercises</a></li>
          <li><a href="{{ url('/sessions') }}">Workout History</a></li>
          <li><a href="">Settings</a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
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

  {!! Html::script('/assets/vendor/bootstrap/dist/js/bootstrap.min.js') !!}
  {!! Html::script('/assets/js/timerFunction.js') !!}

</body>
</html>