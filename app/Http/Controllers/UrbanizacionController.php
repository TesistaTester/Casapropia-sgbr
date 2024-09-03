<?php

namespace App\Http\Controllers;

use App\Models\Manzano;
use App\Models\Urbanizacion;
use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class UrbanizacionController extends Controller
{
    private $modulo = "urbanizaciones";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $urbanizaciones = Urbanizacion::paginate(5);
        return view('propiedades.lista_urbanizaciones', [
            'modulo_activo' => $this->modulo,
            'titulo'=>'Registro de Urbanizaciones', 
            'urbanizaciones'=>$urbanizaciones
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
        return view('propiedades.form_nueva_urbanizacion', [
            'modulo_activo' => $this->modulo,
            'titulo'=>'Nueva urbanizacion'
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
            'urb_nombre'=>'required|min:2|max:100',
            'urb_fecha_aprobacion'=>'nullable|date|min:10|max:10',
            'urb_ley'=>'nullable|min:2|max:150',
        ]);

        $urbanizacion = new Urbanizacion();
        $urbanizacion->urb_nombre = $request->input('urb_nombre');
        $urbanizacion->urb_fecha_aprobacion = $request->input('urb_fecha_aprobacion'); 
        $urbanizacion->urb_ley = $request->input('urb_ley'); 
        $urbanizacion->save();
        $manzanos = array_filter(explode(',',$request->input('manzanos')));
        if(count($manzanos) > 0){
            foreach($manzanos as $item){
                $manzano = new Manzano();
                $manzano->urb_id = $urbanizacion->urb_id;
                $manzano->man_nombre = $item; 
                $manzano->save();    
            }
        }

        return redirect('/urbanizaciones');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = Crypt::decryptString($id);//Desencriptando parametro ID
        $urbanizacion = Urbanizacion::where('urb_id', $id)->first();
        $titulo = 'URBANIZACION: '.$urbanizacion->urb_nombre;
        return view('propiedades.detalle_urbanizacion', [
            'modulo_activo' => $this->modulo,
            'titulo'=>$titulo, 
            'urbanizacion'=>$urbanizacion
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
        $id = Crypt::decryptString($id);
        $urbanizacion = Urbanizacion::where('urb_id', $id)->first();
        return view('propiedades.form_editar_urbanizacion', [
            'modulo_activo' => $this->modulo,
            'titulo'=>'Editar urbanizacion', 
            'urbanizacion'=>$urbanizacion
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
            'urb_nombre'=>'required|min:2|max:100',
            'urb_fecha_aprobacion'=>'nullable|date|min:10|max:10',
            'urb_ley'=>'nullable|min:2|max:150',
        ]);

        $urbanizacion = Urbanizacion::where('urb_id', $id)->first();
        $urbanizacion->urb_nombre = $request->input('urb_nombre');
        $urbanizacion->urb_fecha_aprobacion = $request->input('urb_fecha_aprobacion'); 
        $urbanizacion->urb_ley = $request->input('urb_ley'); 
        $urbanizacion->save();

        return redirect('/urbanizaciones');
    }


    public function store_plano_inicial(Request $request, $id)
    {
        $validacion = $request->validate([
            'urb_geo'=>'required|min:2',
        ]);

        $id = Crypt::decryptString($id);//Desencriptando parametro ID
        $urbanizacion = Urbanizacion::where('urb_id', $id)->first();
        $urbanizacion->urb_plano_geojson = $request->input('urb_plano_geojson'); 
        $urbanizacion->save();

        return redirect('urbanizaciones/'.Crypt::encryptString($id));
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
        $urbanizacion = Urbanizacion::where('urb_id', $id)->first();
        $urbanizacion->delete();
        return redirect('urbanizaciones');
    }

    //obtener los manzanos dado un id de urbanizacion
    public function get_manzanos_by_urbanizacion_json(Request $request){
        $id = $request->input('urb_id');
        $manzanos = Manzano::where('urb_id', $id)->get();
        return response()->json(['status'=>'1', 'manzanos'=>$manzanos]);
    }

}
