<?php

namespace App\Http\Controllers;

use App\Models\AdjuntoUrbanizacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Lote;
use App\Models\Urbanizacion;
use Illuminate\Support\Facades\Storage;


class AdjuntoUrbanizacionController extends Controller
{
    private $modulo = "Urbanizaciones";

    public function nuevo_adjunto_Urbanizacion($id){
        $id = Crypt::decryptString($id);//Desencriptando parametro ID
        $urbanizacion = Urbanizacion::where('urb_id', $id)->first();
        $titulo = "NUEVO DOCUMENTO ADJUNTO DE URBANIZACION";

        return view('propiedades.form_nuevo_adjunto_urbanizacion', [
            'modulo_activo' => $this->modulo,
            'titulo'=>$titulo,
            'urbanizacion'=>$urbanizacion, 
        ]);

    }

    public function store_adjunto_Urbanizacion(Request $request){

        $validacion = $request->validate([
            //datos Urbanizacion
              'adu_descripcion'=>'required|min:2|max:150',
                     'adu_ruta'=>'required|file|mimes:pdf,jpg,png|max:20000',
                       'urb_id'=>'required'
        ]);

        //guardar adjunto
        $adjunto = new AdjuntoUrbanizacion();
        $urb_id = Crypt::decryptString($request->input('urb_id'));
        $adjunto->urb_id = $urb_id;
        $adjunto->adu_descripcion = $request->input('adu_descripcion');
        $codigo_urbanizacion = 'URB'.$urb_id;
        //creando carpeta de urbanizacion
        $disk = Storage::disk('public');
        $carpeta_urbanizacion = 'docs_urbanizaciones/'.$codigo_urbanizacion;
        $disk->makeDirectory($carpeta_urbanizacion);
        $disk->put($carpeta_urbanizacion.'/index.html', "Acceso no permitido");

        $uri_file = $request->file('adu_ruta')->storePublicly($carpeta_urbanizacion, 'public'); // store encadenado
        $adjunto->adu_ruta = $uri_file;
        $adjunto->save();


        return redirect('urbanizaciones/'.Crypt::encryptString($urb_id));
        
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $id = Crypt::decryptString($id);
        $adjunto = AdjuntoUrbanizacion::where('adu_id', $id)->first();
        Storage::delete('public/'.$adjunto->adu_ruta);
        $urbanizacion = Urbanizacion::where('urb_id', $adjunto->urbanizacion->urb_id)->first();
        $adjunto->delete();
        return redirect('urbanizaciones/'.Crypt::encryptString($urbanizacion->urb_id));
    }
}
