@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
		<h3 class="title-header" style="text-transform: uppercase;">
			<i class="fa fa-file-text"></i>
			{{$titulo}}
			<a href="{{url('contratos')}}" title="Volver a lista de contratos" data-placement="top" class="btn btn-sm btn-secondary float-right" style="margin-left:10px;"><i class="fa fa-angle-double-left"></i> ATRÁS</a>
		</h3>

		<div class="row">
			<div class="col-md-12">
				<!-- inicio card  -->
				<div class="card">
					<div class="row no-gutters">
						<div class="col-md-12">
							<div class="card-body">
								<div class="row">
									<div class="col-md-10">
										<form id="form-nuevo-cliente" action="{{url('contratos')}}" method="POST">
										@csrf
										<textarea id="editorhtml" style="height: 500px">	
											<div>
												<p style="text-align: center"><strong>DOCUMENTO PRIVADO DE COMPRAVENTA DE LOTE DE TERRENO</strong></p>									
												<p>
													Conste por el presente documento privado que en el caso necesario podrá ser elevado a la categoria de instrumento publico con solo el reconocimiento de firmas y rubricas suscrito entre las personas que se mencionará mas adelante de conformidad a las siguientes clausulas:					
												</p>																
												<p><strong>PRIMERA.-</strong> Yo <span id="doc-propietario">{{$contrato->legales[0]->propietario_legal->persona->per_nombres}} {{$contrato->legales[0]->propietario_legal->persona->per_primer_apellido}} {{$contrato->legales[0]->propietario_legal->persona->per_segundo_apellido}}</span>, mayor de edad, habil por derecho declaro ser propietaria de un lote de terreno de una extension superficial de <span id="doc-superficie-terreno">{{$contrato->propiedad->pro_superficie}}</span> mts2 (<span id="doc-superficie-terreno-literal" style="text-transform: uppercase">{{$superficie_literal}}</span> 00/100), ubicado en la Urbanización <span id="doc-urbanizacion">{{$contrato->propiedad->lote->manzano->urbanizacion->urb_nombre}}</span>, lote signado con el Nro <span id="doc-numero-lote">{{$contrato->propiedad->lote->lot_nro}}</span> del Manzano
												<span id="doc-manzano">{{$contrato->propiedad->lote->manzano->man_nombre}}</span>, el mismo registrado en Derechos Reales con Matricula Nro. {{$contrato->propiedad->lote->lot_matricula}}.
												</p>												
												<p>
												<strong>SEGUNDO.- </strong>A la fecha, por asi convenir asi a mis intereses, hago formal promesa de venta de un lote de terreno mencionado en la clausula primera en favor del señor(a)  {{$contrato->clientes[0]->cliente->persona->per_nombres}} {{$contrato->clientes[0]->cliente->persona->per_primer_apellido}} {{$contrato->clientes[0]->cliente->persona->per_segundo_apellido}}, 
												mayor de edad y habil por derecho, por el precio libremente convenido entre ambas partes de 
												@if ($contrato->con_moneda == 0)
													Bs.-
												@else
													$US.-
												@endif
												<span style="text-transform: uppercase">
													{{$contrato->con_precio_total}} ({{$monto_total_literal}}
												</span>
												 00/100 
												{{-- @if ($contrato->con_moneda == 0)
													BOLIVIANOS
												@else
													DOLARES AMERICANOS
												@endif --}}
												
												), de acuerdo a las siguientes condiciones.
												</p>												
												<p>
												<strong>a)</strong> A tiempo de susribir el presente documento privado, los compradores hacen la entrega total como anticipo del precio del lote de terreno, la suma de 
												@if ($contrato->con_moneda == 0)
													Bs.-
												@else
													$US.-
												@endif
												{{$contrato->con_pago_inicial}} 
												(
												<span style="text-transform: uppercase">
													{{$pago_inicial_literal}}													
												</span>
												00/100
												{{-- @if ($contrato->con_moneda == 0)
													BOLIVIANOS
												@else
													DOLARES AMERICANOS
												@endif --}}
												), 
												valor que declaro recibir a tiempo de suscribir el presente documento.
												</p>
												<p>
												<strong>b)</strong> El saldo de $US.- 3750 será abonado a mi favor en {{$contrato->con_plazo}} cuotas mensuales de 104 y/o su equivalente en bolivianos a la fecha de pago, el saldo total debe ser cancelado hasta el 29 de abril de 2024, 
												en caso de incumplimiento a esta clausula y la falta de pago de la cuota en la fecha señalada, el comprador se constituira en mora por el solo vencimiento del termino sin requerimiento de notificacion
												alguna.
												</p>
												<p>
												<strong>TERCERO.-</strong> Asi mismo, se conviene entre partes, que al incumplimiento del pago en la fecha señalada y constituirse en mora, se aplicará un incremento del 5% con relacion a la suma total 
												de la cuota adeudadda, por concepto de resarcimiento de daños y prejuicios, conforme a lo previsto por el Art. 532 del Código civil.
												</p>
												<p>
												<strong>CUARTO.-</strong> En el caso de que se incumpla con el pago de cuatro (4) cuotas de forma consecutiva, se recuelve el presente contrato por incumplimiento imputable a los compradores, al amparo del
												Art. 569 del Código Civil. Sin embargo, existe la faculta de novacion conforme disponga la vendedora, asimismo se conviene entre paretes que no se hará la devolucion del monto aportad hasta....
												</p>
												<p>
												<strong>QUINTO.-</strong> 
												</p>
												<p>
												<strong>SEXTO.-</strong> Los compradores a partir de la fecha podrá entrar en posesion del lote de terreno y realizar cualquier construccion o mejor que crean conveniente.
												</p>				
												<p>
												<strong>SEPTIMO.-</strong> Si por cualquier motivo el presente DOCUMENTO PRIVADO no llegara a alcanzar la categoria de instrumento publico, a solo reconocimiento de firmas y rubricas, el mismo tomará
												la caracteristica de Documento Privado reconocido de conformidad al Ar. 1297 del Código Civil.
												</p>
												
												<p>
												<strong>OCTAVO.-</strong> Nosotros, los suscritos contratistas declaramos nuestra conformidad con todas y cada una de las clausulas precedentes y nos sometemos a su fiel y estricto cumplimiento.
												</p>
												
												<p style="text-align: center">
												En Alto, X de Y de Z
												</p>
													<table id="table-firmas" align="center" style="text-align: center">
														<tr>
															<td></td>
															<td></td>
														</tr>
														<tr>
															<td style="padding:10px 50px">
																<small>
																	NOMBRE PROPIETARIO
																	<br>
																	6855478LP
																	<br>
																	<strong>VENDEDOR(A)</strong>
																</small>
															</td>
															<td style="padding:10px 50px">
																<small>
																	NOMBRE COMPRADOR
																	<br>
																	6855478LP
																	<br>
																	<strong>COMPRADOR(A)</strong>									
																</small>
															</td>
														</tr>
													</table>
												</div>
										</textarea>
															
										<hr>
										<section>
												<div class="row">
													<div class="col-md-4">
														<button type="submit" class="btn btn-primary" id="btn-enviar">
															<i class="fa fa-save"></i>
															Guardar datos
														</button>
													</div>
												</div>	
										</section>

									</form>

									</div>
									<div class="col-md-2">
										<div class="alert alert-info text-center">
											<small><strong>DATOS ADICIONALES DE LA PROPIEDAD</strong></small>
											<hr>
											<div class="alert alert-light alert-documento">
												<small class="text-success">MATRICULA</small>
												<p>{{$contrato->propiedad->lote->lot_matricula}}</p>
											</div>
											<div class="alert alert-light alert-documento">
												<small class="text-success">ANCHO DE VIA</small>
												<p>{{$contrato->propiedad->lote->lot_ancho_via}} [m]</p>
											</div>
											<div class="alert alert-light alert-documento">
												<small class="text-success">MURO PERIMETRAL</small>
												<p>{{$contrato->propiedad->pro_muro_perimetral}} [m]</p>
											</div>
											<div class="alert alert-light alert-documento">
												<small class="text-success">SUPERFICIE</small>
												<p>{{$contrato->propiedad->pro_superficie}} [m<sup>2</sup>]</p>
											</div>
											<div class="alert alert-light alert-documento">
												<small class="text-success">SUPERFICIE CONSTRUIDA</small>
												<p>{{$contrato->propiedad->lote->lot_superficie_construida}} [m<sup>2</sup>]</p>
											</div>
											<div class="alert alert-light alert-documento">
												<small class="text-success">BASE IMPONIBLE</small>
												<p>
													@if($contrato->propiedad->pro_base_imponible == null)
														[NO REGISTRADO]
													@else
													{{$contrato->propiedad->pro_base_imponible}}
													@endif
												</p>
											</div>
											<div class="alert alert-light alert-documento">
												<small class="text-success">NRO. INMUEBLE</small>
												<p>
													@if($contrato->propiedad->pro_nro_inmueble == null)
													[NO REGISTRADO]
													@else 
													{{$contrato->propiedad->pro_nro_inmueble}}
													@endif
												</p>
											</div>
										</div>												
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

