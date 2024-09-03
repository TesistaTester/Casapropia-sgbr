@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
    <h3 class="title-header" style="text-transform: uppercase;">
        <i class="fa fa-building"></i>
        {{$titulo}} <small> - Urbanizacion: {{$urbanizacion->urb_nombre}}</small>
        <a href="{{url('urbanizaciones')}}" title="Volver a lista de urbanizaciones" data-placement="top" class="btn btn-sm btn-secondary float-right" style="margin-left:10px;"><i class="fa fa-angle-double-left"></i> ATRÁS</a>
    </h3>
    {{-- <h2>{{$ip}}</h2> --}}
    <div class="row">
        <div class="col-md-12" style="padding-right:0; border-right:2px solid #0d4a9a;">
            <div class="nav nav-pills" id="v-pills-tab">
                <a class="nav-link active" id="v-general-tab" data-toggle="pill" href="#v-general" role="tab" aria-controls="v-general" aria-selected="false"><i class="fa fa-database"></i> Datos generales</a>
                {{-- <a class="nav-link" id="v-modalidad-tab" data-toggle="pill" href="#v-modalidad" role="tab" aria-controls="v-modalidad" aria-selected="false"><i class="fa fa-tags"></i> Modalidad venta </a>
                <a class="nav-link" id="v-disponibilidad-tab" data-toggle="pill" href="#v-disponibilidad" role="tab" aria-controls="v-disponibilidad" aria-selected="false"><i class="fa fa-check"></i> Estados</a> --}}
                <a class="nav-link" id="v-propietarios-tab" data-toggle="pill" href="#v-propietarios" role="tab" aria-controls="v-propietarios" aria-selected="true"><i class="fa fa-users"></i> Propietarios</a>
                {{-- <a class="nav-link" id="v-contratos-tab" data-toggle="pill" href="#v-contratos" role="tab" aria-controls="v-contratos" aria-selected="false"><i class="fa fa-file"></i> Contratos</a> --}}
                <a class="nav-link" id="v-adjuntos-tab" data-toggle="pill" href="#v-adjuntos" role="tab" aria-controls="v-adjuntos" aria-selected="false"><i class="fa fa-folder-open"></i> Documentos adjuntos</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-general" role="tabpanel" aria-labelledby="v-general-tab">
                    <h3 class="subtitle-header"><i class="fa fa-database"></i> DATOS GENERALES
                        {{-- <a href="#" title="Eliminar propiedad" data-toggle="modal" data-target="#modal-eliminar-lote" class="btn btn-sm btn-danger float-right" style="margin-left:10px;"><i class="fa fa-trash"></i> ELIMINAR</a>
                        <a href="{{url('lotes/'.$lote->lot_id.'/editar')}}" title="Editar datos del lote" class="btn btn-sm btn-primary float-right" style="margin-left:10px;"><i class="fa fa-edit"></i> EDITAR</a> --}}
                    </h3>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- inicio card  -->
                            <div class="card mb-3">
                              <div class="row no-gutters">
                                <div class="col-md-3">
                                        <img class="corner-47" style="width: 100%" src="{{asset('img/bg-urbanizacion.png')}}" alt="Foto urbanizacion">
                                    <a title="Actualizar fotografía de la propiedad" href="{{asset('urbanizaciones/detalle/1')}}" class="btn btn-primary btn-block btn-sm corner-0 corner-37"><i class="fa fa-image"></i> ACTUALIZAR FOTO</a>
                                </div>
                                <div class="col-md-9">
                                  <div class="card-body">
                                    <h2 class="card-title"><strong><span class="text-primary">LOTE:</span> {{Str::upper($lote->lot_nro)}}</strong></h2>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <h5 class="card-title"><span class="text-success">URBANIZACION:</span> <br>{{$urbanizacion->urb_nombre}}</h5>
                                                </div>
                                                <div class="col-md-4">
                                                    <h5 class="card-title"><span class="text-success">MANZANO:</span> <br>{{$manzano->man_nombre}}</h5>
                                                </div>
                                                <div class="col-md-4">
                                                    <h5 class="card-title"><span class="text-success">CODIGO:</span> <br>
                                                        @if(Str::of($lote->lot_codigo)->trim()->isEmpty())
                                                        <small>[No definido]</small>
                                                        @else
                                                        {{$lote->lot_codigo}}
                                                        @endif
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <h5 class="card-title"><span class="text-success">MATRICULA:</span> <br>
                                                        @if(Str::of($lote->lot_matricula)->trim()->isEmpty())
                                                        <small>[No definido]</small>
                                                        @else
                                                        {{$lote->lot_matricula}}
                                                        @endif
                                                        
                                                    </h5>
                                                </div>
                                                <div class="col-md-4">
                                                    <h5 class="card-title"><span class="text-success">SUPERFICIE TOTAL (m<sup>2</sup>):</span> <br>
                                                        @if(Str::of($propiedad->pro_superficie)->trim()->isEmpty())
                                                        <small>[No definido]</small>
                                                        @else
                                                        {{$propiedad->pro_superficie}}
                                                        @endif
                                                    </h5>
                                                </div>
                                                <div class="col-md-4">
                                                    <h5 class="card-title"><span class="text-success">SUPERFICIE CONSTRUIDA (m<sup>2</sup>):</span> <br>
                                                        @if(Str::of($lote->lot_superficie_construida)->trim()->isEmpty())
                                                        <small>[No definido]</small>
                                                        @else
                                                        {{$lote->lot_superficie_construida}}
                                                        @endif
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <h5 class="card-title"><span class="text-success">ANCHO DE VIA (m<sup>2</sup>):</span> <br>
                                                        @if(Str::of($lote->ancho_via)->trim()->isEmpty())
                                                        <small>[No definido]</small>
                                                        @else
                                                        {{$lote->ancho_via}}
                                                        @endif
                                                    </h5>
                                                </div>
                                                <div class="col-md-4">
                                                    <h5 class="card-title"><span class="text-success">MURO PERIMETRAL:</span> <br>
                                                        @if(Str::of($propiedad->pro_muro_perimetral)->trim()->isEmpty())
                                                        <small>[No definido]</small>
                                                        @else
                                                        {{$propiedad->pro_muro_perimetral}}
                                                        @endif
                                                        
                                                    </h5>
                                                </div>
                                                <div class="col-md-4">
                                                    <h5 class="card-title"><span class="text-success">DESCRIPCIÓN:</span> <br>
                                                        @if(Str::of($propiedad->pro_descripcion)->trim()->isEmpty())
                                                        <small>[No definido]</small>
                                                        @else
                                                        {{$propiedad->pro_descripcion}}
                                                        @endif
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <h5 class="card-title"><span class="text-success">NRO DE INMUEBLE:</span> <br>
                                                        @if(Str::of($propiedad->pro_nro_inmueble)->trim()->isEmpty())
                                                        <small>[No definido]</small>
                                                        @else
                                                        {{$lote->propiedad->pro_nro_inmueble}}
                                                        @endif
                                                    </h5>
                                                </div>
                                                <div class="col-md-4">
                                                    <h5 class="card-title"><span class="text-success">BASE IMPONIBLE:</span> <br>
                                                        @if(Str::of($propiedad->pro_base_imponible)->trim()->isEmpty())
                                                        <small>[No definido]</small>
                                                        @else
                                                        {{$propiedad->pro_base_imponible}}
                                                        @endif
                                                        
                                                    </h5>
                                                </div>
                                            </div>

                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- fin card  -->
                            {{-- <h3 class="text-primary">
                                <i class="fa fa-flag"></i>
                                ESTADO DE PROPIEDADES
                            </h3>
                            <div class="row">
                                <div class="col-md-3">
                                    <!-- inicio card  -->
                                    <div class="card card-stat">
                                        <div class="card-body text-center">
                                            <h1 class="text-stat text-success">34</h1>
                                            <h5>EN PAGOS</h5>
                                        </div>
                                    </div>
                                    <!-- fin card  -->
                                </div>
                                <div class="col-md-3">
                                    <!-- inicio card  -->
                                    <div class="card card-stat">
                                        <div class="card-body text-center">
                                            <h1 class="text-stat text-success">5</h1>
                                            <h5>VENDIDO</h5>
                                        </div>
                                    </div>
                                    <!-- fin card  -->
                                </div>
                                <div class="col-md-3">
                                    <!-- inicio card  -->
                                    <div class="card card-stat">
                                        <div class="card-body text-center">
                                            <h1 class="text-stat text-success">9</h1>
                                            <h5>OTRO</h5>
                                        </div>
                                    </div>
                                    <!-- fin card  -->
                                </div>
                                <div class="col-md-3">
                                    <!-- inicio card  -->
                                    <div class="card card-stat">
                                        <div class="card-body text-center">
                                            <h1 class="text-stat text-success">7</h1>
                                            <h5>EN PAGOS</h5>
                                        </div>
                                    </div>
                                    <!-- fin card  -->
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="v-modalidad" role="tabpanel" aria-labelledby="v-modalidad-tab">
                    <h3 class="subtitle-header"><i class="fa fa-tags"></i>
                        MODALIDAD DE VENTA
                        <a href="{{url('modalidades_venta/nuevo/lote/'.Crypt::encryptString($lote->lot_id))}}" class="btn btn-sm btn-success float-right" style="margin-left:10px;"><i class="fa fa-plus"></i> NUEVA MODALIDAD</a>
                    </h3>
                    <div class="alert alert-info alert-not-persistent">
                        <div class="media">
                            <img src="{{asset('img/alert-info.png')}}" class="align-self-center mr-3" alt="...">
                            <div class="media-body">
                                <h5 class="mt-0">Nota.-</h5>
                                <ul>
                                    <li>
                                    La propiedad puede tener un historial de modalidades de venta, pero solo una modalidad estará activa a lo largo del tiempo.
                                    </li>
                                    <li>
                                    En el historial, las modalidades en <span class="badge badge-pill badge-danger">rojo</span> NO estan activas, y la modalidad en <span class="badge badge-pill badge-success">verde</span> es la activa.
                                    </li>
                                    <li>
                                    Una vez la propiedad tenga un contrato de compra-venta, ya no podrá crear más modalidades.
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- inicio card  -->
                    <div class="card card-stat">
                        <div class="card-body">
                            @if($modalidades->count() == 0)
                            <div class="alert alert-info">
                                <div class="media">
                                    <img src="{{asset('img/alert-info.png')}}" class="align-self-center mr-3" alt="...">
                                    <div class="media-body">
                                        <h5 class="mt-0">Nota.-</h5>
                                        <p>
                                            La propiedad NO tiene una modalidad de venta registrada. 
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @else
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>TIPO DE VENTA</th>
                                    <th>MONEDA</th>
                                    <th>MONTO INTERES</th>
                                    <th>TASA INTERES</th>
                                    <th>CUOTA INICIAL</th>
                                    <th>PLAZO</th>
                                    <th>PRECIO DE OFERTA</th>
                                    <th>PRECIO MINIMO</th>
                                    <th>PRECIO TOTAL MINIMO</th>
                                    <th>OPCION</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($modalidades as $item)
                                @if($item->mov_activo == 1)
                                <tr class="table-success">
                                @else
                                <tr class="table-danger">
                                @endif
                                    <td>
                                        @if($item->mov_tipo_venta == 0)
                                        AL CONTADO
                                        @endif
                                        @if($item->mov_tipo_venta == 1)
                                        A PAGOS
                                        @endif
                                        @if($item->mov_tipo_venta == 2)
                                        A CRÉDITO
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->mov_moneda_venta == 0)
                                        BOLIVIANOS
                                        @endif
                                        @if($item->mov_moneda_venta == 1)
                                        DOLARES
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        @if($item->mov_tipo_venta == 2)
                                        {{$item->mov_monto_interes}}
                                        @else
                                        -
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        @if($item->mov_tipo_venta == 2)
                                        {{$item->mov_tasa_interes}}
                                        @else
                                        -
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        @if($item->mov_tipo_venta == 1 || $item->mov_tipo_venta == 2)
                                        {{$item->mov_cuota_inicial}}
                                        @else
                                        -
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($item->mov_tipo_venta == 1 || $item->mov_tipo_venta == 2)
                                        {{$item->mov_plazo}}
                                        @else
                                        -
                                        @endif
                                    </td>
                                    <td class="text-right">{{$item->mov_precio_oferta}}</td>
                                    <td class="text-right">{{$item->mov_precio_minimo}}</td>
                                    <td class="text-right">{{$item->mov_precio_total_minimo}}</td>
                                    <td>
                                        <div class="dropdown">
                                          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            OPCION
                                          </button>
                                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                             @if($item->mov_activo == 1)
                                                 @if($contratos->count() > 0)
                                                 <a class="dropdown-item" href="#" title="La propiedad ya tiene contrato vigente. No es posible editar este registro."><i class="fa fa-edit"></i> Editar</a>
                                                 @else
                                                 <a class="dropdown-item" href="{{url('modalidades_venta/'.Crypt::encryptString($item->mov_id).'/editar')}}"><i class="fa fa-edit"></i> Editar</a>
                                                 @endif
                                             @else    
                                             <a class="dropdown-item" href="#" title="Este registro no está vigente y no es posible editarlo."><i class="fa fa-edit"></i> Editar</a>
                                             @endif 
                                             @if($item->mov_activo == 1)
                                                @if($contratos->count() > 0)
                                                <a class="dropdown-item" title="La propiedad ya tiene contrato vigente. No es posible eliminar este registro." href="#"><i class="fa fa-trash"></i> Eliminar</a>
                                                @else
                                                <a class="dropdown-item btn-eliminar-modalidad" data-mov-id="{{Crypt::encryptString($item->mov_id)}}" data-mov-tipo="{{$item->mov_tipo_venta}}" data-mov-moneda="{{$item->mov_moneda_venta}}" data-mov-precio-oferta="{{$item->mov_precio_oferta}}" data-mov-precio-minimo="{{$item->mov_precio_minimo}}" data-toggle="modal" data-target="#modal-eliminar-modalidad" href="#"><i class="fa fa-trash"></i> Eliminar</a>
                                                @endif
                                             @else    
                                                <a class="dropdown-item" href="#" title="Este registro no está vigente y no es posible eliminarlo."><i class="fa fa-trash"></i> Eliminar</a>
                                             @endif 
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
                <div class="tab-pane fade" id="v-disponibilidad" role="tabpanel" aria-labelledby="v-disponibilidad-tab">
                    <h3 class="subtitle-header"><i class="fa fa-check"></i>
                        ESTADOS DE DISPONIBILIDAD
                        <a href="{{url('estados/nuevo/lote/'.Crypt::encryptString($lote->lot_id))}}" class="btn btn-sm btn-success float-right" style="margin-left:10px;"><i class="fa fa-plus"></i> NUEVO ESTADO</a>
                    </h3>
                    <div class="alert alert-info alert-not-persistent">
                        <div class="media">
                            <img src="{{asset('img/alert-info.png')}}" class="align-self-center mr-3" alt="...">
                            <div class="media-body">
                                <h5 class="mt-0">Nota.-</h5>
                                <ul>
                                    <li>
                                    La propiedad puede tener un historial de estados, pero solo un estado que estará activo a lo largo del tiempo.
                                    </li>
                                    <li>
                                    En el historial, los estados en <span class="badge badge-pill badge-danger">rojo</span> NO estan activos, y el estado en <span class="badge badge-pill badge-success">verde</span> es el activo.
                                    </li>
                                    <li>
                                    Una vez la propiedad tenga un contrato de compra-venta registrado, ya no podrá crear o modificar el estado vigente.
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- inicio card -->
                    <div class="card card-stat">
                        <div class="card-body">
                            @if($estados->count() == 0)
                            <div class="alert alert-info">
                                <div class="media">
                                    <img src="{{asset('img/alert-info.png')}}" class="align-self-center mr-3" alt="...">
                                    <div class="media-body">
                                        <h5 class="mt-0">Nota.-</h5>
                                        <p>
                                            La propiedad NO tiene estados registrados todavía.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @else
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ESTADO</th>
                                        <th>FECHA</th>
                                        <th>DESCRIPCIÓN</th>
                                        <th>ACTIVO</th>
                                        <th>OPCION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($estados as $item)
                                    @if($item->esp_activo == '1')
                                    <tr class="table-success">
                                    @else
                                    <tr class="table-danger">
                                    @endif
                                    <td>{{$item->estado->edi_estado}}</td>
                                    <td>{{$item->esp_fecha}}</td>
                                        <td>
                                            @if ($item->esp_descripcion == '' | $item->esp_descripcion == NULL)
                                            &laquo; Ninguna &raquo;
                                            @else
                                            {{$item->esp_descripcion}}
                                            @endif
                                        </td>
                                        <td>
                                            @if($item->esp_activo == '1')
                                            <span class="badge badge-success">SI</span>
                                            @else
                                            <span class="badge badge-danger">NO</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                OPCION
                                              </button>
                                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                {{-- EDITAR --}}
                                                @if($item->esp_activo == 1)
                                                    @if($contratos->count() > 0)
                                                    <a class="dropdown-item" href="#" title="La propiedad ya tiene contrato vigente. No es posible editar este registro."><i class="fa fa-edit"></i> Editar</a>
                                                    @else
                                                    <a class="dropdown-item" href="{{url('estados/'.Crypt::encryptString($item->esp_id).'/editar')}}"><i class="fa fa-edit"></i> Editar</a>
                                                    @endif
                                                @else    
                                                    <a class="dropdown-item" href="#" title="Este registro no está vigente y no es posible editarlo."><i class="fa fa-edit"></i> Editar</a>
                                                @endif 
                                                {{-- ELIMINAR --}}
                                                @if($item->edi_id == 1)
                                                <a class="dropdown-item" href="#" title="Este es el primer estado de la propiedad. No es posible eliminarlo"><i class="fa fa-trash"></i> Eliminar</a>
                                                @else
                                                    @if($item->esp_activo == 1)
                                                        @if($contratos->count() > 0)
                                                        <a class="dropdown-item" title="La propiedad ya tiene contrato vigente. No es posible eliminar este registro." href="#"><i class="fa fa-trash"></i> Eliminar</a>
                                                        @else
                                                        <a class="dropdown-item btn-eliminar-estado" data-esp-id="{{Crypt::encryptString($item->esp_id)}}" data-esp-estado="{{$item->estado->edi_estado}}" data-toggle="modal" data-target="#modal-eliminar-estado" href="#"><i class="fa fa-trash"></i> Eliminar</a>
                                                        @endif
                                                    @else    
                                                        <a class="dropdown-item" href="#" title="Este registro no está vigente y no es posible eliminarlo."><i class="fa fa-trash"></i> Eliminar</a>
                                                    @endif 
                                                @endif
                                            

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
                <div class="tab-pane fade" id="v-propietarios" role="tabpanel" aria-labelledby="v-propietarios-tab">
                    <h3 class="subtitle-header"><i class="fa fa-users"></i>
                        PROPIETARIOS
                    </h3>
                    <div class="alert alert-info alert-not-persistent">
                        <div class="media">
                            <img src="{{asset('img/alert-info.png')}}" class="align-self-center mr-3" alt="...">
                            <div class="media-body">
                                <h5 class="mt-0">Nota.-</h5>
                                <p>
                                    Tenga en cuenta que la propiedad debe tener al menos 1 propietario real y al menos 1 propietario legal.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h4>PROPIETARIOS REALES
                                @if($porcentaje_disponible > 0)
                                <button class="btn btn-sm btn-success float-right" style="margin-left:10px;"  data-toggle="modal" data-target="#modal-asignar-propietario-real"><i class="fa fa-plus"></i> ASIGNAR PROPIETARIO REAL</button>
                                @else
                                <button class="btn btn-sm btn-secondary float-right" style="margin-left:10px;" title="La propiedad ya tiene el 100% de participacion asignado"><i class="fa fa-lock"></i> 100% asignado</button>
                                @endif
                            </h4>
                            <!-- inicio card  -->
                            <div class="card card-stat">
                                <div class="card-body">
                                    @if($prr_asignados->count() == 0)
                                    <div class="alert alert-warning">
                                        <div class="media">
                                            <img src="{{asset('img/alert-warning.png')}}" class="align-self-center mr-3" alt="...">
                                            <div class="media-body">
                                                <h5 class="mt-0">Aviso.-</h5>
                                                <p>
                                                    La propiedad no tiene propietarios (reales) registrados.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>NOMBRE COMPLETO</th>
                                            <th>PARTICIPACIÓN (en %)</th>
                                            <th>OPCION</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($prr_asignados as $item)
                                        <tr>
                                            <td class="prr_nombre">{{$item->per_nombres}} {{$item->per_primer_apellido}} {{$item->per_segundo_apellido}}</td>
                                            <td class="text-center prr_participacion">{{$item->apr_participacion}}</td>
                                            <td>
                                                <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    OPCION
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    @if($contratos->count() == 0)
                                                    <a class="dropdown-item btn-editar-apr" data-item-participacion="{{$item->apr_participacion}}" data-item-descripcion="{{$item->apr_descripcion}}" data-aprid="{{Crypt::encryptString($item->apr_id)}}" data-toggle="modal" data-target="#modal-editar-apr"><i class="fa fa-edit"></i> Editar</a>
                                                    <a class="dropdown-item btn-eliminar-apr" data-item-participacion="{{$item->apr_participacion}}" data-aprid="{{Crypt::encryptString($item->apr_id)}}" data-toggle="modal" data-target="#modal-eliminar-apr" href="#"><i class="fa fa-trash"></i> Eliminar</a>
                                                    @else
                                                    <a class="dropdown-item" href="#" title="No es posible editar o eliminar la asignación. La propiedad ya tiene contrato(s) vigente(s)."><i class="fa fa-trash"></i> Editar - eliminar (no permitido)</a>
                                                    @endif
                                                </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                              <td class="text-right">TOTAL:</td>
                                              <td class="text-center">{{100-$porcentaje_disponible}}</td>
                                              <td></td>
                                            </tr>
                                          </tfoot>
                                    </table>
                                    @endif
                                </div>
                            </div>
                            <!-- fin card  -->
                        </div>
                        <div class="col-md-6">
                            <h4>PROPIETARIOS LEGALES
                                <button class="btn btn-sm btn-success float-right" style="margin-left:10px;"  data-toggle="modal" data-target="#modal-asignar-propietario-legal"><i class="fa fa-plus"></i> ASIGNAR PROPIETARIO LEGAL</button>
                            </h4>
                            <!-- inicio card  -->
                            <div class="card card-stat">
                                <div class="card-body">
                                    @if($ple_asignados->count() == 0)
                                    <div class="alert alert-warning">
                                        <div class="media">
                                            <img src="{{asset('img/alert-warning.png')}}" class="align-self-center mr-3" alt="...">
                                            <div class="media-body">
                                                <h5 class="mt-0">Aviso.-</h5>
                                                <p>
                                                    La propiedad no tiene propietarios (legales) registrados.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>NOMBRE COMPLETO</th>
                                            <th>OPCION</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($ple_asignados as $item)
                                        <tr>
                                            <td class="ple_nombre">{{$item->per_nombres}} {{$item->per_primer_apellido}} {{$item->per_segundo_apellido}}</td>
                                            <td>
                                                <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    OPCION
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    @if($contratos->count() == 0)
                                                    <a class="dropdown-item btn-editar-apl" data-item-descripcion="{{$item->apl_descripcion}}" data-aplid="{{Crypt::encryptString($item->apl_id)}}" data-toggle="modal" data-target="#modal-editar-apl"><i class="fa fa-edit"></i> Editar</a>
                                                    <a class="dropdown-item btn-eliminar-apl" data-aplid="{{Crypt::encryptString($item->apl_id)}}" data-toggle="modal" data-target="#modal-eliminar-apl" href="#"><i class="fa fa-trash"></i> Eliminar</a>
                                                    @else
                                                    <a class="dropdown-item" href="#" title="No es posible editar o eliminar la asignación. La propiedad ya tiene contrato(s) vigente(s)."><i class="fa fa-trash"></i> Editar - eliminar (no permitido)</a>
                                                    @endif
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
                <div class="tab-pane fade" id="v-contratos" role="tabpanel" aria-labelledby="v-contratos">
                    <h3 class="subtitle-header"><i class="fa fa-file"></i>
                        CONTRATOS DEL LOTE
                    </h3>
                    <div class="alert alert-info alert-not-persistent">
                        <div class="media">
                            <img src="{{asset('img/alert-info.png')}}" class="align-self-center mr-3" alt="...">
                            <div class="media-body">
                                <h5 class="mt-0">Nota.-</h5>
                                <ul>
                                    <li>
                                    La propiedad puede tener un historial de contratos a lo largo del tiempo.
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- inicio card  -->
                    <div class="card card-stat">
                        <div class="card-body">
                            @if($contratos->count() == 0)
                            <div class="alert alert-info">
                                <div class="media">
                                    <img src="{{asset('img/alert-info.png')}}" class="align-self-center mr-3" alt="...">
                                    <div class="media-body">
                                        <h5 class="mt-0">Nota.-</h5>
                                        <p>
                                            La propiedad NO tiene contratos registrados. 
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @else
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>TIPO DE VENTA</th>
                                    <th>MONEDA</th>
                                    <th>MONTO INTERES</th>
                                    <th>TASA INTERES</th>
                                    <th>CUOTA INICIAL</th>
                                    <th>PLAZO</th>
                                    <th>PRECIO DE OFERTA</th>
                                    <th>PRECIO MINIMO</th>
                                    <th>PRECIO TOTAL MINIMO</th>
                                    <th>OPCION</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($contratos as $item)
                                @if($item->mov_activo == 1)
                                <tr class="table-success">
                                @else
                                <tr class="table-danger">
                                @endif
                                    <td>
                                        @if($item->mov_tipo_venta == 0)
                                        AL CONTADO
                                        @endif
                                        @if($item->mov_tipo_venta == 1)
                                        A PAGOS
                                        @endif
                                        @if($item->mov_tipo_venta == 2)
                                        A CRÉDITO
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->mov_moneda_venta == 0)
                                        BOLIVIANOS
                                        @endif
                                        @if($item->mov_moneda_venta == 1)
                                        DOLARES
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        @if($item->mov_tipo_venta == 2)
                                        {{$item->mov_monto_interes}}
                                        @else
                                        -
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        @if($item->mov_tipo_venta == 2)
                                        {{$item->mov_tasa_interes}}
                                        @else
                                        -
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        @if($item->mov_tipo_venta == 1 || $item->mov_tipo_venta == 2)
                                        {{$item->mov_cuota_inicial}}
                                        @else
                                        -
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($item->mov_tipo_venta == 1 || $item->mov_tipo_venta == 2)
                                        {{$item->mov_plazo}}
                                        @else
                                        -
                                        @endif
                                    </td>
                                    <td class="text-right">{{$item->mov_precio_oferta}}</td>
                                    <td class="text-right">{{$item->mov_precio_minimo}}</td>
                                    <td class="text-right">{{$item->mov_precio_total_minimo}}</td>
                                    <td>
                                        <div class="dropdown">
                                          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            OPCION
                                          </button>
                                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                             @if($item->mov_activo == 1)
                                                 @if($contratos->count() > 0)
                                                 <a class="dropdown-item" href="#" title="La propiedad ya tiene contrato vigente. No es posible editar este registro."><i class="fa fa-edit"></i> Editar</a>
                                                 @else
                                                 <a class="dropdown-item" href="{{url('modalidades_venta/'.Crypt::encryptString($item->mov_id).'/editar')}}"><i class="fa fa-edit"></i> Editar</a>
                                                 @endif
                                             @else    
                                             <a class="dropdown-item" href="#" title="Este registro no está vigente y no es posible editarlo."><i class="fa fa-edit"></i> Editar</a>
                                             @endif 
                                             @if($item->mov_activo == 1)
                                                @if($contratos->count() > 0)
                                                <a class="dropdown-item" title="La propiedad ya tiene contrato vigente. No es posible eliminar este registro." href="#"><i class="fa fa-trash"></i> Eliminar</a>
                                                @else
                                                <a class="dropdown-item btn-eliminar-modalidad" data-mov-id="{{Crypt::encryptString($item->mov_id)}}" data-mov-tipo="{{$item->mov_tipo_venta}}" data-mov-moneda="{{$item->mov_moneda_venta}}" data-mov-precio-oferta="{{$item->mov_precio_oferta}}" data-mov-precio-minimo="{{$item->mov_precio_minimo}}" data-toggle="modal" data-target="#modal-eliminar-modalidad" href="#"><i class="fa fa-trash"></i> Eliminar</a>
                                                @endif
                                             @else    
                                                <a class="dropdown-item" href="#" title="Este registro no está vigente y no es posible eliminarlo."><i class="fa fa-trash"></i> Eliminar</a>
                                             @endif 
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

                <div class="tab-pane fade" id="v-adjuntos" role="tabpanel" aria-labelledby="v-adjuntos">
                    <h3 class="subtitle-header"><i class="fa fa-folder-open"></i>
                        DOCUMENTOS ADJUNTOS - LOTE
                        <a href="{{url('lotes/'.Crypt::encryptString($lote->lot_id).'/nuevo_adjunto')}}" class="btn btn-sm btn-success float-right" style="margin-left:10px;"><i class="fa fa-plus"></i> NUEVA DOCUMENTO ADJUNTO</a>
                    </h3>
                    <div class="alert alert-info alert-not-persistent">
                        <div class="media">
                            <img src="{{asset('img/alert-info.png')}}" class="align-self-center mr-3" alt="...">
                            <div class="media-body">
                                <h5 class="mt-0">Nota.-</h5>
                                <ul>
                                    <li>
                                    La propiedad puede tener documentos adjuntos digitalizados, como el folio real, impuestos, entre otros.
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- inicio card  -->
                    <div class="card card-stat">
                        <div class="card-body">
                            @if($adjuntos->count() == 0)
                            <div class="alert alert-info">
                                <div class="media">
                                    <img src="{{asset('img/alert-info.png')}}" class="align-self-center mr-3" alt="...">
                                    <div class="media-body">
                                        <h5 class="mt-0">Nota.-</h5>
                                        <p>
                                            La propiedad NO tiene documentos adjuntos registrados. 
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @else
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center">DESCRIPCION DEL DOCUMENTO</th>
                                    <th class="text-center">ENLACE</th>
                                    <th class="text-center">FECHA Y HORA DE CARGA</th>
                                    <th class="text-center">OPCION</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($adjuntos as $item)
                                <tr>
                                    <td class="text-center">{{$item->apo_descripcion}}</td>
                                    <td class="text-center">
                                        <a target="_blank" href="{{asset('storage/'.$item->apo_ruta)}}" class="btn btn-sm btn-link">
                                            <i class="fa fa-file"></i> Ver documento
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        {{$item->updated_at}}
                                    </td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            OPCION
                                          </button>
                                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item btn-eliminar-adjunto" data-apo-id="{{Crypt::encryptString($item->apo_id)}}" data-apo-descripcion="{{$item->apo_descripcion}}" data-toggle="modal" data-target="#modal-eliminar-adjunto" href="#"><i class="fa fa-trash"></i> Eliminar</a>
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

