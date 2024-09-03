<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{
    use HasFactory;
    protected $table = "lote";
    protected $primaryKey = "lot_id";
    /*
    ------------------------------------------------------------------------
    METODOS PARA RELACIONES
    ------------------------------------------------------------------------
     */
    //Lote pertenece a una propiedad 
    public function propiedad(){
        return $this->belongsTo(Propiedad::class, 'pro_id');
    }
    //Manzano pertenece a una propiedad 
    public function manzano(){
        return $this->belongsTo(Manzano::class, 'man_id');
    }

    public function ubicaciones(){
        return $this->hasMany(Ubicacion_referencial::class, 'lot_id');
    }

    //Atravesando una relacion
    // public function lotes(){
    //     return $this->hasManyThrough(Lote::class, Manzano::class, 'urb_id', 'man_id', 'urb_id', 'man_id');
    // }


    /*
    ------------------------------------------------------------------------
    METODOS ADICIONALES
    ------------------------------------------------------------------------
     */
}
