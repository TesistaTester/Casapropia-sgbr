@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
		<h3 class="title-header" style="text-transform: uppercase;">
			<i class="fa fa-plus"></i>
			{{$titulo}}
			<a href="{{url('clientes')}}" title="Volver a lista de propietarios" data-placement="top" class="btn btn-sm btn-secondary float-right" style="margin-left:10px;"><i class="fa fa-angle-double-left"></i> ATRÁS</a>
		</h3>

		<div class="row">
			<div class="col-md-12">
				<!-- inicio card  -->
				<div class="card">
					<div class="row no-gutters">
						<div class="col-md-12">
							<div class="card-body">
								<form id="form-nuevo-cliente" action="{{url('contratos')}}" method="POST">
								  @csrf
									{{-- <div class="alert alert-info">
										<div class="media">
											<img src="{{asset('img/alert-info.png')}}" class="align-self-center mr-3" alt="...">
											<div class="media-body">
												<h5 class="mt-0">Nota.-</h5>
												<p>
													- Asegurese de tener la fotografía del cliente y el PDF escaneado del documento de identificación.
													<br>
													- Ingrese correctamente el tipo de cliente, luego este dato NO es posible modificarlo.
													<br>
													- Ingrese correctamente el número de documento de identificación (CI, libreta militar), luego este dato NO es posible modificarlo.
												</p>
											</div>
										</div>
									</div> --}}
								  
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
													<div class="col-md-2">
														<div class="form-group">
															<label class="label-blue label-block" for="">
																Manzano:
																<span class="text-danger">*</span>
																<i class="fa fa-question-circle float-right" title="Seleccione el manzano al que pertenece la propiedad"></i>
															</label>
															<select required name="man_id" id="man_id" class="form-control @error('man_id') is-invalid @enderror" data-get-lotes-json="{{url('manzanos/get_lot_by_man_json_contratos')}}">
																<option value="">Seleccione una opción</option>
															</select>
															@error('man_id')
															<div class="invalid-feedback">
																{{$message}}
															</div>											
															@enderror
														</div>
													</div>
													<div class="col-md-2">
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
															<select required name="con_tipo_venta" id="con_tipo_venta" class="form-control @error('lot_id') is-invalid @enderror">
																<option value="">Seleccione una opción</option>
																<option value="0">AL CONTADO</option>
																<option value="1">A PAGOS</option>
																<option value="2">A CREDITO</option>
															</select>
															@error('con_tipo_venta')
															<div class="invalid-feedback">
																{{$message}}
															</div>											
															@enderror
														</div>
													</div>
													<div class="col-md-2">
														<div class="form-group">
															<label class="label-blue label-block" for="">
																Tasa de interes:
																<span class="text-danger">*</span>
																<i class="fa fa-question-circle float-right" title="Tasa de interes para la venta de la propiedad. Este valor debe oscilar entre 0 y 1. Por ejemplo: 5% = 0.05, 15% = 0.15"></i>
															</label>
															<input required type="number" min="0" step="0.01" value="{{old('con_interes')}}" class="form-control @error('con_interes') is-invalid @enderror" name="con_interes" id="con_interes" placeholder="Tasa interes">
															@error('con_interes')
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
	
								  <section id="seccion-datos-contrato">
									<h4 class="card-title"><strong><span class="text-primary">
										<i class="fa fa-file"></i>
										Datos del contrato <span id="txt-representante-empresa"></span>
									</span></strong></h4>
									<hr>
									<div class="row">
										<div class="col-md-12">
											<div class="row">
												<div class="col-md-3">
													<div class="form-group">
															<label class="label-blue label-block" for="">
																Codigo de Contrato
																<span class="text-danger">*</span>
																<i class="fa fa-question-circle float-right" title="Establecer el codigo de contrato"></i>
															</label>
														<input required type="text" value="{{old('con_codigo_contrato')}}" class="form-control @error('con_codigo_contrato') is-invalid @enderror" name="con_codigo_contrato" id="con_codigo_contrato" placeholder="Codigo contrato">
														@error('con_codigo_contrato')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
															<label class="label-blue label-block" for="">
																Número de contrato
																<span class="text-danger">*</span>
																<i class="fa fa-question-circle float-right" title="Establecer el numero de contrato"></i>
															</label>
														<input required type="text" value="{{old('con_nro_contrato')}}" class="form-control @error('con_nro_contrato') is-invalid @enderror" name="con_nro_contrato" id="con_nro_contrato" placeholder="Nro de contrato">
														@error('con_nro_contrato')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
															<label class="label-blue label-block" for="">
																Precio total:
																<span class="text-danger">*</span>
																<i class="fa fa-question-circle float-right" title="Establecer el total de venta de la propiedad"></i>
															</label>
														<input required type="text" value="{{old('con_precio_total')}}" class="form-control @error('con_precio_total') is-invalid @enderror" name="con_precio_total" id="con_precio_total" placeholder="Precio total">
														@error('con_precio_total')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
															<label class="label-blue label-block" for="">
																Moneda:
																<span class="text-danger">*</span>
																<i class="fa fa-question-circle float-right" title="Establecer el número de documento de identificación de la persona"></i>
															</label>
															<select required name="con_moneda" id="con_moneda" class="form-control @error('con_moneda') is-invalid @enderror">
																<option value="">Seleccione una opción</option>
																<option value="0">BOLIVIANOS</option>
																<option value="1">DOLARES</option>
															</select>
															@error('con_moneda')
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
																Pago inicial:
																<span class="text-danger">*</span>
																<i class="fa fa-question-circle float-right" title="Establecer el número de documento de identificación de la persona"></i>
															</label>
														<input required type="number" value="{{old('con_pago_inicial')}}" class="form-control @error('con_pago_inicial') is-invalid @enderror" name="con_pago_inicial" id="con_pago_inicial" placeholder="Pago inicial">
														@error('con_pago_inicial')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
															<label class="label-blue label-block" for="">
																Plazo (en meses):
																<span class="text-danger">*</span>
																<i class="fa fa-question-circle float-right" title="Establecer el plazo de la venta (en meses, si corresponde)"></i>
															</label>
														<input required type="number" value="{{old('con_plazo')}}" class="form-control @error('con_plazo') is-invalid @enderror" name="con_plazo" id="con_plazo" placeholder="Plazo en meses">
														@error('con_plazo')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
															<label class="label-blue label-block" for="">
																Tasa de cambio:
																<span class="text-danger">*</span>
																<i class="fa fa-question-circle float-right" title="Establecer la tasa de cambio aceptada en el contrato"></i>
															</label>
														<input required type="number" step=".1" value="{{old('con_tasa_cambio')}}" class="form-control @error('con_tasa_cambio') is-invalid @enderror" name="con_tasa_cambio" id="con_tasa_cambio" placeholder="Tasa de cambio">
														@error('con_tasa_cambio')
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
																Tipo de contrato:
																<span class="text-danger">*</span>
																<i class="fa fa-question-circle float-right" title="Establecer el tipo de contrato. Este formulario esta predeterminado para los contratos de compra-venta."></i>
															</label>
															<select required name="con_tipo" id="con_tipo" class="form-control @error('con_tipo') is-invalid @enderror">
																<option value="">Seleccione una opción</option>
																<option value="0" selected>COMPRA/VENTA</option>
															</select>
														@error('con_tipo')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
															<label class="label-blue label-block" for="">
																Fecha de contrato:
																<span class="text-danger">*</span>
																<i class="fa fa-question-circle float-right" title="Establecer la fecha de contrato."></i>
															</label>
														<input required type="date" value="{{old('con_fecha_contrato', date('Y-m-d'))}}" class="form-control @error('con_fecha_contrato') is-invalid @enderror" name="con_fecha_contrato" id="con_fecha_contrato" placeholder="Fecha de contrato">
														@error('con_fecha_contrato')
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

								  <section id="seccion-datos-clientes">
									<h4 class="card-title"><strong><span class="text-primary">
										<i class="fa fa-users"></i>
										Datos de los firmantes
									</span></strong></h4>
									<hr>
									<div><small>Seleccione los cliente(s) y propietario(s) que realizarán la firma del contrato</small></div>
									<div class="row">
										<div class="col-md-12">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
															<label class="label-blue label-block" for="">
																Clientes
																<span class="text-danger">*</span>
																<i class="fa fa-question-circle float-right" title="Establecer el número de documento de identificación de la persona"></i>
															</label>
															<select required name="cli_id[]" id="cli_id" multiple="multiple" class="form-control search-items @error('ple_id') is-invalid @enderror">
																<option value="">Seleccione una opción</option>
																@foreach($clientes as $item)
																<option value="{{$item->cli_id}}" {{ old('cli_id') == $item->cli_id ? 'selected' : '' }}>{{$item->persona->per_nombres}} {{$item->persona->per_primer_apellido}} {{$item->persona->per_segundo_apellido}} - Doc.ID.: {{$item->persona->per_nro_id}}</option>
																@endforeach
															</select>			
														@error('cli_id')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
															<label class="label-blue label-block" for="">
																Propietario(s)
																<span class="text-danger">*</span>
																<i class="fa fa-question-circle float-right" title="Establecer el número de documento de identificación de la persona"></i>
															</label>
															<select required name="ple_id[]" id="ple_id" multiple="multiple" class="form-control search-items @error('ple_id') is-invalid @enderror">
																<option value="">Seleccione una opción</option>
																@foreach($propietarios as $item)
																<option value="{{$item->ple_id}}" {{ old('ple_id') == $item->ple_id ? 'selected' : '' }}>{{$item->persona->per_nombres}} {{$item->persona->per_primer_apellido}} {{$item->persona->per_segundo_apellido}} - Doc.ID.: {{$item->persona->per_nro_id}}</option>
																@endforeach
															</select>			
														@error('ple_id')
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
								  <hr>
								  <section id="pasos-contrato">
										<div class="row">
											<div class="col-md-4 text-center">
												<div class="alert alert-secondary">
													<div id="generador_planes">
														<small>Para continuar, debe <b>Generar el plan de pagos</b>.
														</small>
													</div>
													<button type="button" class="btn" id="btn-genera-plan-pagos" data-toggle="modal" data-target="#modal-generar-plan" href="#">
														<i class="fa fa-cogs"></i>
														Generar el plan de pagos
													</button>	
												</div>
											</div>
											<div class="col-md-4 text-center">
												<div class="alert alert-secondary">
													<div id="contrato_editor">
													<small>Luego, debe <b>Editar el borrador del contrato</b></small>
												  </div>
												  <button id="btn-editar-borrador" type="button" class="btn" href="#">
													<i class="fa fa-edit"></i>
													Editar borrador de contrato
												  </button>		
												</div>
											</div>
											<div class="col-md-4 text-center">
												<div class="alert alert-secondary">
													<small>Para finalizar, puede <b>Guardar datos del contrato</b></small>
													<input type="text" id="campo_plan_pagos" name="campo_plan_pagos">
													<button type="submit" class="btn" id="btn-enviar">
														<i class="fa fa-save"></i>
														Guardar datos
													</button>
												</div>
											</div>
										</div>	
								  </section>


								</form>
							</div>
						</div>
					</div>
				</div>

				<!-- fin card  -->

			</div>
		</div>
	</div>

	<section id="redac_contrato">

		
	</section>


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
          {{-- <button type="button" id="btn-no-autocompletar" class="btn btn-secondary" data-dismiss="modal">No autocompletar</button> --}}
          <button type="button" id="btn-autocompletar" class="btn btn-primary" data-dismiss="modal">
			<i class="fa fa-edit"></i>
			Autocompletar datos
		  </button>
        </div>
      </div>
    </div>
  </div>
  {{-- FIN MODAL: EXISTE PROPIETARIO / AUTOCOMPLETAR FORMULARIO --}}

  {{-- INICIO MODAL: GENERAR PLAN DE PAGOS --}}
  <div class="modal fade" id="modal-generar-plan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-cogs"></i>
              Generar plan de pagos
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
			<table class="table table-bordered">
				<tr>
					<td class="text-primary">PRECIO DE VENTA:</td>
					<td id="txt_monto">4500</td>
					<td class="text-primary">MONEDA:</td>
					<td id="txt_moneda">dolare</td>
					<td class="text-primary">MODALIDAD:</td>
					<td id="txt_modalidad">A PAGOS</td>
				</tr>
				<tr>
					<td class="text-primary">MESES PLAZO:</td>
					<td id="txt_meses"></td>
					<td class="text-primary">CUOTA INICIAL:</td>
					<td id="txt_cuota_inicial"></td>
					<td class="text-primary">TASA DE INTERÉS:</td>
					<td id="txt_interes"></td>
				</tr>
			</table>
			<table class="table table-sm table-bordered">
				<thead>
					<tr>
						<td>NRO</td>
						<td>FECHA</td>
						<td>MONTO PAGO (USD)</td>
						<td>MONTO PAGO (Bs)</td>
						<td>INTERES MESUAL</td>
						<td>AMORTIZACION</td>
						<td>SALDO</td>
						<td>OBSERVACION</td>
					</tr>
				</thead>
				<tbody id="tabla-plan-pagos">
					<tr>
						<td>1</td>
						<td>01-08-2024</td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
					</tr>	
				</tbody>
			</table>
        </div>
        <div class="modal-footer">
          <button type="button" id="btn-entendido" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" id="btn-guarda-plan-pagos" class="btn btn-success" data-dismiss="modal">
			<i class="fa fa-check"></i>
			Guardar plan de pagos
		  </button>
        </div>
      </div>
    </div>
  </div>
  {{-- FIN MODAL: GENERAR PLAN DE PAGOS --}}


  {{-- INICIO MODAL: DESCRIPCION DEL CONTRATO --}}
  <div class="modal fade" id="modal-descripcion-contrato" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-edit"></i>
              Editar borrador del contrato
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
			<textarea id="editorhtml">	
				<div>
					<p style="text-align: center"><strong>DOCUMENTO PRIVADO DE COMPRAVENTA DE LOTE DE TERRENO</strong></p>
				
					<p>
						Conste por el presente documento privado que en el caso necesario podrá ser elevado a la categoria de instrumento publico con solo el reconocimiento de firmas y rubricas suscrito entre las personas que se mencionará mas adelante de conformidad a las siguientes clausulas:					
					</p>				
					
					<p><strong>PRIMERA.-</strong> Yo <span id="doc-propietario"></span>, mayor de edad, habil por derecho declaro ser propietaria de un lote de terreno de una extension superficial de <span id="doc-superficie-terreno"></span> mts2 (<span id="doc-superficie-terreno-literal"></span> 00/100), ubicado en la Urbanización <span id="doc-urbanizacion"></span>, lote signado con el Nro <span id="doc-numero-lote"></span> del Manzano
					<span id="doc-manzano"></span>, el mismo registrado en Derechos Reales.
					</p>
					
					<p>
					<strong>SEGUNDO.- </strong>A la fecha, por asi convenir asi a mis intereses, hago formal promesa de venta de un lote de terreno mencionado en la clausula primera en favor del señor NOMBRE CLIENTE, 
					mayor de edad y habil por derecho, por el precio libremente convenido entre ambas partes de $US.- 4250 (CUATRO MIL DOSCIENTOS CINCUENTA 00/100 DOLARES AMERICANOS), de acuerdo a las siguientes condiciones.
					</p>
					
					<p>
					<strong>a)</strong> A tiempo de susribir el presente documento privado, los compradores he hacen la entrega total como anticipo del precio del lote de terreno, la suma de $US.- 500 (QUINIENTOS DOLARES AMERICANOS), 
					valor que declaro recibir a tiempo de suscribir el presente documento.
					</p>
					<p>
					<strong>b)</strong> El saldo de $US.- 3750 será abonado a mi favor en 36 cutas mensuales de 104 y/0 su equivalente en bolivianos a la fecha de pago, el saldo total debe ser cancelado hasta el 29 de abril de 2024, 
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
        </div>
        <div class="modal-footer">
          <button type="button" id="btn-entendido" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" id="btn-guardar-edicion" class="btn btn-success" data-dismiss="modal">
			<i class="fa fa-check"></i>
			Guardar edición y continuar
		  </button>
        </div>
      </div>
    </div>
  </div>
  {{-- FIN MODAL: DESCRIPCION DEL CONTRATO --}}

