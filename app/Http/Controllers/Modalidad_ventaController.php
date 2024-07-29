<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Lote;
use App\Models\Modalidad_venta;
use App\Models\Propiedad;

class Modalidad_ventaController extends Controller
{
    private $modulo = "propiedades";
    /**
     * Muestra el formulario para crear una nueva modalidad de venta.
     *
     * @return \Illuminate\Http\Response
     */
    public function nueva_modalidad_venta($id)
    {
        $id = Crypt::decryptString($id);//Desencriptando parametro ID
        $lote = Lote::where('lot_id', $id)->first();
        $propiedad = $lote->propiedad;
        $manzano = $lote->manzano;
        $urbanizacion = $manzano->urbanizacion;
        $titulo = "NUEVA MODALIDAD DE VENTA";

        return view('propiedades.form_nueva_modalidad_venta', [
            'modulo_activo' => $this->modulo,
            'titulo'=>$titulo, 
            'urbanizacion'=>$urbanizacion, 
            'manzano'=>$manzano,
            'lote'=>$lote,
            'propiedad'=>$propiedad
        ]);
    }



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
        //
        $validacion = $request->validate([
            'pro_id'=>'required|min:1',
            'lot_id'=>'required|min:1',
            'mov_moneda_venta'=>'required|min:0|max:1|integer',
            'mov_tipo_venta'=>'required|min:0|max:2|integer',
            'mov_precio_oferta'=>'required|min:0|numeric',
            'mov_precio_minimo'=>'required|min:0|numeric',
            'mov_tasa_interes'=>'required|min:0|numeric',
            'mov_monto_interes'=>'required|min:0|numeric',
            'mov_cuota_inicial'=>'required|min:0|numeric',
            'mov_precio_total_minimo'=>'required|min:1|numeric',
            'mov_plazo'=>'required|min:0|max:200',
        ]);
        $pro_id = Crypt::decryptString($request->input('pro_id'));
        $ultima_modalidad = Modalidad_venta::ultima_modalidad($pro_id);
        if($ultima_modalidad != NULL){
            //ya tiene anteriores registros
            $ultima_modalidad = Modalidad_venta::where('mov_id', $ultima_modalidad->mov_id)->first();
            $ultima_modalidad->mov_activo = 0;
            $ultima_modalidad->save();
        }
        //guardar modalidad de venta
        $modalidad = new Modalidad_venta();
        $modalidad->pro_id = $pro_id;
        $modalidad->mov_moneda_venta = $request->input('mov_moneda_venta');
        $modalidad->mov_tipo_venta = $request->input('mov_tipo_venta');
        $modalidad->mov_precio_oferta = $request->input('mov_precio_oferta');
        $modalidad->mov_precio_minimo = $request->input('mov_precio_minimo');
        $modalidad->mov_tasa_interes = $request->input('mov_tasa_interes');
        $modalidad->mov_monto_interes = $request->input('mov_monto_interes');
        $modalidad->mov_cuota_inicial = $request->input('mov_cuota_inicial');
        $modalidad->mov_plazo = $request->input('mov_plazo');
        $modalidad->mov_precio_total_minimo = $request->input('mov_precio_total_minimo');
        $modalidad->mov_activo = 1;//registro nuevo (siempre activo)
        $modalidad->save();

        $lot_id = $request->input('lot_id');

        return redirect('lotes/'.$lot_id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = Crypt::decryptString($id);
        $modalidad = Modalidad_venta::where('mov_id', $id)->first();
        $propiedad = $modalidad->propiedad;
        $lote = $propiedad->lote;
        $manzano = $lote->manzano;
        $urbanizacion = $manzano->urbanizacion;
        $titulo = 'EDITAR MODALIDAD DE VENTA';

        return view('propiedades.form_editar_modalidad_venta', [
            'modulo_activo' => $this->modulo,
            'titulo'=>$titulo,
            'urbanizacion'=>$urbanizacion,
            'manzano'=>$manzano,
            'lote'=>$lote,
            'propiedad'=>$propiedad,
            'modalidad'=>$modalidad,
        ]);
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
        $validacion = $request->validate([
            'pro_id'=>'required|min:1',
            'lot_id'=>'required|min:1',
            'mov_moneda_venta'=>'required|min:0|max:1|integer',
            'mov_tipo_venta'=>'required|min:0|max:2|integer',
            'mov_precio_oferta'=>'required|min:0|numeric',
            'mov_precio_minimo'=>'required|min:0|numeric',
            'mov_tasa_interes'=>'required|min:0|numeric',
            'mov_monto_interes'=>'required|min:0|numeric',
            'mov_cuota_inicial'=>'required|min:0|numeric',
            'mov_precio_total_minimo'=>'required|min:1|numeric',
            'mov_plazo'=>'required|min:0|max:200',
        ]);
        $mov_id = Crypt::decryptString($id);
        //guardar modalidad de venta
        $modalidad = Modalidad_venta::where('mov_id', $mov_id)->first();
        $modalidad->mov_moneda_venta = $request->input('mov_moneda_venta');
        $modalidad->mov_tipo_venta = $request->input('mov_tipo_venta');
        $modalidad->mov_precio_oferta = $request->input('mov_precio_oferta');
        $modalidad->mov_precio_minimo = $request->input('mov_precio_minimo');
        $modalidad->mov_tasa_interes = $request->input('mov_tasa_interes');
        $modalidad->mov_monto_interes = $request->input('mov_monto_interes');
        $modalidad->mov_cuota_inicial = $request->input('mov_cuota_inicial');
        $modalidad->mov_plazo = $request->input('mov_plazo');
        $modalidad->mov_precio_total_minimo = $request->input('mov_precio_total_minimo');
        // $modalidad->mov_activo = 1;//registro nuevo (siempre activo)
        $modalidad->save();

        $lot_id = $request->input('lot_id');

        return redirect('lotes/'.$lot_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $id = Crypt::decryptString($id);
        $modalidad = Modalidad_venta::where('mov_id', $id)->first();
        $modalidad->delete();
        $lot_id = $request->input('lot_id');
        return redirect('lotes/'.$lot_id);
    }



}
