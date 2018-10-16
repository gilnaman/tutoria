
<!DOCTYPE html>
<html>
<head>
  <title></title>
  @include('layouts.bootstrap')
</head>
<body>

    <nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Gestion escolar</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      
      <ul class="nav navbar-nav">
        <li class="active"><a href="{{ url('/') }}">Sistema <span class="sr-only">(current)</span></a></li>
        {{--<li><a href="#">Link</a></li>--}}
        
        @if(Session::has('usuario')== true)
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Accciones <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="{{url('cardex',['matricula' =>Session::get('matricula')])}}">Perfil</a></li>
              
              {{--
                <li><a href="{{url('cardex',['matricula' =>Session::get('matricula')])}}">Perfil</a></li>
                <li><a href="#">Something else here</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="#">Separated link</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="#">One more separated link</a></li>--}}
            </ul>
          </li>
        @endif

      </ul>

      {{--<form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>--}}


      @if(Session::has('usuario')== false)
             <ul class="nav navbar-nav navbar-right">
       
              <li><a href="{{ url('/') }}">Login</a></li>
              {{--<li><a href="{{ url('/register') }}">Register</a></li>--}}
            </ul>
        @else
          <ul class="nav navbar-nav navbar-right">
              <li><a href="#">Universidad</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{'BIENVENIDO : '. Session::get('usuario') }} <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="{{url('logout')}}">Salir</a></li>
                  {{--<li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="#">Separated link</a></li>--}}
                </ul>
              </li>
          </ul>




      @endif

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
  
  @yield('contenido')



</body>



</html>

