@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
    <h3 class="title-header" style="text-transform: uppercase;">
        <i class="fa fa-id-card"></i>
        {{$titulo}}
        <a href="{{url('clientes/nuevo')}}" class="btn btn-sm btn-success float-right" style="margin-left:10px;"><i class="fa fa-plus"></i> NUEVO CLIENTE</a>
    </h3>
    <div class="row">
        <div class="col-12">
                <!-- inicio card  -->
                <div class="card card-stat">
                    <div class="card-body">
                        @if($clientes->count() == 0)
                        <div class="alert alert-info">
                            <div class="media">
                                <img src="{{asset('img/alert-info.png')}}" class="align-self-center mr-3" alt="...">
                                <div class="media-body">
                                    <h5 class="mt-0">Nota.-</h5>
                                    <p>
                                        NO se tienen clientes registrados hasta el momento.
                                    </p>
                                </div>
                            </div>
                        </div>
                        @else
                        <table class="table table-bordered tabla-datos-clientes">
                            <thead>
                            <tr>
                                <th>FOTOGRAFÍA</th>
                                <th>TIPO PERSONA</th>
                                <th>NRO DOCUMENTO</th>
                                <th>NOMBRE COMPLETO</th>
                                <th>ACTIVIDAD ECONÓMICA</th>
                                <th>FECHA DE REGISTRO</th>
                                <th>OPCION</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($clientes as $item)
                            <tr>
                                <td>
                                    <img style="width:200px !important;" class="img-thumbnail" src="{{asset('storage/'.$item->cli_foto)}}">
                                </td>
                                <td>
                                    @if($item->persona->per_tipo_persona == 0)
                                    NATURAL
                                    @endif
                                    @if($item->persona->per_tipo_persona == 1)
                                    JURIDICA
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($item->persona->per_tipo_documento == 0)
                                    CI:
                                    @endif
                                    @if($item->persona->per_tipo_documento == 1)
                                    LM:
                                    @endif
                                    @if($item->persona->per_tipo_documento == 2)
                                    OTRO:
                                    @endif
                                    {{$item->persona->per_nro_id}}
                                    @if($item->persona->per_tipo_documento == 0)
                                    {{$item->persona->per_expedido}}
                                    @endif
                                </td>
                                <td class="text-center">
                                    {{$item->persona->per_nombres}} {{$item->persona->per_primer_apellido}} {{$item->persona->per_segundo_apellido}}
                                </td>
                                <td>
                                    {{$item->actividad_economica->first()->ace_descripcion}}
                                </td>
                                <td class="text-center">
                                    {{$item->updated_at}}
                                </td>
                                <td>
                                    <div class="dropdown">
                                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        OPCION
                                      </button>
                                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                         <a class="dropdown-item" href="{{url('clientes/'.Crypt::encryptString($item->cli_id).'/editar')}}"><i class="fa fa-edit"></i> Editar</a>
                                         @if($item->contratos()->count() > 0)
                                         <a class="dropdown-item" title="El cliente tiene contratos registrados. No es posible eliminar este registro." href="#"><i class="fa fa-trash"></i> Eliminar</a>
                                         @else
                                         <a class="dropdown-item btn-eliminar-cliente" data-cli-id="{{Crypt::encryptString($item->cli_id)}}" data-cli-nombre-completo="{{$item->persona->per_nombres}} {{$item->persona->per_primer_apellido}} {{$item->persona->per_segundo_apellido}}" data-toggle="modal" data-target="#modal-eliminar-cliente" href="#"><i class="fa fa-trash"></i> Eliminar</a>
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