{{-- INICIO MODAL: ASIGNAR PROPIETARIO REAL --}}
<div class="modal fade" id="modal-asignar-propietario-real" tabindex="-1" role="dialog" aria-labelledby="ModelPropietarioLegal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-plus"></i>
              Asignar propietario real a la propiedad
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{url('lotes/asignar_prr/'.$propiedad->pro_id)}}" method="post">
            @csrf
            @method('post')
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>
                        <span class="text-success">LOTE: </span>
                        <span id="urb-desc-eliminar">{{$lote->lot_nro}}</span>
                    </h4>
                </div>
                <div class="col-md-6">
                    <h5>
                        <span class="text-success">MANZANO: </span>
                        <span id="urb-desc-eliminar">{{$manzano->man_nombre}}</span>
                    </h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h5>
                        <span class="text-success">URBANIZACION: </span>
                        <span id="urb-desc-eliminar">{{$urbanizacion->urb_nombre}}</span>
                    </h5>
                </div>
            </div>

            <div id="table-propietarios-reales">
                @if($prr_libres->count() == 0)
                <div class="alert alert-warning">
                    <div class="media">
                        <img src="{{asset('img/alert-warning.png')}}" class="align-self-center mr-3" alt="...">
                        <div class="media-body">
                            <h5 class="mt-0">Aviso.-</h5>
                            <p>
                                No se tienen propietarios reales disponibles.
                                <br>
                                <small>Puede registrar propietarios haciendo <a href="{{url('propietarios')}}">click aquí</a></small>
                            </p>
                        </div>
                    </div>
                </div>
                @else
                <table class="table table-bordered tabla-datos">
                    <thead>
                        <tr>
                            <th>NOMBRE PROPIETARIO</th>
                            <th>OPCION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($prr_libres as $item)
                        <tr>
                            <td>{{$item->per_nombres}} {{$item->per_primer_apellido}} {{$item->per_segundo_apellido}}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-success btn-adicionar-prr" data-prrid="{{$item->prr_id}}"> 
                                    <i class="fa fa-plus"></i>
                                    Adicionar
                                </button>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                </table>
              @endif
            </div>

          <div id="box-participacion">
              <div class="row">
                  <div class="col-md-12">
                    <h5>
                        <span class="text-success">NOMBRE DEL PROPIETARIO REAL</span><br>
                        <span id="txt-propietario-real"></span>
                    </h5>
                  </div>
              </div>
              <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="form-group">
                        <label class="label-blue label-block" for="">
                            Participación del propietario (en %):
                            <i class="fa fa-question-circle float-right" title="Establecer el porcentaje de participación del propietario sobre la propiedad"></i>
                            <br>
                            <small>Porcentaje disponible: {{$porcentaje_disponible}}%</small>
                        </label>
                        <input required pattern="^[1-9][0-9]*$" type="range" value="0" min="0" max="{{$porcentaje_disponible}}" step="1" id="apr_participacion" name="apr_participacion" class="form-control">
                        <small>Estas asignando <strong><output>0</output>%</strong> de participacion a este propietario. </small>
                    </div>                    
                    <div class="form-group">
                        <label class="label-blue label-block" for="">
                            Algún comentario adicional sobre la asignación:
                            <i class="fa fa-question-circle float-right" title="Establecer alguna descripcion o comentario adicional"></i>
                        </label>
                        <textarea required class="form-control" id="apr_descripcion" name="apr_descripcion"></textarea>
                    </div>                    
                </div>
              </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            <i class="fa fa-times"></i>
            Cerrar
          </button>
          <button type="reset" class="btn btn-danger" id="btn-clear-propietario-real">
            <i class="fa fa-trash"></i>
            Limpiar selección
          </button>
          @if($prr_libres->count() > 0)
          <input type="hidden" name="lot_id" id="lot_id" value="{{Crypt::encrypt($lote->lot_id)}}">
          <input type="hidden" name="pro_id" id="pro_id" value="{{$propiedad->pro_id}}">
          <input type="hidden" name="prr_id" id="prr_id">
            <button type="submit" class="btn btn-primary" id="btn-guardar-adicionar-propietario-real">
                <i class="fa fa-save"></i>    
                Guardar
            </button>
          @endif
        </div>
    </form>

    </div>
    </div>
  </div>
  {{-- FIN MODAL: ASIGNAR PROPIETARIO REAL --}}

