@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
    <h3 class="title-header" style="text-transform: uppercase;">
        <i class="fa fa-users"></i>
        {{$titulo}}
        <a href="{{url('usuarios/nuevo')}}" class="btn btn-sm btn-success float-right" style="margin-left:10px;"><i class="fa fa-plus"></i> NUEVO USUARIO</a>
    </h3>
    <div class="row">
        <div class="col-12">
                <!-- inicio card  -->
                <div class="card card-stat">
                    <div class="card-body">
                        @if($usuarios->count() == 0)
                        <div class="alert alert-info">
                            <div class="media">
                                <img src="{{asset('img/alert-info.png')}}" class="align-self-center mr-3" alt="...">
                                <div class="media-body">
                                    <h5 class="mt-0">Nota.-</h5>
                                    <p>
                                        NO se tienen usuarios registrados hasta el momento.
                                    </p>
                                </div>
                            </div>
                        </div>
                        @else
                        <table class="table table-bordered tabla-datos-clientes">
                            <thead>
                            <tr>
                                <th class="text-center">FOTOGRAFÍA</th>
                                <th class="text-center">NOMBRE COMPLETO</th>
                                <th class="text-center">EMAIL</th>
                                <th class="text-center">PRIMER LOGIN</th>
                                <th class="text-center">CONTRASEÑA EXPIRA</th>
                                <th class="text-center">CUENTA ACTIVA</th>
                                <th class="text-center">FECHA DE REGISTRO</th>
                                <th class="text-center">OPCION</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($usuarios as $item)
                            @if($item->per_id != null)                                
                            <tr>
                                <td class="text-center">
                                    <img style="width:100px !important;" class="img-thumbnail" src="{{asset('storage/'.$item->usu_foto)}}">
                                </td>
                                <td class="text-center">
                                    {{$item->persona->per_nombres}} {{$item->persona->per_primer_apellido}} {{$item->persona->per_segundo_apellido}}
                                </td>
                                <td class="text-center">
                                    {{$item->usu_email}}
                                </td>
                                <td class="text-center">
                                    @if($item->usu_primer_login)
                                    <span class="badge badge-info">SI</span>
                                    @else
                                    <span class="badge badge-warning">NO</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    {{$item->usu_expiracion_passsword}}
                                </td>
                                <td class="text-center">
                                    @if($item->usu_activo)
                                    <span class="badge badge-success">SI</span>
                                    @else
                                    <span class="badge badge-danger">NO</span>
                                    @endif
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
                                         <a class="dropdown-item btn-resetear-password" data-cli-id="{{Crypt::encryptString($item->usu_id)}}" data-cli-nombre-completo="{{$item->persona->per_nombres}} {{$item->persona->per_primer_apellido}} {{$item->persona->per_segundo_apellido}}" data-toggle="modal" data-target="#modal-resetear-password" href="#"><i class="fa fa-lock"></i> Resetear contraseña</a>
                                         <a class="dropdown-item" href="{{url('usuarios/'.Crypt::encryptString($item->usu_id).'/editar')}}"><i class="fa fa-edit"></i> Editar</a>
                                         {{-- @if($item->contratos()->count() > 0) --}}
                                         {{-- <a class="dropdown-item" title="El cliente tiene contratos registrados. No es posible eliminar este registro." href="#"><i class="fa fa-trash"></i> Eliminar</a> --}}
                                         {{-- @else --}}
                                         <a class="dropdown-item btn-eliminar-usuario" data-cli-id="{{Crypt::encryptString($item->usu_id)}}" data-cli-nombre-completo="{{$item->persona->per_nombres}} {{$item->persona->per_primer_apellido}} {{$item->persona->per_segundo_apellido}}" data-toggle="modal" data-target="#modal-eliminar-usuario" href="#"><i class="fa fa-trash"></i> Eliminar</a>
                                         {{--@endif --}}
                                      </div>
                                    </div>
                                </td>
                            </tr>
                            @endif
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


{{-- INICIO MODAL: ELIMINAR USUARIO --}}
<div class="modal fade" id="modal-eliminar-usuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-trash"></i>
              Eliminar usuario
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="box-data-xtra">
                <h5>
                    <span class="text-success">NOMBRE USUARIO: </span>
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
          <form id="form-eliminar-usuario" action="{{url('usuarios')}}" data-simple-action="{{url('usuarios')}}" method="post">
            @method('delete')
            @csrf
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Si, eliminar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  {{-- FIN MODAL: ELIMINAR USUARIO --}}

{{-- INICIO MODAL: RESETEAR PASSWORD --}}
<div class="modal fade" id="modal-resetear-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-lock"></i>
              Resetear password
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="box-data-xtra">
                <h5>
                    <span class="text-success">NOMBRE USUARIO: </span>
                    <span id="txt-usu-nombre"></span><br>
                </h5>
            </div>
            <div class="alert alert-warning">
                <div class="media">
                    <img src="{{asset('img/alert-danger.png')}}" class="align-self-center mr-3" alt="...">
                    <div class="media-body">
                        <h5 class="mt-0">Aviso.-</h5>
                        <p>
                            ¿Está seguro de resetear la contraseña de este usuario?
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
          <form id="form-resetear-password" action="{{url('usuarios')}}" data-simple-action="{{url('usuarios/resetear_password')}}" method="post">
            @csrf
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Si, resetear el password</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  {{-- FIN MODAL: RESETEAR PASSWORD --}}


<script type="text/javascript">
$(function(){
    /*
    -------------------------------------------------------------
    * CONFIGURACION DATA TABLES
    -------------------------------------------------------------
    */
    $('.tabla-datos-clientes').DataTable({"language":{url: '{{asset('js/datatables-lang-es.json')}}'}, "order": [[ 3, "desc" ]]});

    /*
    --------------------------------------------------------------
    ELIMINAR ESTADO
    --------------------------------------------------------------
    */
    $('.btn-eliminar-usuario').click(function(){
       let cli_id = $(this).attr('data-cli-id');
       let cli_nombre = $(this).attr('data-cli-nombre-completo');
       $('#txt-cli-nombre').html(cli_nombre);
       //form data
       action = $('#form-eliminar-usuario').attr('data-simple-action');
       action = action+'/'+cli_id;
       $('#form-eliminar-usuario').attr('action',action);
   });

    /*
    --------------------------------------------------------------
    RESETEAR PASSWORD DE USUARIOS
    --------------------------------------------------------------
    */
    $('.btn-resetear-password').click(function(){
       let cli_id = $(this).attr('data-cli-id');
       let cli_nombre = $(this).attr('data-cli-nombre-completo');
       $('#txt-usu-nombre').html(cli_nombre);
       //form data
       action = $('#form-resetear-password').attr('data-simple-action');
       action = action+'/'+cli_id;
       $('#form-resetear-password').attr('action',action);
   });

});
</script>




@endsection
