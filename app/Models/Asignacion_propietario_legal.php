<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignacion_propietario_legal extends Model
{
    use HasFactory;
    protected $table = "asignacion_propietario_legal";
    protected $primaryKey = "apl_id";
    /*
    ------------------------------------------------------------------------
    METODOS PARA RELACIONES
    ------------------------------------------------------------------------
     */
    //Asignacion Propietario Legal proviene de: Propietario Legal
    public function propietario_legal(){
        return $this->belongsTo(Propietario_legal::class, 'ple_id');
    }
    //Asignacion Propietario Legal proviene de: Propiedad
    public function propiedad(){
        return $this->belongsTo(Propiedad::class, 'pro_id');
    }


     /*
    ------------------------------------------------------------------------
    METODOS ADICIONALES
    ------------------------------------------------------------------------
     */


}
