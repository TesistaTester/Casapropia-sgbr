@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
		<h3 class="title-header" style="text-transform: uppercase;">
			<i class="fa fa-plus"></i>
			{{$titulo}}
			<a href="{{url('urbanizaciones/'.Crypt::encryptString($urbanizacion->urb_id))}}" title="Volver a Administración del urbanizacion" data-placement="top" class="btn btn-sm btn-secondary float-right" style="margin-left:10px;"><i class="fa fa-angle-double-left"></i> ATRÁS</a>
		</h3>

		<div class="row">
			<div class="col-md-12">
				<!-- inicio card  -->
				<div class="card">
					<div class="row no-gutters">
						<div class="col-md-12">
							<div class="card-body">
								<hr>
								<div class="row">
									<div class="col-md-8 offset-md-2">
										<div class="box-data-xtra">
											<div class="row">
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
								<form enctype="multipart/form-data" action="{{url('urbanizaciones/store_adjunto')}}" method="POST">
									@csrf
									<div class="row">
										<div class="col-md-8 offset-md-2">
											<small>Los campos marcados con asterisco (<span class="text-danger">*</span>) son obligatorios.</small>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4 offset-md-2">
											<div class="form-group">
												<label class="label-blue label-block" for="">
													Descripción del documento:
													<span class="text-danger">*</span>
													<i class="fa fa-question-circle float-right" title="Establecer una descripcion del documento"></i>
												</label>
												<input type="text" required name="adu_descripcion" id="adu_descripcion" class="form-control @error('adu_descripcion') is-invalid @enderror">
												@error('adu_descripcion')
												<div class="invalid-feedback">
													{{$message}}
												</div>											
												@enderror
											</div>
										</div>
										<div class="col-md-4">
											<label class="label-blue label-block" for="">
												Archivo:
												<span class="text-danger">*</span>
												<i class="fa fa-question-circle float-right" title="Establecer la fotografía del cliente"></i>
											</label>
											<input required type="file" name="adu_ruta" id="adu_ruta" class="form-control file @error('adu_ruta') is-invalid @enderror" accept="image/*,.pdf">
											@error('adu_ruta')
											<div class="invalid-feedback">
												{{$message}}
											</div>											
											@enderror
									</div>
									</div>
									<div class="row">
										<div class="col-md-8 offset-md-2">
											<input type="hidden" name="urb_id" id="urb_id" value="{{Crypt::encryptString($urbanizacion->urb_id)}}">
											<button type="submit" class="btn btn-primary btn-enviar-adjunto">
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
			$('.btn-enviar-adjunto').click(function(e){
				setTimeout(() => {
					$(this).attr('disabled',true);
				}, 200);

			});
		});
		</script>
		


    @endsection

