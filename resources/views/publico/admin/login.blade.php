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
							<h2 class="text-primary font-weight-bold">FORMULARIO DE ACCESO</h2>
							<hr>
							<form action="{{url('auth')}}" method="POST" autocomplete="off">
								@csrf
								<small class="text-secondary">Ingrese sus credenciales para ingresar al sistema.</small>
								<input style="display:none">
								<input type="text" style="display:none">
								<input autocomplete="false" name="hidden" type="text" style="display:none;">
								<div class="form-group">
								  <label class="text-primary">E-mail: </label>
								  <input required type="email" class="form-control form-control-lg" name="uuo" id="uuo" placeholder="Escriba su correo eletrónico." autocomplete="false" autofocus>
								</div>
								<div class="form-group">
								  <label class="text-primary">Contraseña: </label>
								  <input required type="password" class="form-control form-control-lg" name="ovc" id="ovc" placeholder="Escriba su contraseña" autocomplete="false">
								</div>
								<button type="submit" class="btn btn-lg btn-block btn-success">
									  <i class="fa fa-sign-in"></i>
									  Ingresar
								  </button>
								  <br><br>
								  <a class="btn btn-sm btn-secondary" href="#" id="btn-reset-password">
									  <i class="fa fa-shield"></i>
									  ¿Olvidó su contraseña?
								  </a>
							  </form>	  
						</section>
						<section id="form-reset-password">
							<h2 class="text-primary font-weight-bold">REESTABLECER CONTRASEÑA</h2>
							<hr>
							<form action="{{url('auth/reset')}}" method="POST" autocomplete="off">
								@csrf
								<small class="text-secondary">Se le enviará un mensaje a su e-mail para reestablecer su contraseña.</small>
								<input style="display:none">
								<input type="text" style="display:none">
								<input autocomplete="false" name="hidden" type="text" style="display:none;">
								<div class="form-group">
								  <label class="text-primary">Número de CI: </label>
								  <input required type="text" class="form-control form-control-lg" name="trq" id="trq" placeholder="Escriba su nro CI." autocomplete="false" autofocus>
								</div>
								<div class="form-group">
									<label class="text-primary">E-mail: </label>
									<input required type="text" class="form-control form-control-lg" name="trq" id="trq" placeholder="Escriba su e-mail" autocomplete="false">
								  </div>
								  <button type="submit" class="btn btn-lg btn-block btn-success">
									  <i class="fa fa-key"></i>
									  Solicitar nueva contraseña
								  </button>
								  <br><br>
								  <a class="btn btn-sm btn-secondary" href="#" id="btn-back-login">
									<i class="fa fa-arrow-left"></i>
									Atras
								</a>
							</form>
							</section>
					  </div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
    $(function(){
        $('#form-reset-password').hide();
		$('#btn-reset-password').click(function(){
			$('#form-login').fadeOut(300);
			setTimeout(function(){$('#form-reset-password').fadeIn(400);}, 301);
			
		});
		$('#btn-back-login').click(function(){
			$('#form-reset-password').fadeOut(300);
			setTimeout(function(){$('#form-login').fadeIn(400);}, 301);			
		});
    });
</script>

@endsection
