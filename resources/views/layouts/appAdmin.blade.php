<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
   <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
   <link href="{{ asset('css/starter-template.css') }}" rel="stylesheet">
   <link href="{{ asset('css/bootstrap-theme.min.css') }}" rel="stylesheet">
   <link href="{{ asset('css/ie10-viewport-bug-workaround.css') }}" rel="stylesheet">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
   <meta name="csrf-token" content="{{ csrf_token() }}">


</head>
<body>

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
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                      @guest
                            &nbsp;
                        @else
                            <a class="navbar-brand" href="{{ url('/equipo') }}">
                                Equipos
                            </a>
                        @endguest
                    </ul>
                    <ul class="nav navbar-nav">
                      @guest
                            &nbsp;
                        @else
                            <a class="navbar-brand" href="{{ url('/grupo') }}">
                                Administrar Grupos
                            </a>
                        @endguest
                    </ul>
                     <!-- <ul class="nav navbar-nav">
                      @guest
                            &nbsp;
                        @else
                            <a class="navbar-brand" href="{{ url('/partido') }}">
                                Partidos
                            </a>
                      @endguest
                    </ul>
                    <ul class="nav navbar-nav">
                      @guest
                            &nbsp;
                        @else
                            <a class="navbar-brand" href="{{ url('/grupoPicture') }}">
                                Ver Grupos
                            </a>
                        @endguest
                    </ul> -->
                    <ul class="nav navbar-nav">
                      @guest
                            &nbsp;
                        @else
                            <a class="navbar-brand" href="{{ url('/apuesta') }}">
                                Apuestas
                            </a>
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
    
   
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
   
	
</body>
</html>
