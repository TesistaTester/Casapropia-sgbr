@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
    <h3 class="title-header" style="text-transform: uppercase;">
        <i class="fa fa-key"></i>
        {{$titulo}}
    </h3>

    <div class="row">
        <div class="col-12" style="padding-right:0; border-right:2px solid #0d4a9a;">
            <div class="nav nav-pills" id="v-pills-tab">
                <a class="nav-link active" id="v-reales-tab" data-toggle="pill" href="#v-reales" role="tab" aria-controls="v-reales" aria-selected="false"><i class="fa fa-users"></i> Propietarios reales</a>
                <a class="nav-link" id="v-legales-tab" data-toggle="pill" href="#v-legales" role="tab" aria-controls="v-legales" aria-selected="false"><i class="fa fa-gavel"></i> Propietarios legales</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-reales" role="tabpanel" aria-labelledby="v-reales-tab">
                    <h3 class="subtitle-header"><i class="fa fa-users"></i> 
                        PROPIETARIOS REALES
                        <a href="{{url('propietarios_reales/nuevo')}}" class="btn btn-sm btn-success float-right" style="margin-left:10px;"><i class="fa fa-plus"></i> NUEVO PROPIETARIO REAL</a>
                    </h3>

                    <div id="map" style="height: 480px;"></div>

                    <!-- inicio card  -->
                    <div class="card card-stat">
                        <div class="card-body">
                            @if($reales->count() == 0)
                            <div class="alert alert-info">
                                <div class="media">
                                    <img src="{{asset('img/alert-info.png')}}" class="align-self-center mr-3" alt="...">
                                    <div class="media-body">
                                        <h5 class="mt-0">Nota.-</h5>
                                        <p>
                                            Aún no se tienen propietarios reales registrados.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @else
                            <table class="table table-bordered tabla-datos">
                                <thead>
                                <tr>
                                    <th>NOMBRE COMPLETO</th>
                                    <th>ULTIMA ACTUALIZACION</th>
                                    <th>OPCION</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($reales as $item)
                                <tr>
                                    <td>{{$item->persona->per_nombres}} {{$item->persona->per_primer_apellido}} {{$item->persona->per_segundo_apellido}}</td>
                                    <td>{{$item->updated_at}}</td>
                                    <td>
                                        <div class="dropdown">
                                          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            OPCION
                                          </button>
                                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{{url('propietarios_reales/'.$item->prr_id.'/editar')}}"><i class="fa fa-edit"></i> Editar</a>
                                            <a class="dropdown-item btn-eliminar-prr" data-prrid="{{$item->prr_id}}" data-cantprops="{{$item->cantidad_propiedades->count()}}" data-item_descripcion="{{$item->persona->per_nombres}} {{$item->persona->per_primer_apellido}} {{$item->persona->per_segundo_apellido}}" data-toggle="modal" data-target="#modal-eliminar-prr" href="#"><i class="fa fa-trash"></i> Eliminar</a>
                                          </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @endif
                        </div>
                    </div>
                    <!-- fin card  -->

                    
                </div>
                <div class="tab-pane fade" id="v-legales" role="tabpanel" aria-labelledby="v-legales-tab">
                    <h3 class="subtitle-header"><i class="fa fa-gavel"></i>
                        REGISTRO DE PROPIETARIOS LEGALES
                        <a href="{{url('propietarios_legales/nuevo')}}" class="btn btn-sm btn-success float-right" style="margin-left:10px;"><i class="fa fa-plus"></i> NUEVO PROPIETARIO LEGAL</a>
                    </h3>
                    <!-- inicio card  -->
                    <div class="card card-stat">
                        <div class="card-body">
                            @if($legales->count() == 0)
                            <div class="alert alert-info">
                                <div class="media">
                                    <img src="{{asset('img/alert-info.png')}}" class="align-self-center mr-3" alt="...">
                                    <div class="media-body">
                                        <h5 class="mt-0">Nota.-</h5>
                                        <p>
                                            Aún no se tienen propietarios legales registrados.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @else
                            <table class="table table-bordered tabla-datos">
                                <thead>
                                <tr>
                                    <th>NOMBRE COMPLETO</th>
                                    <th>ULTIMA ACTUALIZACION</th>
                                    <th>OPCION</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($legales as $item)
                                <tr>
                                    <td>{{$item->persona->per_nombres}} {{$item->persona->per_primer_apellido}} {{$item->persona->per_segundo_apellido}}</td>
                                    <td>{{$item->updated_at}}</td>
                                    <td>
                                        <div class="dropdown">
                                          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            OPCION
                                          </button>
                                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{{url('propietarios_legales/'.$item->ple_id.'/editar')}}"><i class="fa fa-edit"></i> Editar</a>
                                            <a class="dropdown-item btn-eliminar-ple" data-pleid="{{$item->ple_id}}" data-cantprops="{{$item->cantidad_propiedades->count()}}" data-item_descripcion="{{$item->persona->per_nombres}} {{$item->persona->per_primer_apellido}} {{$item->persona->per_segundo_apellido}}" data-toggle="modal" data-target="#modal-eliminar-ple" href="#"><i class="fa fa-trash"></i> Eliminar</a>
                                          </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @endif
                        </div>
                    </div>
                    <!-- fin card  -->

                </div>
            </div>
        </div>
    </div>
