<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Contrato;
use App\Models\FirmaCliente;
use App\Models\FirmaPropietarioLegal;
use App\Models\Lote;
use App\Models\Propiedad;
use App\Models\Propietario_legal;
use App\Models\Urbanizacion;
use Illuminate\Http\Request;

class ContratoController extends Controller
{
    private $modulo = "contratos";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contratos = Contrato::all();
        return view('contratos.lista_contratos', ['titulo'=>'Contratos',
                                                          'contratos' => $contratos,
                                                          'modulo_activo' => $this->modulo
                                                         ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $propiedades = Propiedad::all();
        $urbanizaciones = Urbanizacion::all();
        $clientes = Cliente::all();
        $propietarios = Propietario_legal::all();
        $contratos = Contrato::where('con_fecha_contrato');        
        return view('contratos.form_nuevo_contrato', ['titulo'=>'Registrar contrato',
                                                          'urbanizaciones' => $urbanizaciones,
                                                          'clientes' => $clientes,
                                                          'propietarios' => $propietarios,
                                                          'propiedades' => $propiedades,
                                                          'modulo_activo' => $this->modulo
                                                         ]);
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
            //datos propiedad
            'lot_id'=>'required',
            'con_tipo_venta'=>'required',
            'con_interes'=>'required',
            'con_codigo_contrato'=>'required|min:1|max:100',
            'con_nro_contrato'=>'required',
            'con_precio_total'=>'required',
            'con_moneda'=>'required',
            'con_pago_inicial'=>'required',
            'con_plazo'=>'required',
            'con_tasa_cambio'=>'required',
            'con_tipo'=>'required',
            'con_fecha_contrato'=>'required',
            'cli_id'=>'required',
            'ple_id'=>'required',
            'campo_plan_pagos'=>'required'
        ]);
        //PERSONA NUEVA Y PROPIETARIO NUEVO
        $contrato = new Contrato();
        $lote = Lote::where('lot_id', $request->input('lot_id'))->first();
        $contrato->pro_id = $lote->propiedad->pro_id;
        $contrato->con_codigo_contrato = $request->input('con_codigo_contrato');
        $contrato->con_nro_contrato = $request->input('con_nro_contrato');
        $contrato->con_precio_total = $request->input('con_precio_total');
        $contrato->con_moneda = $request->input('con_moneda');
        $contrato->con_tipo_venta = $request->input('con_tipo_venta');
        $contrato->con_pago_inicial = $request->input('con_pago_inicial');
        $contrato->con_plazo = $request->input('con_plazo');
        $contrato->con_tasa_cambio = $request->input('con_tasa_cambio');
        $contrato->con_fecha_contrato = $request->input('con_fecha_contrato');
        $contrato->con_interes = $request->input('con_interes');
        $contrato->con_tipo = 0;
        $contrato->con_descripcion = '';
        $contrato->con_interes_mora_pago = 0;
        $contrato->con_meses_mora_pago = 0;
        $contrato->con_rescindido = false;
        $contrato->con_causa_rescindido = '';
        $contrato->con_origen = 0;
        $contrato->con_anulacion = 0;
        $contrato->save();    

        //guardar firma contrato cliente (seleccion multiple)
        $cli_id = $request->input('cli_id');
        foreach($cli_id as $item){
            $firma_cliente = new FirmaCliente();
            $firma_cliente->con_id = $contrato->con_id;
            $firma_cliente->cli_id = $item;
            $firma_cliente->fic_firmado = false;
            $firma_cliente->fic_fecha_firmado = '1900-01-01';
            $firma_cliente->save();
        }
        //guardar firma contrato propietario legal (seleccion multiple)
        $ple_id = $request->input('ple_id');
        foreach($ple_id as $item){
            $firma_propietario = new FirmaPropietarioLegal();
            $firma_propietario->con_id = $contrato->con_id;
            $firma_propietario->ple_id = $item;
            $firma_propietario->fip_firmado = false;
            $firma_propietario->fip_fecha_firmado = '1900-01-01';
            $firma_propietario->save();
        }

        return redirect('contratos/');
        
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
