@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
		<h3 class="title-header" style="text-transform: uppercase;">
			<i class="fa fa-print"></i>
			{{$titulo}}
			<a href="{{url('reservas')}}" title="Volver a lista de reservas" data-placement="top" class="btn btn-sm btn-secondary float-right" style="margin-left:10px;"><i class="fa fa-angle-double-left"></i> ATRÁS</a>
			<a href="#" onClick="window.print()" class="btn btn-sm btn-success float-right" style="margin-left:10px;"><i class="fa fa-print"></i> IMPRIMIR RECIBO</a>
		</h3>

		<div class="row">
			<div class="col-md-12">
				<!-- inicio card  -->
				<div class="card">
					<div class="row no-gutters">
						<div class="col-md-12">
							<div class="card-body card-bordered">

								<table class="table table-bordered table-recibo table-recibo-print">
									<tr class="d-flex">
										<td class="col-md-4 text-center">
											<img src="{{asset('img/inloader.png')}}" style="width:100px;">
										</td>
										<td class="text-center col-md-4">
											<h1 classs="text-primary text-bold">RECIBO</h1>
											<small style="text-secondary">ORIGINAL</small>
										</td>
										<td class="text-center col-md-4">
											<h3 class="text-primary">
											N°
											@if(intval($reserva->res_nro_recibo) < 10 ) 
											000{{$reserva->res_nro_recibo}}
											@elseif (intval($reserva->res_nro_recibo) < 100)
											00{{$reserva->res_nro_recibo}}
											@elseif (intval($reserva->res_nro_recibo) < 100)
											0{{$reserva->res_nro_recibo}}
											@elseif (intval($reserva->res_nro_recibo) < 100)
											{{$reserva->res_nro_recibo}}
											@endif
											</h3>
											<span><span class="text-primary">Fecha:</span> {{$reserva->res_fecha_recibo}}</span>											
										</td>
									</tr>
									<tr>
										<td colspan="3"><b class="text-bold">Recibido del Sr./Sra.:</b>  {{$reserva->persona->per_nombres}} {{$reserva->persona->per_primer_apellido}} {{$reserva->persona->per_segundo_apellido}}</td>
									</tr>
									<tr>
										<td colspan="3">
											<span class="text-bold">El monto de:</span> 
											@if($reserva->res_moneda == 0)
											Bs 
											@else
											USD 
											@endif
											{{$reserva->res_monto}}
											({{$cad_monto}}
											00/100 .-) 
										</td>
									</tr>
									<tr>
										<td colspan="3">
											<span class="text-bold">Por concepto de:</span> {{$reserva->res_concepto_recibo}}
											<small>
												<br>
												<span class="text-primary">Modalidad de pago de la propiedad:</span> {{$reserva->res_modalidad}}
												<br>
												<span class="text-primary">La reserva expira en fecha: </span>{{$reserva->res_fecha_expiracion}}
												<br>
												<span class="text-primary">Observacion/detalle: </span>{{$reserva->res_observacion_pago}}
											</small>
										</td>
									</tr>
									<tr>
										<td colspan="3" class="text-center">
											<table class="table table-borderless table-sm">
												<tr>
													<td>
														<br><br>
														----------------------------------------- 
														<br>
														{{$reserva->persona->per_nombres}} {{$reserva->persona->per_primer_apellido}} {{$reserva->persona->per_segundo_apellido}}														<br>
														<small>Entregue conforme</small>		
													</td>
													<td>
														<br><br>
														----------------------------------------- 
														<br>
														{{Auth::user()->persona->per_nombres}} {{Auth::user()->persona->per_primer_apellido}} {{Auth::user()->persona->per_segundo_apellido}}
														<br>
														<small>Recibi conforme</small>		
													</td>
												</tr>
											</table>	
										</td>
									</tr>
									<tr>
										<td class="text-center pie_recibo pie_recibo_print"> 
											<small>{{config('casapropia.PIE_RECIBOS')}}</small>
										</td>
									</tr>
								</table>
								
							</div>
						</div>
					</div>
					<hr>
					<div class="row no-gutters">
						<div class="col-md-12">
							<div class="card-body card-bordered">

								<table class="table table-bordered table-recibo table-recibo-print">
									<tr class="d-flex">
										<td class="col-md-4 text-center">
											<img src="{{asset('img/inloader.png')}}" style="width:100px;">
										</td>
										<td class="text-center col-md-4">
											<h1 classs="text-primary text-bold">RECIBO</h1>
											<small style="text-secondary">COPIA CLIENTE</small>
										</td>
										<td class="text-center col-md-4">
											<h3 class="text-primary">
											N°
											@if(intval($reserva->res_nro_recibo) < 10 ) 
											000{{$reserva->res_nro_recibo}}
											@elseif (intval($reserva->res_nro_recibo) < 100)
											00{{$reserva->res_nro_recibo}}
											@elseif (intval($reserva->res_nro_recibo) < 100)
											0{{$reserva->res_nro_recibo}}
											@elseif (intval($reserva->res_nro_recibo) < 100)
											{{$reserva->res_nro_recibo}}
											@endif
											</h3>
											<span><span class="text-primary">Fecha:</span> {{$reserva->res_fecha_recibo}}</span>											
										</td>
									</tr>
									<tr>
										<td colspan="3"><b class="text-bold">Recibido del Sr./Sra.:</b>  {{$reserva->persona->per_nombres}} {{$reserva->persona->per_primer_apellido}} {{$reserva->persona->per_segundo_apellido}}</td>
									</tr>
									<tr>
										<td colspan="3">
											<span class="text-bold">El monto de:</span> 
											@if($reserva->res_moneda == 0)
											Bs 
											@else
											USD 
											@endif
											{{$reserva->res_monto}}
											({{$cad_monto}}
											00/100 .-) 
										</td>
									</tr>
									<tr>
										<td colspan="3">
											<span class="text-bold">Por concepto de:</span> {{$reserva->res_concepto_recibo}}
											<small>
												<br>
												<span class="text-primary">Modalidad de pago de la propiedad:</span> {{$reserva->res_modalidad}}
												<br>
												<span class="text-primary">La reserva expira en fecha: </span>{{$reserva->res_fecha_expiracion}}
												<br>
												<span class="text-primary">Observacion/detalle: </span>{{$reserva->res_observacion_pago}}
											</small>
										</td>
									</tr>
									<tr>
										<td colspan="3" class="text-center">
											<table class="table table-borderless table-sm">
												<tr>
													<td>
														<br><br>
														----------------------------------------- 
														<br>
														{{$reserva->persona->per_nombres}} {{$reserva->persona->per_primer_apellido}} {{$reserva->persona->per_segundo_apellido}}														<br>
														<small>Entregue conforme</small>		
													</td>
													<td>
														<br><br>
														----------------------------------------- 
														<br>
														{{Auth::user()->persona->per_nombres}} {{Auth::user()->persona->per_primer_apellido}} {{Auth::user()->persona->per_segundo_apellido}}
														<br>
														<small>Recibi conforme</small>		
													</td>
												</tr>
											</table>	
										</td>
									</tr>
									<tr>
										<td class="text-center pie_recibo pie_recibo_print"> 
											<small>{{config('casapropia.PIE_RECIBOS')}}</small>
										</td>
									</tr>
								</table>
								
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