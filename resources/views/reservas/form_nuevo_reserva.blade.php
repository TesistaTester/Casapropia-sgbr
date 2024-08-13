@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
		<h3 class="title-header" style="text-transform: uppercase;">
			<i class="fa fa-plus"></i>
			{{$titulo}}
			<a href="{{url('reservas')}}" title="Volver a lista de reservas" data-placement="top" class="btn btn-sm btn-secondary float-right" style="margin-left:10px;"><i class="fa fa-angle-double-left"></i> ATRÁS</a>
		</h3>

		<div class="row">
			<div class="col-md-12">
				<!-- inicio card  -->
				<div class="card">
					<div class="row no-gutters">
						<div class="col-md-12">
							<div class="card-body">
								<form id="form-nuevo-reserva" action="{{url('reservas')}}" data-validation1="{{url('clientes/valida_persona')}}" method="POST">
								  @csrf
							  
								  <section id="seccion-datos-generales">
									<h4 class="card-title"><strong><span class="text-primary">
										<i class="fa fa-home"></i>
										Datos de la propiedad
									</span></strong></h4>
									<hr>
										<small>Los campos marcados con asterisco (<span class="text-danger">*</span>) son obligatorios.</small>
									<div class="row">
										<div class="col-md-12">
											<div class="row">
												<div class="col-md-3">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															Urbanización:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Seleccione la urbanización a la que pertenece la propiedad"></i>
														</label>
														<select required name="urb_id" id="urb_id" class="form-control @error('urb_id') is-invalid @enderror" data-get-manzanos-json="{{url('urbanizaciones/get_man_by_urb_json')}}">
															<option value="">Seleccione una opción</option>
															@foreach($urbanizaciones as $item)
															<option value="{{$item->urb_id}}" {{ old('urb_id') == $item->urb_id ? 'selected' : '' }}>{{$item->urb_nombre}}</option>
															@endforeach
														</select>
														@error('urb_id')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															Manzano:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Seleccione el manzano al que pertenece la propiedad"></i>
														</label>
														<select required name="man_id" id="man_id" class="form-control @error('man_id') is-invalid @enderror" data-get-lotes-json="{{url('manzanos/get_lot_by_man_json')}}">
															<option value="">Seleccione una opción</option>
														</select>
														@error('man_id')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															Lote:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Seleccione el lote que desea reservar"></i>
														</label>
														<select required name="lot_id" id="lot_id" class="form-control @error('lot_id') is-invalid @enderror">
															<option value="">Seleccione una opción</option>
														</select>
														@error('lot_id')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															Modalidad de venta:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Modalidad de venta de la propiedad"></i>
														</label>
														<input type="text" class="form-control" id="res_modalidad" name="res_modalidad" readonly>
														@error('res_modalidad')
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

								  <section id="seccion-datos-personales">
									<h4 class="card-title"><strong><span class="text-primary">
										<i class="fa fa-tag"></i>
										Datos para el recibo
									</span></strong></h4>
									<hr>
									<div class="row">
										<div class="col-md-12">
											<div class="row">
												<div class="col-md-3">
													<div class="form-group">
															<label class="label-blue label-block" for="">
																Nro de documento:
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
												<div class="col-md-3">
													<div class="form-group">
															<label class="label-blue label-block" for="">
																Nombres:
																<span class="text-danger">*</span>
																<i class="fa fa-question-circle float-right" title="Establecer los nombres de la persona"></i>
															</label>
														<input required type="text" value="{{old('per_nombres')}}" class="form-control @error('per_nombres') is-invalid @enderror" name="per_nombres" id="per_nombres" placeholder="Nombres">
														@error('per_nombres')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-3">
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
												<div class="col-md-3">
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
									</div>

									<div class="row">
										<div class="col-md-12">
											<div class="row">
												<div class="col-md-2">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															Nro recibo:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Número de recibo (autogenerado)"></i>
														</label>													
														<input required type="text" value="{{$nro_recibo}}" id="res_nro_recibo" name="res_nro_recibo" class="form-control" readonly>
														@error('res_nro_recibo')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-2">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															Monto:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer el monto de la reserva"></i>
														</label>
														<input required type="number" step=".1" name="res_monto" id="res_monto" class="form-control @error('res_monto') is-invalid @enderror">
														@error('res_monto')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-2">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															Moneda:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer la moneda de pago"></i>
														</label>
														<select required name="res_moneda" id="res_moneda" class="form-control @error('res_moneda') is-invalid @enderror">
															<option value="0" {{ old('res_moneda') == '0' ? 'selected' : '' }}>Bolivianos</option>
															<option value="1" {{ old('res_moneda') == '1' ? 'selected' : '' }}>Dólares</option>
														</select>
														@error('res_moneda')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															Concepto del recibo:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer el concepto del recibo"></i>
														</label>
														<input required type="text" value="Reserva de lote" class="form-control" id="res_concepto_recibo" name="res_concepto_recibo">
														@error('res_concepto_recibo')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>

											</div>
											<div class="row">
												<div class="col-md-2">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															Efectivo/Otro:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer el tipo de documento de la persona"></i>
														</label>
														<select required name="res_efectivo" id="res_efectivo" class="form-control @error('res_efectivo') is-invalid @enderror">
															<option value="0" {{ old('res_efectivo') == '0' ? 'selected' : '' }}>Efectivo</option>
															<option value="1" {{ old('res_efectivo') == '0' ? 'selected' : '' }}>Transaccion Bancaria</option>
														</select>
														@error('res_efectivo')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-2">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															Fecha recibo:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer el tipo de documento de la persona"></i>
														</label>
														<input required type="date" value="{{date('Y-m-d')}}" class="form-control" id="res_fecha_recibo" name="res_fecha_recibo">
														@error('res_fecha_recibo')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-8">
													<div class="form-group">
														<label class="label-blue label-block" for="">
															Observación:
															<i class="fa fa-question-circle float-right" title="Establecer alguna observacion al recibo de reserva"></i>
														</label>
														<input required type="text" class="form-control" id="res_observacion" name="res_observacion">
														@error('res_observacion')
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


  {{-- INICIO MODAL: EXISTE PROPIETARIO / AUTOCOMPLETAR FORMULARIO --}}
  <div class="modal fade" id="modal-autocompletar-formulario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-info-circle"></i>
              Validación datos de cliente
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
            <div class="alert alert-danger" id="alert-cliente-existe">
                <div class="media">
                    <img src="{{asset('img/alert-danger.png')}}" class="align-self-center mr-3" alt="...">
                    <div class="media-body">
                        <h5 class="mt-0">Cuidado.-</h5>
                        <p>
                            El número de documento ingresado ya pertenece a un cliente registrado.<br> <b>El formulario fue vaciado. Revise los clientes registrados o intente nuevamente.</b>
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
							<b>Para registrarlo como cliente solo debe AUTOCOMPLETAR el formulario y continuar con la Fotografía en el formulario.
                        </p>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" id="btn-entendido" class="btn btn-secondary" data-dismiss="modal">Entendido</button>
          <button type="button" id="btn-autocompletar" class="btn btn-primary" data-dismiss="modal">
			<i class="fa fa-edit"></i>
			Autocompletar datos
		  </button>
        </div>
      </div>
    </div>
  </div>
  {{-- FIN MODAL: EXISTE PROPIETARIO / AUTOCOMPLETAR FORMULARIO --}}

	

