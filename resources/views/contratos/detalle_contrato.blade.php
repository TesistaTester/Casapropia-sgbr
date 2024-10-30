@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
    <h3 class="title-header" style="text-transform: uppercase;">
        <i class="fa fa-building"></i>
        {{$titulo}}
        <a href="{{url('urbanizaciones')}}" title="Volver a lista de urbanizaciones" data-placement="top" class="btn btn-sm btn-secondary float-right" style="margin-left:10px;"><i class="fa fa-angle-double-left"></i> ATRÁS</a>
    </h3>

    <div class="row">
        <div class="col-12" style="padding-right:0; border-right:2px solid #0d4a9a;">
            <div class="nav nav-pills" id="v-pills-tab">
                <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fa fa-database"></i> Datos generales</a>
                <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false"><i class="fa fa-apple"></i> Manzanos</a>
                <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false"><i class="fa fa-building"></i> Lotes</a>
                <a class="nav-link" id="v-pills-documents-tab" data-toggle="pill" href="#v-documents" role="tab" aria-controls="v-pills-documents" aria-selected="false"><i class="fa fa-folder-open"></i> Documentos adjuntos</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                    <h3 class="subtitle-header"><i class="fa fa-database"></i> DATOS GENERALES
                        {{-- <a href="#" title="Eliminar urbanización" data-toggle="modal" data-target="#modal-eliminar-urbanizacion" class="btn btn-sm btn-danger float-right" style="margin-left:10px;"><i class="fa fa-trash"></i> ELIMINAR</a>
                        <a href="{{url('urbanizaciones/'.$urbanizacion->urb_id.'/editar')}}" title="Editar datos de urbanización" class="btn btn-sm btn-primary float-right" style="margin-left:10px;"><i class="fa fa-edit"></i> EDITAR</a> --}}
                    </h3>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- inicio card  -->
                            <!-- fin card  -->
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    <h3 class="subtitle-header"><i class="fa fa-apple"></i>
                        MANZANOS
                        <a href="{{url('manzanos/nuevo/urb/'.1)}}" class="btn btn-sm btn-success float-right" style="margin-left:10px;"><i class="fa fa-plus"></i> NUEVO MANZANO</a>
                    </h3>
                    <!-- inicio card  -->
                    <!-- fin card  -->
                </div>
                <div class="tab-pane fade" id="v-documents" role="tabpanel" aria-labelledby="v-documents">
                    <h3 class="subtitle-header"><i class="fa fa-folder-open"></i>
                        DOCUMENTOS ADJUNTOS - URBANIZACION
                        <a href="{{url('urbanizaciones/'.Crypt::encryptString('a').'/nuevo_adjunto')}}" class="btn btn-sm btn-success float-right" style="margin-left:10px;"><i class="fa fa-plus"></i> NUEVO DOCUMENTO ADJUNTO</a>
                    </h3>
                    <!-- inicio card  -->
                    <!-- fin card  -->
                </div>

                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                    <h3 class="subtitle-header"><i class="fa fa-building"></i>
                        LOTES
                        <a href="{{url('lotes/nuevo/urb/')}}" class="btn btn-sm btn-success float-right" style="margin-left:10px;"><i class="fa fa-plus"></i> NUEVO LOTE</a>
                    </h3>
                    <!-- inicio card  -->
                    <!-- fin card  -->
                </div>
            </div>
        </div>
    </div>
</div>

{{-- INICIO MODAL: ELIMINAR URBANIZACION --}}
<div class="modal fade" id="modal-eliminar-urbanizacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-trash"></i>
              Eliminar urbanizacion
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <h2 class="text-center">
                <span class="text-success">URBANIZACION: </span>
                <span id="urb-desc-eliminar">{{$urbanizacion->urb_nombre}}</span>
            </h2>
            @if($urbanizacion->manzanos->count() == 0 && $urbanizacion->lotes->count() == 0)
            <div class="alert alert-danger">
                <div class="media">
                    <img src="{{asset('img/alert-danger.png')}}" class="align-self-center mr-3" alt="...">
                    <div class="media-body">
                        <h5 class="mt-0">Cuidado.-</h5>
                        <p>
                            ¿Está seguro que desea eliminar ésta urbanización?
                        </p>
                    </div>
                </div>
            </div>
            @else
            <div class="alert alert-warning">
                <div class="media">
                    <img src="{{asset('img/alert-warning.png')}}" class="align-self-center mr-3" alt="...">
                    <div class="media-body">
                        <h5 class="mt-0">Advertencia.-</h5>
                        <p>
                            Esta urbanización tiene manzanos y/o lotes asociados, por tanto no es posible eliminarlo.
                            <br>
                            <small>Asegurese de desvincular este registro de otros manzanos o lotes para eliminarlo.</small>
                        </p>
                    </div>
                </div>
            </div>
            @endif

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          @if($urbanizacion->manzanos->count() == 0 && $urbanizacion->lotes->count() == 0)
          <form action="{{url('urbanizaciones/'.$urbanizacion->urb_id)}}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">Si, eliminar</button>
          </form>
          @endif
        </div>
      </div>
    </div>
  </div>
  {{-- FIN MODAL: ELIMINAR URBANIZACION --}}

