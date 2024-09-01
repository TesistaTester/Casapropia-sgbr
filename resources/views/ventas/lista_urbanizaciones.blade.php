@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')
	<!-- CONTENIDO -->
	<div class="col-md-10 content-pane">
		<h3 class="title-header" style="text-transform: uppercase;">
			<i class="fa fa-building"></i>
			{{$titulo}}
			<a class="btn btn-sm btn-secondary float-right" style="margin-left:10px;" href="#"><i class="fa fa-chevron-left"></i> ATRAS</a>
		</h3>

			<!-- inicio card  -->
			<div class="card mb-3">
			  @if($urbanizaciones->count() == 0)
			  <br>
			  <div class="row">
				<div class="col-md-10 offset-md-1">
					<div class="alert alert-info">
					<div class="media">
						<img src="{{asset('img/alert-info.png')}}" class="align-self-center mr-3" alt="...">
						<div class="media-body">
							<h5 class="mt-0">Nota.-</h5>
							<p>
								No hay urbanizaciones registradas todavía. 
							</p>
						</div>
					</div>
				  </div>
				</div>
				</div>
			  @else
			  @foreach ($urbanizaciones as $item)
			  <input type="hidden" id="data-map-inicial" value="{{$item->urb_plano_geojson}}">
			  @endforeach
			  <div id="mapa-inicial" style="height: 580px;"></div>
			  @endif
			</div>
			<!-- fin card  -->

			<!-- PAGINACION INICIO -->
            {{$urbanizaciones->links()}}
			<!-- PAGINACION FIN -->


	</div><!-- END RIGHT CONTENT -->
