<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'QunielaMundial') }}</title>

    <!-- Styles -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" >
   <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
   <link href="{{ asset('css/starter-template.css') }}" rel="stylesheet">
   <link href="{{ asset('css/bootstrap-theme.min.css') }}" rel="stylesheet">
   <link href="{{ asset('css/ie10-viewport-bug-workaround.css') }}" rel="stylesheet">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  
   <meta name="csrf-token" content="{{ csrf_token() }}">
<style>
   html{
  font-family: "dusha_plusregular";
}
</style>


</head>
<body>
@include('ajax.avatar')
    <div id="app">

        <nav class="navbar navbar-inverse navbar-fixed-top">
            
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
<!--
                    <a class="navbar-brand" href="{{ url('/home') }}">
-->
                        @if (Auth::check())
                        @can('administrador',Auth::user())
                        <a class="navbar-brand" href="{{ url('/admin') }}"><?php echo "<img id='a' style= 'cursor: pointer;' onclick='consultar(this.id);'  src=' " . asset("storage/upload/254645_w2.png") ."'> "; ?> </a>
                            @else
                         <a class="navbar-brand" href="{{ url('/home') }}"><?php echo "<img id='a' style= 'cursor: pointer;' onclick='consultar(this.id);'  src=' " . asset("storage/upload/254645_w2.png") ."'> "; ?>    </a>
                           
                            @endcan
                       
                        @endif
                     </div>
                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                    @if (Auth::check())
                    @can('administrador',Auth::user())
                        
                      @guest
                            &nbsp;
                        @else
                            <li class="nav-item">
            <a class="navbar-brand" href="{{ url('/equipo') }}">
                                Equipos</a>
                       
                        </li>
                            
                        @endguest
                    
                     
                      @guest
                            &nbsp;
                        @else
                        <li class="nav-item">
           <a class="navbar-brand" href="{{ url('/grupo') }}">
                                Administrar Grupos
                            </a>
          </li>
                           
                        
                        @endguest
                   
                    @endcan
                    @endif
                    
                      @guest
                            &nbsp;
                        @else
                       
                            <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                        Partidos <span class="caret"></span>
                                </a>
                        <ul class="dropdown-menu">
                                    <li>
                            <a  href="{{ url('/partido') }}">
                                Fase 1
                            </a>          </li>
                            <li>
                            <a  href="{{ url('/partido2') }}">
                                Fase 2
                            </a>          </li>
                            </ul>
                            </li>
                      @endguest
                    
                      @guest
                            &nbsp;
                        @else
                        <li class="nav-item">
<a class="navbar-brand" href="{{ url('/grupoPicture') }}">
                                Ver Grupos
                            </a>          </li>
                            
                        @endguest
                  
                      @guest
                            &nbsp;
                        @else
                        <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                        Apuestas <span class="caret"></span>
                                </a>
                        <ul class="dropdown-menu">
                                    <li>
                            <a  href="{{ url('/apuesta') }}">
                                Fase 1
                            </a>          </li>
                            <li>
                            <a  href="{{ url('/apuesta2') }}">
                                Fase 2
                            </a>          </li>
                            </ul>
                            </li>
                        @endguest
                        @guest
                            &nbsp;
                        @else
                        <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                        Posiciones <span class="caret"></span>
                                </a>
                        <ul class="dropdown-menu">
                                    <li>
                            <a  href="{{ url('/home') }}">
                                Fase 1
                            </a>          </li>
                            <li>
                            <a  href="{{ url('/homeb') }}">
                                Fase 2
                            </a>          </li>
                            </ul>
                            </li>
                        @endguest
                    </ul> 
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a onclick="update();">
                                            User
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
           
            </div>
        </nav>

        @yield('content')
    </div>
   
<div class="footer">
  <p><a href="{{ url('/admin/login') }}" style="color: #000000">*</a> @if (Auth::check())
                    @can('administrador',Auth::user())
                    <strong>(Administator)</strong>
                    @endcan
                    @endif</p>
</div>

	
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
    <script src="{{ asset('js/app.js') }}"></script>
    <style>
.footer {
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    background-color: black;
    color: white;
    text-align: center;
}
</style> 
<script type="text/javascript">

$.ajaxSetup({
  headers: {

    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

  }

});
function update(){
    
    $.get("{!! URL::to('home/update') !!}",null, function(data){
        $('#id').val(data.id)
        $('#name').val(data.name)
        console.log(data);
        $("#modalavatar").modal();
    });
}

</script>
</html>
