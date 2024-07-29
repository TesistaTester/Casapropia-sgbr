@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
		<h3 class="title-header" style="text-transform: uppercase;">
			<i class="fa fa-plus"></i>
			{{$titulo}}
			<a href="{{url('lotes/'.Crypt::encryptString($lote->lot_id))}}" title="Volver a Administración del lote" data-placement="top" class="btn btn-sm btn-secondary float-right" style="margin-left:10px;"><i class="fa fa-angle-double-left"></i> ATRÁS</a>
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
									Datos básicos
								</span></strong></h4>
								<hr>
								<div class="row">
									<div class="col-md-10 offset-md-1">
										<div class="box-data-xtra">
											<div class="row">
												<div class="col-md-3">
													<h5>
														<span class="text-success">LOTE:</span>
														<span>{{$lote->lot_nro}}</span>
													</h5>
												</div>
												<div class="col-md-3">
													<h5>
														<span class="text-success">MANZANO:</span>
														<span>{{$manzano->man_nombre}}</span>
													</h5>
												</div>
												<div class="col-md-6">
													<h5>
														<span class="text-success">URBANIZACION:</span>
														<span>{{$urbanizacion->urb_nombre}}</span>
													</h5>
												</div>
											</div>
										</div>
									</div>
								</div>
								<form action="{{url('modalidades_venta')}}" method="POST">
									@csrf
									<small>Los campos marcados con asterisco (<span class="text-danger">*</span>) son obligatorios.</small>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label class="label-blue label-block" for="">
													Moneda de venta:
													<span class="text-danger">*</span>
													<i class="fa fa-question-circle float-right" title="Definir la moneda en la cual se establecerá la venta de la propiedad"></i>
												</label>
												<select required name="mov_moneda_venta" id="mov_moneda_venta" class="form-control @error('mov_moneda_venta') is-invalid @enderror">
													<option value="">Seleccione una opción</option>
													@if(old('mov_moneda_venta') == '0')
													<option value="0" selected>Bolivianos</option>
													@else
													<option value="0">Bolivianos</option>
													@endif
													@if(old('mov_moneda_venta') == '1')
													<option value="1" selected>Dolares</option>
													@else
													<option value="1">Dolares</option>
													@endif
												</select>
												@error('mov_moneda_venta')
												<div class="invalid-feedback">
													{{$message}}
												</div>											
												@enderror
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
													<label class="label-blue label-block" for="">
														Tipo de venta:
														<span class="text-danger">*</span>
														<i class="fa fa-question-circle float-right" title="Definir si la modalidad, al contado, a credito o en pagos"></i>
													</label>
													<select required name="mov_tipo_venta" id="mov_tipo_venta" class="form-control @error('mov_tipo_venta') is-invalid @enderror">
														<option value="">Seleccione una opción</option>
														@if(old('mov_tipo_venta') == '0')
														<option value="0" selected>Al contado</option>
														@else
														<option value="0">Al contado</option>
														@endif
														@if(old('mov_tipo_venta') == '1')
														<option value="1" selected>Pagos</option>
														@else
														<option value="1">Pagos</option>
														@endif
														@if(old('mov_tipo_venta') == '2')
														<option value="2" selected>Crédito</option>
														@else
														<option value="2">Crédito</option>
														@endif
													</select>
													@error('mov_tipo_venta')
													<div class="invalid-feedback">
														{{$message}}
													</div>											
													@enderror
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="label-blue label-block" for="">
													Precio de oferta:
													<span class="text-danger">*</span>
													<i class="fa fa-question-circle float-right" title="Definir el precio de oferta en el mercado"></i>
												</label>
											<input required type="number" min="0" step=".1" value="{{old('mov_precio_oferta',0)}}" class="form-control @error('mov_precio_oferta') is-invalid @enderror" name="mov_precio_oferta" id="mov_precio_oferta" placeholder="Precio de oferta">
											@error('mov_precio_oferta')
											<div class="invalid-feedback">
												{{$message}}
											</div>											
											@enderror
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="label-blue label-block" for="">
													Precio mínimo de venta:
													<span class="text-danger">*</span>
													<i class="fa fa-question-circle float-right" title="Definir el precio minimo de venta. (Limite para el contrato)"></i>
												</label>
											<input required type="number" min="0" step=".1" value="{{old('mov_precio_minimo',0)}}" class="form-control @error('mov_precio_minimo') is-invalid @enderror" name="mov_precio_minimo" id="mov_precio_minimo" placeholder="Precio mínimo de venta">
											@error('mov_precio_minimo')
											<div class="invalid-feedback">
												{{$message}}
											</div>											
											@enderror
											</div>
										</div>
	
										<div class="col-md-4" id="box-tasa-interes">
											<div class="form-group">
												<label class="label-blue label-block" for="">
													Tasa de interés (%):
													<span class="text-danger">*</span>
													<i class="fa fa-question-circle float-right" title="Definir la tasa de interés anual (en caso de modalidad a crédito). En porcentaje de 1 a 100"></i>
												</label>
												<input required type="number" min="0" max="100" step="1" value="{{old('mov_tasa_interes',0)}}" class="form-control @error('mov_tasa_interes') is-invalid @enderror" name="mov_tasa_interes" id="mov_tasa_interes" placeholder="Tasa de interes">
												@error('mov_tasa_interes')
												<div class="invalid-feedback">
													{{$message}}
												</div>											
												@enderror
											</div>
										</div>
										<div class="col-md-4" id="box-monto-interes">
											<div class="form-group">
												<label class="label-blue label-block" for="">
													Monto interés:
													<span class="text-danger">*</span>
													<i class="fa fa-question-circle float-right" title="Definir el monto de interés anual (en caso de modalidad a Credito)"></i>
												</label>
											<input required type="number" min="0" step=".1" value="{{old('mov_monto_interes',0)}}" class="form-control @error('mov_monto_interes') is-invalid @enderror" name="mov_monto_interes" id="mov_monto_interes" placeholder="Monto interes">
											@error('mov_monto_interes')
											<div class="invalid-feedback">
												{{$message}}
											</div>											
											@enderror
											</div>
										</div>
										<div class="col-md-4" id="box-cuota-inicial">
											<div class="form-group">
												<label class="label-blue label-block" for="">
													Cuota inicial:
													<span class="text-danger">*</span>
													<i class="fa fa-question-circle float-right" title="Definir la cuota inicial mínima que se aceptará para la venta en pagos o a crédito"></i>
												</label>
												<input required type="number" min="0" step=".1" value="{{old('mov_cuota_inicial',0)}}" class="form-control @error('mov_cuota_inicial') is-invalid @enderror" name="mov_cuota_inicial" id="mov_cuota_inicial" placeholder="Cuota inicial">
												@error('mov_cuota_inicial')
												<div class="invalid-feedback">
													{{$message}}
												</div>											
												@enderror
											</div>
										</div>
										<div class="col-md-4" id="box-plazo">
											<div class="form-group">
												<label class="label-blue label-block" for="">
													Plazo (meses):
													<span class="text-danger">*</span>
													<i class="fa fa-question-circle float-right" title="Definir el plazo (en meses) que representa el tiempo máximo para el cumplimiento de contrato."></i>
												</label>
											<input required type="number" min="0" step="1" value="{{old('mov_plazo',0)}}" class="form-control @error('mov_plazo') is-invalid @enderror" name="mov_plazo" id="mov_plazo" placeholder="Plazo">
											@error('mov_plazo')
											<div class="invalid-feedback">
												{{$message}}
											</div>											
											@enderror
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="label-blue label-block" for="">
													Precio total mínimo:
													<span class="text-danger">*</span>
													<i class="fa fa-question-circle float-right" title="Corresponde al Precio Total (+ Intereses si corresponde) que la empresa espera percibir por la propiedad vendida"></i>
												</label>
											<input required type="number" min="0" step=".1" value="{{old('mov_precio_total_minimo',0)}}" class="form-control @error('mov_precio_total_minimo') is-invalid @enderror" name="mov_precio_total_minimo" id="mov_precio_total_minimo" placeholder="Precio total minimo">
											@error('mov_precio_total_minimo')
											<div class="invalid-feedback">
												{{$message}}
											</div>											
											@enderror
											</div>
										</div>
							    	</div>
									<input type="hidden" name="pro_id" id="pro_id" value="{{Crypt::encryptString($propiedad->pro_id)}}">
									<input type="hidden" name="lot_id" id="lot_id" value="{{Crypt::encryptString($lote->lot_id)}}">
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

	<script type="text/javascript">
		$(function(){
			/*
			--------------------------------------------------------------
			REGISTRAR NUEVA MODALIDAD DE VENTA
			--------------------------------------------------------------
			*/
			$('#box-monto-interes').hide();
			$('#box-tasa-interes').hide();
			$('#box-cuota-inicial').hide();
			$('#box-plazo').hide();
		
			$('#mov_tipo_venta').change(function(){
				if($(this).val() == ''){
					$('#box-monto-interes').fadeOut();
					$('#box-tasa-interes').fadeOut();
					$('#box-cuota-inicial').fadeOut();
					$('#box-plazo').fadeOut();
					$('#mov_monto_interes').val(0);
					$('#mov_tasa_interes').val(0);
					$('#mov_cuota_inicial').val(0);
					$('#mov_plazo').val(0);
				}
				if($(this).val() == 0){
					$('#box-monto-interes').fadeOut();
					$('#box-tasa-interes').fadeOut();
					$('#box-cuota-inicial').fadeOut();
					$('#box-plazo').fadeOut();
					$('#mov_monto_interes').val(0);
					$('#mov_tasa_interes').val(0);
					$('#mov_cuota_inicial').val(0);
					$('#mov_plazo').val(0);
				}
				if($(this).val() == 1){
					$('#box-monto-interes').fadeOut();
					$('#box-tasa-interes').fadeOut();
					$('#box-cuota-inicial').fadeIn();
					$('#box-plazo').fadeIn();
					$('#mov_monto_interes').val(0);
					$('#mov_tasa_interes').val(0);
				}
				if($(this).val() == 2){
					$('#box-monto-interes').fadeIn();
					$('#box-tasa-interes').fadeIn();
					$('#box-cuota-inicial').fadeIn();
					$('#box-plazo').fadeIn();
				}
			});	
		
		});
		</script>
		


    @endsection

