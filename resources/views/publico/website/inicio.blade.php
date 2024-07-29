@extends('layouts.publico')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-12 content-pane">
    <div class="box-slide1">
        <div class="row">
            <div class="col-md-12">
                <div id="cf1">
                    <img src="{{asset('img/banner_01.png')}}" alt="Imagen 1" style="width:100%;">
                    <img src="{{asset('img/banner_02.png')}}" alt="Imagen 1" style="width:100%;">
                    <img src="{{asset('img/banner_03.png')}}" alt="Imagen 1" style="width:100%;">
                    <img src="{{asset('img/banner_01.png')}}" alt="Imagen 1" style="width:100%;">
                    <img src="{{asset('img/banner_02.png')}}" alt="Imagen 1" style="width:100%;">
                    <img src="{{asset('img/banner_03.png')}}" alt="Imagen 1" style="width:100%;">
                </div>    
            </div>
        </div>    
    </div>

    <h2 class="titulo-amarillo text-center">
        <i class="fa fa-map"></i>
            NUESTRAS URBANIZACIONES
    </h2>
    <div class="">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><i class="fa fa-star"></i> Cobertura nacional</li>
                    <li class="list-group-item"><i class="fa fa-star"></i> Operamos casi en todo el país</li>
                    <li class="list-group-item"><i class="fa fa-star"></i> Con los mejores buses del mercado</li>
                    <li class="list-group-item"><i class="fa fa-star"></i> Y todas las medidas de bioseguridad</li>
                    <li class="list-group-item"><i class="fa fa-star"></i> A los mejores destinos de nuestra amada Bolivia</li>
                </ul>        
                        <br id="seccion_destinos">        
            </div>
        </div>    
    </div>


    <div class="row">
        <div class="col-10 offset-md-1">
            <h2 class="titulo-amarillo text-center">
                <i class="fa fa-tag"></i>
                    ¿CÓMO COMPRAR UNA PROPIEDAD?
            </h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{asset('img/foto_lapaz.jpg')}}" class="card-img-top" alt="...">
                        <div class="card-body">                        
                            <h5 class="card-title">LA PAZ</h5>
                            <p class="card-text">La ciudad maravilla. Fundada el 20 de octubre de 1779. </p>
                        </div>
                    </div>    
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{asset('img/foto_cochabamba.png')}}" class="card-img-top" alt="...">
                        <div class="card-body">                        
                            <h5 class="card-title">COCHABAMBA</h5>
                            <p class="card-text">La ciudad maravilla. Fundada el 20 de octubre de 1779. </p>
                        </div>
                    </div>    
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{asset('img/foto_santacruz.jpg')}}" class="card-img-top" alt="...">
                        <div class="card-body">                        
                            <h5 class="card-title">SANTA CRUZ</h5>
                            <p class="card-text">La ciudad maravilla. Fundada el 20 de octubre de 1779. </p>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-10 offset-md-1">
            <h2 class="titulo-amarillo text-center">
                <i class="fa fa-smile-o"></i>
                    TESTIMONIOS DE NUESTROS CLIENTES
            </h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{asset('img/foto_lapaz.jpg')}}" class="card-img-top" alt="...">
                        <div class="card-body">                        
                            <h5 class="card-title">LA PAZ</h5>
                            <p class="card-text">La ciudad maravilla. Fundada el 20 de octubre de 1779. </p>
                        </div>
                    </div>    
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{asset('img/foto_cochabamba.png')}}" class="card-img-top" alt="...">
                        <div class="card-body">                        
                            <h5 class="card-title">COCHABAMBA</h5>
                            <p class="card-text">La ciudad maravilla. Fundada el 20 de octubre de 1779. </p>
                        </div>
                    </div>    
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{asset('img/foto_santacruz.jpg')}}" class="card-img-top" alt="...">
                        <div class="card-body">                        
                            <h5 class="card-title">SANTA CRUZ</h5>
                            <p class="card-text">La ciudad maravilla. Fundada el 20 de octubre de 1779. </p>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-10 offset-md-1">
            <h2 class="titulo-amarillo text-center">
                <i class="fa fa-question-circle"></i>
                    PREGUNTAS FRECUENTES
            </h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{asset('img/foto_lapaz.jpg')}}" class="card-img-top" alt="...">
                        <div class="card-body">                        
                            <h5 class="card-title">LA PAZ</h5>
                            <p class="card-text">La ciudad maravilla. Fundada el 20 de octubre de 1779. </p>
                        </div>
                    </div>    
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{asset('img/foto_cochabamba.png')}}" class="card-img-top" alt="...">
                        <div class="card-body">                        
                            <h5 class="card-title">COCHABAMBA</h5>
                            <p class="card-text">La ciudad maravilla. Fundada el 20 de octubre de 1779. </p>
                        </div>
                    </div>    
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{asset('img/foto_santacruz.jpg')}}" class="card-img-top" alt="...">
                        <div class="card-body">                        
                            <h5 class="card-title">SANTA CRUZ</h5>
                            <p class="card-text">La ciudad maravilla. Fundada el 20 de octubre de 1779. </p>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-10 offset-md-1">
            <h2 class="titulo-amarillo text-center">
                <i class="fa fa-shopping-bag"></i>
                    MÁS SOBRE NOSOTROS
            </h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{asset('img/foto_lapaz.jpg')}}" class="card-img-top" alt="...">
                        <div class="card-body">                        
                            <h5 class="card-title">LA PAZ</h5>
                            <p class="card-text">La ciudad maravilla. Fundada el 20 de octubre de 1779. </p>
                        </div>
                    </div>    
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{asset('img/foto_cochabamba.png')}}" class="card-img-top" alt="...">
                        <div class="card-body">                        
                            <h5 class="card-title">COCHABAMBA</h5>
                            <p class="card-text">La ciudad maravilla. Fundada el 20 de octubre de 1779. </p>
                        </div>
                    </div>    
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{asset('img/foto_santacruz.jpg')}}" class="card-img-top" alt="...">
                        <div class="card-body">                        
                            <h5 class="card-title">SANTA CRUZ</h5>
                            <p class="card-text">La ciudad maravilla. Fundada el 20 de octubre de 1779. </p>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </div>



    <br id="seccion_contactos">

    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-md-5 offset-md-1">
                    <div id="mapa-oficina" style="width:100%; height: 300px;"></div>
                </div>
                <div class="col-md-5">
                    <br>
                    <h2 class="titulo-amarillo text-center">
                        <i class="fa fa-phone"></i>
                        CONTACTOS
                    </h2>
                    <h3 class="text-center">
                       Acercate a una de nuestras sucursales o contáctate al Whatsapp +591 55441122.
                       <br>
                       Tambien puedes seguirnos en nuestras redes sociales. 
                       <br>
                        <a class="btn btn-light btn-lg" href="facebook.com">
                            <i class="fa fa-facebook-square"></i> Facebook
                        </a>
                        <a class="btn btn-light btn-lg" href="facebook.com">
                            <i class="fa fa-youtube-square"></i> Youtube
                        </a>
                        <a class="btn btn-light btn-lg" href="facebook.com">
                            <i class="fa fa-instagram"></i> Instagram
                        </a>
                    </h3>
                </div>
            </div>
        </div>
    </div>



    <footer>
        &copy; {{date('Y')}} {{env('APP_NAME')}}. Todos los derechos reservados.
    </footer>
    
</div>


<script type="text/javascript">

	/*
	--------------------------------------------------------------------------------------
	MAPA DE OFICINA
	--------------------------------------------------------------------------------------
	*/
	var mymap = L.map('mapa-oficina').setView([-16.491385,-68.2120388], 13);
	//AGREGAR MARCADOR
	var marker = L.marker(new L.LatLng(-16.491385,-68.2120388), {}).addTo(mymap);
	marker.bindPopup('Oficina Casa Propia').openPopup();

	//CAPA BASE
	var map_token = '{{config('casapropia.MAPBOX_ACCESS_TOKEN')}}';
	L.tileLayer("https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token="+map_token, {
				maxZoom: 20,
				attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
					'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
					'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
				id: 'mapbox/streets-v11',
				tileSize: 512,
				zoomOffset: -1
			}).addTo(mymap);
</script>




@endsection