</div>


{{-- INICIO MODAL: ELIMINAR PROPIETARIO REAL --}}
<div class="modal fade" id="modal-eliminar-prr" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-trash"></i>
              Eliminar propietario real
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <h4 class="text-center">
                <span class="text-success">NOMBRE: </span>
                <span id="txt-eliminar-prr-nombre"></span>
            </h4>
            <div class="alert alert-danger" id="box-prr-danger">
                <div class="media">
                    <img src="{{asset('img/alert-danger.png')}}" class="align-self-center mr-3" alt="...">
                    <div class="media-body">
                        <h5 class="mt-0">Cuidado.-</h5>
                        <p>
                            ¿Está seguro que desea eliminar a éste propietario real?
                        </p>
                    </div>
                </div>
            </div>

            <div class="alert alert-warning" id="box-prr-warning">
                <div class="media">
                    <img src="{{asset('img/alert-warning.png')}}" class="align-self-center mr-3" alt="...">
                    <div class="media-body">
                        <h5 class="mt-0">Advertencia.-</h5>
                        <p>
                            Este propietario real tiene propiedades asignadas, por tanto no es posible eliminarlo.
                            <br>
                            <small>De ser necesario, asegurese de desvincular este propietario de los lotes asignados para eliminarlo.</small>
                        </p>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <form id="form-eliminar-propietarios-reales" action="{{url('propietarios_reales')}}" method="post">
            @method('delete')
            @csrf
            <button type="submit" class="btn btn-danger">Si, eliminar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  {{-- FIN MODAL: ELIMINAR PROPIETARIO REAL --}}

{{-- INICIO MODAL: ELIMINAR PROPIETARIO LEGAL --}}
<div class="modal fade" id="modal-eliminar-ple" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-trash"></i>
              Eliminar propietario legal
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <h4 class="text-center">
                <span class="text-success">NOMBRE: </span>
                <span id="txt-eliminar-ple-nombre"></span>
            </h4>
            <div class="alert alert-danger" id="box-ple-danger">
                <div class="media">
                    <img src="{{asset('img/alert-danger.png')}}" class="align-self-center mr-3" alt="...">
                    <div class="media-body">
                        <h5 class="mt-0">Cuidado.-</h5>
                        <p>
                            ¿Está seguro que desea eliminar a éste propietario legal?
                        </p>
                    </div>
                </div>
            </div>

            <div class="alert alert-warning" id="box-ple-warning">
                <div class="media">
                    <img src="{{asset('img/alert-warning.png')}}" class="align-self-center mr-3" alt="...">
                    <div class="media-body">
                        <h5 class="mt-0">Advertencia.-</h5>
                        <p>
                            Este propietario legal tiene propiedades asignadas, por tanto no es posible eliminarlo.
                            <br>
                            <small>De ser necesario, asegurese de desvincular este propietario de los lotes asignados para eliminarlo.</small>
                        </p>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <form id="form-eliminar-propietarios-legales" action="{{url('propietarios_legales')}}" method="post">
            @method('delete')
            @csrf
            <button type="submit" class="btn btn-danger">Si, eliminar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  {{-- FIN MODAL: ELIMINAR PROPIETARIO LEGAL --}}



<script type="text/javascript">