<section id="box-contract" style="display: none">
	<div>
	<p style="text-align: center"><strong>DOCUMENTO PRIVADO DE COMPRAVENTA DE LOTE DE TERRENO</strong></p>

	<p>
		Conste por el presente documento privado que en el caso necesario podrá ser elevado a la categoria de instrumento publico con solo el reconocimiento de firmas y rubricas suscrito entre las personas que se mencionará mas adelante de conformidad a las siguientes clausulas:					
	</p>				
	
	<p><strong>PRIMERA.-</strong> Yo <span id="doc-propietario"></span>, mayor de edad, habil por derecho declaro ser propietaria de un lote de terreno de una extension superficial de <span id="doc-superficie-terreno"></span> mts2 (<span id="doc-superficie-terreno-literal"></span> 00/100), ubicado en la Urbanización <span id="doc-urbanizacion"></span>, lote signado con el Nro <span id="doc-numero-lote"></span> del Manzano
	<span id="doc-manzano"></span>, el mismo registrado en Derechos Reales.
	</p>
	
	<p>
	<strong>SEGUNDO.- </strong>A la fecha, por asi convenir asi a mis intereses, hago formal promesa de venta de un lote de terreno mencionado en la clausula primera en favor del señor NOMBRE CLIENTE, 
	mayor de edad y habil por derecho, por el precio libremente convenido entre ambas partes de $US.- 4250 (CUATRO MIL DOSCIENTOS CINCUENTA 00/100 DOLARES AMERICANOS), de acuerdo a las siguientes condiciones.
	</p>
	
	<p>
	<strong>a)</strong> A tiempo de susribir el presente documento privado, los compradores he hacen la entrega total como anticipo del precio del lote de terreno, la suma de $US.- 500 (QUINIENTOS DOLARES AMERICANOS), 
	valor que declaro recibir a tiempo de suscribir el presente documento.
	</p>
	<p>
	<strong>b)</strong> El saldo de $US.- 3750 será abonado a mi favor en 36 cutas mensuales de 104 y/0 su equivalente en bolivianos a la fecha de pago, el saldo total debe ser cancelado hasta el 29 de abril de 2024, 
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

