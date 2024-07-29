@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')
	<!-- CONTENIDO -->
	<div class="col-md-10 content-pane">
		<h3 class="title-header" style="text-transform: uppercase;">
			<i class="fa fa-building"></i>
			{{$titulo}}
			<a class="btn btn-sm btn-secondary float-right" style="margin-left:10px;" href="#"><i class="fa fa-chevron-left"></i> ATRAS</a>
			<a class="btn btn-sm btn-success float-right" href="{{url('urbanizaciones/nuevo')}}"><i class="fa fa-plus"></i> NUEVA URBANIZACION</a>
		</h3>

			<!-- inicio card  -->
			<div class="card mb-3">
			  @if($urbanizaciones->count() == 0)
			  <br>
			  <div class="row">
				<div class="col-md-10 offset-md-1">
					<div class="alert alert-info">
					<div class="media">
						<img src="{{asset('img/alert-info.png')}}" class="align-self-center mr-3" alt="...">
						<div class="media-body">
							<h5 class="mt-0">Nota.-</h5>
							<p>
								No hay urbanizaciones registradas todavía. 
							</p>
						</div>
					</div>
				  </div>
				</div>
				</div>
			  @else
			  @foreach($urbanizaciones as $item)
			  <div class="row no-gutters">
			    <div class="col-md-3">
						<img style="width: 100%" src="{{asset('img/bg-urbanizacion.png')}}" alt="Foto urbanizacion">
			    </div>
			    <div class="col-md-9">
			      <div class="card-body">
			        <h4 class="card-title"><strong><span class="text-primary">URBANIZACION:</span> {{Str::upper($item->urb_nombre)}}</strong></h4>
							<hr>
							<div class="row">
								<div class="col-md-6">
									<h5 class="card-title"><span class="text-success">FECHA APROBACION:</span> 
										@if(Str::of($item->urb_fecha_aprobacion)->trim()->isEmpty())
										<small>[No definido]</small>
										@else
										{{$item->urb_fecha_aprobacion}}
										@endif
									</h5>
								</div>
								<div class="col-md-6">
									<h5 class="card-title"><span class="text-success">LEY MUNICIPAL:</span> 
										@if(Str::of($item->urb_ley)->trim()->isEmpty())
										<small>[No definido]</small>
										@else
										{{$item->urb_ley}}
										@endif
									</h5>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<h5 class="card-title"><span class="text-success">MANZANOS:</span> {{$item->manzanos->count();}}</h5>
								</div>
								<div class="col-md-6">
									<h5 class="card-title"><span class="text-success">TOTAL LOTES:</span> {{$item->lotes->count();}}</h5>
								</div>
							</div>
							<a href="{{url('urbanizaciones/'.Crypt::encryptString($item->urb_id))}}" class="btn btn-primary">
								<i class="fa fa-chevron-right"></i>
								ADMINISTRAR URBANIZACION
							</a>
			      </div>
			    </div>
			  </div>
			  @endforeach
			  @endif
			</div>
			<!-- fin card  -->

			<!-- PAGINACION INICIO -->
            {{$urbanizaciones->links()}}
			<!-- PAGINACION FIN -->


	</div><!-- END RIGHT CONTENT -->


</div>

@endsection