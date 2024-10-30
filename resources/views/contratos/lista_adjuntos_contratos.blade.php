@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
    <h3 class="title-header" style="text-transform: uppercase;">
        <i class="fa fa-file"></i>
        {{$titulo}}
        <a href="{{url('contratos/'.Crypt::encryptString($contrato->con_id).'/nuevo_adjunto')}}" class="btn btn-sm btn-success float-right" style="margin-left:10px;"><i class="fa fa-plus"></i> NUEVO ADJUNTO</a>
    </h3>
    <div class="row">
        <div class="col-12">
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
