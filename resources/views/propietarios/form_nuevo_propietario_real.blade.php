@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
		<h3 class="title-header" style="text-transform: uppercase;">
			<i class="fa fa-plus"></i>
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
												Asegurese de registrar correctamente el número de identificación del propietario.
												Tenga en cuenta que al editar los datos del propietario legal no puede cambiar el número de identificación registrado.
											</p>
										</div>
									</div>
								</div>

								<small>Los campos marcados con asterisco (<span class="text-danger">*</span>) son obligatorios.</small>
								<form id="form-nuevo-propietario-real" action="{{url('propietarios_reales')}}" method="POST" data-validation1="{{url('propietarios_reales/valida_propietario')}}">
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
													<option value="0" {{ old('per_tipo_documento') == '0' ? 'selected' : '' }}>Cédula de identidad</option>
													<option value="1" {{ old('per_tipo_documento') == '1' ? 'selected' : '' }}>Libreta de servicio militar</option>
													<option value="2" {{ old('per_tipo_documento') == '2' ? 'selected' : '' }}>Otro</option>
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
												<input required type="text" value="{{old('per_nro_id')}}" class="form-control @error('per_nro_id') is-invalid @enderror" name="per_nro_id" id="per_nro_id" placeholder="Número de documento">
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
													<option value="LP" {{ old('per_expedido') == 'LP' ? 'selected' : '' }}>La Paz</option>
													<option value="OR"{{ old('per_expedido') == 'OR' ? 'selected' : '' }}>Oruro</option>
													<option value="PT"{{ old('per_expedido') == 'PT' ? 'selected' : '' }}>Potosí</option>
													<option value="CB"{{ old('per_expedido') == 'CB' ? 'selected' : '' }}>Cochabamba</option>
													<option value="CH"{{ old('per_expedido') == 'CH' ? 'selected' : '' }}>Chuquisaca</option>
													<option value="TJ"{{ old('per_expedido') == 'TJ' ? 'selected' : '' }}>Tarija</option>
													<option value="PN"{{ old('per_expedido') == 'PN' ? 'selected' : '' }}>Pando</option>
													<option value="BN"{{ old('per_expedido') == 'BN' ? 'selected' : '' }}>Beni</option>
													<option value="SC"{{ old('per_expedido') == 'SC' ? 'selected' : '' }}>Santa Cruz</option>
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
												<input required type="text" value="{{old('per_nombres')}}" class="form-control @error('per_nombres') is-invalid @enderror" name="per_nombres" id="per_nombres" placeholder="Nombres">
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
												<input required type="text" value="{{old('per_primer_apellido')}}" class="form-control @error('per_primer_apellido') is-invalid @enderror" name="per_primer_apellido" id="per_primer_apellido" placeholder="Primer apellido">
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
												<input required type="text" value="{{old('per_segundo_apellido')}}" class="form-control @error('per_segundo_apellido') is-invalid @enderror" name="per_segundo_apellido" id="per_segundo_apellido" placeholder="Segundo apellido">
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
												<input required type="date" value="{{old('per_fecha_nacimiento')}}" class="form-control @error('per_fecha_nacimiento') is-invalid @enderror" name="per_fecha_nacimiento" id="per_fecha_nacimiento" placeholder="Fecha de nacimiento">
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
														<option value="M" {{ old('per_sexo') == 'M' ? 'selected' : '' }}>Masculino</option>
														<option value="F" {{ old('per_sexo') == 'F' ? 'selected' : '' }}>Femenino</option>
														<option value="O" {{ old('per_sexo') == 'O' ? 'selected' : '' }}>Otro</option>
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
														<option value="0" {{ old('per_estado_civil') == '0' ? 'selected' : '' }}>Soltero</option>
														<option value="1" {{ old('per_estado_civil') == '1' ? 'selected' : '' }}>Casado</option>
														<option value="2" {{ old('per_estado_civil') == '2' ? 'selected' : '' }}>Concubinato</option>
														<option value="3" {{ old('per_estado_civil') == '3' ? 'selected' : '' }}>Viudo</option>
														<option value="4" {{ old('per_estado_civil') == '4' ? 'selected' : '' }}>Divorciado</option>
														<option value="5" {{ old('per_estado_civil') == '5' ? 'selected' : '' }}>Otro</option>
													</select>
												@error('per_estado_civil')
												<div class="invalid-feedback">
													{{$message}}
												</div>											
												@enderror
											</div>
											<input type="hidden" name="per_id" id="per_id" value="0">
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


  {{-- INICIO MODAL: EXISTE PROPIETARIO / AUTOCOMPLETAR FORMULARIO --}}
  <div class="modal fade" id="modal-autocompletar-formulario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-info-circle"></i>
              Validación propietario real
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <h5 class="text-left">
                <span class="text-success">NRO DOCUMENTO: </span>
                <span id="txt-nro-documento"></span>
				<br>
                <span class="text-success">NOMBRE COMPLETO: </span>
                <span id="txt-nombre-completo"></span>
            </h5>
            <div class="alert alert-danger" id="alert-propietario-existe">
                <div class="media">
                    <img src="{{asset('img/alert-danger.png')}}" class="align-self-center mr-3" alt="...">
                    <div class="media-body">
                        <h5 class="mt-0">Cuidado.-</h5>
                        <p>
                            El número de documento ingresado ya pertenece a un propietario real registrado.<br> <b>El formulario fue vaciado, revise los datos e intente nuevamente.</b>
                        </p>
                    </div>
                </div>
            </div>
            <div class="alert alert-info" id="alert-persona-existe">
                <div class="media">
                    <img src="{{asset('img/alert-info.png')}}" class="align-self-center mr-3" alt="...">
                    <div class="media-body">
                        <h5 class="mt-0">Nota.-</h5>
                        <p>
							La persona con el número de documento ya está registrada en la base de datos. <br> 
							<b>Para registrarlo como propietario real solo debe AUTOCOMPLETAR el formulario y luego hacer clic en GUARDAR DATOS para guardar el formulario.
                        </p>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" id="btn-entendido" class="btn btn-secondary" data-dismiss="modal">Entendido</button>
          {{-- <button type="button" id="btn-no-autocompletar" class="btn btn-secondary" data-dismiss="modal">No autocompletar</button> --}}
          <button type="button" id="btn-autocompletar" class="btn btn-primary" data-dismiss="modal">Autocompletar formulario</button>
        </div>
      </div>
    </div>
  </div>
  {{-- FIN MODAL: EXISTE PROPIETARIO / AUTOCOMPLETAR FORMULARIO --}}

	

