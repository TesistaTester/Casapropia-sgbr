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

    {{-- CONTENIDO PRINCIPAL (FIN)--}}
    <script src="{{url('js/jquery36.min.js')}}"></script>
    <script src="{{url('js/popper.min.js')}}"></script>
    <script src="{{url('js/bootstrap.min.js')}}"></script>

    <style>
        body{
          background-image: url('{{asset('img/bg-login.png')}}');
          background-position: center center;
          background-repeat: no-repeat;
          background-attachment: fixed;
          background-size: cover;
          transition:0.8s;
        }
        /* body:hover{
          transform: scale(1.05);
        } */
    </style>
</head>
<body>
    {{-- CONTENIDO PRINCIPAL (INICIO) --}}
    @yield('contenido')        
    <script>
        $(function(){
            $('.login-box').hide();
            $('.login-box').fadeIn(2000);
        });
    </script>
</body>
</html>