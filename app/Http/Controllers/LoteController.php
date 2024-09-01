<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Urbanizacion;
use App\Models\Ubicacion;
use App\Models\Ubicacion_referencial;
use App\Models\Lote;
use App\Models\Propiedad;
use App\Models\Estado_disponibilidad;
use App\Models\Estado_propiedad;
use App\Models\Propietario_real;
use App\Models\Propietario_legal;
use Brick\Math\BigInteger;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class LoteController extends Controller
{
    private $modulo = "propiedades";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     * @param  int  $id Identificador de urbanización
     * @return \Illuminate\Http\Response
     */
    public function nuevo_lote_urbanizacion($id)
    {
        $ubicaciones = Ubicacion::all();
        $urbanizacion = Urbanizacion::where('urb_id', $id)->first();
        $titulo = 'NUEVO LOTE - '.$urbanizacion->urb_nombre;
        return view('propiedades.form_nuevo_lote', [
            'modulo_activo' => $this->modulo,
            'titulo'=>$titulo, 
            'urbanizacion'=>$urbanizacion, 
            'ubicaciones'=>$ubicaciones
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validacion = $request->validate([
            'man_id'=>'required|min:1|max:100',
            'lot_nro'=>'required|min:0|integer',
            'lot_codigo'=>'nullable|min:1|max:100',
            'lot_matricula'=>'nullable|min:1|max:100',
            'pro_superficie'=>'required|min:0|numeric',
            'lot_superficie_construida'=>'nullable|min:0|numeric',
            'lot_ancho_via'=>'required|min:0|numeric',
            'pro_muro_perimetral'=>'nullable|min:0|numeric',
            'ubi_id'=>'required',
            'pro_descripcion'=>'nullable|min:1|max:100',
        ]);
        //guardar propiedad
        $propiedad = new Propiedad();
        $propiedad->pro_superficie = $request->input('pro_superficie');
        $propiedad->pro_muro_perimetral = $request->input('pro_muro_perimetral');
        $propiedad->pro_descripcion = $request->input('pro_descripcion');
        $propiedad->pro_base_imponible = $request->input('pro_base_imponible');
        $propiedad->pro_nro_inmueble = $request->input('pro_nro_inmueble');
        $propiedad->save();
        //guardar lote
        $lote = new Lote();
        $lote->man_id = $request->input('man_id');
        $lote->pro_id = $propiedad->pro_id;
        $lote->lot_nro = $request->input('lot_nro');
        $lote->lot_codigo = $request->input('lot_codigo');
        $lote->lot_matricula = $request->input('lot_matricula');
        $lote->lot_ancho_via = $request->input('lot_ancho_via');
        $lote->lot_superficie_construida = $request->input('lot_superficie_construida');
        $lote->save();
        //guardar ubicaciones (seleccion multiple)
        $ubi_id = $request->input('ubi_id');
        foreach($ubi_id as $item){
            $ubi_ref = new Ubicacion_referencial();
            $ubi_ref->lot_id = $lote->lot_id;
            $ubi_ref->ubi_id = $item;
            $ubi_ref->save();
        }
        //guardar estado (predeterminado)
        $estado_guardado = Estado_disponibilidad::where('edi_estado', 'GUARDADO')->first();
        $estado_propiedad = new Estado_propiedad();
        $estado_propiedad->edi_id = $estado_guardado->edi_id;
        $estado_propiedad->pro_id = $propiedad->pro_id;
        $estado_propiedad->esp_fecha = date('Y-m-d');
        $estado_propiedad->esp_descripcion = "PRIMER ESTADO (REGISTRO SISTEMA)";
        $estado_propiedad->esp_activo = 1;
        $estado_propiedad->save();

        $urb_id = $request->input('urb_id');

        return redirect('urbanizaciones/'.Crypt::encryptString($urb_id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        // $ip = $request->ip();
        // echo "EL id antes de desencriptar: ".$id;
        $id = Crypt::decryptString($id);//Desencriptando parametro ID
        // echo "<br>EL id antes es: ".$id;
        $lote = Lote::where('lot_id', $id)->first();
        // echo "<br>EL id despues es: ".$id;
        $propiedad = $lote->propiedad;
        $manzano = $lote->manzano;
        $urbanizacion = $manzano->urbanizacion;
        $modalidades = $propiedad->modalidades_venta->sortByDesc('created_at');
        $estados = $propiedad->estados->sortByDesc('created_at');
        $adjuntos = $propiedad->adjuntos;

        //contratos de la propiedad
        // $contratos = $propiedad->contratos;
        $contratos = collect();
        //propietarios no asignados
        $propietarios_legales_libres = $propiedad->ple_libres($propiedad->pro_id);
        $propietarios_reales_libres = $propiedad->prr_libres($propiedad->pro_id);
        //propietarios asignados
        $propietarios_legales_asignados = $propiedad->propietarios_legales($propiedad->pro_id);
        $propietarios_reales_asignados = $propiedad->propietarios_reales($propiedad->pro_id);
        //Porcentaje de asignacion para propietarios reales
        $porcentaje_disponible = 100;
        if($propietarios_reales_asignados->count() > 0){
            $porcentaje_asignado = 0;
            foreach($propietarios_reales_asignados as $item){
                $porcentaje_asignado = $porcentaje_asignado + $item->apr_participacion;
            }
            $porcentaje_disponible = 100 - $porcentaje_asignado;
        }

        $titulo = 'LOTE: '.$lote->lot_nro;
        return view('propiedades.detalle_lote', [
                                                 'modulo_activo' => $this->modulo,
                                                 'titulo'=>$titulo, 
                                                 'urbanizacion'=>$urbanizacion, 
                                                 'manzano'=>$manzano,
                                                 'lote'=> $lote,
                                                 'propiedad'=>$propiedad,
                                                 'modalidades'=>$modalidades,
                                                 'estados'=>$estados,
                                                 'ple_libres' => $propietarios_legales_libres,
                                                 'prr_libres' => $propietarios_reales_libres,
                                                 'ple_asignados' => $propietarios_legales_asignados,
                                                 'prr_asignados' => $propietarios_reales_asignados,
                                                 'porcentaje_disponible' => $porcentaje_disponible,
                                                 'contratos'=>$contratos,
                                                 'adjuntos'=>$adjuntos,
                                                //  'ip'=>$ip
                                                ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
