@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')
	<!-- CONTENIDO -->
	<div class="col-md-10 content-pane">
		<h3 class="title-header" style="text-transform: uppercase;">
			<i class="fa fa-building"></i>
			{{$titulo}}
			<a class="btn btn-sm btn-secondary float-right" style="margin-left:10px;" href="#"><i class="fa fa-chevron-left"></i> ATRAS</a>
			<a class="btn btn-sm btn-success float-right" href="{{url('urbanizaciones/nuevo')}}"><i class="fa fa-plus"></i> NUEVA URBANIZACION</a>
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
			  @foreach($urbanizaciones as $item)
			  <div class="row no-gutters">
			    <div class="col-md-3">
						<img style="width: 100%" src="{{asset('img/bg-urbanizacion.png')}}" alt="Foto urbanizacion">
			    </div>
			    <div class="col-md-9">
			      <div class="card-body">
			        <h4 class="card-title"><strong><span class="text-primary">URBANIZACION:</span> {{Str::upper($item->urb_nombre)}}</strong>
					@if (count($item->lotes) == 0 && count($item->manzanos) == 0)
                	<a href="#" title="Eliminar urbanizacion" data-toggle="modal" data-target="#modal-eliminar-urbanizacion" class="btn btn-sm btn-danger float-right btn-eliminar-urbanizacion" style="margin-left:10px;" data-urb-id="{{Crypt::encryptString($item->urb_id)}}" data-urb-nombre="{{$item->urb_nombre}}"><i class="fa fa-trash"></i> ELIMINAR</a>						
					@endif	
                    <a href="{{url('urbanizaciones/'.Crypt::encryptString($item->urb_id).'/editar')}}" title="Editar datos de urbanización" class="btn btn-sm btn-primary float-right" style="margin-left:10px;"><i class="fa fa-edit"></i> EDITAR</a> 
					</h4>
							<hr>
							<div class="row">
								<div class="col-md-6">
									<h5 class="card-title"><span class="text-success">FECHA APROBACION:</span> 
										@if(Str::of($item->urb_fecha_aprobacion)->trim()->isEmpty())
										<small>[No definido]</small>
										@else
										{{$item->urb_fecha_aprobacion}}
										@endif
									</h5>
								</div>
								<div class="col-md-6">
									<h5 class="card-title"><span class="text-success">LEY MUNICIPAL:</span> 
										@if(Str::of($item->urb_ley)->trim()->isEmpty())
										<small>[No definido]</small>
										@else
										{{$item->urb_ley}}
										@endif
									</h5>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<h5 class="card-title"><span class="text-success">MANZANOS:</span> {{$item->manzanos->count();}}</h5>
								</div>
								<div class="col-md-6">
									<h5 class="card-title"><span class="text-success">TOTAL LOTES:</span> {{$item->lotes->count();}}</h5>
								</div>
							</div>
							<a href="{{url('urbanizaciones/'.Crypt::encryptString($item->urb_id))}}" class="btn btn-primary">
								<i class="fa fa-chevron-right"></i>
								ADMINISTRAR URBANIZACION
							</a>
			      </div>
			    </div>
			  </div>
			  <hr>
			  @endforeach
			  @endif
			</div>
			<!-- fin card  -->

			<!-- PAGINACION INICIO -->
            {{$urbanizaciones->links()}}
			<!-- PAGINACION FIN -->

	</div><!-- END RIGHT CONTENT -->

</div>

{{-- INICIO MODAL: ELIMINAR URBANIZACION --}}
<div class="modal fade" id="modal-eliminar-urbanizacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-trash"></i>
              Eliminar urbanización
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="box-data-xtra">
                <h5>
                    <span class="text-success">DESCRIPCION: </span>
                    <span id="txt-urb-nombre"></span><br>
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
          <form id="form-eliminar-urbanizacion" action="{{url('urbanizaciones')}}" data-simple-action="{{url('urbanizaciones')}}" method="post">
            @method('delete')
            @csrf
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Si, eliminar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  {{-- FIN MODAL: ELIMINAR URBANIZACION --}}

  <script type="text/javascript">
	$(function(){
	
		/*
		--------------------------------------------------------------
		ELIMINAR RESERVA
		--------------------------------------------------------------
		*/
		$('.btn-eliminar-urbanizacion').click(function(){
		   let urb_id = $(this).attr('data-urb-id');
		   let urb_nombre = $(this).attr('data-urb-nombre');
		   console.log(urb_id);
		   console.log(urb_nombre);
		   $('#txt-urb-nombre').html(urb_nombre);
		   //form data
		   action = $('#form-eliminar-urbanizacion').attr('data-simple-action');
		   action = action+'/'+urb_id;
		   $('#form-eliminar-urbanizacion').attr('action',action);
	   });		
	
	});
	</script>
	

@endsection