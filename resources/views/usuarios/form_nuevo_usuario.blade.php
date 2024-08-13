@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
		<h3 class="title-header" style="text-transform: uppercase;">
			<i class="fa fa-plus"></i>
			{{$titulo}}
			<a href="{{url('usuarios')}}" title="Volver a lista de propietarios" data-placement="top" class="btn btn-sm btn-secondary float-right" style="margin-left:10px;"><i class="fa fa-angle-double-left"></i> ATRÁS</a>
		</h3>

		<div class="row">
			<div class="col-md-12">
				<!-- inicio card  -->
				<div class="card">
					<div class="row no-gutters">
						<div class="col-md-12">
							<div class="card-body">
								<form enctype="multipart/form-data" id="form-nuevo-usuario" action="{{url('usuarios')}}" method="POST" data-validation1="{{url('usuarios/valida_usuario')}}" data-validation2="{{url('usuarios/valida_email')}}">
								  @csrf
									<div class="alert alert-info">
										<div class="media">
											<img src="{{asset('img/alert-info.png')}}" class="align-self-center mr-3" alt="...">
											<div class="media-body">
												<h5 class="mt-0">Nota.-</h5>
												<p>
													- Asegurese de tener la fotografía del usuario.
													<br>
													- Ingrese correctamente el número de documento de identificación (CI, libreta militar), luego este dato NO es posible modificarlo.
												</p>
											</div>
										</div>
									</div>
								  
								  <section id="seccion-datos-personales">
									<h4 class="card-title"><strong><span class="text-primary">
										<i class="fa fa-database"></i>
										Datos personales <span id="txt-representante-empresa"></span>
									</span></strong></h4>
									<hr>
									<div class="row">
										<div class="col-md-8">
											<div class="row">
												<div class="col-md-6">
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
												<div class="col-md-6">
													<div class="form-group">
															<label class="label-blue label-block" for="">
																Número de documento de identificación:
																<span class="text-danger">*</span>
																<i class="fa fa-question-circle float-right" title="Establecer el número de documento de identificación de la persona"></i>
															</label>
														<input required type="text" value="{{old('per_nro_id')}}" class="form-control @error('per_nro_id') is-invalid @enderror" name="per_nro_id" id="per_nro_id" placeholder="Número de documento">
														@error('per_nro_id')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
															<label class="label-blue label-block" for="">
																Expedido en:
																<span class="text-danger">*</span>
																<i class="fa fa-question-circle float-right" title="Establecer el lugar donde fue expedido el documento"></i>
															</label>
														<select required class="form-control @error('per_expedido') is-invalid @enderror" name="per_expedido" id="per_expedido">
															<option value="">Seleccione una opción</option>
															<option value="LP" {{ old('per_expedido') == 'LP' ? 'selected' : '' }}>LA PAZ</option>
															<option value="OR"{{ old('per_expedido') == 'OR' ? 'selected' : '' }}>ORURO</option>
															<option value="PT"{{ old('per_expedido') == 'PT' ? 'selected' : '' }}>POTOSÍ</option>
															<option value="CB"{{ old('per_expedido') == 'CB' ? 'selected' : '' }}>COCHABAMBA</option>
															<option value="CH"{{ old('per_expedido') == 'CH' ? 'selected' : '' }}>CHUQUISACA</option>
															<option value="TJ"{{ old('per_expedido') == 'TJ' ? 'selected' : '' }}>TARIJA</option>
															<option value="PN"{{ old('per_expedido') == 'PN' ? 'selected' : '' }}>PANDO</option>
															<option value="BN"{{ old('per_expedido') == 'BN' ? 'selected' : '' }}>BENI</option>
															<option value="SC"{{ old('per_expedido') == 'SC' ? 'selected' : '' }}>SANTA CRUZ</option>
														</select>
														@error('per_expedido')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-6">
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
											</div>
											<div class="row">
												<div class="col-md-6">
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
												<div class="col-md-6">
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
										</div>
										<div class="col-md-4">
											<div class="row">
												<div class="col-md-12">
													<label class="label-blue label-block" for="">
														Fotografía usuario:
														<span class="text-danger">*</span>
														<i class="fa fa-question-circle float-right" title="Establecer la fotografía del usuario"></i>
													</label>
													<div class="text-center">
														<img src="{{asset('img/default.jpg')}}" id="preview" class="img-thumbnail" style="width:60%; margin-bottom:7px;">
													</div>
													<input required type="file" name="usu_foto" id="usu_foto" class="form-control file @error('usu_foto') is-invalid @enderror" accept="image/*">
													@error('usu_foto')
													<div class="invalid-feedback">
														{{$message}}
													</div>											
													@enderror

												</div>
											</div>
										</div>
									</div>
								  </section>
								  <section id="seccion-datos-personales">
									<h4 class="card-title"><strong><span class="text-primary">
										<i class="fa fa-key"></i>
										Credenciales <span id="txt-representante-empresa"></span>
									</span></strong></h4>
									<hr>
									<div class="row">
										<div class="col-md-12">
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
															<label class="label-blue label-block" for="">
																Usuario:
																<span class="text-danger">*</span>
																<i class="fa fa-question-circle float-right" title="Establecer el nombre de usuario"></i>
															</label>
														<input required type="email" value="{{old('usu_email')}}" class="form-control @error('usu_email') is-invalid @enderror" name="usu_email" id="usu_email" placeholder="Escriba el Email de la persona">
														@error('usu_email')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
															<label class="label-blue label-block" for="">
																Password:
																<span class="text-danger">*</span>
																<i class="fa fa-question-circle float-right" title="El password de la persona se genera automaticamente"></i>
															</label>
														<input required type="password" value="{{old('usu_password', Str::random(30))}}" class="form-control @error('usu_password') is-invalid @enderror" name="usu_password" id="usu_password" readonly>
														<small>El password es generado automáticamente y enviado al email especificado.</small>
														@error('usu_password')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
															<label class="label-blue label-block" for="">
																Roles de usuario:
																<span class="text-danger">*</span>
																<i class="fa fa-question-circle float-right" title="El password de la persona se genera automaticamente"></i>
															</label>
															<select required multiple class="form-control select-multi @error('rol_id') is-invalid @enderror" name="rol_id[]" id="rol_id">
																{{-- <option value="">Seleccione una opción</option> --}}
																@foreach ($roles as $item)
																@if($item->rol_id > 1)
																<option value="{{$item->rol_id}}" {{ old('rol_id') == $item->rol_id ? 'selected' : '' }}>{{$item->rol_nombre}}</option>
																@endif
																@endforeach
															</select>	
														@error('rol_id')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
											</div>
										</div>
									</div>
								  </section>

								  <input type="hidden" name="per_id" id="per_id" value="0">
									<button type="submit" class="btn btn-primary">
											<i class="fa fa-save"></i>
											Guardar datos
									</button>
					</form>
							</div>
						</div>
					</div>
				</div>

				<!-- fin card  -->

			</div>
		</div>
	</div>


  {{-- INICIO MODAL: EXISTE USUARIO / AUTOCOMPLETAR FORMULARIO --}}
  <div class="modal fade" id="modal-autocompletar-formulario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-info-circle"></i>
              Validación datos de usuario
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
            <div class="alert alert-danger" id="alert-usuario-existe">
                <div class="media">
                    <img src="{{asset('img/alert-danger.png')}}" class="align-self-center mr-3" alt="...">
                    <div class="media-body">
                        <h5 class="mt-0">Cuidado.-</h5>
                        <p>
                            El número de documento ingresado ya pertenece a un usuario registrado.<br> <b>El formulario fue vaciado. Revise los usuarios registrados o intente nuevamente.</b>
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
							<b>Para registrarlo como usuario solo debe AUTOCOMPLETAR el formulario y continuar con la Fotografía en el formulario.
                        </p>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" id="btn-entendido" class="btn btn-secondary" data-dismiss="modal">Entendido</button>
          {{-- <button type="button" id="btn-no-autocompletar" class="btn btn-secondary" data-dismiss="modal">No autocompletar</button> --}}
          <button type="button" id="btn-autocompletar" class="btn btn-primary" data-dismiss="modal">
			<i class="fa fa-edit"></i>
			Autocompletar datos
		  </button>
        </div>
      </div>
    </div>
  </div>
  {{-- FIN MODAL: EXISTE USUARIO / AUTOCOMPLETAR FORMULARIO --}}

  {{-- INICIO MODAL: EXISTE EMAIL --}}
  <div class="modal fade" id="modal-autocompletar-formulario-email" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-info-circle"></i>
              Validación de credenciales
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <h5 class="text-left">
                <span class="text-success">EMAIL: </span>
                <span id="txt-email"></span>
				<br>
            </h5>
            <div class="alert alert-danger" id="alert-email-existe">
                <div class="media">
                    <img src="{{asset('img/alert-danger.png')}}" class="align-self-center mr-3" alt="...">
                    <div class="media-body">
                        <h5 class="mt-0">Cuidado.-</h5>
                        <p>
                            Este EMAIL ya pertenece a un usuario registrado.<br>
							Revise el registro de usuarios para verificarlo.
                        </p>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" id="btn-entendido" class="btn btn-secondary" data-dismiss="modal">Entendido</button>
        </div>
      </div>
    </div>
  </div>
  {{-- FIN MODAL: EXISTE EMAIL --}}
	