$(function(){
            //------------------------------------------------------------------------------------
            //FUNCIONES Y EVENTOS PARA ELIMINAR PROPIETARIO REAL
            //-------------------------------------------------------------------------------------
            $('#box-prr-danger').hide();
            $('#box-prr-warning').hide();
            $('#form-eliminar-propietarios-reales').hide();
            // EVENTO: click en el boton eliminar propietario real
            $('.btn-eliminar-prr').click(function(){
                $('#form-eliminar-propietarios-reales').hide();
                let prr_id = $(this).attr('data-prrid');
                let cant_props = $(this).attr('data-cantprops');
                if(cant_props == '0'){
                    //SI PUEDE ELIMINAR EL ITEM
                    $('#box-prr-warning').hide();
                    $('#box-prr-danger').show();
                    $('#form-eliminar-propietarios-reales').show();
                    let action = $('#form-eliminar-propietarios-reales').attr('action');
                    action = action + '/'+ prr_id;
                    $('#form-eliminar-propietarios-reales').attr('action', action);
                    $('#txt-eliminar-prr-nombre').html($(this).attr('data-item_descripcion'));
                }else{
                    //NO PUEDE ELIMINAR EL ITEM
                    $('#box-prr-danger').hide();
                    $('#box-prr-warning').show();
                    $('#txt-eliminar-prr-nombre').html($(this).attr('data-item_descripcion'));
                }
            });

            //------------------------------------------------------------------------------------
            //FUNCIONES Y EVENTOS PARA ELIMINAR PROPIETARIO LEGALES
            //-------------------------------------------------------------------------------------
            $('#box-ple-danger').hide();
            $('#box-ple-warning').hide();
            $('#form-eliminar-propietarios-legales').hide();
            // EVENTO: click en el boton eliminar legal
            $('.btn-eliminar-ple').click(function(){
                $('#form-eliminar-propietarios-legales').hide();
                let ple_id = $(this).attr('data-pleid');
                let cant_props = $(this).attr('data-cantprops');
                if(cant_props == '0'){
                    //SI PUEDE ELIMINAR EL ITEM
                    $('#box-ple-warning').hide();
                    $('#box-ple-danger').show();
                    $('#form-eliminar-propietarios-legales').show();
                    let action = $('#form-eliminar-propietarios-legales').attr('action');
                    action = action + '/'+ ple_id;
                    $('#form-eliminar-propietarios-legales').attr('action', action);
                    $('#txt-eliminar-ple-nombre').html($(this).attr('data-item_descripcion'));
                }else{
                    //NO PUEDE ELIMINAR EL ITEM
                    $('#box-ple-danger').hide();
                    $('#box-ple-warning').show();
                    $('#txt-eliminar-ple-nombre').html($(this).attr('data-item_descripcion'));
                }
            });


});



/*
--------------------------------------------------------------------------------------
MAPAS COROPLETICOS
--------------------------------------------------------------------------------------
*/
// var mymap = L.map('map').setView([37.8, -96], 5);
// //AGREGAR MARCADOR
// // var marker = L.marker(new L.LatLng(-16.987968509970777,-65.14336862612436), {
// // 				        draggable: true
// //         	}).addTo(mymap);
// // marker.bindPopup('<b>Marcador apuntado</b><br>Ubicacion georeferenciada.').openPopup();

// //AGREGAR POP-UPS: Funcion oneachfeature
// function ponerTitulo(feature, layer) {
//     // does this feature have a property named popupContent?
//     if (feature.properties && feature.properties.titulo) {
//         layer.bindPopup(feature.properties.titulo);
//     }
//     layer.on({
//         mouseover: highlightFeature,
//         mouseout: resetHighlight,
//         click: zoomToFeature
//     });    
// }

// //CAPA BASE
// var map_token = '{{config('casapropia.MAPBOX_ACCESS_TOKEN')}}';
// L.tileLayer("https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token="+map_token, {
// 			maxZoom: 20,
// 			attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
// 				'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
// 				'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
// 			id: 'mapbox/streets-v11',
// 			tileSize: 512,
// 			zoomOffset: -1
// 		}).addTo(mymap);

// // datos en GeoJson
// var states = [{
//     "type": "Feature",
//     "properties": {
//         "party": "Republican",
//         "mostrar": true,
//         "titulo" : "Region de republicanos",
//         "densidad": 21
//     },
//     "geometry": {
//         "type": "Polygon",
//         "coordinates": [[
//             [-104.05, 48.99],
//             [-97.22,  48.98],
//             [-96.58,  45.94],
//             [-104.03, 45.94],
//             [-104.05, 48.99]
//         ]]
//     }
// }, {
//     "type": "Feature",
//     "properties": {
//         "party": "Democrat",
//         "mostrar": true,
//         "titulo" : "Region de demócratas",
//         "densidad": 450
//     },
//     "geometry": {
//         "type": "Polygon",
//         "coordinates": [[
//             [-109.05, 41.00],
//             [-102.06, 40.99],
//             [-102.03, 36.99],
//             [-109.04, 36.99],
//             [-109.05, 41.00]
//         ]]
//     }
// }];