<script>
$(function(){
	var registro_persona = null;
	$('#per_nro_id').focusout(function(e){
				e.preventDefault();
				var rsm = $('#form-nuevo-propietario-real').attr('data-validation1');
				var per_nro_id = $('#per_nro_id').val();
				var csrfName = '_token'; // Value specified in $config['csrf_token_name']
				var csrfHash = $("input[name='_token']").val(); // CSRF hash
				$.ajax({
						type: "POST",
						url: rsm,
						data: {
							per_nro_id: per_nro_id,
							[csrfName]: csrfHash},
	       			    dataType: 'json',
						beforeSend: function(){
							$('.request-loader').show(20);
							$('#alert-propietario-existe').hide();
							$('#alert-persona-existe').hide();
							$('#btn-entendido').hide();
							$('#btn-no-autocompletar').hide();
							$('#btn-autocompletar').hide();
						},
						success: function(data){
							$('.request-loader').hide();
							if(data.status == 1){
								//no existe, puede continuar llenando
								console.log(data);
							}
							if(data.status == 2){
								//Mostrar modal solo existe en persona, autollenar
								console.log(data);
								let persona = data.persona[0];
								registro_persona = persona;

								$('#txt-nro-documento').html(persona.per_nro_id+' '+persona.per_expedido);
								$('#txt-nombre-completo').html(persona.per_nombres+' '+persona.per_primer_apellido+' '+persona.per_segundo_apellido);
								$('#alert-persona-existe').show();
								$('#btn-no-autocompletar').show();
								$('#btn-autocompletar').show();
								$('#modal-autocompletar-formulario').modal('show')
							}
							if(data.status == 3){
								//Mostrar modal error existe propietario y vaciar formulario
								console.log(data);
								let propietario = data.propietario[0];
								$('#txt-nro-documento').html(propietario.per_nro_id+' '+propietario.per_expedido);
								$('#txt-nombre-completo').html(propietario.per_nombres+' '+propietario.per_primer_apellido+' '+propietario.per_segundo_apellido);
								$('#alert-propietario-existe').show();
								$('#btn-entendido').show();
								$('#modal-autocompletar-formulario').modal('show')
								$('#form-nuevo-propietario-real').trigger("reset");
							}
						},
						error: function(data){
							console.log(data);
							$('.request-loader').hide();
							console.log("Error de servidor");
						}
				});
			});

	// $('#btn-no-autocompletar').click(function(){
	// 	$('#form-nuevo-propietario-real').trigger("reset");
	// });		
	$('#modal-autocompletar-formulario').on('hidden.bs.modal', function (e) {
		if($('#per_id').val() == '0'){
			$('#form-nuevo-propietario-real').trigger("reset");
		}
	});
	$('#btn-reestablecer-form').click(function(){
		$("#form-nuevo-propietario-real :input:not(:button):not(input[type='hidden'])").attr('readonly', false);
	});		
	$('#btn-autocompletar').click(function(){
		$('#per_tipo_documento').val(registro_persona.per_tipo_documento).change();
		$('#per_expedido').val(registro_persona.per_expedido).change();
		$('#per_nombres').val(registro_persona.per_nombres);
		$('#per_primer_apellido').val(registro_persona.per_primer_apellido);
		$('#per_segundo_apellido').val(registro_persona.per_segundo_apellido);
		$('#per_fecha_nacimiento').val(registro_persona.per_fecha_nacimiento);
		$('#per_sexo').val(registro_persona.per_sexo).change();
		$('#per_estado_civil').val(registro_persona.per_estado_civil).change();
		$('#per_id').val(registro_persona.per_id);
		$("#form-nuevo-propietario-real :input:not(:button):not(input[type='hidden'])").attr('readonly', 'readonly');
	});		

});	
</script>

    @endsection