{{-- INICIO MODAL: ELIMINAR MANZANO --}}
<div class="modal fade" id="modal-eliminar-manzano" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-trash"></i>
              Eliminar manzano
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <h2 class="text-center">
                <span class="text-success">MANZANO: </span>
                <span id="man-desc-eliminar"></span>
            </h2>
            <div class="alert alert-danger" id="man-box-danger">
                <div class="media">
                    <img src="{{asset('img/alert-danger.png')}}" class="align-self-center mr-3" alt="...">
                    <div class="media-body">
                        <h5 class="mt-0">Cuidado.-</h5>
                        <p>
                            ¿Está seguro que desea eliminar éste manzano?
                        </p>
                    </div>
                </div>
            </div>

            <div class="alert alert-warning" id="man-box-warning">
                <div class="media">
                    <img src="{{asset('img/alert-warning.png')}}" class="align-self-center mr-3" alt="...">
                    <div class="media-body">
                        <h5 class="mt-0">Advertencia.-</h5>
                        <p>
                            Este manzano tiene lotes asociados, por tanto no es posible eliminarlo.
                            <br>
                            <small>Asegurese de desvincular este registro de otros lotes para eliminarlo.</small>
                        </p>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <form id="form-eliminar-manzano" action="{{url('manzanos')}}" method="post">
            @method('delete')
            @csrf
            <input type="hidden" name="urb_id" value="{{$urbanizacion->urb_id   }}">
            <button type="submit" class="btn btn-danger">Si, eliminar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  {{-- FIN MODAL: ELIMINAR MANZANO --}}

{{-- INICIO MODAL: ELIMINAR ADJUNTO --}}
<div class="modal fade" id="modal-eliminar-adjunto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-trash"></i>
              Eliminar documento adjunto
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="box-data-xtra">
                <h5>
                    <span class="text-success">DOCUMENTO: </span>
                    <span id="txt-descripcion"></span><br>
                </h5>
            </div>
            <div class="alert alert-danger">
                <div class="media">
                    <img src="{{asset('img/alert-danger.png')}}" class="align-self-center mr-3" alt="...">
                    <div class="media-body">
                        <h5 class="mt-0">Cuidado.-</h5>
                        <p>
                            ¿Está seguro que desea eliminar éste registro?
                        </p>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
          <form id="form-eliminar-adjunto" action="{{url('urbanizaciones/eliminar_adjunto')}}" method="post">
            @method('delete')
            @csrf
            {{-- <input type="hidden" name="lot_id" value="{{Crypt::encryptString($lote->lot_id)}}"> --}}
            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Si, eliminar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  {{-- FIN MODAL: ELIMINAR ADJUNTO --}}

{{-- INICIO MODAL: ELIMINAR LOTE --}}
<div class="modal fade" id="modal-eliminar-lote" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-trash"></i>
              Eliminar lote
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="box-data-xtra">
                <h5>
                    <span class="text-success">DOCUMENTO: </span>
                    <span id="txt-descripcion-lote"></span><br>
                </h5>
            </div>
            <div class="alert alert-danger">
                <div class="media">
                    <img src="{{asset('img/alert-danger.png')}}" class="align-self-center mr-3" alt="...">
                    <div class="media-body">
                        <h5 class="mt-0">Cuidado.-</h5>
                        <p>
                            ¿Está seguro que desea eliminar éste registro?
                        </p>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
          <form id="form-eliminar-lote" action="{{url('lotes')}}" method="post">
            @method('delete')
            @csrf
            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Si, eliminar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  {{-- FIN MODAL: ELIMINAR ADJUNTO --}}


  {{-- INICIO MODAL: CARGAR ARCHIVO GEOJSON --}}
