<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta content="" name="description" />
    <meta name="author" content="Fabricio Yassuda" />
    <meta name="keywords" content="" />
    
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="pt_BR">
    <meta property="og:url" content="http://projetoafeto.siteoficial.ws/" />
    <meta property="og:title" content=" Projeto Afeto - Rael e os Pequenos Guerreiros" />
    <meta property="og:image" content="http://projetoafeto.siteoficial.ws/logo.png" />
    <meta property="og:site_name" content="Projeto Afeto" />
    <meta property="og:description" content="" />
    
    
    <meta itemprop=”name” content="Projeto Afeto - Rael e os Pequenos Guerreiros" />
    <meta itemprop=”description” content="" />
    <meta itemprop=”image” content="http://projetoafeto.siteoficial.ws/imagens/logo.png" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Tauri" rel="stylesheet">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'Projeto Afeto') }}</title> --}}
    <title>Projeto Afeto</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link href="{{ asset('css/welcome_css.css') }}" rel="stylesheet">
    
    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>
    <div id="app">

        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                        
                    </button>
                    <a class="navbar-brand" href="{{ url('/') }}">Projeto Afeto</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li><a href="{{ url('post/main') }}">Nossa História</a></li>
                        <li><a href="{{ url('galeria') }}">Galeria de fotos</a></li>
                        <li><a href="{{ url('post/colabore') }}">Colabore com o Projeto</a></li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                    
                    <form class="navbar-form navbar-left" action="{{ url('/pesquisar')}}" method="get">
                        <div class="input-group">
                            <input type="text" name="pesquisa_post" class="form-control" placeholder="Título do Post">
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <i class="glyphicon glyphicon-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                        {{--<li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li> --}}
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                            {{-- <li><a href="{{ route('register') }}">Register</a></li> --}}
                        @else

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                        
                                        <a href="{{ route('gerenciador') }}" target="_blank">Gerenciador</a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}

                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif                        
                    </ul>

                </div>
            </div>
        </nav>
    </div>
    
    @yield('content')
    
    <div id="footer">
        @yield('footer')
    </div>
    <div id="poweredby">
        <p><a href="http://fabricioyassuda.tempsite.ws/" target="_blank">Fabricio Yassuda - Soluções em Tecnologia</a></p>
    </div>


</body>
</html>
