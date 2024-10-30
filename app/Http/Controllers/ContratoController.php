<?php

namespace App\Http\Controllers;

use App\Models\AdjuntoContrato;
use App\Models\Cliente;
use App\Models\ConfiguracionProgramaPago;
use App\Models\Contrato;
use App\Models\FirmaCliente;
use App\Models\FirmaPropietarioLegal;
use App\Models\Lote;
use App\Models\ProgramaPago;
use App\Models\Propiedad;
use App\Models\Propietario_legal;
use App\Models\ReciboPago;
use App\Models\Urbanizacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use TNkemdilim\MoneyToWords\Converter;
use TNkemdilim\MoneyToWords\Languages as Language;

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
        return view('contratos.lista_contratos', ['titulo'=>'Contratos de compraventa',
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
        // $contratos = Contrato::where('con_fecha_contrato');        
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

        //guardar configuracion de pagos
        $config_pagos = new ConfiguracionProgramaPago();
        $config_pagos->con_id = $contrato->con_id;
        $config_pagos->cof_precio_total = $request->input('con_precio_total');
        $config_pagos->cof_tipo_venta = $request->input('con_tipo_venta');
        $config_pagos->cof_interes = $request->input('con_interes');
        $config_pagos->cof_plazo = $request->input('con_plazo');
        $config_pagos->cof_pago_inicial = $request->input('con_pago_inicial');
        $config_pagos->cof_moneda = $request->input('con_moneda');
        $config_pagos->cof_tasa_cambio = $request->input('con_tasa_cambio');
        $config_pagos->save();        

        //guardar plan de pagos
        $plan_pagos = json_decode($request->input('campo_plan_pagos'));
        $primer_pago = 0;
        foreach($plan_pagos as $item){
            $plan = new ProgramaPago();
            $plan->cof_id = $config_pagos->cof_id;
            $plan->ppa_nro = $item->nro;
            $plan->ppa_fecha_programada = $item->fecha;            
            $plan->ppa_cuota_programada = $item->monto;
            $plan->ppa_cuota_cambio = $item->monto_cambio;
            $plan->ppa_interes_mensual = $item->interes_mensual;
            $plan->ppa_amortizacion_mensual = $item->amortizacion;
            $plan->ppa_saldo = $item->saldo;
            $plan->save();
            
            if($primer_pago == 0){
                // $recibo = new ReciboPago();
                // $recibo->rep_observacion = $item->observacion;
            }
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

    public function redaccion($id)
    {
        $id = Crypt::decryptString($id);
        $contrato = Contrato::where('con_id', $id)->first();        

        $moneda = "";
        if($contrato->con_moneda == 0){
            $moneda = "BOLIVIANOS";
        }else{
            $moneda = "DOLARES AMERICANOS";
        }

        $converterM2 = new Converter("METROS CUADRADOS", "centavos", Language::SPANISH);
        $converterMoney = new Converter($moneda,"centavos", Language::SPANISH);

        $superficie_literal = $converterM2->convert(floatval($contrato->propiedad->pro_superficie));
        $superficie_literal = substr($superficie_literal, 0, strlen($superficie_literal)-4);
        $monto_total_literal = $converterMoney->convert(floatVal($contrato->con_precio_total));
        $monto_total_literal = substr($monto_total_literal, 0, strlen($monto_total_literal)-4);
        $pago_inicial_literal = $converterMoney->convert(floatVal($contrato->con_pago_inicial));
        $pago_inicial_literal = substr($pago_inicial_literal, 0, strlen($pago_inicial_literal)-4);

        return view('contratos.form_redactar_contrato', ['titulo'=>'Redactar contrato',
                                                          'superficie_literal' => $superficie_literal,
                                                          'monto_total_literal' => $monto_total_literal,
                                                          'pago_inicial_literal' => $pago_inicial_literal,
                                                          'contrato' => $contrato,
                                                          'modulo_activo' => $this->modulo
                                                         ]);
    }

    public function plan_pago($id)
    {
        $id = Crypt::decryptString($id);
        $contrato = Contrato::where('con_id', $id)->first();        
        $configuracion = ConfiguracionProgramaPago::where('con_id', $id)->first();
        $cuotas = ProgramaPago::where("cof_id", $configuracion->cof_id)->get();
        return view('contratos.plan_pagos', ['titulo'=>'Plan de pagos',
                                                          'configuracion' => $configuracion,
                                                          'contrato' => $contrato,
                                                          'cuotas' => $cuotas,
                                                          'modulo_activo' => $this->modulo
                                                         ]);
    }

    public function adjuntos($id)
    {
        $id = Crypt::decryptString($id);
        $contrato = Contrato::where('con_id', $id)->first();        
        $adjuntos = AdjuntoContrato::where("con_id", $id)->get();
        return view('contratos.lista_adjuntos_contratos', ['titulo'=>'Adjuntos de contrato',
                                                          'contrato' => $contrato,
                                                          'adjuntos' => $adjuntos,
                                                          'modulo_activo' => $this->modulo
                                                         ]);
    }

    public function nuevo_adjunto($id)
    {
        $id = Crypt::decryptString($id);
        $contrato = Contrato::where('con_id', $id)->first();        
        return view('contratos.form_nuevo_adjunto_contrato', ['titulo'=>'Nuevo adjunto de contrato',
                                                          'contrato' => $contrato,
                                                          'modulo_activo' => $this->modulo
                                                         ]);
    }


}
