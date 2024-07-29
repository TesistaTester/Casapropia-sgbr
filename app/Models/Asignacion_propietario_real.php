<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignacion_propietario_real extends Model
{
    use HasFactory;
    protected $table = "asignacion_propietario_real";
    protected $primaryKey = "apr_id";
    /*
    ------------------------------------------------------------------------
    METODOS PARA RELACIONES
    ------------------------------------------------------------------------
     */
    //Asignacion Propietario Real proviene de: Propietario Real
    public function propietario_real(){
        return $this->belongsTo(Propietario_real::class, 'prr_id');
    }
    //Asignacion Propietario Real proviene de: Propiedad
    public function propiedad(){
        return $this->belongsTo(Propiedad::class, 'pro_id');
    }


     /*
    ------------------------------------------------------------------------
    METODOS ADICIONALES
    ------------------------------------------------------------------------
     */
}
