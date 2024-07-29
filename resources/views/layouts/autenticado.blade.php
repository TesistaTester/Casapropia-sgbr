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
                        <li class="nav-item active">
                            <a class="nav-link" href="#">
                                <i class="fa fa-home"></i> INICIO <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fa fa-book"></i> GUIA DE USUARIO</span>
                            </a>
                        </li>
                        <!-- <li class="nav-item dropdown">
                             <a id="btn-menu-modulos" class="nav-link" href="#" data-toggle="dropdown" data-target="#menu_principal">
                                 <i class="fa fa-th"></i>
                                 MODULOS
                             </a>
                         <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                 <a class="dropdown-item" href="#"><i class="fa fa-map"></i> ADMINISTRACIÓN DE PROPIEDADES</a>
                                 <a class="dropdown-item" href="#"><i class="fa fa-bookmark"></i> ADMINISTRACIÓN DE VENTAS</a>
                                 <a class="dropdown-item" href="#"><i class="fa fa-file"></i> ADMINISTRACIÓN DE CONTRATOS</a>
                                 <a class="dropdown-item" href="#"><i class="fa fa-user"></i> ADMINISTRACIÓN DE USUARIOS</a>
                                 <a class="dropdown-item" href="#"><i class="fa fa-line-chart"></i> ADMINISTRACIÓN DE REPORTES</a>
                             </div>
                         </li> -->
                    </ul>
                    <div class="btn-group">
                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user"></i>
                            Cuenta de usuario
                        </button>
                        <div class="dropdown-menu dropdown-menu-right dropdown-user-profile" style="padding:0 !important;">
                            <div class="card card-user">
                                <img style="width:60%; margin:10px auto 0 auto;" class="rounded-circle" src="{{ asset('img/default.jpg')}}" alt="Foto de perfil">
                                <div class="card-body text-center" style="padding:10px;">
                                    <h4 class="text-white">JOSE MARIA
                                        <br><small>RIVERO LOPEZ</small>
                                        <br><small class="text-uppercase text-success" style="font-size:0.6em;">PROPIETARIO</small>
                                    </h4>
                                    <div class="box-user-menu">
                                        <a href="#" class="dropdown-item"><i class="fa fa-user"></i> Ver perfil</a>
                                        <a href="#" class="dropdown-item"><i class="fa fa-lock"></i> Actualizar password</a>
                                        <a href="#" class="dropdown-item"><i class="fa fa-random"></i> Cambiar rol</a>
                                        <a href="#" class="dropdown-item"><i class="fa fa-sign-out"></i> Cerrar sesión</a>
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
                <div class="text-center">
                    <img style="width:50%; margin:10px auto 0 auto;" class="rounded-circle" src="{{ asset('img/default.jpg')}}" alt="Foto de perfil">
                    <h4 class="text-white">JOSE MARIA
                        <br><small>RIVERO LOPEZ</small>
                        <br><small class="text-uppercase text-success" style="font-size:0.6em;">superadmin</small>
                    </h4>
                </div>
                <hr>
                    <h4 class="text-center text-white" style="text-transform: uppercase;">
                        <small>- MODULOS -</small>
                    </h4>
                    <nav class="nav nav-pills" aria-orientation="vertical">
                        <a class="nav-item nav-link @if($modulo_activo == 'urbanizaciones'): active @endif" href="{{url('urbanizaciones')}}"><i class="fa fa-building"></i> URBANIZACIONES</a>
                        <a class="nav-item nav-link @if($modulo_activo == 'propietarios'): active @endif" href="{{url('propietarios')}}"><i class="fa fa-key"></i> PROPIETARIOS</a>
                        <a class="nav-item nav-link @if($modulo_activo == 'clientes'): active @endif" href="{{url('clientes')}}"><i class="fa fa-id-card"></i> CLIENTES</a>
                        <a class="nav-item nav-link @if($modulo_activo == 'reservas'): active @endif" href="{{url('reservas')}}"><i class="fa fa-tag"></i> RESERVAS</a>
                        <a class="nav-item nav-link @if($modulo_activo == 'contratos'): active @endif" href="{{url('contratos')}}"><i class="fa fa-file"></i> CONTRATOS</a>
                        <a class="nav-item nav-link @if($modulo_activo == 'usuarios'): active @endif" href="{{url('usuarios')}}"><i class="fa fa-users"></i> USUARIOS</a>
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


    <script src="{{url('js/particles.min.js')}}"></script>
    <script src="{{url('js/int.particles.js')}}"></script>

    <script>
        $(function(){
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
                    return false;
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

            //VALIDACION CAMPO NRO LOTE (FORMULARIO REGISTRO DE LOTE)
            $('#lot_nro').focusout(function(){
                let respuesta = validar_campo("lotes/valida_lot_nro", "lot_nro", $(this).val(), "lote", $(this).attr('data-urbid'));
                let msg_ok = "El nro de lote"+$(this).val()+" es único";
                let msg_error = "El nro de lote "+$(this).val()+" ya existe. Intente nuevamente";
                mostrar_resultados_validacion($(this), respuesta, msg_ok, msg_error);
            });
            //VALIDACION CAMPO CODIGO LOTE (FORMULARIO REGISTRO DE LOTE)
            $('#lot_codigo').focusout(function(){
                let respuesta = validar_campo("lotes/valida_lot_codigo", "lot_codigo", $(this).val(), "lote", $(this).attr('data-urbid'));
                let msg_ok = "El código de lote"+$(this).val()+" es único";
                let msg_error = "El código de lote "+$(this).val()+" ya existe. Intente nuevamente";
                mostrar_resultados_validacion($(this), respuesta, msg_ok, msg_error);
            });
            //VALIDACION CAMPO NRO LOTE (FORMULARIO REGISTRO DE LOTE)
            $('#lot_matricula').focusout(function(){
                let respuesta = validar_campo("lotes/valida_lot_matricula", "lot_matricula", $(this).val(), "lote", $(this).attr('data-urbid'));
                let msg_ok = "La matricula de lote"+$(this).val()+" es único";
                let msg_error = "La matricula de lote "+$(this).val()+" ya existe. Intente nuevamente";
                mostrar_resultados_validacion($(this), respuesta, msg_ok, msg_error);
            });






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