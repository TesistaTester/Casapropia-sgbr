@extends('layouts.noautenticado')
@section('titulo', $titulo)

@section('contenido')

<div id="container">
	<div class="row">
		<div class="col-md-8 offset-md-2">
			<div class="login-box">
				<div class="row">
					<div class="col-md-6 right-login-box" style="min-height:10em; position:relative;">
						<div style="text-align: center; margin: 0; position: absolute; top: 50%; -ms-transform: translateY(-50%); transform: translateY(-50%);">
							<img style="width:80%; margin:auto;" src="{{asset('img/logo_sis_casa_propia.png')}}">
						</div>
					</div>
					<div class="col-md-6 left-login-box">
						<section id="form-login">
							<h2 class="text-primary font-weight-bold">Seleccione un rol</h2>
							<hr>
							<form action="{{url('role_director')}}" method="POST" autocomplete="off">
								@csrf
								<small class="text-secondary">Seleccione un rol de usuario para interactuar con el sistema.</small>
								<br>
								<br>
								<input style="display:none">
								<input type="text" style="display:none">
								<input autocomplete="false" name="hidden" type="text" style="display:none;">
								<div class="form-group">
								  <label class="text-primary">Ingresar al sistema como: </label>
								  <select required name="rol_id" id="rol_id" class="form-control @error('rol_id') is-invalid @enderror">
									<option value="">Seleccione una opción</option>
									@foreach($roles as $item)
									<option value="{{$item->rol->rol_codigo}}" {{ old('rol_id') == $item->rol->rol_codigo ? 'selected' : '' }}>{{$item->rol->rol_nombre}}</option>
									@endforeach
								  </select>								
								</div>
								<button type="submit" class="btn btn-lg btn-block btn-success">
									  <i class="fa fa-arrow-right"></i>
									  Continuar
							    </button>
							  </form>	  
							  <hr>
							  <p class="text-center text-secondary">
								ó
							  </p>
							  <a class="btn btn-sm btn-secondary" href="{{url('logout')}}">
								  <i class="fa fa-arrow-left"></i>
								  Cerrar sesión
						      </a>
						</section>
					  </div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
    $(function(){
    });
</script>

@endsection