{{-- INICIO MODAL: ASIGNAR PROPIETARIO LEGAL --}}
<div class="modal fade" id="modal-asignar-propietario-legal" tabindex="-1" role="dialog" aria-labelledby="ModelPropietarioLegal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-plus"></i>
              Asignar propietario legal a la propiedad
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{url('lotes/asignar_ple/'.$propiedad->pro_id)}}" method="post">
            @csrf
            @method('post')

        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>
                        <span class="text-success">LOTE: </span>
                        <span>{{$lote->lot_nro}}</span>
                    </h4>
                </div>
                <div class="col-md-6">
                    <h5>
                        <span class="text-success">MANZANO: </span>
                        <span>{{$manzano->man_nombre}}</span>
                    </h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h5>
                        <span class="text-success">URBANIZACION: </span>
                        <span>{{$urbanizacion->urb_nombre}}</span>
                    </h5>
                </div>
            </div>

            <div id="table-propietarios-legales">
                @if($ple_libres->count() == 0)
                <div class="alert alert-warning">
                    <div class="media">
                        <img src="{{asset('img/alert-warning.png')}}" class="align-self-center mr-3" alt="...">
                        <div class="media-body">
                            <h5 class="mt-0">Aviso.-</h5>
                            <p>
                                No se tienen propietarios legales disponibles.
                                <br>
                                <small>Puede registrar propietarios haciendo <a href="{{url('propietarios')}}">click aquí</a></small>
                            </p>
                        </div>
                    </div>
                </div>
                @else
                <table class="table table-bordered tabla-datos">
                    <thead>
                        <tr>
                            <th>NOMBRE PROPIETARIO LEGAL</th>
                            <th>OPCION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ple_libres as $item)
                        <tr>
                            <td>{{$item->per_nombres}} {{$item->per_primer_apellido}} {{$item->per_segundo_apellido}}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-success btn-adicionar-ple" data-pleid="{{$item->ple_id}}"> 
                                    <i class="fa fa-plus"></i>
                                    Adicionar
                                </button>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                </table>
              @endif
            </div>

          <div id="box-propietarios-legales">
              <div class="row">
                  <div class="col-md-12">
                    <h5>
                        <span class="text-success">NOMBRE DEL PROPIETARIO LEGAL</span><br>
                        <span id="txt-propietario-legal"></span>
                    </h5>
                    <div class="form-group">
                        <label class="label-blue label-block" for="">
                            Algún comentario adicional sobre la asignación:
                            <i class="fa fa-question-circle float-right" title="Establecer alguna descripcion o comentario adicional"></i>
                        </label>
                        <textarea required class="form-control" id="apl_descripcion" name="apl_descripcion"></textarea>
                    </div>                    

                  </div>
              </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            <i class="fa fa-times"></i>
            Cerrar
          </button>
          <button type="reset" class="btn btn-danger" id="btn-clear-propietario-legal">
            <i class="fa fa-trash"></i>
            Limpiar selección
          </button>
          @if($ple_libres->count() > 0)
          <input type="hidden" name="lot_id" id="lot_id" value="{{Crypt::encrypt($lote->lot_id)}}">
          <input type="hidden" name="pro_id" id="pro_id" value="{{$propiedad->pro_id}}">
            <input type="hidden" name="ple_id" id="ple_id">
            <button type="submit" class="btn btn-primary" id="btn-guardar-adicionar-propietario-legal">
                <i class="fa fa-save"></i>    
                Guardar
            </button>
          @endif
        </div>
    </form>

    </div>
    </div>
  </div>
  {{-- FIN MODAL: ASIGNAR PROPIETARIO LEGAL --}}



  @if($contratos->count() == 0)
  {{-- INICIO MODAL: EDITAR ASIGNACION PROPIETARIO REAL --}}
