<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClienteActividad extends Model
{
    use HasFactory;
    protected $table = "cliente_actividad";
    protected $primaryKey = "cla_id";
    /*
    ------------------------------------------------------------------------
    METODOS PARA RELACIONES
    ------------------------------------------------------------------------
     */
    //Cliente_actividad proviene de: Cliente
    public function cliente(){
        return $this->belongsTo(Cliente::class, 'cli_id');
    }
    //Cliente_actividad proviene de: Actividad_economica
    // public function actividad_economica(){
    //     return $this->belongsToMany(ActividadEconomica::class, 'ace_id');
    // }

    /*
    ------------------------------------------------------------------------
    METODOS ADICIONALES
    ------------------------------------------------------------------------
     */


}
