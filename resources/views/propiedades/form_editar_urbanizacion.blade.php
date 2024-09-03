@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
		<h3 class="title-header" style="text-transform: uppercase;">
			<i class="fa fa-edit"></i>
			{{$titulo}}
			<a href="{{url('urbanizaciones')}}" title="Volver a lista de urbanizaciones" data-placement="top" class="btn btn-sm btn-secondary float-right" style="margin-left:10px;"><i class="fa fa-angle-double-left"></i> ATRÁS</a>
		</h3>

		<div class="row">
			<div class="col-md-12">
				<!-- inicio card  -->
				<div class="card">
					<div class="row no-gutters">
						<div class="col-md-12">
							<div class="card-body">
								<div class="row">
									<div class="col-md-6 offset-md-3">
										<h4 class="card-title"><strong><span class="text-primary">
											<i class="fa fa-database"></i>
											Datos básicos
										</span></strong></h4>
										<hr>
										<small>Los campos marcados con asterisco (<span class="text-danger">*</span>) son obligatorios.</small>
										<form action="{{url('urbanizaciones/'.$urbanizacion->urb_id)}}" method="POST">
											@method('PUT')
											@csrf
										  <div class="form-group">
												<label class="label-blue label-block" for="">
													Nombre de la urbanización:
													<span class="text-danger">*</span>
													<i class="fa fa-question-circle float-right" title="Descripcion adicional"></i>
												</label>
										    <input type="text" value="{{old('urb_nombre', $urbanizacion->urb_nombre)}}" class="form-control @error('urb_nombre') is-invalid @enderror" name="urb_nombre" placeholder="Nombre urbanización">
											@error('urb_nombre')
											<div class="invalid-feedback">
												{{$message}}
											</div>											
											@enderror

										  </div>
										  <div class="form-group">
												<label class="label-blue label-block" for="">
													Fecha de aprobación:
													<i class="fa fa-question-circle float-right" title="Descripcion adicional"></i>
												</label>
										    <input type="date" value="{{old('urb_fecha_aprobacion', $urbanizacion->urb_fecha_aprobacion)}}" class="form-control @error('urb_fecha_aprobacion') is-invalid @enderror" name="urb_fecha_aprobacion" placeholder="Fecha de aprobacion">
											@error('urb_fecha_aprobacion')
											<div class="invalid-feedback">
												{{$message}}
											</div>											
											@enderror
										  </div>
											<div class="form-group">
												<label class="label-blue label-block" for="">
													Ley de municipal:
													<i class="fa fa-question-circle float-right" title="Descripcion adicional"></i>
												</label>
										    <input type="text" value="{{old('urb_ley', $urbanizacion->urb_ley)}}" class="form-control @error('urb_ley') is-invalid @enderror" name="urb_ley" placeholder="Describir la ley municipal">
											@error('urb_ley')
											<div class="invalid-feedback">
												{{$message}}
											</div>											
											@enderror
										  </div>
										  <button type="submit" class="btn btn-primary">
												<i class="fa fa-save"></i>
												Guardar datos
											</button>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- fin card  -->

			</div>
		</div>

	</div>

    @endsection