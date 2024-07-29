<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Lote;
use App\Models\Propiedad;
use App\Models\Estado_disponibilidad;
use App\Models\Estado_propiedad;

class EstadoPropiedadController extends Controller
{
    private $modulo = "propiedades";
    /**
     * Muestra el formulario para crear una nueva modalidad de venta.
     *
     * @return \Illuminate\Http\Response
     */
    public function nuevo_estado($id)
    {
        $id = Crypt::decryptString($id);//Desencriptando parametro ID
        $lote = Lote::where('lot_id', $id)->first();
        $propiedad = $lote->propiedad;
        $manzano = $lote->manzano;
        $urbanizacion = $manzano->urbanizacion;
        $titulo = "NUEVO ESTADO DE LA PROPIEDAD";
        $estados = Estado_disponibilidad::all();

        return view('propiedades.form_nuevo_estado_propiedad', [
            'modulo_activo' => $this->modulo,
            'titulo'=>$titulo, 
            'urbanizacion'=>$urbanizacion, 
            'manzano'=>$manzano,
            'lote'=>$lote,
            'propiedad'=>$propiedad,
            'estados'=>$estados
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
        $validacion = $request->validate([
            'pro_id'=>'required|min:1',
            'lot_id'=>'required|min:1',
            'edi_id'=>'required|min:1|integer',
            'esp_fecha'=>'required|min:10|max:10|date',
            'esp_descripcion'=>'min:0|max:200',
        ]);
        $pro_id = Crypt::decryptString($request->input('pro_id'));
        $ultimo_estado = Estado_propiedad::ultimo_estado($pro_id);
        if($ultimo_estado != NULL){
            //ya tiene anteriores registros
            $ultimo_estado = Estado_propiedad::where('esp_id', $ultimo_estado->esp_id)->first();
            $ultimo_estado->esp_activo = 0;
            $ultimo_estado->save();
        }
        //guardar modalidad de venta
        $estado = new Estado_propiedad();
        $estado->pro_id = $pro_id;
        $estado->edi_id = $request->input('edi_id');
        $estado->esp_fecha = $request->input('esp_fecha');
        if($request->input('esp_descripcion') == NULL){
            $estado->esp_descripcion = '';
        }else{
            $estado->esp_descripcion = $request->input('esp_descripcion'); 
        }
        $estado->esp_activo = 1;//registro nuevo (siempre activo)
        $estado->save();

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
        $estado_propiedad = Estado_propiedad::where('esp_id', $id)->first();
        $propiedad = $estado_propiedad->propiedad;
        $lote = $propiedad->lote;
        $manzano = $lote->manzano;
        $urbanizacion = $manzano->urbanizacion;
        $titulo = 'EDITAR ESTADO DE LA PROPIEDAD';
        $estados = Estado_disponibilidad::all();

        return view('propiedades.form_editar_estado_propiedad', [
            'modulo_activo' => $this->modulo,
            'titulo'=>$titulo,
            'urbanizacion'=>$urbanizacion,
            'manzano'=>$manzano,
            'lote'=>$lote,
            'propiedad'=>$propiedad,
            'estado_propiedad'=>$estado_propiedad,
            'estados'=>$estados
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
        $validacion = $request->validate([
            'lot_id'=>'required|min:1',
            'edi_id'=>'required|min:1|integer',
            'esp_fecha'=>'required|min:10|max:10|date',
            'esp_descripcion'=>'min:0|max:200',
        ]);
        $esp_id = Crypt::decryptString($id);
        //guardar estado propiedad
        $estado = Estado_propiedad::where('esp_id', $esp_id)->first();
        $estado->edi_id = $request->input('edi_id');
        $estado->esp_fecha = $request->input('esp_fecha');
        if($request->input('esp_descripcion') == NULL){
            $estado->esp_descripcion = '';
        }else{
            $estado->esp_descripcion = $request->input('esp_descripcion'); 
        }
        $estado->esp_activo = 1;//registro nuevo (siempre activo)
        $estado->save();

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
        $estado_propiedad = Estado_propiedad::where('esp_id', $id)->first();
        $estado_propiedad->delete();
        $lot_id = $request->input('lot_id');
        return redirect('lotes/'.$lot_id);
    }
}
