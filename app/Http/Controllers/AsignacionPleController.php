<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asignacion_propietario_legal;
use Illuminate\Support\Facades\Crypt;

class AsignacionPleController extends Controller
{
    /*
     *  Guardar la asignacion del propietario legal
     * @param  \Illuminate\Http\Request  $request
     */
    public function guardar_asignacion_propietario_legal(Request $request){
        $apl = new Asignacion_propietario_legal();
        $lot_id = $request->input('lot_id');
        $apl->pro_id = $request->input('pro_id');
        $apl->ple_id = $request->input('ple_id');
        $apl->apl_descripcion = $request->input('apl_descripcion');
        $apl->save();

        return redirect('lotes/'.$lot_id);

    }
    /*
     *  Editar la asignacion del propietario legal
     * @param  \Illuminate\Http\Request  $request
     */
    public function editar_asignacion_propietario_legal(Request $request, $id){
        $id = Crypt::decryptString($id);//Desencriptando parametro ID
        $apl = Asignacion_propietario_legal::where('apl_id', $id)->first();
        $lot_id = $request->input('lot_id');
        $apl->apl_descripcion = $request->input('apl_descripcion_edit');
        $apl->save();
        return redirect('lotes/'.$lot_id);
    }
    /*
     *  Eliminar la asignacion del propietario real
     * @param  \Illuminate\Http\Request  $request
     */
    public function eliminar_asignacion_propietario_legal(Request $request, $id){
        $id = Crypt::decryptString($id);//Desencriptando parametro ID
        $apl = Asignacion_propietario_legal::where('apl_id', $id)->first();
        $apl->delete();
        $lot_id = $request->input('lot_id');
        return redirect('lotes/'.$lot_id);
    }

}
