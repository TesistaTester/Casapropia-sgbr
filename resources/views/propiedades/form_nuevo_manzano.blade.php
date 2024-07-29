@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-9 content-pane">
	<h3 class="title-header" style="text-transform: uppercase;">
		<i class="fa fa-plus"></i>
		{{$titulo}}
		<a title="Volver a lista de urbanizaciones" class="btn btn-sm btn-secondary float-right" data-placement="top" style="margin-left:10px;" href="#"><i class="fa fa-angle-double-left"></i> ATRÁS</a>
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
									<form action="{{url('manzanos')}}" method="POST">
										@csrf
										<input type="hidden" name="urb_id" value="{{$urbanizacion->urb_id}}">
										<div class="form-group">
											<label class="label-blue label-block" for="">
												Nombre del manzano:
												<span class="text-danger">*</span>
												<i class="fa fa-question-circle float-right" title="Descripcion adicional"></i>
											</label>
										<input required pattern="[A-Za-z0-9._\s]{1,}" value="{{old('man_nombre')}}" type="text" class="form-control @error('man_nombre') is-invalid @enderror" name="man_nombre" placeholder="Nombre del manzano">
										@error('man_nombre')
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