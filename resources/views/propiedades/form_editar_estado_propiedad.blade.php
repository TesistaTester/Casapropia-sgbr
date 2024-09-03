@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
		<h3 class="title-header" style="text-transform: uppercase;">
			<i class="fa fa-edit"></i>
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
								<form action="{{url('estados/'.Crypt::encryptString($estado_propiedad->esp_id))}}" method="POST">
									@csrf
									@method('PUT')
									<div class="row">
										<div class="col-md-8 offset-md-2">
											<small>Los campos marcados con asterisco (<span class="text-danger">*</span>) son obligatorios.</small>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4 offset-md-2">
											<div class="form-group">
												<label class="label-blue label-block" for="">
													Estado:
													<span class="text-danger">*</span>
													<i class="fa fa-question-circle float-right" title="Definir la moneda en la cual se establecerá la venta de la propiedad"></i>
												</label>
												<select required name="edi_id" id="edi_id" class="form-control @error('edi_id') is-invalid @enderror">
													<option value="">Seleccione una opción</option>
													@foreach ($estados as $item)
														{{-- @if($item->edi_estado !== 'VENDIDO' && $item->edi_estado !== 'PAGANDO')
															@if($item->edi_id == $estado_propiedad->edi_id)
																<option value="{{$item->edi_id}}" selected>{{$item->edi_estado}}</option>
															@else
																<option value="{{$item->edi_id}}">{{$item->edi_estado}}</option>
															@endif
														@endif --}}
														<option value="{{$item->edi_id}}">{{$item->edi_estado}}</option>
													@endforeach
												</select>
												@error('edi_id')
												<div class="invalid-feedback">
													{{$message}}
												</div>											
												@enderror
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
													<label class="label-blue label-block" for="">
														Fecha actual:
														<span class="text-danger">*</span>
														<i class="fa fa-question-circle float-right" title="Definir la fecha de inicio del estado"></i>
													</label>
													<input type="date" required name="esp_fecha" id="esp_fecha" class="form-control @error('esp_fecha') is-invalid @enderror" value="{{old('esp_fecha', $estado_propiedad->esp_fecha)}}">
													@error('esp_fecha')
													<div class="invalid-feedback">
														{{$message}}
													</div>											
													@enderror
											</div>
										</div>
									</div>
									<div class="row">	
										<div class="col-md-8 offset-md-2">
											<div class="form-group">
												<label class="label-blue label-block" for="">
													Descripción o comentario adicional:
													<i class="fa fa-question-circle float-right" title="Corresponde al Precio Total (+ Intereses si corresponde) que la empresa espera percibir por la propiedad vendida"></i>
												</label>
											<textarea class="form-control @error('esp_descripcion') is-invalid @enderror" name="esp_descripcion" id="esp_descripcion">{{old('esp_descripcion', $estado_propiedad->esp_descripcion)}}</textarea>	
											@error('esp_descripcion')
											<div class="invalid-feedback">
												{{$message}}
											</div>											
											@enderror
											</div>
										</div>
							    	</div>
									<div class="row">
										<div class="col-md-8 offset-md-2">
											<input type="hidden" name="lot_id" id="lot_id" value="{{Crypt::encryptString($lote->lot_id)}}">
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

	<script type="text/javascript">
		$(function(){
		
		});
		</script>
		


    @endsection