// // funcion para colorear (operador ternario)
// function colorear(d){
//     return d > 1000 ? '#800026' :
//            d > 500  ? '#BD0026' :
//            d > 200  ? '#E31A1C' :
//            d > 100  ? '#FC4E2A' :
//            d > 50   ? '#FD8D3C' :
//            d > 20   ? '#FEB24C' :
//            d > 10   ? '#FED976' :
//                       '#FFEDA0';
// }

// // funcion para aplicar estilos a las figuras
// function estilos(feature) {
//     return {
//         fillColor: colorear(feature.properties.densidad),
//         weight: 2,
//         opacity: 1,
//         color: 'white',
//         dashArray: '3',
//         fillOpacity: 0.7
//     };
// }

// //funcion resaltar figura (mouseover)
// function highlightFeature(e) {
//     var layer = e.target;//obtenemos la figura sobre la cual se tiene encima el ratón

//     layer.setStyle({
//         weight: 5,
//         color: '#666',
//         dashArray: '',
//         fillOpacity: 0.7
//     });

//     if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
//         layer.bringToFront();
//     }

//     info.update(layer.feature.properties);
// }
// //funcion para restaurar los estilos de la capa que fue hovered
// function resetHighlight(e) {
//     geojson.resetStyle(e.target);
//     info.update();
// }
// //funcion para aplicar efecto de zoom sobre el feature
// function zoomToFeature(e) {
//     mymap.fitBounds(e.target.getBounds());
// }

// //CONTROLES ADICIONALES AL MAPA
// //CONTROL INFORMATIVO
// var info = L.control();
// //funcion para adicionar el elemento div al mapa con clase info
// info.onAdd = function (map) {
//     this._div = L.DomUtil.create('div', 'info'); // create a div with a class "info"
//     this.update();
//     return this._div;
// };

// // method that we will use to update the control based on feature properties passed
// info.update = function (props) {
//     this._div.innerHTML = '<h5>INFORMACION DE LA PROPIEDAD</h5>' +  (props ?
//         '<h5><b>' + props.titulo + '</b><br />' + props.densidad + ' personas.</h5>'
//         : 'Apunta sobre una propiedad');
// };

// info.addTo(mymap);

// //CONTROL LEYENDA
// var legend = L.control({position: 'bottomright'});

// legend.onAdd = function (map) {

//     var div = L.DomUtil.create('div', 'info legend'),
//         grades = [0, 10, 20, 50, 100, 200, 500, 1000],
//         labels = [];

//     // loop through our density intervals and generate a label with a colored square for each interval
//     for (var i = 0; i < grades.length; i++) {
//         div.innerHTML += '<i style="background:' + colorear(grades[i] + 1) + '"></i> '+grades[i] + (grades[i + 1] ? '&ndash;' + grades[i + 1] + '<br>' : '+');
//     }

//     return div;
// };

// legend.addTo(mymap);

// //Agregando GeoJson al mapa
// var geojson;
// geojson = L.geoJSON(states, {
//     // style: function(feature) {
//     //     switch (feature.properties.party) {
//     //         case 'Republican': return {color: "#ff0000"};
//     //         case 'Democrat':   return {color: "#0000ff"};
//     //     }
//     // },
//     style: estilos,
//     filter: function(feature, layer) {
//         return feature.properties.mostrar;
//     },
//     onEachFeature: ponerTitulo
// }).addTo(mymap);        

/*
-------------------------------------------------------------------------------------------------
AGREGANDO MOVING MARKER
-------------------------------------------------------------------------------------------------
*/
// //Puntos por donde se moverá el marcador
// var londonParisRomeBerlinBucarest = [[51.507222, -0.1275], [48.8567, 2.3508], 
// [41.9, 12.5], [52.516667, 13.383333], [44.4166,26.1]];
// //creando un icono de marcador
// url_icon = '{{asset("img/avion.png")}}';
// var myicon = L.icon({
// iconUrl: url_icon,
// });

// //Agregando el marcador 
// var marker2 = L.Marker.movingMarker(londonParisRomeBerlinBucarest,
//     [30000, 20000, 50000, 30000], {autostart: true, icon: myicon}).addTo(mymap);
// //Agregando linea de varios puntos al mapa
// L.polyline(londonParisRomeBerlinBucarest, {color: 'blue'}).addTo(mymap);
// //ajustando el centro del mapa
// mymap.fitBounds(londonParisRomeBerlinBucarest);
</script>

@endsection
