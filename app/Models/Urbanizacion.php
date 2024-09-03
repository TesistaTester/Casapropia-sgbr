<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Urbanizacion extends Model
{
    use HasFactory;
    protected $table = "urbanizacion";
    protected $primaryKey = "urb_id";

    /*
    ------------------------------------------------------------------------
    METODOS PARA RELACIONES
    ------------------------------------------------------------------------
     */
    //Manzanos de la urbanizacion X
    public function manzanos(){
        return $this->hasMany(Manzano::class, 'urb_id');
    }
    //Lotes de la urbanizacion X
    public function lotes(){
        return $this->hasManyThrough(Lote::class, Manzano::class, 'urb_id', 'man_id', 'urb_id', 'man_id');
    }
    //Adjuntos de la urbanizacion X
    public function adjuntos(){
        return $this->hasMany(AdjuntoUrbanizacion::class, 'urb_id');
    }
    /*
    ------------------------------------------------------------------------
    METODOS ADICIONALES
    ------------------------------------------------------------------------
     */
}
