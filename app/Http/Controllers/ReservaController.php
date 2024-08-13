<?php

namespace App\Http\Controllers;

use App\Models\Lote;
use App\Models\Propiedad;
use App\Models\Reserva;
use App\Models\Persona;
use App\Models\Urbanizacion;
use App\Models\DescargoReserva;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use TNkemdilim\MoneyToWords\Converter;
use TNkemdilim\MoneyToWords\Languages as Language;

class ReservaController extends Controller
{
    private $modulo = "reservas";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservas = Reserva::all();
        return view('reservas.lista_reservas', ['titulo'=>'Reservas',
                                                          'reservas' => $reservas,
                                                          'modulo_activo' => $this->modulo
                                                         ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function generar_nro_recibo($nro){
        $generado = "";
        $nro = $nro + 1;
        if($nro < 10){
            $generado = "000".$nro;
        }else{
            if($nro < 100){
                $generado = "00".$nro;
            }else{
                if($nro < 1000){
                    $generado = "0".$nro;
                }else{
                    $generado = "".$nro;
                }
            }
        }
        return $generado;
    }

    public function create()
    {
        $titulo = 'NUEVA RESERVA';
        $urbanizaciones = Urbanizacion::all();
        $ultimo_recibo = Reserva::max('res_nro_recibo');
        $nro_recibo = $this->generar_nro_recibo($ultimo_recibo);

        return view('reservas.form_nuevo_reserva', [   
                                                       'titulo'=>$titulo, 
                                                       'urbanizaciones'=>$urbanizaciones, 
                                                       'nro_recibo'=>$nro_recibo, 
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
            'lot_id'=>'required',
            'res_modalidad'=>'required',
            'per_nro_id'=>'required',
            'per_nombres'=>'required',
            'per_primer_apellido'=>'required',
            'per_segundo_apellido'=>'required',
            'res_nro_recibo'=>'required',
            'res_monto'=>'required',
            'res_moneda'=>'required',
            'res_concepto_recibo'=>'required',
            'res_efectivo'=>'required',
            'res_fecha_recibo'=>'required',
            'res_observacion'=>'required',
        ]);

        //procesando datos de persona
        if($request->input('per_id') == '0'){
            //PERSONA NUEVA
            $persona = new Persona();
            $persona->pai_id = 1;//ID de Bolivia = 1, insertado en BD por seeder
            $persona->per_tipo_persona = 0;
            $persona->per_tipo_documento = 0;
            $persona->per_nro_id = $request->input('per_nro_id');
            $persona->per_expedido = 'LP';
            $persona->per_nombres = $request->input('per_nombres');
            $persona->per_primer_apellido = $request->input('per_primer_apellido');
            $persona->per_segundo_apellido = $request->input('per_segundo_apellido');
            $persona->per_fecha_nacimiento = '1900-01-01';
            $persona->per_sexo = 'O';
            $persona->per_estado_civil = 5;
            $persona->per_nombre_comercial = '';
            $persona->save();    
        }else{
            //PERSONA REGISTRADA Y PROPIETARIO NUEVO
            $persona = Persona::where('per_id', $request->input('per_id'))->first();
        }
        //procesando datos de propiedad
        $lote = Lote::where('lot_id', $request->input('lot_id'))->first();
        $propiedad = $lote->propiedad;


        $reserva = new Reserva();
        $reserva->per_id = $persona->per_id;
        $reserva->pro_id = $propiedad->pro_id;
        $reserva->res_nro_recibo = $request->input('res_nro_recibo');
        $reserva->res_concepto_recibo = $request->input('res_concepto_recibo'); 
        $reserva->res_monto = $request->input('res_monto');
        $reserva->res_moneda = $request->input('res_moneda');
        $reserva->res_efectivo = $request->input('res_efectivo');
        $reserva->res_fecha_recibo = $request->input('res_fecha_recibo');
        $reserva->res_observacion_pago = $request->input('res_observacion');
        $reserva->res_modalidad = $request->input('res_modalidad');
        $reserva->res_fecha_expiracion = Carbon::parse($request->input('res_fecha_recibo'))->add(config('casapropia.TIEMPO_EXPIRACION_RESERVA') ,'day');
        $reserva->res_ampliacion_exp = false;
        $reserva->res_devuelto = false; 
        $reserva->res_fecha_devolucion = '1900-01-01';
        $reserva->res_observacion_devolucion = '';
        $reserva->save();

        return redirect('/reservas');
    }

    /**
     * Ampliar fecha de la reserva.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ampliacion($id)
    {
        $id = Crypt::decryptString($id);
        $reserva = Reserva::where('res_id', $id)->first();
        $reserva->res_ampliacion_exp = true;
        $reserva->res_fecha_expiracion = Carbon::now()->add(config('casapropia.TIEMPO_AMPLIACION_RESERVA') ,'day');
        $reserva->save();
        return redirect('/reservas');
    }

    /**
     * Registrar descargo de la reserva.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function registrar_descargo(Request $request, $id)
    {
        $id = Crypt::decryptString($id);
        $reserva = Reserva::where('res_id', $id)->first();
        $descargo = new DescargoReserva();
        $descargo->res_id = $id;
        if($request->input('dre_observacion') == null || $request->input('dre_observacion') == ''){
            $descargo->dre_observacion = "-";
        }else{
            $descargo->dre_observacion = $request->input('dre_observacion');
        }
        $descargo->dre_fecha = Carbon::now();
        $descargo->save();
        return redirect('/reservas');
    }

    /**
     * Devolucion reserva.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function devolucion(Request $request, $id)
    {
        $id = Crypt::decryptString($id);
        $reserva = Reserva::where('res_id', $id)->first();
        $reserva->res_ampliacion_exp = true;
        if($request->input('res_observacion_devolucion') == null || $request->input('res_observacion_devolucion') == ''){
            $reserva->res_observacion_devolucion = "-";
        }else{
            $reserva->res_observacion_devolucion = $request->input('res_observacion_devolucion');
        }
        $reserva->res_devuelto = true;
        $reserva->res_fecha_expiracion = Carbon::now();
        $reserva->save();
        return redirect('/reservas');
    }


    /**
     * Muestra formulario para imprimir documento.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function imprimir_recibo($id)
    {
        $titulo = 'Imprimir recibo';
        $id = Crypt::decryptString($id);
        $reserva = Reserva::where('res_id', $id)->first();
        $monto = $reserva->res_monto;
        //convertir de numero a texto para recibo
        $moneda = "";
        if($reserva->res_moneda == 0){
            $moneda = "Bolivianos";
        }else{
            $moneda = "Dólares";
        }
        $converter = new Converter($moneda,"centavos", Language::SPANISH);
        $cad_monto = $converter->convert(floatval($monto));
        return view('reservas.show_imprimir_recibo', [   
            'titulo'=>$titulo, 
            'reserva'=>$reserva,
            'cad_monto' => $cad_monto, 
            'modulo_activo' => $this->modulo
         ]);
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
        $id = Crypt::decryptString($id);
        $reserva = Reserva::where('res_id', $id)->first();
        $descargo = DescargoReserva::where('res_id', $id)->first();
        if($descargo != null){
            $descargo->delete();
        }
        $reserva->delete();
        return redirect('reservas');
    }
}