</div>
<script src="https://unpkg.com/@turf/turf@6.5.0/turf.min.js"></script>
<script type="text/javascript" async="defer">
	$(function(){
		/*
		---------------------------------------------------------------------------------------
		MAPA EN GEOJSON INICIAL
		---------------------------------------------------------------------------------------
		*/
		var mymap = L.map('mapa-inicial').setView([-16.987968509970777, -65.14336862612436], 5);
	
		// AGREGAR POP-UPS: Funcion oneachfeature
		function ponerTitulo(feature, layer) {
			// does this feature have a property named 
			if (feature.properties && feature.properties.Id) {
				layer.bindPopup("<h3>SALUDOS</h3>");
			}
			layer.bindPopup("<h3>SALUDOS</h3>");
			// console.log("Un feature");
            // var centroid = turf.centroid(feature);
            // var latlng = L.latLng(centroid.geometry.coordinates[1], centroid.geometry.coordinates[0]);

			// L.marker(latlng).addTo(mymap).bindPopup("HOLA");
			
			layer.on({
				mouseover: highlightFeature,
				mouseout: resetHighlight,
				click: zoomToFeature
			});    
		}
	
		// CAPA BASE
		var map_token = '{{config('casapropia.MAPBOX_ACCESS_TOKEN')}}';
		// L.tileLayer("https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token="+map_token, {
		// 			maxZoom: 20,
		// 			attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
		// 				'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
		// 				'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		// 			id: 'mapbox/streets-v11',
		// 			tileSize: 512,
		// 			zoomOffset: -1
		// 		}).addTo(mymap);

        var googleRoadmap = L.tileLayer('https://mt1.google.com/vt/lyrs=r&x={x}&y={y}&z={z}&key=AIzaSyAAtnmKYcYoy-wxOBHxd3YCz_KWP0MQiKU', {
            maxZoom: 20,
            attribution: '&copy; <a href="https://www.google.com/maps">Google Maps</a>'
        }).addTo(mymap);

		var googleSatellite = L.tileLayer('https://mt1.google.com/vt/lyrs=s&x={x}&y={y}&z={z}&key=AIzaSyAAtnmKYcYoy-wxOBHxd3YCz_KWP0MQiKU', {
            maxZoom: 20,
            attribution: '&copy; <a href="https://www.google.com/maps">Google Maps</a>'
        });

        // Agregar un control de capas para cambiar entre Roadmap y Satellite
        var baseMaps = {
            "Rutas": googleRoadmap,
            "Satelital": googleSatellite
        };

        L.control.layers(baseMaps).addTo(mymap);		

	
		// datos en GeoJson
		var states = JSON.parse($('#data-map-inicial').val());
	
		// funcion para colorear (operador ternario)
		function colorear(d){
			return d > 1000 ? '#800026' :
				d > 500  ? '#BD0026' :
				d > 200  ? '#E31A1C' :
				d > 100  ? '#FC4E2A' :
				d > 50   ? '#FD8D3C' :
				d > 20   ? '#FEB24C' :
				d > 10   ? '#FED976' :
							'#FFEDA0';
		}
	
		// funcion para aplicar estilos a las figuras
		function estilos(feature) {
			return {
				fillColor: '#113285',
				weight: 2,
				opacity: 1,
				color: '#125',
				dashArray: '3',
				fillOpacity: 0.7
			};
		}
	
		// funcion resaltar figura (mouseover)
		function highlightFeature(e) {
			var layer = e.target;//obtenemos la figura sobre la cual se tiene encima el ratón
	
			layer.setStyle({
				weight: 5,
				color: '#666',
				dashArray: '',
				fillOpacity: 0.7
			});
	
			if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
				layer.bringToFront();
			}
	
			info.update(layer.feature.properties);
		}
		// funcion para restaurar los estilos de la capa que fue hovered
		function resetHighlight(e) {
			geojson.resetStyle(e.target);
			info.update();
		}
		// funcion para aplicar efecto de zoom sobre el feature
		function zoomToFeature(e) {
			mymap.fitBounds(e.target.getBounds());
		}
	
		//CONTROLES ADICIONALES AL MAPA
		//CONTROL INFORMATIVO
		var info = L.control();
		//funcion para adicionar el elemento div al mapa con clase info
		info.onAdd = function (map) {
			this._div = L.DomUtil.create('div', 'info'); // create a div with a class "info"
			this.update();
			return this._div;
		};
	
		// method that we will use to update the control based on feature properties passed
		info.update = function (props) {
			this._div.innerHTML = '<h4>INFORMACION DE LA PROPIEDAD</h4>' +  (props ?
				'<h6>ID PROPIEDAD: <b>' + props.Id + '</b></h6><h6>CODIGO LOTE: <b>2</b></h6><h6>MATRICULA: <b>002</b></h6><h6>SUPERFICIE: <b>250 M2</b></h6><h6>SUPERFICIE CONSTRUIDA: <b>80 M2</b></h6><h6>ANCHO DE VIA: <b>14 M</b></h6><h6>TIPO DE VENTA: <b>AL CONTADO</b></h6><h6>MONEDA DE VENTA: <b>DOLARES</b></h6><h6>PRECIO DE VENTA: <b>5.000</b></h6><h6>CUOTA INICIAL: <b>1.000</b></h6><br><div class="text-center"><button class="btn btn-sm btn-info">Reservar</button>&nbsp;<button target="_blank" class="btn btn-sm btn-secondary">Registrar clientes</button>&nbsp;<button class="btn btn-sm btn-success">Registrar contrato</button></div>'
				: 'Apunta sobre una propiedad');
		};
	
		info.addTo(mymap);
	
	
		/*
		-------------------------------------------------------------------------------------------------
		CONTROLES ADICIONALES DEL MAPA
		-------------------------------------------------------------------------------------------------
		*/
		// Agregando GeoJson al mapa
		var geojson;
		geojson = L.geoJSON(states, {
			style: estilos,
			// filter: function(feature, layer) {
			//     return feature.properties.mostrar;
			// },
			onEachFeature: ponerTitulo
		}).addTo(mymap);        
	
		mymap.setView(geojson.getBounds().getCenter(), 17);
		
	
	});
	</script>
	


@endsection