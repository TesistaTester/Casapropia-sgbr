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
								<form enctype="multipart/form-data" id="form-nuevo-cliente" action="{{url('clientes')}}" method="POST" data-validation1="{{url('clientes/valida_cliente')}}">
								  @csrf
									<div class="alert alert-info">
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
									</div>
								  <section id="seccion-tipo-cliente">
									<h4 class="card-title"><strong><span class="text-primary">
										<i class="fa fa-tag"></i>
										Tipo de cliente a registrar
									</span></strong></h4>
									<hr>
									<small>Los campos marcados con asterisco (<span class="text-danger">*</span>) son obligatorios.</small>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label class="label-blue label-block" for="">
													Tipo de cliente:
													<span class="text-danger">*</span>
													<i class="fa fa-question-circle float-right" title="Establecer el tipo de cliente"></i>
												</label>
												<select required name="per_tipo_persona" id="per_tipo_persona" class="form-control @error('per_tipo_persona') is-invalid @enderror">
													<option value="">Seleccione una opción</option>
													<option value="0" {{ old('per_tipo_documento', '0') == '0' ? 'selected' : '' }}>Persona natural</option>
													<option value="1" {{ old('per_tipo_documento') == '1' ? 'selected' : '' }}>Persona juridica</option>
												</select>
												@error('per_tipo_persona')
												<div class="invalid-feedback">
													{{$message}}
												</div>											
												@enderror
											</div>
										</div>
										<div class="col-md-8">
											<section id="seccion-nombre-comercial">
														<div class="form-group">
															<label class="label-blue label-block" for="">
																Nombre comercial:
																<span class="text-danger">*</span>
																<i class="fa fa-question-circle float-right" title="Establecer el nombre comercial de la empresa"></i>
															</label>
															<input required type="text" value="{{old('per_nombre_comercial','ninguno')}}" class="form-control @error('per_nombre_comercial') is-invalid @enderror" name="per_nombre_comercial" id="per_nombre_comercial" placeholder="Nombre comercial de la empresa o negocio">
														@error('per_nombre_comercial')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
											  </section>
										</div>
									</div>
								  </section>


								  
								  <section id="seccion-datos-personales">
									<h4 class="card-title"><strong><span class="text-primary">
										<i class="fa fa-database"></i>
										Datos personales <span id="txt-representante-empresa"></span>
									</span></strong></h4>
									<hr>
									<div class="row">
										<div class="col-md-8">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
															<label class="label-blue label-block" for="">
																Tipo de documento:
																<span class="text-danger">*</span>
																<i class="fa fa-question-circle float-right" title="Establecer el tipo de documento de la persona"></i>
															</label>
														<select required name="per_tipo_documento" id="per_tipo_documento" class="form-control @error('per_tipo_documento') is-invalid @enderror">
															<option value="">Seleccione una opción</option>
															<option value="0" {{ old('per_tipo_documento') == '0' ? 'selected' : '' }}>Cédula de identidad</option>
															<option value="1" {{ old('per_tipo_documento') == '1' ? 'selected' : '' }}>Libreta de servicio militar</option>
															<option value="2" {{ old('per_tipo_documento') == '2' ? 'selected' : '' }}>Otro</option>
														</select>
														@error('per_tipo_documento')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
															<label class="label-blue label-block" for="">
																Número de documento de identificación:
																<span class="text-danger">*</span>
																<i class="fa fa-question-circle float-right" title="Establecer el número de documento de identificación de la persona"></i>
															</label>
														<input required type="text" value="{{old('per_nro_id')}}" class="form-control @error('per_nro_id') is-invalid @enderror" name="per_nro_id" id="per_nro_id" placeholder="Número de documento">
														@error('per_nro_id')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
															<label class="label-blue label-block" for="">
																Expedido en:
																<span class="text-danger">*</span>
																<i class="fa fa-question-circle float-right" title="Establecer el lugar donde fue expedido el documento"></i>
															</label>
														<select required class="form-control @error('per_expedido') is-invalid @enderror" name="per_expedido" id="per_expedido">
															<option value="">Seleccione una opción</option>
															<option value="LP" {{ old('per_expedido') == 'LP' ? 'selected' : '' }}>LA PAZ</option>
															<option value="OR"{{ old('per_expedido') == 'OR' ? 'selected' : '' }}>ORURO</option>
															<option value="PT"{{ old('per_expedido') == 'PT' ? 'selected' : '' }}>POTOSÍ</option>
															<option value="CB"{{ old('per_expedido') == 'CB' ? 'selected' : '' }}>COCHABAMBA</option>
															<option value="CH"{{ old('per_expedido') == 'CH' ? 'selected' : '' }}>CHUQUISACA</option>
															<option value="TJ"{{ old('per_expedido') == 'TJ' ? 'selected' : '' }}>TARIJA</option>
															<option value="PN"{{ old('per_expedido') == 'PN' ? 'selected' : '' }}>PANDO</option>
															<option value="BN"{{ old('per_expedido') == 'BN' ? 'selected' : '' }}>BENI</option>
															<option value="SC"{{ old('per_expedido') == 'SC' ? 'selected' : '' }}>SANTA CRUZ</option>
														</select>
														@error('per_expedido')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
															<label class="label-blue label-block" for="">
																Nombres:
																<span class="text-danger">*</span>
																<i class="fa fa-question-circle float-right" title="Establecer los nombres de las personas"></i>
															</label>
														<input required type="text" value="{{old('per_nombres')}}" class="form-control @error('per_nombres') is-invalid @enderror" name="per_nombres" id="per_nombres" placeholder="Nombres">
														@error('per_nombres')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
															<label class="label-blue label-block" for="">
																Primer apellido:
																<span class="text-danger">*</span>
																<i class="fa fa-question-circle float-right" title="Establecer el primer apellido de la persona"></i>
															</label>
														<input required type="text" value="{{old('per_primer_apellido')}}" class="form-control @error('per_primer_apellido') is-invalid @enderror" name="per_primer_apellido" id="per_primer_apellido" placeholder="Primer apellido">
														@error('per_primer_apellido')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
															<label class="label-blue label-block" for="">
																Segundo apellido:
																<span class="text-danger">*</span>
																<i class="fa fa-question-circle float-right" title="Establecer el segundo apellido de la persona"></i>
															</label>
														<input required type="text" value="{{old('per_segundo_apellido')}}" class="form-control @error('per_segundo_apellido') is-invalid @enderror" name="per_segundo_apellido" id="per_segundo_apellido" placeholder="Segundo apellido">
														@error('per_segundo_apellido')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
															<label class="label-blue label-block" for="">
																Fecha de nacimiento:
																<span class="text-danger">*</span>
																<i class="fa fa-question-circle float-right" title="Establecer la fecha de nacimiento de la persona"></i>
															</label>
														<input required type="date" value="{{old('per_fecha_nacimiento')}}" class="form-control @error('per_fecha_nacimiento') is-invalid @enderror" name="per_fecha_nacimiento" id="per_fecha_nacimiento" placeholder="Fecha de nacimiento">
														@error('per_fecha_nacimiento')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
															<label class="label-blue label-block" for="">
																Género:
																<span class="text-danger">*</span>
																<i class="fa fa-question-circle float-right" title="Establecer el género de la persona"></i>
															</label>
															<select required class="form-control @error('per_sexo') is-invalid @enderror" name="per_sexo" id="per_sexo">
																<option value="">Seleccione una opción</option>
																<option value="M" {{ old('per_sexo') == 'M' ? 'selected' : '' }}>Masculino</option>
																<option value="F" {{ old('per_sexo') == 'F' ? 'selected' : '' }}>Femenino</option>
																<option value="O" {{ old('per_sexo') == 'O' ? 'selected' : '' }}>Otro</option>
															</select>
															@error('per_sexo')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
															<label class="label-blue label-block" for="">
																Estado civil:
																<span class="text-danger">*</span>
																<i class="fa fa-question-circle float-right" title="Establecer el estado civil de la persona"></i>
															</label>
															<select required class="form-control @error('per_estado_civil') is-invalid @enderror" name="per_estado_civil" id="per_estado_civil">
																<option value="">Seleccione una opción</option>
																<option value="0" {{ old('per_estado_civil') == '0' ? 'selected' : '' }}>Soltero</option>
																<option value="1" {{ old('per_estado_civil') == '1' ? 'selected' : '' }}>Casado</option>
																<option value="2" {{ old('per_estado_civil') == '2' ? 'selected' : '' }}>Concubinato</option>
																<option value="3" {{ old('per_estado_civil') == '3' ? 'selected' : '' }}>Viudo</option>
																<option value="4" {{ old('per_estado_civil') == '4' ? 'selected' : '' }}>Divorciado</option>
																<option value="5" {{ old('per_estado_civil') == '5' ? 'selected' : '' }}>Otro</option>
															</select>
														@error('per_estado_civil')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="row">
												<div class="col-md-12">
													<label class="label-blue label-block" for="">
														Fotografía cliente:
														<span class="text-danger">*</span>
														<i class="fa fa-question-circle float-right" title="Establecer la fotografía del cliente"></i>
													</label>
													<div class="text-center">
														<img src="{{asset('img/default.jpg')}}" id="preview" class="img-thumbnail" style="width:60%; margin-bottom:7px;">
													</div>
													<input required type="file" name="cli_foto" id="cli_foto" class="form-control file @error('cli_copia_ci') is-invalid @enderror" accept="image/*">
													{{-- <div class="input-group my-3">
													  <input type="text" name="cli_foto_text" class="form-control" disabled placeholder="Seleccionar foto" id="file">
													  <div class="input-group-append">
														<button type="button" class="browse btn btn-primary"><i class="fa fa-camera"></i></button>
													  </div>
													</div> --}}
													@error('cli_foto')
													<div class="invalid-feedback">
														{{$message}}
													</div>											
													@enderror

												</div>
											</div>
											<br>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
															<label class="label-blue label-block" for="">
																Documento de identificación PDF:
																<span class="text-danger">*</span>
																<i class="fa fa-question-circle float-right" title="Cargar el PDF escaneado del documento de identificación del cliente. Si fuera más de un documento, escanear varios archivos físicos en un solo PDF."></i>
															</label>
														<input required type="file" value="{{old('cli_copia_ci')}}" accept="application/pdf" class="form-control @error('cli_copia_ci') is-invalid @enderror" name="cli_copia_ci" id="cli_copia_ci" placeholder="PDF documento identificación">
														@error('cli_copia_ci')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
											</div>
										</div>
									</div>


									{{-- <div class="row">
										<div class="col-md-4 offset-md-8 text-right">
											<button type="submit" href="#" id="next-domicilio" class="btn btn-secondary">
													Siguiente
													<i class="fa fa-chevron-right"></i>
											</button>
										</div>
									</div> --}}
								  </section>

  								  <section id="seccion-domicilio">
										<h4 class="card-title"><strong><span class="text-primary">
											<i class="fa fa-home"></i>
											Datos del domicilio y actividad económica <span id="txt-domicilio-empresa"></span>
										</span></strong></h4>
										<hr>
										<small>Los campos marcados con asterisco (<span class="text-danger">*</span>) son obligatorios.</small>
										<h5>DATOS DEL DOMICILIO</h5>
										<div class="row">
											<div class="col-md-5">
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="label-blue label-block" for="">
																Tipo de domicilio:
																<span class="text-danger">*</span>
																<i class="fa fa-question-circle float-right" title="Establecer el tipo de domicilio"></i>
															</label>
															<select required class="form-control @error('dom_tipo') is-invalid @enderror" name="dom_tipo" id="dom_tipo">
																<option value="">Seleccione una opción</option>
																<option value="0"{{ old('dom_tipo') == '0' ? 'selected' : '' }}>ALQUILER</option>
																<option value="1"{{ old('dom_tipo') == '1' ? 'selected' : '' }}>ANTICRETICO</option>
																<option value="2" {{ old('dom_tipo') == '2' ? 'selected' : '' }}>PROPIO</option>
																<option value="3"{{ old('dom_tipo') == '3' ? 'selected' : '' }}>OTRO</option>
															</select>
															@error('dom_tipo')
															<div class="invalid-feedback">
																{{$message}}
															</div>											
															@enderror
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="label-blue label-block" for="">
																Departamento:
																<span class="text-danger">*</span>
																<i class="fa fa-question-circle float-right" title="Establecer el pais donde está el domicilio del cliente"></i>
															</label>
															<select required name="dep_id" id="dep_id" class="form-control @error('dep_id') is-invalid @enderror" data-municipio-change="{{url('departamentos')}}">
																<option value="">Seleccione una opción</option>
																@foreach($departamentos as $item)
																<option value="{{$item->dep_id}}" {{ old('dep_id') == $item->dep_id ? 'selected' : '' }}>{{$item->dep_nombre}}</option>
																@endforeach
															</select>
															@error('dep_id')
															<div class="invalid-feedback">
																{{$message}}
															</div>											
															@enderror
														</div>
												</div>
												<div class="row">
													</div>
													<div class="col-md-6">
														<div class="form-group">
																<label class="label-blue label-block" for="">
																	Municipio:
																	<span class="text-danger">*</span>
																	<i class="fa fa-question-circle float-right" title="Establecer el número de documento de la persona"></i>
																</label>
																<select required name="mun_id" id="mun_id" class="form-control search-municipio @error('mun_id') is-invalid @enderror">
																	<option value="">Seleccione una opción</option>
																</select>
																@error('mun_id')
																<div class="invalid-feedback">
																	{{$message}}
																</div>											
																@enderror
															</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="label-blue label-block" for="">
																Zona:
																<span class="text-danger">*</span>
																<i class="fa fa-question-circle float-right" title="Establecer la zona donde está ubicado el domicilio"></i>
															</label>
															<input required type="text" value="{{old('dom_zona')}}" class="form-control @error('dom_zona') is-invalid @enderror" name="dom_zona" id="dom_zona" placeholder="Zona">
															@error('dom_zona')
															<div class="invalid-feedback">
																{{$message}}
															</div>											
															@enderror
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="label-blue label-block" for="">
																Calle/Avenida:
																<span class="text-danger">*</span>
																<i class="fa fa-question-circle float-right" title="Establecer la calle o avenida donde está ubicado el domicilio"></i>
															</label>
															<input required type="text" value="{{old('dom_calle_avenida')}}" class="form-control @error('dom_calle_avenida') is-invalid @enderror" name="dom_calle_avenida" id="dom_calle_avenida" placeholder="Calle/Avenida">
															@error('dom_calle_avenida')
															<div class="invalid-feedback">
																{{$message}}
															</div>											
															@enderror
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
																<label class="label-blue label-block" for="">
																	Número:
																	<span class="text-danger">*</span>
																	<i class="fa fa-question-circle float-right" title="Establecer el número de documento de la persona"></i>
																</label>
																<input  type="text" value="{{old('dom_nro')}}" class="form-control @error('dom_nro') is-invalid @enderror" name="dom_nro" id="dom_nro" placeholder="Nro domicilio">
																@error('dom_nro')
																<div class="invalid-feedback">
																	{{$message}}
																</div>											
																@enderror
															</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="label-blue label-block" for="">
																Latitud:
																<i class="fa fa-question-circle float-right" title="Establecer la latitud del domicilio"></i>
															</label>
															<input type="text" value="{{old('dom_latitud', 0)}}" class="form-control @error('dom_latitud') is-invalid @enderror" name="dom_latitud" id="dom_latitud" placeholder="Latitud" readonly>
															@error('dom_latitud')
															<div class="invalid-feedback">
																{{$message}}
															</div>											
															@enderror
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
																<label class="label-blue label-block" for="">
																	Longitud:
																	<i class="fa fa-question-circle float-right" title="Establecer la longitud del domicilio"></i>
																</label>
																<input  type="text" value="{{old('dom_longitud', 0)}}" class="form-control @error('dom_longitud') is-invalid @enderror" name="dom_longitud" id="dom_longitud" placeholder="Longitud" readonly>
																@error('dom_longitud')
																<div class="invalid-feedback">
																	{{$message}}
																</div>											
																@enderror
															</div>
													</div>
												</div>
											</div>
											<div class="col-md-7">
												<label class="label-blue label-block" for="">
													Georeferenciar domicilio:
													<i class="fa fa-question-circle float-right" title="Establecer georeferenciación del domicilio"></i>
												</label>
												<div id="mapa-domicilio" style="width:100%; height: 300px;"></div>
											</div>
										</div>
										<hr>
									<div class="row">
										<div class="col-md-5">
											<h5>DATOS DE LA ACTIVIDAD ECONÓMICA</h5>
											<div class="form-group">
												<label class="label-blue label-block" for="">
													Actividad económica:
													<span class="text-danger">*</span>
													<i class="fa fa-question-circle float-right" title="Establecer la actividad económica del cliente"></i>
												</label>
												<select required name="ace_id" id="ace_id" class="form-control search-actividad-economica @error('ace_id') is-invalid @enderror">
													<option value="">Seleccione una opción</option>
													@foreach($actividades as $item)
													<option value="{{$item->ace_id}}" {{ old('ace_id') == $item->ace_id ? 'selected' : '' }}>{{$item->ace_descripcion}}</option>
													@endforeach
												</select>
												@error('ace_id')
												<div class="invalid-feedback">
													{{$message}}
												</div>											
												@enderror
											</div>
										</div>
									</div>
									{{-- <div class="row">
										<div class="col-md-4 offset-md-8 text-right">
											<a href="#" id="ant-personales" class="btn btn-secondary">
													<i class="fa fa-chevron-left"></i>
													Anterior
											</a>
											<button type="submit" id="next-contacto" class="btn btn-secondary">
													<i class="fa fa-chevron-right"></i>
													Siguiente
											</button>
										</div>
									</div> --}}

								    </section>

									<section id="seccion-contacto">
										<h4 class="card-title"><strong><span class="text-primary">
											<i class="fa fa-phone-square"></i>
											Datos de contacto
										</span></strong></h4>
										<hr>
										<small>Los campos marcados con asterisco (<span class="text-danger">*</span>) son obligatorios.</small>
										<h5>CORREO ELECTRÓNICO & TELEFONO DEL CLIENTE</h5>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
														<label class="label-blue label-block" for="">
															Correo electrónico:
															<i class="fa fa-question-circle float-right" title="Establecer la dirección de correo electrónico"></i>
														</label>
													<input  type="email" value="{{old('cli_email')}}" class="form-control @error('cli_email') is-invalid @enderror" name="cli_email" id="cli_email" placeholder="E-mail">
													@error('cli_email')
													<div class="invalid-feedback">
														{{$message}}
													</div>											
													@enderror
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
														<label class="label-blue label-block" for="">
															Nro de Teléfono/celular:
															<i class="fa fa-question-circle float-right" title="Establecer el número de telefono o celular del cliente"></i>
														</label>
													<input  type="text" value="{{old('cli_telefono')}}" class="form-control @error('cli_telefono') is-invalid @enderror" name="cli_telefono" id="cli_telefono" placeholder="Nro celular">
													@error('cli_telefono')
													<div class="invalid-feedback">
														{{$message}}
													</div>											
													@enderror
												</div>
											</div>
										</div>

										<h5>PERSONA DE REFERENCIA</h5>
										<div class="row">
											<div class="col-md-3">
												<div class="form-group">
														<label class="label-blue label-block" for="">
															Nombres:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer los nombres de la persona de referencia"></i>
														</label>
													<input required type="text" value="{{old('pre_nombres')}}" class="form-control @error('pre_nombres') is-invalid @enderror" name="pre_nombres" id="pre_nombres" placeholder="Nombres">
													@error('pre_nombres')
													<div class="invalid-feedback">
														{{$message}}
													</div>											
													@enderror
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
														<label class="label-blue label-block" for="">
															Primer apellido:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer el primer apellido de la persona de referencia"></i>
														</label>
													<input required type="text" value="{{old('pre_primer_apellido')}}" class="form-control @error('pre_primer_apellido') is-invalid @enderror" name="pre_primer_apellido" id="pre_primer_apellido" placeholder="Primer apellido">
													@error('pre_primer_apellido')
													<div class="invalid-feedback">
														{{$message}}
													</div>											
													@enderror
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
														<label class="label-blue label-block" for="">
															Segundo apellido:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer el segundo apellido de la persona de referencia"></i>
														</label>
													<input required type="text" value="{{old('pre_segundo_apellido')}}" class="form-control @error('pre_segundo_apellido') is-invalid @enderror" name="pre_segundo_apellido" id="pre_segundo_apellido" placeholder="Segundo apellido">
													@error('pre_segundo_apellido')
													<div class="invalid-feedback">
														{{$message}}
													</div>											
													@enderror
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
														<label class="label-blue label-block" for="">
															Parentesto:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer el grado de parentesco"></i>
														</label>
														<select required class="form-control @error('pre_parentesco') is-invalid @enderror" name="pre_parentesco" id="pre_parentesco">
															<option value="">Seleccione una opción</option>
															<option value="0"{{ old('pre_parentesco') == '0' ? 'selected' : '' }}>PADRE/MADRE</option>
															<option value="1"{{ old('pre_parentesco') == '1' ? 'selected' : '' }}>HIJO(A)</option>
															<option value="2"{{ old('pre_parentesco') == '2' ? 'selected' : '' }}>ESPOSO(A)/CONYUGUE</option>
															<option value="3"{{ old('pre_parentesco') == '3' ? 'selected' : '' }}>HERMANO(A)</option>
															<option value="4"{{ old('pre_parentesco') == '4' ? 'selected' : '' }}>ABUELO(A)</option>
															<option value="5"{{ old('pre_parentesco') == '5' ? 'selected' : '' }}>NIETO(A)</option>
															<option value="6"{{ old('pre_parentesco') == '6' ? 'selected' : '' }}>TIO(A)</option>
															<option value="7"{{ old('pre_parentesco') == '7' ? 'selected' : '' }}>SOBRINO(A)</option>
															<option value="8"{{ old('pre_parentesco') == '8' ? 'selected' : '' }}>OTRO</option>
														</select>
												@error('pre_parentesco')
													<div class="invalid-feedback">
														{{$message}}
													</div>											
													@enderror
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
														<label class="label-blue label-block" for="">
															Telefono:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer el telefono de contacto de la persona de referencia"></i>
														</label>
													<input required type="text" value="{{old('pre_telefono')}}" class="form-control @error('pre_telefono') is-invalid @enderror" name="pre_telefono" id="pre_telefono" placeholder="Nro de teléfono">
													@error('pre_telefono')
													<div class="invalid-feedback">
														{{$message}}
													</div>											
													@enderror
												</div>
											</div>
										</div>
										<h5>CONTACTO CON CASA PROPIA</h5>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
														<label class="label-blue label-block" for="">
															¿Cómo conoció la oferta inmobiliaria de CASA PROPIA?:
															<span class="text-danger">*</span>
															<i class="fa fa-question-circle float-right" title="Establecer el segundo apellido de la persona"></i>
														</label>
														<select required multiple class="form-control select-multi @error('foc_id') is-invalid @enderror" name="foc_id[]" id="foc_id">
															<option value="">Seleccione una opción</option>
															@foreach ($formas_contacto as $item)
															<option value="{{$item->foc_id}}" {{ old('foc_id') == $item->foc_id ? 'selected' : '' }}>{{$item->foc_medio}}</option>
															@endforeach
														</select>
													@error('foc_id[]')
													<div class="invalid-feedback">
														{{$message}}
													</div>											
													@enderror
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6 offset-md-6 text-right">
												<button type="reset" id="btn-reestablecer-form" class="btn btn-danger">
														<i class="fa fa-refresh"></i>
														Resetear formulario
												</button>
												<a href="#" id="ant-domicilio" class="btn btn-secondary">
													<i class="fa fa-chevron-left"></i>
													Anterior
											</a>
												<input type="text" name="per_id" id="per_id" value="0">
												<button type="submit" class="btn btn-primary">
														<i class="fa fa-save"></i>
														Guardar datos
												</button>
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

	

<script>
$(function(){
	//select2 buscador
	$('.search-municipio, .search-actividad-economica').select2({language:"es"});
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
	var mymap = L.map('mapa-domicilio').setView([-16.50357853577617,-68.16282717846254], 13);
	//AGREGAR MARCADOR
	var marker = L.marker(new L.LatLng(-16.50357853577617,-68.16282717846254), {
							draggable: true
				}).addTo(mymap);
	marker.bindPopup('Mover el marcador para<br>apuntar en la ubicación<br>georeferenciada del domicilio.').openPopup();
	marker.on('dragend', function (e) {
		document.getElementById('dom_latitud').value = marker.getLatLng().lat;
		document.getElementById('dom_longitud').value = marker.getLatLng().lng;
	});


	//CAPA BASE
	var map_token = '{{config('casapropia.MAPBOX_ACCESS_TOKEN')}}';
	L.tileLayer("https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token="+map_token, {
				maxZoom: 20,
				attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
					'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
					'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
				id: 'mapbox/streets-v11',
				tileSize: 512,
				zoomOffset: -1
			}).addTo(mymap);
	</script>


    @endsection