@if($urbanizacion->urb_plano_geojson == null)
  <div class="modal fade" id="modal-cargar-geojson" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-map"></i>
              Cargar planos georeferenciados en formato GEOJSON
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="form-cargar-geojson" action="{{url('urbanizaciones/'.Crypt::encryptString($urbanizacion->urb_id).'/store_plano_inicial')}}" method="POST">
        @csrf
        <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="label-blue label-block" for="">
                                Seleccionar archivo GEOJSON:
                                <span class="text-danger">*</span>
                                <i class="fa fa-question-circle float-right" title="Cargar el archivo geojson que corresponde a la urbanización"></i>
                            </label>
                            <input required type="file" value="" class="form-control" name="urb_geo" id="urb_geo" placeholder="Archivo geojson de la urbanizacion" accept=".txt,.json,.geojson">
                        </div>
                    </div>
                </div>
                <section id="input-geojson">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                    <label class="label-blue label-block" for="">
                                        Contenido del archivo:
                                        <span class="text-danger">*</span>
                                        <i class="fa fa-question-circle float-right" title="En este campo puede revisar el contenido del archivo GEOJSON cargado"></i>
                                    </label>
                                <textarea name="urb_plano_geojson" id="urb_plano_geojson" class="form-control @error('urb_plano_geojson') is-invalid @enderror" rows="15" readonly>{{old('urb_plano_geojson')}}</textarea>    
                                @error('urb_plano_geojson')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>											
                                @enderror
                            </div>
                        </div>
                    </div>
                    </section>
                    <section id="map-geojson">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="mapa-verificacion" style="height: 480px;"></div>
                        </div>
                    </div>
                </section>
        </div>
        <div class="modal-footer">
            <span class="text-danger" id="btn-error-msg">
                <i class="fa fa-danger"></i>
                ERROR: Formato no compatible, intente nuevamente.
            </span>
            <button type="reset" class="btn btn-danger" id="btn-urb-reset-form">
                    <i class="fa fa-refresh"></i>
                    Limpiar formulario
            </button>
            <button type="button" class="btn btn-success" id="btn-validar-geojson">
                <i class="fa fa-check"></i>
                Validar GEOJSON
            </button>
            <button type="submit" class="btn btn-primary" id="btn-enviar-geojson">
                    <i class="fa fa-save"></i>
                    Guardar archivo GEOJSON
            </button>
        </div>
        </form>
      </div>
    </div>
  </div>
@endif
  {{-- FIN MODAL: CARGAR ARCHIVO GEOJSON --}}


