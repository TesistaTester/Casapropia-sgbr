<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('titulo') - {{env('APP_NAME')}}</title>
    {{-- HOJAS DE ESTILO --}}
    <link rel="shortcut icon" href="{{url('img/favicon.ico')}}" type="image/x-icon">
	<link rel="icon" href="{{url('img/favicon.ico')}}" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="{{url('css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('css/ext.styles.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('css/font-awesome.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('css/leaflet.css')}}">
	<style>
        body{
          background-image: url('{{asset('img/bg-login.png')}}');
          background-position: center center;
          background-repeat: no-repeat;
          background-attachment: fixed;
          background-size: cover;
        }
    </style>
    {{-- SCRIPTS --}}
    <script src="{{url('js/jquery36.min.js')}}"></script>
    <script src="{{url('js/popper.min.js')}}"></script>
    <script src="{{url('js/bootstrap.min.js')}}"></script>
    <script src="{{url('js/leaflet.js')}}"></script>

</head>
<body>

    {{-- TOP MENÚ (INICIO) --}}
    <nav class="navbar navbar-expand-lg navbar-dark nav-top-menu sticky-top">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <a class="navbar-brand navbar-brand-centered" href="#">
                <img style="height:70px;" src="{{ asset('img/logo_casa_propia-white.png')}}" alt="..." class="">
            </a>
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="#">
                        <i class="fa fa-home"></i> INICIO <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fa fa-map"></i> URBANIZACIONES</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fa fa-tag"></i> ¿CÓMO COMPRAR?</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fa fa-smile-o"></i> TESTIMONIOS</span>
                    </a>
                </li>
            </ul>
            <div class="btn-group">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa fa-question-circle"></i> PREGUNTAS FRECUENTES</span>
                        </a>
                    </li>    
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa fa-shopping-bag"></i> NOSOTROS</span>
                        </a>
                    </li>    
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa fa-phone"></i> CONTACTOS</span>
                        </a>
                    </li>    
                </ul>
            </div>
        </div>
    </nav>

{{-- TOP MENÚ (FIN) --}}


    {{-- CONTENIDO PRINCIPAL (INICIO) --}}
    @yield('contenido')        
    {{-- CONTENIDO PRINCIPAL (FIN)--}}
    <script>
        $(function(){
            $('.login-box').hide();
            $('.login-box').fadeIn(2000);
        });
    </script>
</body>
</html>