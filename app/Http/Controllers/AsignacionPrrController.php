<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asignacion_propietario_real;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class AsignacionPrrController extends Controller
{
    /*
     *  Guardar la asignacion del propietario real
     * @param  \Illuminate\Http\Request  $request
     */
    public function guardar_asignacion_propietario_real(Request $request){
        $apr = new Asignacion_propietario_real();
        $lot_id = $request->input('lot_id');
        $apr->pro_id = $request->input('pro_id');
        $apr->prr_id = $request->input('prr_id');
        $apr->apr_participacion = $request->input('apr_participacion');
        $apr->apr_descripcion = $request->input('apr_descripcion');
        $apr->save();
        return redirect('lotes/'.$lot_id);
    }
    /*
     *  Editar la asignacion del propietario real
     * @param  \Illuminate\Http\Request  $request
     */
    public function editar_asignacion_propietario_real(Request $request, $id){
        $id = Crypt::decryptString($id);//Desencriptando parametro ID
        $apr = Asignacion_propietario_real::where('apr_id', $id)->first();
        $lot_id = $request->input('lot_id');
        $apr->apr_participacion = $request->input('apr_participacion_edit');
        $apr->apr_descripcion = $request->input('apr_descripcion_edit');
        $apr->save();
        return redirect('lotes/'.$lot_id);
    }

    /*
     *  Eliminar la asignacion del propietario real
     * @param  \Illuminate\Http\Request  $request
     */
    public function eliminar_asignacion_propietario_real(Request $request, $id){
        $id = Crypt::decryptString($id);//Desencriptando parametro ID
        $apr = Asignacion_propietario_real::where('apr_id', $id)->first();
        $apr->delete();
        $lot_id = $request->input('lot_id');
        return redirect('lotes/'.$lot_id);
    }

}
