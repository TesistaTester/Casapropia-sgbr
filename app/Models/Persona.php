<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Persona extends Model
{
    use HasFactory;
    protected $table = "persona";
    protected $primaryKey = "per_id";
    /*
    ------------------------------------------------------------------------
    METODOS PARA RELACIONES
    ------------------------------------------------------------------------
     */
    //Persona proviene de un país
    public function pais(){
        return $this->belongsTo(Pais::class, 'pai_id');
    }
    //Cliente tiene N contratos
    public function domicilio(){
        return $this->hasMany(Domicilio::class, 'per_id');
    }


     /*
    ------------------------------------------------------------------------
    METODOS ADICIONALES
    ------------------------------------------------------------------------
     */
    // si existe, retorna array persona
    // si no existe, retorna falso
    public static function existe_persona_por_nro_documento($x){
        $persona = DB::table('persona')
                                ->select('persona.*')
                                ->where('persona.per_nro_id', '=', $x)
                                ->get();
        if($persona->count() > 0){
            return true;
        }else{
            return false;
        }                                
    }

    //OBTIENE POR NRO DE DOCUMENTO
    public static function get_persona_por_nro_documento($x){
        $persona = DB::table('persona')
                                ->select('persona.*')
                                ->where('persona.per_nro_id', '=', $x)
                                ->get();
        if($persona->count() > 0){
            return $persona;
        }else{
            return [];
        }                                
    }


}
