@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
    <h3 class="title-header" style="text-transform: uppercase;">
        <i class="fa fa-tag"></i>
        {{$titulo}}
        <a href="{{url('reservas/nuevo')}}" class="btn btn-sm btn-success float-right" style="margin-left:10px;"><i class="fa fa-plus"></i> NUEVA RESERVA</a>
    </h3>
    <div class="row">
        <div class="col-12">
                <!-- inicio card  -->
                <div class="card card-stat">
                    <div class="card-body">
                        @if($reservas->count() == 0)
                        <div class="alert alert-info">
                            <div class="media">
                                <img src="{{asset('img/alert-info.png')}}" class="align-self-center mr-3" alt="...">
                                <div class="media-body">
                                    <h5 class="mt-0">Nota.-</h5>
                                    <p>
                                        NO se tienen reservas registrados hasta el momento.
                                    </p>
                                </div>
                            </div>
                        </div>
                        @else
                        <table class="table table-bordered tabla-datos-reservas">
                            <thead>
                            <tr class="tr-little">
                                <th class="text-center">PROPIEDAD</th>
                                <th class="text-center">PERSONA QUE RESERVA</th>
                                <th class="text-center">CI</th>
                                <th class="text-center">RECIBO</th>
                                <th class="text-center">MONTO RECIBO</th>
                                <th class="text-center">MODALIDAD</th>
                                <th class="text-center">FECHA RECIBO</th>
                                <th class="text-center">RESERVA EXPIRA</th>
                                <th class="text-center">RESERVA AMPLIADA</th>
                                <th class="text-center">DESCARGO REALIZADO</th>
                                <th class="text-center">DEVOLUCION</th>
                                <th class="text-center">OPCION</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($reservas as $item)
                            <tr>
                                <td class="text-center">
                                    Lote: {{$item->propiedad->lote->lot_nro}} <br>
                                    <small class="text-primary">Mzn.: {{$item->propiedad->lote->manzano->man_nombre}}</small><br>
                                    <small class="text-secondary">Urb.:{{$item->propiedad->lote->manzano->urbanizacion->urb_nombre}}</small>
                                </td>
                                <td class="text-center">
                                    {{$item->persona->per_nombres}} {{$item->persona->per_primer_apellido}} {{$item->persona->per_segundo_apellido}}
                                </td>
                                <td class="text-center">
                                    {{$item->persona->per_nro_id}}
                                </td>
                                <td class="text-center">
                                    N°
                                    @if(intval($item->res_nro_recibo) < 10 ) 
                                    000{{$item->res_nro_recibo}}
                                    @elseif (intval($item->res_nro_recibo) < 100)
                                    00{{$item->res_nro_recibo}}
                                    @elseif (intval($item->res_nro_recibo) < 100)
                                    0{{$item->res_nro_recibo}}
                                    @elseif (intval($item->res_nro_recibo) < 100)
                                    {{$item->res_nro_recibo}}
                                    @endif
                                </td>
                                <td class="text-center">
                                    {{$item->res_monto}} 
                                    @if($item->res_moneda == 0)
                                        Bs
                                    @endif
                                    @if($item->res_moneda == 1)
                                        USD
                                    @endif
                                </td>
                                <td class="text-center">
                                    {{$item->res_modalidad}}
                                </td>
                                <td class="text-center">
                                    {{$item->res_fecha_recibo}}
                                </td>
                                <td class="text-center">
                                    {{$item->res_fecha_expiracion}}
                                </td>
                                <td class="text-center">
                                  @if($item->res_ampliacion_exp)
                                  <div class="badge badge-info">SI</div>
                                  @else
                                  <div class="badge badge-secondary">NO</div>
                                  @endif
                                </td>
                                <td class="text-center">
                                  @if($item->descargo == null)
                                  <div class="badge badge-secondary">NO</div>
                                  @else
                                  <div class="badge badge-info">SI</div>
                                  @endif
                                </td>
                                <td class="text-center">
                                  @if($item->res_devuelto)
                                  <div class="badge badge-info">SI</div>
                                  @else
                                  <div class="badge badge-secondary">NO</div>
                                  @endif
                                </td>
                              <td class="text-center">
                                    <div class="dropdown">
                                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        OPCION
                                      </button>
                                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                         <a class="dropdown-item" href="{{url('reservas/'.Crypt::encryptString($item->res_id).'/imprimir_recibo')}}"><i class="fa fa-print"></i> Imprimir recibo</a>
                                         @if(!$item->res_ampliacion_exp)
                                         <a class="dropdown-item btn-ampliar-reserva" data-cli-id="{{Crypt::encryptString($item->res_id)}}" data-cli-nombre-completo="{{$item->persona->per_nombres}} {{$item->persona->per_primer_apellido}} {{$item->persona->per_segundo_apellido}}" data-toggle="modal" data-target="#modal-ampliar-reserva" href="#"><i class="fa fa-repeat"></i> Ampliar reserva</a>
                                         @endif
                                         @if($item->descargo == null)
                                         <a class="dropdown-item btn-registrar-descargo" data-cli-id="{{Crypt::encryptString($item->res_id)}}" data-cli-nombre-completo="{{$item->persona->per_nombres}} {{$item->persona->per_primer_apellido}} {{$item->persona->per_segundo_apellido}}" data-toggle="modal" data-target="#modal-registrar-descargo"><i class="fa fa-money"></i> Registrar descargo</a>
                                         @endif
                                         @if(!$item->res_devuelto)
                                         <a class="dropdown-item btn-devolucion-reserva" data-cli-id="{{Crypt::encryptString($item->res_id)}}" data-cli-nombre-completo="{{$item->persona->per_nombres}} {{$item->persona->per_primer_apellido}} {{$item->persona->per_segundo_apellido}}" data-toggle="modal" data-target="#modal-devolucion-reserva" href="#"><i class="fa fa-hand-o-left"></i> Devolución</a>
                                         @endif
                                         <a class="dropdown-item btn-eliminar-reserva" data-cli-id="{{Crypt::encryptString($item->res_id)}}" data-cli-nombre-completo="{{$item->persona->per_nombres}} {{$item->persona->per_primer_apellido}} {{$item->persona->per_segundo_apellido}}" data-toggle="modal" data-target="#modal-eliminar-reserva" href="#"><i class="fa fa-trash"></i> Eliminar reserva</a>
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