<div class="modal fade" id="modal-editar-apr" tabindex="-1" role="dialog" aria-labelledby="ModelPropietarioLegal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-edit"></i>
              Editar Asignación propietario real a la propiedad
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="form-editar-apr" action="" data-action="{{url('lotes/editar_prr')}}" method="post">
            @csrf
            @method('post')
        <div class="modal-body">
            <div class="row">
                <div class="col-md-5 offset-md-1">
                    <h5>
                        <span class="text-success">LOTE: </span>
                        <span id="txt-lote-editar-apr">{{$lote->lot_nro}}</span>
                    </h4>
                </div>
                <div class="col-md-5">
                    <h5>
                        <span class="text-success">MANZANO: </span>
                        <span id="txt-manzano-editar-apr">{{$manzano->man_nombre}}</span>
                    </h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <h5>
                        <span class="text-success">URBANIZACION: </span>
                        <span id="txt-urbanizacion-editar-apr">{{$urbanizacion->urb_nombre}}</span>
                    </h5>
                </div>
            </div>
          <div id="box-participacion">
              <div class="row">
                  <div class="col-md-10 offset-md-1">
                    <h5>
                        <span class="text-success">NOMBRE DEL PROPIETARIO REAL</span><br>
                        <span id="txt-propietario-real-editar-apr"></span>
                    </h5>
                  </div>
              </div>
              <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="form-group">
                        <label class="label-blue label-block" for="">
                            Participación del propietario (en %):
                            <i class="fa fa-question-circle float-right" title="Establecer el porcentaje de participación del propietario sobre la propiedad"></i>
                            <br>
                            <small>Porcentaje disponible: <span id="txt_apr_participacion_disponible"></span>%</small>
                        </label>
                        <input type="hidden" id="apr_participacion_disponible" value="{{$porcentaje_disponible}}">
                        <input required pattern="^[1-9][0-9]*$" type="range" min="0" max="0" step="1" id="apr_participacion_edit" name="apr_participacion_edit" class="form-control">
                        <small>Estas asignando <strong><output id="apr-porcent-participacion">0</output>%</strong> de participacion a este propietario. </small>
                    </div>                    
                    <div class="form-group">
                        <label class="label-blue label-block" for="">
                            Algún comentario adicional sobre la asignación:
                            <i class="fa fa-question-circle float-right" title="Establecer alguna descripcion o comentario adicional"></i>
                        </label>
                        <textarea class="form-control" id="apr_descripcion_edit" name="apr_descripcion_edit"></textarea>
                    </div>                    
                </div>
              </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            <i class="fa fa-times"></i>
            Cerrar
          </button>
          <input type="hidden" name="lot_id" id="lot_id" value="{{Crypt::encryptString($lote->lot_id)}}">
          <button type="submit" class="btn btn-primary" id="btn-guardar-editar-propietario-real">
            <i class="fa fa-save"></i>    
            Guardar
          </button>
        </div>
    </form>

    </div>
    </div>
  </div>
  {{-- FIN MODAL: EDITAR ASIGNACION PROPIETARIO REAL --}}

