@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
    <h3 class="title-header" style="text-transform: uppercase;">
        <i class="fa fa-file"></i>
        {{$titulo}}
        <a href="{{url('contratos/nuevo')}}" class="btn btn-sm btn-success float-right" style="margin-left:10px;"><i class="fa fa-plus"></i> NUEVO CONTRATO</a>
    </h3>
    <div class="row">
        <div class="col-12">
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
                                        NO se tienen contratos registrados hasta el momento.
                                    </p>
                                </div>
                            </div>
                        </div>
                        @else
                        <table class="table table-bordered tabla-datos-contratos">
                            <thead>
                            <tr>
                                <th>NRO CONTRATO</th>
                                <th>TIPO CONTRATO</th>
                                <th>COD. LOTE</th>
                                <th>PRECIO TOTAL</th>
                                <th>TIPO DE VENTA</th>
                                <th>PAGO INICIAL</th>
                                <th>PLAZO</th>
                                <th>INTERES</th>
                                <th>FECHA DE CONTRATO</th>
                                <th>OPCION</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contratos as $item)
                            <tr>
                                <td>
                                    {{$item->con_nro_contrato}}
                                </td>
                                <td>
                                    @if ($item->con_tipo == 0)
                                        COMPRAVENTA
                                    @endif
                                    @if ($item->con_tipo == 1)
                                        CANCELACION
                                    @endif
                                    @if ($item->con_tipo == 2)
                                        TRASPASO DE PROPIETARIOS
                                    @endif
                                    @if ($item->con_tipo == 3)
                                        TRASPASO DE LOTES
                                    @endif
                                    @if ($item->con_tipo == 3)
                                        DEVOLUCION
                                    @endif
                                </td>
                                <td>
                                    {{$item->propiedad->lote->lot_codigo}}
                                </td>
                                <td>
                                    {{$item->con_precio_total}}
                                    @if($item->con_moneda == 0)
                                    [Bs]
                                    @else
                                    [$US]
                                    @endif
                                </td>
                                <td>
                                    @if ($item->con_tipo_venta == 0)
                                    AL CONTADO
                                    @endif
                                    @if ($item->con_tipo_venta == 1)
                                    PAGOS
                                    @endif
                                    @if ($item->con_tipo_venta == 2)
                                    CREDITO
                                    @endif
                                </td>
                                <td>
                                    {{$item->con_pago_inicial}}
                                </td>
                                <td>
                                    {{$item->con_plazo}}
                                </td>
                                <td>
                                    {{$item->con_interes}}
                                </td>
                                <td>
                                    {{$item->con_fecha_contrato}}
                                </td>
                                <td>
                                    <div class="dropdown">
                                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        OPCION
                                      </button>
                                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{url('contratos/'.Crypt::encryptString($item->con_id).'/redaccion')}}"><i class="fa fa-file-text"></i> Redactar documento</a>
                                        <a class="dropdown-item" href="{{url('contratos/'.Crypt::encryptString($item->con_id).'/plan_pago')}}"><i class="fa fa-dollar"></i> Plan de pagos</a>
                                        <a class="dropdown-item" href="{{url('contratos/'.Crypt::encryptString($item->con_id).'/adjuntos')}}"><i class="fa fa-upload"></i> Adjuntos digitalizados</a>
                                        <a class="dropdown-item" href="{{url('contratos/'.Crypt::encryptString($item->con_id).'/editar')}}"><i class="fa fa-check-square-o"></i> Validación de firmas</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{url('contratos/'.Crypt::encryptString($item->cli_id).'/editar')}}"><i class="fa fa-edit"></i> Editar datos</a>
                                         @if($item->adjuntos()->count() > 0)
                                         <a class="dropdown-item" title="El cliente tiene contratos registrados. No es posible eliminar este registro." href="#"><i class="fa fa-trash"></i> Eliminar</a>
                                         @else
                                         <a class="dropdown-item btn-eliminar-cliente" data-cli-id="{{Crypt::encryptString($item->con_id)}}" data-cli-nombre-completo="" data-toggle="modal" data-target="#modal-eliminar-cliente" href="#"><i class="fa fa-trash"></i> Eliminar</a>
                                         @endif
                                         <div class="dropdown-divider"></div>
                                         <a title="Reconocimiento de firmas, contrato de cancelacion, minuta, etc." class="dropdown-item" href="{{url('contratos/'.Crypt::encryptString($item->cli_id).'/editar')}}"><i class="fa fa-cog"></i> Tramites/documentos asociados</a>
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
    $('.tabla-datos-contratos').DataTable({"language":{url: '{{asset('js/datatables-lang-es.json')}}'}, "order": [[ 7, "desc" ]]});

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
