@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
		<h3 class="title-header" style="text-transform: uppercase;">
			<i class="fa fa-plus"></i>
			{{$titulo}}
			<a href="{{url('urbanizaciones')}}" title="Volver a lista de urbanizaciones" data-placement="top" class="btn btn-sm btn-secondary float-right" style="margin-left:10px;"><i class="fa fa-angle-double-left"></i> ATRÁS</a>
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
								<small>Los campos marcados con asterisco (<span class="text-danger">*</span>) son obligatorios.</small>
								<form action="{{url('urbanizaciones')}}" method="POST" id="form-urbanizacion">
							    @csrf
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label class="label-blue label-block" for="">
												Nombre de la urbanización:
												<span class="text-danger">*</span>
												<i class="fa fa-question-circle float-right" title="Descripcion adicional"></i>
											</label>
										<input required type="text" value="{{old('urb_nombre')}}" class="form-control @error('urb_nombre') is-invalid @enderror" name="urb_nombre" placeholder="Nombre urbanización">
										@error('urb_nombre')
										<div class="invalid-feedback">
											{{$message}}
										</div>											
										@enderror
									  </div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="label-blue label-block" for="">
												Fecha de aprobación:
												<i class="fa fa-question-circle float-right" title="Descripcion adicional"></i>
											</label>
										<input type="date" value="{{old('urb_fecha_aprobacion')}}" class="form-control @error('urb_fecha_aprobacion') is-invalid @enderror" name="urb_fecha_aprobacion" placeholder="Fecha de aprobacion">
										@error('urb_fecha_aprobacion')
										<div class="invalid-feedback">
											{{$message}}
										</div>											
										@enderror
									  </div>
									</div>
									<div class="col-md-4">
									  <div class="form-group">
											<label class="label-blue label-block" for="">
												Ley de municipal:
												<i class="fa fa-question-circle float-right" title="Descripcion adicional"></i>
											</label>
										<input type="text" value="{{old('urb_ley')}}" class="form-control @error('urb_ley') is-invalid @enderror" name="urb_ley" placeholder="Ley municipal">
										@error('urb_ley')
										<div class="invalid-feedback">
											{{$message}}
										</div>											
										@enderror
									  </div>
									</div>
								</div>
								<h4 class="card-title"><strong><span class="text-primary">
									<i class="fa fa-apple"></i>
									Manzanos
								</span></strong></h4>
								<hr>
								<small>Para agregar manzanos directamente, haga click en <strong>Agregar Manzano</strong> y escriba el nombre correspondiente para registrarlo.</small>
								<br><br>
								<div class="row">
									<div class="col-md-3 text-center">
										<div class="alert alert-secondary">
											<a class="btn btn-success text-white" id="btn-agregar-manzano">
												<i class="fa fa-plus"></i> Agregar manzano
											</a>
											<hr>
											<a class="btn btn-sm btn-secondary text-white" id="btn-limpiar-manzano">
												<i class="fa fa-trash"></i> Limpiar manzanos
											</a>
	
										</div>
										{{-- <br>
										<a class="btn btn-sm btn-secondary" id="btn-get-manzanos">
											<i class="fa fa-trash"></i> Get manzanos
										</a> --}}

									</div>
									<div class="col-md-6" id="box-manzanos">
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-md-6">
										  <input type="hidden" name="manzanos" id="manzanos">
										  <button type="submit" class="btn btn-primary" id="guarda-manzanos">
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
		var manzanos = [];
		$('#btn-agregar-manzano').click(function(e){
			let cant = $('.apple').length +1;
			let apple = '<div class="row apple"><div class="col-md-1 text-right">'+cant+'.-</div><div class="col-md-6"><div class="form-group"><input required type="text" class="form-control nombre_manzano" placeholder="Nombre del manzano"></div></div></div>';
			$('#box-manzanos').append(apple);
			console.log("test");
		});

		$('#btn-limpiar-manzano').click(function(e){
			$('#box-manzanos').html('');	
			manzanos = [];		
		});
		$('#guarda-manzanos').bind("focusin mouseover",function(e){
			//limpiamos
			manzanos = [];		
			//continuamos
			$(".nombre_manzano").each(function(index){
				manzanos.push($(this).val());
			});
			console.log(manzanos);
			$('#manzanos').val(manzanos);
		});
	});
	</script>

    @endsection