<script>
$(function(){
	/*
	* Verificación de duplicados de persona en bd
	* Evento: focusout
	*/
	var registro_persona = null;
	$('#per_nro_id').focusout(function(e){
				e.preventDefault();
				var rsm = $('#form-nuevo-usuario').attr('data-validation1');
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
							$('#alert-usuario-existe').hide();
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
								let usuario = data.usuario[0];
								$('#txt-nro-documento').html(usuario.per_nro_id+' '+usuario.per_expedido);
								$('#txt-nombre-completo').html(usuario.per_nombres+' '+usuario.per_primer_apellido+' '+usuario.per_segundo_apellido);
								$('#alert-usuario-existe').show();
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


			var registro_persona = null;
			$('#usu_email').focusout(function(e){
				e.preventDefault();
				var rsm = $('#form-nuevo-usuario').attr('data-validation2');
				var email = $(this).val();
				var campo = $(this);
				console.log($(this).val());
				var csrfName = '_token'; // Value specified in $config['csrf_token_name']
				var csrfHash = $("input[name='_token']").val(); // CSRF hash
				$.ajax({
						type: "POST",
						url: rsm,
						data: {
							usu_email: email,
							[csrfName]: csrfHash},
	       			    dataType: 'json',
						beforeSend: function(){
							$('.request-loader').show(20);
							$('#alert-email-existe').hide();
							$('#btn-entendido').hide();
						},
						success: function(data){
							$('.request-loader').hide();
							$('#txt-email').html(email);
							if(data.status == 1){
								//no existe, puede continuar llenando
								console.log(data);
							}
							if(data.status == 2){
								//Mostrar modal error existe EMAIL y vaciar formulario
								console.log(data);
								$('#alert-email-existe').show();
								campo.val('');//resetear el campo email
								$('#modal-autocompletar-formulario-email').modal('show')
							}
						},
						error: function(data){
							console.log(data);
							$('.request-loader').hide();
							console.log("Error de servidor");
						}
				});
			});


	$('#modal-autocompletar-formulario').on('hidden.bs.modal', function (e) {
		if($('#per_id').val() == '0'){
			$('#form-nuevo-usuario').trigger("reset");
		}
	});

	//resetear el formulario
	$('#btn-reestablecer-form').click(function(){
		$("#form-nuevo-propietario-legal :input:not(:button):not(input[type='hidden'])").attr('readonly', false);
	});		
	//autocompletar el formulario de PERSONA en caso que exista su registro en bd
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
		$("#form-nuevo-propietario-legal :input:not(:button):not(input[type='hidden'])").attr('readonly', 'readonly');
		$('#cli_foto').focusin();
		console.log('enfocado');
	});		


	/*
	* --------------------------------------------------------------------
	*	SUBIR FOTOGRAFIA
	* --------------------------------------------------------------------
	*/
	$(document).on("click", ".browse", function() {
		var file = $(this).parents().find(".file");
		file.trigger("click");
	});
	//Evento Change para input de fotografía
	$('#cli_foto').change(function(e) {
		var fileName = e.target.files[0].name;
		$("#file").val(fileName);
		var reader = new FileReader();
		reader.onload = function(e) {
			// get loaded data and render thumbnail.
			document.getElementById("preview").src = e.target.result;
		};
		// read the image file as a data URL.
		reader.readAsDataURL(this.files[0]);
	});	


});	


	</script>


    @endsection