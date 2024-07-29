<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Propietario_legal extends Model
{
    use HasFactory;
    protected $table = "propietario_legal";
    protected $primaryKey = "ple_id";
    /*
    ------------------------------------------------------------------------
    METODOS PARA RELACIONES
    ------------------------------------------------------------------------
     */
    //propietario legal tiene solo 1 persona asociada
    public function persona(){
        return $this->belongsTo(Persona::class, 'per_id');
    }
    public function cantidad_propiedades(){
        return $this->hasMany(Asignacion_propietario_legal::class, 'ple_id');
    }


     /*
    ------------------------------------------------------------------------
    METODOS ADICIONALES
    ------------------------------------------------------------------------
     */
    //metodo para verificar la existencia de un propietario legal en bd
    public static function existe_propietario_legal_por_nro_documento($x){
        $propietario_legal = DB::table('propietario_legal')
                                ->join('persona','propietario_legal.per_id' ,'=', 'persona.per_id')
                                ->select('persona.*', 'propietario_legal.*')
                                ->where('persona.per_nro_id', '=', $x)
                                ->get();
        if($propietario_legal->count() > 0){
            return $propietario_legal;
        }else{
            return false;
        }                        
    }

     
}