{{-- INICIO MODAL: EDITAR ASIGNACION PROPIETARIO LEGAL --}}
<div class="modal fade" id="modal-editar-apl" tabindex="-1" role="dialog" aria-labelledby="ModelPropietarioLegal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-edit"></i>
              Editar Asignación propietario legal a la propiedad
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="form-editar-apl" action="" data-action="{{url('lotes/editar_ple')}}" method="post">
            @csrf
            @method('post')
        <div class="modal-body">
            <div class="row">
                <div class="col-md-5 offset-md-1">
                    <h5>
                        <span class="text-success">LOTE: </span>
                        <span id="txt-lote-editar-apl">{{$lote->lot_nro}}</span>
                    </h4>
                </div>
                <div class="col-md-5">
                    <h5>
                        <span class="text-success">MANZANO: </span>
                        <span id="txt-manzano-editar-apl">{{$manzano->man_nombre}}</span>
                    </h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <h5>
                        <span class="text-success">URBANIZACION: </span>
                        <span id="txt-urbanizacion-editar-apl">{{$urbanizacion->urb_nombre}}</span>
                    </h5>
                </div>
            </div>
          <div id="box-participacion">
              <div class="row">
                  <div class="col-md-10 offset-md-1">
                    <h5>
                        <span class="text-success">NOMBRE DEL PROPIETARIO REAL</span><br>
                        <span id="txt-propietario-legal-editar-apl"></span>
                    </h5>
                  </div>
              </div>
              <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="form-group">
                        <label class="label-blue label-block" for="">
                            Algún comentario adicional sobre la asignación:
                            <i class="fa fa-question-circle float-right" title="Establecer alguna descripcion o comentario adicional"></i>
                        </label>
                        <textarea class="form-control" id="apl_descripcion_edit" name="apl_descripcion_edit"></textarea>
                    </div>                    
                </div>
              </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            <i class="fa fa-times"></i>
            Cerrar
          </button>
          <input type="hidden" name="lot_id" id="lot_id" value="{{Crypt::encryptString($lote->lot_id)}}">
          <button type="submit" class="btn btn-primary" id="btn-guardar-editar-propietario-legal">
            <i class="fa fa-save"></i>    
            Guardar
          </button>
        </div>
    </form>

    </div>
    </div>
  </div>
  {{-- FIN MODAL: EDITAR ASIGNACION PROPIETARIO LEGAL --}}


