<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manzano extends Model
{
    use HasFactory;
    protected $table = "manzano";
    protected $primaryKey = "man_id";
    /*
    ------------------------------------------------------------------------
    METODOS PARA RELACIONES
    ------------------------------------------------------------------------
     */
    //Manzano tiene N lotes
    public function lotes(){
        return $this->hasMany(Lote::class, 'man_id');
    }
    //Manzano proviene de: Urbanizacion
    public function urbanizacion(){
        return $this->belongsTo(Urbanizacion::class, 'urb_id');
    }

    /*
    ------------------------------------------------------------------------
    METODOS ADICIONALES
    ------------------------------------------------------------------------
     */

}
