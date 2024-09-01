<?php

namespace App\Http\Controllers;

use App\Models\AdjuntoPropiedad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Lote;
use Illuminate\Support\Facades\Storage;


class AdjuntoPropiedadController extends Controller
{
    private $modulo = "propiedades";

    public function nuevo_adjunto_propiedad($id){
        $id = Crypt::decryptString($id);//Desencriptando parametro ID
        $lote = Lote::where('lot_id', $id)->first();
        $propiedad = $lote->propiedad;
        $manzano = $lote->manzano;
        $urbanizacion = $manzano->urbanizacion;
        $titulo = "NUEVO DOCUMENTO ADJUNTO DE PROPIEDAD";

        return view('propiedades.form_nuevo_adjunto_propiedad', [
            'modulo_activo' => $this->modulo,
            'titulo'=>$titulo,
            'urbanizacion'=>$urbanizacion, 
            'manzano'=>$manzano,
            'lote'=>$lote,
            'propiedad'=>$propiedad,
        ]);

    }

    public function store_adjunto_propiedad(Request $request){

        $validacion = $request->validate([
            //datos propiedad
              'apo_descripcion'=>'required|min:2|max:150',
                     'apo_ruta'=>'required|file|mimes:pdf,jpg,png|max:20000',
                       'pro_id'=>'required'
        ]);

        //guardar cliente
        $adjunto = new AdjuntoPropiedad();
        $pro_id = Crypt::decryptString($request->input('pro_id'));
        $adjunto->pro_id = $pro_id;
        $adjunto->apo_descripcion = $request->input('apo_descripcion');
        $codigo_propiedad = 'PRO'.$pro_id;
        //creando carpeta cliente
        $disk = Storage::disk('public');
        $carpeta_propiedad = 'docs_propiedades/'.$codigo_propiedad;
        $disk->makeDirectory($carpeta_propiedad);
        $disk->put($carpeta_propiedad.'/index.html', "Acceso no permitido");

        $uri_file = $request->file('apo_ruta')->storePublicly($carpeta_propiedad, 'public'); // store encadenado
        $adjunto->apo_ruta = $uri_file;
        $adjunto->save();

        $lote = Lote::where('pro_id', $pro_id)->first();

        return redirect('lotes/'.Crypt::encryptString($lote->lot_id));
        
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
        $adjunto = AdjuntoPropiedad::where('apo_id', $id)->first();
        Storage::delete('public/'.$adjunto->apo_ruta);
        $lote = Lote::where('pro_id', $adjunto->propiedad->pro_id)->first();
        $adjunto->delete();
        return redirect('lotes/'.Crypt::encryptString($lote->lot_id));
    }
}
