<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdjuntoUrbanizacion extends Model
{
    use HasFactory;
    protected $table = "adjunto_urbanizacion";
    protected $primaryKey = "adu_id";
    /*
    ------------------------------------------------------------------------
    METODOS PARA RELACIONES
    ------------------------------------------------------------------------
     */
    public function urbanizacion(){
        return $this->belongsTo(Urbanizacion::class, 'urb_id');
    }

}