{{-- INICIO MODAL: ELIMINAR RESERVA --}}
<div class="modal fade" id="modal-eliminar-reserva" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-trash"></i>
              Anular reserva
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="box-data-xtra">
                <h5>
                    <span class="text-success">RESERVA DE CLIENTE: </span>
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
          <form id="form-eliminar-reserva" action="{{url('reservas')}}" data-simple-action="{{url('reservas')}}" method="post">
            @method('delete')
            @csrf
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Si, eliminar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  {{-- FIN MODAL: ELIMINAR RESERVA --}}

{{-- INICIO MODAL: AMPLIAR RESERVA --}}
<div class="modal fade" id="modal-ampliar-reserva" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-repeat"></i>
              Ampliar reserva
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="box-data-xtra">
                <h5>
                    <span class="text-success">RESERVA DE CLIENTE: </span>
                    <span id="txt-cli-nombre1"></span><br>
                </h5>
            </div>
            <div class="alert alert-info">
                <div class="media">
                    <img src="{{asset('img/alert-info.png')}}" class="align-self-center mr-3" alt="...">
                    <div class="media-body">
                        <h5 class="mt-0">Nota.-</h5>
                        <p>
                            ¿Está seguro que desea ampliar el tiempo de la reserva?
                            <br>
                            El tiempo de reserva se ampliará por <h3>{{config('casapropia.TIEMPO_AMPLIACION_RESERVA')}} días.</h3>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
          <form id="form-ampliar-reserva" action="{{url('reservas')}}" data-simple-action="{{url('reservas')}}" method="post">
            @csrf
                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Si, ampliar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  {{-- FIN MODAL: AMPLIAR RESERVA --}}

{{-- INICIO MODAL: DESCARGO --}}
<div class="modal fade" id="modal-registrar-descargo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-money"></i>
              Registrar descargo
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="form-registrar-descargo" action="{{url('reservas')}}" data-simple-action="{{url('reservas')}}" method="post">
          @method('post')
          @csrf
          <div class="modal-body">
            <div class="box-data-xtra">
                <h5>
                    <span class="text-success">RESERVA DE CLIENTE: </span>
                    <span id="txt-cli-nombre2"></span><br>
                </h5>
            </div>
            <div class="alert alert-info">
                <div class="media">
                    <img src="{{asset('img/alert-info.png')}}" class="align-self-center mr-3" alt="...">
                    <div class="media-body">
                        <h5 class="mt-0">Nota.-</h5>
                        <p>
                            Usted va a registrar el descargo de esta reserva. <br>¿Esta seguro de esta operación?
                        </p>
                        <br>
                        <div class="form-group">
                          <label class="label-blue label-block" for="">
                            Alguna observacion sobre el descargo:
                            <i class="fa fa-question-circle float-right" title="Establecer alguna observacion relacionada al descargo de la reserva"></i>
                          </label>
                          <input type="text" class="form-control" id="dre_observacion" name="dre_observacion" placeholder="Anote alguna observacion">
                          @error('dre_observacion')
                          <div class="invalid-feedback">
                            {{$message}}
                          </div>											
                          @enderror
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Si, registrar</button>
        </div>
        </form>
    </div>
    </div>
  </div>
  {{-- FIN MODAL: DESCARGO --}}