<script>
$(function(){
	$('#btn-edita-plan-pagos').hide();
	//select2 buscador
	$('.search-items').select2({language:"es"});

	$('body').on("click", "#btn-genera-plan-pagos",function(e){
		$('#btn-edita-plan-pagos').hide();

		var data_plan = [];//vaciamos data_plan
		var x = null;
		$('#tabla-plan-pagos').html('');//vaciamos el html 
		var fecha = new Date();
		var iterador_meses = 0;
		
		// INICIO --- INPUTS
		let monto = $('#con_precio_total').val();//input -- precio total
		let tipo_venta = $('#con_tipo_venta').val();//input -- modalidad venta
		let interes_anual = $('#con_interes').val();//input -- 
		let n = $('#con_plazo').val();//plazo input
		let cuota_inicial = $('#con_pago_inicial').val();//input
		let tasa_cambio = $('#con_tasa_cambio').val();//input
		// fin -- INPUTS

		//MODAL TEXTS
		$('#txt_monto').html($('#con_precio_total').val());
		$('#txt_moneda').html($('#con_moneda :selected').text());
		$('#txt_modalidad').html($('#con_tipo_venta :selected').text());
		$('#txt_meses').html($('#con_plazo').val());
		$('#txt_cuota_inicial').html($('#con_pago_inicial').val());
		$('#txt_interes').html($('#con_interes').val());

		let saldo = monto;

		console.log("GENERANDO PLANDE PAGOS");
		// al contado
		if(tipo_venta == 0){
			console.log("CONTADO");
			saldo = monto - cuota_inicial;
			const nuevoMes = fecha.getMonth() + iterador_meses;
			fecha.setMonth(nuevoMes);
			var dia = fecha.getDate(); // Día del mes
			var mes = fecha.getMonth() + 1; // Mes (enero es 0, por eso se suma 1)
			var anio = fecha.getFullYear(); // Año
			var fecha_actual = dia+"-"+mes+"-"+anio;
			var monto_cambio = Math.round((cuota_inicial*tasa_cambio)*100)/100;

			$('#tabla-plan-pagos').append('<tr><td>1</td><td>'+fecha_actual+'</td><td>'+cuota_inicial+'</td><td>'+(monto_cambio)+'</td><td>0</td><td>0</td><td>'+saldo+'</td><td>PAGO AL CONTADO</td></tr>');
			x = {'nro':1, 'fecha':fecha_actual, 'monto':cuota_inicial,'monto_cambio':monto_cambio, 'interes_mensual':0, 'amortizacion':0, 'saldo':saldo, 'observacion':'PAGO AL CONTADO'};
			data_plan.push(x);
			// console.log("Mes: 0 Monto: "+monto+" Cuota inicial: "+cuota_inicial+" Saldo:"+saldo);
			console.log(data_plan);
			$('#campo_plan_pagos').val(JSON.stringify(data_plan));
		}
		// a pagos
		if(tipo_venta == 1){
			console.log("PAGOS");
			$('#btn-edita-plan-pagos').show();
			const nuevoMes = fecha.getMonth() + iterador_meses;
			fecha.setMonth(nuevoMes);
			var dia = fecha.getDate(); // Día del mes
			var mes = fecha.getMonth() + 1; // Mes (enero es 0, por eso se suma 1)
			var anio = fecha.getFullYear(); // Año
			if(mes < 10){
				mes = "0" + mes;
			}
			var fecha_actual = anio+"-"+mes+"-"+dia;
			saldo = monto - cuota_inicial;
			iterador_meses++;
			var monto_cambio = Math.round((cuota_inicial*tasa_cambio)*100)/100;

			$('#tabla-plan-pagos').append('<tr><td>0</td><td><input class="form-control" type="date" value="'+fecha_actual+'"></td><td><input class="form-control" type="number" value="'+cuota_inicial+'"></td><td><input class="form-control" type="number" value="'+monto_cambio+'"></td><td>0</td><td>0</td><td><input class="form-control" type="number" value="'+saldo+'"></td><td>CUOTA INICIAL</td></tr>');
			x = {'nro':0, 'fecha':fecha_actual, 'monto':cuota_inicial,'monto_cambio':monto_cambio, 'interes_mensual':0, 'amortizacion':0, 'saldo':saldo, 'observacion':'CUOTA INICIAL'};
			data_plan.push(x);

			console.log("Mes: 0 Monto: "+monto+" Cuota inicial: "+cuota_inicial+" Saldo:"+saldo);
			monto = saldo;

			//monto de pago mensual
			M = monto/n;
			let i = 1;
			while(i <= n){
				//monto de pago redondeado
				monto_pago = (Math.round(M*100)/100);			
				//saldo redondeado
				saldo = Math.round((saldo - monto_pago)*100)/100;
				if(saldo > -1 && saldo < 1){
					saldo = 0;
				}
				const nuevoMes = fecha.getMonth() + iterador_meses;
				fecha.setMonth(nuevoMes);

				var dia = fecha.getDate(); // Día del mes
				var mes = fecha.getMonth() + 1; // Mes (enero es 0, por eso se suma 1)
				var anio = fecha.getFullYear(); // Año
				if(mes < 10){
					mes = "0" + mes;
				}
				var fecha_actual = anio+"-"+mes+"-"+dia;
				monto_cambio = Math.round((monto_pago*tasa_cambio)*100)/100;

				$('#tabla-plan-pagos').append('<tr><td>'+i+'</td><td><input class="form-control" type="date" value="'+fecha_actual+'"></td><td><input class="form-control" type="number" value="'+monto_pago+'"></td><td><input class="form-control" type="number" value="'+monto_cambio+'"></td><td>0</td><td>0</td><td><input class="form-control" type="number" value="'+saldo+'"></td><td></td></tr>');
				x = {'nro':i, 'fecha':fecha_actual, 'monto':monto_pago,'monto_cambio':monto_cambio, 'interes_mensual':0, 'amortizacion':0, 'saldo':saldo, 'observacion':''};
				data_plan.push(x);
				console.log("Mes: "+i+" Monto: "+monto_pago+" SALDO: "+saldo);

				i++;
			}
			console.log(data_plan);
			$('#campo_plan_pagos').val(JSON.stringify(data_plan));

		}
		// a credito
		if(tipo_venta == 2 && interes_anual > 0){
			console.log("CREDITO");
			const nuevoMes = fecha.getMonth() + iterador_meses;
			fecha.setMonth(nuevoMes);
			var dia = fecha.getDate(); // Día del mes
			var mes = fecha.getMonth() + 1; // Mes (enero es 0, por eso se suma 1)
			var anio = fecha.getFullYear(); // Año
			var fecha_actual = dia+"-"+mes+"-"+anio;
			saldo = monto - cuota_inicial;
			iterador_meses++;
			var monto_cambio = Math.round((cuota_inicial*tasa_cambio)*100)/100;

			$('#tabla-plan-pagos').append('<tr><td>0</td><td>'+fecha_actual+'</td><td>'+cuota_inicial+'</td><td>'+(monto_cambio)+'</td><td>0</td><td>0</td><td>'+saldo+'</td><td>CUOTA INICIAL</td></tr>');
			x = {'nro':0, 'fecha':fecha_actual, 'monto':cuota_inicial,'monto_cambio':monto_cambio, 'interes_mensual':0, 'amortizacion':0, 'saldo':saldo, 'observacion':'CUOTA INICIAL'};
			data_plan.push(x);
			console.log("Mes: 0 Monto: "+monto+" Cuota inicial: "+cuota_inicial+" Saldo:"+saldo);
			monto = saldo;

			let r = interes_anual/12;//interes mensual
			let i = 1;
			while(i <= n){
				//monto de pago mensual
				M = (monto * r * (1 + r)**n) / ((1 + r)**n - 1)
				//interes mensual
				IM = Math.round(saldo*r*100)/100;
				//amortizacion
				AM = Math.round((M-IM)*100)/100;
				//monto de pago redondeado
				monto_pago = (Math.round(M*100)/100);			
				//saldo redondeado
				saldo = Math.round((saldo - AM)*100)/100;
				if(saldo > -1 && saldo < 1){
					saldo = 0;
				}
				const nuevoMes = fecha.getMonth() + iterador_meses;
				fecha.setMonth(nuevoMes);

				var dia = fecha.getDate(); // Día del mes
				var mes = fecha.getMonth() + 1; // Mes (enero es 0, por eso se suma 1)
				var anio = fecha.getFullYear(); // Año
				var fecha_actual = dia+"-"+mes+"-"+anio;
				monto_cambio = Math.round((monto_pago*tasa_cambio)*100)/100;

				$('#tabla-plan-pagos').append('<tr><td>'+i+'</td><td>'+fecha_actual+'</td><td>'+monto_pago+'</td><td>'+(monto_cambio)+'</td><td>'+IM+'</td><td>'+AM+'</td><td>'+saldo+'</td><td></td></tr>');
				x = {'nro':i, 'fecha':fecha_actual, 'monto':monto_pago,'monto_cambio':monto_cambio, 'interes_mensual':IM, 'amortizacion':AM, 'saldo':saldo, 'observacion':''};
				data_plan.push(x);
				console.log("Mes: "+i+" Monto: "+monto_pago+" I: "+IM+" A: "+AM+" SALDO: "+saldo);
				i++;
			}
			console.log(data_plan);
			$('#campo_plan_pagos').val(JSON.stringify(data_plan));
		}
		if(tipo_venta == 2 && interes_anual <= 0){
			$('#tabla-plan-pagos').append('<tr><td colspan="7"><div class="alert alert-warning">Para un plan a credito, el interes anual debe ser mayor a 0. Revise los datos de entrada e intente nuevamente.</div></td></tr>');
		}

	});


	/*
	* EDITA PLAN DE PAGOS
	*/
	$('body').on('click', '#btn-edita-plan-pagos', function(){
		let tds = $('#tabla-plan-pagos td');
		let td_text = $('#tabla-plan-pagos td');
		$.each(td_text, function( i, item ) {
			console.log(item);
		});
	});
	/*
	* Verificación de duplicados de persona en bd
	* Evento: focusout
	*/
	var registro_persona = null;
	$('#per_nro_id').focusout(function(e){
				e.preventDefault();
				var rsm = $('#form-nuevo-cliente').attr('data-validation1');
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
							$('#alert-cliente-existe').hide();
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
								let cliente = data.cliente[0];
								$('#txt-nro-documento').html(cliente.per_nro_id+' '+cliente.per_expedido);
								$('#txt-nombre-completo').html(cliente.per_nombres+' '+cliente.per_primer_apellido+' '+cliente.per_segundo_apellido);
								$('#alert-cliente-existe').show();
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


	/*
	* Verificación de duplicados de persona en bd
	* Evento: focusout
	*/
	$('#dep_id').change(function(e){
				e.preventDefault();
				var rsm = $(this).attr('data-municipio-change');
				var dep_id = $(this).val();
				rsm = rsm+'/'+dep_id+'/municipios';
				var csrfName = '_token'; // Value specified in $config['csrf_token_name']
				var csrfHash = $("input[name='_token']").val(); // CSRF hash
				$.ajax({
						type: "POST",
						url: rsm,
						data: {
							dep_id: dep_id,
							[csrfName]: csrfHash},
	       			    dataType: 'json',
						beforeSend: function(){
							$('.request-loader').show(20);
						},
						success: function(data){
							$('.request-loader').hide();
							$('#mun_id').html('');
							$('#mun_id').append('<option value="">Seleccione una opción</option>');
							//rellenando el select
							$(data.municipios).each(function(){
								let select_item = '<option value="'+this.mun_id+'">'+this.mun_nombre.toUpperCase()+'</option>';
								$('#mun_id').append(select_item);
							});
						},
						error: function(data){
							console.log(data);
							$('.request-loader').hide();
							console.log("Error de servidor");
						}
				});
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
		$('#per_fecha_nacimiento').val(registro_persona.per_fecha_nacimiento);
		$('#per_sexo').val(registro_persona.per_sexo).change();
		$('#per_estado_civil').val(registro_persona.per_estado_civil).change();
		$('#per_id').val(registro_persona.per_id);
		$("#form-nuevo-propietario-legal :input:not(:button):not(input[type='hidden'])").attr('readonly', 'readonly');
		$('#cli_foto').focusin();
		console.log('enfocado');
	});		

	/*
	-------------------------------------------------------------------------------------------------------------------------
	EVENTOS DEL FORMULARIO EN CASO DE SER NOMBRE COMERCIAL Y REPRESENTANTE LEGAL
	-------------------------------------------------------------------------------------------------------------------------
	*/
	$('#seccion-nombre-comercial').hide();
	$('#per_tipo_persona').change(function(e){
		if($(this).val() == '0'){
			$('#seccion-nombre-comercial').slideUp();
			$('#txt-representante-empresa').html('del cliente');
			$('#txt-domicilio-empresa').fadeOut();
			$('#per_nombre_comercial').val('ninguno');
		}
		if($(this).val() == '1'){
			$('#seccion-nombre-comercial').slideDown();
			$('#txt-representante-empresa').html('del representante legal');
			$('#txt-representante-empresa').fadeIn();
			$('#txt-domicilio-empresa').html('de la empresa');
			$('#txt-domicilio-empresa').fadeIn();
			$('#per_nombre_comercial').val('');
		}
	});


	/*
	* Slide formulario registro cliente
	*/
	// Ocultando secciones datos domicilio y contacto
	// $('#seccion-domicilio').hide();
	// $('#seccion-contacto').hide();
	// Enlaces hacia atrás de ambas secciones
	// $('#ant-personales').click(function(){
	// 	$('#seccion-domicilio').fadeOut();
	// 	$('#seccion-datos-personales').slideDown();
	// });
	// $('#ant-domicilio').click(function(){
	// 	$('#seccion-contacto').fadeOut();
	// 	$('#seccion-domicilio').slideDown();
	// });
	//Validacion de datos requeridos y slide de primera seccion Datos Generales -> Datos domicilio
	// $('#next-domicilio').click(function(e){
	// 	if(
	// 		$('#per_tipo_documento')[0].checkValidity() && 
	// 		$('#per_nro_id')[0].checkValidity() && 
	// 		$('#per_expedido')[0].checkValidity() && 
	// 		$('#per_nombres')[0].checkValidity() && 
	// 		$('#per_primer_apellido')[0].checkValidity() && 
	// 		$('#per_segundo_apellido')[0].checkValidity() && 
	// 		$('#per_fecha_nacimiento')[0].checkValidity() && 
	// 		$('#per_sexo')[0].checkValidity() && 
	// 		$('#per_estado_civil')[0].checkValidity() && 
	// 		$('#cli_foto')[0].checkValidity() && 
	// 		$('#cli_copia_ci')[0].checkValidity()
	// 		)
	// 	{
	// 		e.preventDefault();
	// 		$('#seccion-datos-personales').slideUp();
	// 		$('#seccion-domicilio').fadeIn();
	// 	}else{
	// 		e.preventDefault();
	// 		$('#per_tipo_documento')[0].reportValidity();
	// 		if($('#per_nro_id').val().length > 0){
	// 			$('#per_nro_id')[0].reportValidity();
	// 		}
	// 		$('#per_expedido')[0].reportValidity(); 
	// 		$('#per_nombres')[0].reportValidity(); 
	// 		$('#per_primer_apellido')[0].reportValidity(); 
	// 		$('#per_segundo_apellido')[0].reportValidity(); 
	// 		$('#per_fecha_nacimiento')[0].reportValidity(); 
	// 		$('#per_sexo')[0].reportValidity();
	// 		$('#per_estado_civil')[0].reportValidity(); 
	// 		$('#cli_foto')[0].reportValidity();
	// 		$('#cli_copia_ci')[0].reportValidity();
	// 		console.log("No pasa a domicilio");
	// 	}
	// });


	//Validacion de datos requeridos y slide de segunda seccion Datos domicilio -> Datos contacto
	// $('#next-contacto').click(function(e){
	// 	if(
	// 		$('#dom_tipo')[0].checkValidity() && 
	// 		$('#dep_id')[0].checkValidity() && 
	// 		$('#mun_id')[0].checkValidity() && 
	// 		$('#dom_zona')[0].checkValidity() && 
	// 		$('#dom_calle_avenida')[0].checkValidity() && 
	// 		$('#dom_nro')[0].checkValidity() && 
	// 		$('#ace_id')[0].checkValidity()
	// 		)
	// 	{
	// 		e.preventDefault();
	// 		$('#seccion-domicilio').slideUp();
	// 		$('#seccion-contacto').fadeIn();
	// 	}else{
	// 		e.preventDefault();
	// 		$('#dom_tipo')[0].reportValidity();
	// 		$('#dep_id')[0].reportValidity(); 
	// 		$('#mun_id')[0].reportValidity(); 
	// 		$('#dom_zona')[0].reportValidity(); 
	// 		$('#dom_calle_avenida')[0].reportValidity(); 
	// 		$('#dom_nro')[0].reportValidity(); 
	// 		$('#ace_id')[0].reportValidity();
	// 	}
	// });

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

	/*
	--------------------------------------------------------------------------------------
	MAPA DOMICILIO
	--------------------------------------------------------------------------------------
	*/
//	var mymap = L.map('mapa-domicilio').setView([-16.50357853577617,-68.16282717846254], 13);
	//AGREGAR MARCADOR
	// var marker = L.marker(new L.LatLng(-16.50357853577617,-68.16282717846254), {
	// 						draggable: true
	// 			}).addTo(mymap);
	// marker.bindPopup('Mover el marcador para<br>apuntar en la ubicación<br>georeferenciada del domicilio.').openPopup();
	// marker.on('dragend', function (e) {
	// 	document.getElementById('dom_latitud').value = marker.getLatLng().lat;
	// 	document.getElementById('dom_longitud').value = marker.getLatLng().lng;
	// });


	//CAPA BASE
	// var map_token = '{{config('casapropia.MAPBOX_ACCESS_TOKEN')}}';
	// L.tileLayer("https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token="+map_token, {
	// 			maxZoom: 20,
	// 			attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
	// 				'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
	// 				'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
	// 			id: 'mapbox/streets-v11',
	// 			tileSize: 512,
	// 			zoomOffset: -1
	// 		}).addTo(mymap);

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
				console.log(data.lotes);
				//rellenando el select
				$(data.lotes).each(function(){
					let select_item = '<option data-modalidad="'+this.mov_tipo_venta+'" data-moneda="'+this.mov_moneda_venta+'" data-pago-inicial="'+this.mov_cuota_inicial+'" data-plazo="'+this.mov_plazo+'" data-precio="'+this.mov_precio_oferta+'" data-interes="'+this.mov_tasa_interes+'" value="'+this.lot_id+'">'+this.lot_nro+'</option>';
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
		$moneda_selected = $(this).find(":selected").attr('data-moneda');
		$precio_selected = $(this).find(":selected").attr('data-precio');
		$interes_selected = $(this).find(":selected").attr('data-interes');
		$pago_inicial_selected = $(this).find(":selected").attr('data-pago-inicial');
		$plazo_selected = $(this).find(":selected").attr('data-plazo');

		$('#con_moneda').val($moneda_selected);
		$('#con_precio_total').val($precio_selected);
		$('#con_pago_inicial').val($pago_inicial_selected);
		$('#con_plazo').val($plazo_selected);
		$('#con_interes').val($interes_selected);

		$modalidad_selected == 0 ? $('#con_tipo_venta').val(0) : "";
		$modalidad_selected == 1 ? $('#con_tipo_venta').val(1) : "";
		$modalidad_selected == 2 ? $('#con_tipo_venta').val(2) : "";

		// let res_concepto = $('#res_concepto_recibo').val();
		// let res_urb = $('#urb_id option:selected').text();
		// let res_man = $('#man_id option:selected').text();
		// let res_lot = $('#lot_id option:selected').text();
//		res_concepto = res_concepto+" "+res_lot+" de la urbanizacion "+res_urb+" manzano "+res_man;
//		$('#res_concepto_recibo').val(res_concepto);
	});

	// $('#cli_id').change(function(e){
	// 	console.log($(this).val());
	// });

	$('#ple_id').change(function(e){
		if($(this).val().length > 0 && $('#cli_id').val().length > 0){
			$('#btn-genera-plan-pagos').addClass('btn-primary');
			$('#btn-genera-plan-pagos').attr('disabled', false);
		}
	});

	$('#btn-guarda-plan-pagos').click(function(e){
//		$('#btn-editar-borrador').addClass('btn-primary');
//		$('#btn-editar-borrador').attr('disabled', false);
		$('#btn-enviar').addClass('btn-primary');
		$('#btn-enviar').attr('disabled', false);
	});

	// $('#btn-guardar-edicion').click(function(e){
	// 	$('#btn-enviar').addClass('btn-primary');
	// 	$('#btn-enviar').attr('disabled', false);
	// });

	$('#btn-editar-borrador').click(function(){
		$('#doc-propietario').html();
		$('#doc-superficie-terreno').html();
		$('#doc-superficie-terreno-literal').html();
		$('#doc-urbanizacion').html($('#urb_id option:selected').text());
		$('#doc-numero-lote').html($('#lot_id option:selected').text());
		$('#doc-manzano').html($('#man_id option:selected').text());

		console.log($('#box-contract').html());
		$('#editorhtml').val($('#box-contract').html());
		$('#modal-descripcion-contrato').modal('show');
		
	});

		
	
	</script>


    @endsection