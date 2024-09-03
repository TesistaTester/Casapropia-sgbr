<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('titulo') - {{env('APP_NAME')}}</title>
    {{-- HOJAS DE ESTILO --}}
    <link rel="shortcut icon" href="{{url('img/favicon.ico')}}" type="image/x-icon">
	<link rel="icon" href="{{url('img/favicon.ico')}}" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="{{url('css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('css/int.styles.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('css/font-awesome.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('css/datatables.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('css/bootstrap-multiselect.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('css/leaflet.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('css/select2.min.css')}}">

    {{--   JS PARA TODO EL PROYECTO   --}}
    <script src="{{url('js/jquery36.min.js')}}"></script>
    <script src="{{url('js/popper.min.js')}}"></script>
    <script src="{{url('js/bootstrap.min.js')}}"></script>
    <script src="{{url('js/leaflet.js')}}"></script>
    <script src="{{url('js/moving_marker.js')}}"></script>
    <script src="{{url('js/datatables.min.js')}}"></script>
    <script src="{{url('js/bootstrap-multiselect.min.js')}}"></script>
    <script src="{{url('js/select2.min.js')}}"></script>

    <script src="{{url('js/tinymce/tinymce.min.js')}}" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: '#editorhtml',
        license_key: 'gpl',
        language_url: "{{url('js/tinymce/langs/es.js')}}",
        language: 'es_Es',
        language_load: false, 
      });
    </script>

</head>
<body>
    {{-- <div class="preloader">
        <div class="preloader"></div>
    </div> --}}
    <div id="particles-js"></div>

    {{-- TOP MENÚ (INICIO) --}}
            <nav class="navbar navbar-expand-lg navbar-dark nav-top-menu">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                    <a class="navbar-brand navbar-brand-centered" href="#">
                        <img style="height:55px;" src="{{ asset('img/logo_casa_propia-white.png')}}" alt="..." class="">
                    </a>
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        <li class="nav-item @if($modulo_activo == 'dashboard'): active @endif">
                            <a class="nav-link" href="{{url('inicio')}}">
                                <i class="fa fa-home"></i> INICIO <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="modal" data-target="#modal-guia-usuario" href="#">
                                <i class="fa fa-book"></i> GUIA DE USUARIO</span>
                            </a>
                        </li>
                    </ul>
                    <div class="btn-group">
                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user"></i>
                            @if(Auth::user()->persona == null)
                            ADMIN::{{session('rol_nombre')}}
                            @else
                            {{Auth::user()->persona->per_nombres}}::{{session('rol_nombre')}}
                            @endif

                        </button>
                        <div class="dropdown-menu dropdown-menu-right dropdown-user-profile" style="padding:0 !important;">
                            <div class="card card-user">
                                <div class="card-body text-center" style="padding:10px;">
                                    <div class="box-user-menu">
                                        <div class="text-center">
                                            <img style="width:40%; margin:10px auto 0 auto;" class="rounded-circle" src="{{asset('storage/'.Auth::user()->usu_foto)}}" alt="Foto de perfil">
                                            <h4 class="text-white">
                                                @if(Auth::user()->persona == null)
                                                ADMINISTRADOR
                                                @else
                                                {{Auth::user()->persona->per_nombres}} 
                                                <br><small>{{Auth::user()->persona->per_primer_apellido}} {{Auth::user()->persona->per_segundo_apellido}}</small>
                                                @endif
                                                <br>
                                                <small class="text-uppercase text-success" style="font-size:0.6em;">ROL: {{session('rol_nombre')}}</small>
                                            </h4>
                                        </div>
                                        <hr>
                        
                                        <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal-cuenta"><i class="fa fa-user"></i> Ver perfil</a>
                                        @if(count(Auth::user()->roles_usuario) > 1)
                                        <a href="{{url('role_selector')}}" class="dropdown-item"><i class="fa fa-random"></i> Cambiar rol</a>
                                        @endif
                                        <a href="{{url('logout')}}" class="dropdown-item"><i class="fa fa-sign-out"></i> Cerrar sesión</a>
                                    </div>
                                </div>
                            </div>
                            </div>
                    </div>
                </div>
            </nav>
    
    {{-- TOP MENÚ (FIN) --}}

    {{-- CONTENEDOR PRINCIPAL (INICIO) --}}
    <div class="row page-content"">
        {{-- MENU CONTEXTUAL --}}
        <div class="col-md-2 nav-contextual-container">
            <div class="nav-contextual">
                {{-- <div class="text-center">
                    <img style="width:40%; margin:10px auto 0 auto;" class="rounded-circle" src="{{asset('storage/'.Auth::user()->usu_foto)}}" alt="Foto de perfil">
                    <h4 class="text-white">
                        @if(Auth::user()->persona == null)
                        ADMINISTRADOR
                        @else
                        {{Auth::user()->persona->per_nombres}} 
                        <br><small>{{Auth::user()->persona->per_primer_apellido}} {{Auth::user()->persona->per_segundo_apellido}}</small>
                        @endif
                        <br><small class="text-uppercase text-success" style="font-size:0.6em;">superadmin</small>
                    </h4>
                </div>
                <hr> --}}
                    <h4 class="text-center text-white" style="text-transform: uppercase;">
                        <small>- MODULOS -</small>
                    </h4>
                    <nav class="nav nav-pills" aria-orientation="vertical">
                        {{-- @if(session('rol_id') == 3) --}}
                        <a class="nav-item nav-link @if($modulo_activo == 'urbanizaciones'): active @endif" href="{{url('urbanizaciones')}}"><i class="fa fa-building"></i> URBANIZACIONES</a>
                        {{-- @endif --}}
                        {{-- <a class="nav-item nav-link @if($modulo_activo == 'clientes'): active @endif" href="{{url('clientes')}}"><i class="fa fa-id-card"></i> CLIENTES</a>
                        <a class="nav-item nav-link @if($modulo_activo == 'ventas'): active @endif" href="{{url('ventas')}}"><i class="fa fa-map"></i> VENTAS</a> --}}
                        <a class="nav-item nav-link @if($modulo_activo == 'propietarios'): active @endif" href="{{url('propietarios')}}"><i class="fa fa-key"></i> PROPIETARIOS</a>
                        {{-- <a class="nav-item nav-link @if($modulo_activo == 'reservas'): active @endif" href="{{url('reservas')}}"><i class="fa fa-tag"></i> RESERVAS</a>
                        <a class="nav-item nav-link @if($modulo_activo == 'contratos'): active @endif" href="{{url('contratos')}}"><i class="fa fa-file"></i> CONTRATOS</a>
                        <a class="nav-item nav-link @if($modulo_activo == 'usuarios'): active @endif" href="{{url('usuarios')}}"><i class="fa fa-users"></i> USUARIOS</a>
                        <a class="nav-item nav-link @if($modulo_activo == 'reportes'): active @endif" href="{{url('reportes')}}"><i class="fa fa-line-chart"></i> REPORTES</a> --}}
                    </nav>    
                <div class="box-copyright">
                    &copy; {{date('Y')}} {{env('APP_NAME')}}
                </div>
    
            </div>
        </div>
        {{-- MENU CONTEXTUAL (FIN) --}}

        {{-- CONTENIDO VARIABLE (INICIO) --}}
        @yield('contenido')        
        {{-- CONTENIDO VARIABLE (FIN)--}}
    </div>
    
    {{-- CONTENEDOR PRINCIPAL (FIN) --}}


