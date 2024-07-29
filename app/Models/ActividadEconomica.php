<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActividadEconomica extends Model
{
    use HasFactory;
    protected $table = "actividad_economica";
    protected $primaryKey = "ace_id";
    /*
    ------------------------------------------------------------------------
    METODOS PARA RELACIONES
    ------------------------------------------------------------------------
     */
    //Actividad_economica tiene N cliente_actividad
    public function cliente_actividad(){
        return $this->hasMany(ClienteActividad::class, 'ace_id');
    }

    /*
    ------------------------------------------------------------------------
    METODOS ADICIONALES
    ------------------------------------------------------------------------
     */
}