{{-- INICIO MODAL: ELIMINAR MODALIDAD --}}
<div class="modal fade" id="modal-eliminar-cliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-trash"></i>
              Eliminar cliente
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="box-data-xtra">
                <h5>
                    <span class="text-success">NOMBRE CLIENTE: </span>
                    <span id="txt-cli-nombre"></span><br>
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
          <form id="form-eliminar-cliente" action="{{url('clientes')}}" data-simple-action="{{url('clientes')}}" method="post">
            @method('delete')
            @csrf
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
    -------------------------------------------------------------
    * CONFIGURACION DATA TABLES
    -------------------------------------------------------------
    */
    $('.tabla-datos-clientes').DataTable({"language":{url: '{{asset('js/datatables-lang-es.json')}}'}, "order": [[ 5, "desc" ]]});


    /*

    --------------------------------------------------------------
    REGISTRAR ASIGNACIÓN PROPIETARIO REAL
    --------------------------------------------------------------
    */
    //inicialización de valores
    // $('#box-participacion').hide();
    // $('#btn-clear-propietario-real').hide();    
    // $('#btn-guardar-adicionar-propietario-real').hide();

    //Evento: click al adicionar propietario real
    // $('.btn-adicionar-prr').click(function(){
    //     let prop_id = $(this).attr('data-prrid');
    //     let prop_nombre = $(this).parent().prev('td').html();
    //     $('#txt-propietario-real').html(prop_nombre);
    //     $('#prr_id').val(prop_id);
    //     $('#btn-guardar-adicionar-propietario-real').show();
    //     $('#btn-clear-propietario-real').show();    
    //     $('#table-propietarios-reales').slideUp(700);
    //     $('#box-participacion').slideDown(2000);
    // });
    //Evento: limpiar el propietario real seleccionado
    // $('#btn-clear-propietario-real').click(function(){
    //     $('#btn-guardar-adicionar-propietario-real').hide();
    //     $('#btn-clear-propietario-real').hide();    
    //     $('#box-participacion').slideUp(700);
    //     $('#table-propietarios-reales').slideDown(2000);
    //     $('#apr_participacion').val(0);
    //     $('#apr_descripcion').val('');
    // });
    //Modificacion del porcentaje de asignacion
    // $('#apr_participacion').on('input',function(){
    //     $(this).next('small').find('output').val($(this).val());
    // });

    /*
    --------------------------------------------------------------
    REGISTRAR ASIGNACIÓN PROPIETARIO LEGAL
    --------------------------------------------------------------
    */
    //inicialización de valores
    // $('#box-propietarios-legales').hide();
    // $('#btn-clear-propietario-legal').hide();    
    // $('#btn-guardar-adicionar-propietario-legal').hide();

    //Evento: click al adicionar propietario legal
    // $('.btn-adicionar-ple').click(function(){
    //     let prop_id = $(this).attr('data-pleid');
    //     let prop_nombre = $(this).parent().prev('td').html();
    //     $('#txt-propietario-legal').html(prop_nombre);
    //     $('#ple_id').val(prop_id);
    //     $('#btn-guardar-adicionar-propietario-legal').show();
    //     $('#btn-clear-propietario-legal').show();    
    //     $('#table-propietarios-legales').slideUp(700);
    //     $('#box-propietarios-legales').slideDown(2000);
    //     console.log($('#ple_id').val());
    // });
    //Evento: limpiar el propietario legal seleccionado
    // $('#btn-clear-propietario-legal').click(function(){
    //     $('#btn-guardar-adicionar-propietario-legal').hide();
    //     $('#btn-clear-propietario-legal').hide();    
    //     $('#box-propietarios-legales').slideUp(700);
    //     $('#table-propietarios-legales').slideDown(2000);
    //     $('#apl_descripcion').val('');
    // });
    /*
    --------------------------------------------------------------
    EDITAR ASIGNACIÓN PROPIETARIO REAL
    --------------------------------------------------------------
    */