</section>	

<script>
$(function(){
	//select2 buscador
	$('.search-items').select2({language:"es"});

	$('#btn-genera-plan-pagos').click(function(e){
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

		// al contado
		if(tipo_venta == 0){
			saldo = monto - cuota_inicial;
			const nuevoMes = fecha.getMonth() + iterador_meses;
			fecha.setMonth(nuevoMes);
			var dia = fecha.getDate(); // Día del mes
			var mes = fecha.getMonth() + 1; // Mes (enero es 0, por eso se suma 1)
			var anio = fecha.getFullYear(); // Año
			var fecha_actual = dia+"-"+mes+"-"+anio;

			$('#tabla-plan-pagos').append('<tr><td>1</td><td>'+fecha_actual+'</td><td>'+cuota_inicial+'</td><td>'+(cuota_inicial*tasa_cambio)+'</td><td>0</td><td>0</td><td>'+saldo+'</td><td>PAGO AL CONTADO</td></tr>');
			x = {'nro':1, 'fecha':fecha_actual, 'monto':cuota_inicial, 'interes_mensual':0, 'amortizacion':0, 'saldo':saldo, 'observacion':'PAGO AL CONTADO'};
			data_plan.push(x);
			// console.log("Mes: 0 Monto: "+monto+" Cuota inicial: "+cuota_inicial+" Saldo:"+saldo);
			console.log(data_plan);
			$('#campo_plan_pagos').val(JSON.stringify(data_plan));
		}
		// a pagos
		if(tipo_venta == 1){
			const nuevoMes = fecha.getMonth() + iterador_meses;
			fecha.setMonth(nuevoMes);
			var dia = fecha.getDate(); // Día del mes
			var mes = fecha.getMonth() + 1; // Mes (enero es 0, por eso se suma 1)
			var anio = fecha.getFullYear(); // Año
			var fecha_actual = dia+"-"+mes+"-"+anio;
			saldo = monto - cuota_inicial;
			iterador_meses++;

			$('#tabla-plan-pagos').append('<tr><td>0</td><td>'+fecha_actual+'</td><td>'+cuota_inicial+'</td><td>'+(cuota_inicial*tasa_cambio)+'</td><td>0</td><td>0</td><td>'+saldo+'</td><td>CUOTA INICIAL</td></tr>');
			x = {'nro':0, 'fecha':fecha_actual, 'monto':cuota_inicial, 'interes_mensual':0, 'amortizacion':0, 'saldo':saldo, 'observacion':'CUOTA INICIAL'};
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
				var fecha_actual = dia+"-"+mes+"-"+anio;

				$('#tabla-plan-pagos').append('<tr><td>'+i+'</td><td>'+fecha_actual+'</td><td>'+monto_pago+'</td><td>'+(monto_pago*tasa_cambio)+'</td><td>0</td><td>0</td><td>'+saldo+'</td><td></td></tr>');
				x = {'nro':i, 'fecha':fecha_actual, 'monto':monto_pago, 'interes_mensual':0, 'amortizacion':0, 'saldo':saldo, 'observacion':''};
				data_plan.push(x);

				console.log("Mes: "+i+" Monto: "+monto_pago+" SALDO: "+saldo);

				i++;
			}
			console.log(data_plan);
			$('#campo_plan_pagos').val(JSON.stringify(data_plan));

		}
		// a credito
		if(tipo_venta == 2 && interes_anual > 0){
			const nuevoMes = fecha.getMonth() + iterador_meses;
			fecha.setMonth(nuevoMes);
			var dia = fecha.getDate(); // Día del mes
			var mes = fecha.getMonth() + 1; // Mes (enero es 0, por eso se suma 1)
			var anio = fecha.getFullYear(); // Año
			var fecha_actual = dia+"-"+mes+"-"+anio;
			saldo = monto - cuota_inicial;
			iterador_meses++;

			$('#tabla-plan-pagos').append('<tr><td>0</td><td>'+fecha_actual+'</td><td>'+cuota_inicial+'</td><td>'+(cuota_inicial*tasa_cambio)+'</td><td>0</td><td>0</td><td>'+saldo+'</td><td>CUOTA INICIAL</td></tr>');
			x = {'nro':0, 'fecha':fecha_actual, 'monto':cuota_inicial, 'interes_mensual':0, 'amortizacion':0, 'saldo':saldo, 'observacion':'CUOTA INICIAL'};
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

				$('#tabla-plan-pagos').append('<tr><td>'+i+'</td><td>'+fecha_actual+'</td><td>'+monto_pago+'</td><td>'+(monto_pago*tasa_cambio)+'</td><td>'+IM+'</td><td>'+AM+'</td><td>'+saldo+'</td><td></td></tr>');
				x = {'nro':i, 'fecha':fecha_actual, 'monto':monto_pago, 'interes_mensual':IM, 'amortizacion':AM, 'saldo':saldo, 'observacion':''};
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