{{-- INICIO MODAL: DEVOLUCION --}}
<div class="modal fade" id="modal-devolucion-reserva" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-hand-o-left"></i>
              Devolucion de reserva
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>        
        </div>
        <form id="form-devolucion-reserva" action="{{url('reservas')}}" data-simple-action="{{url('reservas')}}" method="post">
          @method('post')
          @csrf
      <div class="modal-body">
            <div class="box-data-xtra">
                <h5>
                    <span class="text-success">RESERVA DE CLIENTE: </span>
                    <span id="txt-cli-nombre3"></span><br>
                </h5>
            </div>
            <div class="alert alert-warning">
                <div class="media">
                    <img src="{{asset('img/alert-warning.png')}}" class="align-self-center mr-3" alt="...">
                    <div class="media-body">
                        <h5 class="mt-0">Aviso.-</h5>
                        <p>
                            ¿Está seguro que desea registrar la devolución de esta reserva?
                        </p>
                        <br>
                        <div class="form-group">
                          <label class="label-blue label-block" for="">
                            Alguna observacion sobre la devolución:
                            <i class="fa fa-question-circle float-right" title="Establecer alguna observacion relacionada a la devolucion"></i>
                          </label>
                          <input type="text" class="form-control" id="res_observacion_devolucion" name="res_observacion_devolucion" placeholder="Anote alguna observacion">
                          @error('res_observacion_devolucion')
                          <div class="invalid-feedback">
                            {{$message}}
                          </div>											
                          @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Si, registrar devolución</button>
        </div>
      </form>
    </div>
    </div>
  </div>
  {{-- FIN MODAL: DEVOLUCION --}}


<script type="text/javascript">
$(function(){
    /*
    -------------------------------------------------------------
    * CONFIGURACION DATA TABLES
    -------------------------------------------------------------
    */
    $('.tabla-datos-reservas').DataTable({"language":{url: '{{asset('js/datatables-lang-es.json')}}'}, "order": [[ 6, "desc" ]]});

    /*
    --------------------------------------------------------------
    ELIMINAR RESERVA
    --------------------------------------------------------------
    */
    $('.btn-eliminar-reserva').click(function(){
       let cli_id = $(this).attr('data-cli-id');
       let cli_nombre = $(this).attr('data-cli-nombre-completo');
       $('#txt-cli-nombre').html(cli_nombre);
       //form data
       action = $('#form-eliminar-reserva').attr('data-simple-action');
       action = action+'/'+cli_id;
       $('#form-eliminar-reserva').attr('action',action);
   });

   $('.btn-ampliar-reserva').click(function(){
       let cli_id = $(this).attr('data-cli-id');
       let cli_nombre = $(this).attr('data-cli-nombre-completo');
       $('#txt-cli-nombre1').html(cli_nombre);
       //form data
       action = $('#form-ampliar-reserva').attr('data-simple-action');
       action = action+'/'+cli_id+'/ampliacion';
       $('#form-ampliar-reserva').attr('action',action);
   });

   $('.btn-registrar-descargo').click(function(){
       let cli_id = $(this).attr('data-cli-id');
       let cli_nombre = $(this).attr('data-cli-nombre-completo');
       $('#txt-cli-nombre2').html(cli_nombre);
       //form data
       action = $('#form-registrar-descargo').attr('data-simple-action');
       action = action+'/'+cli_id+'/registrar_descargo';
       $('#form-registrar-descargo').attr('action',action);
   });

   $('.btn-devolucion-reserva').click(function(){
       let cli_id = $(this).attr('data-cli-id');
       let cli_nombre = $(this).attr('data-cli-nombre-completo');
       $('#txt-cli-nombre3').html(cli_nombre);
       //form data
       action = $('#form-devolucion-reserva').attr('data-simple-action');
       action = action+'/'+cli_id+'/devolucion';
       $('#form-devolucion-reserva').attr('action',action);
   });


});
</script>




@endsection
