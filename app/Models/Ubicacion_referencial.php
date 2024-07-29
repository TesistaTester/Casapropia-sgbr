<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubicacion_referencial extends Model
{
    use HasFactory;
    protected $table = "ubicacion_referencial";
    protected $primaryKey = "ure_id";
    /*
    ------------------------------------------------------------------------
    METODOS PARA RELACIONES
    ------------------------------------------------------------------------
     */
    public function ubicacion(){
        return $this->belongsTo(Ubicacion::class, 'ubi_id');
    }

    /*
    ------------------------------------------------------------------------
    METODOS ADICIONALES
    ------------------------------------------------------------------------
     */
}
