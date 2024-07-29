<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Propietario_real extends Model
{
    use HasFactory;
    protected $table = "propietario_real";
    protected $primaryKey = "prr_id";
    /*
    ------------------------------------------------------------------------
    METODOS PARA RELACIONES
    ------------------------------------------------------------------------
     */
    //propietario real proviene de 1 persona
    public function persona(){
        return $this->belongsTo(Persona::class, 'per_id');
    }
    public function cantidad_propiedades(){
        return $this->hasMany(Asignacion_propietario_real::class, 'prr_id');
    }
    //propietarios reales sin asignacion


     /*
    ------------------------------------------------------------------------
    METODOS ADICIONALES
    ------------------------------------------------------------------------
     */
    //metodo para verificar la existencia de un propietario real en bd
    public static function existe_propietario_real_por_nro_documento($x){
        $propietario_real = DB::table('propietario_real')
                                ->join('persona','propietario_real.per_id' ,'=', 'persona.per_id')
                                ->select('persona.*', 'propietario_real.*')
                                ->where('persona.per_nro_id', '=', $x)
                                ->get();
        if($propietario_real->count() > 0){
            return $propietario_real;
        }else{
            return false;
        }                        
    }

}
