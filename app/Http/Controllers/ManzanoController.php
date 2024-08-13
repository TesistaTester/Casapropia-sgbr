<?php

namespace App\Http\Controllers;

use App\Models\Lote;
use Illuminate\Http\Request;
use App\Models\Urbanizacion;
use App\Models\Manzano;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class ManzanoController extends Controller
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
        return "HOLA MUNDO";
    }

    /**
     * Show the form for creating a new resource.
     * @param  int  $id Identificador de urbanización
     * @return \Illuminate\Http\Response
     */
    public function nuevo_manzano_urbanizacion($id)
    {
        $urbanizacion = Urbanizacion::where('urb_id', $id)->first();
        $titulo = 'NUEVO MANZANO - '.$urbanizacion->urb_nombre;

        return view('propiedades.form_nuevo_manzano', [
            'modulo_activo' => $this->modulo,
            'titulo'=>$titulo, 
            'urbanizacion'=>$urbanizacion
        ]);
    }


    /**
     * Show the form for creating a new resource.
     * @param  int  $id Identificador de urbanización
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $urbanizacion = Urbanizacion::where('urb_id', $id)->first();
        // $titulo = 'NUEVO MANZANO - URBANIZACION: '.$urbanizacion->urb_nombre;

        // return view('propiedades.form_nuevo_manzano', ['titulo'=>$titulo, 'urbanizacion'=>$urbanizacion]);
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
            'man_nombre'=>'required|min:1|max:100',
        ]);

        $manzano = new Manzano();
        $urb_id = $request->input('urb_id');
        $manzano->urb_id = $urb_id;
        $manzano->man_nombre = $request->input('man_nombre'); 
        $manzano->save();

        return redirect('/urbanizaciones/'.Crypt::encryptString($urb_id));
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
        $id = Crypt::decryptString($id);//Desencriptando parametro ID
        $manzano = Manzano::where('man_id', $id)->first();
        $urbanizacion = $manzano->urbanizacion;
        $titulo = 'EDITAR MANZANO - '.$urbanizacion->urb_nombre;

        return view('propiedades.form_editar_manzano', [
            'modulo_activo' => $this->modulo,
            'titulo'=>$titulo, 
            'urbanizacion'=>$urbanizacion, 
            'manzano'=>$manzano
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
            'man_nombre'=>'required|min:1|max:100',
        ]);

        $manzano = Manzano::where('man_id', $id)->first();
        $urb_id = $request->input('urb_id');
        $manzano->urb_id = $urb_id;
        $manzano->man_nombre = $request->input('man_nombre'); 
        $manzano->save();

        return redirect('/urbanizaciones/'.Crypt::encryptString($urb_id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $manzano = Manzano::where('man_id', $id)->first();
        $manzano->delete();
        $urb_id = $request->input('urb_id');
        return redirect('urbanizaciones/'.$urb_id);
    }

    //obtener los lotes de un manzano dado un id de manzano
    public function get_lotes_by_manzano_json(Request $request){
        $id = $request->input('man_id');
        $usu_rol = 1; //rol del usuario;
        $lotes = DB::table('lote')
                 ->join('propiedad', 'lote.pro_id', '=', 'propiedad.pro_id')
                 ->join('modalidad_venta', 'propiedad.pro_id', '=', 'modalidad_venta.pro_id')
                 ->where('lote.man_id', $id)
                 ->where('modalidad_venta.mov_activo', true)
                 ->whereNotIn('propiedad.pro_id', DB::table('reserva')->select('pro_id'))
                //  ->where('')//agregar estado de propiedad de acuerdo a requerimientos
                 ->get();
        return response()->json(['status'=>'1', 'lotes'=>$lotes]);
    }

}
