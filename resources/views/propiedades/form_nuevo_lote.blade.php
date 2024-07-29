@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')
<div class="col-md-10 content-pane">
    <h3 class="title-header" style="text-transform: uppercase;">
        <i class="fa fa-plus"></i>
        {{$titulo}}
        <a title="Volver a lista de urbanizaciones" data-placement="top" class="btn btn-sm btn-secondary float-right" style="margin-left:10px;" href="{{url('urbanizaciones/'.Crypt::encryptString($urbanizacion->urb_id))}}"><i class="fa fa-angle-double-left"></i> ATRÁS</a>
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
                            <form action="{{url('lotes')}}" method="POST">
                            @csrf
                            <input type="hidden" name="urb_id" value="{{$urbanizacion->urb_id}}">
                            <div class="row">
                                <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="label-blue label-block" for="">
                                                Manzano:
                                                <span class="text-danger">*</span>
                                                <i class="fa fa-question-circle float-right" title="Seleccionar el manzano donde está el lote"></i>
                                            </label>
                                            <select required name="man_id" class="form-control @error('man_id') is-invalid @enderror">
                                                <option value="">Seleccione un manzano</option>
                                                @foreach($urbanizacion->manzanos as $item)
                                                @if(old('man_id') == $item->man_id)
                                                <option value="{{$item->man_id}}" selected>{{$item->man_nombre}}</option>
                                                @else
                                                <option value="{{$item->man_id}}">{{$item->man_nombre}}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                            @error('man_id')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>											
                                            @enderror
                                      </div>
                                      <div class="form-group">
                                            <label class="label-blue label-block" for="">
                                                Nro lote:
                                                <span class="text-danger">*</span>
                                                <i class="fa fa-question-circle float-right" title="Establecer un número de lote"></i>
                                            </label>
                                        <input required data-urbid="{{$urbanizacion->urb_id}}" type="text" id="lot_nro" name="lot_nro" value="{{old('lot_nro')}}" class="form-control @error('man_id') is-invalid @enderror" placeholder="Nro lote">
                                        @error('lot_nro')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>											
                                        @enderror
                                  </div>
                                      <div class="form-group">
                                            <label class="label-blue label-block" for="">
                                                Código lote:
                                                <i class="fa fa-question-circle float-right" title="Establecer un código de lote"></i>
                                            </label>
                                        <input data-urbid="{{$urbanizacion->urb_id}}" type="text" id="lot_codigo" name="lot_codigo" value="{{old('lot_codigo')}}" class="form-control @error('lot_codigo') is-invalid @enderror" placeholder="Cod. Lote">
                                        @error('lot_codigo')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>											
                                        @enderror
                                  </div>
                                        <div class="form-group">
                                            <label class="label-blue label-block" for="">
                                                Matricula lote:
                                                <i class="fa fa-question-circle float-right" title="Establecer una matricula de lote"></i>
                                            </label>
                                        <input data-urbid="{{$urbanizacion->urb_id}}" type="text" id="lot_matricula" name="lot_matricula" value="{{old('lot_matricula')}}" class="form-control @error('lot_matricula') is-invalid @enderror" placeholder="Matricula. Lote">
                                        @error('lot_matricula')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>											
                                        @enderror
                                  </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="label-blue label-block" for="">
                                            Superficie total (m2):
                                            <span class="text-danger">*</span>
                                            <i class="fa fa-question-circle float-right" title="Establecer la superficie total del lote en metros cuadrados"></i>
                                        </label>
                                        <input required pattern="[0-9]+([\.][0-9]{0,2})?" value="{{old('pro_superficie')}}" type="number" min="0" step=".1" name="pro_superficie" class="form-control @error('pro_superficie') is-invalid @enderror" placeholder="Sup Total Metros Cuadrados">
                                        @error('pro_superficie')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>											
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="label-blue label-block" for="">
                                            Superficie construida (m2):
                                            <i class="fa fa-question-circle float-right" title="Establecer la superficie construida del lote en metros cuadrados (si corresponde)"></i>
                                        </label>
                                        <input type="number" pattern="[0-9]+([\.][0-9]{0,2})?" value="{{old('lot_superficie_construida')}}" min="0" step=".1" name="lot_superficie_construida" class="form-control @error('lot_superficie_construida') is-invalid @enderror" placeholder="Sup Const Metros Cuadrados">
                                        @error('lot_superficie_construida')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>											
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="label-blue label-block" for="">
                                            Ancho de via (m):
                                            <span class="text-danger">*</span>
                                            <i class="fa fa-question-circle float-right" title="Establecer el ancho de vía del lote en metros"></i>
                                        </label>
                                        <input required type="number" pattern="[0-9]+([\.][0-9]{0,2})? " value="{{old('lot_ancho_via')}}" min="0" step=".1" name="lot_ancho_via" class="form-control @error('lot_ancho_via') is-invalid @enderror" placeholder="Ancho Via Metros Lineal">
                                        @error('lot_ancho_via')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>											
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="label-blue label-block" for="">
                                            Muro perimetral (m):
                                            <i class="fa fa-question-circle float-right" title="Establecer la longitud del muro perimetral en metros (si corresponde)"></i>
                                        </label>
                                        <input type="number" min="0" pattern="[0-9]+([\.][0-9]{0,2})?" value="{{old('pro_muro_perimetral')}}" step=".1" name="pro_muro_perimetral" class="form-control @error('pro_muro_perimetral') is-invalid @enderror" placeholder="Muro Metros Lineal">
                                        @error('pro_muro_perimetral')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>											
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="label-blue label-block" for="">
                                            Ubicación referencial:
                                            <span class="text-danger">*</span>
                                            <i class="fa fa-question-circle float-right" title="Establecer la ubicación referencial del lote. Puede seleccionar más de una opción."></i>
                                        </label>
                                        <select required name="ubi_id[]" multiple="multiple" class="form-control select-multi @error('ubi_id') is-invalid @enderror">
                                            {{-- <option value="">Seleccione ubicaciones</option> --}}
                                            @foreach($ubicaciones as $item)
                                            <option value="{{$item->ubi_id}}">{{$item->ubi_descripcion}}</option>
                                            @endforeach
                                        </select>
                                        @error('ubi_id')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>											
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="label-blue label-block" for="">
                                            Descripción complementaria:
                                            <i class="fa fa-question-circle float-right" title="Agregar una descripción complementaria de la propiedad"></i>
                                        </label>
                                        <textarea name="pro_descripcion" placeholder="Describir adicional de la propiedad" rows="7" class="form-control @error('pro_descripcion') is-invalid @enderror"></textarea>
                                        @error('pro_descripcion')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>											
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
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

@endsection