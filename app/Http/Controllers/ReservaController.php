<?php

namespace App\Http\Controllers;

use App\Models\Propiedad;
use App\Models\Reserva;
use App\Models\Urbanizacion;
use Illuminate\Http\Request;

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
        // $validacion = $request->validate([
        //     'man_nombre'=>'required|min:1|max:100',
        // ]);

        // $manzano = new Manzano();
        // $urb_id = $request->input('urb_id');
        // $manzano->urb_id = $urb_id;
        // $manzano->man_nombre = $request->input('man_nombre'); 
        // $manzano->save();

        // return redirect('/urbanizaciones/'.$urb_id);
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