{{-- INICIO MODAL: ELIMINAR ASIGNACION PROPIETARIO REAL --}}
<div class="modal fade" id="modal-eliminar-apr" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-trash"></i>
              Eliminar asignacion de propietario real
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form id="form-eliminar-apr" action="" data-action="{{url('lotes/eliminar_apr')}}" method="post">
            @csrf
            @method('post')
        <div class="modal-body">
            <div class="row">
                <div class="col-md-5 offset-md-1">
                    <h5>
                        <span class="text-success">LOTE: </span>
                        <span id="txt-lote-eliminar-apr">{{$lote->lot_nro}}</span>
                    </h4>
                </div>
                <div class="col-md-5">
                    <h5>
                        <span class="text-success">MANZANO: </span>
                        <span id="txt-manzano-eliminar-apr">{{$manzano->man_nombre}}</span>
                    </h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <h5>
                        <span class="text-success">URBANIZACION: </span>
                        <span id="txt-urbanizacion-eliminar-apr">{{$urbanizacion->urb_nombre}}</span>
                    </h5>
                </div>
            </div>
          <div id="box-participacion">
              <div class="row">
                  <div class="col-md-10 offset-md-1">
                    <h5>
                        <span class="text-success">NOMBRE DEL PROPIETARIO REAL</span><br>
                        <span id="txt-apr-eliminar-propietario"></span>
                    </h5>
                    <h5>
                        <span class="text-success">PARTICIPACION (en %)</span><br>
                        <span id="txt-apr-eliminar-participacion"></span>
                    </h5>
                  </div>
              </div>
          </div>
          <div class="alert alert-danger">
            <div class="media">
                <img src="{{asset('img/alert-danger.png')}}" class="align-self-center mr-3" alt="...">
                <div class="media-body">
                    <h5 class="mt-0">Cuidado.-</h5>
                    <p>
                        ¿Está seguro que desea eliminar esta asignación?
                    </p>
                </div>
            </div>
        </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            <i class="fa fa-times"></i>
            Cerrar
          </button>
          <input type="hidden" name="lot_id" id="lot_id" value="{{Crypt::encryptString($lote->lot_id)}}">
          <button type="submit" class="btn btn-danger" id="btn-guardar-editar-propietario-legal">
            <i class="fa fa-trash"></i>    
            Si, eliminar
          </button>
        </div>
    </form>


    </div>
    </div>
  </div>
  {{-- FIN MODAL: ELIMINAR ASIGNACION PROPIETARIO REAL --}}