<script type="text/javascript" async="defer">
$(function(){
    /*
    -------------------------------------------------------------
    * CONFIGURACION DATA TABLES
    -------------------------------------------------------------
    */
    $('.tabla-datos-lotes').DataTable({"language":{url: '{{asset('js/datatables-lang-es.json')}}'}, "order": [[ 0, "desc" ]]});

    /*
    --------------------------------------------------------------
    ELIMINAR LOTE
    --------------------------------------------------------------
    */
    $('.btn-eliminar-lote').click(function(){
       let apo_id = $(this).attr('data-lot-id');
       let apo_descripcion = $(this).attr('data-lot-descripcion');
       $('#txt-descripcion-lote').html(apo_descripcion);
       //form data
       action = $('#form-eliminar-lote').attr('action');
       action = action+'/'+apo_id;
       $('#form-eliminar-lote').attr('action', action);
   });

    
    /*
    --------------------------------------------------------------
    ELIMINAR ADJUNTO
    --------------------------------------------------------------
    */
    $('.btn-eliminar-adjunto').click(function(){
       let apo_id = $(this).attr('data-apo-id');
       let apo_descripcion = $(this).attr('data-apo-descripcion');
       $('#txt-descripcion').html(apo_descripcion);
       //form data
       action = $('#form-eliminar-adjunto').attr('action');
       action = action+'/'+apo_id;
       $('#form-eliminar-adjunto').attr('action',action);
   });
    


    @if($urbanizacion->urb_plano_geojson == null)
    /*
    ---------------------------------------------------------------------------------------
    CARGA DE ARCHIVO GEOJSON
    ---------------------------------------------------------------------------------------
    */
    //ocultar botones
    $('#btn-validar-geojson').hide();
    $('#btn-enviar-geojson').hide();
    $('#btn-urb-reset-form').hide();
    $('#btn-error-msg').hide();
    $('#map-geojson').hide();
	//Evento Change para input de geojson
	$('#urb_geo').change(function(e) {
		var fileName = e.target.files[0].name;
		var reader = new FileReader();
		reader.onload = function(e) {
			// get loaded data and render thumbnail.
            try{
                let json_parsed = JSON.parse(reader.result);
                let json_pretty = JSON.stringify(json_parsed, undefined, 4);
                $('#urb_plano_geojson').attr('readonly',false);
                document.getElementById("urb_plano_geojson").textContent = json_pretty;
            }catch(e){
                document.getElementById("urb_plano_geojson").textContent = '¡Error! El archivo no tiene el formato requerido. Intente nuevamente.';
            }
		};
		reader.readAsText(this.files[0]);
        $('#btn-urb-reset-form').slideDown();
        $('#btn-validar-geojson').slideDown();
        $('#btn-error-msg').hide();

	});	
    //variable global del mapa
    var mymap = null;
    //reset form
    $('#btn-urb-reset-form').click(function(){
        $('#urb_plano_geojson').html('');
        $('#btn-validar-geojson').slideUp();
        $('#btn-urb-reset-form').slideUp();

        $('#urb_plano_geojson').attr('readonly',true);
        $('#map-geojson').slideUp();
        $('#input-geojson').fadeIn();

        $('#btn-error-msg').hide();
        $('#urb_geo').attr('readonly',false);

        if (mymap && mymap.remove) {
            mymap.off();
            mymap.remove();
        }        
    });

    $('body').on('click', '#btn-validar-geojson', function(){

        mymap = L.map('mapa-verificacion')
                        // .setView([-16.987968509970777, -65.14336862612436], 5)
                        ;
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

        
        // funcion para aplicar estilos a las figuras
        function estilos(feature) {
            return {
                fillColor: '#113285',
                weight: 2,
                opacity: 1,
                color: '#125',
                dashArray: '2',
                fillOpacity: 0.85
            };
        }

        try{
            // datos en GeoJson
            var states = '[';
            var cierre_states = ']';
            states = JSON.parse(states + $('#urb_plano_geojson').val()+cierre_states);
            //Agregando GeoJson al mapa
            var lotes = L.geoJson(states, {
                style: estilos,
            }).addTo(mymap);    
            
            mymap.setView(lotes.getBounds().getCenter(), 17);

            $('#input-geojson').slideUp();
            $('#map-geojson').fadeIn();
            $('#btn-error-msg').hide();
            $('#btn-validar-geojson').slideUp();
            $('#urb_geo').attr('readonly',true);
            $('#btn-enviar-geojson').fadeIn();

            console.log("Todo ok");
        }catch (e){
            $('#btn-error-msg').fadeIn(200);
            // console.log("Ocurrio algun error");            
        }
    });
    @endif

    @if($urbanizacion->urb_plano_geojson != null)
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
            layer.bindPopup(feature.properties.Id);
        }
        layer.on({
            mouseover: highlightFeature,
            mouseout: resetHighlight,
            click: zoomToFeature
        });    
    }

    // CAPA BASE
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
        this._div.innerHTML = '<h4 class="text-primary">INFORMACION DE LA PROPIEDAD</h4>' +  (props ?
            '<h5>ID POLIGONO: <b>' + props.Id + '</b></h5><div class="text-center"><button class="btn btn-sm btn-info">Relacionar con propiedad en BD</button></div>'
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

    @endif

    
/*
--------------------------------------------------------------------------------------
MAPAS COROPLETICOS
--------------------------------------------------------------------------------------
*/
// var mymap = L.map('mapa-verificacion').setView([-16.987968509970777, -65.14336862612436], 5);
//AGREGAR MARCADOR
// var marker = L.marker(new L.LatLng(-16.987968509970777,-65.14336862612436), {
// 				        draggable: true
//         	}).addTo(mymap);
// marker.bindPopup('<b>Marcador apuntado</b><br>Ubicacion georeferenciada.').openPopup();

//AGREGAR POP-UPS: Funcion oneachfeature
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

//CAPA BASE
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
// var states = '[{ "TYPE": "FEATURECOLLECTION",';
// var cierre_states = '}]';

// funcion para colorear (operador ternario)
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

// funcion para aplicar estilos a las figuras
// function estilos(feature) {
//     return {
//         fillColor: '#fd0',
//         weight: 2,
//         opacity: 1,
//         color: 'white',
//         dashArray: '3',
//         fillOpacity: 0.7
//     };
// }

//funcion resaltar figura (mouseover)
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
//funcion para restaurar los estilos de la capa que fue hovered
// function resetHighlight(e) {
//     geojson.resetStyle(e.target);
//     info.update();
// }
//funcion para aplicar efecto de zoom sobre el feature
// function zoomToFeature(e) {
//     mymap.fitBounds(e.target.getBounds());
// }

/*
-------------------------------------------------------------------------------------------------
CONTROLES ADICIONALES DEL MAPA
-------------------------------------------------------------------------------------------------
*/
//Agregando GeoJson al mapa
// var geojson;
// geojson = L.geoJSON(states, {
//     style: estilos,
//     // filter: function(feature, layer) {
//     //     return feature.properties.mostrar;
//     // },
//     // onEachFeature: ponerTitulo
// }).addTo(mymap);        



});
</script>


@endsection