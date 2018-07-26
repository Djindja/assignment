<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Holycode | @yield('title')</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{url("css/bootstrap.min.css")}}" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="{{url("css/sb-admin.css")}}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{url("font-awesome/css/font-awesome.min.css")}}" rel="stylesheet" type="text/css">

    <!-- Main Style -->
    <link href="{{url("css/main.css")}}" rel="stylesheet" type="text/css">

    @yield('head')
  </head>

  <body>
    @if($errors->any())
      <ul class="globalErrors">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
      </ul>
    @endif

    @if(session()->has('successfulMessages'))
      <ul class="globalSuccess">
       @foreach (session()->get('successfulMessages') as $message)
          <li>{{ $message }}</li>
       @endforeach
      </ul>
    @endif

    <div id="wrapper">
      <!-- Navigation -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="{{url("")}}">{{Lang::get('titles.task')}}</a>
          </div>
          <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
          @section('sidebar')
          <div class="collapse navbar-collapse navbar-ex1-collapse">
              <ul class="nav navbar-nav side-nav">
                <li>
                    <a href="{{url("/trip")}}"><i class="fa fa-dashboard"></i> {{Lang::get('titles.trip.trips')}}</a>
                </li>
              </ul>
              <div class="logout">
                <span class="user-name">{{Lang::get('titles.hello')}}, {{ Auth::user()->name }} </span>
                  <a onclick="return (confirm('Are you sure you want to logout?'))"href="{{url("/logout")}}">{{Lang::get('titles.logout')}}</a>
              </div>
          </div>
          <!-- /.navbar-collapse -->
      </nav>
      @show
      <div id="page-wrapper">
          <div class="container-fluid">
              @yield('content')
          </div>
      </div>

    </div>

    <!-- jQuery -->
    <script src="{{url("js/jquery.js")}}"></script>
    
    <!-- Bootstrap Core JavaScript -->
    <script src="{{url("js/bootstrap.min.js")}}"></script>

    <!-- Main JavaScript -->
    <script src="{{url("/js/main.js")}}"></script>
    
    @yield('foot')
  </body>
</html>