{{-- INICIO MODAL: ELIMINAR ASIGNACION PROPIETARIO LEGAL --}}
<div class="modal fade" id="modal-eliminar-apl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-trash"></i>
              Eliminar asignacion de propietario legal
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form id="form-eliminar-apl" action="" data-action="{{url('lotes/eliminar_apl')}}" method="post">
            @csrf
            @method('post')
        <div class="modal-body">
            <div class="row">
                <div class="col-md-5 offset-md-1">
                    <h5>
                        <span class="text-success">LOTE: </span>
                        <span id="txt-lote-eliminar-apl">{{$lote->lot_nro}}</span>
                    </h4>
                </div>
                <div class="col-md-5">
                    <h5>
                        <span class="text-success">MANZANO: </span>
                        <span id="txt-manzano-eliminar-apl">{{$manzano->man_nombre}}</span>
                    </h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <h5>
                        <span class="text-success">URBANIZACION: </span>
                        <span id="txt-urbanizacion-eliminar-apl">{{$urbanizacion->urb_nombre}}</span>
                    </h5>
                </div>
            </div>
          <div id="box-participacion">
              <div class="row">
                  <div class="col-md-10 offset-md-1">
                    <h5>
                        <span class="text-success">NOMBRE DEL PROPIETARIO REAL</span><br>
                        <span id="txt-apl-eliminar-propietario"></span>
                    </h5>
                  </div>
              </div>
          </div>
          <div class="alert alert-danger">
            <div class="media">
                <img src="{{asset('img/alert-danger.png')}}" class="align-self-center mr-3" alt="...">
                <div class="media-body">
                    <h5 class="mt-0">Cuidado.-</h5>
                    <p>
                        ¿Está seguro que desea eliminar esta asignación?
                    </p>
                </div>
            </div>
        </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            <i class="fa fa-times"></i>
            Cerrar
          </button>
          <input type="hidden" name="lot_id" id="lot_id" value="{{Crypt::encryptString($lote->lot_id)}}">
          <button type="submit" class="btn btn-danger" id="btn-guardar-eliminar-propietario-legal">
            <i class="fa fa-trash"></i>    
            Si, eliminar
          </button>
        </div>
    </form>


    </div>
    </div>
  </div>
  {{-- FIN MODAL: ELIMINAR ASIGNACION PROPIETARIO LEGAL --}}


@endif

{{-- INICIO MODAL: ELIMINAR MODALIDAD --}}
<div class="modal fade" id="modal-eliminar-modalidad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-trash"></i>
              Eliminar modalidad de venta
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="box-data-xtra">
                <h5>
                    <span class="text-success">TIPO DE VENTA: </span>
                    <span id="txt-mov-tipo-venta"></span><br>
                    <span class="text-success">MONEDA DE VENTA: </span>
                    <span id="txt-mov-moneda-venta"></span><br>
                    <span class="text-success">PRECIO DE OFERTA: </span>
                    <span id="txt-mov-precio-oferta"></span><br>
                    <span class="text-success">PRECIO MINIMO DE VENTA: </span>
                    <span id="txt-mov-precio-minimo"></span><br>
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
          <form id="form-eliminar-modalidad" action="{{url('modalidades_venta')}}" method="post">
            @method('delete')
            @csrf
            <input type="hidden" name="lot_id" value="{{Crypt::encryptString($lote->lot_id)}}">
            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Si, eliminar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  {{-- FIN MODAL: ELIMINAR MODALIDAD --}}

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
          <form id="form-eliminar-adjunto" action="{{url('lotes/eliminar_adjunto')}}" method="post">
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


{{-- INICIO MODAL: ELIMINAR ESTADO --}}
<div class="modal fade" id="modal-eliminar-estado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-trash"></i>
              Eliminar estado de propiedad
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="box-data-xtra">
                <h5>
                    <span class="text-success">ESTADO: </span>
                    <span id="txt-esp-estado"></span><br>
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
          <form id="form-eliminar-estado" action="{{url('estados')}}" method="post">
            @method('delete')
            @csrf
            <input type="hidden" name="lot_id" value="{{Crypt::encryptString($lote->lot_id)}}">
            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Si, eliminar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  {{-- FIN MODAL: ELIMINAR ESTADO --}}