//    $('.btn-editar-apr').click(function(){
//        let participacion_item = $(this).attr('data-item-participacion');
//        let descripcion = $(this).attr('data-item-descripcion');
//        let apr_id = $(this).attr('data-aprid');
//        let nombre = $(this).parents('td').siblings('.prr_nombre').html();
//        $('#txt-propietario-real-editar-apr').html(nombre);
//        let participacion_disponible = $('#apr_participacion_disponible').val();
//        max_participacion = parseInt(participacion_item) + parseInt(participacion_disponible);
//        $('#apr_participacion_edit').attr('max',max_participacion);
//        $('#txt_apr_participacion_disponible').html(max_participacion);
//        $('#apr-porcent-participacion').html(participacion_item);
//        //form data
//        $('#apr_participacion_edit').val(participacion_item);
//        $('#apr_descripcion_edit').val(descripcion);
//        action = $('#form-editar-apr').attr('data-action');
//        action = action+'/'+apr_id;
//        $('#form-editar-apr').attr('action',action);
//    });
//     //Modificacion del porcentaje de asignacion
//     $('#apr_participacion_edit').on('input',function(){
//         $(this).next('small').find('output').val($(this).val());
//     });
//     /*
//     --------------------------------------------------------------
//     EDITAR ASIGNACIÓN PROPIETARIO LEGAL
//     --------------------------------------------------------------
//     */
//    $('.btn-editar-apl').click(function(){
//        let descripcion = $(this).attr('data-item-descripcion');
//        let apl_id = $(this).attr('data-aplid');
//        let nombre = $(this).parents('td').siblings('.ple_nombre').html();
//        $('#txt-propietario-legal-editar-apl').html(nombre);
//        //form data
//        $('#apl_descripcion_edit').val(descripcion);
//        action = $('#form-editar-apl').attr('data-action');
//        action = action+'/'+apl_id;
//        $('#form-editar-apl').attr('action',action);
//    });
//     /*
//     --------------------------------------------------------------
//     ELIMINAR ASIGNACIÓN PROPIETARIO REAL
//     --------------------------------------------------------------
//     */
//     $('.btn-eliminar-apr').click(function(){
//        let apr_id = $(this).attr('data-aprid');
//        let participacion = $(this).attr('data-item-participacion');
//        let nombre = $(this).parents('td').siblings('.prr_nombre').html();
//        $('#txt-apr-eliminar-propietario').html(nombre);
//        $('#txt-apr-eliminar-participacion').html(participacion);
//        console.log(nombre);
//        console.log(participacion);
//        //form data
//        action = $('#form-eliminar-apr').attr('data-action');
//        action = action+'/'+apr_id;
//        $('#form-eliminar-apr').attr('action',action);
//    });
//     /*
//     --------------------------------------------------------------
//     ELIMINAR ASIGNACIÓN PROPIETARIO LEGAL
//     --------------------------------------------------------------
//     */
//     $('.btn-eliminar-apl').click(function(){
//        let apl_id = $(this).attr('data-aplid');
//        let nombre = $(this).parents('td').siblings('.ple_nombre').html();
//        $('#txt-apl-eliminar-propietario').html(nombre);
//        //form data
//        action = $('#form-eliminar-apl').attr('data-action');
//        action = action+'/'+apl_id;
//        $('#form-eliminar-apl').attr('action',action);
//    });
    /*
    --------------------------------------------------------------
    ELIMINAR MODALIDAD
    --------------------------------------------------------------
    */
//     $('.btn-eliminar-modalidad').click(function(){
//        let mov_id = $(this).attr('data-mov-id');
//        let mov_tipo_venta = $(this).attr('data-mov-tipo');
//        let mov_moneda_venta = $(this).attr('data-mov-moneda');
//        let mov_precio_oferta = $(this).attr('data-mov-precio-oferta');
//        let mov_precio_minimo = $(this).attr('data-mov-precio-minimo');
//        if(mov_tipo_venta == '0'){$('#txt-mov-tipo-venta').html('AL CONTADO')}
//        if(mov_tipo_venta == '1'){$('#txt-mov-tipo-venta').html('A PAGOS')}
//        if(mov_tipo_venta == '2'){$('#txt-mov-tipo-venta').html('A CRÉDITO')}
//        if(mov_moneda_venta == '0'){$('#txt-mov-moneda-venta').html('BOLIVIANOS')}
//        if(mov_moneda_venta == '1'){$('#txt-mov-moneda-venta').html('DOLARES')}
//        $('#txt-mov-precio-oferta').html(mov_precio_oferta);
//        $('#txt-mov-precio-minimo').html(mov_precio_minimo);
//        //form data
//        action = $('#form-eliminar-modalidad').attr('action');
//        action = action+'/'+mov_id;
//        $('#form-eliminar-modalidad').attr('action',action);
//    });

    /*
    --------------------------------------------------------------
    ELIMINAR ESTADO
    --------------------------------------------------------------
    */
    $('.btn-eliminar-cliente').click(function(){
       let cli_id = $(this).attr('data-cli-id');
       let cli_nombre = $(this).attr('data-cli-nombre-completo');
       $('#txt-cli-nombre').html(cli_nombre);
       //form data
       action = $('#form-eliminar-cliente').attr('data-simple-action');
       action = action+'/'+cli_id;
       $('#form-eliminar-cliente').attr('action',action);
   });


});
</script>




@endsection