<script>
$(function(){
	//select2 buscador
	$('.search-municipio, .search-actividad-economica').select2({language:"es"});
	/*
	* Verificación de duplicados de persona en bd
	* Evento: focusout
	*/
	var registro_persona = null;
	$('#per_nro_id').focusout(function(e){
				e.preventDefault();
				var rsm = $('#form-nuevo-reserva').attr('data-validation1');
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
							$('#alert-persona-existe').hide();
							$('#alert-cliente-existe').hide();
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
							// if(data.status == 3){
							// 	//Mostrar modal error existe propietario y vaciar formulario
							// 	console.log(data);
							// 	let cliente = data.cliente[0];
							// 	$('#txt-nro-documento').html(cliente.per_nro_id+' '+cliente.per_expedido);
							// 	$('#txt-nombre-completo').html(cliente.per_nombres+' '+cliente.per_primer_apellido+' '+cliente.per_segundo_apellido);
							// 	$('#alert-cliente-existe').show();
							// 	$('#btn-no-autocompletar').show();
							// 	$('#btn-autocompletar').show();
							// 	$('#modal-autocompletar-formulario').modal('show')
							// 	$('#form-nuevo-reserva').trigger("reset");
							// }
						},
						error: function(data){
							console.log(data);
							$('.request-loader').hide();
							console.log("Error de servidor");
						}
				});
			});


	/*
	* Get Manzanas de la urbanización
	* Evento: change
	*/
	$('#urb_id').change(function(e){
		e.preventDefault();
		$.ajax({
			type: "POST",
			url: $(this).attr('data-get-manzanos-json'),
			data: {
				urb_id: $(this).val(),
				'_token': $("input[name='_token']").val()},
     			    dataType: 'json',
			success: function(data){
				$('#man_id').html('');
				$('#man_id').append('<option value="">Seleccione una opción</option>');
				//rellenando el select
				$(data.manzanos).each(function(){
					let select_item = '<option value="'+this.man_id+'">'+this.man_nombre.toUpperCase()+'</option>';
					$('#man_id').append(select_item);
				});
			},
			error: function(data){
				console.log("Error de servidor");
			}
		});
	});

	$('body').on('change','#man_id',function(e){
		e.preventDefault();
		$.ajax({
			type: "POST",
			url: $(this).attr('data-get-lotes-json'),
			data: {
				man_id: $(this).val(),
				'_token': $("input[name='_token']").val()},
     			dataType: 'json',
			success: function(data){
				$('#lot_id').html('');
				$('#lot_id').append('<option value="">Seleccione una opción</option>');
				//rellenando el select
				$(data.lotes).each(function(){
					let select_item = '<option data-modalidad="'+this.mov_tipo_venta+'" value="'+this.lot_id+'">'+this.lot_nro+'</option>';
					$('#lot_id').append(select_item);
				});
			},
			error: function(data){
				console.log("Error de servidor");
			}
		});
	});

	$('body').on('change','#lot_id',function(e){
		e.preventDefault();
		$modalidad_selected = $(this).find(":selected").attr('data-modalidad');

		$modalidad_selected == 0 ? $('#res_modalidad').val('AL CONTADO') : "";
		$modalidad_selected == 1 ? $('#res_modalidad').val('A PAGOS') : "";
		$modalidad_selected == 2 ? $('#res_modalidad').val('A CREDITO') : "";

		let res_concepto = $('#res_concepto_recibo').val();
		let res_urb = $('#urb_id option:selected').text();
		let res_man = $('#man_id option:selected').text();
		let res_lot = $('#lot_id option:selected').text();
		res_concepto = res_concepto+" "+res_lot+" de la urbanizacion "+res_urb+" manzano "+res_man;
		$('#res_concepto_recibo').val(res_concepto);
	});


	// $('#btn-no-autocompletar').click(function(){
	// 	$('#form-nuevo-propietario-legal').trigger("reset");
	// });
	$('#modal-autocompletar-formulario').on('hidden.bs.modal', function (e) {
		if($('#per_id').val() == '0'){
			$('#form-nuevo-cliente').trigger("reset");
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
		// $('#per_fecha_nacimiento').val(registro_persona.per_fecha_nacimiento);
		// $('#per_sexo').val(registro_persona.per_sexo).change();
		// $('#per_estado_civil').val(registro_persona.per_estado_civil).change();
		$('#per_id').val(registro_persona.per_id);
		// $("#form-nuevo-propietario-legal :input:not(:button):not(input[type='hidden'])").attr('readonly', 'readonly');
		$('#res_monto').focus();
		console.log('enfocado');
	});		

	/*
	-------------------------------------------------------------------------------------------------------------------------
	EVENTOS DEL FORMULARIO EN CASO DE SER NOMBRE COMERCIAL Y REPRESENTANTE LEGAL
	-------------------------------------------------------------------------------------------------------------------------
	*/
	// $('#seccion-nombre-comercial').hide();
	// $('#per_tipo_persona').change(function(e){
	// 	if($(this).val() == '0'){
	// 		$('#seccion-nombre-comercial').slideUp();
	// 		$('#txt-representante-empresa').html('del cliente');
	// 		$('#txt-domicilio-empresa').fadeOut();
	// 		$('#per_nombre_comercial').val('ninguno');
	// 	}
	// 	if($(this).val() == '1'){
	// 		$('#seccion-nombre-comercial').slideDown();
	// 		$('#txt-representante-empresa').html('del representante legal');
	// 		$('#txt-representante-empresa').fadeIn();
	// 		$('#txt-domicilio-empresa').html('de la empresa');
	// 		$('#txt-domicilio-empresa').fadeIn();
	// 		$('#per_nombre_comercial').val('');
	// 	}
	// });





});	




	</script>


    @endsection