<script type="text/javascript">
$(function(){
    /*
    --------------------------------------------------------------
    REGISTRAR ASIGNACIÓN PROPIETARIO REAL
    --------------------------------------------------------------
    */
    //inicialización de valores
    $('#box-participacion').hide();
    $('#btn-clear-propietario-real').hide();    
    $('#btn-guardar-adicionar-propietario-real').hide();

    //Evento: click al adicionar propietario real
    $('.btn-adicionar-prr').click(function(){
        let prop_id = $(this).attr('data-prrid');
        let prop_nombre = $(this).parent().prev('td').html();
        $('#txt-propietario-real').html(prop_nombre);
        $('#prr_id').val(prop_id);
        $('#btn-guardar-adicionar-propietario-real').show();
        $('#btn-clear-propietario-real').show();    
        $('#table-propietarios-reales').slideUp(700);
        $('#box-participacion').slideDown(2000);
    });
    //Evento: limpiar el propietario real seleccionado
    $('#btn-clear-propietario-real').click(function(){
        $('#btn-guardar-adicionar-propietario-real').hide();
        $('#btn-clear-propietario-real').hide();    
        $('#box-participacion').slideUp(700);
        $('#table-propietarios-reales').slideDown(2000);
        $('#apr_participacion').val(0);
        $('#apr_descripcion').val('');
    });
    //Modificacion del porcentaje de asignacion
    $('#apr_participacion').on('input',function(){
        $(this).next('small').find('output').val($(this).val());
    });

    /*
    --------------------------------------------------------------
    REGISTRAR ASIGNACIÓN PROPIETARIO LEGAL
    --------------------------------------------------------------
    */
    //inicialización de valores
    $('#box-propietarios-legales').hide();
    $('#btn-clear-propietario-legal').hide();    
    $('#btn-guardar-adicionar-propietario-legal').hide();

    //Evento: click al adicionar propietario legal
    $('.btn-adicionar-ple').click(function(){
        let prop_id = $(this).attr('data-pleid');
        let prop_nombre = $(this).parent().prev('td').html();
        $('#txt-propietario-legal').html(prop_nombre);
        $('#ple_id').val(prop_id);
        $('#btn-guardar-adicionar-propietario-legal').show();
        $('#btn-clear-propietario-legal').show();    
        $('#table-propietarios-legales').slideUp(700);
        $('#box-propietarios-legales').slideDown(2000);
        console.log($('#ple_id').val());
    });
    //Evento: limpiar el propietario legal seleccionado
    $('#btn-clear-propietario-legal').click(function(){
        $('#btn-guardar-adicionar-propietario-legal').hide();
        $('#btn-clear-propietario-legal').hide();    
        $('#box-propietarios-legales').slideUp(700);
        $('#table-propietarios-legales').slideDown(2000);
        $('#apl_descripcion').val('');
    });
    /*
    --------------------------------------------------------------
    EDITAR ASIGNACIÓN PROPIETARIO REAL
    --------------------------------------------------------------
    */
   $('.btn-editar-apr').click(function(){
       let participacion_item = $(this).attr('data-item-participacion');
       let descripcion = $(this).attr('data-item-descripcion');
       let apr_id = $(this).attr('data-aprid');
       let nombre = $(this).parents('td').siblings('.prr_nombre').html();
       $('#txt-propietario-real-editar-apr').html(nombre);
       let participacion_disponible = $('#apr_participacion_disponible').val();
       max_participacion = parseInt(participacion_item) + parseInt(participacion_disponible);
       $('#apr_participacion_edit').attr('max',max_participacion);
       $('#txt_apr_participacion_disponible').html(max_participacion);
       $('#apr-porcent-participacion').html(participacion_item);
       //form data
       $('#apr_participacion_edit').val(participacion_item);
       $('#apr_descripcion_edit').val(descripcion);
       action = $('#form-editar-apr').attr('data-action');
       action = action+'/'+apr_id;
       $('#form-editar-apr').attr('action',action);
   });
    //Modificacion del porcentaje de asignacion
    $('#apr_participacion_edit').on('input',function(){
        $(this).next('small').find('output').val($(this).val());
    });
    /*
    --------------------------------------------------------------
    EDITAR ASIGNACIÓN PROPIETARIO LEGAL
    --------------------------------------------------------------
    */
   $('.btn-editar-apl').click(function(){
       let descripcion = $(this).attr('data-item-descripcion');
       let apl_id = $(this).attr('data-aplid');
       let nombre = $(this).parents('td').siblings('.ple_nombre').html();
       $('#txt-propietario-legal-editar-apl').html(nombre);
       //form data
       $('#apl_descripcion_edit').val(descripcion);
       action = $('#form-editar-apl').attr('data-action');
       action = action+'/'+apl_id;
       $('#form-editar-apl').attr('action',action);
   });
    /*
    --------------------------------------------------------------
    ELIMINAR ASIGNACIÓN PROPIETARIO REAL
    --------------------------------------------------------------
    */
    $('.btn-eliminar-apr').click(function(){
       let apr_id = $(this).attr('data-aprid');
       let participacion = $(this).attr('data-item-participacion');
       let nombre = $(this).parents('td').siblings('.prr_nombre').html();
       $('#txt-apr-eliminar-propietario').html(nombre);
       $('#txt-apr-eliminar-participacion').html(participacion);
       console.log(nombre);
       console.log(participacion);
       //form data
       action = $('#form-eliminar-apr').attr('data-action');
       action = action+'/'+apr_id;
       $('#form-eliminar-apr').attr('action',action);
   });
    /*
    --------------------------------------------------------------
    ELIMINAR ASIGNACIÓN PROPIETARIO LEGAL
    --------------------------------------------------------------
    */
    $('.btn-eliminar-apl').click(function(){
       let apl_id = $(this).attr('data-aplid');
       let nombre = $(this).parents('td').siblings('.ple_nombre').html();
       $('#txt-apl-eliminar-propietario').html(nombre);
       //form data
       action = $('#form-eliminar-apl').attr('data-action');
       action = action+'/'+apl_id;
       $('#form-eliminar-apl').attr('action',action);
   });
    /*
    --------------------------------------------------------------
    ELIMINAR MODALIDAD
    --------------------------------------------------------------
    */
    $('.btn-eliminar-modalidad').click(function(){
       let mov_id = $(this).attr('data-mov-id');
       let mov_tipo_venta = $(this).attr('data-mov-tipo');
       let mov_moneda_venta = $(this).attr('data-mov-moneda');
       let mov_precio_oferta = $(this).attr('data-mov-precio-oferta');
       let mov_precio_minimo = $(this).attr('data-mov-precio-minimo');
       if(mov_tipo_venta == '0'){$('#txt-mov-tipo-venta').html('AL CONTADO')}
       if(mov_tipo_venta == '1'){$('#txt-mov-tipo-venta').html('A PAGOS')}
       if(mov_tipo_venta == '2'){$('#txt-mov-tipo-venta').html('A CRÉDITO')}
       if(mov_moneda_venta == '0'){$('#txt-mov-moneda-venta').html('BOLIVIANOS')}
       if(mov_moneda_venta == '1'){$('#txt-mov-moneda-venta').html('DOLARES')}
       $('#txt-mov-precio-oferta').html(mov_precio_oferta);
       $('#txt-mov-precio-minimo').html(mov_precio_minimo);
       //form data
       action = $('#form-eliminar-modalidad').attr('action');
       action = action+'/'+mov_id;
       $('#form-eliminar-modalidad').attr('action',action);
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


    /*
    --------------------------------------------------------------
    ELIMINAR ESTADO
    --------------------------------------------------------------
    */
    $('.btn-eliminar-estado').click(function(){
       let esp_id = $(this).attr('data-esp-id');
       let esp_nombre = $(this).attr('data-esp-estado');
       $('#txt-esp-estado').html(esp_nombre);
       console.log(esp_nombre);
       //form data
       action = $('#form-eliminar-estado').attr('action');
       action = action+'/'+esp_id;
       $('#form-eliminar-estado').attr('action',action);
   });


});
</script>




@endsection
