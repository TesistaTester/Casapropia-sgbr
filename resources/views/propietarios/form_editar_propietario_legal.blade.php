@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
		<h3 class="title-header" style="text-transform: uppercase;">
			<i class="fa fa-edit"></i>
			{{$titulo}}
			<a href="{{url('propietarios')}}" title="Volver a lista de propietarios" data-placement="top" class="btn btn-sm btn-secondary float-right" style="margin-left:10px;"><i class="fa fa-angle-double-left"></i> ATRÁS</a>
		</h3>

		<div class="row">
			<div class="col-md-12">
				<!-- inicio card  -->
				<div class="card">
					<div class="row no-gutters">
						<div class="col-md-12">
							<div class="card-body">
								<h4 class="card-title"><strong><span class="text-primary">
									<i class="fa fa-database"></i>
									Datos personales
								</span></strong></h4>
								<hr>
								<div class="alert alert-info">
									<div class="media">
										<img src="{{asset('img/alert-info.png')}}" class="align-self-center mr-3" alt="...">
										<div class="media-body">
											<h5 class="mt-0">Nota.-</h5>
											<p>
												Tenga en cuenta que al editar los datos del propietario legal no puede cambiar el número de identificación registrado.
											</p>
										</div>
									</div>
								</div>

								<small>Los campos marcados con asterisco (<span class="text-danger">*</span>) son obligatorios.</small>
								<form id="form-editar-propietario-legal" action="{{url('propietarios_legales/'.$propietario->ple_id)}}" method="POST">
   								  @method('PUT')
								  @csrf
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
													<label class="label-blue label-block" for="">
														Tipo de documento:
														<span class="text-danger">*</span>
														<i class="fa fa-question-circle float-right" title="Establecer el tipo de documento de la persona"></i>
													</label>
												<select required name="per_tipo_documento" id="per_tipo_documento" class="form-control @error('per_tipo_documento') is-invalid @enderror">
													<option value="">Seleccione una opción</option>
													<option value="0" {{ old('per_tipo_documento', $persona->per_tipo_documento) == '0' ? 'selected' : '' }}>Cédula de identidad</option>
													<option value="1" {{ old('per_tipo_documento', $persona->per_tipo_documento) == '1' ? 'selected' : '' }}>Libreta de servicio militar</option>
													<option value="2" {{ old('per_tipo_documento', $persona->per_tipo_documento) == '2' ? 'selected' : '' }}>Otro</option>
												</select>
												@error('per_tipo_documento')
												<div class="invalid-feedback">
													{{$message}}
												</div>											
												@enderror
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
													<label class="label-blue label-block" for="">
														Número de documento:
														<span class="text-danger">*</span>
														<i class="fa fa-question-circle float-right" title="Establecer el número de documento de la persona"></i>
													</label>
												<input required type="text" value="{{old('per_nro_id', $persona->per_nro_id)}}" class="form-control @error('per_nro_id') is-invalid @enderror" name="per_nro_id" id="per_nro_id" placeholder="Número de documento">
												@error('per_nro_id')
												<div class="invalid-feedback">
													{{$message}}
												</div>											
												@enderror
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
													<label class="label-blue label-block" for="">
														Expedido en:
														<span class="text-danger">*</span>
														<i class="fa fa-question-circle float-right" title="Establecer el lugar donde fue expedido el documento"></i>
													</label>
												<select required class="form-control @error('per_expedido') is-invalid @enderror" name="per_expedido" id="per_expedido">
													<option value="">Seleccione una opción</option>
													<option value="LP"{{ old('per_expedido', $persona->per_expedido) == 'LP' ? 'selected' : '' }}>La Paz</option>
													<option value="OR"{{ old('per_expedido', $persona->per_expedido) == 'OR' ? 'selected' : '' }}>Oruro</option>
													<option value="PT"{{ old('per_expedido', $persona->per_expedido) == 'PT' ? 'selected' : '' }}>Potosí</option>
													<option value="CB"{{ old('per_expedido', $persona->per_expedido) == 'CB' ? 'selected' : '' }}>Cochabamba</option>
													<option value="CH"{{ old('per_expedido', $persona->per_expedido) == 'CH' ? 'selected' : '' }}>Chuquisaca</option>
													<option value="TJ"{{ old('per_expedido', $persona->per_expedido) == 'TJ' ? 'selected' : '' }}>Tarija</option>
													<option value="PN"{{ old('per_expedido', $persona->per_expedido) == 'PN' ? 'selected' : '' }}>Pando</option>
													<option value="BN"{{ old('per_expedido', $persona->per_expedido) == 'BN' ? 'selected' : '' }}>Beni</option>
													<option value="SC"{{ old('per_expedido', $persona->per_expedido) == 'SC' ? 'selected' : '' }}>Santa Cruz</option>
												</select>
												@error('per_expedido')
												<div class="invalid-feedback">
													{{$message}}
												</div>											
												@enderror
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
													<label class="label-blue label-block" for="">
														Nombres:
														<span class="text-danger">*</span>
														<i class="fa fa-question-circle float-right" title="Establecer los nombres de las personas"></i>
													</label>
												<input required type="text" value="{{old('per_nombres', $persona->per_nombres)}}" class="form-control @error('per_nombres') is-invalid @enderror" name="per_nombres" id="per_nombres" placeholder="Nombres">
												@error('per_nombres')
												<div class="invalid-feedback">
													{{$message}}
												</div>											
												@enderror
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
													<label class="label-blue label-block" for="">
														Primer apellido:
														<span class="text-danger">*</span>
														<i class="fa fa-question-circle float-right" title="Establecer el primer apellido de la persona"></i>
													</label>
												<input required type="text" value="{{old('per_primer_apellido', $persona->per_primer_apellido)}}" class="form-control @error('per_primer_apellido') is-invalid @enderror" name="per_primer_apellido" id="per_primer_apellido" placeholder="Primer apellido">
												@error('per_primer_apellido')
												<div class="invalid-feedback">
													{{$message}}
												</div>											
												@enderror
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
													<label class="label-blue label-block" for="">
														Segundo apellido:
														<span class="text-danger">*</span>
														<i class="fa fa-question-circle float-right" title="Establecer el segundo apellido de la persona"></i>
													</label>
												<input required type="text" value="{{old('per_segundo_apellido', $persona->per_segundo_apellido)}}" class="form-control @error('per_segundo_apellido') is-invalid @enderror" name="per_segundo_apellido" id="per_segundo_apellido" placeholder="Segundo apellido">
												@error('per_segundo_apellido')
												<div class="invalid-feedback">
													{{$message}}
												</div>											
												@enderror
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
													<label class="label-blue label-block" for="">
														Fecha de nacimiento:
														<span class="text-danger">*</span>
														<i class="fa fa-question-circle float-right" title="Establecer la fecha de nacimiento de la persona"></i>
													</label>
												<input required type="date" value="{{old('per_fecha_nacimiento', $persona->per_fecha_nacimiento)}}" class="form-control @error('per_fecha_nacimiento') is-invalid @enderror" name="per_fecha_nacimiento" id="per_fecha_nacimiento" placeholder="Fecha de nacimiento">
												@error('per_fecha_nacimiento')
												<div class="invalid-feedback">
													{{$message}}
												</div>											
												@enderror
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
													<label class="label-blue label-block" for="">
														Género:
														<span class="text-danger">*</span>
														<i class="fa fa-question-circle float-right" title="Establecer el género de la persona"></i>
													</label>
													<select required class="form-control @error('per_sexo') is-invalid @enderror" name="per_sexo" id="per_sexo">
														<option value="">Seleccione una opción</option>
														<option value="M" {{ old('per_sexo', $persona->per_sexo) == 'M' ? 'selected' : '' }}>Masculino</option>
														<option value="F" {{ old('per_sexo', $persona->per_sexo) == 'F' ? 'selected' : '' }}>Femenino</option>
														<option value="O" {{ old('per_sexo', $persona->per_sexo) == 'O' ? 'selected' : '' }}>Otro</option>
													</select>
													@error('per_sexo')
												<div class="invalid-feedback">
													{{$message}}
												</div>											
												@enderror
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
													<label class="label-blue label-block" for="">
														Estado civil:
														<span class="text-danger">*</span>
														<i class="fa fa-question-circle float-right" title="Establecer el estado civil de la persona"></i>
													</label>
													<select required class="form-control @error('per_estado_civil') is-invalid @enderror" name="per_estado_civil" id="per_estado_civil">
														<option value="">Seleccione una opción</option>
														<option value="0" {{ old('per_estado_civil', $persona->per_estado_civil) == '0' ? 'selected' : '' }}>Soltero</option>
														<option value="1" {{ old('per_estado_civil', $persona->per_estado_civil) == '1' ? 'selected' : '' }}>Casado</option>
														<option value="2" {{ old('per_estado_civil', $persona->per_estado_civil) == '2' ? 'selected' : '' }}>Concubinato</option>
														<option value="3" {{ old('per_estado_civil', $persona->per_estado_civil) == '3' ? 'selected' : '' }}>Viudo</option>
														<option value="4" {{ old('per_estado_civil', $persona->per_estado_civil) == '4' ? 'selected' : '' }}>Divorciado</option>
														<option value="5" {{ old('per_estado_civil', $persona->per_estado_civil) == '5' ? 'selected' : '' }}>Otro</option>
													</select>
												@error('per_estado_civil')
												<div class="invalid-feedback">
													{{$message}}
												</div>											
												@enderror
											</div>
											<input type="hidden" name="per_id" id="per_id" value="{{$persona->per_id}}">
											<button type="reset" id="btn-reestablecer-form" class="btn btn-secondary">
													<i class="fa fa-refresh"></i>
													Reestablecer formulario
											</button>
											<button type="submit" class="btn btn-primary">
													<i class="fa fa-save"></i>
													Guardar datos
											</button>
										</div>
									</div>

								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- fin card  -->

			</div>
		</div>

	</div>

	

<script>
$(function(){
	$("#per_nro_id").attr('readonly', true);

	$('#btn-reestablecer-form').click(function(){
		$("#per_nro_id").attr('readonly', true);
	});		

});	
</script>

    @endsection