{{-- INICIO MODAL: GUIA DE USUARIO --}}
<div class="modal fade" id="modal-guia-usuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-book"></i>
              Guia de usuario
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <iframe class="pdf" 
            src="https://media.geeksforgeeks.org/wp-content/cdn-uploads/20210101201653/PDF.pdf" style="width:100%; height:500px;">
            </iframe>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  {{-- FIN MODAL: GUIA DE USUARIO --}}

  {{-- INICIO MODAL: CUENTA_USUARIO --}}
<div class="modal fade" id="modal-cuenta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-user"></i>
              Perfil de usuario
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="box-data-xtra">
                <div class="row">
                    <div class="col-md-6 text-success text-right">
                        USUARIO: 
                    </div>
                    <div class="col-md-6">
                        {{Auth::user()->usu_email}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 text-success text-right">
                        NOMBRES:
                    </div>
                    <div class="col-md-6">
                        @if(Auth::user()->persona == null)
                        ADMINISTRADOR
                        @else
                        {{Auth::user()->persona->per_nombres}} {{Auth::user()->persona->per_primer_apellido}} {{Auth::user()->persona->per_segundo_apellido}}
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 text-success text-right">
                        ROLES ASIGNADOS:
                    </div>
                    <div class="col-md-6">
                        @foreach (Auth::user()->roles_usuario as $item)
                            - {{$item->rol->rol_nombre}}<br>
                        @endforeach
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 text-success text-right">
                        ROL ACTUAL:
                    </div>
                    <div class="col-md-6">
                        <div class="badge badge-success">
                        {{session('rol_nombre')}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 text-success text-right">
                        ACTUALIZADO:
                    </div>
                    <div class="col-md-6">
                        {{Auth::user()->updated_at}}
                    </div>
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <a id="btn-update-password" class="btn btn-success btn-block" href="#">
                        <i class="fa fa-refresh"></i>
                        Actualizar contraseña
                    </a>

                    <form id="form-update-password" action="" method="POST">
                        @csrf
                        <a id="btn-back-update-password" class="btn btn-sm btn-secondary" style="float:right;" href="#">Atrás</a>
                        <h5 class="text-success">ACTUALIZAR CONTRASEÑA</h5>
                        <small>
                            Los campos marcados con <span class="text-danger">*</span> son obligatorios
                        </small>
						<div class="form-group">
							<label class="label-blue label-block" for="">
								Contraseña actual:
								<span class="text-danger">*</span>
								<i class="fa fa-question-circle float-right" title="Establecer la contraseña actual"></i>
							</label>
							<input required type="password" value="" class="form-control txt_pwd @error('pwd_actual') is-invalid @enderror" name="pwd_actual" id="pwd_actual" placeholder="Contraseña actual">
                            <input type="checkbox" onclick="ver_password('pwd_actual')"><small>Ver ésta contraseña</small>
                        </div>
						<div class="form-group">
							<label class="label-blue label-block" for="">
								Contraseña nueva:
								<span class="text-danger">*</span>
								<i class="fa fa-question-circle float-right" title="Establecer la contraseña nueva"></i>
							</label>
							<input required type="password" value="" class="form-control passwordInput txt_pwd @error('pwd_nueva') is-invalid @enderror" name="pwd_nueva" id="pwd_nueva" placeholder="Contraseña nueva">
                            <input type="checkbox" onclick="ver_password('pwd_nueva')"><small>Ver ésta contraseña</small>
                        </div>
                        <div id="msg-ok-update-password" class="alert alert-success">Contraseña actualizada correctamente.</div>
                        <div id="msg-error-update-password" class="alert alert-danger">La contraseña actual no coincide. Intente nuevamente.</div>
                        <div>
                            <div class="request-loader" style="display:inline; float:left;">
                                <img style="height:50px;" src="{{ asset('img/loader.gif')}}" alt="..." class="">
                                Procesando...
                            </div>
                            <button type="button" id="btn-send-password" class="btn btn-success" style="float:right;">
                                <i class="fa fa-save"></i>
                                Guardar datos
                            </button>
                        </div>
                    </form>    
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
  {{-- FIN MODAL: CUENTA USUARIO --}}



    <script src="{{url('js/particles.min.js')}}"></script>
    <script src="{{url('js/int.particles.js')}}"></script>

    <script>
        function ver_password(id_field) {
            var x = $("#"+id_field);
            if (x.attr('type') === "password") {
                x.attr('type','text');
            } else {
                x.attr('type','password');
            }
        }        
        $(function(){
            //PERFIL DE USUARIO
            $('#form-update-password').hide();            
            $('#btn-update-password').click(function(){
                $('#btn-update-password').slideUp();            
                $('#btn-logout').slideUp();            
                $('#form-update-password').slideDown();            
            });
            
            $('#btn-back-update-password').click(function(){    
                $('#form-update-password').slideUp();            
                $('#btn-update-password').slideDown();            
                $('#btn-logout').slideDown();            
            });

            $('#msg-ok-update-password').hide();
            $('#msg-error-update-password').hide();
            $('.request-loader').hide();            


			$("#btn-send-password").click(function(e){
                console.log("Entrando");
				if($("#form-update-password")[0].checkValidity()) {
                    console.log("validando");
					e.preventDefault();
					$(this).attr('disabled','true');
                    var btn_update = $(this);
					var csrfName = '_token'; // Value specified in $config['csrf_token_name']
					var csrfHash = $("input[name='_token']").val(); // CSRF hash
					var pwd_actual = $('#pwd_actual').val();
					var pwd_nuevo = $('#pwd_nueva').val();
					var route = '{{url("usuarios/update_password/".Crypt::encryptString(Auth::user()->usu_id))}}';
          			$.ajax({
  						type: "PUT",
  						url: route,
	 		            data: {
							pwd_actual: pwd_actual,
							pwd_nuevo: pwd_nuevo,
							[csrfName]: csrfHash
						},
  					    dataType: 'json',
  						beforeSend: function(){
    						$('.request-loader').show();
  						},
  						success: function(data){
  							if(data.status == 1){
                                console.log("STATUS 1");
									$('#msg-ok-update-password').slideDown(1000);
									setTimeout(function(){ window.location.reload(); }, 2500);
  							}else{
                                console.log("STATUS 2");
                                $('.request-loader').hide();
                                    $('#msg-error-update-password').slideDown(1000);
									setTimeout(function(){$('#msg-error-update-password').slideUp(1000);}, 5000);
                                    btn_update.attr('disabled',false);
  							}
  						},
  						error: function(data){
                            console.log("ERROR DE REQUEST");
                            $('.request-loader').hide();
                            $('#msg-error-update-password').slideDown(1000);
    						setTimeout(function(){$('#msg-error-update-password').slideUp(1000);}, 5000);
                            btn_update.attr('disabled',false);
  						}
  				});
        }
			});


			/*
            -----------------------------------------------------------------------
			FUNCIONES / EVENTOS GENERICOS PARA TODA LA APP
            -----------------------------------------------------------------------
            */
            //PRELOADER
            // $('.preloader').fadeOut('fast');
            //TOOLTIPS
            $('[title]').tooltip();
            //HTML SELECT MULTIPLE PLUGIN
            $('.select-multi').multiselect({nonSelectedText:"Seleccione una o más opciones"});

			//CONVERTIR TODOS LOS INPUT TEXT A MAYUSCULAS
			$("input[type=text], textarea").keyup(function () {
				if($(this).attr('data-tipo') != 'email' || $(this).attr('data-tipo') != 'pwd'){
					var start = this.selectionStart;
				  var end = this.selectionEnd;
				  this.value = this.value.toUpperCase();
				  this.setSelectionRange(start, end);
					// $(this).val($(this).val().toUpperCase());
				}
			});
            //ALERTAS NO PERSISTENTES
            setTimeout(function(){$('.alert-not-persistent').slideUp(2000);}, 10000);

			/*
            -----------------------------------------------------------------------
			CONFIGURACION DATATABLES
            -----------------------------------------------------------------------
            */
			//Obtiene la cantidad de columnas de la tabla
			// var nro_cols = $('.tabla-datos').find('th').length - 2;
			//Configura el data-table
			// $('.tabla-datos').DataTable({"language":{url: '{{asset('js/datatables-lang-es.json')}}'}, /*"order": [[ nro_cols, "desc" ]]*/});
			/*
            #######################################################################################
			EVENT LISTENERS
            #######################################################################################
            */
            //------------------------------------------------------------------------------------
            //FUNCIONES Y EVENTOS PARA ELIMINAR MANZANO (REGISTRO DE PROPIEDADES)
            //-------------------------------------------------------------------------------------
            $('#man-box-danger').hide();
            $('#man-box-warning').hide();
            $('#form-eliminar-manzano').hide();
            // EVENTO: click en el boton eliminar manzano
            $('.btn-eliminar-manzano').click(function(){
                $('#form-eliminar-manzano').hide();
                man_id = $(this).attr('data-manid');
                cant_lotes = $(this).attr('data-cantlot');
                if(cant_lotes == '0'){
                    //SI PUEDE ELIMINAR EL ITEM
                    $('#man-box-warning').hide();
                    $('#man-box-danger').show();
                    $('#form-eliminar-manzano').show();
                    action = $('#form-eliminar-manzano').attr('action');
                    action = action + '/'+ man_id;
                    $('#form-eliminar-manzano').attr('action', action);
                    $('#man-desc-eliminar').html($(this).attr('data-item_descripcion'));
                }else{
                    //NO PUEDE ELIMINAR EL ITEM
                    $('#man-box-danger').hide();
                    $('#man-box-warning').show();
                    $('#man-desc-eliminar').html($(this).attr('data-item_descripcion'));
                }
            });

            //------------------------------------------------------------------------------------
            // FUNCIONES Y EVENTOS PARA VALIDAR CAMPOS DE FORMULARIOS
            //------------------------------------------------------------------------------------

            // FUNCION: Mostrar elemento feedback MENSAJE valido o error
            function mostrar_resultados_validacion(nodo, respuesta, msg_ok, msg_error){
                if(respuesta === true || respuesta === "true" || respuesta === false || respuesta === "false"){
                    var randid = Math.floor(Math.random()*100);                
                    if(respuesta){//verdad - no existe registro con igual id
                        nodo.addClass("is-valid");
                        nodo.after('<div class="valid-feedback">'+msg_ok+'</div>');
                    }else{// falso - existe un registro con igual id
                        nodo.addClass("is-invalid");
                        nodo.after('<div id="'+randid+'" class="invalid-feedback">'+msg_error+'</div>');
                        setTimeout(function(){$('#'+randid).hide(1000);}, 4000);
                        nodo.val('');
                    }
                }
            }

            // FUNCION: Validar campo con datos del servidor
            // Retorna: 0 en caso de tener campo vacio, TRUE si pasó la validación, FALSE si NO pasó la validación
            function validar_campo(ruta_servicio, campo, valor, tabla, id_referencia){
                if(valor === "" || valor === 0 || valor === "0"){
                    return 0;
                }else{
                    //consultar al servidor
                    return true;//siempre positivo
                    return false;//siempre negativo
                }
                // if(id_referencia == 0){
                //     //consultas simples por la nombre de tabla
                // }else{
                //     //consultas compuestas del campo con un registro cuyo id sea referencial (otra tabla relacionada [es de, pertenece a])
                // }
            //     $.ajax({
            //             type: "POST",
            //             url: ruta_servicio,
            //             data: $(form_id).serialize(),
            //             dataType: 'json',
            //             success: function(data){
            //                 if(data.status == 1){
            //                     $('.save_success').slideDown(1000);
            //                     setTimeout(function(){ window.location.replace(route_destination); }, 2500);
            //                 }else{
            //                     $('.save_error').slideDown(1000);
            //                     trigger_element.removeAttr('disabled');
            //                     setTimeout(function(){$('.save_error').slideUp(1000);}, 5000);
            //                 }
            //             },
            //             error: function(data){
        
            //             }
            //     });
            }

            // //VALIDACION CAMPO NRO LOTE (FORMULARIO REGISTRO DE LOTE)
            // $('#lot_nro').focusout(function(){
            //     let respuesta = validar_campo("lotes/valida_lot_nro", "lot_nro", $(this).val(), "lote", $(this).attr('data-urbid'));
            //     let msg_ok = "El nro de lote"+$(this).val()+" es único";
            //     let msg_error = "El nro de lote "+$(this).val()+" ya existe. Intente nuevamente";
            //     mostrar_resultados_validacion($(this), respuesta, msg_ok, msg_error);
            // });
            // //VALIDACION CAMPO CODIGO LOTE (FORMULARIO REGISTRO DE LOTE)
            // $('#lot_codigo').focusout(function(){
            //     let respuesta = validar_campo("lotes/valida_lot_codigo", "lot_codigo", $(this).val(), "lote", $(this).attr('data-urbid'));
            //     let msg_ok = "El código de lote"+$(this).val()+" es único";
            //     let msg_error = "El código de lote "+$(this).val()+" ya existe. Intente nuevamente";
            //     mostrar_resultados_validacion($(this), respuesta, msg_ok, msg_error);
            // });
            // //VALIDACION CAMPO NRO LOTE (FORMULARIO REGISTRO DE LOTE)
            // $('#lot_matricula').focusout(function(){
            //     let respuesta = validar_campo("lotes/valida_lot_matricula", "lot_matricula", $(this).val(), "lote", $(this).attr('data-urbid'));
            //     let msg_ok = "La matricula de lote"+$(this).val()+" es único";
            //     let msg_error = "La matricula de lote "+$(this).val()+" ya existe. Intente nuevamente";
            //     mostrar_resultados_validacion($(this), respuesta, msg_ok, msg_error);
            // });






            //---------------------------------------------------------------------
            // JAVASCRIPT ANTERIOR VERSION
            //---------------------------------------------------------------------

            //OCULTA LAS ALERTA DE MENSAJES DE FORMULARIO
            $('.save_success').hide();
            $('.save_error').hide();
            /*
            *FUNCION PARA GUARDAR CUALQUIER FORMULARIO
            * trigger_element Elemento de DOM (boton) que lanza el evento
            * form_id ID del formulario en HTML
            * route_save_method URL del controlador que procesará los datos del formulario
            * route_destination URL de redirección en caso de exito
            * route_error URL de redirección en caso de error en el proceso
            */
            function guardar_formulario(trigger_element, form_id, route_save_method, route_destination){
                trigger_element.attr('disabled','true');
                $.ajax({
                        type: "POST",
                        url: route_save_method,
                        data: $(form_id).serialize(),
                        dataType: 'json',
                        success: function(data){
                            if(data.status == 1){
                                $('.save_success').slideDown(1000);
                                setTimeout(function(){ window.location.replace(route_destination); }, 2500);
                            }else{
                                $('.save_error').slideDown(1000);
                                trigger_element.removeAttr('disabled');
                                setTimeout(function(){$('.save_error').slideUp(1000);}, 5000);
                            }
                        },
                        error: function(data){
        
                        }
                });
            }
            // GUARDAR
            $('#guardar_tratamiento').click(function(){
                var rsm = '{{url('tratamientos/guardar')}}';
                var rd = '{{url('tratamientos/lista')}}';
                guardar_formulario($(this),'#form-tratamiento',rsm,rd);
            });
        });
        </script>
        
</body>
</html>